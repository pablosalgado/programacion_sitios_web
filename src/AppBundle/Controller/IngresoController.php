<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use \mysqli;

class IngresoController extends Controller
{

    /**
     * @Route("/ingreso")
     */
    public function ingresoForm(Request $request)
    {
        $servername = "localhost";
        $username = "root";
        $password = "12345678";
        $dbname = "bdunad24";

        $post = Request::createFromGlobals();

        $nombres = $post->request->get('nombres');
        $apellidos = $post->request->get('apellidos');
        $registro = $post->request->get('registro');
        $identificacion = $post->request->get('identificacion');
        $telefono = $post->request->get('telefono');
        $email = $post->request->get('email');
        $direccion = $post->request->get('direccion');
        $especialidad = $post->request->get('especialidad');
        $hospital = $post->request->get('hospital');

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
              $retArray['nombres'] = $nombres;
              $retArray['apellidos'] = $apellidos;
              $retArray['registro'] = $registro;
              $retArray['identificacion'] = $identificacion;
              $retArray['telefono'] = $telefono;
              $retArray['email'] = $email;
              $retArray['direccion'] = $direccion;
              $retArray['especialidad'] = $especialidad;
              $retArray['hospital'] = $hospital;
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = 'INSERT INTO `tabla24` (`nombres`, `apellidos`, `registro`, `identificacion`, `telefono`, `email`, `direccion`, `especialidad`, `hospital`)';
          $sql .= ' VALUES(';
          $sql .= '"' . $nombres . '", ';
          $sql .= '"' . $apellidos . '", ';
          $sql .= '"' . $registro . '", ';
          $sql .= '"' . $identificacion . '", ';
          $sql .= '"' . $telefono . '", ';
          $sql .= '"' . $email . '", ';
          $sql .= '"' . $direccion . '", ';
          $sql .= '"' . $especialidad . '", ';
          $sql .= '"' . $hospital . '");';

          // echo $sql;

          if ($conn->query($sql) === TRUE) {
              $retArray['resultado'] = "Datos insertados éxitosamente";
          } else {
              $retArray['nombres'] = $nombres;
              $retArray['apellidos'] = $apellidos;
              $retArray['registro'] = $registro;
              $retArray['identificacion'] = $identificacion;
              $retArray['telefono'] = $telefono;
              $retArray['email'] = $email;
              $retArray['direccion'] = $direccion;
              $retArray['especialidad'] = $especialidad;
              $retArray['hospital'] = $hospital;
              $retArray['error'] = "Ocurrió un error al insertar los datos: " . $conn->error;
          }
        }

        return $this->render(
            'Ingreso/ingreso.html.twig', $retArray
        );
    }

}
