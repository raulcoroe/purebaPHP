
<?php
function listarMensajes(){

    iniciarSesion();
    require "model/model_usuario.php";
    require "model/model_mensaje.php";
    $usuario = new usuario(null, null, null);
    $mensaje = new mensaje(null, null, null);
    $mensajes = $mensaje->mostrarMensajes($_GET['id_tema']);
    include "view/listar_mensajes.php";
}

function eliminarMensajeController(){
    iniciarSesion();
    require "model/model_mensaje.php";
    require "model/model_usuario.php";

    $usuario = new usuario(null, null, null);
    $mensaje = new mensaje(null, null, null);

    if (isset($_GET['id']) && isset($_GET['usuario'])) {
        if (isset($_SESSION['alias'])) {
            if ($_SESSION['alias'] == $usuario->getAliasById($_GET['usuario'])) {
                $id_mensaje = $_GET['id'];
                $mensaje->eliminarMensaje($id_mensaje);
            } else {
                echo '<script>alert("Solo puede borrar el mensaje el usuario que lo ha creado");window.location.href="index.php?action=listarMensajes&controller=controller_mensaje"</script>';
            }
        } else {
            echo '<script>alert("Debes iniciar sesion para borrar mensajes");window.location.href="index.php?action=listarMensajes&controller=controller_mensaje"</script>';
        }
    }
    header("Location:index.php");
}

function iniciarSesion(){
    require "sesion.php";
    $Sesion = new Sesion();
}

function formularioAnadirMensaje(){
    iniciarSesion();
    require "view/anadir_mensaje.php";
}

function anadirMensaje() {
    iniciarSesion();
    require "model/model_mensaje.php";
    require "model/model_usuario.php";

    $id_tema = $_GET["id_tema"];
    if (isset($_SESSION['alias'])) {                                //Comprueba que la sesion este iniciada
        if (isset($_POST['submit']) && !empty($_POST['texto'])) {    //Comprueba que el hay texto en el txtarea y que se ha pulsado el boton de submit
            $usuario = new usuario(null, null, null);
            $id_usuario = $usuario->getId($_SESSION['alias']);
            $mensaje = new mensaje($id_usuario, $_GET["id_tema"], $_POST['texto']);
            $mensaje->crearMensaje();
            header("Location:index.php");
        } else {
            echo '<script>alert("Debes introducir texto en el mensajes");window.location.href="index.php?action=listarMensajes&controller=controller_mensaje"</script>';
        }
    } else {
        echo '<script>alert("Debes iniciar sesion para continuar");window.location.href="index.php?action=listarMensajes&controller=controller_mensaje"</script>';
    }


}
?>