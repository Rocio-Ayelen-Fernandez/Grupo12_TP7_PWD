<?php

include_once "../../configuracion.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

$datos = data_submitted();
$mensaje = '';

if (isset($datos)) {
    // Autenticación de usuario
    $objAbmPersona = new AbmUsuario();
    $rta = $objAbmPersona->login($datos);

    if ($rta == 1 || $rta == 2 || $rta == 3) {
        // Manejo de mensajes de error
        if ($rta == 1) {
            $mensaje = "La contraseña es incorrecta.";
        } else if ($rta == 2) {
            $mensaje = "No se encontró un usuario con ese email.";
        } else if ($rta == 3) {
            $mensaje = "Debe ingresar un email y una contraseña válida.";
        }
        // Redirige a login.php con el código de error después de 5 segundos
        echo '<script>setTimeout(function(){ window.location.href = "../login.php?error=' . $rta . '"; }, 5000);</script>';
    } else {
        // Si el usuario está autenticado, redirige a la página de bienvenida
        header('Location: ../welcome.php');
        exit();
    }
}
?>

<!doctype html>
<?php include_once "../Estructura/header.php"; ?>

<div class="alert alert-danger text-center" role="alert">
	<?php echo $mensaje; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once '../Estructura/footer.php'; ?>