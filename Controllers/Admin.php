<?php
class Admin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        // session_destroy();    // Es para borrar la seecion cuando no aun un boton de cerrar seccion
    }
    public function index()
    {
        $data['title'] = 'Acceso al Sistema';
        $this->views->getView('admin', "login", $data);
    }
}
