<?php
class usuarios {
	private $nombre;
	private $apellido;
	private $fecha_nacimiento;

	function __construct($nombre, $apellido, $fecha_nacimiento) {
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->fecha_nacimiento = $fecha_nacimiento;
	}

	private function calcular_edad() {
		$nacimiento = new DateTime($this->fecha_nacimiento);
		$hoy = new DateTime();
		$diferencia = $hoy->diff($nacimiento);
		return $diferencia->y;
	}

	function imprime_caracteristicas() {
		echo "<div class='ficha-usuario'>";
		echo "<p><strong>Nombre:</strong> " . $this->nombre . "</p>";
		echo "<p><strong>Apellido:</strong> " . $this->apellido . "</p>";
		echo "<p><strong>Edad:</strong> " . $this->calcular_edad() . " años</p>";
		echo "</div>";
	}
}
?>
