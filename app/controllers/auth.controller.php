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
        //die(password_hash('admin', PASSWORD_BCRYPT));
        $this->view->showLogin();
    }

    function verify (){
        //atrapo los datos del formulario a traves del arreglo superglobal
        $email= $_POST['email'];
        $password= $_POST['password'];
        //busco el usuario en la base de datos
        $usuario=$this->model->getUsuarioByEmail($email);
        //chequeo que exista y que la clave sea la misma
        if ($usuario && password_verify($password, $usuario->password)){
            session_start();  //para que recuerde al usuario
            $_SESSION["logueado"] = true;
            $_SESSION["username"] = $usuario->email;
            header("Location: " . BASE_URL);
        } else{
            $this->view->showLogin("Acceso denegado");
        }
    }
}
