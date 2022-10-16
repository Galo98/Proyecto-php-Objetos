create database galoGuia2;

use galoGuia2;

create table clientes(
	nroCliente int auto_increment,
    nombre varchar(30),
    apellido varchar(30),
    dni int(8),
    direccion varchar(30),
    telefono int (10),
    primary key (nroCliente)
);

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