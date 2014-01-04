using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ServiceHelper.SMSManager
{

    /// <summary>
    /// Descripción de un mensaje de texto de respuesta
    /// </summary>
    public class SMSAnswer
    {

        /// <summary>
        /// Identificador de la respuesta
        /// </summary>
        public Int32 Id
        {
            get;
            set;
        }

        /// <summary>
        /// Número celular del remitente
        /// </summary>
        public String Celular
        {
            get;
            set;
        }

        /// <summary>
        /// Mensaje de respuesta del remitente
        /// </summary>
        public String Respuesta
        {
            get;
            set;
        }

        /// <summary>
        /// Fecha de envío del mensaje
        /// </summary>
        public DateTime Fecha
        {
            get;
            set;
        }

        /// <summary>
        /// Constructor de la respuesta
        /// </summary>
        /// <param name="celular">Número celular del remitente</param>
        /// <param name="respuesta">Respuesta del remitente</param>
        /// <param name="fecha">Fecha de envío del mensaje</param>
        /// <param name="id">Identificador del mensaje</param>
        public SMSAnswer(String celular, String respuesta, DateTime fecha, Int32 id)
        {

            this.Celular = celular;
            this.Respuesta = respuesta;
            this.Fecha = fecha;
            this.Id = id;

        }

    }
}
