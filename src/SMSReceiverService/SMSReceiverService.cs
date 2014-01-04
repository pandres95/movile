using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Linq;
using System.ServiceProcess;
using System.Text;
using System.Timers;
using ServiceHelper.SMSManager;
using ServiceHelper.DataManager;

namespace SMSReceiverService
{

    /// <summary>
    /// Punto principal del Servicio de Windows encargado de recibir y procesar los mensajes de texto de los usuarios.
    /// </summary>
    public partial class SMSReceiverService : ServiceBase
    {

        /// <summary>
        /// Constructor predeterminado
        /// </summary>
        public SMSReceiverService()
        {
            InitializeComponent();
            InitializeLog();
            configuracion = Configuration.Instance;
            InitializeTimer(configuracion.Time);
        }
        
        /// <summary>
        /// Evento de inicio del servicio.
        /// </summary>
        /// <param name="args">Argumentos enviados por medio de la línea de comandos que inicializo el proceso.</param>
        protected override void OnStart(string[] args)
        {
            Log.WriteEntry("SvcStarted");
            Log.WriteEntry(
                String.Format(
                    "{0}{1}SMS Receiver Service{1}v1.0{1}Session Started{1}{0}",
                    "************************************************", "\n"
                    )
                );
            StartTimer();
        }

        /// <summary>
        /// Ocurre cuando ha pasado el intervalo de espera. 
        /// Este evento está encargado del procesamiento de la lectura de los mensajes entrantes, y del envio para procesamiento.
        /// </summary>
        /// <param name="sender">El objeto que envía el evento. Normalmente es el timer</param>
        /// <param name="e">Los parametros del evento</param>
        void TimerElapsed(object sender, System.Timers.ElapsedEventArgs e)
        {

            StopTimer();

            Int32 lastId = configuracion.LastId;

            Log.WriteEntry(
                String.Format(
                    "[{0}] Iniciado proceso de análisis de mensajes. Leyendo mensajes con Id posterior a {1}",
                    e.SignalTime,
                    lastId
                )
            );
            
            List<SMSAnswer> bandejaEntrada = 
                ServiceReadMessage.LeerMensajes(configuracion.URL, configuracion.Ticket, lastId);

            
            foreach (SMSAnswer a in bandejaEntrada) 
            {
                Log.WriteEntry(
                String.Format(
                        "[{0}] Procesando mensaje: {1} envió {2} el {3}.",
                        DateTime.Now, // Fecha de procesamiento
                        a.Celular, // Celular que envió el mensaje
                        a.Respuesta, // Respuesta que envió en el mensaje.
                        a.Fecha // Fecha de envío del mensaje
                    )
                );

                ProcessAnswer(a);

            }

            int newElements = bandejaEntrada.Count;

            Log.WriteEntry(
                String.Format(
                        "[{0}] Ejecución finalizada: {1} {2}.", 
                        DateTime.Now, // Hora del evento
                        newElements, // Número de elementos nuevos leídos
                        (newElements == 1 ? "nuevo elemento leído": "nuevos elementos leídos")
                )
            );

            if (newElements > 0)
            {
                configuracion.LastId = bandejaEntrada.Last().Id;
            }
            Configuration.SaveToFile();

            StartTimer();

        }

        /// <summary>
        /// Procesa una respuesta y ejecuta las acciones de envío de nuevos mensajes de pregunta.
        /// </summary>
        /// <param name="ans">Descripción de la respuesta del usuario</param>
        private void ProcessAnswer(SMSAnswer ans)
        {

            try
            {

                QuestionsManager qManager = new QuestionsManager(configuracion.DbHost, configuracion.DbUser,
                    configuracion.DbPassword, configuracion.DbSchema);

                if (qManager.HasActiveQuestion(ans.Celular))
                {
                    Log.WriteEntry(
                        String.Format(
                            "[{0}] Se encontró una pregunta activa.",
                            DateTime.Now
                            )
                        );
                    if (qManager.AnswerQuestion(ans.Celular, Int32.Parse(ans.Respuesta.Trim())))
                    {
                        Log.WriteEntry(
                        String.Format(
                            "[{0}] La respuesta ha sido registrada",
                            DateTime.Now
                            )
                        );
                        if (qManager.HasNextQuestion(ans.Celular))
                        {
                            int nQ = qManager.NextQuestion(ans.Celular);
                            string message = qManager.Question(nQ);

                            try
                            {

                                ServiceSendMessageClient sms = new ServiceSendMessageClient();
                                string res = sms.SendMessage(configuracion.SMSUser, configuracion.SMSPassword, message,
                                    ans.Celular);
                                if (res != "")
                                {

                                    if (qManager.AskNextQuestion(ans.Celular))
                                    {
                                        Log.WriteEntry(
                                            String.Format(
                                                "[{0}] {1}",
                                                DateTime.Now,
                                                res
                                            )
                                        );
                                    }
                                    else
                                    {
                                        Log.WriteEntry(
                                            String.Format(
                                                "[{0}] La siguiente pregunta no pudo ser correctamente enviada. Por favor, revise las configuraciones de envío de SMS.",
                                                DateTime.Now
                                            )
                                        );
                                    }
                                    
                                }
                                

                            }
                            catch (Exception e)
                            {
                                Log.WriteEntry(String.Format(
                                    "[{0}] No se pudo enviar el mensaje. Procediendo a registrar el inconveniente.",
                                    DateTime.Now
                                    ));
                                new SMSErrorManager(configuracion.DbHost, configuracion.DbUser,
                    configuracion.DbPassword, configuracion.DbSchema).LogSMSError(ans.Celular);
                            }

                            
                        }
                        else
                        {
                            Log.WriteEntry(
                            String.Format(
                                "[{0}] No hay más preguntas.",
                                DateTime.Now
                                )
                            );
                            ServiceSendMessageClient sms = new ServiceSendMessageClient();
                            sms.SendMessage(configuracion.SMSUser, configuracion.SMSPassword, "Gracias por participar.", 
                                ans.Celular);
                        }
                    }
                    else
                    {
                        int qInv = qManager.InvalidatePreviousQuestion(ans.Celular);
                        Log.WriteEntry(
                            String.Format(
                                "[{0}] {1} {2}",
                                DateTime.Now,
                                qInv,
                                (qInv == 1 ? "pregunta cerrada" : "preguntas cerradas")
                            )
                        );
                    }
                }
                else
                {
                    int qInv = qManager.InvalidatePreviousQuestion(ans.Celular);
                    Log.WriteEntry(
                            String.Format(
                                "[{0}] {1} {2}",
                                DateTime.Now,
                                qInv,
                                (qInv == 1 ? "pregunta cerrada" : "preguntas cerradas")
                            )
                    );
                }

            }
            catch (Exception e)
            {
                Log.WriteEntry(
                    String.Format("[{0}] {1}: {2}",
                            DateTime.Now,
                            e.GetType(),
                            e.Message
                            )
                );
            }


        }

        /// <summary>
        /// Evento que ocurre al retornar el servicio de la pausa
        /// </summary>
        protected override void OnContinue()
        {
            StartTimer();
        }

        /// <summary>
        /// Evento que ocurre al pausar el servicio
        /// </summary>
        protected override void OnPause()
        {
            StopTimer();
            Configuration.SaveToFile();
        }

        /// <summary>
        /// Evento que ocurre al detener el servicio
        /// </summary>
        protected override void OnStop()
        {
            StopTimer();
            Configuration.SaveToFile();
            Log.WriteEntry("SvcStopped");
        }

    }

}
