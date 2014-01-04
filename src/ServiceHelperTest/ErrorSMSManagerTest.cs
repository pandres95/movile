using ServiceHelper.DataManager;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using System;

namespace QuestionsTest
{
    
    
    /// <summary>
    ///Se trata de una clase de prueba para ErrorSMSManagerTest y se pretende que
    ///contenga todas las pruebas unitarias ErrorSMSManagerTest.
    ///</summary>
    [TestClass()]
    public class ErrorSMSManagerTest
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
        ///Una prueba de Constructor ErrorSMSManager
        ///</summary>
        [TestMethod()]
        public void ErrorSMSManagerConstructorTest()
        {
            string host = string.Empty; // TODO: Inicializar en un valor adecuado
            string uName = string.Empty; // TODO: Inicializar en un valor adecuado
            string pass = string.Empty; // TODO: Inicializar en un valor adecuado
            string db = string.Empty; // TODO: Inicializar en un valor adecuado
            ErrorSMSManager target = new ErrorSMSManager(host, uName, pass, db);
            Assert.Inconclusive("TODO: Implementar código para comprobar el destino");
        }
    }
}
