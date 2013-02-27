<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);
    
if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    if(isset($_POST['login_username']) && isset($_POST['login_userpass']))
    {
        $usuario = new Usuario();
        $usuario->usuario=$_POST['login_username'];
        $usuario->clave=$_POST['login_userpass'];
        /// Señores no se les olvide encriptar las contraseñas com MD5
        $userlog=DAOFactory::getUsuarioDAO()->queryByUsuario($usuario->usuario, $usuario->clave);
        if($userlog)
        {
            $aux = $userlog[0];
            if ($aux->clave == $usuario->clave)
            {
                $_SESSION['username']=$aux->usuario;
                $_SESSION['userid']=$aux->id;
                echo 1;
            }
            else
            {
                echo "Contraseña Incorrecta";
            }
        }
        else
        {
            echo "Usuario No existe";
        }
    }
    else
    {
       header('Location: ./');
    }
}
else{
    echo "Debe Iniciar Sesión";
}
?>