DELETE FROM usuarios;
DELETE FROM peliculas;

INSERT INTO `usuarios` (`IdUsuario`, `nombreUsuario`, `nombre`, `password`, `correo`, `rol`) VALUES
(1, 'admin', 'Administrador', '$2y$10$j3gDDnUmICg/rvP0lmz8Duv2FcE1Ufi0tDQpIqx5cKcbqtkBOxhfS', 'admin@ucm.es', 'admin'),
(2, 'user', 'Usuario', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'user@ucm.es', 'user'),
(3, 'test', 'Tester', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG', 'test@ucm.es', 'user'),
(4, 'Pablete', 'Pablo', '$2y$10$35uh6wVOujk/xqDMfsRMpuYrTwUiORkHxjSuNEPWJ5h6HuJf.1LkG', 'pablsa11@ucm.es', 'user'),
(5, 'Serginio', 'Sergio', '$2y$10$0D/3TMzY6mVTTKYJpAXP0OQrJmtvIxjqaY20IdEdgmx4xXq..UaL6', 'sergilor@ucm.es', 'user'),
(6, 'MazoMazo', 'Victor', '$2y$10$aolR/C7SqPryVDh8fKmGO.7SfgSiLckyNxLIbOZtFFvZKlMcROSY.', 'vmoren04@ucm.es', 'user'),
(7, 'PetarPetas', 'Petar', '$2y$10$RUt3SOt5BGrqXwgyvza05.GsmXWRicUrFMiIZOA7y.wXiaiUY5XoC', 'peivanov@ucm.es', 'user'),
(8, 'AlvaVarito', 'Alvaro', '$2y$10$qefQg2bKTUz57GG738X0duVwmWjuBXZT6bkGYTk97mYzwJLkKDwZq', 'alvaga28@ucm.es', 'user'),
(9, 'DaPito', 'David', '$2y$10$Lzz9Et97e0W6VUQ2dN0wnuAVCQK84j0QGEEvinWetIs/QAKrX25xa', 'davcan01@ucm.es', 'user');
COMMIT;