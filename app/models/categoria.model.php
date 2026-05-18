<?php
require_once __DIR__ . '/model.php';
class CategoriaModel extends Model{
    
    function getCategorias(){
        //1. La conexión ya se establece en el constructor del padre Model.

        //2.enviar la consulta
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();
        //3. obtengo la respuesta con un fetchAll (porque son muchos)
        $categorias = $query->fetchAll(PDO::FETCH_OBJ); //arreglo de productos

        return $categorias;

    }        
    function getProductosPorCategoria($idCategoria){
        //1. La conexión ya se establece en el constructor del padre Model.

        //2.enviar la consulta
        $consulta = 'SELECT categoria.nombre AS "categoria", categoria.descripcion AS "descripcion_categoria", producto.* FROM categoria JOIN producto ON categoria.id = producto.id_categoria WHERE categoria.id = ?';
        $query = $this->db->prepare($consulta);
        $query->execute([$idCategoria]);
        //3. obtengo la respuesta con un fetch (es una sola categoría)
        $productos = $query->fetchAll(PDO::FETCH_OBJ); //objeto de producto

        return $productos;
    }      
    
    function insertCategoria($nombre, $descripcion){

        $consulta = 'INSERT INTO categoria(nombre, descripcion) VALUES (?,?)';
        $query = $this->db->prepare($consulta);
        $query->execute([$nombre, $descripcion]);

        return $this->db->lastInsertId();

    }

    function deleteCategoria($id){

      $consulta = 'DELETE FROM categoria WHERE id = ?';
      $query = $this->db->prepare($consulta);
      $query->execute([$id]);

    }

}
