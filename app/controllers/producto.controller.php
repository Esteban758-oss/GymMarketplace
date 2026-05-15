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
        //Para que estoy guardando la id??  //para redirirlo al detalle del producto que queria insertar
        $id = $this->model->insertProducto($nombre, $descripcion, $precio, $stock, $id_categoria);
    
        //redirigimos al listado
        header("Location: " . BASE_URL. "detalle/" .$id);    
    }

    //Elimina el producto del sistema
    function deleteProducto($id){
        $this->model->removeProducto($id);
        header("Location: " . BASE_URL . "listar");
    }

    // mostrar el formulario con datos viejos
    public function editProducto($id) {
        $producto = $this->model->getProducto($id);
        $this->view->showEditForm($producto);
    }

    function updateProducto($id){
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $id_categoria= $_POST['id_categoria'];
        //verifico campos obligatorios
        if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock) || empty($id_categoria) ){
            $this->view->showError('Faltan datos obligatorios');
            die();
        }

        //inserto la tarea en la DB
        //Para que estoy guardando la id??       //para redirirlo al detalle del producto que queria actualizar
        $this->model->updateProducto($id, $nombre, $descripcion, $precio, $stock, $id_categoria);
    
        //redirigimos al listado
        header("Location: " . BASE_URL . "detalle/" .$id);  
    }

    //NUEVO ->

    function showDetalle($id){
        $producto = $this->model->getProducto($id);
        if ($producto) {
            $this->view->showDetalle($producto);
        } else { 
            $this->view->showError('el producto no existe');
        }
    }

}
