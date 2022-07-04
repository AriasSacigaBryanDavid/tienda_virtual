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
        public function shop($page)
        {
            $pagina = (empty($page)) ? 1 : $page ;
            $porPagina =20;
            $desde = ($pagina -1) * $porPagina;
            $data['title'] = 'Nuestro Productos';
            $data['productos'] = $this->model->getProductos($desde, $porPagina);
            $data['pagina'] = $pagina;
            $total = $this->model->getTotalProductos();
            $data['total'] = ceil($total['total'] / $porPagina);
            $this->views->getView('principal', "shop", $data);
        }
        // VISTA DETAIL
        public function detail($id_producto)
        {
            $data['producto'] = $this->model->getProducto($id_producto);
            $data['title'] = $data['producto']['nombre'];
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