<?php
include_once "../configuracion.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$mensaje = '';
$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

if (isset($_COOKIE['token'])) {
    try {
        // Decodifica el token JWT
        $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
        // Obtiene el nombre del usuario
        $usuarioNombre = $decoded->data->usuario_nombre;

        // Muestra el mensaje de bienvenida
        $mensaje= '<div class="container text-center" id="cardBienvenida">
                <div class="card shadow-lg p-4" style="max-width: 450px; margin: auto; border-radius: 15px;">
                    <div class="card-body">
                        <h2 class="card-title mb-3">Bienvenido, <b>' . $usuarioNombre . '</b>!</h2>
                        <p class="card-text text-muted mb-4">Nos alegra verte nuevamente. Disfruta de tu experiencia en nuestro sitio web.</p>
                        <a href="logout.php" class="btn btn-danger btn-lg mb-2">Cerrar Sesión</a>
                    </div>
                </div>
              </div>';
    } catch (Exception $e) {
        // Si el token es inválido o expiró, redirige al login
        header("Location: ../login.php");
        exit();
    }
} else {
    // Si no hay token, redirige al login
    header("Location: ../login.php");
    exit();
}

?>
<!doctype html>

<?php include_once "Estructura/header.php"; ?>

<div>
    <?php echo $mensaje; ?> 
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once 'Estructura/footer.php'; ?>
