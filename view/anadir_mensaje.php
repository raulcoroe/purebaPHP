<!DOCTYPE html>
<html lang="en">

<!--Cabecera del foro-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad de aprendizaje</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Nerko+One&family=Noto+Sans+JP:wght@300&family=Raleway:ital,wght@1,200&display=swap"
        rel="stylesheet">
    <div class="intro-pagina">
        <div class="logo">
            <img src="img/logo.png">
        </div>
        <div class="titulo">
            <h1>FORO ÓPTICA</h1>
        </div>
        <div class="elementos">

            <a href="index.php?action=listarTemas&controller=controller_tema">Inicio</a>
            <a href="index.php?action=mostrarRegister&controller=controller_usuario">Registrate</a>
            <a href="index.php?action=mostrarLogin&controller=controller_usuario">Unete</a>
            <a href="index.php?action=cerrarSesion&controller=controller_usuario">Cerrar sesion</a>
            <p class = "sesion"> <?php if(isset($_SESSION['alias'])) echo "Has iniciado sesión con: ", $_SESSION['alias'] ?></p>
            </a>
        </div>
    </div>

</head>
<form class="formulario" method="post" action="index.php?action=anadirMensaje&controller=controller_mensaje&id_tema=<?php echo $_GET['id_tema']?>">
    <div class="form">
        <textarea name="texto" class="form-input-area" placeholder="Introduce el comentario"></textarea>
        <input type="submit" name="submit" value="Añadir mensaje" class="form-boton">
    </div>
</form>

</body>
</html>
