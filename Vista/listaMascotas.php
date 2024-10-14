<?php

require_once "../configuracion.php";

use GuzzleHttp\Client;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$objUsuarioAbm = new AbmUsuario();
$objGatoAbm = new AbmGato();

// Obtener todos los usuarios y sus gatos
$usuarios = $objUsuarioAbm->buscar([]);

$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

$token = null;
if (isset($_COOKIE['token'])) {
    try {
        $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
        $token = $_COOKIE['token'];
        // Obtiene el ID del usuario desde el token
        $usuarioId = $decoded->data->usuario_id; 
    } catch (Exception $e) {
        header("Location: login.php");
        exit();
    }
}else{
    header("Location: login.php");
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

<?php include_once "../Vista/Estructura/header.php"; ?>
<div class="container mt-5 text-center">

    <div class="container-flex bg-body-tertiary border border-secondary-subtle rounded-3 my-4 mx-5 py-5">
        <h2>Usuarios y sus Gatos</h2>
        <table class="table table-striped table-hover align-middle my-3">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Nombre del Gato</th>
                    <th>Raza del Gato</th>
                    <th>Imagen del Gato</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($usuarios as $usuario) {
                    $gatos = $objGatoAbm->buscar(['usuario_id' => $usuario->getUsuarioId()]);
                    foreach ($gatos as $gato) {
                        echo "<tr>";
                        echo "<td>{$usuario->getUsuarioNombre()}</td>";
                        echo "<td>{$usuario->getUsuarioApellido()}</td>";
                        echo "<td>{$usuario->getDni()}</td>";
                        echo "<td>{$gato->getGatoNombre()}</td>";
                        echo "<td>{$gato->getGatoRaza()}</td>";
                        $imagenUrl = CatApiHelper::getImageUrl($gato->getImagenId());
                        echo "<td><img src='{$imagenUrl}' alt='Imagen del gato' style='width: 100px; height: 100px;'></td>";
                        echo "<td><a href='modificarGato.php?gato_id={$gato->getGatoId()}' class='btn btn-primary'>Editar</a> <a href='Accion/eliminarGato.php?gato_id={$gato->getGatoId()}' class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
</div>

<?php include_once "../Vista/Estructura/footer.php"; ?>


</html>