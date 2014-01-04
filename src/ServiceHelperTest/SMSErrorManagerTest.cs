using ServiceHelper.DataManager;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using System;

namespace QuestionsTest
{
    
    
    /// <summary>
    ///Se trata de una clase de prueba para SMSErrorManagerTest y se pretende que
    ///contenga todas las pruebas unitarias SMSErrorManagerTest.
    ///</summary>
    [TestClass()]
    public class SMSErrorManagerTest
    {


        private TestContext testContextInstance;

        /// <summary>
        ///Obtiene o establece el contexto de la prueba que proporciona
        ///la información y funcionalidad para la ejecución de pruebas actual.
        ///</summary>
        public TestContext TestContext
        {
            get
            {
                return testContextInstance;
            }
            set
            {
                testContextInstance = value;
            }
        }

        #region Atributos de prueba adicionales
        // 
        //Puede utilizar los siguientes atributos adicionales mientras escribe sus pruebas:
        //
        //Use ClassInitialize para ejecutar código antes de ejecutar la primera prueba en la clase 
        //[ClassInitialize()]
        //public static void MyClassInitialize(TestContext testContext)
        //{
        //}
        //
        //Use ClassCleanup para ejecutar código después de haber ejecutado todas las pruebas en una clase
        //[ClassCleanup()]
        //public static void MyClassCleanup()
        //{
        //}
        //
        //Use TestInitialize para ejecutar código antes de ejecutar cada prueba
        //[TestInitialize()]
        //public void MyTestInitialize()
        //{
        //}
        //
        //Use TestCleanup para ejecutar código después de que se hayan ejecutado todas las pruebas
        //[TestCleanup()]
        //public void MyTestCleanup()
        //{
        //}
        //
        #endregion


        /// <summary>
        ///Una prueba de LogSMSError
        ///</summary>
        [TestMethod()]
        public void LogSMSErrorTest()
        {
            string host = "localhost"; // TODO: Inicializar en un valor adecuado
            string uName = "shorty_your658"; // TODO: Inicializar en un valor adecuado
            string pass = "g2sdxPS2i7"; // TODO: Inicializar en un valor adecuado
            string db = "shorty_movile"; // TODO: Inicializar en un valor adecuado
            SMSErrorManager target = new SMSErrorManager(host, uName, pass, db); // TODO: Inicializar en un valor adecuado
            string celular = "3014599967"; // TODO: Inicializar en un valor adecuado
            target.LogSMSError(celular);
            Assert.Inconclusive("Un método que no devuelve ningún valor no se puede comprobar.");
        }
    }
}
