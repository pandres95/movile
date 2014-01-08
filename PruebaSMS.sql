/* Inserción de datos de prueba */
SELECT * FROM movile_encuestas;
INSERT INTO movile_encuestas (nombre) VALUES ('Encuesta de satisfaccion de MySQL');
SELECT * FROM movile_preguntas;
INSERT INTO movile_preguntas (id_encuesta, texto) VALUES (1, 'Como se siente usando MySQL Workbench?');
INSERT INTO movile_preguntas (id_encuesta, texto) VALUES (1, 'Que piensa del uso de MySQL Workbench?');
SELECT * FROM movile_respuestas;

INSERT INTO movile_respuestas (id_pregunta, texto, numeral) VALUES (1, 'Excelente', 1);
INSERT INTO movile_respuestas (id_pregunta, texto, numeral) VALUES (1, 'Regular', 2);
INSERT INTO movile_respuestas (id_pregunta, texto, numeral) VALUES (1, 'Mal', 3);

INSERT INTO movile_respuestas (id_pregunta, texto, numeral) VALUES (2, 'Esta bien', 1);
INSERT INTO movile_respuestas (id_pregunta, texto, numeral) VALUES (2, 'Le faltan detalles', 2);
/* **************************** */

INSERT INTO movile_celulares VALUES ('3014599967', '73001');
INSERT INTO movile_celulares VALUES ('3007261215', '11001');

/* Inicia una encuesta con el número asignado */
CALL iniciar_encuesta('3014599967', 1, @res);
CALL iniciar_encuesta('3007261215', 1, @res);
SELECT @res AS r;

/* Responde una pregunta con el numeral dado */
CALL responder_pregunta('3014599967', 2, @res);
SELECT @res as r;

/* Pregunta si hay más preguntas para responder en la encuesta activa del usuario */
CALL hay_siguiente_pregunta('3014599967', @res);
SELECT @res as r;

/* Agrega la siguiente pregunta al usuario */
CALL agregar_siguiente_pregunta('3014599967', res);
SELECT @res AS r;

/* Invalida las preguntas que fueron abiertas previamente y no resueltas */
CALL invalidar_preguntas_previas_abiertas('3007261215', @res);
CALL invalidar_preguntas_previas_abiertas('3014599967', @res);
SELECT @res AS r;

/* Consulta de tabla de respuestas */
SELECT * FROM respuestas_usuarios;

/* Borrado de tabla de respuestas */
TRUNCATE respuestas_usuarios;

SELECT * FROM movile_menu;
SELECT * FROM movile_usuarios;

SELECT count(id) AS cuenta FROM respuestas_usuarios LIMIT 1;
SELECT * FROM sms_fallidos;
INSERT INTO sms_fallidos(celular, fecha) VALUES ('3014599967', CURRENT_TIMESTAMP);

SELECT (SELECT COUNT(id) AS cuenta FROM respuestas_usuarios LIMIT 1) + (SELECT COUNT(id) AS cuenta FROM sms_fallidos LIMIT 1) AS cuenta;

INSERT INTO movile_usuarios VALUES (NULL, 'johasalinasq', 'Johana Salinas Q.', MD5('joahasalinasq'), 2, 1);

TRUNCATE movile_menu;

INSERT INTO movile_menu VALUES(NULL, 'Escritorio', '', '1,2');
INSERT INTO movile_menu VALUES(NULL, 'Envio de SMS', 'enviosms', '1,2');
INSERT INTO movile_menu VALUES(NULL, 'Encuestas', 'enviosms/encuestas', '2');

LOAD DATA LOCAL INFILE 'C:\\Users\\GOLDEN\\Downloads\\idepartamentos.csv' INTO TABLE movile_departamentos FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE 'C:\\Users\\GOLDEN\\Desktop\\departamentoscolombia.csv' INTO TABLE movile_departamentos FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE 'C:\\Users\\GOLDEN\\Downloads\\imunicipios.csv' INTO TABLE movile_municipios FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE 'C:\\Users\\GOLDEN\\Desktop\\municipioscolombia.csv' INTO TABLE movile_municipios FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n';

SELECT * FROM movile_departamentos;
SELECT * FROM movile_municipios LIMIT 1102;

DELETE FROM movile_departamentos;
DELETE FROM movile_municipios;

CREATE VIEW `encuestas_por_ciudad` AS
SELECT e.id, e.nombre, m.id as municipio
FROM movile_encuestas e, respuestas_usuarios r, movile_municipios m
WHERE e.id = r.id_encuesta AND r.celular IN (
	SELECT celular 
	FROM movile_celulares c, movile_municipios m
	WHERE c.municipio = m.id
);

CREATE VIEW `ultimas_encuestas_agregadas` AS
SELECT *
FROM movile_encuestas
ORDER BY id DESC;

SELECT id, nombre FROM encuestas_por_ciudad WHERE municipio = '73001';
SELECT * FROM ultimas_encuestas_agregadas;

DROP VIEW sms_enviados_por_municipio;

SELECT count(id) FROM sms_enviados_por_municipio WHERE municipio = '11001';