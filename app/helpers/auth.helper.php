<?php
class AuthHelper {
    static function verify(){  
        //funcion estatica para ser llamada directamente sin tener que creau un objeto new AuthHelper
        session_start();
        if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
            header('Location: ' . BASE_URL . 'login');
            //si no esta logueado lo manda directo al login de vuelta
            die();
        }
    }
}