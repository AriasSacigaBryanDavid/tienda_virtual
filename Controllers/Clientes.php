<?php
class Clientes extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        $data['title'] = 'Tu Perfil';
        $this->views->getView('principal', "perfil", $data);
    }
    public function registroDirecto()
    {
        if (isset($_POST['nombre']) && isset($_POST['contrasena'])) {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $data = $this->model->registroDirecto($nombre, $correo, $hash);
            if ($data > 0) {
                $mensaje = array('msg' => 'registrado con éxito', 'icono' => 'success');
            } else {
                $mensaje = array('msg' => 'error al registrarse', 'icono' => 'error');
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
