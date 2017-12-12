<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use \mysqli;

class SecurityController extends Controller
{
    /**
    * @Route("/login", name="login")
    */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        $this->initDatabase();

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('Security/login.html.twig', array(
          'last_username' => $lastUsername,
          'error'        => $error,
        ));
    }

    private function initDatabase() {
        $servername = "localhost";
        $username = "root";
        $password = "12345678";
        $dbname = "bdunad24";

        // Establecer conexión al servidor MySQL local
        $conn = new mysqli($servername, $username, $password);

        // Abortar si no se puede establecer conexión al servidor
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Crear la base de datos
        $sql = "CREATE DATABASE IF NOT EXISTS bdunad24";
        if ($conn->query($sql) === TRUE) {
            // echo "Base de datos creada éxitosamente";
        } else {
            // echo "Ocurrió un error al crear la base de datos: " . $conn->error;
        }

        $conn->close();

        // Establecer conexión al servidor MySQL local
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Abortar si no se puede establecer conexión al servidor
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Crear la tabla
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
          // echo "Tabla creada éxitosamente";
        } else {
          // echo "Ocurrió un error al crear la tabla: " . $conn->error;
        }

        // sql para crear la tabla de usuarios
        $sql = "CREATE TABLE IF NOT EXISTS usuarios (
           id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
           nombre_usuario VARCHAR(255) NOT NULL UNIQUE KEY,
           contrasena_usuario VARCHAR(255) NOT NULL,
           estado_usuario BOOLEAN NOT NULL DEFAULT 1
        )";

        if ($conn->query($sql) === TRUE) {
           // echo "Tabla creada éxitosamente";
        } else {
           // echo "Ocurrió un error al crear la tabla: " . $conn->error;
        }

        // Se crea el usuario administrado sólo la primera vez
        $sql = "SELECT * FROM `usuarios` WHERE `nombre_usuario` = 'admin';";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
           $sql = "INSERT INTO `usuarios` (`nombre_usuario`, `contrasena_usuario`) VALUES (
              'admin',
              '$2y$13\$EjIteG4JXFgFfGmCdE8imOt3f.glM5eIQxaL4s2Wv8vbovHgqnb4O');"; // 12345678

           if ($conn->query($sql) === TRUE) {
              echo "Usuario administrador creado éxitosamente";
           } else {
              echo "Ocurrió un error al crear el usuario: " . $conn->error;
           }
        }

        $conn->close();
    }
}
