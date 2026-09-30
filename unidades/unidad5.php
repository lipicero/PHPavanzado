<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
		<h2>Consultas</h2>
		<?php
		if (isset($_GET['ok'])) {
			echo "<p class='mensaje-ok'>¡Consulta enviada correctamente!</p>";
		}
		if (isset($_GET['error'])) {
			echo "<p class='mensaje-error'>El código de verificación es incorrecto. Intentá nuevamente.</p>";
		}
		?>
		<form class="form-comentarios" action="cargar.php" method="post">
			<label for="nombre">Nombre:</label>
			<input type="text" id="nombre" name="nombre" required>
			<label for="apellido">Apellido:</label>
			<input type="text" id="apellido" name="apellido" required>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
			<label for="consulta">Consulta:</label>
			<textarea id="consulta" name="consulta" rows="5" required></textarea>
			<label for="captcha">Código de verificación:</label>
			<div class="captcha-bloque">
				<img src="captcha.php" alt="Código captcha">
				<input type="text" id="captcha" name="captcha" maxlength="5" required autocomplete="off">
			</div>
			<input type="submit" value="Enviar">
		</form>
	</section>
	<aside>
		<p>Completá el formulario e ingresá el código que aparece en la imagen para enviar tu consulta.</p>
  </aside>
	<footer>
		<a href="https://site.elearning-total.com/courses/?com=lb">Programación en PHP y MySQL - Nivel Avanzado</a>
	</footer>
 
</div>
</body>
</html>
