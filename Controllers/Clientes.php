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
            $token = md5($correo);
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
            // $this->enviarCorreo($correo, $token);
            // exit;
            if ($data > 0) {
                $mensaje = array('msg' => 'registrado con éxito', 'icono' => 'success', 'token' => $token);
            } else {
                $mensaje = array('msg' => 'error al registrarse', 'icono' => 'error');
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
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
    public function verificarCorreo($token)
    {
        print_r($token);
    }
}
