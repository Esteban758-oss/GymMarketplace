<?php
class ProductoView {

    function showProductos($productos) {
        // Acá iría todo el HTML (head, body, etc.)
        echo "<h1>Catálogo de Gym Shop</h1>";
        
        echo "<ul>";
        foreach($productos as $producto) {
            echo "<li>" . $producto->nombre . " - $" . $producto->precio . " <a href='" . BASE_URL . "detalle/" . $producto->id . "'>Ver Detalle</a></li>";
        }
        echo "</ul>";
    }

    function showDetalle($producto){
        echo "<h1>Detalle del Producto</h1>";
        
        // Mostramos todos los campos de la tabla
        echo "<h2>" . $producto->nombre . "</h2>";
        
        echo "<p><strong>Categoría:</strong> " . $producto->nombre_categoria . "</p>"; 
        
        echo "<p><strong>Descripción:</strong> " . $producto->descripcion . "</p>";
        echo "<p><strong>Precio:</strong> $" . $producto->precio . "</p>";
        echo "<p><strong>Stock disponible:</strong> " . $producto->stock . " unidades</p>";
        
        // Botón para volver usando la constante BASE_URL para que no se rompan las rutas
        echo "<br><a href='" . BASE_URL . "listar'>Volver al catálogo</a>";
    }

    // Método extra para mostrar mensajes de error si algo falla
    function showError($mensaje) {
        echo "<h2>Error</h2>";
        echo "<p>" . $mensaje . "</p>";
        echo "<a href='" . BASE_URL . "listar'>Volver al inicio</a>";
    }
}