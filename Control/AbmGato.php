<?php


class AbmGato {
    private function cargarObjeto($param){
        $obj = null;
        if( array_key_exists('gato_nombre', $param) and array_key_exists('usuario_id', $param) and array_key_exists('gato_raza', $param) and array_key_exists('imagen_id', $param)){
            $usuario = new Usuario();
            $usuario->setUsuarioId($param['usuario_id']);
            $obj = new Gato();
            $obj->setear(null, $param['gato_nombre'], $usuario, $param['gato_raza'], $param['imagen_id']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['gato_id']) ){
            $obj = new Gato();
            $obj->setGatoId($param['gato_id']);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['gato_id']))
            $resp = true;
        return $resp;
    }

    public function alta($param){
        $resp = false;
        $objGato = $this->cargarObjeto($param);
        if ($objGato != null and $objGato->insertar()){
            $resp = true;
        }
        return $resp;
    }

    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objGato = $this->cargarObjetoConClave($param);
            if ($objGato != null and $objGato->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            echo "Entro seteadosCamposClaves";
            $objGato = $this->cargarObjetoConClave($param);
            $objGato->setGatoNombre($param["gato_nombre"]);
            if($objGato != null and $objGato->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param){
        $where = " true ";
        if ($param != NULL){
            if (isset($param['gato_id'])){
                $where .= " and gato_id = '".$param['gato_id']."'";
            }
            if (isset($param['gato_nombre'])){
                $where .= " and gato_nombre = '".$param['gato_nombre']."'";
            }
            if (isset($param['usuario_id'])){
                $where .= " and usuario_id = '".$param['usuario_id']."'";
            }
            if (isset($param['gato_raza'])){
                $where .= " and gato_raza = '".$param['gato_raza']."'";
            }
            if (isset($param['imagen_id'])){
                $where .= " and imagen_id = '".$param['imagen_id']."'";
            }
        }
        $arreglo = Gato::listar($where);  
        return $arreglo;
    }
}
?>