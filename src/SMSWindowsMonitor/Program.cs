using System;
using System.Diagnostics;

namespace SMSWindowsMonitor
{
    static class Program
    {


        private static EventLog Log;

        /// <summary>
        /// Punto de entrada principal para la aplicación.
        /// </summary>
        [STAThread]
        static void Main(string[] args)
        {
            Log = new EventLog("Application", ".", "SMSReceiverService");
            Log.EntryWritten += new EntryWrittenEventHandler(EntryWritten);
            Log.EnableRaisingEvents = true;
            Console.Read();
        }

        static void EntryWritten(object sender, EntryWrittenEventArgs e)
        {
            if (e.Entry.Message == "SvcStarted")
                Console.Clear();
            else
                Console.WriteLine("{0}", e.Entry.Message);
        }

    }

}