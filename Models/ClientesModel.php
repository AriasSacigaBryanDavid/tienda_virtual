<?php
class ClientesModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function registroDirecto($nombre, $correo, $contrasena)
    {
        $sql = "INSERT INTO clientes (nombre, correo, contrasena) values(?,?,?)";
        $datos = array($nombre, $correo, $contrasena);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }
}
