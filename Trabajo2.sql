CREATE DATABASE SENATIDB;
USE SENATIDB;

CREATE TABLE marcas
(
	idmarca		INT AUTO_INCREMENT PRIMARY KEY,
    marca		VARCHAR(30)		NOT NULL,
    creat_at	DATETIME		NOT NULL DEFAULT NOW(),
    inactive_at DATETIME		NULL,
    update_at	DATETIME		NULL,
    CONSTRAINT uk_marca_mar UNIQUE(marca)
)
ENGINE = INNODB;

INSERT INTO marcas (marca)
	VALUES
		('Toyota'),
        ('Nissan'),
        ('Volvo'),
        ('Hyundai'),
        ('KIA');
        
CREATE TABLE vehiculos
(
	idvehiculo		INT AUTO_INCREMENT PRIMARY KEY,
    idmarca			INT 		NOT NULL,
    modelo			VARCHAR(50)	NOT NULL,
    color			VARCHAR(30) NOT NULL,
    tipocombustible	CHAR(3)		NOT NULL,
    peso			SMALLINT    NOT NULL,
    afabricacion	CHAR(4)		NOT NULL,
    placa			CHAR(7)		NOT NULL,
	creat_at		DATETIME	NOT NULL DEFAULT NOW(),
    inactive_at 	DATETIME	NULL,
    update_at		DATETIME	NULL,
    CONSTRAINT fk_idmarca_veh FOREIGN KEY(idmarca) REFERENCES marcas (idmarca),
    CONSTRAINT ck_tipocombustible CHECK (tipocombustible IN ('GSL', 'DSL', 'GNV', 'GLP')),
    CONSTRAINT ck_peso_vech CHECK (peso>0),
    CONSTRAINT uk_placa_veh UNIQUE(placa)
)
ENGINE=INNODB;




INSERT INTO vehiculos
	(idmarca, modelo, color, tipocombustible, peso, afabricacion, placa)
    VALUES
		(1, 'Hilux', 'blanco', 'DSL', 1080, '2020', 'ABC-111'),
        (2, 'Sentra', 'gris', 'GSL', 1200, '2021', 'ABC-112'),
        (3, 'EX30', 'negro', 'GNV', 1350, '2023', 'ABC-113'),
        (4, 'Tucson', 'rojo', 'GLP', 1800, '2022','ABC-114'),
        (5, 'Sportage', 'azul', 'DSL', 1500, '2010', 'ABC-115');

CREATE TABLE sedes
(
	idsede			INT AUTO_INCREMENT PRIMARY KEY,
    sede			VARCHAR(30) NOT NULL,
	create_at		DATETIME	NOT NULL DEFAULT NOW(),
    inactive_at 	DATETIME	NULL,
    update_at		DATETIME	NULL,	
    CONSTRAINT uk_sede 		UNIQUE(sede)
)
ENGINE=INNODB;

INSERT INTO sedes (sede) VALUES
('LIMA'),
('PISCO'),
('AYACUCHO');




CREATE TABLE empleados
(
	idempleado		INT AUTO_INCREMENT PRIMARY KEY,
    idsede			INT 		NOT NULL,
    apellidos   	VARCHAR(60) NOT NULL,
    nombres			VARCHAR(60) NOT NULL,
    nrodocumento	CHAR(8)		NOT NULL, 
    fechanac		DATE        NOT NULL,
    telefono		CHAR(9)     NOT NULL,
	create_at		DATETIME	NOT NULL DEFAULT NOW(),
    inactive_at 	DATETIME	NULL,
    update_at		DATETIME	NULL,
	CONSTRAINT fk_sede_empleado FOREIGN KEY (idsede) REFERENCES sedes(idsede),
    CONSTRAINT uk_nrodoc		UNIQUE (nrodocumento),

    CONSTRAINT uk_telefono      UNIQUE(telefono)
)

	SELECT DISTINCT SED.sede, COUNT(EMP.idsede) TOTAL FROM empleados EMP
	INNER JOIN sedes SED ON SED.idsede=EMP.idsede
	GROUP BY SED.sede;

