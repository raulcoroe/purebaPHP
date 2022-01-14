<?php
class mensaje
{

    public $id_usuario;         //Usuario que crea el mensaje
    public $id_tema;            //Tema en el que es creado el mensaje
    public $texto;              //Cuerpo del mensaje
    public $conexion;           //Objeto que conecta con la bbdd

    //Constructor de la clase
    public function __construct($id_usuario, $id_tema, $texto)
    {
        $this->conexion = new Conexion();
        $this->id_usuario = $id_usuario;
        $this->id_tema = $id_tema;
        $this->texto = $texto;
    }

    //Metodo que permite listar todos los mensajes de un tema
    public function mostrarMensajes($id_tema)
    {
        $this->conexion->conectar();
        $mensajes = $this->conexion->consultar("SELECT * FROM mensaje WHERE id_tema = '$id_tema'");
        return $mensajes;
        $this->conexion->desconectar();

    }

    //Metodo que permite crear mensajes
    public function crearMensaje()
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("INSERT INTO mensaje(id_usuario, id_tema, texto) VALUES ('$this->id_usuario', '$this->id_tema', '$this->texto')");
        $this->conexion->desconectar();
    }

    //Metodo que permite eliminar los mensajes
    public function eliminarMensaje($id_mensaje)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("DELETE FROM mensaje WHERE id_mensaje = '$id_mensaje'");
        $this->conexion->desconectar();
    }
}