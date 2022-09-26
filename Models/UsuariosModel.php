<?php
class UsuariosModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuarios()
    {
        $sql = "SELECT id, nombres, apellidos, correo, perfil FROM usuarios";
        return $this->selectAll($sql);
    }
    public function registrar($nombre, $apellido, $correo, $contrasena)
    {
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo, contrasena) VALUES (?,?,?,?)";
        $array = array($nombre, $apellido, $correo, $contrasena);
        return $this->insertar($sql, $array);
    }
}
