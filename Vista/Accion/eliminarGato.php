<?php

require_once "../../configuracion.php";


use GuzzleHttp\Client;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$data = data_submitted();
$mensaje = '';


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


if(!empty($data)){

    $gato_id = $data['gato_id'];

    if (!empty($gato_id)) {
        $objGatoAbm = new AbmGato();
        $respuesta = $objGatoAbm->baja(['gato_id' => $gato_id]);

        if ($respuesta) {
            $mensaje = '<div class="container text-center" id="cardBienvenida">
                <div class="card shadow-lg p-4" style="max-width: 450px; margin: auto; border-radius: 15px;">
                    <div class="card-body">
                        <h2 class="card-title mb-3">Gato eliminado Existosamente</b></h2>
                        <a href="../listaMascotas.php" class="btn btn-danger btn-lg mb-2">Volver a la Lista</a>
                    </div>
                </div>
              </div>';
        } else {
            $mensaje = '<div class="container text-center" id="cardBienvenida">
                <div class="card shadow-lg p-4" style="max-width: 450px; margin: auto; border-radius: 15px;">
                    <div class="card-body">
                        <h2 class="card-title mb-3">Error al eliminar al gato</b></h2>
                        <a href="../listaMascotas.php" class="btn btn-danger btn-lg mb-2">Volver a la Lista</a>
                    </div>
                </div>
              </div>';
        }
    } else {
        $mensaje = '<div class="container text-center" id="cardBienvenida">
                <div class="card shadow-lg p-4" style="max-width: 450px; margin: auto; border-radius: 15px;">
                    <div class="card-body">
                        <h2 class="card-title mb-3">ID del gato no proporcionado</b></h2>
                        <a href="../listaMascotas.php" class="btn btn-danger btn-lg mb-2">Volver a la Lista</a>
                    </div>
                </div>
              </div>';
    }

}else{

    $mensaje = '<div class="container text-center" id="cardBienvenida">
                <div class="card shadow-lg p-4" style="max-width: 450px; margin: auto; border-radius: 15px;">
                    <div class="card-body">
                        <h2 class="card-title mb-3">No hay datos</b></h2>
                        <a href="../listaMascotas.php" class="btn btn-danger btn-lg mb-2">Volver a la Lista</a>
                    </div>
                </div>
              </div>';
}
?>

<!DOCTYPE html>
<?php include_once "../Estructura/header.php"; ?>

<div class="container mt-5">
    <?php echo $mensaje; ?>
</div>

<?php include_once "../Estructura/footer.php"; ?>

</html>