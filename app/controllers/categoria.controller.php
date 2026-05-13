<?php
include_once __DIR__ . '/../models/categoria.model.php';
include_once __DIR__ . '/../views/categoria.phtml';
include_once __DIR__ . '/../views/producto.view.php';

class CategoriaController {

    private $model;
    private $view;
    private $view_producto;

    function __construct(){
       
        $this->model = new CategoriaModel();
        
        $this->view = new CategoriaView();
        $this->view_producto = new ProductoView();
    }

    //Imprimir las categorias
    function showCategorias(){
        //obtiene los categorias del modelo
        $categorias = $this->model->getCategorias();
        //actualizo la vista
        $this->view->showCategorias($categorias);
    }

    //Imprimir la categoria
    function showCategoria($id){
        //obtiene los categorias del modelo
        $categoria = $this->model->getCategoria($id);
        //actualizo la vista
        // $this->view->showCategoria($categoria);
        $this->view_producto->showProductos($categoria);

    }

    //Inserta una categoria en el sistema
    function addCategoria(){
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        //verifico campos obligatorios
        if (empty($nombre) || empty($descripcion)){
            $this->view->showError('Faltan datos obligatorios');
            die();
        }

        //inserto la categoria en la DB
        //Para que estoy guardando la id??
        $id = $this->model->insertCategoria($nombre, $descripcion);
    
        //redirigimos al listado
        header("Location: " . BASE_URL . "categorias/");    
    }

    //Elimina el categoria del sistema
    function deleteCategoria($id){
        $this->model->deleteCategoria($id);
        header("Location: " . BASE_URL . "categorias/");    

    }

    function updateCategoria($id){
        $nombre = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        if (empty($nombre) || empty($descripcion)){
            $this->view->showError('Faltan datos obligatorios');
            die();
        }

        //Para que estoy guardando la id??
        $this->model->updateCategoria($id, $nombre, $descripcion);
    
        //redirigimos al listado de categorias
        header("Location: " . BASE_URL . "categorias/");    

    }

}
