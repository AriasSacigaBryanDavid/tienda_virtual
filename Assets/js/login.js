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

//variable de busqueda

const inputBusqueda = document.querySelector("#inputModalSearch");

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
          //console.log(this.responseText);

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

  //busqueda de productos
  inputBusqueda.addEventListener("keyup", function (e) {
    const url = base_url + "principal/busqueda/" + e.target.value;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        let html = "";
        res.forEach((producto) => {
          html += `
              <div class="col-12 col-md-4 mb-4">
              <div class="card h-100">
                <a href="${base_url + "principal/detail/" + producto.id}">
                  <img src="${producto.imagen}" class="card-img-top" alt="${
            producto.nombre
          }">
                </a>
                <div class="card-body">
                  <ul class="list-unstyled d-flex justify-content-between">
                    <li>
                      <i class="text-warning fa fa-star"></i>
                      <i class="text-warning fa fa-star"></i>
                      <i class="text-warning fa fa-star"></i>
                      <i class="text-muted fa fa-star"></i>
                      <i class="text-muted fa fa-star"></i>
                    </li>
                    <li class="text-muted text-right">${producto.precio}</li>
                  </ul>
                  <a href="${
                    base_url + "principal/detail/" + producto.id
                  }" class="h2 text-decoration-none text-dark">${
            producto.nombre
          }</a>
                  <p class="card-text">
                    ${producto.descripcion}
                  </p>
                </div>
              </div>
            </div>
          `;
        });
        document.querySelector("#resultBusqueda").innerHTML = html;
      }
    };
  });
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
