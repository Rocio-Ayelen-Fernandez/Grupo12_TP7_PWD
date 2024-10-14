<?php 
include_once "../../configuracion.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

if (isset($_COOKIE['token'])) {
	$decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
} else {
	header('location:../login.php');
}
	
	$datos = data_submitted();
	if(isset($datos)){
		$abmUsuario = new AbmUsuario();
	
	$objUsuario = $abmUsuario->buscar($datos);
	
	if(count($objUsuario) > 0){
		$mensaje= "<p class='text-warning' >El usuario ya existe</p><a class='btn btn-primary' href='../signup.php'>Volver</a>";
	
	}else{
		if(isset($datos)){
			$res = $abmUsuario->alta($datos);
		
			if($res){
				$mensaje = "<p class='text-success'>usuario cargado correctamente</p><a class='btn btn-primary' href='../signup.php'>Volver</a>";
		
				
			}else{
				$mensaje="<p class='text-danger'>No se pudo cargar el usuario</p><a class='btn btn-primary' href='../signup.php'>Volver</a>";
			}
		}
	   
	}
	}
	
	?>
	<!DOCTYPE html>
		
	<!-- Navbar -->
	<?php include_once("../Estructura/header.php"); ?>
	
		<div class="row justify-content-center m-auto">
			<div class="conteiner m-5 w-75 ">
				<div class="conteiner mx-5 p-5 text-center  ">
					<div class="bg-light-subtle border border-2 border-secondary rounded shadow mx-5 p-3 ">
	
					<h3>Accion Nuevo Usuario</h3>
					
					<?php
					
						echo $mensaje;
	
					?>
		
	
					</div>
	
				</div>
				
			</div>
		</div>
		
		<?php
	include_once "../Estructura/Footer.php";

?>