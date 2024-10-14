<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up Michis & Pichis</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<?php include_once "Estructura/header.php";

?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-8 ">
			<div class="card">
				<div class="card-header text-center">
					<h3>Registro</h3>
				</div>
				<div class="card-body">
				<form id="signupForm" action="Accion/accionSignup.php" method="post">
    <div class="mb-3">
        <label for="dni" class="form-label">DNI</label>
        <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese su DNI" required>
        <div class="invalid-feedback">Por favor, ingresa un DNI válido.</div>
    </div>

    <div class="d-flex">
        <div class="mb-3 me-3">
            <label for="usuario_nombre" class="form-label">Nombre</label>
            <!-- Cambié id="nombre" a id="usuario_nombre" -->
            <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" placeholder="Ingrese su nombre" required>
            <div class="invalid-feedback">Por favor, ingresa un nombre válido.</div>
        </div>
        <div class="mb-3">
            <label for="usuario_apellido" class="form-label">Apellido</label>
            <!-- Cambié id="apellido" a id="usuario_apellido" -->
            <input type="text" class="form-control" id="usuario_apellido" name="usuario_apellido" placeholder="Ingrese su apellido" required>
            <div class="invalid-feedback">Por favor, ingresa un apellido válido.</div>
        </div>
    </div>

    <div class="mb-3">
        <label for="usuario_email" class="form-label">Correo electrónico</label>
        <input type="text" class="form-control" id="usuario_email" name="usuario_email" placeholder="Ingrese su correo electrónico" required>
        <div class="invalid-feedback">Por favor, ingresa un correo electrónico válido.</div>
    </div>

    <div class="mb-3">
        <label for="usuario_password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="usuario_password" name="usuario_password" placeholder="Ingrese su contraseña" required>
        <div class="invalid-feedback">La contraseña es obligatoria. Debe tener al menos 5 caracteres.</div>
    </div>

    <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirma tu contraseña" required>
        <div class="invalid-feedback">Las contraseñas no coinciden.</div>
    </div>

    <!-- Opción para mostrar la contraseña -->
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="showPassword">
        <label class="form-check-label" for="showPassword">Mostrar contraseña</label>
    </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </div>
</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="assets/js/valLoginSignup.js"></script>






<?php include_once "Estructura/footer.php"; ?>


</html>