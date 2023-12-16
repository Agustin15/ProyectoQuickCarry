CREATE DATABASE IF NOT EXISTS php;
USE php;

DROP TABLE IF EXISTS admin,clienteCrecom,funcionarioscrecom,
funcionariosQuickCarry,almacenes,vehiculos,camiones,
camionetas,choferCamion,choferCamioneta,conduce,lotes,paquete,trayecto,visita
,tarea;


CREATE TABLE admin (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  usuario varchar(50) NOT NULL,
  correo varchar(50) NOT NULL,
  contrasenia varchar(50) NOT NULL,
  
  CONSTRAINT checkCorreoAdmin check(correo REGEXP '^[a-zA-Z0-9@.]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE clientecrecom (
  idCliente int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  usuario varchar(50) NOT NULL,
  correo varchar(50) NOT NULL,
  direccion varchar(80) NOT NULL,
  contrasenia varchar(255) NOT NULL,
  
  CONSTRAINT checkCorreoClienteCrecom check(correo REGEXP '^[a-zA-Z0-9@.]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--

CREATE TABLE funcionarioscrecom (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  usuario varchar(50) NOT NULL,
  numFuncio int(11) NOT NULL,
  cedula varchar(8) NOT NULL,
  correo varchar(50) NOT NULL,
  contrasenia varchar(255) NOT NULL,
  
  CONSTRAINT checkNumFuncioCrecom CHECK (numFuncio > 0),
   CONSTRAINT checkCedulaFuncioCrecom CHECK (char_length(cedula)=8 AND cedula REGEXP '^[0-9]+$'),
   CONSTRAINT checkCorreoFuncioCrecom check(correo REGEXP '^[a-zA-Z0-9@.]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE funcionariosquickcarry (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  usuario varchar(50) NOT NULL,
  numFuncio int(11) NOT NULL,
  cedula varchar(8) NOT NULL,
  correo varchar(50) NOT NULL,
  contrasenia varchar(255) NOT NULL,
  
   CONSTRAINT checkNumFuncioQuickCarry CHECK (numFuncio > 0),
   CONSTRAINT checkCedulaFuncioQuickCarry CHECK (char_length(cedula)=8 AND cedula REGEXP '^[0-9]+$'),
   CONSTRAINT checkFuncioQuick check(correo REGEXP '^[a-zA-Z0-9@.]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE almacenes (
  numAlmacen int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  direccion varchar(90) NOT NULL,
  departamento varchar(50) NOT NULL,
  
  CONSTRAINT checkDepartamentoCrecom CHECK(departamento REGEXP '^[A-Za-z " "]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE vehiculos(
  matricula varchar(7) NOT NULL PRIMARY KEY,
  capacidadCarga int(11) NOT NULL,
  
CONSTRAINT checkMatriculaVehiculos CHECK (char_length(matricula) = 7
AND substring(matricula,1,1) REGEXP '^[A-S]$' 
AND substring(matricula,2,1) REGEXP '^[T]$'
AND substring(matricula,3,1) REGEXP '^[PL]$'
AND substring(matricula,4,4) REGEXP '^[0-9]{4}$'),


CONSTRAINT checkCapacidadCarga check (capacidadCarga>0 and capacidadCarga REGEXP '^[0-9]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE  camiones (
  matricula varchar(7) NOT NULL PRIMARY KEY,
  altura double NOT NULL,
  numeroRuedas int(11) NOT NULL,
  peso double NOT NULL,
  
  CONSTRAINT checkPeso check(peso>=10 and peso<=28),
  CONSTRAINT checkNumRuedas CHECK 
  (numeroRuedas%2=0 and numeroRuedas>=6 and numeroRuedas<=12),
  CONSTRAINT checkAltura check (altura>=3.0 and altura<6.0),
  CONSTRAINT checkMatriculaCamion CHECK (char_length(matricula) = 7
AND substring(matricula,1,1) REGEXP '^[A-S]$' 
AND substring(matricula,2,1) REGEXP '^[T]$'
AND substring(matricula,3,1) REGEXP '^[P]$'
AND substring(matricula,4,4) REGEXP '^[0-9]{4}$'),
  
  CONSTRAINT fk_matriculaVehiculoCamiones FOREIGN KEY (matricula) REFERENCES vehiculos (matricula)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE camionetas(
  matricula varchar(7) NOT NULL PRIMARY KEY,
 CONSTRAINT checkMatriculaCamioneta CHECK (char_length(matricula) = 7
  AND substring(matricula,1,1) REGEXP '^[A-S]$'
  AND substring(matricula,2,1) REGEXP '^[T]$'
  AND substring(matricula,3,1) REGEXP '^[L]$'
  AND substring(matricula,4,4) REGEXP '^[0-9]{4}$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE chofercamion (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  usuario varchar(50) NOT NULL,
  numChoferCamion int(11) NOT NULL,
  matriculaCamion VARCHAR(7) NOT NULL,
  cedula varchar(8) NOT NULL,
  correo varchar(50) NOT NULL,
  contrasenia varchar(255) NOT NULL,

  CONSTRAINT checkCedulaChoferCamion CHECK  (char_length(cedula)=8 AND cedula REGEXP '^[0-9]+$'),
  CONSTRAINT checkNumChoferCamion check (numChoferCamion>0),
  CONSTRAINT checkCorreoChoferCamion check(correo REGEXP '^[a-zA-Z0-9@.]+$'),
  CONSTRAINT checkMatriculaCamionChofer CHECK (char_length(matriculaCamion) = 7
  AND substring(matriculaCamion,1,1) REGEXP '^[A-S]$' 
  AND substring(matriculaCamion,2,1) REGEXP '^[T]$'
  AND substring(matriculaCamion,3,1) REGEXP '^[P]$'
  AND substring(matriculaCamion,4,4) REGEXP '^[0-9]{4}$'),
   
  CONSTRAINT fk_matriculaChoferCamion FOREIGN KEY (matriculaCamion) REFERENCES camiones (matricula)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE chofercamioneta (

  id int(11) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  usuario varchar(50) NOT NULL,
  numChoferCamioneta int(11) NOT NULL,
  matriculaCamioneta VARCHAR(7),
  cedula varchar(8) NOT NULL,
  correo varchar(50) NOT NULL,
  contrasenia varchar(255) NOT NULL,
  
  CONSTRAINT checkNumChoferCamioneta CHECK (numChoferCamioneta>0),
   CONSTRAINT checkCedulaChoferCamioneta CHECK  (char_length(cedula)=8 AND cedula REGEXP '^[0-9]+$'),
   CONSTRAINT checkCorreoChoferCamioneta check(correo REGEXP '^[a-zA-Z0-9@.]+$'),
   CONSTRAINT checkMatriculaCamionetaChofer CHECK(char_length(matriculaCamioneta) = 7
   AND substring(matriculaCamioneta,1,1) REGEXP '^[A-S]$' 
   AND substring(matriculaCamioneta,2,1) REGEXP '^[T]$'
   AND substring(matriculaCamioneta,3,1) REGEXP '^[L]$'
   AND substring(matriculaCamioneta,4,4) REGEXP '^[0-9]{4}$'),
   
  CONSTRAINT fk_matriculaCamionetaChofer FOREIGN KEY (matriculaCamioneta) REFERENCES camionetas (matricula)
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE lotes (
  numLote int(11) NOT NULL PRIMARY KEY,
  matriculaCamioneta varchar(7) NOT NULL,
  
   CONSTRAINT checkMatriculaCamionetaLote CHECK (char_length(matriculaCamioneta) = 7
   AND substring(matriculaCamioneta,1,1) REGEXP '^[A-S]$' 
   AND substring(matriculaCamioneta,2,1) REGEXP '^[T]$'
   AND substring(matriculaCamioneta,3,1) REGEXP '^[L]$'
   AND substring(matriculaCamioneta,4,4) REGEXP '^[0-9]{4}$'),
  
  CONSTRAINT fk_matriculaCamionetaLote FOREIGN KEY (matriculaCamioneta) REFERENCES camionetas (matricula)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE paquete (
  idPaquete int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  numLote int(11) ,
  idCliente INT(11) NOT NULL,
  numAlmacen int(11) ,
  matriculaCamion VARCHAR(7) ,
  nombre varchar(50) NOT NULL,
  estado varchar(50) NOT NULL,
  destino varchar(90) NOT NULL,
  fechaEntrega datetime ,
  fechaPedido datetime ,
  codigoRastreo VARCHAR(13),

  CONSTRAINT checkEstado CHECK (estado REGEXP '^[a-zA-Z" "]+$'), 
  CONSTRAINT checkFechaEntrega check  (fechaEntrega REGEXP '^[0-9-:" "]+$'),
  CONSTRAINT checkFechaPedido check  (fechaPedido  REGEXP '^[0-9-:" "]+$'),
  CONSTRAINT check_paqueteCodigo check (char_length(codigoRastreo)=13 AND codigoRastreo REGEXP '^[0-9A-Z]+$'),
  
  CONSTRAINT checkMatriculaCamionPaquete CHECK(char_length(matriculaCamion) = 7
   AND substring(matriculaCamion,1,1) REGEXP '^[A-S]$' 
   AND substring(matriculaCamion,2,1) REGEXP '^[T]$'
   AND substring(matriculaCamion,3,1) REGEXP '^[P]$'
   AND substring(matriculaCamion,4,4) REGEXP '^[0-9]{4}$'),
   
    CONSTRAINT checkNumAlmacenPaquete CHECK(numAlmacen>0),
	CONSTRAINT checkNumLote CHECK(numLote>0),
  
  CONSTRAINT fk_almacenPaquete FOREIGN KEY (numAlmacen) REFERENCES almacenes (numAlmacen),
  CONSTRAINT fk_lotePaquete FOREIGN KEY (numLote) REFERENCES lotes (numLote),
  CONSTRAINT fk_idClientePaquete FOREIGN KEY (idCliente) REFERENCES clienteCrecom (idCliente),
  CONSTRAINT fk_matriculaCamionPaquete FOREIGN KEY (matriculaCamion) REFERENCES
  camiones (matricula)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE trayecto(
   idTrayecto int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
   matriculaCamion varchar(7) NOT NULL,
   numAlmacen int(11) NOT NULL,
   ruta int(11) NOT NULL,
   fechaTrayecto DATETIME NOT NULL,
  
  CONSTRAINT checkMatriculaCamion CHECK (char_length(matriculaCamion) = 7
   AND substring(matriculaCamion,1,1) REGEXP '^[A-S]$' 
   AND substring(matriculaCamion,2,1) REGEXP '^[T]$'
   AND substring(matriculaCamion,3,1) REGEXP '^[P]$'
   AND substring(matriculaCamion,4,4) REGEXP '^[0-9]{4}$'),
   
  CONSTRAINT checkNumAlmacenTrayecto CHECK(numAlmacen>0),
  CONSTRAINT checkFechaTrayecto check  (fechaTrayecto REGEXP '^[0-9-:" "]+$'),
  

  
    CONSTRAINT fk_matriculaCamion FOREIGN KEY (matriculaCamion) REFERENCES camiones (matricula),
     CONSTRAINT fk_almacenTrayecto FOREIGN KEY (numAlmacen) REFERENCES almacenes (numAlmacen)

     
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE visita (
  idVisita int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  matriculaCamionVisita varchar(7) NOT NULL,
  numAlmacen int(11) NOT NULL,
  fechaVisita datetime NOT NULL,

 CONSTRAINT checkMatriculaCamionVisita CHECK (char_length(matriculaCamionVisita) = 7
   AND substring(matriculaCamionVisita,1,1) REGEXP '^[A-S]$' 
   AND substring(matriculaCamionVisita,2,1) REGEXP '^[T]$'
   AND substring(matriculaCamionVisita,3,1) REGEXP '^[P]$'
   AND substring(matriculaCamionVisita,4,4) REGEXP '^[0-9]{4}$'),
   
  CONSTRAINT checkFechaVisita check  (fechaVisita REGEXP '^[0-9-:" "]+$'),
  CONSTRAINT checkNumAlmacenVisita CHECK(numAlmacen>0),

CONSTRAINT fk_visitaCamion FOREIGN KEY (matriculaCamionVisita) REFERENCES camiones (matricula),
CONSTRAINT fk_almacenVisita FOREIGN KEY (numAlmacen) REFERENCES almacenes (numAlmacen)



) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE tarea (
   idTarea int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
   matriculaCamion varchar(7) NOT NULL,
   descripcion varchar(90) NOT NULL,
   fechaInicio datetime NOT NULL,
   fechaFin datetime NOT NULL,
  
 CONSTRAINT checkMatriculaCamionTarea CHECK (char_length(matriculaCamion) = 7
   AND substring(matriculaCamion,1,1) REGEXP '^[A-S]$' 
   AND substring(matriculaCamion,2,1) REGEXP '^[T]$'
   AND substring(matriculaCamion,3,1) REGEXP '^[P]$'
   AND substring(matriculaCamion,4,4) REGEXP '^[0-9]{4}$'),
   
 CONSTRAINT checkFechaInicio check (fechaInicio REGEXP '^[0-9-:" "]+$'),
 CONSTRAINT checkFechaFin check (fechaFin REGEXP '^[0-9-:" "]+$'),
 
 CONSTRAINT fk_matriculaCamionTarea FOREIGN KEY (matriculaCamion) REFERENCES camiones (matricula)

 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


START TRANSACTION;

INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (1, 'Wilson Ferreira Aldunate 340 55000', 'Artigas');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (2, 'Héctor Miranda 278 90000', 'Canelones');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (3, 'Treinta y Tres, 37000 Melo', 'Cerro Largo');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (4, 'Domingo Baqué 465 70000', 'Colonia');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (5, 'Joaquin Suarez 169 97000', 'Durazno');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (6, 'Av. Artigas 1037 94000 ', 'Florida');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (7, 'Dr. Luis Alberto de Herrera 1039 85000', 'Flores');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (8, 'Intendente Lois 30000', 'Lavalleja');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (9, ' Av. Franklin Delano Roosevelt 20000', 'Maldonado');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (10, 'Av. Luis Alberto de Herrera 1290', 'Montevideo');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (11, 'Bulevar General Artigas 770 60000', 'Paysandu');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (12, '25 de Mayo 3242 Fray Bentos', 'Rio negro');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (13, 'Monseñor Jacinto Vera 1169 40000', 'Rivera');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (14, '18 de Julio 1481,Rocha', 'Rocha');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (15, 'Av. Carlos Reyles 1952 50000 ', 'Salto');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (16, '80000 San José de Mayo', 'San Jose');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (17, 'Don Bosco 734 75000', 'Mercedes');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (18, 'Doctor Domingo Catalina 130 45000', 'Tacuarembo');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (19, 'Manuel Lavalleja 1050 33000', 'Treinta y Tres');
INSERT INTO almacenes (numAlmacen,direccion,departamento) VALUES (20,"Bulevar General Artigas 1825,11800 Montevideo","Montevideo");

COMMIT;

ROLLBACK;


START TRANSACTION;


INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("STP9876","50");
INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("FTP3345","60");
INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("MTP1567","40");
INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("RTP5421","54");
INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("QTP7342","46");

INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("STL2256","10");
INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("PTL6270","12");
INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("CTL3281","14");
INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("LTL7742","16");
INSERT INTO vehiculos (matricula,capacidadCarga) VALUES ("ATL4917","20");

COMMIT;

ROLLBACK;



START TRANSACTION;

SELECT @matriculaCamion1:= matricula FROM vehiculos where matricula="STP9876";
SELECT @matriculaCamion2:= matricula FROM vehiculos where matricula="FTP3345";
SELECT @matriculaCamion3:= matricula FROM vehiculos where matricula="MTP1567";
SELECT @matriculaCamion4:= matricula FROM vehiculos where matricula="RTP5421";
SELECT @matriculaCamion5:= matricula FROM vehiculos where matricula="QTP7342";

INSERT INTO camiones (matricula,altura,numeroRuedas,peso) VALUES (@matriculaCamion1,"4","8","15");
INSERT INTO camiones (matricula,altura,numeroRuedas,peso) VALUES (@matriculaCamion2,"5","10","17");
INSERT INTO camiones (matricula,altura,numeroRuedas,peso) VALUES (@matriculaCamion3,"3","6","13");
INSERT INTO camiones (matricula,altura,numeroRuedas,peso) VALUES (@matriculaCamion4,"4","8","16");
INSERT INTO camiones (matricula,altura,numeroRuedas,peso) VALUES (@matriculaCamion5,"4","10","16");

COMMIT;
ROLLBACK;



START TRANSACTION;

SELECT @matriculaCamioneta1:= matricula FROM vehiculos where matricula="STL2256";
SELECT @matriculaCamioneta2:= matricula FROM vehiculos where matricula="PTL6270";
SELECT @matriculaCamioneta3:= matricula FROM vehiculos where matricula="CTL3281";
SELECT @matriculaCamioneta4:= matricula FROM vehiculos where matricula="LTL7742";
SELECT @matriculaCamioneta5:= matricula FROM vehiculos where matricula="ATL4917";

INSERT INTO camionetas (matricula) VALUES (@matriculaCamioneta1);
INSERT INTO camionetas (matricula) VALUES (@matriculaCamioneta2);
INSERT INTO camionetas (matricula) VALUES (@matriculaCamioneta3);
INSERT INTO camionetas (matricula) VALUES (@matriculaCamioneta4);
INSERT INTO camionetas (matricula) VALUES (@matriculaCamioneta5);

COMMIT;
ROLLBACK;  


START TRANSACTION;

INSERT INTO admin (id,nombre,apellido,usuario,correo,contrasenia) VALUES ("1","Agustin","Miranda","agustinMiranda","agus@gmail.com","54169129");
INSERT INTO admin (id,nombre,apellido,usuario,correo,contrasenia) VALUES ("2","Sebastian","Cancela","sebastianCancela","seba@gmail.com","53602699");
INSERT INTO admin (id,nombre,apellido,usuario,correo,contrasenia) VALUES ("3","Juan Manuel","Pereyra","juanPereyra","juanma@gmail.com","56121553");
INSERT INTO admin (id,nombre,apellido,usuario,correo,contrasenia) VALUES ("4","Agustina","Franco","agustinaFranco","agusFran@gmail.com","55741174");

COMMIT;
ROLLBACK;




