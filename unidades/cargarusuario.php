<?php
include('registro.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: unidad8.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($contrasena) < 6) {
    header('Location: unidad8.php?registro=datos-invalidos');
    exit;
}

try {
    $registro = new Registro();
    if ($registro->registrar($email, $contrasena)) {
        header('Location: unidad8.php?registro=ok');
        exit;
    }
} catch (RuntimeException $e) {
    // El mensaje visible no expone detalles de conexión ni de la base.
}

header('Location: unidad8.php?registro=error');
exit;
?>