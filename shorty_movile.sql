SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `shorty_movile` ;
CREATE SCHEMA IF NOT EXISTS `shorty_movile` DEFAULT CHARACTER SET utf8 ;
USE `shorty_movile` ;

-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_departamentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_departamentos` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_departamentos` (
  `id` CHAR(2) NOT NULL,
  `nombre_departamento` VARCHAR(100) NOT NULL,
  `latitud` DOUBLE NOT NULL,
  `longitud` DOUBLE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_encuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_encuestas` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_encuestas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_usuarios` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(50) NOT NULL,
  `nombre` VARCHAR(110) NOT NULL,
  `pass` TEXT NOT NULL,
  `nivel` INT(11) NOT NULL,
  `stat` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_mensajes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_mensajes` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_mensajes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `remitente` INT(11) NOT NULL,
  `destinatario` INT(11) NOT NULL,
  `mensaje` TEXT NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `usuario_remitente`
    FOREIGN KEY (`remitente`)
    REFERENCES `shorty_movile`.`movile_usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usuario_destinatario`
    FOREIGN KEY (`destinatario`)
    REFERENCES `shorty_movile`.`movile_usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `usuario_remitente_idx` ON `shorty_movile`.`movile_mensajes` (`remitente` ASC);

CREATE INDEX `usuario_destinatario_idx` ON `shorty_movile`.`movile_mensajes` (`destinatario` ASC);


-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_menu` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_menu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(160) NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  `nivel` VARCHAR(30) NOT NULL,
  `parent` INT(11) NULL,
  `icon` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_parent`
    FOREIGN KEY (`parent`)
    REFERENCES `shorty_movile`.`movile_menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_parent_idx` ON `shorty_movile`.`movile_menu` (`parent` ASC);


-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_municipios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_municipios` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_municipios` (
  `id` CHAR(5) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `departamento` CHAR(2) NOT NULL,
  `latitud` DOUBLE NOT NULL,
  `longitud` DOUBLE NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `dpto_municipio`
    FOREIGN KEY (`departamento`)
    REFERENCES `shorty_movile`.`movile_departamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `dpto_municipio_idx` ON `shorty_movile`.`movile_municipios` (`departamento` ASC);


-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_preguntas` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_preguntas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_encuesta` INT(11) NOT NULL,
  `texto` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_movile_preguntas_movile_encuestas1`
    FOREIGN KEY (`id_encuesta`)
    REFERENCES `shorty_movile`.`movile_encuestas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_movile_preguntas_movile_encuestas1_idx` ON `shorty_movile`.`movile_preguntas` (`id_encuesta` ASC);


-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_respuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_respuestas` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_respuestas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pregunta` INT(11) NOT NULL,
  `texto` VARCHAR(50) NOT NULL,
  `numeral` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_movile_respuestas_movile_preguntas`
    FOREIGN KEY (`id_pregunta`)
    REFERENCES `shorty_movile`.`movile_preguntas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_movile_respuestas_movile_preguntas_idx` ON `shorty_movile`.`movile_respuestas` (`id_pregunta` ASC);


-- -----------------------------------------------------
-- Table `shorty_movile`.`movile_celulares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`movile_celulares` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`movile_celulares` (
  `celular` CHAR(10) NOT NULL,
  `municipio` CHAR(5) NOT NULL,
  PRIMARY KEY (`celular`),
  CONSTRAINT `fk_movile_celulares_movile_municipios1`
    FOREIGN KEY (`municipio`)
    REFERENCES `shorty_movile`.`movile_municipios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_movile_celulares_movile_municipios1_idx` ON `shorty_movile`.`movile_celulares` (`municipio` ASC);


-- -----------------------------------------------------
-- Table `shorty_movile`.`respuestas_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`respuestas_usuarios` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`respuestas_usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `celular` CHAR(10) NOT NULL,
  `id_encuesta` INT(11) NOT NULL,
  `id_pregunta` INT(11) NOT NULL,
  `id_respuesta` INT(11) NULL DEFAULT NULL,
  `fecha` TIMESTAMP NOT NULL,
  `estado` INT(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_respuestas_usuarios_movile_encuestas1`
    FOREIGN KEY (`id_encuesta`)
    REFERENCES `shorty_movile`.`movile_encuestas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_respuestas_usuarios_movile_preguntas1`
    FOREIGN KEY (`id_pregunta`)
    REFERENCES `shorty_movile`.`movile_preguntas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_respuestas_usuarios_movile_respuestas1`
    FOREIGN KEY (`id_respuesta`)
    REFERENCES `shorty_movile`.`movile_respuestas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_respuestas_usuarios_movile_celulares1`
    FOREIGN KEY (`celular`)
    REFERENCES `shorty_movile`.`movile_celulares` (`celular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_respuestas_usuarios_movile_encuestas1_idx` ON `shorty_movile`.`respuestas_usuarios` (`id_encuesta` ASC);

CREATE INDEX `fk_respuestas_usuarios_movile_preguntas1_idx` ON `shorty_movile`.`respuestas_usuarios` (`id_pregunta` ASC);

CREATE INDEX `fk_respuestas_usuarios_movile_respuestas1_idx` ON `shorty_movile`.`respuestas_usuarios` (`id_respuesta` ASC);

CREATE INDEX `fk_respuestas_usuarios_movile_celulares1_idx` ON `shorty_movile`.`respuestas_usuarios` (`celular` ASC);


-- -----------------------------------------------------
-- Table `shorty_movile`.`sms_fallidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`sms_fallidos` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`sms_fallidos` (
  `id` INT(11) NOT NULL,
  `celular` CHAR(10) NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_sms_fallidos_movile_celulares1`
    FOREIGN KEY (`celular`)
    REFERENCES `shorty_movile`.`movile_celulares` (`celular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_sms_fallidos_movile_celulares1_idx` ON `shorty_movile`.`sms_fallidos` (`celular` ASC);


-- -----------------------------------------------------
-- Table `shorty_movile`.`sms_enviados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `shorty_movile`.`sms_enviados` ;

CREATE TABLE IF NOT EXISTS `shorty_movile`.`sms_enviados` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `celular` CHAR(10) NOT NULL,
  `mensaje` TEXT NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_sms_enviados_movile_celulares1`
    FOREIGN KEY (`celular`)
    REFERENCES `shorty_movile`.`movile_celulares` (`celular`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_sms_enviados_movile_celulares1_idx` ON `shorty_movile`.`sms_enviados` (`celular` ASC);

USE `shorty_movile` ;

-- -----------------------------------------------------
-- Placeholder table for view `shorty_movile`.`encuestas_por_ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shorty_movile`.`encuestas_por_ciudad` (`id` INT, `nombre` INT, `municipio` INT);

-- -----------------------------------------------------
-- Placeholder table for view `shorty_movile`.`ultimas_encuestas_agregadas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shorty_movile`.`ultimas_encuestas_agregadas` (`id` INT, `nombre` INT);

-- -----------------------------------------------------
-- Placeholder table for view `shorty_movile`.`sms_enviados_por_municipio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shorty_movile`.`sms_enviados_por_municipio` (`celular` INT, `municipio` INT);

-- -----------------------------------------------------
-- Placeholder table for view `shorty_movile`.`respuestas_por_departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shorty_movile`.`respuestas_por_departamento` (`id` INT, `cuenta` INT);

-- -----------------------------------------------------
-- procedure agregar_siguiente_pregunta
-- -----------------------------------------------------

USE `shorty_movile`;
DROP procedure IF EXISTS `shorty_movile`.`agregar_siguiente_pregunta`;

DELIMITER $$
USE `shorty_movile`$$
CREATE PROCEDURE `agregar_siguiente_pregunta`(IN `i_celular` VARCHAR(40), OUT `resultado` INT(11))
    MODIFIES SQL DATA
BEGIN
	
	DECLARE i_pregunta INT(11);
	DECLARE i_encuesta INT(11);
	DECLARE i_n_pregunta INT(11);

	CREATE TEMPORARY TABLE temp_res AS(
        SELECT id_pregunta, id_encuesta
        FROM respuestas_usuarios
        WHERE estado = 2
            AND celular = i_celular
        ORDER BY id DESC LIMIT 1
	);

	SET i_pregunta = (SELECT id_pregunta FROM temp_res LIMIT 1);
	SET i_encuesta = (SELECT id_encuesta FROM temp_res LIMIT 1);

	DROP TABLE temp_res;

	SET i_n_pregunta = (
        SELECT id FROM movile_preguntas
		WHERE id > i_pregunta
			AND id_encuesta = i_encuesta
		LIMIT 1
	);

	INSERT INTO respuestas_usuarios
		(celular, id_encuesta, id_pregunta, fecha, estado)
	VALUES
		(i_celular, i_encuesta, i_n_pregunta, CURRENT_TIMESTAMP, 1);

	SELECT ROW_COUNT() INTO resultado;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure hay_siguiente_pregunta
-- -----------------------------------------------------

USE `shorty_movile`;
DROP procedure IF EXISTS `shorty_movile`.`hay_siguiente_pregunta`;

DELIMITER $$
USE `shorty_movile`$$
CREATE PROCEDURE `hay_siguiente_pregunta`(IN `i_celular` VARCHAR(40), OUT `resultado` INT(11))
    READS SQL DATA
BEGIN

	DECLARE i_pregunta INT(11);
	DECLARE i_encuesta INT(11);
	DECLARE i_n_pregunta INT(11);

	CREATE TEMPORARY TABLE temp_res AS(
        SELECT id_pregunta, id_encuesta
        FROM respuestas_usuarios
        WHERE estado = 2
            AND celular = i_celular
        ORDER BY id DESC LIMIT 1
	);

	SET i_pregunta = (SELECT id_pregunta FROM temp_res LIMIT 1);
	SET i_encuesta = (SELECT id_encuesta FROM temp_res LIMIT 1);

	DROP TABLE temp_res;

	SET i_n_pregunta = (
        SELECT COUNT(id) FROM movile_preguntas
		WHERE id > i_pregunta
			AND id_encuesta = i_encuesta
		LIMIT 1
	);

	SELECT i_n_pregunta INTO resultado;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure iniciar_encuesta
-- -----------------------------------------------------

USE `shorty_movile`;
DROP procedure IF EXISTS `shorty_movile`.`iniciar_encuesta`;

DELIMITER $$
USE `shorty_movile`$$
CREATE PROCEDURE `iniciar_encuesta`(IN `i_celular` VARCHAR(40), IN `i_encuesta` INT(11), OUT `resultado` INT(11))
    MODIFIES SQL DATA
BEGIN

INSERT INTO respuestas_usuarios (celular, id_encuesta, id_pregunta, fecha, estado) VALUES
	(i_celular, i_encuesta, (SELECT id FROM movile_preguntas WHERE id_encuesta = i_encuesta LIMIT 1), 
	CURRENT_TIMESTAMP, 1
   );

SELECT ROW_COUNT() INTO resultado;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure invalidar_preguntas_previas_abiertas
-- -----------------------------------------------------

USE `shorty_movile`;
DROP procedure IF EXISTS `shorty_movile`.`invalidar_preguntas_previas_abiertas`;

DELIMITER $$
USE `shorty_movile`$$
CREATE PROCEDURE `invalidar_preguntas_previas_abiertas`(IN `i_celular` VARCHAR(40), OUT `resultados` INT(11))
    MODIFIES SQL DATA
BEGIN

DECLARE i_id INT(11);

SET i_id = (SELECT id FROM respuestas_usuarios 
WHERE celular = '3014599967'
ORDER BY id DESC LIMIT 1);

UPDATE respuestas_usuarios
SET estado = 3
WHERE celular = i_celular AND estado = 1 AND id <= i_id;

SELECT ROW_COUNT() INTO resultados;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure responder_pregunta
-- -----------------------------------------------------

USE `shorty_movile`;
DROP procedure IF EXISTS `shorty_movile`.`responder_pregunta`;

DELIMITER $$
USE `shorty_movile`$$
CREATE PROCEDURE `responder_pregunta`(IN `i_celular` VARCHAR(40), IN `i_numeral` INT(11), OUT `resultado` INT(11))
    MODIFIES SQL DATA
BEGIN

	DECLARE i_pregunta INT(11);
	DECLARE i_respuesta INT(11);
	DECLARE i_n_respuesta INT(11);

	CREATE TEMPORARY TABLE temp_res AS (
		SELECT id, id_pregunta
		FROM respuestas_usuarios
		WHERE celular = i_celular
			AND id_respuesta IS NULL
			AND estado = 1
		ORDER BY id DESC LIMIT 1
	);

	SET i_pregunta = (SELECT id_pregunta FROM temp_res LIMIT 1);
	SET i_respuesta = (SELECT id FROM temp_res LIMIT 1);

	DROP TABLE temp_res;

	SET i_n_respuesta = (SELECT COUNT(id) FROM movile_respuestas
	WHERE id_pregunta = i_pregunta
		AND numeral = i_numeral LIMIT 1);

	IF i_n_respuesta = 1 THEN

		UPDATE respuestas_usuarios
		SET id_respuesta = (SELECT id FROM movile_respuestas
							WHERE id_pregunta = i_pregunta
							AND numeral = i_numeral LIMIT 1),
			estado = 2
		WHERE id = i_respuesta;

	END IF;

	SELECT ROW_COUNT() INTO resultado;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure siguiente_pregunta
-- -----------------------------------------------------

USE `shorty_movile`;
DROP procedure IF EXISTS `shorty_movile`.`siguiente_pregunta`;

DELIMITER $$
USE `shorty_movile`$$
CREATE PROCEDURE `siguiente_pregunta`(IN `i_celular` VARCHAR(40), OUT `resultado` INT(11))
    READS SQL DATA
BEGIN

	DECLARE i_pregunta INT(11);
	DECLARE i_encuesta INT(11);
	DECLARE i_n_pregunta INT(11);

	CREATE TEMPORARY TABLE temp_res AS(
        SELECT id_pregunta, id_encuesta
        FROM respuestas_usuarios
        WHERE estado = 2
            AND celular = i_celular
        ORDER BY id DESC LIMIT 1
	);

	SET i_pregunta = (SELECT id_pregunta FROM temp_res LIMIT 1);
	SET i_encuesta = (SELECT id_encuesta FROM temp_res LIMIT 1);

	DROP TABLE temp_res;

	SET i_n_pregunta = (
        SELECT id FROM movile_preguntas
		WHERE id > i_pregunta
			AND id_encuesta = i_encuesta
		LIMIT 1
	);

	SELECT i_n_pregunta INTO resultado;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure respuestas_por_departamento
-- -----------------------------------------------------

USE `shorty_movile`;
DROP procedure IF EXISTS `shorty_movile`.`respuestas_por_departamento`;

DELIMITER $$
USE `shorty_movile`$$
CREATE PROCEDURE `respuestas_por_departamento` ()
BEGIN

	DECLARE i_departamento CHAR(2);
	DECLARE finished INT;
	
	DECLARE cDepartamentos CURSOR FOR
	(SELECT id FROM movile_departamentos);
	DECLARE CONTINUE HANDLER
	FOR NOT FOUND SET finished = 1;

	CREATE TEMPORARY TABLE my_table
		( departamento CHAR(2),
		   respuestas DOUBLE
		);

	OPEN cDepartamentos;

	REPEAT
		FETCH cDepartamentos INTO i_departamento;
		
		IF (SELECT COUNT(id) FROM respuestas_por_departamento WHERE depto = i_departamento) > 0 THEN
			INSERT INTO my_table 
			VALUES (i_departamento, 
					ROUND(100 * (SELECT COUNT(id)
					FROM respuestas_por_departamento 
					WHERE depto = i_departamento)
					/(SELECT COUNT(id)
					FROM respuestas_usuarios
					WHERE estado = 2), 2)
					);
		END IF;
		
	UNTIL finished END REPEAT;

	CLOSE cDepartamentos;

	SELECT * FROM my_table ORDER BY respuestas DESC;

	DROP TABLE my_table;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure insertar_celular
-- -----------------------------------------------------

USE `shorty_movile`;
DROP procedure IF EXISTS `shorty_movile`.`insertar_celular`;

DELIMITER $$
USE `shorty_movile`$$
CREATE PROCEDURE `insertar_celular`(IN i_celular CHAR(10), IN i_ciudad CHAR(5))
BEGIN

	IF((SELECT COUNT(celular) FROM movile_celulares WHERE celular = i_celular) >  0) THEN
		UPDATE movile_celulares
		SET ciudad = i_ciudad
		WHERE celular = i_celular;
	ELSE
		INSERT INTO movile_celulares VALUES (i_celular, i_ciudad);
	END IF;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- View `shorty_movile`.`encuestas_por_ciudad`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `shorty_movile`.`encuestas_por_ciudad` ;
DROP TABLE IF EXISTS `shorty_movile`.`encuestas_por_ciudad`;
USE `shorty_movile`;
CREATE  OR REPLACE VIEW `encuestas_por_ciudad` AS
SELECT e.id, e.nombre, m.id as municipio
FROM movile_encuestas e, respuestas_usuarios r, movile_municipios m
WHERE e.id = r.id_encuesta AND r.celular IN (
	SELECT celular 
	FROM movile_celulares c, movile_municipios m
	WHERE c.municipio = m.id
);

-- -----------------------------------------------------
-- View `shorty_movile`.`ultimas_encuestas_agregadas`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `shorty_movile`.`ultimas_encuestas_agregadas` ;
DROP TABLE IF EXISTS `shorty_movile`.`ultimas_encuestas_agregadas`;
USE `shorty_movile`;
CREATE  OR REPLACE VIEW `ultimas_encuestas_agregadas` AS
SELECT *
FROM movile_encuestas
ORDER BY id DESC;

-- -----------------------------------------------------
-- View `shorty_movile`.`sms_enviados_por_municipio`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `shorty_movile`.`sms_enviados_por_municipio` ;
DROP TABLE IF EXISTS `shorty_movile`.`sms_enviados_por_municipio`;
USE `shorty_movile`;
CREATE  OR REPLACE VIEW `sms_enviados_por_municipio` AS
SELECT r.celular, 
	m.id as municipio 
FROM respuestas_usuarios r, 
	movile_celulares c, 
	movile_municipios m
WHERE r.celular = c.celular 
	AND c.municipio = m.id;

-- -----------------------------------------------------
-- View `shorty_movile`.`respuestas_por_departamento`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `shorty_movile`.`respuestas_por_departamento` ;
DROP TABLE IF EXISTS `shorty_movile`.`respuestas_por_departamento`;
USE `shorty_movile`;
CREATE  OR REPLACE VIEW `respuestas_por_departamento` AS
SELECT d.id, (SELECT count(r.id)
		FROM respuestas_usuarios r,  
			movile_celulares c, 
			movile_municipios m, 
			movile_departamentos d
		WHERE r.celular = c.celular 
			AND c.municipio = m.id 
			AND m.departamento = d.id 
			AND r.estado = 2) 
		AS cuenta
FROM movile_departamentos d;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
