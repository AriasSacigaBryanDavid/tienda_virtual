<?php
class Principal extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    // VISTA ABOUT
    public function about()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Nuestro Equipo';
        $this->views->getView('principal', "about", $data);
    }
    // VISTA SHOP
    public function shop($page)
    {
        $data['perfil'] = 'no';
        $pagina = (empty($page)) ? 1 : $page;
        $porPagina = 20;
        $desde = ($pagina - 1) * $porPagina;
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
        $data['perfil'] = 'no';
        $data['producto'] = $this->model->getProducto($id_producto);
        $id_categoria = $data['producto']['id_categoria'];
        $data['relacionados'] = $this->model->getAleatorios($id_categoria, $data['producto']['id']);
        $data['title'] = $data['producto']['nombre'];
        $this->views->getView('principal', "detail", $data);
    }
    // VISTA CATEGORIA
    public function categorias($datos)
    {
        $data['perfil'] = 'no';
        $id_categoria = 1;
        $page = 1;
        $array = explode(',', $datos);
        if (isset($array[0])) {
            if (!empty($array[0])) {
                $id_categoria = $array[0];
            }
        }
        if (isset($array[1])) {
            if (!empty($array[1])) {
                $page = $array[1];
            }
        }
        $pagina = (empty($page)) ? 1 : $page;
        $porPagina = 16;
        $desde = ($pagina - 1) * $porPagina;

        $data['pagina'] = $pagina;
        $total = $this->model->getTotalProductosCat($id_categoria);
        $data['total'] = ceil($total['total'] / $porPagina);


        $data['productos'] = $this->model->getProductosCat($id_categoria, $desde, $porPagina);
        $data['title'] = 'categorias';
        $data['id_categoria'] = $id_categoria;
        $this->views->getView('principal', "categorias", $data);
    }
    // VISTA CONTACT
    public function contact()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Contactos';
        $this->views->getView('principal', "contact", $data);
    }
    // VISTA LISTA DESEOS
    public function deseo()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Tu lista de deseos';
        $this->views->getView('principal', "deseo", $data);
    }
    // OBTENER PRODUCTO A PARTIR DE LA LISTA DE DESEOS
    // public function listaDeseo()
    // {
    //     $datos = file_get_contents('php://input');
    //     $json = json_decode($datos, true);
    //     $array['productos'] = array();
    //     foreach ($json as $producto) {
    //         $result = $this->model->getProducto($producto['idProducto']);
    //         $data['id'] = $result['id'];
    //         $data['nombre'] = $result['nombre'];
    //         $data['precio'] = $result['precio'];
    //         $data['cantidad'] = $producto['cantidad'];
    //         $data['imagen'] = $result['imagen'];
    //         array_push($array['productos'], $data);
    //     }
    //     $array['moneda'] = MONEDA;
    //     echo json_encode($array, JSON_UNESCAPED_UNICODE);
    //     die();  
    // }
    // OBTENER PRODUCTO A PARTIR DE LA LISTA DE CARRITOS
    public function listaProductos()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $array['productos'] = array();
        $total = 0.00;
        if (!empty($json)) {
            foreach ($json as $producto) {
                $result = $this->model->getProducto($producto['idProducto']);
                $data['id'] = $result['id'];
                $data['nombre'] = $result['nombre'];
                $data['precio'] = $result['precio'];
                $data['cantidad'] = $producto['cantidad'];
                $data['imagen'] = $result['imagen'];
                // $data['subTotal'] = number_format($result['precio'] * $producto['cantidad'], 2);
                $subTotal = $result['precio'] * $producto['cantidad'];
                $data['subTotal'] = number_format($subTotal, 2);
                array_push($array['productos'], $data);
                $total += $subTotal;
            }
        }

        $array['total'] = number_format($total, 2);
        $array['totalpaypal'] = number_format($total, 2, '.', '');
        $array['moneda'] = MONEDA;
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function busqueda($valor)
    {
        $data = $this->model->getBusqueda($valor);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
