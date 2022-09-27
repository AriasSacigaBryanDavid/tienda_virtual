const agregar_Categoria = document.querySelector("#registrar_categoria");
const frm = document.querySelector("#frmCategoria");
const titleCategoria = document.querySelector("#titleCategoria");
const btnAccion = document.querySelector("#btnAccion");
let tblCategorias;
document.addEventListener("DOMContentLoaded", function () {
  //carga datos usuarios con DataTables
  // $("#tblUsuarios").DataTable({
  //   ajax: {
  //     url: base_url + "Usuarios/listar",
  //     dataSrc: "",
  //   },
  //   columns: [
  //     { data: "id" },
  //     { data: "nombres" },
  //     { data: "apellidos" },
  //     { data: "correo" },
  //     { data: "perfil" },
  //   ],
  //   language,
  //   dom,
  //   buttons,
  // });

  tblCategorias = $("#tblCategorias").DataTable({
    ajax: {
      url: base_url + "Categorias/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "categoria" },
      { data: "imagen" },
      { data: "accion" }
    ],
    dom:
      "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
      "<'table-responsive'tr>" +
      "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
    buttons: {
      buttons: [
        { extend: "copy", className: "btn" },
        { extend: "csv", className: "btn" },
        { extend: "excel", className: "btn" },
        { extend: "print", className: "btn" },
      ],
    },
    oLanguage: {
      oPaginate: {
        sPrevious:
          '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
        sNext:
          '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
      },
      sInfo: "Showing page _PAGE_ of _PAGES_",
      sSearch:
        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
      sSearchPlaceholder: "Search...",
      sLengthMenu: "Results :  _MENU_",
    },
    stripeClasses: [],
    lengthMenu: [7, 10, 20, 50],
    pageLength: 10,
  });

  //abrir modal para registrar usuarios
  agregar_Categoria.addEventListener("click", function () {
    document.querySelector("#id").value = "";
    document.querySelector("#imagen_actual").value = "";
    document.querySelector("#imagen").value = "";
    titleCategoria.textContent = "Registrar Categoría";
    btnAccion.textContent = "Registrar";
    document.getElementById("frmCategoria").reset();
    $("#categoriaModal").modal("show");
  });

  //formulario submit usuarios
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "Categorias/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          frm.reset();
          tblCategorias.ajax.reload();
          $("#categoriaModal").modal("hide");
          document.querySelector("#imagen").value = "";
        }
        alertas(res.msg, res.icono);
      }
    };
  });
});

function alertas(msg, icono) {
  Swal.fire({
    icon: icono,
    title: msg.toUpperCase(),
  });
}

function eliminarCat($idCat) {
  Swal.fire({
    title: "¿Está seguro?",
    text: "¡No podrás revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Categorias/delete/" + $idCat;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          //   console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblCategorias.ajax.reload();
          }
          // Swal.fire("¡Eliminado!", "Su archivo ha sido eliminado.", "success");
          Swal.fire("¡Aviso!", res.msg.toUpperCase(), res.icono);
        }
      };
    }
  });
}

function editCat($idCat) {
  const url = base_url + "Categorias/editar/" + $idCat;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      document.querySelector("#id").value = res.id;
      document.querySelector("#categoria").value = res.categoria;
      document.querySelector("#imagen_actual").value = res.imagen;
      // document.querySelector('#contrasena').setAttribute('readonly', 'readonly' );
     
      btnAccion.textContent = "Actualizar";
      $("#categoriaModal").modal("show");
      titleCategoria.textContent = "Actualizar Categoría";
      tblCategorias.ajax.reload();
    }
  };
}
