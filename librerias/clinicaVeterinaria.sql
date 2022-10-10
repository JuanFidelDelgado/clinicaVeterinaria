/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  adora
 * Created: 9/06/2022
 */
create table empresa(
    nit int primary key not null,
    nombre varchar(50) not null,
    direccion varchar(50) not null,
    telefono varchar(15) not null,
    correoElectronico varchar(50) not null,
    paginaWeb varchar(50) not null,
    facebook varchar(50) not null,
    instagram varchar(50) not null,
    twitter varchar(50) not null
);

create table tipoIdentificacion(
    id int auto_increment primary key not null,
    tipo varchar(3) not null,
    nombre varchar(50) not null
);

create table usuario (
    id int auto_increment primary key not null,
    tipoUsuario varchar(1) not null,
    identificacion int not null,
    tipoIdentificacion varchar(50) not null,
    nombres varchar(50) not null,
    apellidos varchar(50) null,
    telefono int not null,
    direccion varchar(20) not null,
    correoElectronico varchar(50) not null,
    clave varchar(32) not null,
    tarjetaProfesional varchar(15) null
);

create table especie (
    id int auto_increment primary key not null,
    nombre varchar(50) not null
);

create table raza (
    id int auto_increment primary key not null,
    nombre varchar(50) not null,
    idEspecie int not null
);

alter table raza add foreign key(idEspecie) references especie(id) on delete restrict on update cascade;

create table paciente (
    id int auto_increment primary key not null,
    idUsuario int not null,
    foto varchar(20),
    nombre varchar(50) not null,
    idEspecie int not null,
    idRaza int not null,
    fechaNacimiento date not null,
    sexo varchar(1) not null,
    color varchar(20) not null,
    señasParticulares varchar(50) not null
);

alter table paciente add foreign key(idUsuario) references usuario(id) on delete restrict on update cascade;
alter table paciente add foreign key(idEspecie) references especie(id) on delete restrict on update cascade;
alter table paciente add foreign key(idRaza) references raza(id) on delete restrict on update cascade;

create table tipoCita (
    id int auto_increment primary key not null,
    tipo varchar(20) not null
);

create table estadoCita (
    id int auto_increment primary key not null,
    estado varchar(20) not null
);

create table citas (
    id int auto_increment primary key not null,
    idPaciente int not null,
    fecha date not null,
    hora time not null,
    lugar varchar(50) not null,
    estadoCita varchar(20) not null,
    tipoCita varchar(20) not null
);
alter table citas add foreign key(idPaciente) references paciente(id) on delete restrict on update cascade;

create table consulta (
    id int auto_increment primary key not null,
    fecha date, 
    idCita int not null,
    idMedico int not null,
    idPaciente int not null,
    idHistoriaClinica int not null
);

alter table consulta add foreign key(idCitas) references citas(id) on delete restrict on update cascade;
alter table consulta add foreign key(idMedico) references usuario(id) on delete restrict on update cascade;
alter table consulta add foreign key(idPaciente) references paciente(id) on delete restrict on update cascade;

create table examenClinico (
    id int auto_increment primary key not null,
    idConsulta int not null,
    actitud varchar(500) null,
    condicionCorporal varchar(50) null,
    estadoHidratacion varchar(50) null
);

alter table examenClinico add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;

create table desparasitacion (
    id int auto_increment primary key not null,
    idConsulta int not null,
    estadoDesparasitacion varchar(50) null,
    fechaDesparasitacion date null
);

alter table desparasitacion add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;

create table constantesFisiologicas (
    id int auto_increment primary key not null,
    idConsulta int not null,
    tlc int null,
    temperatura int null,
    fr int null,
    fc int null,
    pulso int null,
    peso int null
);

alter table constantesFisiologicas add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;

create table planDiagnostico (
    id int auto_increment primary key not null,
    idConsulta int not null,
    cuadroHematico varchar(500) null,
    fechaCuadroHematico date null,
    parcialOrina varchar(500) null,
    fechaParcialOrina date null,
    coprologico varchar(500) null,
    fechaCoprologico date null,
    coproscopico varchar(500) null,
    fechaCoproscopico date null
);

