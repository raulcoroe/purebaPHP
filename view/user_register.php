<?php include "head.php"; ?>

<!--Pagina que muestra un formulario para el registro del usuario-->
<body>
<div id="contenedor">
    <header>
        <h1>Registro de usuario</h1>
    </header>
    <form action="" method="post">
        <div class="formulario">
            <form action="" method="post">
                <div class="form">
                    <input type="text" name="user" placeholder="Alias" class="form-input"><br/>
                    <input type="password" name="password" placeholder="Contraseña" class="form-input"><br/>
                    <input type="text" name="email" placeholder="Email" class="form-input"><br/>
                    <input type='submit' name='submit' value='Registrarse' class="form-boton">
                </div>
            </form>
        </div>
</div>
</body>
</html>

