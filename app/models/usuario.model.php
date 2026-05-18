<?php
require_once __DIR__ . '/model.php';
class UsuarioModel extends Model{
    function getUsuario($user){
        $query=$this->db->prepare('SELECT * FROM usuario WHERE user = ?');
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}