alter table planDiagnostico add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;

create table listaProblemas (
    id int auto_increment primary key not null,
    idConsulta int null,
    nombre varchar(50) null,
    diagnosticoDiferencial varchar(500) null
);

alter table listaProblemas add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;

create table citologia (
    id int auto_increment primary key not null,
    idConsulta int not null,
    resultado varchar(256) null,
    observaciones varchar(500) null
);

alter table citologia add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;

create table estadosFisicos (
    id int auto_increment primary key not null,
    nombre varchar(50) null,
    observaciones varchar(500) null
);

create table estadoFisicoPaciente (
    id int auto_increment primary key not null,
    idConsulta int not null,
    idEstadosFisicos int null,
    observaciones varchar(500) null
);

alter table estadoFisicoPaciente add foreign key(idEstadosFisicos) references estadosFisicos(id) on delete restrict on update cascade;
alter table estadoFisicoPaciente add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;

create table vacunas (
    id int auto_increment primary key not null,
    nombre varchar(50) not null,
    observaciones varchar(500) null
);

create table estadosReproductivos (
    id int auto_increment primary key not null,
    nombre varchar(50) not null,
    observaciones varchar(500) null
);

create table enfermedades (
    id int auto_increment primary key not null,
    nombre varchar(50) not null,
    descripcion varchar(500) null
);

create table tipoAlimentacion (
    id int auto_increment primary key not null,
    tipo varchar(20) not null,
    observaciones varchar(500) null
);

create table habitat (
    id int auto_increment primary key not null,
    tipo varchar(20) not null,
    observaciones varchar(500) null
);

create table medicamentos (
    id int auto_increment primary key not null,
    principioActivo varchar(50) not null,
    presentacion varchar(500) not null,
    concentracion varchar(500) not null
);

create table planTerapeutico (
    id int auto_increment primary key not null,
    idConsulta int not null,
    tipo1 varchar(50) null,
    tipo2 varchar(50) null,
    tipo3 varchar(50) null,
    tipo4 varchar(50) null,
    tipo5 varchar(50) null,
    medicamento1 varchar(500) null,
    medicamento2 varchar(500) null,
    medicamento3 varchar(500) null,
    medicamento4 varchar(500) null,
    medicamento5 varchar(500) null,
    dosisTotal1 varchar(500) null,
    dosisTotal2 varchar(500) null,
    dosisTotal3 varchar(500) null,
    dosisTotal4 varchar(500) null,
    dosisTotal5 varchar(500) null,
    viaAdministracion1 varchar(50) null,
    viaAdministracion2 varchar(50) null,
    viaAdministracion3 varchar(50) null,
    viaAdministracion4 varchar(50) null,
    viaAdministracion5 varchar(50) null,
    frecuencia1 varchar(30) null,
    frecuencia2 varchar(30) null,
    frecuencia3 varchar(30) null,
    frecuencia4 varchar(30) null,
    frecuencia5 varchar(30) null,
    duracion1 varchar(30) null,
    duracion2 varchar(30) null,
    duracion3 varchar(30) null,
    duracion4 varchar(30) null,
    duracion5 varchar(30) null
);

alter table planTerapeutico add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;

create table diagnosticoDefinitivo (
    id int auto_increment primary key not null,
    idConsulta int not null,
    diagnosticoDefinitivo varchar(500) null,
    observaciones varchar(500) null
);

alter table diagnosticoDefinitivo add foreign key(idConsulta) references consulta(id) on delete restrict on update cascade;


create table historiaClinica (
    id int auto_increment primary key not null,
    fecha date,
    idPaciente int not null,
    fechaEsterilizacion date,
    tipoAlimentacion varchar(20) null,
    habitat varchar(20) null
);

alter table historiaClinica add foreign key(idPaciente) references paciente(id) on delete restrict on update cascade;

