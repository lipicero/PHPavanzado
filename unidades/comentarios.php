<?php
$nombre      = isset($_POST['Nombre']) ? trim($_POST['Nombre']) : '';
$apellido    = isset($_POST['Apellido']) ? trim($_POST['Apellido']) : '';
$mail        = isset($_POST['Mail']) ? trim($_POST['Mail']) : '';
$comentarios = isset($_POST['Comentarios']) ? trim($_POST['Comentarios']) : '';

$fecha_hora = date('d/m/Y H:i:s');

$nombre      = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
$apellido    = htmlspecialchars($apellido, ENT_QUOTES, 'UTF-8');
$mail        = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
$comentarios = nl2br(htmlspecialchars($comentarios, ENT_QUOTES, 'UTF-8'));

$registro  = "<article class=\"comentario\">\n";
$registro .= "\t<p><strong>Fecha y hora:</strong> $fecha_hora</p>\n";
$registro .= "\t<p><strong>Nombre:</strong> $nombre</p>\n";
$registro .= "\t<p><strong>Apellido:</strong> $apellido</p>\n";
$registro .= "\t<p><strong>Mail:</strong> $mail</p>\n";
$registro .= "\t<p><strong>Comentario:</strong> $comentarios</p>\n";
$registro .= "</article>\n";

$archivo = fopen("comentarios.txt", "a");
fwrite($archivo, $registro);
fclose($archivo);

header("Location: unidad3.php?ok");
exit;
?>
