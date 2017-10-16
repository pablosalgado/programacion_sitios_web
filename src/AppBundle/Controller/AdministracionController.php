<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class AdministracionController extends Controller
{
    /**
     * @Route("/administracion")
     */
    public function administracionForm(Request $request)
    {
        $post = Request::createFromGlobals();

        return $this->render(
            'Administracion/administracion.html.twig',
            array()
        );
    }

}
