<?php
require_once __DIR__ . '/../config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: unidad5.php');
	exit;
}

$captcha_ingresado = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';
$captcha_sesion = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';

unset($_SESSION['captcha']);

if ($captcha_sesion === '' || strcasecmp($captcha_ingresado, $captcha_sesion) !== 0) {
	header('Location: unidad5.php?error');
	exit;
}

$nombre   = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$consulta = isset($_POST['consulta']) ? trim($_POST['consulta']) : '';

if ($nombre === '' || $apellido === '' || $email === '' || $consulta === '') {
	header('Location: unidad5.php?error');
	exit;
}

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conexion) {
	header('Location: unidad5.php?error');
	exit;
}

$nombre   = mysqli_real_escape_string($conexion, $nombre);
$apellido = mysqli_real_escape_string($conexion, $apellido);
$email    = mysqli_real_escape_string($conexion, $email);
$consulta = mysqli_real_escape_string($conexion, $consulta);

mysqli_query($conexion, "INSERT INTO consultas (nombre, apellido, email, consulta) VALUES ('$nombre', '$apellido', '$email', '$consulta')");
mysqli_close($conexion);

header('Location: unidad5.php?ok');
exit;
?>
