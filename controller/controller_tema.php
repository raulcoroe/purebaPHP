<?php

function listarTemas(){
    iniciarSesion();
    require "model/model_tema.php";
    $usuario = new usuario(null, null, null);
    $tema1 = new tema(null, null);
    $mensajes = $tema1->mostrarTemas();
    include "view/listar_temas.php";
}

function eliminarTemaController(){
    iniciarSesion();
    require "model/model_tema.php";
    $usuario = new usuario(null, null, null);
    $tema1 = new tema(null, null);

    if (isset($_GET['id']) && isset($_GET['usuario'])) {
        if (isset($_SESSION['alias'])) {
            if ($_SESSION['alias'] == $usuario->getAliasById($_GET['usuario'])) {
                $id_tema = $_GET['id'];
                $tema1->eliminarTema($id_tema);
            } else {
                echo '<div> No se puede borrar porque ha sido creado por otro usuario </div>';
            }
        } else {
            echo '<div> Debes iniciar sesion para modificar los temas </div>';
        }
    }
    header("Location:index.php");
}

function iniciarSesion(){
    require "sesion.php";
    $Sesion = new Sesion();
}

?>