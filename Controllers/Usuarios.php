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
    public function registrar()
    {
        if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['contrasena']) && isset($_POST['confirmarcontrasena'])) {
            if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['confirmarcontrasena'])) {
                $respuesta = array('msg' => 'Todo los campos son requeridos', 'icono' => 'warning');
            } else {
                if ($_POST['contrasena'] != $_POST['confirmarcontrasena']) {
                    $respuesta = array('msg' => 'Las Contraseñas no coinciden', 'icono' => 'warning');
                }else {
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $correo = $_POST['correo'];
                    $contrasena = $_POST['contrasena'];
                    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    
                    $data = $this->model->registrar($nombre, $apellido, $correo, $hash);
                    if ($data > 0) {
                        $respuesta = array('msg' => 'usuario registrado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
                    }
                }
                
            }
            
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
