using ServiceHelper.DataManager;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using System;

namespace QuestionsTest
{
            
    /// <summary>
    ///Se trata de una clase de prueba para QuestionsManagerTest y se pretende que
    ///contenga todas las pruebas unitarias QuestionsManagerTest.
    ///</summary>
    [TestClass()]
    public class QuestionsManagerTest
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
        ///Una prueba de AnswerQuestion
        ///</summary>
        [TestMethod()]
        public void AnswerQuestionTest()
        {
            string host = "212.83.147.135"; // TODO: Inicializar en un valor adecuado
            string uName = "shorty"; // TODO: Inicializar en un valor adecuado
            string pass = "eseEselsitio123"; // TODO: Inicializar en un valor adecuado
            string db = "shorty_movile"; // TODO: Inicializar en un valor adecuado
            QuestionsManager target = new QuestionsManager(host, uName, pass, db); // TODO: Inicializar en un valor adecuado
            string celular = "3014599967"; // TODO: Inicializar en un valor adecuado
            int numeral = 1; // TODO: Inicializar en un valor adecuado
            bool actual;
            actual = target.AnswerQuestion(celular, numeral);
            Assert.IsTrue(actual);
        }

        /// <summary>
        ///Una prueba de HasActiveQuestion
        ///</summary>
        [TestMethod()]
        public void HasActiveQuestionTest()
        {
            string host = "212.83.147.135"; // TODO: Inicializar en un valor adecuado
            string uName = "shorty"; // TODO: Inicializar en un valor adecuado
            string pass = "eseEselsitio123"; // TODO: Inicializar en un valor adecuado
            string db = "shorty_movile"; // TODO: Inicializar en un valor adecuado
            QuestionsManager target = new QuestionsManager(host, uName, pass, db); // TODO: Inicializar en un valor adecuado
            string cellPhone = "3014599967"; // TODO: Inicializar en un valor adecuado
            bool actual;
            actual = target.HasActiveQuestion(cellPhone);
            Assert.IsTrue(actual);
        }


        /// <summary>
        ///Una prueba de HasNextQuestion
        ///</summary>
        [TestMethod()]
        public void HasNextQuestionTest()
        {
            string host = "212.83.147.135"; // TODO: Inicializar en un valor adecuado
            string uName = "shorty"; // TODO: Inicializar en un valor adecuado
            string pass = "eseEselsitio123"; // TODO: Inicializar en un valor adecuado
            string db = "shorty_movile"; // TODO: Inicializar en un valor adecuado
            QuestionsManager target = new QuestionsManager(host, uName, pass, db); // TODO: Inicializar en un valor adecuado
            string cellPhone = "3014599967"; // TODO: Inicializar en un valor adecuado
            bool actual;
            actual = target.HasNextQuestion(cellPhone);
            Assert.IsTrue(actual);
        }

        /// <summary>
        ///Una prueba de AskNextQuestion
        ///</summary>
        [TestMethod()]
        public void AskNextQuestionTest()
        {
            string host = "212.83.147.135"; // TODO: Inicializar en un valor adecuado
            string uName = "shorty"; // TODO: Inicializar en un valor adecuado
            string pass = "eseEselsitio123"; // TODO: Inicializar en un valor adecuado
            string db = "shorty_movile"; // TODO: Inicializar en un valor adecuado
            QuestionsManager target = new QuestionsManager(host, uName, pass, db); // TODO: Inicializar en un valor adecuado
            string celular = "3014599967"; // TODO: Inicializar en un valor adecuado
            bool actual;
            actual = target.AskNextQuestion(celular);
            Assert.IsTrue(actual);
        }

        /// <summary>
        ///Una prueba de NextQuestion
        ///</summary>
        [TestMethod()]
        public void NextQuestionTest()
        {
            string host = "212.83.147.135"; // TODO: Inicializar en un valor adecuado
            string uName = "shorty"; // TODO: Inicializar en un valor adecuado
            string pass = "eseEselsitio123"; // TODO: Inicializar en un valor adecuado
            string db = "shorty_movile"; // TODO: Inicializar en un valor adecuado
            QuestionsManager target = new QuestionsManager(host, uName, pass, db); // TODO: Inicializar en un valor adecuado
            string celular = "3014599967"; // TODO: Inicializar en un valor adecuado
            int expected = 7; // TODO: Inicializar en un valor adecuado
            int actual;
            actual = target.NextQuestion(celular);
            Assert.AreEqual(expected, actual);
        }

        /// <summary>
        ///Una prueba de NextQuestion
        ///</summary>
        [TestMethod()]
        public void NextQuestionTest1()
        {
            string host = "212.83.147.135"; // TODO: Inicializar en un valor adecuado
            string uName = "shorty"; // TODO: Inicializar en un valor adecuado
            string pass = "eseEselsitio123"; // TODO: Inicializar en un valor adecuado
            string db = "shorty_movile"; // TODO: Inicializar en un valor adecuado
            QuestionsManager target = new QuestionsManager(host, uName, pass, db); // TODO: Inicializar en un valor adecuado
            int nextQuestion = 7; // TODO: Inicializar en un valor adecuado
            string actual;
            actual = target.Question(nextQuestion);
            Assert.IsTrue(true ,"{0}", actual);
        }

        /// <summary>
        ///Una prueba de InvalidatePreviousQuestion
        ///</summary>
        [TestMethod()]
        public void InvalidatePreviousQuestionTest()
        {
            string host = "212.83.147.135"; // TODO: Inicializar en un valor adecuado
            string uName = "shorty"; // TODO: Inicializar en un valor adecuado
            string pass = "eseEselsitio123"; // TODO: Inicializar en un valor adecuado
            string db = "shorty_movile"; // TODO: Inicializar en un valor adecuado
            QuestionsManager target = new QuestionsManager(host, uName, pass, db); // TODO: Inicializar en un valor adecuado
            string celular = "3014599967"; // TODO: Inicializar en un valor adecuado
            int expected = 4;
            int actual;
            actual = target.InvalidatePreviousQuestion(celular);
            Assert.AreEqual(expected, actual);
        }
    }
}
