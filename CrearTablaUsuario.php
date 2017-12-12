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

// sql para crear la tabla
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(255) NOT NULL,
    contrasena_usuario VARCHAR(255) NOT NULL,
    estado_usuario BOOLEAN NOT NULL DEFAULT 1
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla creada éxitosamente";
} else {
    echo "Ocurrió un error al crear la tabla: " . $conn->error;
}

$sql = "ALTER TABLE `usuarios` ADD UNIQUE( `nombre_usuario`);";

if ($conn->query($sql) === TRUE) {
    echo "Tabla actualizada éxitosamente";
} else {
    echo "Ocurrió un error al actualizar la tabla: " . $conn->error;
}

$sql = "INSERT INTO `usuarios` (`nombre_usuario`, `contrasena_usuario`) VALUES (
    'admin',
    '$2y$13\$EjIteG4JXFgFfGmCdE8imOt3f.glM5eIQxaL4s2Wv8vbovHgqnb4O');"; // 12345678

if ($conn->query($sql) === TRUE) {
    echo "Usuario administrador creado éxitosamente";
} else {
    echo "Ocurrió un error al crear el usuario: " . $conn->error;
}

$conn->close();
?>
