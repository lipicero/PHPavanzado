<?php
include('registro.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: unidad8.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';
$resultado = 'error';

if (filter_var($email, FILTER_VALIDATE_EMAIL) && $contrasena !== '') {
    try {
        $registro = new Registro();
        $resultado = $registro->verificar($email, $contrasena) ? 'ok' : 'incorrecto';
    } catch (RuntimeException $e) {
        $resultado = 'error';
    }
}

header('Location: unidad8.php?ingreso=' . $resultado);
exit;
?>