<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class ReportesController extends Controller
{
    /**
     * @Route("/reportes")
     */
    public function reportesForm(Request $request)
    {
        $post = Request::createFromGlobals();

        $identificacion = $post->request->get('identificacion');
        $nombres = $post->request->get('nombres');
        $apellidos = $post->request->get('apellidos');
        $email = $post->request->get('email');
        $clave = $post->request->get('clave');
        $telefono = $post->request->get('telefono');
        $resultado = '';
        $retArray = array(
            'identificacion'  => '',
            'nombres'  => '',
            'apellidos'  => '',
            'email'  => '',
            'clave'  => '',
            'telefono'  => ''
        );

        if ($post->request->has('submit')) {
            // El directorio raíz del sitio web. En este se va a crear un directorio
            // 'archivos/reportes' si no existe, para guardar allí los archivos
            // generados.
            $raiz = $request->server->get('DOCUMENT_ROOT').$request->getBasePath();

            // Instanciar el manejo del sistema de archivos de Symfony
            $fs = new Filesystem();

            // Crear el directorio de archivos
            $directorioArchivos = $raiz . '/archivos/reportes';
            $fs->mkdir($directorioArchivos);

            // La lista de archivos sin incluir los directorios: '.' y '..'
            // $files = array_diff(scandir($directorioArchivos), array('..', '.'));
            // print_r($files)

            // Se crea el archivo de texto. El nombre del archivo es el número
            // de identificacion.
            $archivo = fopen($directorioArchivos . '/' . $identificacion . '.txt', 'w');

            // Se escriben los datos
            $txt = 'Número de identificacion: ' . $identificacion . PHP_EOL;
            fwrite($archivo, $txt);

            $txt = 'Nombres: ' . $nombres . PHP_EOL;
            fwrite($archivo, $txt);

            $txt = 'Apellidos: ' . $apellidos . PHP_EOL;
            fwrite($archivo, $txt);

            $txt = 'Correo electrónico: ' . $email . PHP_EOL;
            fwrite($archivo, $txt);

            $txt = 'Contraseña: ' . $clave . PHP_EOL;
            fwrite($archivo, $txt);

            $txt = 'Teléfono: ' . $telefono . PHP_EOL;
            fwrite($archivo, $txt);

            fclose($archivo);

            $resultado = $identificacion . '.txt';

            // Como se ha creado con éxito el archivo, se puede borrar los campos
            // del formulario.
            $identificacion = '';
            $nombres = '';
            $apellidos = '';
            $email = '';
            $clave = '';
            $telefono = '';

            // Se inserta el mensaje de éxito.
            $retArray = array(
                'identificacion'  => $identificacion,
                'nombres'  => $nombres,
                'apellidos'  => $apellidos,
                'email'  => $email,
                'clave'  => $clave,
                'telefono'  => $telefono,
                'resultado' => $resultado
            );
        }

        return $this->render(
            'Reportes/reportes.html.twig', $retArray
        );
    }

}
