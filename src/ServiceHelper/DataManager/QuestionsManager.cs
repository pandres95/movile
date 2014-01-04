using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data.Common;
using MySql.Data.MySqlClient;

namespace ServiceHelper.DataManager
{

    /// <summary>
    /// Maneja el procesamiento de las respuestas enviadas por los usuarios, así como el envío de las siguientes preguntas.
    /// </summary>
    public class QuestionsManager
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
        public QuestionsManager(String host, String uName, String pass, String db)
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
        public bool HasActiveQuestion(String celular)
        {
            
            try
            {
                
                DbCommand dbComm = new MySqlCommand("SELECT COUNT(id) FROM respuestas_usuarios WHERE celular = @cellphone "
                    + "AND estado = 1 AND id_respuesta IS NULL LIMIT 1;");
                dbComm.Connection = dbConn;

                DbParameter cPhone = new MySqlParameter("cellphone", MySqlDbType.VarChar);
                cPhone.Value = celular;

                dbComm.Parameters.Add(cPhone);

                dbConn.Open();
                long res = (long)dbComm.ExecuteScalar();
                dbConn.Close();

                return res == 1;
                
            }
            catch (Exception e)
            {
                throw e;
            }

        }

        /// <summary>
        /// Responde la pregunta actual del usuario <paramref name="celular"/> con el <paramref name="numeral"/> indicado.
        /// </summary>
        /// <param name="celular">El número celular del usuario a responder la pregunta.</param>
        /// <param name="numeral">El numeral indicado para la respuesta</param>
        /// <returns>Un valor <see cref="bool"/> indicando si la respuesta a la pregunta se hizo exitosamente o no.</returns>
        public bool AnswerQuestion(String celular, int numeral)
        { 

            try
            {
                DbCommand dbComm = new MySqlCommand("responder_pregunta");
                dbComm.Connection = dbConn;
                dbComm.CommandType = System.Data.CommandType.StoredProcedure;

                DbParameter pCelular = new MySqlParameter("?i_celular", MySqlDbType.VarChar);
                pCelular.Direction = System.Data.ParameterDirection.Input;
                pCelular.Value = celular;
                DbParameter pNumeral = new MySqlParameter("?i_numeral", MySqlDbType.Int32);
                pNumeral.Direction = System.Data.ParameterDirection.Input;
                pNumeral.Value = numeral;
                DbParameter pResultado = new MySqlParameter("?resultado", MySqlDbType.Int32);
                pResultado.Direction = System.Data.ParameterDirection.Output;

                dbComm.Parameters.AddRange(new DbParameter[] { pCelular, pNumeral, pResultado });

                dbConn.Open();
                dbComm.ExecuteNonQuery();
                int res = (int)dbComm.Parameters["?resultado"].Value;
                dbConn.Close();

                return res == 1;

            }
            catch (Exception e)
            {
                throw e;
            }

        }

        /// <summary>
        /// Indica si el usuario tiene siguientes preguntas por responder.
        /// </summary>
        /// <param name="celular">El número de celular del usuario a buscar.</param>
        /// <returns>Un valor <see cref="bool"/> indicando si el usuario tiene o no una pregunta siguiente para responder.</returns>
        public bool HasNextQuestion(String celular)
        {

            try
            {
                DbCommand dbComm = new MySqlCommand("hay_siguiente_pregunta");
                dbComm.Connection = dbConn;
                dbComm.CommandType = System.Data.CommandType.StoredProcedure;

                DbParameter pCelular = new MySqlParameter("?i_celular", MySqlDbType.VarChar);
                pCelular.Direction = System.Data.ParameterDirection.Input;
                pCelular.Value = celular;
                DbParameter pResultado = new MySqlParameter("?resultado", MySqlDbType.Int32);
                pResultado.Direction = System.Data.ParameterDirection.Output;

                dbComm.Parameters.AddRange(new DbParameter[] { pCelular, pResultado });

                dbConn.Open();
                dbComm.ExecuteNonQuery();
                int res = (int)dbComm.Parameters["?resultado"].Value;
                dbConn.Close();

                return res == 1;

            }
            catch (Exception e)
            {
                throw e;
            }

        }

