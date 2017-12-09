<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="nombre_usuario", columns={"nombre_usuario"}), @ORM\UniqueConstraint(name="nombre_usuario_2", columns={"nombre_usuario"})})
 * @ORM\Entity
 */
class Usuarios implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_usuario", type="string", length=255, nullable=false)
     */
    private $nombreUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasena_usuario", type="string", length=255, nullable=false)
     */
    private $contrasenaUsuario;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado_usuario", type="boolean", nullable=false)
     */
    private $estadoUsuario = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function getId() {
        return $this->id;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function getEstadoUsuario() {
        return $this->estadoUsuario;
    }

    public function getContrasenaUsuario() {
        return $this->contrasenaUsuario;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setEstadoUsuario($estadoUsuario) {
        $this->estadoUsuario = $estadoUsuario;
    }

    public function setContrasenaUsuario($contrasenaUsuario) {
        $this->contrasenaUsuario = $contrasenaUsuario;
    }

    public function getRoles()
    {
        return array();
    }

    public function getPassword()
    {
        return $this->contrasenaUsuario;
    }

    public function getSalt()
    {
        return NULL;
    }

    public function getUsername()
    {
        return $this->nombreUsuario;
    }

    public function eraseCredentials()
    {
    }

}
