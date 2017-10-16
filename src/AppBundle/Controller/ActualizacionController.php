<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class ActualizacionController extends Controller
{
    /**
     * @Route("/actualizacion")
     */
    public function actualizacionForm(Request $request)
    {
        $post = Request::createFromGlobals();

        return $this->render(
            'Actualizacion/actualizacion.html.twig',
            array(
                'nombres' => '',
                'apellidos' => '',
                'registro' => '',
                'identificacion' => '',
                'telefono' => '',
                'email' => '',
                'direccion' => '',
                'especialidad' => '',
                'hospital' => '',
                'nombre' => '',
            )
        );
    }

}
