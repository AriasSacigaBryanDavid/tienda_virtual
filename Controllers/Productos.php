<?php
class Productos extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        // session_destroy();    // Es para borrar la seecion cuando no aun un boton de cerrar seccion
    }
    public function index()
    {
        $data['title'] = 'Productos';
        $data['categorias']=$this->model->getCategoria();
        $this->views->getView('admin/productos', "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getProductos(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '
            <div class="avatar avatar-xl">
                <img alt="'.$data[$i]['nombre'].'" src="'.$data[$i]['imagen'].'" class="rounded-circle" />
            </div>';
            $data[$i]['accion'] = '
            <div class="d-flex">
                <button class="btn btn-outline-info mb-2 me-4 btn-rounded btn-icon" onclick="editProd(' . $data[$i]['id'] . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                </button>
                <button class="btn btn-outline-danger mb-2 me-4 btn-rounded btn-icon" onclick="eliminarProd(' . $data[$i]['id'] . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
            </div>';
        }
        echo json_encode($data);
        die();
    }
    // registrar categorias
    public function registrar()
    {
        if (isset($_POST['categoria']) && isset($_POST['producto']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['cantidad']) && isset($_FILES['imagen'])) {
            $id = $_POST['id'];
            $categoria = $_POST['categoria'];
            $producto = $_POST['producto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $ruta = 'Assets/img/productos/';
            $nombreImg = date('YmdHis');

            if (empty($_POST['categoria']) || empty($_POST['producto']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['cantidad'])) {
                $respuesta = array('msg' => 'Todo los campos son requeridos', 'icono' => 'warning');
            } else {
                if (!empty($imagen['name'])) {
                    $destino = $ruta . $nombreImg . '.jpg';
                } else if (!empty($_POST['imagen_actual'] && empty($imagen['name']))) {
                    $destino = $_POST['imagen_actual'];
                } else {
                    $destino = $ruta . 'default.png';
                }

                if (empty($id)) {
                    $result = $this->model->verificarProducto($producto);
                    if (empty($result)) {
                        $data = $this->model->registrar($categoria, $producto, $descripcion, $precio, $cantidad ,$destino);
                        if ($data > 0) {
                            if (!empty($imagen['name'])) {
                                move_uploaded_file($tmp_name, $destino);
                            }
                            $respuesta = array('msg' => 'Producto registrado con éxito', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'El producto ya existe', 'icono' => 'warning');
                    }
                } else {
                    $result = $this->model->verificarProducto($producto);
                    if (empty($result)) {
                        $data = $this->model->modificar($categoria, $producto, $descripcion, $precio, $cantidad , $destino, $id);
                        if ($data == 1) {
                            if (!empty($imagen['name'])) {
                                move_uploaded_file($tmp_name, $destino);
                            }
                            $respuesta = array('msg' => 'Producto modificado con éxito', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'error al modificar', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'El Producto ya existe', 'icono' => 'warning');
                    }
                }
            }

            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    // eliminar productos
    public function delete($idPro)
    {
        if (is_numeric($idPro)) {
            $data = $this->model->eliminar($idPro);
            if ($data == 1) {
                $respuesta = array('msg' => 'Producto dado de baja', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Error Desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    // editar usuarios
    public function editar($idPro)
    {
        if (is_numeric($idPro)) {
            $data = $this->model->getProducto($idPro);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
