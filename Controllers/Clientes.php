<?php
// start herramienta de phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// end herramienta de phpmailer

class Clientes extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        // session_destroy();
    }
    public function index()
    {
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        $data['title'] = 'Tu Perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }
    // Registro Directo
    public function registroDirecto()
    {
        if (isset($_POST['nombre']) && isset($_POST['contrasena'])) {
            if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['contrasena'])) {
                $mensaje = array('msg' => 'Todos los campos son obligatorio', 'icono' => 'warning');
            } else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $contrasena = $_POST['contrasena'];
                $verificar = $this->model->getVerificar($correo);
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
                    $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                    // $this->enviarCorreo($correo, $token);
                    // exit;
                    if ($data > 0) {
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre;
                        $mensaje = array('msg' => 'registrado con éxito', 'icono' => 'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'error al registrarse', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'Ya Tienes Una Cuenta', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    // enviar correo acceso de verificcion
    public function enviarCorreo()
    {
        if (isset($_POST['correo']) && isset($_POST['token'])) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = USER_SMTP;                     //SMTP username
                $mail->Password   = PASS_SMTP;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('bariassaciga@gmail.com', TITLE);
                $mail->addAddress($_POST['correo']);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Mensaje desde la: ' . TITLE;
                $mail->Body    = 'Para verificar tu correo en nuestra tienda <a href="' . BASE_URL . 'clientes/verificarCorreo/' . $_POST['token'] . '">CLICK AQUÍ</a>';
                $mail->AltBody = 'GRACIAS POR SU PREFERENCIA';

                $mail->send();
                $mensaje = array('msg' => 'Correo enviado con éxito, Revisa tu Entrada - Span', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje = array('msg' => 'Error al Enviar Correo: ' . $mail->ErrorInfo, 'icono' => 'error');
            }
        } else {
            echo 'error fatal';
            $mensaje = array('msg' => 'Error Fatal', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }
    //verificar si es correcto el token
    public function verificarCorreo($token)
    {
        $verificar = $this->model->getToken($token);
        if (!empty($verificar)) {
            $data = $this->model->actualizarVerify($verificar['id']);
            header('Location: ' . BASE_URL . 'clientes');
        }
    }
    // logindirecto
    public function loginDirecto()
    {
        if (isset($_POST['correoLogin']) && isset($_POST['contrasenaLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['contrasenaLogin'])) {
                $mensaje = array('msg' => 'Todos los campos son obligatorio', 'icono' => 'warning');
            } else {
                $correo = $_POST['correoLogin'];
                $contrasena = $_POST['contrasenaLogin'];
                $verificar = $this->model->getVerificar($correo);
                if (!empty($verificar)) {
                    if (password_verify($contrasena, $verificar['contrasena'])) {
                        $_SESSION['correoCliente'] = $verificar['correo'];
                        $_SESSION['nombreCliente'] = $verificar['nombre'];
                        $mensaje = array('msg' => 'ok', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => 'Contraseña Incorrecta', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'El Correo No Existe', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    //registrar pedido
    public function registrarPedido()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $pedidos = $json['pedidos'];
        $productos = $json['productos'];
        if (is_array($pedidos) && is_array($productos)) {
            $id_transaccion = $pedidos['id'];
            $monto = $pedidos['purchase_units'][0]['amount']['value'];
            $estado = $pedidos['status'];
            $fecha = date('Y-m-d H:i:s');
            $email = $pedidos['payer']['email_address'];
            $nombre = $pedidos['payer']['name']['given_name'];
            $apellido = $pedidos['payer']['name']['surname'];
            $direccion = $pedidos['purchase_units'][0]['shipping']['address']['address_line_1'];
            $ciudad = $pedidos['purchase_units'][0]['shipping']['address']['admin_area_2'];
            $email_user = $_SESSION['correoCliente'];
            $data = $this->model->registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $email_user);

            if ($data > 0) {
                foreach ($productos as $producto) {
                    $temp = $this->model->getProducto($producto['idProducto']);
                    $this->model->registrarDetalle($temp['nombre'], $temp['precio'], $producto['cantidad'], $data);
                }
                $mensaje = array('msg' => 'Pedido registrado con exito', 'icono' => 'success');
            } else {
                $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error fatal con los datos', 'icono' => 'error');
        }
        echo json_encode($mensaje);
        die();
    }
    //listar productos pendientes
    public function listarPendientes()
    {
        $data = $this->model->getPedidos(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="text-center">
            <button class="btn btn-primary" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
            
            </div>';
        }
        echo json_encode($data);
        die();
    }
    //ver pedidos
    public function verPedido($idPedido)
    {
        $data['productos'] = $this->model->verPedido($idPedido);
        $data['moneda'] = MONEDA;
        echo json_encode($data);
        die();
    }
}
