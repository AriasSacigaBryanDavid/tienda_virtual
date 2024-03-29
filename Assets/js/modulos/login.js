const frm = document.querySelector("#frm_login");
const email = document.querySelector("#email");
const password = document.querySelector("#password");

document.addEventListener("DOMContentLoaded", function () {
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (email.value == "" || password.value == "") {
      alertas("todo los campos son requeridos", "warning");
    } else {
      let data = new FormData(this);
      const url = base_url + "admin/validar";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //   console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            setTimeout(() => {
              window.location = base_url + "admin/home";
            }, 2000);
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
});

// function alertas(msg, icono) {
//   Swal.fire("Aviso", msg.toUpperCase(), icono);
// }
function alertas(msg, icono) {
    Swal.fire({
        icon: icono,
        title: msg.toUpperCase(),
    })

}