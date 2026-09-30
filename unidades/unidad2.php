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
		<h2>Eventos</h2>
		<?php
		if (isset($_GET['error']) && $_GET['error'] === 'fecha_invalida') {
			echo "<p class='mensaje-error'>La fecha ingresada no existe. Verifica el día, el mes y el año.</p>";
		} elseif (isset($_GET['dias'])) {
			$dias = (int) $_GET['dias'];
			$fecha = $_GET['dia'] . "/" . $_GET['mes'] . "/" . $_GET['anio'];
			if ($dias > 0) {
				$mensaje = "Faltan $dias días para el $fecha.";
			} elseif ($dias < 0) {
				$transcurridos = abs($dias);
				$mensaje = "Han pasado $transcurridos días desde el $fecha.";
			} else {
				$mensaje = "La fecha es hoy ($fecha).";
			}
			echo "<p class='mensaje-ok'>" . $mensaje . "</p>";
		}
		?>
	</section>
	<aside>
		<form action="calculo_fecha.php" method="POST">
			<label>Día:</label><br>
			<input type="number" name="dia" min="1" max="31" value="<?php if(isset($_GET['dia'])) echo $_GET['dia']; ?>" required><br><br>

			<label>Mes:</label><br>
			<input type="number" name="mes" min="1" max="12" value="<?php if(isset($_GET['mes'])) echo $_GET['mes']; ?>" required><br><br>

			<label>Año:</label><br>
			<input type="number" name="anio" min="1900" max="2100" value="<?php if(isset($_GET['anio'])) echo $_GET['anio']; ?>" required><br><br>

			<input type="submit" value="Calcular Días">
		</form>
	</aside>
	<footer>
		<a href="https://site.elearning-total.com/courses/?com=lb">Programación en PHP y MySQL - Nivel Avanzado</a>
	</footer>
 
</div>
</body>
</html>