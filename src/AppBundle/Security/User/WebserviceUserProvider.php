<?php

namespace AppBundle\Security\User;

use AppBundle\Security\User\WebserviceUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use \mysqli;

class WebserviceUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($userName)
    {
        $servername = "localhost";
        $username = "root";
        $password = "12345678";
        $dbname = "bdunad24";

        // Establecer conexión al servidor MySQL local
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Abortar si no se puede establecer conexión al servidor
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Buscar eL usuario en la base de datos
        $sql = "SELECT * FROM `usuarios` WHERE `nombre_usuario` = '" . $userName . "';";

        $result = $conn->query($sql);

        $userName = '';
        $userPassword = '';
        $userStatus = false;
        $userData = false;

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();

          $userName = $row['nombre_usuario'];
          $userPassword = $row['contrasena_usuario'];
          $userStatus = $row['estado_usuario'] == 1;
          $userData = true;
        }

        $conn->close();

        if ($userData && $userStatus) {
            $salt = NULL;
            $roles = array('ROLE_ADMIN');

            return new WebserviceUser($userName, $userPassword, $salt, $roles);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $userName)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return WebserviceUser::class === $class;
    }
}
