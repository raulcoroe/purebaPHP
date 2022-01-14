<?php require_once "sesion.php";
$sesion = new Sesion();
$aliasSesion = $_SESSION['alias'];
?>

?>
<!DOCTYPE html>
<html lang="en">

<!--Cabecera del foro-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad de aprendizaje</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
            href="https://fonts.googleapis.com/css2?family=Nerko+One&family=Noto+Sans+JP:wght@300&family=Raleway:ital,wght@1,200&display=swap"
            rel="stylesheet">
    <div class="intro-pagina">
        <div class="logo">
            <img src="../img/logo.png">
        </div>
        <div class="titulo">
            <h1>FORO ÓPTICA</h1>
        </div>
        <div class="elementos">
            <a href="listar_temas.php">Inicio</a>
            <a href="user_register.php">Registrate</a>
            <a href="user_login.php">Únete</a>
            <a href="user_cerrar.php">Cerrar sesion</a>
            <p class = "sesion"> <?php if(isset($_SESSION['alias'])) echo "Has iniciado sesión con: ", $aliasSesion ?></p>
            </a>
        </div>
    </div>

</head>

