<?php

require_once "../../configuracion.php";

use GuzzleHttp\Client;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$data = data_submitted();
// Instancia de la clase CatApiHelper para hacer solicitudes a la API
$catApiHelper = new CatApiHelper();

$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

$token = null;
if (isset($_COOKIE['token'])) {
    try {
        $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
        $token = $_COOKIE['token'];
        // Obtiene el ID del usuario desde el token
        $usuarioId = $decoded->data->usuario_id; 
    } catch (Exception $e) {
        header("Location: ../login.php");
        exit();
    }
}else{
    header("Location: ../login.php");
    exit();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen del Gato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/css/style.css">
    <script>
        var token = <?php echo json_encode($token); ?>;
    </script>
</head>

<?php include_once "../../Vista/Estructura/header.php"; ?>
<div class="container mt-5 text-center">

<div class="container-flex bg-body-tertiary border border-secondary-subtle rounded-3 my-4 mx-5 py-5">

    <?php
    
    if (!empty($data)) {
        $objUsuarioAbm = new AbmUsuario();
        $objUsuario = $objUsuarioAbm->buscar(['usuario_id' => $data["usuario_id"]]);
        $objGatoAbm = new AbmGato();
        $respuesta = false;
    
        // Si ya hay un usuario con esos datos
        if (!empty($objUsuario)) {
            // echo "<h3>Existe el usuario<h3>";
            $usuario = $objUsuario[0];
    
            echo "<h4>Se cargaron los datos correctamente!</h4>";
            $objGatoAbm->alta($data);
        } else {
            echo "<h4>No existe el usuario</h4>";
        }
    } else {
        echo "<h4>No hay datos cargados</h4>";
    }
    ?>

    <a href="index.php" class="btn btn-primary">Volver</a>
    <a href="../listaMascotas.php" class="btn btn-primary">Ver lista de mascotas</a>

</div>

</div>

<?php include_once "../../Vista/Estructura/footer.php"; ?>


</html>