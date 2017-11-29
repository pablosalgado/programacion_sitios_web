<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use \mysqli;
use \fpdf;

class ReportesController extends Controller
{
    /**
     * @Route("/reportes")
     */
    public function reportesForm(Request $request)
    {
        $servername = "localhost";
        $username = "root";
        $password = "12345678";
        $dbname = "bdunad24";

        $post = Request::createFromGlobals();

        $retArray = array(
        );

        // Establecer conexión al servidor MySQL local
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Abortar si no se puede establecer conexión al servidor
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = 'SELECT * FROM `tabla24`;';
        $result = $conn->query($sql);

        // echo $sql;
        require('fpdf/fpdf.php');
        $pdf = new FPDF("L", "mm", array(400, 650));
        $pdf->AddPage();
        $pdf->SetFont('Courier', '', 10);

        // foreach($header as $heading) {
        //   foreach($heading as $column_heading)
        //     $pdf->Cell(90,12,$column_heading,1);
        // }

        foreach($result as $row) {
          $pdf->SetFont('Courier', '', 10);
          $pdf->Ln();
          foreach($row as $column)
            $pdf->Cell(70, 10, $column, 1);
        }

        $pdf->Output("F", "reporte.pdf");

        $result = $conn->query($sql);

        if ($conn->query($sql) === TRUE) {
            $retArray['resultado'] = "Datos eliminados éxitosamente";
        } else {
            $retArray['error'] = "Ocurrió un error al eliminar los datos: " . $conn->error;
        }

        $conn->close();

        return $this->render(
            'Reportes/reportes.html.twig', $retArray
        );
    }

}
