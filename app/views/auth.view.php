<?php
class AuthView {

    public function showLogin($error = null) {
         //cuando el usuario haga click en entrar el navegador lo redirige al verify
        echo '
        <div class="container">
            <form action="' . BASE_URL . 'verify" method="POST">  
                <h1>Iniciar Sesión</h1>
                
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="admin@admin.com">

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required>';

        // si el controlador nos pasa un error, lo mostramos
        if ($error) {
            echo '<p class="error" style="color:red">' . $error . '</p>';
        }

        echo '
                <button type="submit">Entrar</button>
            </form>
        </div>
        ';
    }
}