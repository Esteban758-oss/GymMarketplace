<?php
class AuthHelper {
    static function isLoged(){  
        return (isset($_SESSION['logueado']) && $_SESSION['logueado'] == true);
    }
}