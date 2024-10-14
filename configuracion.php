<?php header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$PROYECTO ='EjGuzzleJWT';

//variable que almacena el directorio del proyecto
$ROOT = __DIR__ . "/";
//$ROOT =$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

include_once "{$ROOT}util/funciones.php";
include_once "{$ROOT}Modelo/gato.php";
include_once "{$ROOT}Modelo/usuario.php";
include_once "{$ROOT}Control/AbmGato.php";
include_once "{$ROOT}Control/AbmUsuario.php";
include_once "{$ROOT}.gitIgnore/vendor/autoload.php";

// Variable que define la pagina de autenticacion del proyecto
$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/login/login.php";

// variable que define la pagina principal del proyecto (menu principal)
$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/principal.php";


$_SESSION['ROOT']=$ROOT;

?>