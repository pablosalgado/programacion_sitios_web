<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use \mysqli;

class AdministracionController extends Controller
{
    /**
     * @Route("/administracion")
     */
    public function administracionForm(Request $request)
    {
        $servername = "localhost";
        $username = "root";
        $password = "12345678";
        $dbname = "bdunad24";

        $backup_file = $dbname . '.sql';
        $command = "mysqldump --opt -h $servername -u $username -p $password " . " $dbname > $backup_file";
        system($command);

        $post = Request::createFromGlobals();

        $registro = $post->request->get('registro');

        $retArray = array(
          'registro' => ''
        );

        if ($post->request->has('submit')) {
          // Establecer conexión al servidor MySQL local
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Abortar si no se puede establecer conexión al servidor
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = 'DELETE FROM `tabla24` WHERE `registro` = ' . $registro . ';';

          // echo $sql;

          $result = $conn->query($sql);

          if ($conn->query($sql) === TRUE) {
              $retArray['resultado'] = "Datos eliminados éxitosamente";
          } else {
              $retArray['error'] = "Ocurrió un error al eliminar los datos: " . $conn->error;
          }

          $conn->close();
        }

        return $this->render(
            'Administracion/administracion.html.twig', $retArray
        );
    }

}
