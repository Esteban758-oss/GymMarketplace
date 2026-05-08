<?php
require_once __DIR__ . '/model.php';
class UsuarioModel extends Model{
    function getUsuarioByEmail($email){
        $query=$this->db->prepare('SELECT * FROM usuario WHERE email = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}