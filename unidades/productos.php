<?php
require_once __DIR__ . '/../config.php';

class producto {
	private $id_producto;
	private $nombre;
	private $descripcion;
	private $precio;
	private $conexion;

	function __construct($nombre = '', $descripcion = '', $precio = 0, $id_producto = 0) {
		$this->conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->precio = $precio;
		$this->id_producto = $id_producto;
	}

	function introducir_producto() {
		$nombre = mysqli_real_escape_string($this->conexion, $this->nombre);
		$descripcion = mysqli_real_escape_string($this->conexion, $this->descripcion);
		$precio = (float) $this->precio;

		$consulta = "INSERT INTO productos (nombre, descripcion, precio)
			VALUES ('$nombre', '$descripcion', $precio)";
		return mysqli_query($this->conexion, $consulta);
	}

	function eliminar_producto() {
		$id = (int) $this->id_producto;
		$consulta = "DELETE FROM productos WHERE id_producto = $id";
		return mysqli_query($this->conexion, $consulta);
	}

	function listar_producto() {
		$consulta = mysqli_query($this->conexion, "SELECT * FROM productos ORDER BY id_producto ASC");

		if (!$consulta || mysqli_num_rows($consulta) == 0) {
			echo "<p>No hay productos cargados.</p>";
			return;
		}

		echo "<table class='tabla-productos'>";
		echo "<thead><tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Descripción</th>
			<th>Precio</th>
			<th>Acción</th>
		</tr></thead><tbody>";

		while ($fila = mysqli_fetch_assoc($consulta)) {
			$id = (int) $fila['id_producto'];
			$nombre = htmlspecialchars($fila['nombre']);
			$descripcion = htmlspecialchars($fila['descripcion']);
			$precio = number_format((float) $fila['precio'], 1, ',', '.');

			echo "<tr>";
			echo "<td>$id</td>";
			echo "<td>$nombre</td>";
			echo "<td>$descripcion</td>";
			echo "<td>\$$precio</td>";
			echo "<td>
				<form method='post' action='unidad7.php' style='margin:0;'>
					<input type='hidden' name='id_producto' value='$id'>
					<input type='submit' name='eliminar' value='Eliminar' class='btn-eliminar'>
				</form>
			</td>";
			echo "</tr>";
		}

		echo "</tbody></table>";
	}

	function __destruct() {
		if ($this->conexion) {
			mysqli_close($this->conexion);
		}
	}
}
?>
