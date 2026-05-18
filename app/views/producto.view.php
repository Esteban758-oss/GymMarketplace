<?php
require_once __DIR__ . '/../helpers/auth.helper.php';
class ProductoView {

    function showProductos($productos) {
        echo "<h1>Catálogo de Gym Shop</h1>";
        
        echo "<ul>";
        foreach($productos as $producto) {
            echo "<li>" . $producto->nombre . " - $" . $producto->precio . " <a href='" . BASE_URL . "detalle/" . $producto->id . "'>Ver Detalle</a></li>";
            if (AuthHelper::isLoged()) {
            echo "<a href='eliminar/$producto->id'>Eliminar</a>";
            echo "<a href='editar/$producto->id'>Editar</a>";
            }
        }
        echo "</ul>";
        if (AuthHelper::isLoged()) {
            $this->showAddForm();
        }
    }

    public function showAddForm() {
        echo '
        <h2>Agregar Producto</h2>
        <form action="add" method="POST">
            <input name="nombre" placeholder="Nombre">
            <input name="precio" placeholder="Precio">
            <select name="id_categoria"> </select>
            <button type="submit">Guardar</button>
        </form>';
    }

    public function showEditForm($producto) {
        echo "
        <h2>Editando: $producto->nombre</h2>
        <form action='update/$producto->id' method='POST'>
            <input name='nombre' value='$producto->nombre'>
            <input name='precio' value='$producto->precio'>
            <button type='submit'>Actualizar Cambios</button>
        </form>";
    }

    function showDetalle($producto){
        echo "<h1>Detalle del Producto</h1>";
        
        // Mostramos todos los campos de la tabla
        echo "<h2>" . $producto->nombre . "</h2>";
        
        echo "<p><strong>Categoría:</strong> " . $producto->nombre_categoria . "</p>"; 
        
        echo "<p><strong>Descripción:</strong> " . $producto->descripcion . "</p>";
        echo "<p><strong>Precio:</strong> $" . $producto->precio . "</p>";
        echo "<p><strong>Stock disponible:</strong> " . $producto->stock . " unidades</p>";
        
        echo "<br><a href='" . BASE_URL . "listar'>Volver al catálogo</a>";
    }

    // Método extra para mostrar mensajes de error si algo falla
    function showError($mensaje) {
        echo "<h2>Error</h2>";
        echo "<p>" . $mensaje . "</p>";
        echo "<a href='" . BASE_URL . "listar'>Volver al inicio</a>";
    }
}