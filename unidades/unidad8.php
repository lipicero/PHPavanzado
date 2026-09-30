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
		<h2>Registro</h2>
				<?php if (isset($_GET['registro']) && $_GET['registro'] === 'ok'): ?>
					<p class="mensaje-ok">Usuario registrado correctamente.</p>
				<?php elseif (isset($_GET['registro']) && $_GET['registro'] === 'datos-invalidos'): ?>
					<p class="mensaje-error">Ingresá un email válido y una contraseña de al menos 6 caracteres.</p>
				<?php elseif (isset($_GET['registro']) && $_GET['registro'] === 'error'): ?>
					<p class="mensaje-error">No se pudo registrar el usuario. El email puede estar ya registrado.</p>
				<?php endif; ?>

				<form class="form-comentarios" action="cargarusuario.php" method="post">
					<label for="registro-email">Email:</label>
					<input type="email" id="registro-email" name="email" maxlength="255" required>

					<label for="registro-contrasena">Contraseña:</label>
					<input type="password" id="registro-contrasena" name="contrasena" minlength="6" required>

					<input type="submit" value="Registrarme">
				</form>
	</section>
	<aside>
				<h2>Ingreso</h2>
				<?php if (isset($_GET['ingreso']) && $_GET['ingreso'] === 'ok'): ?>
					<p class="mensaje-ok">Ingreso correcto.</p>
				<?php elseif (isset($_GET['ingreso']) && $_GET['ingreso'] === 'incorrecto'): ?>
					<p class="mensaje-error">Email o contraseña incorrectos.</p>
				<?php elseif (isset($_GET['ingreso']) && $_GET['ingreso'] === 'error'): ?>
					<p class="mensaje-error">No se pudo verificar el usuario.</p>
				<?php endif; ?>

				<form class="form-comentarios" action="verificarusuario.php" method="post">
					<label for="ingreso-email">Email:</label>
					<input type="email" id="ingreso-email" name="email" maxlength="255" required>

					<label for="ingreso-contrasena">Contraseña:</label>
					<input type="password" id="ingreso-contrasena" name="contrasena" required>

					<input type="submit" value="Ingresar">
				</form>
  </aside>
	<footer>
		<a href="https://site.elearning-total.com/courses/?com=lb">Programación en PHP y MySQL - Nivel Avanzado</a>
	</footer>
 
</div>
</body>
</html>