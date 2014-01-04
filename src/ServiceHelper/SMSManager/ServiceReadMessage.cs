using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Xml;
using System.Xml.Linq;
using System.Globalization;

namespace ServiceHelper.SMSManager
{

    /// <summary>
    /// Servicio de lectura de mensajes
    /// </summary>
    public class ServiceReadMessage
    {

        /// <summary>
        /// Lee los mensajes a partir del <paramref name="lastReviewedId"/> especificado.
        /// </summary>
        /// <param name="url">Dirección URL con la ubicación del archivo RSS para lectura</param>
        /// <param name="ticket">Ticket de acceso a los datos, asignado por el operador</param>
        /// <param name="lastReviewedId">Id a partir del cual se leera</param>
        /// <returns>Todos los mensajes a partir del <paramref name="lastReviewedId"/> especificado.</returns>
        public static List<SMSAnswer> LeerMensajes(String url, String ticket, int lastReviewedId)
        {

            XmlReader reader = XmlReader.Create(url + ticket);
            XElement xE = XElement.Load(reader).Elements().First();

            IEnumerable<SMSAnswer> ans = 
                from item in xE.Elements("item")
                where Int32.Parse((string)item.Elements("comments").First()) > lastReviewedId
                select createSMSA(
                            (string)item.Elements("author").First(),
                            (string)item.Elements("title").First(),
                            ConvertToDate((string)item.Elements("pubDate").First()),
                            Int32.Parse((string)item.Elements("comments").First())
                );
            
            return ans.ToList();

        }

        private static SMSAnswer createSMSA(string cel, string ans, DateTime date, Int32 id)
        {
            return new SMSAnswer(cel, ans, date, id);
        }

        private static DateTime ConvertToDate(String s)
        {
            DateTime conv = new DateTime();
            if (DateTime.TryParse(s, CultureInfo.InvariantCulture, DateTimeStyles.None, out conv))
                return conv;
            else
                return DateTime.Now;
        }
 
    }
}
