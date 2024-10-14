<?php
include_once '../configuracion.php';
$error = isset($_GET['error']) ? $_GET['error'] : null;
$mensajeError = '';

// Dependiendo del valor de 'error', genera el mensaje correspondiente
if ($error == 1) {
    $mensajeError = 'La contraseña es incorrecta.';
} elseif ($error == 2) {
    $mensajeError = 'No se encontró un usuario con ese email.';
} elseif ($error == 3) {
    $mensajeError = 'Debe ingresar un email y una contraseña válida.';
}

?>
<!DOCTYPE html>
<?php
include_once "Estructura/header.php"
?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header text-center">
					<h3>Iniciar Sesión</h3>
				</div>
				<div class="card-body">

					<form id="loginForm" action="Accion/accionLogin.php" method="post">
					<?php if ($mensajeError): ?>
                        <!-- Mostrar mensaje de error si existe -->
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $mensajeError; ?>
                        </div>
                    <?php endif; ?>
						<div class="mb-3">
							<label for="usuario_email" class="form-label">Email</label>
							<input type="text" class="form-control" id="usuario_email" name="usuario_email" placeholder="Ingrese su email">
							<div id="usernameError" class="invalid-feedback">
								Por favor, ingrese su Email.
							</div>


						</div>
						<div class="mb-3">
							<label for="usuario_password" class="form-label">Contraseña</label>
							<input type="password" class="form-control" name="usuario_password" id="usuario_password" placeholder="Ingrese su contraseña">
							<div id="passwordError" class="invalid-feedback">
								Por favor, ingrese su contraseña.
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary" name="login" value="login">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="assets/js/validarLogin.js"></script>
<?php include_once 'Estructura/footer.php'; ?>

