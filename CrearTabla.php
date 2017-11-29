<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "bdunad24";

// Establecer conexión al servidor MySQL local
$conn = new mysqli($servername, $username, $password, $dbname);

// Abortar si no se puede establecer conexión al servidor
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// sql para crear la taba
$sql = "CREATE TABLE IF NOT EXISTS tabla24 (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombres VARCHAR(30) NOT NULL,
  apellidos VARCHAR(30) NOT NULL,
  registro INT UNSIGNED NOT NULL,
  identificacion INT UNSIGNED NOT NULL,
  telefono VARCHAR(30) NOT NULL,
  email VARCHAR(50),
  direccion VARCHAR(50),
  especialidad VARCHAR(50),
  hospital VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
   echo "Tabla creada éxitosamente";
} else {
   echo "Ocurrió un error al crear la tabla: " . $conn->error;
}

$conn->close();
?>
