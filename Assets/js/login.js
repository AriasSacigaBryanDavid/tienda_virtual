// variables de la funcion de ocultar y mostrar formulario
const btnRegister = document.querySelector("#btnRegister");
const btnLogin = document.querySelector("#btnLogin");

const frmLogin = document.querySelector("#frmLogin");

// variables de la funcion registrarse
const frmRegister = document.querySelector("#frmRegister");
const registrarse = document.querySelector("#registrarse");
const nombreRegistro = document.querySelector("#nombreRegistro");
const correoRegistro = document.querySelector("#correoRegistro");
const contrasenaRegistro = document.querySelector("#contrasenaRegistro");

//variable de la funcion login
const login = document.querySelector("#login");
const correoLogin = document.querySelector("#correoLogin");
const contrasenaLogin = document.querySelector("#contrasenaLogin");

//btn modal de login
// const btnModalLogin = document.querySelector("#btnModalLogin");
const modalLogin = new bootstrap.Modal(document.getElementById("modalLogin"));

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
    if (
      nombreRegistro.value == "" ||
      correoRegistro.value == "" ||
      contrasenaRegistro.value == ""
    ) {
      Swal.fire("Aviso", "Todos los campos son obligatorio", "warning");
    } else {
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
              enviarCorreo(correoRegistro.value, res.token);
            }, 2000);
          }
        }
      };
    }
  });
  //login Directo
  login.addEventListener("click", function () {
    if (correoLogin.value == "" || contrasenaLogin.value == "") {
      Swal.fire("Aviso", "Todos los campos son obligatorio", "warning");
    } else {
      let formData = new FormData();
      formData.append("correoLogin", correoLogin.value);
      formData.append("contrasenaLogin", contrasenaLogin.value);
      const url = base_url + "clientes/loginDirecto";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);

          const res = JSON.parse(this.responseText);
          Swal.fire("Aviso", res.msg, res.icono);
          if (res.icono == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        }
      };
    }
  });
  //modal Login
  // btnModalLogin.addEventListener("click", function () {
  //   modalLogin.show();
  // });
});

function enviarCorreo(correo, token) {
  let formData = new FormData();
  formData.append("correo", correo);
  formData.append("token", token);
  const url = base_url + "clientes/enviarCorreo";
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
}

function abrirModalLogin() {
  myModal.hide();
  modalLogin.show();
}
