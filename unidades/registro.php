<?php
require_once __DIR__ . '/../config.php';

class Registro {
    private $conexion;

    public function __construct() {
        $this->conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (!$this->conexion) {
            throw new RuntimeException('No se pudo conectar con la base de datos.');
        }

        mysqli_set_charset($this->conexion, 'utf8mb4');
    }

    public function registrar($email, $contrasena) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $consulta = mysqli_prepare(
            $this->conexion,
            'INSERT INTO registro (email, contrasena) VALUES (?, ?)'
        );

        if (!$consulta) {
            throw new RuntimeException('No se pudo consultar la tabla de registro.');
        }

        mysqli_stmt_bind_param($consulta, 'ss', $email, $hash);
        $resultado = mysqli_stmt_execute($consulta);
        mysqli_stmt_close($consulta);

        return $resultado;
    }

    public function verificar($email, $contrasena) {
        $consulta = mysqli_prepare(
            $this->conexion,
            'SELECT contrasena FROM registro WHERE email = ? LIMIT 1'
        );

        if (!$consulta) {
            throw new RuntimeException('No se pudo consultar la tabla de registro.');
        }

        mysqli_stmt_bind_param($consulta, 's', $email);
        mysqli_stmt_execute($consulta);
        mysqli_stmt_bind_result($consulta, $hash);
        $existe = mysqli_stmt_fetch($consulta);
        mysqli_stmt_close($consulta);

        return $existe && password_verify($contrasena, $hash);
    }

    public function __destruct() {
        if ($this->conexion) {
            mysqli_close($this->conexion);
        }
    }
}
?>