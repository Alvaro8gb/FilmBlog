CREATE USER 'practica_abd_user'@'%' IDENTIFIED BY 'practica_abd_user';
GRANT ALL PRIVILEGES ON `practica_abd`.* TO 'practica_abd_user'@'%';

CREATE USER 'practica_abd_user'@'localhost' IDENTIFIED BY 'practica_abd_user';
GRANT ALL PRIVILEGES ON `practica_abd`.* TO 'practica_abd_user'@'localhost';