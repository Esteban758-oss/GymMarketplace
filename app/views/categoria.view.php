<?php
require_once __DIR__ . '/../helpers/auth.helper.php';
class CategoriaView {
    public function showCategorias($categorias) {

        if(AuthHelper::isLoged()){
            mostrarForm();
        }
        echo "<h1>Catálogo de Gym Shop</h1>";
        
        echo "<ul>";
        foreach($categorias as $categoria) {
            echo "<li> $categoria->nombre - Descripción: $categoria->descripcion | ";
            echo "<a href='" . BASE_URL . "categoria/$categoria->id'> VER ITEMS </a> - "; //PENDIENTE
            if(AuthHelper::isLoged()){
                echo "<a href='" . BASE_URL . "actualizar-categoria/$categoria->id'> EDITAR </a> - ";
                echo "<a href='" . BASE_URL . "eliminar-categoria/$categoria->id'> ELIMINAR </a>";
            }
            echo "</li>";
        }
        echo "</ul>";
    }
    private function mostrarForm(){
        echo "<h1>Crear nueva categoría</h1>";

        echo '<form action="insertar-categoria/" method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label>
        <label>Descripcion: <input type="text" name="descripcion" required></label>
        <input type="submit">
        </form>';
    }
    public function showCategoria($categoria) {
        // Acá iría todo el HTML (head, body, etc.)
        echo "<h1>Catálogo de Gym Shop</h1>";
        
        echo "<ul>";
            echo "<li> $categoria->nombre - Descripción: $categoria->descripcion </li>";
        echo "</ul>";
    }
}