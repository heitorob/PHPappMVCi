create database if not exists biblioteca;
use biblioteca;

create table if not exists usuario(
    Id int auto_increment primary key,
    Email varchar(60) not null,
    Senha varchar(100) not null,
    Nome varchar(50)
);

select * from usuario;