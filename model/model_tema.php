<?php
require_once("conexion.php");
require_once "model/model_usuario.php";

class tema
{

    public $id_usuario;         //Id del usuario que crea el tema
    public $titulo;             //Titulo del tema
    public $conexion;           //Objeto que permite conectar con la bbdd

    //Constructor de la clase
    public function __construct($id_usuario, $titulo)
    {
        $this->conexion = new Conexion();
        $this->id_usuario = $id_usuario;
        $this->titulo = $titulo;
    }

    //Metodo que permite listar todos los temas
    public function mostrarTemas()
    {
        $this->conexion->conectar();
        $temas = $this->conexion->consultar("SELECT * FROM tema");
        return $temas;
        $this->conexion->desconectar();

    }

    //Metodo que permite crear los temas
    public function crearTema()
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("INSERT INTO tema(id_usuario, titulo) VALUES ('$this->id_usuario', '$this->titulo')");
        $this->conexion->desconectar();
    }

    //Metodo que permite eliminar los temas
    public function eliminarTema($tema)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("DELETE FROM tema WHERE id_tema = '$tema'");
        $this->conexion->desconectar();
    }
}