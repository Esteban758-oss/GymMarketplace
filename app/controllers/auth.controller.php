<?php
include_once __DIR__ . '/../models/usuario.model.php';
include_once __DIR__ . '/../views/auth.view.php';
class AuthController{
    private $model;
    private $view;

    function __construct(){
        $this->model= new UsuarioModel();
        $this->view= new AuthView();
    }

    function showLogin(){
        $this->view->showLogin();
    }

    function verify (){
        //atrapo los datos del formulario a traves del arreglo superglobal
        $user= $_POST['user'];
        $password= $_POST['password'];
        //busco el usuario en la base de datos
        $usuario=$this->model->getUsuario($user);
        //chequeo que exista y que la clave sea la misma
        if ($usuario && password_verify($password, $usuario->password)){
            $_SESSION["logueado"] = true;
            $_SESSION["username"] = $usuario->user;  
            header("Location: " . BASE_URL);
        } else{
            $this->view->showLogin("Acceso denegado");
        }
    }

    function logout() {
        session_start();
        session_destroy();
        header("Location: " . BASE_URL . "login");
    }

}
