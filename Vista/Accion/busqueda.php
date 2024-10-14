<?php

require_once "../../configuracion.php";

use GuzzleHttp\Client;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

$usuarioId = null;
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
}


// Instancia de la clase CatApiHelper para hacer solicitudes a la API
$catApiHelper = new CatApiHelper();

//Obtener datos 
$data = data_submitted();

$mensajeError = '';
$imagenGato = '';
$datosGato = '';
$gato_raza = '';
$imagen_id = '';
$limit = 4;
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
    
    <?php

    if (!empty($data)) {
        $breed_id = $data['breed_id'];
    
        if (empty($breed_id)) {
            echo "Por favor selecciona una raza.";
        } else {
            $imagesResponse = $catApiHelper->getImagesByBreed($breed_id, $limit);
    
            if (!$imagesResponse['success']) {
                echo "Error al obtener imágenes: " . $imagesResponse['error'];
            } else {
                $images = array_slice($imagesResponse['data'], 0, $limit); // Limitar a $limit imágenes
                if (!empty($images)) {
                    echo "<h1>Imágenes de gatos encontrados:</h1>";
                    echo "<div class='row col align-items-start'>";

                    foreach ($images as $image) {

                        
                        echo "<div class='col card text-bg-light p-2 m-1' style='width: 15rem; height: 16rem;'>";

                        
                        $image_url = $image['url']; // URL de la imagen
                        $image_id = $image['id']; // ID de la imagen
                        echo "<img src='{$image_url}' class='card-img-top' alt='Imagen de gato' style='max-height:11rem;'>";
                        echo "<div class='card-body p-2'>";
                        echo "<button type='button' class='btn btn-primary' onclick='setImageId(\"{$image_id}\")'>Seleccionar esta imagen</button><br>";
                        
                        echo "</div></div>";
                    }
                } else {
                    echo "<h1>No se encontró una imagen para esta raza.</h1";
                }


                echo "</div>";

                // Obtener detalles de la raza antes de generar el formulario
                $breedDetailsResponse = $catApiHelper->getBreedDetails($breed_id);
                if (!$breedDetailsResponse['success']) {
                    echo "<h1>Error al obtener detalles de la raza: " . $breedDetailsResponse['error']."</h1>";
                } else {
                    $breed_data = $breedDetailsResponse['data'];
                    if (!empty($breed_data)) {
                        $gato_raza = $breed_data['name']; // Nombre de la raza
                    }
                }

                // Formulario para ingresar el nombre del gato y otros datos
                echo "<form id='hiddenForm' action='agregarGato.php' method='post'>";
                echo "<div class='mt-4'>";
                echo "<input class='form-control' id='gato_nombre' name='gato_nombre' placeholder='Ingrese un nombre aqui' disabled>";
                echo "</div>";
                echo "<input type='hidden' id='usuario_id' name='usuario_id' value='{$usuarioId}'>";
                echo "<input type='hidden' id='gato_raza' name='gato_raza' value='{$gato_raza}'>";
                echo "<input type='hidden' id='imagen_id' name='imagen_id' value=''>";
                echo "</form>";

                echo "<div class='conteiner-flex rounded-3 border border-dark-subtle bg-body-tertiary my-5 mx-2' ><div class='conteiner-flex p-2'>";
                
                if (!empty($breed_data)) {
                    echo "<h2>Detalles de la raza:</h2>";
                    echo "<strong>Nombre:</strong> " . $breed_data['name'] . "<br>";
                    echo "<strong>Origen:</strong> " . $breed_data['origin'] . "<br>";
                    echo "<strong>Temperamento:</strong> " . $breed_data['temperament'] . "<br>";
                    echo "<strong>Descripción:</strong> " . $breed_data['description'] . "<br>";
                    echo "<strong>Esperanza de vida:</strong> " . $breed_data['life_span'] . " años<br>";
                } else {
                    echo "No se encontraron detalles para esta raza.";
                }

                echo "</div></div>";
            }
        }
    } else {
        echo "No se recibieron datos.";
    }
    
    ?>
   

    <!-- Asegúrate de que el botón esté dentro de un div aparte para que se mantenga en su propia línea -->
    <div class="mt-4">
        <a href="<?= $rutaIndex ?>" class="btn btn-primary">Volver a la página principal</a>
        <button id="addCatButton" type="button" class="btn btn-primary" disabled>Agregar gato</button>
    </div>

</div>





<?php include_once "../../Vista/Estructura/footer.php"; ?>
<script>
    var addCatButton;
    var gatoNombreInput;
    var selectedImageId = null;

    document.addEventListener('DOMContentLoaded', function() {
        addCatButton = document.getElementById('addCatButton');
        gatoNombreInput = document.getElementById('gato_nombre');
        if (!token) {
            addCatButton.disabled = true;
            gatoNombreInput.disabled = true;
        } else {
            addCatButton.disabled = false;
            gatoNombreInput.disabled = false;
        }

        addCatButton.addEventListener('click', function() {
            if (selectedImageId) {
                document.getElementById('imagen_id').value = selectedImageId;
                document.getElementById('hiddenForm').submit();
            } else {
                alert("Por favor, seleccione una imagen de gato.");
            }
        });
    });

    function setImageId(imageId) {
        selectedImageId = imageId;
        console.log("Imagen seleccionada ID:", selectedImageId);
        if (!token) {
            alert("No está logeado! Ingrese para guardar al gato!");
        }
    }
</script>

</html>