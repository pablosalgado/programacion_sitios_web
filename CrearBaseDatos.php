<?php
$servername = "localhost";
$username = "root";
$password = "12345678";

// Establecer conexión al servidor MySQL local
$conn = new mysqli($servername, $username, $password);
// Abortar si no se puede establecer conexión al servidor
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// Crear la base de datos
$sql = "CREATE DATABASE IF NOT EXISTS bdunad24";
if ($conn->query($sql) === TRUE) {
   echo "Base de datos creada éxitosamente";
} else {
   echo "Ocurrió un error al crear la base de datos: " . $conn->error;
}

$conn->close();
?>