DELIMITER $$
CREATE PROCEDURE spu_empleado_graficar()
BEGIN
	SELECT DISTINCT SED.sede, COUNT(EMP.idsede) TOTAL FROM empleados EMP
	INNER JOIN sedes SED ON SED.idsede=EMP.idsede
	GROUP BY SED.sede;
END $$

CALL spu_empleado_graficar;

DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT
		idsede,
        sede
        FROM sedes
        WHERE inactive_at IS NULL
        ORDER BY sede;
END $$

CALL spu_sedes_listar;

DELIMITER $$
CREATE PROCEDURE spu_listar_empleado()
BEGIN
	SELECT 
    SED.sede,
    EMP.apellidos,
    EMP.nombres,
    EMP.nrodocumento,
    EMP.fechanac,
    EMP.telefono
     FROM empleados EMP
     INNER JOIN sedes SED ON SED.idsede = EMP.idsede
     WHERE EMP.inactive_at IS NULL	
     ORDER BY EMP.apellidos;
END $$

CALL spu_listar_empleado;

DELIMITER $$
CREATE PROCEDURE spu_buscar_nrodocumento(IN _nrodocumento CHAR(8))
BEGIN
	SELECT
		SED.sede,
		EMP.apellidos,
		EMP.nombres
        FROM empleados EMP 
        INNER JOIN sedes SED ON SED.idsede = EMP.idsede
		WHERE (EMP.inactive_at IS NULL) AND
			  (EMP.nrodocumento = _nrodocumento);
END $$


CALL spu_buscar_nrodocumento ('89904567');


DELIMITER $$
CREATE PROCEDURE spu_registrar_empleado
(
 IN _idsede INT,
 IN _apellidos VARCHAR(60),
 IN _nombres VARCHAR(60),
 IN _nrodocumento CHAR(8),
 IN _fechanac DATE,
 IN _telefono CHAR(9))
BEGIN
	INSERT INTO empleados (idsede, apellidos, nombres, nrodocumento, fechanac, telefono) VALUES
    (_idsede, _apellidos, _nombres, _nrodocumento, _fechanac, _telefono);

    SELECT  @@last_insert_id 'idempleado';
END $$

CALL spu_registrar_empleado (2, 'Diaz Rosales', 'Roberto Juan', '89904567', '2000-02-12', '956789345');

DELIMITER $$
CREATE PROCEDURE spu_vehiculos_buscar(IN _placa CHAR(7))
BEGIN
	SELECT
		VEH.idvehiculo,
        MAR.marca,
        VEH.modelo,
        VEH.color,
        VEH.tipocombustible,
        VEH.peso,
        VEH.afabricacion,
        VEH.placa
        FROM vehiculos VEH
		INNER JOIN marcas MAR ON MAR.idmarca = VEH.idmarca
        WHERE (VEH.inactive_at IS NULL)		AND
			  (VEH.placa = _placa);
END $$

CALL spu_vehiculos_buscar('ABC-222');


DELIMITER $$
CREATE PROCEDURE spu_vehiculos_registrar
(
IN _idmarca 		INT,
IN _modelo 			VARCHAR(50), 
IN _color 			VARCHAR(30), 
IN _tipocombustible CHAR(3),
IN _peso 			SMALLINT,
IN _afabricacion 	CHAR(4),
IN _placa 			CHAR(7))
BEGIN
	INSERT INTO vehiculos (idmarca, modelo, color, tipocombustible, peso, afabricacion, placa) VALUES
    (_idmarca, _modelo, _color, _tipocombustible, _peso, _afabricacion, _placa);
    
    SELECT  @@last_insert_id 'idvehiculo';
END $$

SELECT * FROM vehiculos;

CALL spu_vehiculos_registrar (1, 'X34S', 'negro', 'GSL', 1800, 2005, 'ABC-123');
CALL spu_vehiculos_registrar (2, 'Creta', 'rojo', 'GNV', 2000, 1999, 'ABC-124');

DELIMITER $$
CREATE PROCEDURE spu_marcas_listar()
BEGIN	
	SELECT 
		idmarca,
        marca
        FROM marcas
        WHERE inactive_at IS NULL
        ORDER BY marca;
END $$

CALL spu_marcas_listar;
