<?php
require_once("conexion.php");

class usuario
{
    public $alias;              //Nombre de usuario
    public $email;              //Email del usuario
    public $contrasena;         //Contrasena del usuario
    public $conexion;           //Objeto que permite conectar con la bbdd

    //Constructor de la clase
    public function __construct($alias, $password, $email)
    {
        $this->conexion = new Conexion();
        $this->alias = $alias;
        $this->email = $email;
        $this->contrasena = $this->encriptar($password);
    }

    //Metodo que permite encriptar la contrasena a partir de un hash
    public function encriptar($enc)
    {
        $opciones = ['cost' => 12,];
        $passHash = password_hash($enc, PASSWORD_BCRYPT, $opciones);
        return $passHash;

    }

    //Metodo que comprueba que los campos no esten vacios, el email sea correcto y el alias no este repetido
    public function comprobaciones()
    {
        $this->conexion->conectar();
        //Comprobamos que los campos no estén vacíos
        if ($this->alias == '' || $this->contrasena == '' || $this->email == '') {
            echo "<div class='form'>Por favor, introduce todos los campos requeridos</div>";
            return false;
        }
        //Comprobamos que la dirección de correo sea valida
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='form'> La dirección de correo electrónico " . $this->email . " es inválida. Por favor, introduzca una correcta.</div>";
            return false;
        } //Comprobamos que el alias no esta ya registrado
        else {
            //Consultamos los registros y su valor en la columna user y los almacenamos en el array $usuarios
            $usuarios = $this->conexion->consultar("SELECT alias from usuario");
            if (count($usuarios)) {
                //Recorremos el array y en el caso de que el nombre introducido corresponda con alguno ya registrado impedirá el registro
                foreach ($usuarios as $alias) {
                    if ($alias['alias'] == $this->alias) {
                        echo "<div class='form'> Alias ya registrado. Por favor elija otro.</div>";
                        return false;
                        break;
                    }
                }
            }
        }
    }

    public function nuevo()
    {
        try {
            $this->conexion->conectar();
            $this->conexion->ejecutar("INSERT usuario SET alias='$this->alias', password='$this->contrasena', email='$this->email'");
            //Crea un objeto correo cuyos parámetros son el nombre de usuario y el email introducido para posteriormente llamar al método enviar() y mandarle el correo
            $this->enviar();
            $this->conexion->desconectar();
        } catch (PDOException $ex) {
            //Devuelve la excepción en caso de no poder insertar el usuario
            throw $ex;
        }
        $this->conexion->desconectar();
    }

    //Método que envía el correo y devuelve un error si no es posible
    public function enviar()
    {
        $email_origen = "admin@localhost.com";
        $formato = "html";
        $asunto = "Usuario creado";
        $mensaje = "Su cuenta con nombre de usuario:" . $this->alias . "se ha creado correctamente.";
        $headers = "";

        $headers = "To: " . $this->alias . "<" . $this->email . "> \r \n";
        $headers .= "From: Administrador" . "<" . $email_origen . "> \r \n";
        $headers .= "Return-path: <" . $email_origen . "> \r \n";
        $headers .= "Reply-to: " . $email_origen . "\r \n";
        $headers .= "MIME-Version: 1.0 \r \n";
        if ($formato == "html") {
            $headers .= "Content-Type: text/html; charset = utf-8 \r \n";
        } else {
            $headers .= "Content-Type: text/plain; charset = utf-8 \r \n";
        }
        if (mail($this->email, $asunto, $mensaje, $headers)) {
            echo "Su correo se envió";
        } else {
            echo "Error al enviar correo";
        }
    }


    public function verificar($alias, $pass)
    {
        try {
            $this->conexion->conectar();
            //Recogemos todas las filas con las columnas user y password y las almacenamos en el array $usuarios
            $usuarios = $this->conexion->consultar("SELECT alias, password FROM usuario");
            if (count($usuarios)) {
                //Recorremos todas las filas del array
                foreach ($usuarios as $usuario) {
                    if ($usuario['alias'] == $alias && password_verify($pass, $usuario['password'])) {
                        echo "Contraseña correcta";
                        return true;
                        break;
                    }
                }
            }
            $this->conexion->desconectar();
        } catch (PDOException $ex) {
            throw $ex;
        }
    }
    public function getId($alias){
        $this->conexion->conectar();
        $usuario = $this->conexion->consultar("SELECT id_usuario FROM usuario WHERE alias = '$alias'");
        if (count($usuario)){
            return $usuario[0] ['id_usuario'];
        }
        $this->conexion->desconectar();
}

    public function getAliasById($id_usuario){
        $this->conexion->conectar();
        $usuario = $this->conexion->consultar("SELECT alias FROM usuario WHERE id_usuario = '$id_usuario'");
        if (count($usuario)){
            return $usuario[0] ['alias'];
        }
        $this->conexion->desconectar();
    }
}
