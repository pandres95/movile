using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data.Common;
using MySql.Data.MySqlClient;

namespace ServiceHelper.DataManager
{

    /// <summary>
    /// Maneja el logueo de los SMS Erroneos
    /// </summary>
    public class ErrorSMSManager
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
        public ErrorSMSManager(String host, String uName, String pass, String db)
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
        /// Incluye en el registro un SMS no enviado correctamente
        /// </summary>
        /// <param name="celular">Número de celular del usuario a registrar.</param>
        public void LogSMSError(String celular)
        {

            try
            {

                DbCommand dbComm = new MySqlCommand("INSERT INTO sms_fallidos (celular, fecha) VELUES(@cellphone, "
                    + "CURRENT_TIMESTAMP);");
                dbComm.Connection = dbConn;

                DbParameter cPhone = new MySqlParameter("cellphone", MySqlDbType.VarChar);
                cPhone.Value = celular;

                dbComm.Parameters.Add(cPhone);

                dbConn.Open();
                long res = (long)dbComm.ExecuteNonQuery();
                dbConn.Close();

            }
            catch (Exception e)
            {
                throw e;
            }

        }

    }
}