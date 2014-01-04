using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data.Common;
using MySql.Data.MySqlClient;

namespace ServiceHelper.DataManager
{
    public class SMSErrorManager
    {

        /// <summary>
        /// Conexión a la base de datos
        /// </summary>
        DbConnection dbConn;

        /// <summary>
        /// Constructor de la conexión de base de datos
        /// </summary>
        /// <param name="host">Servidor host para la conexión.</param>
        /// <param name="uName">Nombre de usuario para la conexión</param>
        /// <param name="pass">Constraseña de conexión</param>
        /// <param name="db">Base de datos a conectarse.</param>
        public SMSErrorManager(String host, String uName, String pass, String db)
        {
            try
            {
                dbConn = DatabaseConnection.Conectar(host, uName, pass, db);
            }
            catch (Exception e)
            {
                throw e;
            }
        }

        /// <summary>
        /// Busca si el usuario <paramref name="celular"/> tiene preguntas activas por responder.
        /// </summary>
        /// <param name="celular">Número de celular del usuario a buscar.</param>
        /// <returns>Un valor <see cref="bool"/> indicando si el usuario tiene preguntas activas para responder o no.</returns>
        public void LogSMSError(String celular)
        {
            
            try
            {
                
                DbCommand dbComm = new MySqlCommand("INSERT INTO sms_fallidos(celular, fecha) VALUES(@cellphone, "
                    + "CURRENT_TIMESTAMP);");
                dbComm.Connection = dbConn;

                DbParameter cPhone = new MySqlParameter("cellphone", MySqlDbType.VarChar);
                cPhone.Value = celular;

                dbComm.Parameters.Add(cPhone);

                dbConn.Open();
                dbComm.ExecuteNonQuery();
                dbConn.Close();

            }
            catch (Exception e)
            {
                throw e;
            }

        }

    }
}
