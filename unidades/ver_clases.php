<?php
require_once __DIR__ . '/../config.php';

mysqli_report(MYSQLI_REPORT_OFF);
$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conexion) {
    echo "<p class='mensaje-error'>No se pudo conectar con la base de datos.</p>";
    return;
}

mysqli_set_charset($conexion, "utf8mb4");

$crearTabla = "CREATE TABLE IF NOT EXISTS clases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    unidad VARCHAR(30) NOT NULL,
    fecha DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!mysqli_query($conexion, $crearTabla)) {
    echo "<p class='mensaje-error'>No se pudo preparar la tabla de clases.</p>";
    mysqli_close($conexion);
    return;
}

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
    mysqli_query($conexion, $crearTabla);
}

$consulta = mysqli_query($conexion, "SELECT unidad, fecha FROM clases ORDER BY fecha ASC");
if (!$consulta) {
    echo "<p class='mensaje-error'>No se pudo leer la tabla de clases. Revisa su estado en phpMyAdmin.</p>";
    mysqli_close($conexion);
    return;
}

echo "<div class='contenedor-clases'>";
while ($mostrar = mysqli_fetch_assoc($consulta)) {
?>
    <div class="card-clase">
        <h3>Unidad: <?php echo htmlspecialchars($mostrar['unidad'], ENT_QUOTES, 'UTF-8'); ?></h3>
        <p>Fecha: <?php echo htmlspecialchars($mostrar['fecha'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
<?php
}
echo "</div>";

mysqli_close($conexion);
?>
