CREATE USER 'practica_abd'@'%' IDENTIFIED BY 'practica_abd';
GRANT ALL PRIVILEGES ON `practica_abd`.* TO 'practica_abd'@'%';

CREATE USER 'practica_abd'@'localhost' IDENTIFIED BY 'practica_abd';
GRANT ALL PRIVILEGES ON `practica_abd`.* TO 'practica_abd'@'localhost';