create table aplicacionVacuna (
    id int auto_increment primary key not null,
    idVacuna int not null,
    idHistoriaClinica int not null,
    fecha timestamp,
    observaciones varchar(500) null
);

alter table aplicacionVacuna add foreign key(idHistoriaClinica) references historiaClinica(id) on delete restrict on update cascade;
alter table aplicacionVacuna add foreign key(idVacuna) references vacunas(id) on delete restrict on update cascade;

create table estadoReproductivoPaciente (
    id int auto_increment primary key not null,
    idHistoriaClinica int not null,
    idEstadosReproductivos int not null,
    fecha timestamp,
    observaciones varchar(500) null
);

alter table estadoReproductivoPaciente add foreign key(idEstadosReproductivos) references estadosReproductivos(id) on delete restrict on update cascade;
alter table estadoReproductivoPaciente add foreign key(idHistoriaClinica) references historiaClinica(id) on delete restrict on update cascade;

create table enfermedadesPaciente (
    id int auto_increment primary key not null,
    idEnfermedades int not null,
    idHistoriaClinica int not null,
    observaciones varchar(500) null,
    fecha date
);

alter table enfermedadesPaciente add foreign key(idEnfermedades) references enfermedades(id) on delete restrict on update cascade;
alter table enfermedadesPaciente add foreign key(idHistoriaClinica) references historiaClinica(id) on delete restrict on update cascade;

alter table consulta add foreign key(idHistoriaClinica) references historiaClinica(id) on delete restrict on update cascade;

insert into tipoIdentificacion (tipo, nombre) values ('CC', 'Cédula de ciudadanía'), ('CE', 'Cédula de extranjería'), ('TI', 'Tarjeta de identidad'), ('NIT', 'Identificación tributaria');
insert into estadoCita (estado) values ('Programada'), ('Cumplida'), ('Cancelada');
insert into tipoCita (tipo) values ('General'), ('Especialista'), ('Odontología'), ('No programada');
INSERT INTO `usuario`(`tipoUsuario`, `identificacion`, `tipoIdentificacion`, `nombres`, `apellidos`, `telefono`, `direccion`, `correoElectronico`, `clave`, `tarjetaProfesional`) VALUES ('A','1000','1','Juan Fidel','Delgado González','310000000','Calle 1 # 11 - 91','juan@empresa.com',md5('1000'),'');
insert into especie (nombre) values ('Caninos');
insert into especie (nombre) values ('Felinos');
insert into raza (nombre, idEspecie) values ('Criollo', 1);
insert into raza (nombre, idEspecie) values ('Rottweiller', 1);
insert into raza (nombre, idEspecie) values ('Pastor Aleman', 1);
insert into raza (nombre, idEspecie) values ('Boxer', 1);
insert into raza (nombre, idEspecie) values ('Golden Retriever', 1);
insert into raza (nombre, idEspecie) values ('Abisino', 2);
insert into raza (nombre, idEspecie) values ('Asiatico', 2);
insert into raza (nombre, idEspecie) values ('Bengalí', 2);
insert into raza (nombre, idEspecie) values ('Balinés', 2);
insert into tipoAlimentacion (tipo, observaciones) values ('Casera', 'El paciente consume la alimentación del hogar');
insert into tipoAlimentacion (tipo, observaciones) values ('Especializada', 'El paciente consume únicamente alimento especializado');
insert into tipoAlimentacion (tipo, observaciones) values ('Mixta', 'El paciente consume alimento casero y especializado');
insert into tipoAlimentacion (tipo, observaciones) values ('Medicada', 'El paciente consume alimento medicado únicamente');
insert into habitat (tipo, observaciones) values ('Hogar', 'EL paciente habita con sus propietarios');
insert into habitat (tipo, observaciones) values ('Taller', 'El paciente habita en un taller de trabajo');
insert into habitat (tipo, observaciones) values ('Lote', 'El paciente habita en lote a cielo abierto');
insert into habitat (tipo, observaciones) values ('Silvestre', 'El paciente no tiene lugar de habitación fijo');