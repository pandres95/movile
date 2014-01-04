namespace SMSReceiverService
{
    public partial class SMSReceiverService
    {

        /// <summary> 
        /// Variable del diseñador requerida.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Limpiar los recursos que se estén utilizando.
        /// </summary>
        /// <param name="disposing">true si los recursos administrados se deben eliminar; false en caso contrario, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Código generado por el Diseñador de componentes

        /// <summary> 
        /// Método necesario para admitir el Diseñador. No se puede modificar 
        /// el contenido del método con el editor de código.
        /// </summary>
        private void InitializeComponent()
        {
            this.Log = new System.Diagnostics.EventLog();
            ((System.ComponentModel.ISupportInitialize)(this.Log)).BeginInit();
            // 
            // Log
            // 
            this.Log.Log = "Application";
            this.Log.Source = "SMSReceiverService";
            // 
            // SMSReceiverService
            // 
            this.ServiceName = "SMSReceiverService";
            ((System.ComponentModel.ISupportInitialize)(this.Log)).EndInit();

        }

        #endregion

        protected void InitializeLog()
        {
            if (!System.Diagnostics.EventLog.SourceExists("SMSReceiverService"))
                System.Diagnostics.EventLog.CreateEventSource("SMSReceiverService", "SMSReceiverLog");
        }

        protected void InitializeTimer(long time)
        {
            timer = new System.Timers.Timer();
            timer.Elapsed += new System.Timers.ElapsedEventHandler(TimerElapsed);
            timer.Interval = 1000 * time;
        }

        protected void StartTimer()
        {
            timer.Enabled = true;
        }

        protected void StopTimer()
        {
            timer.Enabled = false;
        }

        private System.Diagnostics.EventLog Log;
        private System.Timers.Timer timer;
        private Configuration configuracion;
    
    }

}
