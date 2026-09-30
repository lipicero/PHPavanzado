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
		<h2>Comentarios</h2>
		<?php
		if (isset($_GET['ok'])) {
			echo "<p class='mensaje-ok'>¡Comentario enviado y guardado correctamente!</p>";
		}
		?>
		<form class="form-comentarios" action="comentarios.php" method="post">
			<label for="Nombre">Nombre:</label>
			<input type="text" id="Nombre" name="Nombre" required>
			<label for="Apellido">Apellido:</label>
			<input type="text" id="Apellido" name="Apellido" required>
			<label for="Mail">Mail:</label>
			<input type="email" id="Mail" name="Mail" required>
			<label for="Comentarios">Comentarios:</label>
			<textarea id="Comentarios" name="Comentarios" rows="5" required></textarea>
			<input type="submit" value="Enviar">
		</form>
	</section>
	<aside>
		<h3>Comentarios guardados</h3>
		<div class="listado-comentarios">
			<?php
			if (file_exists("comentarios.txt") && filesize("comentarios.txt") > 0) {
				echo file_get_contents("comentarios.txt");
			} else {
				echo "<p>Aún no hay comentarios.</p>";
			}
			?>
		</div>
	</aside>
	<footer>
		<a href="https://site.elearning-total.com/courses/?com=lb">Programación en PHP y MySQL - Nivel Avanzado</a>
	</footer>
 
</div>
</body>
</html>