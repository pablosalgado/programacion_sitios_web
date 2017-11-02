<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OperacionesController extends Controller
{
    /**
     * @Route("/operaciones")
     */
    public function operacionesForm()
    {
        $post = Request::createFromGlobals();

        $operando1 = $post->request->get('operando1');
        $operando2 = $post->request->get('operando2');
        $operacion = $post->request->get('operacion');

        $selected1 = "";
        $selected2 = "";
        $selected3 = "";
        $selected4 = "";

        if ($post->request->has('submit')) {
            if (strcmp($operacion, "/") == 0 and $operando2 ==  0) {
                $resultado1 = "No se puede dividir entre cero.";
            } else if (strcmp($operacion, "+") == 0) {
                $resultado1 = $operando1 + $operando2;
                $selected1 = "selected";
            } else if (strcmp($operacion, "-") == 0) {
                $resultado1 = $operando1 - $operando2;
                $selected2 = "selected";
            } else if (strcmp($operacion, "*") == 0) {
                $resultado1 = $operando1 * $operando2;
                $selected3 = "selected";
            } else if (strcmp($operacion, "/") == 0) {
                $resultado1 = $operando1 / $operando2;
                $selected4 = "selected";
            }
        } else {
            $resultado1 = 'Ingrese dos valores y una operación a realizar.';
            $operando1 = 0;
            $operando2 = 0;
        }

        if ($operando1 > $operando2) {
            $resultado2 = "El operando 1 es mayor que el operando 2.";
        } else if($operando1 < $operando2) {
            $resultado2 = "El operando 1 es menor que el operando 2.";
        } else {
            $resultado2 = "Los dos operandos son iguales.";
        }

        $resultado3 = "";
        for ($i = 1; $i < 25; $i++) {
            $resultado3 .= $i." ";
        }

        return $this->render(
          'Operaciones/operaciones.html.twig',
          array(
            'resultado1' => $resultado1,
            'resultado2' => $resultado2,
            'resultado3' => $resultado3,
            'operando1'  => $operando1,
            'operando2'  => $operando2,
            'selected1'  => $selected1,
            'selected2'  => $selected2,
            'selected3'  => $selected3,
            'selected4'  => $selected4
          )
        );
    }
}
