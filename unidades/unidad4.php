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
		<?php require_once __DIR__ . "/../include/botonera.php"; ?>
	</nav>
	</header>
	<section>
		<h2>Imágenes con PHP</h2>
		<?php
		$gdAvailable = function_exists('imagecreatefromstring');
		if ($gdAvailable) {
			$imagen = @imagecreatefromstring(file_get_contents(__DIR__ . '/phpimage.png'));
			$marca = @imagecreatefromstring(file_get_contents(__DIR__ . '/marca.png'));
			if ($imagen !== false && $marca !== false) {
				imagecopymerge(
					$imagen,
					$marca,
					intval((imagesx($imagen) - imagesx($marca)) / 2),
					intval((imagesy($imagen) - imagesy($marca)) / 2),
					0,
					0,
					imagesx($marca),
					imagesy($marca),
					45
				);
				imagepng($imagen, __DIR__ . '/foto_con_marca.png');
			}

			$origen = @imagecreatefromstring(file_get_contents(__DIR__ . '/unidad4.png'));
			if ($origen !== false) {
				$thumb = imagecreatetruecolor(150, 150);
				imagecopyresampled($thumb, $origen, 0, 0, 0, 0, 150, 150, imagesx($origen), imagesy($origen));
				imagepng($thumb, __DIR__ . '/unidad4_thumb.png');
			}
		}
		?>
		<?php if (!$gdAvailable): ?>
			<p>La extensión GD no está disponible en este servidor. Se muestra la imagen original sin procesar.</p>
		<?php endif; ?>
		<h3>Imagen con marca de agua</h3>
		<img src="<?php echo file_exists(__DIR__ . '/foto_con_marca.png') ? 'foto_con_marca.png' : 'phpimage.png'; ?>" alt="Imagen con marca de agua">

		<h3>Thumbnail 150 x 150 px</h3>
		<img class="thumb-unidad4" src="<?php echo file_exists(__DIR__ . '/unidad4_thumb.png') ? 'unidad4_thumb.png' : 'unidad4.png'; ?>" alt="Thumbnail de unidad4.png" width="150" height="150">
	</section>
	<aside>
    
  </aside>
	<footer>
		<a href="https://site.elearning-total.com/courses/?com=lb">Programación en PHP y MySQL - Nivel Avanzado</a>
	</footer>
 
</div>
</body>
</html>
