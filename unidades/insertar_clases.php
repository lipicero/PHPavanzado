<?php
require_once __DIR__ . '/../config.php';

mysqli_report(MYSQLI_REPORT_OFF);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: unidad1.php');
    exit;
}

$unidad = isset($_POST['unidad']) && is_string($_POST['unidad']) ? trim($_POST['unidad']) : '';
$fecha = isset($_POST['fecha']) && is_string($_POST['fecha']) ? trim($_POST['fecha']) : '';
$cantidadCaracteres = preg_match_all('/./us', $unidad);

$fechaValida = preg_match('/^\d{4}-\d{2}-\d{2}$/D', $fecha) === 1;
if ($fechaValida) {
    $partesFecha = explode('-', $fecha);
    $fechaValida = checkdate((int) $partesFecha[1], (int) $partesFecha[2], (int) $partesFecha[0]);
}

if ($unidad === '' || $cantidadCaracteres === false || $cantidadCaracteres > 30 || !$fechaValida) {
    header('Location: unidad1.php?error=datos');
    exit;
}

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conexion) {
    header('Location: unidad1.php?error=conexion');
    exit;
}

mysqli_set_charset($conexion, 'utf8mb4');

$crearTabla = "CREATE TABLE IF NOT EXISTS clases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    unidad VARCHAR(30) NOT NULL,
    fecha DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$estructura = mysqli_query($conexion, "SHOW COLUMNS FROM clases");
$tipoUnidad = "";
$tipoFecha = "";
if ($estructura) {
    while ($columna = mysqli_fetch_assoc($estructura)) {
        if ($columna['Field'] === 'unidad') {
            $tipoUnidad = strtoupper($columna['Type']);
        }
        if ($columna['Field'] === 'fecha') {
            $tipoFecha = strtoupper($columna['Type']);
        }
    }
}

if ($tipoUnidad === '' || $tipoFecha === '' || strpos($tipoUnidad, 'VARCHAR') === false || strpos($tipoFecha, 'DATE') === false) {
    mysqli_query($conexion, "DROP TABLE IF EXISTS clases");
    if (!mysqli_query($conexion, $crearTabla)) {
        mysqli_close($conexion);
        header('Location: unidad1.php?error=tabla');
        exit;
    }
}

$consulta = mysqli_prepare($conexion, 'INSERT INTO clases (unidad, fecha) VALUES (?, ?)');
if (!$consulta) {
    mysqli_close($conexion);
    header('Location: unidad1.php?error=insertar');
    exit;
}

mysqli_stmt_bind_param($consulta, 'ss', $unidad, $fecha);
$insertado = mysqli_stmt_execute($consulta);
mysqli_stmt_close($consulta);
mysqli_close($conexion);

if (!$insertado) {
    header('Location: unidad1.php?error=insertar');
    exit;
}

header('Location: unidad1.php?ok=1');
exit;