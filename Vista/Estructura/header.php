<?php
function redireccion($base_url, $script)
{
	// Obtener el path actual
	$currentPath = $_SERVER['SCRIPT_NAME']; //contiene la ruta del script actual

	// Detecta si esta en la carpeta Accion
	if (strpos($currentPath, '/Accion/') !== false) {
		// Si esta en la carpeta Accion, ajusta el base_url 
		$base_url = $base_url . '/..';
	} 

	return $base_url . '/' . $script;
}

$base_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
$rutaIndex = redireccion($base_url, 'index.php');
$rutaLista = redireccion($base_url, 'listaMascotas.php');
$rutaLogin = redireccion($base_url, 'login.php');
$rutaSignup = redireccion($base_url, 'signup.php');
$custom_style_url = redireccion($base_url, 'assets/css/style.css');
$rutaLogout = redireccion($base_url, 'logout.php');

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Michis & Pichis</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo $custom_style_url; ?>">

</head>
<body class="conteiner-fluid ">
	<header>
		<nav class=" navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?= $rutaIndex ?>">Michis & Pichis🐾</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="<?= $rutaIndex ?>">Inicio</a>
			
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="<?= $rutaLista ?>">Lista</a>
			
						</li>
						<?php
							$protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
							$servidor = $_SERVER['HTTP_HOST']; // El servidor, por ejemplo, localhost
							$ruta = $_SERVER['REQUEST_URI']; // La ruta completa del script actual
							
							$urlCompleta = $protocolo . $servidor . $ruta;
							
						if($urlCompleta !== $rutaSignup){
							echo '<li class="nav-item ">
							<a class="nav-link active" href="'.$rutaSignup.'">Registrarse</a>
						</li>';
						} 
						if (isset($_COOKIE['token'])){
							echo '<li class="nav-item ">
							<a class="nav-link active" href="'. $rutaLogout .'">Cerrar Sesión</a>
						</li>';
						}
						?>
					</ul>
				</div>
			</div>
		</nav>
	</header>