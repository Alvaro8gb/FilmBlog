
--
-- Datos de  la tabla para la tabla `usuarios`
--

DELETE FROM usuarios;

INSERT INTO `usuarios` (`IdUsuario`, `nombreUsuario`, `nombre`, `password`, `correo`, `rol`) VALUES
(1, 'admin', 'Administrador', '$2y$10$j3gDDnUmICg/rvP0lmz8Duv2FcE1Ufi0tDQpIqx5cKcbqtkBOxhfS', 'admin@ucm.es', 'admin'),
(2, 'user', 'Usuario', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'user@ucm.es', 'user'),
(3, 'test', 'Tester', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'test@ucm.es', 'user'),
(4, 'Serginio', 'Sergio', '$2y$10$0D/3TMzY6mVTTKYJpAXP0OQrJmtvIxjqaY20IdEdgmx4xXq..UaL6', 'sergilor@ucm.es', 'user'),
(5, 'AlvaVarito', 'Alvaro', '$2y$10$qefQg2bKTUz57GG738X0duVwmWjuBXZT6bkGYTk97mYzwJLkKDwZq', 'alvaga28@ucm.es', 'user');
COMMIT;


--
-- Datos de  la tabla para la tabla `puntuaciones`
--

DELETE FROM puntuaciones;

INSERT INTO `puntuaciones` VALUES (1,2,1),(1,4,2),(1,5,2),(2,2,1),(3,2,2),(3,3,5),(3,4,2),(4,2,2),(4,3,4),(4,5,2),(5,3,5),(5,5,3),(7,4,4),(7,5,3),(8,2,3),(8,3,4),(9,2,3),(9,3,1),(9,5,1),(10,3,5),(10,4,2),(11,2,2),(11,5,2),(12,4,5),(13,2,5),(14,3,1),(14,4,4),(14,5,2),(16,2,4),(16,3,2),(16,4,1),(16,5,5),(17,3,4),(17,4,1),(17,5,2),(18,2,5),(18,3,1),(18,5,4),(19,4,3),(19,5,2),(20,2,4),(20,3,5),(21,2,4),(21,3,3),(22,2,4),(22,3,1),(22,4,1),(23,2,5),(23,4,5),(24,2,1),(24,4,4),(26,5,1),(27,5,1),(28,2,2),(29,5,3),(30,2,5),(30,4,2),(30,5,2),(31,4,4),(31,5,3),(32,4,3),(32,5,3),(33,5,1),(34,2,3),(34,3,3),(34,4,4),(34,5,5),(35,2,1),(35,3,4),(36,4,4),(36,5,3),(37,4,3),(38,3,1),(38,4,5),(39,4,2),(40,2,5),(40,4,1),(41,2,3),(41,3,5),(42,3,4),(42,4,5),(43,3,3),(43,4,4),(44,3,1),(44,5,4),(45,4,5),(45,5,1),(46,5,3);