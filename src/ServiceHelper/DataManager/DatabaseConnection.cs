using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data.Common;
using MySql.Data.MySqlClient;

namespace ServiceHelper.DataManager
{
    class DatabaseConnection
    {

        public static DbConnection Conectar(String host, String user, String pass, String db)
        {

            try
            {
                return new MySqlConnection(String.Format("server={0};User Id={1};password={2};"
                + "Persist Security Info=True;database={3}", host, user, pass, db));
            }
            catch(Exception e)
            {
                throw e;
            }

        }

    }
}
