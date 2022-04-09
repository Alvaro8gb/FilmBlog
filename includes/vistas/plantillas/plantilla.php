<?php
$params['app']->doInclude('/vistas/helpers/plantilla.php');
$mensajes = mensajesPeticionAnterior();
 
?>
<!DOCTYPE html>
<html lang='es'>

	<head>
		<title><?= $params['tituloPagina'] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href= <?= $params['app']->resuelve(RUTA_CSS."bootstrap.css") ?>>
		<link rel="stylesheet" type="text/css" href= <?= $params['app']->resuelve(RUTA_CSS."estilos.css") ?>>
		<link rel="stylesheet" type="text/css" href= <?= $params['app']->resuelve(RUTA_CSS."header.css") ?>>
		<link rel="shortcut icon" type="image/ico" href=<?= $params['app']->resuelve(RUTA_IMGS."icono.png") ?>>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<?php if(isset($params["css"])) echo "\n\t\t".$params["css"]."\n"; ?>
	</head>

	<body>
		<header>
			<?php
				$params['app']->doInclude('/vistas/comun/header.php');
			?>
		</header>

		<main>
				<?= $mensajes ?>
				<?= $params['contenidoPrincipal'] ?>
		</main>

		<footer>
			<?php
				$params['app']->doInclude('/vistas/comun/footer.php');
			?>
		</footer>

	</body>
</html>

