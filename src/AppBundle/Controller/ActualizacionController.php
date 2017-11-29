<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use \mysqli;

class ActualizacionController extends Controller
{
    /**
     * @Route("/actualizacion")
     */
    public function actualizacionForm(Request $request)
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

          $sql = 'UPDATE `tabla24` SET ';
          $sql .= '`nombres` = "' . $nombres . '", ';
          $sql .= '`apellidos` = "' . $apellidos . '", ';
          $sql .= '`identificacion` = "' . $identificacion . '", ';
          $sql .= '`telefono` = "' . $telefono . '", ';
          $sql .= '`email` = "' . $email . '", ';
          $sql .= '`direccion` = "' . $direccion . '", ';
          $sql .= '`especialidad` = "' . $especialidad . '", ';
          $sql .= '`hospital` = "' . $hospital . '" ';
          $sql .= ' WHERE `registro` = ' . $registro;

          // echo $sql;

          if ($conn->query($sql) === TRUE) {
              $retArray['resultado'] = "Datos actualizados éxitosamente";
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
              $retArray['error'] = "Ocurrió un error al actualizar los datos: " . $conn->error;
          }
        }

        return $this->render(
            'Actualizacion/actualizacion.html.twig', $retArray
        );
    }

}
