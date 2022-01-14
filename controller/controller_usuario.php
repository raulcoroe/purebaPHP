<?php

function registrarUsuario(){
    require ('model/model_usuario.php');

    //Se comprueba que los campos sean correctos y se crea un nuevo usuario
    if (isset($_POST['submit'])) {
        $usuario = new Usuario($_POST['user'], $_POST['password'], $_POST['email']);
        if ($usuario->comprobaciones() !== false) {
            $usuario->nuevo();
            header("Location:index.php");
        }
    }
    include "view/user_register.php";
}

function logIn(){
    require ('model/model_usuario.php');
    require "sesion.php";

    //Verificacion de que el usuario existe al hacer login y se crea una nueva sesion
    if (isset($_POST['submit'])) {
        //Verificamos alias, contraseña y creamos la sesión
        $usuario = new Usuario($_POST['alias'], $_POST['password'], null);
        if ($usuario->verificar($_POST['alias'], $_POST['password'])) {
            $sesion = new Sesion();
            $sesion->set('alias', ($_POST['alias']));
            header("Location:index.php");
        } else {
            echo "<div class='form'>Nombre de usuario o contraseña incorrectos.</div>";
        }
    }

}


?>
