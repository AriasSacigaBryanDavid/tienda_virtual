<?php
class AdminModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuario($email)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
        return $this->select($sql);
    }
}
