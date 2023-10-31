Create database if not exists preguntonta;

use preguntonta;

Create table usuario(
	id INT AUTO_INCREMENT,
    usuario varchar(50),
    contraseña varchar(50),
    record int,
    puntosTotales int,
    PRIMARY KEY (id));
    
Insert into usuario (id, usuario, contraseña, record, puntosTotales) VALUES (1,"admin","1234","0","0");
Insert into usuario (id, usuario, contraseña, record, puntosTotales) VALUES (2,"editor","1234","0","0");