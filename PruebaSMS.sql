/* Inserción de datos de prueba */

	SELECT * FROM movile_encuestas;
	INSERT INTO movile_encuestas (nombre) VALUES ('Encuesta de satisfaccion de MySQL');

	SELECT * FROM movile_preguntas;
	INSERT INTO movile_preguntas (id_encuesta, texto) VALUES (1, 'Como se siente usando MySQL Workbench?');
	INSERT INTO movile_preguntas (id_encuesta, texto) VALUES (1, 'Que piensa del uso de MySQL Workbench?');

	DELETE FROM movile_respuestas;
	SELECT * FROM movile_respuestas;
	INSERT INTO movile_respuestas (id, id_pregunta, texto, numeral) VALUES (1, 1, 'Excelente', 1);
	INSERT INTO movile_respuestas (id, id_pregunta, texto, numeral) VALUES (2, 1, 'Regular', 2);
	INSERT INTO movile_respuestas (id, id_pregunta, texto, numeral) VALUES (3, 1, 'Mal', 3);

	INSERT INTO movile_respuestas (id, id_pregunta, texto, numeral) VALUES (4, 2, 'Esta bien', 1);
	INSERT INTO movile_respuestas (id, id_pregunta, texto, numeral) VALUES (5, 2, 'Le faltan detalles', 2);

/* **************************** */

/* Inserción de números celulares */

	SELECT * FROM movile_celulares;
	CALL insertar_celular('3014599967','73001');
	CALL insertar_celular('3007261215','11001');
	CALL insertar_celular('3124712341','73001');

/* **************************** */

/* Ejemplos de manejo de encuestas */

	/* Inicia una encuesta con el número asignado */
	CALL iniciar_encuesta('3014599967', 1, @res);
	CALL iniciar_encuesta('3007261215', 1, @res);
	SELECT @res AS r;

	/* Responde una pregunta con el numeral dado */
	CALL responder_pregunta('3014599967', 2, @res);
	CALL responder_pregunta('3007261215', 1, @res);
	CALL responder_pregunta('3105851432', 3, @res);
	SELECT @res as r;

	/* Pregunta si hay más preguntas para responder en la encuesta activa del usuario */
	CALL hay_siguiente_pregunta('3014599967', @res);
	SELECT @res as r;

	/* Agrega la siguiente pregunta al usuario */
	CALL agregar_siguiente_pregunta('3014599967', @res);
	SELECT @res AS r;

	/* Invalida las preguntas que fueron abiertas previamente y no resueltas */
	CALL invalidar_preguntas_previas_abiertas('3007261215', @res);
	CALL invalidar_preguntas_previas_abiertas('3014599967', @res);
	SELECT @res AS r;

/* **************************** */

/*  Manejo de menus */

	SELECT * FROM movile_menu;
	INSERT INTO movile_menu VALUES(1, 'Escritorio', '', '1,2', NULL, 'home');
	INSERT INTO movile_menu VALUES(2, 'Envio de SMS', 'enviosms', '1,2', NULL, 'send');
	INSERT INTO movile_menu VALUES(3, 'Encuestas', 'encuesta', '1,2', NULL, 'list-alt');
	INSERT INTO movile_menu VALUES(4, 'Crear Encuesta', 'encuesta/nueva', '2', 3, 'plus');
	INSERT INTO movile_menu VALUES(5, 'Informes', 'informe', '1,2', NULL, 'book');
	INSERT INTO movile_menu VALUES(6, 'SMS Enviados', 'informe/sms_enviados', '1,2', NULL, 'book');

/* **************************** */

/* Registro de SMS Fallidos */

	INSERT INTO sms_fallidos(celular) VALUES ('3014599967');

/* **************************** */

/* Inserción de usuarios */

	SELECT * FROM movile_usuarios;
	INSERT INTO movile_usuarios VALUES (NULL, 'johasalinasq', 'Johana Salinas Q.', MD5('joahasalinasq'), 2, 1);
	INSERT INTO movile_usuarios VALUES (NULL, 'jspaz', 'Joan Paz', MD5('jspaz'), 2, 1);

/* **************************** */

/* Informes de encuestas */

	SELECT * FROM ultimas_encuestas_agregadas;
	CALL respuestas_por_departamento();
	SELECT id, nombre FROM encuestas_por_ciudad WHERE municipio = '73001';

/* **************************** */

/* Informes de SMS */

	SELECT count(celular) FROM sms_enviados_por_municipio WHERE municipio = '11001';
	SELECT * FROM sms_enviados;
	SELECT * FROM sms_fallidos;

/* **************************** */

CALL respuestas_por_departamento();

SELECT * FROM respuestas_usuarios;
SELECT * FROM respuestas_por_departamento;
