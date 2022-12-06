CREATE DATABASE atencionpodologica;
DROP schema atencionpodologica;


CREATE TABLE atencionpodologica.paciente (
    id int NOT NULL AUTO_INCREMENT,
    rut long NOT NULL,
    d_verificador char NOT NULL,
    nombre char(50) NOT NULL,
    apellido char(50) NOT NULL,
    edad int NOT NULL,
    telefono int NOT NULL,
    correo char(50),
    PRIMARY KEY (id)
);

CREATE TABLE atencionpodologica.ficha (
    id int NOT NULL AUTO_INCREMENT,
    id_paciente int NOT NULL,
    fecha date NOT NULL,
    hora TIME NOT NULL,
    direccion char(255),
    comentario text(500),
    costo int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_paciente) REFERENCES paciente(id)
);


CREATE TABLE atencionpodologica.tipo_visita (
    id int NOT NULL AUTO_INCREMENT,
    tipo char(50) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE atencionpodologica.agenda (
    id int NOT NULL AUTO_INCREMENT,
    id_ficha int NOT NULL,
    id_tipo int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_ficha) REFERENCES atencionpodologica.ficha(id),
    FOREIGN KEY (id_tipo) REFERENCES atencionpodologica.tipo_visita(id)
);

CREATE TABLE atencionpodologica.doctor (
    id int NOT NULL AUTO_INCREMENT,
    correo char(50) NOT NULL,
    password char(65) NOT NULL,
    atiende boolean NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE atencionpodologica.inventario (
    id int NOT NULL AUTO_INCREMENT,
    nombre char(50) NOT NULL,
    cantidad int NOT NULL,
    precioTotal int NOT NULL,
    precioxunidad int NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE atencionpodologica.historial (
    id int NOT NULL AUTO_INCREMENT,
    id_producto int NOT NULL,
    fecha date NOT NULL,
    cantidad int NOT NULL,
    precioxunidad int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_producto) REFERENCES inventario(id)
);

 
create table atencionpodologica.horas (hora TIME NOT NULL);
insert into atencionpodologica.horas(hora) values('09:00:00');
insert into atencionpodologica.horas(hora) values('10:30:00');
insert into atencionpodologica.horas(hora) values('12:00:00');
insert into atencionpodologica.horas(hora) values('13:30:00');
insert into atencionpodologica.horas(hora) values('17:30:00');
insert into atencionpodologica.horas(hora) values('19:00:00');
insert into atencionpodologica.horas(hora) values('20:30:00');

INSERT INTO atencionpodologica.tipo_visita (tipo) VALUES ('presencial');
INSERT INTO atencionpodologica.tipo_visita (tipo) VALUES ('domicilio');

INSERT INTO atencionpodologica.doctor (correo, password, atiende) VALUES ('patyirigoin@yahoo.es', '$2y$10$H0RPDCAbahGWwwefdxZsYuafUmdpY89wJ0r/RvZZXTr.4.KLKCITa', True);
INSERT INTO atencionpodologica.paciente (id, rut, d_verificador, nombre, apellido, edad, telefono, correo) VALUES (3, '6898909', '4','patricia', 'irigoin', 61, 972125596, 'patyirigoin@yahoo.es');