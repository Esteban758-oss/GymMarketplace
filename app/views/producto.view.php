<?php
class ProductoView {
    public function showProductos($productos) {
        // Acá iría todo el HTML (head, body, etc.)
        echo "<h1>Catálogo de Gym Shop</h1>";
        
        echo "<ul>";
        foreach($productos as $producto) {
            echo "<li>" . $producto->nombre . " - $" . $producto->precio . " (Categoría: " . $producto->categoria . ")</li>";
        }
        echo "</ul>";
    }
}