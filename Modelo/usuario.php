<?php
include_once 'conector/BaseDatos.php';

class Usuario {
    private $usuario_id;
    private $dni;
    private $usuario_email;
    private $usuario_password;
    private $usuario_nombre;
    private $usuario_apellido;
    private $mensajeoperacion;

    public function __construct(){
        $this->usuario_id = "";
        $this->dni = "";
        $this->usuario_email = "";
        $this->usuario_password = "";
        $this->usuario_nombre = "";
        $this->usuario_apellido = "";
        $this->mensajeoperacion = "";
    }

    public function getUsuarioId(){
        return $this->usuario_id;
    }
    public function setUsuarioId($usuario_id){
        $this->usuario_id = $usuario_id;
    }

    public function getDni(){
        return $this->dni;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }

    public function getUsuarioEmail(){
        return $this->usuario_email;
    }
    public function setUsuarioEmail($usuario_email){
        $this->usuario_email = $usuario_email;
    }

    public function getUsuarioPassword(){
        return $this->usuario_password;
    }
    public function setUsuarioPassword($usuario_password){
        $this->usuario_password = $usuario_password;
    }

    public function getUsuarioNombre(){
        return $this->usuario_nombre;
    }
    public function setUsuarioNombre($usuario_nombre){
        $this->usuario_nombre = $usuario_nombre;
    }

    public function getUsuarioApellido(){
        return $this->usuario_apellido;
    }
    public function setUsuarioApellido($usuario_apellido){
        $this->usuario_apellido = $usuario_apellido;
    }

    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeOperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function setear($usuario_id, $dni, $usuario_email, $usuario_password, $usuario_nombre, $usuario_apellido){
        $this->setUsuarioId($usuario_id);
        $this->setDni($dni);
        $this->setUsuarioEmail($usuario_email);
        $this->setUsuarioPassword($usuario_password);
        $this->setUsuarioNombre($usuario_nombre);
        $this->setUsuarioApellido($usuario_apellido);
    }

    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM Usuario WHERE usuario_id = '".$this->getUsuarioId()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res > -1){
                if($res > 0){
                    $row = $base->Registro();
                    $this->setear($row['usuario_id'], $row['dni'], $row['usuario_email'], $row['usuario_password'], $row['usuario_nombre'], $row['usuario_apellido']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Usuario->cargar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO Usuario (dni, usuario_email, usuario_password, usuario_nombre, usuario_apellido) VALUES ('" . $this->getDni() . "', '" . $this->getUsuarioEmail() . "', '" . $this->getUsuarioPassword() . "', '" . $this->getUsuarioNombre() . "', '" . $this->getUsuarioApellido() . "')";
        try {
            if ($base->Iniciar()) {
                // Cambia la ejecución de la consulta a Ejecutar() como lo tenías.
                if ($base->Ejecutar($sql)) {
                    // Obtener el ID de la última inserción
                    $idUsuario = $base->lastInsertId();
                    if ($idUsuario) {
                        $this->setUsuarioId($idUsuario);
                        $resp = true;
                    }
                } else {
                    $this->setMensajeOperacion("Usuario->insertar: " . $base->getError());
                }
            } else {
                $this->setMensajeOperacion("Usuario->insertar: " . $base->getError());
            }
        } catch (PDOException $e) {
            $this->setMensajeOperacion("Usuario->insertar: " . $e->getMessage());
        }
        return $resp;
    }
    

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE Usuario SET dni='".$this->getDni()."', usuario_email='".$this->getUsuarioEmail()."', usuario_password='".$this->getUsuarioPassword()."', usuario_nombre='".$this->getUsuarioNombre()."', usuario_apellido='".$this->getUsuarioApellido()."' WHERE usuario_id='".$this->getUsuarioId()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Usuario->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("Usuario->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM Usuario WHERE usuario_id='".$this->getUsuarioId()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("Usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = [];
        $base = new BaseDatos();
        $sql = "SELECT * FROM Usuario";
        if ($parametro != "") {
            $sql .= ' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res > -1){
            if($res > 0){
                while ($row = $base->Registro()){
                    $obj = new Usuario();
                    $obj->setear($row['usuario_id'], $row['dni'], $row['usuario_email'], $row['usuario_password'], $row['usuario_nombre'], $row['usuario_apellido']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            error_log("Usuario->listar: ".$base->getError());
        }
        return $arreglo;
    }
}
?>