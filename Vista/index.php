<?php

require_once "../configuracion.php";

use GuzzleHttp\Client;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


// Instancia de la clase CatApiHelper para hacer solicitudes a la API
$catApiHelper = new CatApiHelper();

$breedsResponse = $catApiHelper->getBreeds();
if (!$breedsResponse['success']) {
    echo "Error al obtener las razas: " . $breedsResponse['error'];
    die();
}
$breeds = $breedsResponse['data'];



$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

if (isset($_COOKIE['token'])) {
    $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
} else {
   header("Location: login.php");
}


?>


<!DOCTYPE html>

<?php include_once "Estructura/header.php"; ?>

<div class="container mt-5">
    <h1 class="mb-4">Buscar imagen de gato por raza</h1>
    <form action="Accion/busqueda.php" method="POST">
        <div class="mb-3">
            <label for="breed" class="form-label">Selecciona la raza del gato:</label>
            <select class="form-select" name="breed_id" id="breed" required>
                <option value="">Selecciona una raza</option>
                <?php
                // Rellenar el menú desplegable con las razas
                foreach ($breeds as $breed) {
                    echo "<option value='{$breed['id']}'>{$breed['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
        
    </form>

    
</div>


<?php include_once "Estructura/footer.php"; ?>


</html>