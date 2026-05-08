<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/app/controllers/producto.controller.php';
require_once __DIR__ . '/app/controllers/auth.controller.php';

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
    case 'detalle':         //NUEVO 
        $controller = new ProductoController();
        $id=$params[1];
        $controller->showDetalle($id);
        break;
    default:
        echo('404 page not found');
        break;
}