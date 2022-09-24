<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        // session_destroy();    // Es para borrar la seecion cuando no aun un boton de cerrar seccion
    }
    public function index()
    {
        $data['title'] = 'Usuarios';
        $this->views->getView('admin/usuarios', "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getUsuarios();
        echo json_encode($data);
        die();
    }
}
