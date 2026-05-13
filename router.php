<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/app/controllers/producto.controller.php';
require_once __DIR__ . '/app/controllers/categoria.controller.php';

// define la base URL del sitio
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


// lee la accion
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'listar'; //accion por defecto
}

//parsea la accion ()
$params= explode('/', $action);



//determina que camino seguir segun la accion
switch ($params[0]){
    case 'listar':
        $controller = new ProductoController();
        $controller->showProductos();
        break;
    case 'insertar':
        $controller = new ProductoController();
        $controller->addProducto();
        break;
    case 'eliminar': //eliminar/id
        $controller = new ProductoController();
        $id = $params[1];
        $controller->deleteProducto($id);
        break;
    case 'actualizar':
        $controller = new ProductoController();
        $id = $params[1];
        $controller->updateProducto($id);
        break;


    //RUTAS CATEGORIA
    case 'categorias':
        $controller = new CategoriaController();
        $controller->showCategorias();
        break;

    case 'categoria':
        $controller = new CategoriaController();
        $id = $params[1];
        if (!isset($id)){
            header("Location: " . BASE_URL . "categorias");  
        }
        $controller->showCategoria($id);
        break;

    case 'insertar-categoria':
        $controller = new CategoriaController();
        $controller->addCategoria();
        break;

   case 'eliminar-categoria': //eliminar-categoria/id
        $controller = new CategoriaController();
        $id = $params[1];
        $controller->deleteCategoria($id);
        break;
        
    case 'actualizar-categoria':
        $controller = new CategoriaController();
        $id = $params[1];
        $controller->updateCategoria($id);
        break;

    default:
        echo('404 page not found');
        break;
}