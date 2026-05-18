<?php
require_once __DIR__ . '/model.php';
class ProductoModel extends Model{
    
    function getProductos(){
        //1. La conexión ya se establece en el constructor del padre Model.

        //2.enviar la consulta
        $query = $this->db->prepare('SELECT producto.*, categoria.nombre AS categoria FROM producto JOIN categoria ON producto.id_categoria = categoria.id');
        $query->execute();
        //3. obtengo la respuesta con un fetchAll (porque son muchos)
        $productos = $query->fetchAll(PDO::FETCH_OBJ); //arreglo de productos

        return $productos;

    }       

      //NUEVO->

    function getProducto($id){
        $query=$this->db->prepare('SELECT p.*, c.nombre AS nombre_categoria FROM producto p JOIN categoria c ON p.id_categoria = c.id WHERE p.id = ?');
        $query->execute([$id]);

        $producto = $query->fetch(PDO:: FETCH_OBJ);
        return $producto;   
    } 

    function insertProducto($nombre, $desc, $precio, $stock, $id_categoria){
        $query = $this->db->prepare('INSERT INTO producto (nombre, descripcion, precio, stock, id_categoria) VALUES (?,?,?,?,?)');
        $query->execute([$nombre, $desc, $precio, $stock, $id_categoria]);
        return $this->db->lastInsertId;
    }

    function updateProducto($id, $nombre, $descripcion, $precio, $stock, $id_categoria){
        $query=$this->db->prepare('UPDATE producto set nombre = ?, descripcion = ?, precio = ?, stock = ?, id_categoria = ? WHERE id = ?');
        $query->execute([$nombre, $descripcion, $precio, $stock, $id_categoria]);
    }

    function removeProducto($id){
        $query=$this->db->prepare('DELETE FROM producto WHERE id = ?');
        $query->execute([$id]);
    }


}
