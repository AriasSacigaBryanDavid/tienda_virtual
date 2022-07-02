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
            $this->views->getView('principal', "about", $data);
        }
        // VISTA SHOP
        public function shop()
        {
            $data['title'] = 'Nuestro Productos';
            $this->views->getView('principal', "shop", $data);
        }
        // VISTA DETAIL
        public function detail($id_producto)
        {
            $data['title'] = 'Detalles Productos';
            $this->views->getView('principal', "detail", $data);
        }
        // VISTA CONTACT
        public function contact()
        {
            $data['title'] = 'Contactos';
            $this->views->getView('principal', "contact", $data);
        }
    }
?>