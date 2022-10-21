create database galoGuia3;

use galoGuia3;

-- drop database galoGuia3;

create table clientes(
	nroCliente int auto_increment,
    nombre varchar(30),
    apellido varchar(30),
    dni int(8),
    direccion varchar(30),
    telefono int (10),
    primary key (nroCliente)
);

insert into clientes (nombre,apellido,dni,direccion,telefono) values ('Matias','Karlen',11345678,'Calle falsa',11345678),('Juan','David',87654321,'Calle Mentira',25463251),('Luciano','Herdeli',30253625,'Calle Rota',11251325),('Alberto','Posadas',25362514,'Cale 251',1135265425);

create table empleados(
	nroEmpleado int auto_increment,
    nombre varchar(30),
    apellido varchar(30),
    dni int(8),
    direccion varchar(30),
    telefono int (10),
    sueldo float (9,2),
    rol varchar (10),
    antiguedad date,
    primary key (nroEmpleado)
);

insert into empleados (nombre,apellido,dni,direccion,telefono,sueldo,rol,antiguedad) values ('Celeste','Diaz',40201302,'Calle falsa 123',113152415,120000,'admin','2022-02-02'),('Dana','More',41352163,'Calle 123',1141526314,115000,'empelado','2022-06-15'),('Roberto','Mendoza',32201302,'Calle 33',1115308947,150000,'admin','2020-05-16'),('Susana','Gimenez',32524635,'Calle 800',1136548974,190000,'admin','2010-10-05'),('Dario','Barassi',36201302,'Calle 400',1160857496,220000,'empleado','2005-08-25'),('Marcelo','Tinelli',31201302,'Calle Poblada',1158695263,250000,'empleado','2000-02-02');

-- select * from clientes;
-- select * from empleados;

