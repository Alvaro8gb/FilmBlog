DELETE FROM usuarios;

INSERT INTO `usuarios` (`IdUsuario`, `nombreUsuario`, `nombre`, `password`, `correo`, `rol`) VALUES
(1, 'admin', 'Administrador', '$2y$10$j3gDDnUmICg/rvP0lmz8Duv2FcE1Ufi0tDQpIqx5cKcbqtkBOxhfS', 'admin@ucm.es', 'admin'),
(2, 'user', 'Usuario', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'user@ucm.es', 'user'),
(3, 'test', 'Tester', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'test@ucm.es', 'user'),
(4, 'Serginio', 'Sergio', '$2y$10$0D/3TMzY6mVTTKYJpAXP0OQrJmtvIxjqaY20IdEdgmx4xXq..UaL6', 'sergilor@ucm.es', 'user'),
(5, 'AlvaVarito', 'Alvaro', '$2y$10$qefQg2bKTUz57GG738X0duVwmWjuBXZT6bkGYTk97mYzwJLkKDwZq', 'alvaga28@ucm.es', 'user');
COMMIT;

INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES ('2', '3', '4');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES ('2', '4', '3');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES ('2', '5', '5');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 18 ',' 3 ',' 0 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 8 ',' 4 ',' 1 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 13 ',' 4 ',' 4 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 24 ',' 4 ',' 4 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 9 ',' 4 ',' 2 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 11 ',' 4 ',' 1 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 5 ',' 2 ',' 1 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 45 ',' 2 ',' 5 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 19 ',' 2 ',' 2 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 44 ',' 3 ',' 0 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 36 ',' 3 ',' 1 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 31 ',' 3 ',' 2 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 29 ',' 3 ',' 3 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 42 ',' 2 ',' 1 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 12 ',' 2 ',' 4 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 36 ',' 2 ',' 4 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 27 ',' 2 ',' 2 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 3 ',' 2 ',' 4 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 6 ',' 4 ',' 5 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 0 ',' 4 ',' 3 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 10 ',' 4 ',' 4 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 25 ',' 4 ',' 0 ');
INSERT INTO `puntuaciones` (`idpelicula`, `idusuario`, `puntuacion`) VALUES (' 5 ',' 4 ',' 4 ');




