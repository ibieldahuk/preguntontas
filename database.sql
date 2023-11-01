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

CREATE TABLE preguntas (
    ID INT(2) PRIMARY KEY AUTO_INCREMENT,
    pregunta VARCHAR(100),
    categoria VARCHAR(20),
    qty INT,
    correctas INT,
    sharecorrecta INT
);

INSERT INTO preguntas (pregunta, categoria, qty, correctas, sharecorrecta) VALUES
    ("¿Quién es el heroe que protege a Ciudad Gotica?", "Entretenimiento", 1, 1, 1),
    ("¿Cómo se llamaba el barco del pirata Jack Sparrow en ""Piratas del Caribe""?", "Entretenimiento", 1, 1, 1),
    ("¿Cuál es la comida preferida de Garfield?", "Entretenimiento", 1, 1, 1),
    ("¿En que parte de Estados unidos vive la familia soprano?", "Entretenimiento", 1, 1, 1),
    ("¿Qué superpoder tiene Lex Luthor, el archienemigo de Superman?", "Entretenimiento", 1, 1, 1),
    ("¿En que cancha esta filmada la escena de futbol de ""El Secreto ded sus Ojos""?", "Entretenimiento", 1, 1, 1),
    ("Apu de Los Simpsons ¿Es vegetariano?", "Entretenimiento", 1, 1, 1),
    ("¿En que pais se desarrolla ""La novicia rebelde""?", "Entretenimiento", 1, 1, 1),
    ("¿Con que pelicula Jennifer Lawrence gano el Oscar?", "Entretenimiento", 1, 1, 1),
    ("¿Cómo se llama el hermano de Michael Scofield en la serie ""Prision Break""?", "Entretenimiento", 1, 1, 1),
    ("¿Qué ciudad fue elegida como sede de los juegos olimpicos 2020?", "Deporte", 1, 1, 1),
    ("El tenista Rafael Nadal ¿Es diestro?", "Deporte", 1, 1, 1),
    ("¿Qué nombre recibe la colchoneta donde se practica Judo?", "Deporte", 1, 1, 1),
    ("En la pesca deportiva ¿A que pez se lo conoce como ""Flecha de plata""?", "Deporte", 1, 1, 1),
    ("¿En que provincia Argentina nacio el golfista Angel Cabrera?", "Deporte", 1, 1, 1),
    ("¿Qué animal fue seleccionado como mascota del mundial de futbol Rusia 2018?", "Deporte", 1, 1, 1),
    ("¿Se permiten golpes de codo en kick-boxing?", "Deporte", 1, 1, 1),
    ("¿En que pais se invento el paddle?", "Deporte", 1, 1, 1),
    ("¿Qué altura tienen los trampolines olimpicos?", "Deporte", 1, 1, 1),
    ("¿Cuántas medallas de oro tuvo Argentina en Rio 2016?", "Deporte", 1, 1, 1),
    ("", "Deporte", 1, 1, 1),
    ("¿Qué animal puede sobrevivir mas tiempo sin agua?", "Naturaleza", 1, 1, 1),
    ("¿Las hormigas tienen reinas, como las abejas?", "Naturaleza", 1, 1, 1),
    ("Los tibres blancos tienen ojos azules ¿De que color los tienen el resto?", "Naturaleza", 1, 1, 1),
    ("Los koalas se alimentan de las hojas y corteza de un solo arbol ¿De cual?", "Naturaleza", 1, 1, 1),
    ("¿Quién fue el primer hombre que realizo un vuelo espacial?", "Naturaleza", 1, 1, 1),
    ("¿En que lugar del cuerpo tienen las moscas sus 15.000 papilas gustativas?", "Naturaleza", 1, 1, 1),
    ("¿En que momento del dia suelen registrarse las temperaturas mas bajas?", "Naturaleza", 1, 1, 1),
    ("¿De que color es la piel de los osos polares debajo del pelo?", "Naturaleza", 1, 1, 1),
    ("¿Las ballenas ponen huevos?", "Naturaleza", 1, 1, 1),
    ("¿Cuántas patas tiene un cien pies?", "Naturaleza", 1, 1, 1),
    ("¿Dónde nacio Barack Obama?", "Geografia", 1, 1, 1),
    ("Si hago rafting en el rio Atuel ¿En que provincia estoy?", "Geografia", 1, 1, 1),
    ("¿Qué pais asiatico es conocido como ""La tierra del elefante blanco""?", "Geografia", 1, 1, 1),
    ("¿La ruptura de que galciar es admirado por miles de turistar?", "Geografia", 1, 1, 1),
    ("¿En que pais esta la caverna mas profunda del mundo?", "Geografia", 1, 1, 1),
    ("¿A que pais pertenece la turistica isla margarita?", "Geografia", 1, 1, 1),
    ("¿Cómo se llamo el huracan que devasto Nueva Orleans en el siglo XXI?", "Geografia", 1, 1, 1),
    ("Indonesia ¿Esta formado por mas de 10.000 islas?", "Geografia", 1, 1, 1),
    ("¿Qué provincia es la capital nacional del poncho?", "Geografia", 1, 1, 1),
    ("Una vez disuelta la Union Sovietica ¿Cuál paso a ser el pais mas extenso del mundo?", "Geografia", 1, 1, 1);

CREATE TABLE respuestas (
    ID INT(2) PRIMARY KEY AUTO_INCREMENT,
    ID_preguntas INT(2),
    opcion VARCHAR(40),
    opcioncorrecta VARCHAR(2)
);