<?php
include_once __DIR__ . '/../models/producto.model.php';
include_once __DIR__ . '/../views/producto.view.php';

class ProductoController {

    private $model;
    private $view;

    function __construct(){
       
        $this->model = new ProductoModel();
        
        $this->view = new ProductoView();
    }

    //Imprimir los productos
    function showProductos(){
        //obtiene los productos del modelo
        $productos = $this->model->getProductos();
        //actualizo la vista
        $this->view->showProductos($productos);
    }

    //Inserta un producto en el sistema
    function addProducto(){
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $id_categoria= $_POST['id_categoria'];

        //verifico campos obligatorios
        if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock)){
            $this->view->showError('Faltan datos obligatorios');
            die();
        }

        //inserto la tarea en la DB
        //Para que estoy guardando la id??
        $id = $this->model->insertProducto($nombre, $descripcion, $precio, $stock);
    
        //redirigimos al listado
        header("Location: " . BASE_URL);    
    }

    //Elimina el producto del sistema
    function deleteProducto($id){
        $this->model->removeProducto($id);
        header("Location: " . BASE_URL);
    }

    function updateProducto($id){
        $nombre = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];

        //verifico campos obligatorios
        if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock)){
            $this->view->showError('Faltan datos obligatorios');
            die();
        }

        //inserto la tarea en la DB
        //Para que estoy guardando la id??
        $this->model->updateProducto($id, $nombre, $descripcion, $precio, $stock);
    
        //redirigimos al listado
        header("Location: " . BASE_URL);  
    }

}
