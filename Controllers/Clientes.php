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
}
