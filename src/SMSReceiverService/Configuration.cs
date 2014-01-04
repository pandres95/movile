using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.IO;
using System.Linq;
using System.Text;
using System.Runtime.Serialization;
using System.Runtime.Serialization.Json;

namespace SMSReceiverService
{

    [DataContract]
    class Configuration
    {

        // Elapsed time
        [DataMember]
        private int time;
        
        // SMS Sending & Receiving
        [DataMember]
        private string url;
        [DataMember]
        private string ticket;
        [DataMember]
        private string pass;
        [DataMember]
        private string user;
        [DataMember]
        private Int32 last_id;

        // Database connection
        [DataMember]
        private string db_host;
        [DataMember]
        private string db_user;
        [DataMember]
        private string db_pass;
        [DataMember]
        private string db_schema;

        public int Time
        {
            get {
                return time;
            }
            set
            {
                time = value;
            }
        }

        public String URL
        {
            get
            {
                return url;
            }
            set
            {
                url = value;
            }
        }

        public String Ticket
        {
            get
            {
                return ticket;
            }
            set
            {
                ticket = value;
            }
        }

        public String SMSPassword
        {
            get
            {
                return pass;
            }
            set
            {
                pass = value;
            }
        }

        public String SMSUser
        {
            get
            {
                return user;
            }
            set
            {
                user = value;
            }
        }

        public Int32 LastId
        {
            get
            {
                return last_id;
            }
            set
            {
                last_id = value;
            }
        }

        public String DbHost
        {
            get
            {
                return db_host;
            }
            set
            {
                db_host = value;
            }
        }

        public String DbUser
        {
            get
            {
                return db_user;
            }
            set
            {
                db_user = value;
            }
        }

        public String DbPassword
        {
            get
            {
                return db_pass;
            }
            set
            {
                db_pass = value;
            }
        }

        public String DbSchema
        {
            get
            {
                return db_schema;
            }
            set
            {
                db_schema = value;
            }
        }

        // Singleton
        private static Configuration instance;
        
        private Configuration()
        {
            time = 1;
            url =
            ticket =
            pass = 
            db_host = 
            db_user = 
            db_pass = 
            db_schema = "";
        }
        
        public static Configuration Instance
        {
            get
            {
                if (instance == null)
                {
                    instance = ReadFromFile();
                }
                return instance;
            }

        }

        private static Configuration ReadFromFile()
        {
            try
            {
                FileStream fs = File.Open("config.json", FileMode.Open);
                EventLog.WriteEntry("Archivo de configuración: {0}", fs.Name);
                DataContractJsonSerializer serializador = new DataContractJsonSerializer(typeof(Configuration));
                Configuration c = (Configuration)serializador.ReadObject(fs);
                fs.Close();
                return c;
            }
            catch (FileNotFoundException)
            {
                Configuration c = new Configuration();
                EventLog.WriteEntry("SMSReceiverService", "Archivo no encontrado, se creara una nueva configuración");
                return c;
            }

        }
        
        public static void SaveToFile()
        {
            try
            {
                FileStream fs = File.Open("config.json", FileMode.OpenOrCreate, FileAccess.Write);
                DataContractJsonSerializer serializador = new DataContractJsonSerializer(typeof(Configuration));
                serializador.WriteObject(fs, instance);
                fs.Close();
            }
            catch (Exception ex)
            {
                EventLog.WriteEntry("SMSReceiverService", ex.Message);
            }
        }

    }
}
