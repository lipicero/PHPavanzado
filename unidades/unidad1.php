<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Programación en PHP y MySQL</title>
  <link rel="stylesheet" href="../estilos.css">
</head>
 
<body>
 
<div class="container">
	<header>
		<h1>Programación en PHP y MySQL - Nivel Avanzado</h1>
	

	<nav>
		<?php include("../include/botonera.php"); ?>
	</nav>
	</header>
	<section>
		<h2>Agenda de clases</h2>
		<?php
		if (isset($_GET['ok'])) {
			echo "<p class='mensaje-ok'>¡Clase registrada exitosamente!</p>";
		}
		$mensajesError = array(
			'datos' => 'Completa una unidad válida y una fecha correcta.',
			'conexion' => 'No se pudo conectar con la base de datos.',
			'tabla' => 'No se pudo preparar la tabla de clases.',
			'insertar' => 'No se pudo guardar la clase.'
		);
		$error = isset($_GET['error']) && is_string($_GET['error']) ? $_GET['error'] : '';
		if (isset($mensajesError[$error])) {
			echo "<p class='mensaje-error'>" . htmlspecialchars($mensajesError[$error], ENT_QUOTES, 'UTF-8') . "</p>";
		}
		include("ver_clases.php");
		?>
	</section>
	<aside>
		<form action="insertar_clases.php" method="POST">
			<label>Unidad:</label><br>
			<input type="text" name="unidad" maxlength="30" required><br><br>
	
			<label>Fecha:</label><br>
			<input type="date" name="fecha" required><br><br>
	
			<input type="submit" value="Cargar Clase">
		</form>
    
  </aside>
	<footer>
		<a href="https://site.elearning-total.com/courses/?com=lb">Programación en PHP y MySQL - Nivel Avanzado</a>
	</footer>
 
</div>
</body>
</html>