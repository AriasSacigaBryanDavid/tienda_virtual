<?php
    class Principal extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index()
        {
            
        }
        // VISTA ABOUT
        public function about()
        {
            $data['title'] = 'Nuestro Equipo';
            $this->views->getView('Principal', "about", $data);
        }
        // VISTA SHOP
        public function shop()
        {
            $data['title'] = 'Nuestro Productos';
            $this->views->getView('Principal', "shop", $data);
        }
        // VISTA DETAIL
        public function detail($id_producto)
        {
            $data['title'] = 'Detalles Productos';
            $this->views->getView('Principal', "detail", $data);
        }
        // VISTA CONTACT
        public function contact()
        {
            $data['title'] = 'Contactos';
            $this->views->getView('Principal', "contact", $data);
        }
    }
?>