        /// <summary>
        /// Ingresa la siguiente pregunta para el usuario <paramref name="celular"/> en la base de datos.
        /// </summary>
        /// <param name="celular">El usuario a preguntarsele.</param>
        /// <returns>Un <see cref="bool"/> indicando si la pregunta fue correctamente asignada o no.</returns>
        public bool AskNextQuestion(String celular)
        {

            try
            {
                DbCommand dbComm = new MySqlCommand("agregar_siguiente_pregunta");
                dbComm.Connection = dbConn;
                dbComm.CommandType = System.Data.CommandType.StoredProcedure;

                DbParameter pCelular = new MySqlParameter("?i_celular", MySqlDbType.VarChar);
                pCelular.Direction = System.Data.ParameterDirection.Input;
                pCelular.Value = celular;
                DbParameter pResultado = new MySqlParameter("?resultado", MySqlDbType.Int32);
                pResultado.Direction = System.Data.ParameterDirection.Output;

                dbComm.Parameters.AddRange(new DbParameter[] { pCelular, pResultado });

                dbConn.Open();
                dbComm.ExecuteNonQuery();
                int res = (int)dbComm.Parameters["?resultado"].Value;
                dbConn.Close();

                return res == 1;

            }
            catch (Exception e)
            {
                throw e;
            }

        }

        /// <summary>
        /// Busca la siguiente pregunta para el usuario <paramref name="celular"/>.
        /// </summary>
        /// <param name="celular">El número celular del usuario a buscar.</param>
        /// <returns>El número de la siguiente pregunta o -1 si no existe siguiente pregunta</returns>
        public int NextQuestion(String celular)
        {

            try
            {
                DbCommand dbComm = new MySqlCommand("siguiente_pregunta");
                dbComm.Connection = dbConn;
                dbComm.CommandType = System.Data.CommandType.StoredProcedure;

                DbParameter pCelular = new MySqlParameter("?i_celular", MySqlDbType.VarChar);
                pCelular.Direction = System.Data.ParameterDirection.Input;
                pCelular.Value = celular;
                DbParameter pResultado = new MySqlParameter("?resultado", MySqlDbType.Int32);
                pResultado.Direction = System.Data.ParameterDirection.Output;

                dbComm.Parameters.AddRange(new DbParameter[] { pCelular, pResultado });

                dbConn.Open();
                dbComm.ExecuteNonQuery();
                int res = (int)dbComm.Parameters["?resultado"].Value;
                dbConn.Close();

                return res;

            }
            catch (Exception e)
            {
                throw e;
            }

        }

        /// <summary>
        /// Busca el texto de la pregunta indicada.
        /// </summary>
        /// <param name="questionNumber">El número de la pregunta a buscar.</param>
        /// <returns>Un <see cref="System.String"/> con el texto de la pregunta </returns>
        public string Question(int questionNumber)
        {

            try
            {

                String res = "";

                DbCommand dbComm = new MySqlCommand("SELECT texto FROM movile_preguntas WHERE id = @pregunta LIMIT 1;");
                dbComm.Connection = dbConn;

                DbParameter pNextQuestion = new MySqlParameter("pregunta", MySqlDbType.Int32);
                pNextQuestion.Value = questionNumber;

                dbComm.Parameters.Add(pNextQuestion);

                dbConn.Open();
                res += (string)dbComm.ExecuteScalar() + "\n";
                dbConn.Close();

                dbComm = new MySqlCommand("SELECT texto, numeral FROM movile_respuestas WHERE id_pregunta = @pregunta;");
                dbComm.Connection = dbConn;

                dbComm.Parameters.Add(pNextQuestion);

                dbConn.Open();
                DbDataReader reader = dbComm.ExecuteReader();
                
                while (reader.Read())
                {
                    res += reader["numeral"] + ". " + reader["texto"] + "\n";
                }

                dbConn.Close();

                return res;
            }
            catch (Exception e)
            {
                throw e;
            }
        }

        /// <summary>
        /// Invalida las preguntas anteriores a la pregunta actual del usuario <paramref name="celular"/> que quedaron abiertas.
        /// </summary>
        /// <param name="celular">El número celular del usuario al cual se le va a invalidar las preguntas anteriores.</param>
        /// <returns>El número de preguntas que fueron invalidadas tras el proceso.</returns>
        public int InvalidatePreviousQuestion(String celular)
        {

            try
            {
                DbCommand dbComm = new MySqlCommand("invalidar_preguntas_previas_abiertas");
                dbComm.Connection = dbConn;
                dbComm.CommandType = System.Data.CommandType.StoredProcedure;

                DbParameter pCelular = new MySqlParameter("?i_celular", MySqlDbType.VarChar);
                pCelular.Direction = System.Data.ParameterDirection.Input;
                pCelular.Value = celular;
                DbParameter pResultado = new MySqlParameter("?resultados", MySqlDbType.Int32);
                pResultado.Direction = System.Data.ParameterDirection.Output;

                dbComm.Parameters.AddRange(new DbParameter[] { pCelular, pResultado });

                dbConn.Open();
                dbComm.ExecuteNonQuery();
                int res = (int)dbComm.Parameters["?resultados"].Value;
                dbConn.Close();

                return res;

            }
            catch (Exception e)
            {
                throw e;
            }

        }

    }

}