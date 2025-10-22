drop database if exists agenda;
create database agenda;
use agenda;

create table contacto (
  id int auto_increment primary key,
  nombres varchar(80) not null,
  apaterno varchar(80) not null,
  amaterno varchar(80) not null,
  genero enum('m','f') not null,
  fecha_nacimiento date not null,
  telefono varchar(20) not null,
  email varchar(120) not null,
  linkedin varchar(200) not null,
  creado_en timestamp default current_timestamp
);

-- datos
insert into contacto (nombres, apaterno, amaterno, genero, fecha_nacimiento, telefono, email, linkedin) values
('marcelo', 'manrique', 'rojas', 'm', '2001-03-14', '987654321', 'marcelo@gmail.com', 'https://linkedin.com/in/mmanrique'),
('valeria', 'sanchez', 'quiroz', 'f', '2000-07-08', '984321678', 'valeria@gmail.com', 'https://linkedin.com/in/valeriasq'),
('diego', 'flores', 'ramirez', 'm', '1999-12-23', '976543210', 'dieg@gmail.com', 'https://linkedin.com/in/diegofr'),
('andrea', 'huaman', 'lopez', 'f', '2002-05-11', '965478123', 'andrea@gmail.com', 'https://linkedin.com/in/andreahl');
