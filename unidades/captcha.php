<?php
session_start();

$caracteres = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$codigo = '';
for ($i = 0; $i < 5; $i++) {
    $codigo .= $caracteres[random_int(0, strlen($caracteres) - 1)];
}
$_SESSION['captcha'] = $codigo;

$ancho = 160;
$alto = 50;

if (function_exists('imagecreatetruecolor')) {
    $imagen = imagecreatetruecolor($ancho, $alto);
    $fondo = imagecolorallocate($imagen, 245, 245, 245);
    $color_texto = imagecolorallocate($imagen, 80, 40, 40);
    $color_linea = imagecolorallocate($imagen, 180, 180, 180);
    $color_punto = imagecolorallocate($imagen, 160, 160, 160);

    imagefilledrectangle($imagen, 0, 0, $ancho, $alto, $fondo);

    for ($i = 0; $i < 6; $i++) {
        imageline($imagen, random_int(0, $ancho), random_int(0, $alto), random_int(0, $ancho), random_int(0, $alto), $color_linea);
    }

    for ($i = 0; $i < 80; $i++) {
        imagesetpixel($imagen, random_int(0, $ancho), random_int(0, $alto), $color_punto);
    }

    for ($i = 0; $i < strlen($codigo); $i++) {
        imagestring($imagen, 5, 20 + ($i * 26), random_int(12, 22), $codigo[$i], $color_texto);
    }

    header('Content-Type: image/png');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    imagepng($imagen);
    imagedestroy($imagen);
    exit;
}

header('Content-Type: image/svg+xml');
header('Cache-Control: no-store, no-cache, must-revalidate');

$lineas = '';
for ($i = 0; $i < 8; $i++) {
    $x1 = random_int(0, $ancho);
    $y1 = random_int(0, $alto);
    $x2 = random_int(0, $ancho);
    $y2 = random_int(0, $alto);
    $lineas .= '<line x1="' . $x1 . '" y1="' . $y1 . '" x2="' . $x2 . '" y2="' . $y2 . '" stroke="#b0b0b0" stroke-width="1"/>';
}

$circulos = '';
for ($i = 0; $i < 35; $i++) {
    $cx = random_int(0, $ancho);
    $cy = random_int(0, $alto);
    $radio = random_int(1, 3);
    $circulos .= '<circle cx="' . $cx . '" cy="' . $cy . '" r="' . $radio . '" fill="#a0a0a0"/>';
}

$chars = '';
for ($i = 0; $i < strlen($codigo); $i++) {
    $x = 22 + ($i * 26);
    $y = random_int(18, 30);
    $rot = random_int(-20, 20);
    $chars .= '<text x="' . $x . '" y="' . $y . '" transform="rotate(' . $rot . ' ' . $x . ' ' . $y . ')" font-family="Arial, Helvetica, sans-serif" font-size="24" font-weight="bold" fill="#4d2a2a">' . htmlspecialchars($codigo[$i], ENT_QUOTES, 'UTF-8') . '</text>';
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $ancho . '" height="' . $alto . '" viewBox="0 0 ' . $ancho . ' ' . $alto . '">';
echo '<rect width="100%" height="100%" fill="#f5f5f5"/>';
echo $lineas;
echo $circulos;
echo $chars;
echo '</svg>';
?>
