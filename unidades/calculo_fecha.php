<?php
$dia = filter_input(INPUT_POST, 'dia', FILTER_VALIDATE_INT);
$mes = filter_input(INPUT_POST, 'mes', FILTER_VALIDATE_INT);
$anio = filter_input(INPUT_POST, 'anio', FILTER_VALIDATE_INT);

if ($dia === false || $mes === false || $anio === false || $dia < 1 || $mes < 1 || $anio < 1) {
    $diaActual = $_POST['dia'] ?? '';
    $mesActual = $_POST['mes'] ?? '';
    $anioActual = $_POST['anio'] ?? '';
    header("Location: unidad2.php?error=fecha_invalida&dia=" . urlencode((string) $diaActual) . "&mes=" . urlencode((string) $mesActual) . "&anio=" . urlencode((string) $anioActual));
    exit;
}

if (!checkdate($mes, $dia, $anio)) {
    header("Location: unidad2.php?error=fecha_invalida&dia=$dia&mes=$mes&anio=$anio");
    exit;
}

$fechaIngresada = DateTimeImmutable::createFromFormat('!Y-m-d', sprintf('%04d-%02d-%02d', $anio, $mes, $dia));
$fechaActual = new DateTimeImmutable('today');

if ($fechaIngresada === false) {
    header("Location: unidad2.php?error=fecha_invalida&dia=$dia&mes=$mes&anio=$anio");
    exit;
}

$diasDiferencia = (int) $fechaActual->diff($fechaIngresada)->format('%r%a');
header("Location: unidad2.php?dias=$diasDiferencia&dia=$dia&mes=$mes&anio=$anio");
