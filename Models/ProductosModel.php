<?php
class ProductosModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getProductos($estado)
    {
        $sql = "SELECT * FROM productos WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    public function registrar($categoria, $producto, $descripcion, $precio, $cantidad ,$destino)
    {
        $sql = "INSERT INTO productos (id_categoria, nombre, descripcion, precio, cantidad ,imagen) VALUES (?,?,?,?,?,?)";
        $array = array($categoria, $producto, $descripcion, $precio, $cantidad ,$destino);
        return $this->insertar($sql, $array);
    }
    public function verificarProducto($producto)
    {
        $sql = "SELECT nombre FROM productos WHERE nombre = '$producto' AND estado = 1";
        return $this->selectAll($sql);
    }
    // para eliminar categoria
    public function eliminar($idPro)
    {
        $sql = "UPDATE productos SET estado = ? WHERE id = ? ";
        $array = array(0, $idPro);
        return $this->save($sql, $array);
    }
    public function getProducto($idPro)
    {
        $sql = "SELECT id, nombre, descripcion, precio, cantidad, imagen, id_categoria FROM productos WHERE id = $idPro";
        return $this->select($sql);
    }
    public function modificar($categoria, $producto, $descripcion, $precio, $cantidad , $destino, $id)
    {
        $sql = "UPDATE productos SET id_categoria = ?, nombre = ?, descripcion = ?, precio = ?, cantidad = ?, imagen = ? WHERE id = ?";
        $array = array($categoria, $producto, $descripcion, $precio, $cantidad , $destino, $id);
        return $this->save($sql, $array);
    }
    public function getCategoria()
    {
        $sql="SELECT * FROM categorias WHERE estado=1";
        $data =$this->selectAll($sql);
        return $data;
    }
}
