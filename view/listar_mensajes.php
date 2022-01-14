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
            <p class="sesion"> <?php if (isset($_SESSION['alias'])) echo "Has iniciado sesión con: ", $_SESSION['alias'] ?></p>
            </a>
        </div>
    </div>

</head>

<!--Pagina de inicio en la que se muestra el listado de temas el foto-->
<body>
<div class="wave">
    <div style="height: 150px; overflow: hidden;">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none"
             style="height: 100%; width: 100%;">
            <path d="M0.00,49.98 C149.99,150.00 271.49,-49.98 500.00,49.98 L500.00,0.00 L0.00,0.00 Z"
                  style="stroke: none; fill: rgb(255, 255, 255);"></path>
        </svg>
    </div>
</div>
<div class="zonas-centrales">
    <div class="texto">
        <h2>Mensajes</h2>
    </div>
    <div class="tabla">
        <?php
        //Recorre mediante foreach todos los temas del foro y los pinta por pantalla
        if (!empty($mensajes)) {
            foreach ($mensajes as $mensaje) {
                $id_tema = $mensaje['id_tema'];
                if (!empty($usuario)) {
                    echo '
                                <div class="tabla-elemento">
                                    <div class="elemento-texto"> 
                                        <p name=""texto">' . $mensaje ['texto'] . ' </p>
                                    </div>
                                    <div class="elemento"> 
                                        <p name="usuario">Creado por: ', $usuario->getAliasById($mensaje['id_usuario']), '</p>
                                        <p name="fecha">Fecha:  ', $mensaje['fecha_creacion'], '</p>
                                    </div> 
                                    <div class="elemento"> 
                                        <a href="index.php?id=' . $mensaje['id_mensaje'] . '&usuario=' . $mensaje['id_usuario'] . '
                                        &action=' . "eliminarMensajeController" . '&controller=' . "controller_mensaje" . '" 
                                        type="submit" class="boton" >Borrar</a>
                                    </div>
                                </div>';
                }
            }
        }

        echo '
    </div>
    <div class="boton-anadir">
        <a class="boton" href="index.php?action=formularioAnadirMensaje&controller=controller_mensaje&id_tema=' . $_GET['id_tema'] . '">Añadir mensaje</a>
    </div>'
        ?>
    </div>
</body>
</html>