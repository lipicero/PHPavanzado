<?php
include("usuarios.php");

$usuario = new usuarios("Luis", "Klug", "2000-01-29");
$usuario1 = new usuarios("Marcos", "García", "2001-01-29");
$usuario->imprime_caracteristicas();
$usuario1->imprime_caracteristicas();
?>
