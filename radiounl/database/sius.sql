SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/****** 1  C O N T R I B U I D O R *******/
DROP TABLE IF EXISTS `contribuidor`;
CREATE TABLE IF NOT EXISTS `contribuidor` (
  IDCONTRIBUIDOR int(11) NOT NULL AUTO_INCREMENT, 
  NOMBRE         varchar(255), 
  APELLIDO       varchar(255), 
  CORREO         varchar(255), 
  TELEFONO       varchar(255), 
  FECHA_REGISTRO date,
  PRIMARY KEY (IDCONTRIBUIDOR)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/******* 2  E S P E C I A L I D A D *******/
DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE IF NOT EXISTS `especialidad` (
  area_especialidadIDAREA_ESPECIALIDAD int(10), 
  IDESPECIALIDAD                       int(10) NOT NULL AUTO_INCREMENT, 
  NOMBRE                               varchar(255), 
  DISPONIBILIDA                        int(1), 
  TELEFONO                             varchar(255), 
  NOMBREPRO_FESIONAL_RESPONSABLE       varchar(255), 
  HORARIO_ATENCION                     varchar(255), 
  DIAS_ATENCION                        varchar(255), 
  PRIMARY KEY (IDESPECIALIDAD)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/******* 3  A R E A S    E S P E C I A L I D A D *******/
DROP TABLE IF EXISTS `AREA_ESPECIALIDAD`;
CREATE TABLE IF NOT EXISTS `AREA_ESPECIALIDAD` (
  unidad_SaludIDUNIDADSALUD int(10) NOT NULL, 
  unidad_SaludUNICODIGO     int(10) NOT NULL, 
  IDAREA_ESPECIALIDAD       int(10) NOT NULL AUTO_INCREMENT, 
  NOMBRE                    varchar(255), 
  PRIMARY KEY (IDAREA_ESPECIALIDAD)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/******* 4  H O R A R I O S   T R A B A J O *******/
DROP TABLE IF EXISTS `horarios_trabajo`;
CREATE TABLE IF NOT EXISTS `horarios_trabajo` (
  unidad_SaludIDUNIDADSALUD  int(10), 
  unidad_SaludUNICODIGO      int(10), 
  especialidadIDESPECIALIDAD int(10),
  IDHORARIOS_TRABAJO         int(11) NOT NULL AUTO_INCREMENT, 
  NOMBRE_MEDICO              varchar(255), 
  DIAS_ATENCION              varchar(255), 
  HORAS_ATENCION             varchar(255), 
  PRIMARY KEY (IDHORARIOS_TRABAJO)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/******* 5  S E R V I C I O S *******/
DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  unidad_SaludIDUNIDADSALUD  int(10), 
  unidad_SaludUNICODIGO      int(10), 
  contribuidorIDCONTRIBUIDOR int(11) NOT NULL, 
  IDSERVICIO                 int(10) NOT NULL AUTO_INCREMENT, 
  DESCRIPCION                varchar(255), 
  DISPONIBILIDAD             int(1), 
  TELEFONO                   varchar(255), 
  NOMBRE_RESPONSABLE         varchar(255), 
  HORARIO                    varchar(255), 
  PRIMARY KEY (IDSERVICIO)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/******* 6  U N I D A D   S A L U D *******/
DROP TABLE IF EXISTS `unidad_salud`;
CREATE TABLE IF NOT EXISTS `unidad_salud` (
  usuarioidUsuario      int(10) NOT NULL, 
  IDUNIDADSALUD         int(10) NOT NULL AUTO_INCREMENT, 
  UNICODIGO             int(10) NOT NULL, 
  NOMBRE_OFICIAL        varchar(255), 
  NOMBRE_COMUN          varchar(255), 
  DIRECCION             varchar(255), 
  TELEFONO              varchar(255), 
  PROVINCIA             varchar(255), 
  CANTON                varchar(255), 
  PARROQUIA             varchar(255), 
  PARROQUIA_TIPO        char(1), 
  ZONA                  varchar(255), 
  ZONA_DISTRIBUCION     varchar(255), 
  DISTRITO              varchar(255), 
  DISTRITO_DISTRIBUCION varchar(255), 
  CIRCUITO              varchar(255), 
  AREA_CODIGO           varchar(255), 
  AREA                  varchar(255), 
  RED_ATENCION          varchar(255), 
  LUCRO                 varchar(255), 
  INSTITUCION           varchar(255), 
  NIVEL_ATENCION        varchar(255), 
  TIPOLOGIA             varchar(255), 
  HORARIO_ATENCION      varchar(255), 
  ESTADO                int(1), 
  LATITUD               double, 
  LONGITUD              double, 
  FOTO                  varchar(255), 
  PRIMARY KEY (IDUNIDADSALUD,UNICODIGO),
  KEY `Administra` (`usuarioidUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/******* 7  U S U A R I O *******/
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  IDUSUARIO      int(11) NOT NULL AUTO_INCREMENT, 
  NOMBRE         varchar(255) NOT NULL, 
  APELLIDO       varchar(255) NOT NULL, 
  CLAVE          varchar(255) NOT NULL, 
  CEDULA         varchar(255) NOT NULL, 
  CORREO         varchar(255) NOT NULL, 
  DIRECCION      varchar(255), 
  ESTADO         char(1), 
  FOTO           varchar(255), 
  TELEFONO       varchar(255), 
  RESPUESTA      varchar(250), 
  CORREORESPALDO varchar(255), 
  PRIMARY KEY (`IDUSUARIO`,`CEDULA`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/******* ISERTAR USUARIO ******/
INSERT INTO `usuario` (`IDUSUARIO`, `NOMBRE`, `APELLIDO`, `CLAVE`, `CEDULA`, `CORREO`, `DIRECCION`, `ESTADO`, `FOTO`, `TELEFONO`, `RESPUESTA`, `CORREORESPALDO`) VALUES
(16, 'k1RURMLL95/+uLxjIlNCxK6QwAq9fBMh8dx0k9OK47xldvvgIDS/tkAaZy8TQT4z53NRDarIW5/nmm0QMN1VsQ==', 'aehEG7yUa4rcdXUhpMP9FpN1QLHGlBfc3+m7IWVKL99l+kyyItaMNDHPNxT/J9Yzu/r4IIP2+d2C/1rgnWu0cg==', 'Ht0UUpa9v9SakQxBBZSZyVm6n7iwDfv2rVXjENZrWmL85tTkOQ0G8UzzSvHGp0lBxJxGt/PPE0Rfhah6gPOtAw==', 'tDLE6VBF8n84DoS/SMUU3P5f3x565r9yWiLrXijsZ0UUMG/Z6k0pr7ZYsePv7jKLeQmGO2NKNVRjd2BKrm0tOg==', 'KeZT4OkuBoq16tueaVZxT4Vk/uUjHmNN6E/TDVrMUoiIubFDMVT+dF4GJm2rnXiVaskFp5yCDNimQ5IcafEv+g==', 'tXAT7b0fzr9RxCt8TZfIVTCN3pMXsEohpMlDi16uyiydarnuW0FVa/LnwYzg3o98QgpGFH1EEYC4DWu+vbzdgA==', 'A', 'uploads/Cuentas_de_usuario.png', 'y0VCBPYogupuwSJ6DkjE51aynnphCI4c0RXKWS+vVZB38hS7ffmDXFLXWTflXDGOUrG9rM1Pweaq2C4+9fBIqg==', 'wXpSexCRFXVsHfrZsFmf2lw3PsCLwbF338IxieEPwlOCYG5vGSW15LtTQ4k1G3jQ/Xf4cDl8ehDz4RbXYpHtkg==', 'gPvDNmN3+vQSJxPca0esIerI/gytt+aHVdyaHGwNHioW+ecVhAPpCFZnFApZp4ocYUMF/UvBZAtgGzaS7Hdcog==');
