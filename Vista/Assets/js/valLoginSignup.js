document.addEventListener("DOMContentLoaded", function () {
  // Mostrar u ocultar la contraseña
  document
    .getElementById("showPassword")
    .addEventListener("change", function () {
      let password = document.getElementById("usuario_password");
      let confirmPassword = document.getElementById("confirmPassword");
      if (this.checked) {
        password.type = "text";
        confirmPassword.type = "text";
      } else {
        password.type = "password";
        confirmPassword.type = "password";
      }
    });

  // Validación de formularios
  document
    .getElementById("signupForm")
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevenir el envío hasta que se val

  let dni = document.getElementById("dni");
  let nombre = document.getElementById("usuario_nombre");
  let apellido = document.getElementById("usuario_apellido");
  let email = document.getElementById("usuario_email");
  let password = document.getElementById("usuario_password");
  let confirmPassword = document.getElementById("confirmPassword");
  let valid = true;

  // Resetear los estados de validación
  dni.classList.remove("is-invalid");
  nombre.classList.remove("is-invalid");
  apellido.classList.remove("is-invalid");
  email.classList.remove("is-invalid");
  password.classList.remove("is-invalid");
  confirmPassword.classList.remove("is-invalid");

  // Validar el formato del DNI (solo números y longitud de 8 dígitos)
  let dniPattern = /^\d{8}$/;
  if (!dniPattern.test(dni.value.trim())) {
    dni.classList.add("is-invalid");
    valid = false;
  }

  // Validar el nombre (solo letras y no vacío)
  let namePattern = /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/;
  if (!namePattern.test(nombre.value.trim()) || nombre.value.trim() === "") {
    nombre.classList.add("is-invalid");
    valid = false;
  }

  // Validar el apellido (solo letras y no vacío)
  if (!namePattern.test(apellido.value.trim()) || apellido.value.trim() === "") {
    apellido.classList.add("is-invalid");
    valid = false;
  }

  // Validar el formato del correo electrónico
  let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailPattern.test(email.value.trim())) {
    email.classList.add("is-invalid");
    valid = false;
  }

  // Validar la longitud y formato de la contraseña (mínimo 5 caracteres alfanuméricos)
  let passwordPattern = /^[a-zA-Z0-9]{4,}$/;
  if (!passwordPattern.test(password.value.trim())) {
    password.classList.add("is-invalid");
    valid = false;
  }

  // Verificar que las contraseñas coincidan
  if (password.value !== confirmPassword.value) {
    confirmPassword.classList.add("is-invalid");
    valid = false;
  }

  // Si el formulario es válido, enviarlo
  if (valid) {
    alert("Formulario enviado correctamente.");
    this.submit(); // Enviar el formulario si es válido
  }
});
});
