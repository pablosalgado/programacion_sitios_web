<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use \mysqli;

class ConsultaController extends Controller
{
    /**
     * @Route("/consulta")
     */
    public function consultaForm()
    {
        $servername = "localhost";
        $username = "root";
        $password = "12345678";
        $dbname = "bdunad24";

        $post = Request::createFromGlobals();

        $registro = $post->request->get('registro');

        $retArray = array(
          'nombres' => '',
          'apellidos' => '',
          'registro' => '',
          'identificacion' => '',
          'telefono' => '',
          'email' => '',
          'direccion' => '',
          'especialidad' => '',
          'hospital' => ''
        );

        if ($post->request->has('submit')) {
          // Establecer conexión al servidor MySQL local
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Abortar si no se puede establecer conexión al servidor
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = 'SELECT * FROM `tabla24` WHERE `registro` = ' . $registro . ';';

          // echo $sql;

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $retArray['nombres'] = $row['nombres'];
            $retArray['apellidos'] = $row['apellidos'];
            $retArray['registro'] = $row['registro'];
            $retArray['identificacion'] = $row['identificacion'];
            $retArray['telefono'] = $row['telefono'];
            $retArray['email'] = $row['email'];
            $retArray['direccion'] = $row['direccion'];
            $retArray['especialidad'] = $row['especialidad'];
            $retArray['hospital'] = $row['hospital'];
            $retArray['resultado'] = '1';
          } else {
            $retArray['resultado'] = '0';
          }

          $conn->close();
        }

        return $this->render(
            'Consulta/consulta.html.twig', $retArray
        );
    }

}
