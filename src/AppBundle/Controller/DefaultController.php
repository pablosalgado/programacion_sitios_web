<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \mysqli;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
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

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
