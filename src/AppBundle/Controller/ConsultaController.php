<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class ConsultaController extends Controller
{
    /**
     * @Route("/consulta")
     */
    public function consultaForm()
    {
        $post = Request::createFromGlobals();

        return $this->render(
            'Consulta/consulta.html.twig',
            array(
                'registro' => '',
            )
        );
    }

}
