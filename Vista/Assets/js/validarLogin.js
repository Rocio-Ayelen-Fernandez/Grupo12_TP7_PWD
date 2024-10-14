document.addEventListener("DOMContentLoaded", function () {
 
  
    // Validación de formularios
    document
      .getElementById("loginForm")
      .addEventListener("submit", function (event) {
        event.preventDefault(); // Prevenir el envío hasta que se val
  
    let email = document.getElementById("usuario_email");
    let password = document.getElementById("usuario_password");
    let valid = true;
  
    // Resetear los estados de validación
    email.classList.remove("is-invalid");
    password.classList.remove("is-invalid");
  
    
  
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
  
    // Si el formulario es válido, enviarlo
    if (valid) {
      this.submit(); // Enviar el formulario si es válido
    }
  });
  });
  