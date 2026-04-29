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

}
