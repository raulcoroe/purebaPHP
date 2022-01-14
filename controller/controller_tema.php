
<?php
function listarTemas(){
    iniciarSesion();
    require "model/model_tema.php";
    require "model/model_usuario.php";

    $usuario = new usuario(null, null, null);
    $tema1 = new tema(null, null);
    $mensajes = $tema1->mostrarTemas();
    include "view/listar_temas.php";
}

function eliminarTemaController(){
    iniciarSesion();
    require "model/model_tema.php";
    require "model/model_usuario.php";

    $usuario = new usuario(null, null, null);
    $tema1 = new tema(null, null);

    if (isset($_GET['id']) && isset($_GET['usuario'])) {
        if (isset($_SESSION['alias'])) {
            if ($_SESSION['alias'] == $usuario->getAliasById($_GET['usuario'])) {
                $id_tema = $_GET['id'];
                $tema1->eliminarTema($id_tema);
                header("Location:index.php");
            } else {

                echo '<script>alert("Solo puede borrar el tema el usuario que lo haya creado");
                        window.location.href="listarTemas.php"</script>';

            }
        } else {
            echo '<script>alert("Debes iniciar sesion para borrar los temas");window.location.href="index.php"</script>';

        }
    }

}

function iniciarSesion(){
    require "sesion.php";
    $Sesion = new Sesion();
}

function formularioanadir(){
    iniciarSesion();
    require "view/anadir_tema.php";
}

function anadirTema() {
    iniciarSesion();
    require "model/model_tema.php";
    require "model/model_usuario.php";


    if (isset($_SESSION['alias'])) {                                //Comprueba que la sesion este iniciada
        if (isset($_POST['submit']) && !empty($_POST['titulo'])) {   ////Comprueba que hay texto en el titulo y que se ha pulsado el boton de submit
            $usuario = new usuario(null, null, null);
            $id_usuario = $usuario->getId($_SESSION['alias']);
            $tema = new tema($id_usuario, $_POST['titulo']);
            $tema->crearTema();
            header("Location:index.php");
        } else {
            echo '<script>alert("Debes ponerle un titulo al tema");window.location.href="index.php?action=listarTemas&controller=controller_tema"</script>';
        }
    } else {
        echo '<script>alert("Debes iniciar sesion para poder continuar");window.location.href="index.php?action=listarTemas&controller=controller_tema"</script>';
    }

}
?>