document.addEventListener("DOMContentLoaded", function () {
  //carga datos usuarios con DataTables
  $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "Usuarios/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombres" },
      { data: "apellidos" },
      { data: "correo" },
      { data: "perfil" },
    ],
    language,
    dom,
    buttons,
  });
});
