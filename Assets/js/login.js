// variables de la funcion de ocultar y mostrar formulario
const btnRegister = document.querySelector("#btnRegister");
const btnLogin = document.querySelector("#btnLogin");
const frmLogin = document.querySelector("#frmLogin");
const frmRegister = document.querySelector("#frmRegister");
const registrarse = document.querySelector("#registrarse");

// variables de la funcion registrarse
const nombreRegistro = document.querySelector("#nombreRegistro");
const correoRegistro = document.querySelector("#correoRegistro");
const contrasenaRegistro = document.querySelector("#contrasenaRegistro");

document.addEventListener("DOMContentLoaded", function () {
  // mostrar formulario resgistro y ocultar login
  btnRegister.addEventListener("click", function () {
    frmLogin.classList.add("d-none");
    frmRegister.classList.remove("d-none");
  });
  // mostrar formulario login y ocultar registro
  btnLogin.addEventListener("click", function () {
    frmLogin.classList.remove("d-none");
    frmRegister.classList.add("d-none");
  });
  // Registrarse
  registrarse.addEventListener("click", function () {
    let formData = new FormData();
    formData.append("nombre", nombreRegistro.value);
    formData.append("correo", correoRegistro.value);
    formData.append("contrasena", contrasenaRegistro.value);
    const url = base_url + "clientes/registroDirecto";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(formData);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        Swal.fire("Aviso", res.msg, res.icono);
        if (res.icono == "success") {
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        }
      }
    };
  });
});
