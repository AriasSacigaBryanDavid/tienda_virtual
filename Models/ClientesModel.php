<?php
class ClientesModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function registroDirecto($nombre, $correo, $contrasena, $token)
    {
        $sql = "INSERT INTO clientes (nombre, correo, contrasena, token) values(?,?,?,?)";
        $datos = array($nombre, $correo, $contrasena, $token);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
}
