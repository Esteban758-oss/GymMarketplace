<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/app/controllers/producto.controller.php';
require_once __DIR__ . '/app/controllers/auth.controller.php';
require_once __DIR__ . '/app/helpers/auth.helper.php';
require_once __DIR__ . '/app/controllers/categoria.controller.php';
session_start();

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
    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'verify':
        $controller = new AuthController();
        $controller->verify();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'listar':
        $controller = new ProductoController();
        $controller->showProductos();
        break;
    case 'insertar':
        if (AuthHelper::isLoged()) {
            $controller = new ProductoController();
            $controller->addProducto();
        } else {
            header('Location: ' . BASE_URL . 'login');
        }
        break;
    case 'eliminar': //eliminar/id
        if (AuthHelper::isLoged()) {
            $controller = new ProductoController();
            $id = $params[1];
            $controller->deleteProducto($id);
        } else {
            header('Location: ' . BASE_URL . 'login');
        }
        break;
    case 'editar': 
        if (AuthHelper::isLoged()) {
            $controller = new ProductoController();
            $id = $params[1];
            $controller->editProducto($id);
        } else {
            header('Location: ' . BASE_URL . 'login');
        }
        break;
    case 'actualizar':
        if (AuthHelper::isLoged()) {
            $controller = new ProductoController();
            $id = $params[1];
            $controller->updateProducto($id);
        } else {
            header('Location: ' . BASE_URL . 'login');
        }
        break;
    case 'detalle':         //NUEVO 
        $controller = new ProductoController();
        $id=$params[1];
        $controller->showDetalle($id);
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