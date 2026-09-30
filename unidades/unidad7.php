<?php
include("productos.php");

if (isset($_POST['cargar'])) {
	$producto = new producto($_POST['nombre'], $_POST['descripcion'], $_POST['precio']);
	if ($producto->introducir_producto()) {
		header('Location: unidad7.php?ok');
		exit;
	}
	header('Location: unidad7.php?error');
	exit;
}

if (isset($_POST['eliminar'])) {
	$producto = new producto('', '', 0, $_POST['id_producto']);
	if ($producto->eliminar_producto()) {
		header('Location: unidad7.php?eliminado');
		exit;
	}
	header('Location: unidad7.php?error');
	exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Administrador de Productos</title>
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
		<h2>Compras</h2>
		<?php
		if (isset($_GET['ok'])) {
			echo "<p class='mensaje-ok'>¡Producto cargado correctamente!</p>";
		}
		if (isset($_GET['eliminado'])) {
			echo "<p class='mensaje-ok'>Producto eliminado correctamente.</p>";
		}
		if (isset($_GET['error'])) {
			echo "<p class='mensaje-error'>Ocurrió un error al procesar la operación.</p>";
		}

		$listado = new producto();
		$listado->listar_producto();
		?>
	</section>
	<aside>
		<h3>Cargar producto</h3>
		<form class="form-comentarios" action="unidad7.php" method="post">
			<label for="nombre">Nombre:</label>
			<input type="text" id="nombre" name="nombre" maxlength="30" required>

			<label for="descripcion">Descripción:</label>
			<textarea id="descripcion" name="descripcion" maxlength="255" rows="4" required></textarea>

			<label for="precio">Precio:</label>
			<input type="number" id="precio" name="precio" step="0.1" min="0" required>

			<input type="submit" name="cargar" value="Cargar">
		</form>
  </aside>
	<footer>
		<a href="https://site.elearning-total.com/courses/?com=lb">Programación en PHP y MySQL - Nivel Avanzado</a>
	</footer>
 
</div>
</body>
</html>
