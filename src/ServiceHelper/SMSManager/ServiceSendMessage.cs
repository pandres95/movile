namespace ServiceHelper.SMSManager
{
    
    /// <summary>
    /// Interfaz de envío de mensajes
    /// </summary>
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    [System.ServiceModel.ServiceContractAttribute(ConfigurationName = "IServiceSendMessage")]
    public interface IServiceSendMessage
    {
        /// <summary>
        /// Envía un mensaje de texto
        /// </summary>
        /// <param name="User">Usuario asignado por el operador</param>
        /// <param name="Password">Contraseña asignada por el operador</param>
        /// <param name="Message">Mensaje a enviar</param>
        /// <param name="PhoneNumber">Número de telefono a enviar</param>
        /// <returns>La respuesta del servicio web</returns>
        [System.ServiceModel.OperationContractAttribute(Action = "http://tempuri.org/IServiceSendMessage/SendMessage", ReplyAction = "http://tempuri.org/IServiceSendMessage/SendMessageResponse")]
        string SendMessage(string User, string Password, string Message, string PhoneNumber);
    }

    /// <summary>
    /// Interfaz del canal de conexión al servicio
    /// </summary>
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    public interface IServiceSendMessageChannel : IServiceSendMessage, System.ServiceModel.IClientChannel
    {
    }

    /// <summary>
    /// Servicio de envío de mensajes de texto
    /// </summary>
    [System.Diagnostics.DebuggerStepThroughAttribute()]
    [System.CodeDom.Compiler.GeneratedCodeAttribute("System.ServiceModel", "4.0.0.0")]
    public partial class ServiceSendMessageClient : System.ServiceModel.ClientBase<IServiceSendMessage>, IServiceSendMessage
    {

        /// <summary>
        /// Constructor predeterminado
        /// </summary>
        public ServiceSendMessageClient()
        {
        }

        /// <summary>
        /// Constructor del servicio
        /// </summary>
        /// <param name="endpointConfigurationName">Nombre del endpoint en el archivo de configuración</param>
        public ServiceSendMessageClient(string endpointConfigurationName) :
            base(endpointConfigurationName)
        {
        }

        /// <summary>
        /// Constructor del servicio
        /// </summary>
        /// <param name="endpointConfigurationName">Nombre del endpoint en el archivo de configuración</param>
        /// <param name="remoteAddress">Dirección del servicio</param>
        public ServiceSendMessageClient(string endpointConfigurationName, string remoteAddress) :
            base(endpointConfigurationName, remoteAddress)
        {
        }

        /// <summary>
        /// Constructor del servicio
        /// </summary>
        /// <param name="endpointConfigurationName">Nombre del endpoint en el archivo de configuración</param>
        /// <param name="remoteAddress">Dirección del servicio</param>
        public ServiceSendMessageClient(string endpointConfigurationName, System.ServiceModel.EndpointAddress remoteAddress) :
            base(endpointConfigurationName, remoteAddress)
        {
        }

        /// <summary>
        /// Constructor del servicio
        /// </summary>
        /// <param name="binding">Canal de conexión al servicio</param>
        /// <param name="remoteAddress">Dirección remota del servicio</param>
        public ServiceSendMessageClient(System.ServiceModel.Channels.Binding binding, System.ServiceModel.EndpointAddress remoteAddress) :
            base(binding, remoteAddress)
        {
        }

        /// <summary>
        /// Envía un mensaje de texto
        /// </summary>
        /// <param name="User">Usuario asignado por el operador</param>
        /// <param name="Password">Contraseña asignada por el operador</param>
        /// <param name="Message">Mensaje a enviar</param>
        /// <param name="PhoneNumber">Número de telefono a enviar</param>
        /// <returns>La respuesta del servicio web</returns>
        public string SendMessage(string User, string Password, string Message, string PhoneNumber)
        {
            return base.Channel.SendMessage(User, Password, Message, PhoneNumber);
        }
    
    }

}