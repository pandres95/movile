namespace SMSReceiverService
{
    partial class ProjectInstaller
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
            this.ServiceProcessInstaller = new System.ServiceProcess.ServiceProcessInstaller();
            this.ServiceInstaller = new System.ServiceProcess.ServiceInstaller();
            // 
            // ServiceProcessInstaller
            // 
            this.ServiceProcessInstaller.Account = System.ServiceProcess.ServiceAccount.LocalSystem;
            this.ServiceProcessInstaller.Password = null;
            this.ServiceProcessInstaller.Username = null;
            // 
            // ServiceInstaller
            // 
            this.ServiceInstaller.Description = "Servicio de recepción y tratamiento de mensajes de texto";
            this.ServiceInstaller.DisplayName = "SMS Receiver Service";
            this.ServiceInstaller.ServiceName = "SMSReceiverService";
            this.ServiceInstaller.StartType = System.ServiceProcess.ServiceStartMode.Automatic;
            // 
            // ProjectInstaller
            // 
            this.Installers.AddRange(new System.Configuration.Install.Installer[] {
            this.ServiceProcessInstaller,
            this.ServiceInstaller});

        }

        #endregion

        private System.ServiceProcess.ServiceProcessInstaller ServiceProcessInstaller;
        private System.ServiceProcess.ServiceInstaller ServiceInstaller;
    }
}