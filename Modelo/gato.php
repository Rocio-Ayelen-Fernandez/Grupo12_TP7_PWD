<?php
include_once 'conector/BaseDatos.php';
include_once 'usuario.php';

class Gato {
    private $gato_id;
    private $gato_nombre;
    private $usuario; // Cambiado a objeto Usuario
    private $gato_raza;
    private $imagen_id;
    private $mensajeoperacion;

    public function __construct(){
        $this->gato_id = "";
        $this->gato_nombre = "";
        $this->usuario = new Usuario(); // Inicializado como objeto Usuario
        $this->gato_raza = "";
        $this->imagen_id = "";
        $this->mensajeoperacion = "";
    }

    public function getGatoId(){
        return $this->gato_id;
    }
    public function setGatoId($gato_id){
        $this->gato_id = $gato_id;
    }

    public function getGatoNombre(){
        return $this->gato_nombre;
    }
    public function setGatoNombre($gato_nombre){
        $this->gato_nombre = $gato_nombre;
    }

    public function getUsuario(){
        return $this->usuario;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getGatoRaza(){
        return $this->gato_raza;
    }
    public function setGatoRaza($gato_raza){
        $this->gato_raza = $gato_raza;
    }

    public function getImagenId(){
        return $this->imagen_id;
    }
    public function setImagenId($imagen_id){
        $this->imagen_id = $imagen_id;
    }

    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeOperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function setear($gato_id, $gato_nombre, $usuario, $gato_raza, $imagen_id){
        $this->setGatoId($gato_id);
        $this->setGatoNombre($gato_nombre);
        $this->setUsuario($usuario);
        $this->setGatoRaza($gato_raza);
        $this->setImagenId($imagen_id);
    }

    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM Gato WHERE gato_id = '".$this->getGatoId()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res > -1){
                if($res > 0){
                    $row = $base->Registro();
                    $usuario = new Usuario();
                    $usuario->setUsuarioId($row['usuario_id']);
                    $usuario->cargar();
                    $this->setear($row['gato_id'], $row['gato_nombre'], $usuario, $row['gato_raza'], $row['imagen_id']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Gato->cargar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO Gato (gato_nombre, usuario_id, gato_raza, imagen_id) VALUES ('".$this->getGatoNombre()."', '".$this->getUsuario()->getUsuarioId()."', '".$this->getGatoRaza()."', '".$this->getImagenId()."')";
        try {
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    $resp = true;
                } else {
                    $this->setMensajeOperacion("Gato->insertar: ".$base->getError());
                }
            } else {
                $this->setMensajeOperacion("Gato->insertar: ".$base->getError());
            }
        } catch (PDOException $e) {
            $this->setMensajeOperacion("Gato->insertar: ".$e->getMessage());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE Gato SET gato_nombre='" . $this->getGatoNombre() . "' WHERE gato_id=" . $this->getGatoId() . "";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Gato->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("Gato->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM Gato WHERE gato_id='".$this->getGatoId()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Gato->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("Gato->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = [];
        $base = new BaseDatos();
        $sql = "SELECT * FROM Gato";
        if ($parametro != "") {
            $sql .= ' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res > -1){
            if($res > 0){
                while ($row = $base->Registro()){
                    $usuario = new Usuario();
                    $usuario->setUsuarioId($row['usuario_id']);
                    $usuario->cargar();
                    $obj = new Gato();
                    $obj->setear($row['gato_id'], $row['gato_nombre'], $usuario, $row['gato_raza'], $row['imagen_id']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            error_log("Gato->listar: ".$base->getError());
        }
        return $arreglo;
    }
}
?>