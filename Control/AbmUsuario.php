<?php
use Firebase\JWT\JWT;
class AbmUsuario {
    private function cargarObjeto($param){
        $obj = null;
        if( array_key_exists('dni', $param)and array_key_exists('usuario_nombre', $param) and array_key_exists('usuario_apellido', $param ) and array_key_exists('usuario_email', $param) and array_key_exists('usuario_password', $param)  ){
            $obj = new Usuario();
            $obj->setear(null, $param['dni'], $param['usuario_email'], $param['usuario_password'], $param['usuario_nombre'], $param['usuario_apellido']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['usuario_id']) ){
            $obj = new Usuario();
            $obj->setUsuarioId($param['usuario_id']);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['usuario_id']))
            $resp = true;
        return $resp;
    }

    public function alta($param){
        $resp = false;
        $objUsuario = $this->cargarObjeto($param);
        if ($objUsuario != null and $objUsuario->insertar()){
            $resp = true;
        }
        return $resp;
    }

    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objUsuario = $this->cargarObjetoConClave($param);
            if ($objUsuario != null and $objUsuario->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objUsuario = $this->cargarObjeto($param);
            if($objUsuario != null and $objUsuario->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param){
        $where = " true ";
        if ($param != NULL){
            if (isset($param['usuario_id'])){
                $where .= " and usuario_id = '".$param['usuario_id']."'";
            }
            if (isset($param['dni'])){
                $where .= " and dni = '".$param['dni']."'";
            }
        }
        $arreglo = Usuario::listar($where);  
        return $arreglo;
    }

    public function login($param) {
        $rta =null;
        if (isset($param["usuario_email"]) && isset($param["usuario_password"])) {
            $persona = new Usuario();
            $persona->setUsuarioEmail($param["usuario_email"]);
            $persona->setUsuarioPassword($param["usuario_password"]);
    
            // Busca usuario por email
            $usuario = Usuario::listar('usuario_email = "' . $persona->getUsuarioEmail() . '"');
    
            if (!empty($usuario)) {
                // Verifica los datos recuperados del usuario
    
                // Verifica si la contraseña coincide (usa password_verify si está hasheada)
                if ($usuario[0]->getUsuarioPassword() === $persona->getUsuarioPassword()) {
                    $this->createJWT($usuario[0]);
                    
                    //
                } else {
                    $rta= 1; // Contraseña incorrecta
                }
            } else {
                $rta= 2; // Usuario no encontrado
            }
        } else {
            $rta= 3; // Debe ingresar un email y una contraseña válida
        }
        return $rta;
    }
    
    
    
        // Función para generar el token JWT
        private function createJWT($usuario) {
            $key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';
        
            // Genera el token JWT con los datos del usuario
            $token = JWT::encode(
                array(
                    'iat' => time(),
                    'nbf' => time(),
                    'exp' => time() + 3600, // 1 hora de expiración
                    'data' => array(
                        'usuario_id' => $usuario->getUsuarioId(),
                        'usuario_nombre' => $usuario->getUsuarioNombre()
                    )
                ),
                $key,
                'HS256'
            );
        
            // Limpia el buffer de salida para asegurar que no haya contenido previo
            if (ob_get_length()) {
                ob_end_clean();
            }
        
            // Configuración de la cookie con el token JWT
            setcookie("token", $token, time() + 3600, "/", "", true, true); // HTTPOnly, cookie segura
        }
}
?>