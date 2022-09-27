<?php
class CategoriasModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategorias($estado)
    {
        $sql = "SELECT id, categoria, imagen  FROM categorias WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    public function registrar($categoria, $destino)
    {
        $sql = "INSERT INTO categorias (categoria, imagen) VALUES (?,?)";
        $array = array($categoria, $destino);
        return $this->insertar($sql, $array);
    }
    public function verificarCategoria($categoria)
    {
        $sql = "SELECT categoria FROM categorias WHERE categoria = '$categoria' AND estado = 1";
        return $this->selectAll($sql);
    }
    // para eliminar categoria
    public function eliminar($idCat)
    {
        $sql = "UPDATE categorias SET estado = ? WHERE id = ? ";
        $array = array(0, $idCat);
        return $this->save($sql, $array);
    }
    public function getCategoria($idCat)
    {
        $sql = "SELECT id, categoria, imagen FROM categorias WHERE id = $idCat";
        return $this->select($sql);
    }
    public function modificar($categoria, $destino, $id)
    {
        $sql = "UPDATE categorias SET categoria = ?, imagen = ? WHERE id = ?";
        $array = array($categoria, $destino, $id);
        return $this->save($sql, $array);
    }
}
