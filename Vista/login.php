
<body class="min-h-screen flex">

    <!-- Imagen a la izquierda con overlay y texto -->
    <div class="w-1/2 h-screen relative overflow-hidden">
        <img src="./Recursos/img/login.jpg" alt="Login" class="w-full h-full object-cover">
        
        <!-- Filtro oscuro que aclara la imagen -->
        <div class="absolute inset-0 bg-black opacity-70"></div>
        
        <!-- Texto centrado -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-6xl font-bold" style="font-family: 'Roboto Slab';">
                    <span style="color: #60a1deff;">Control</span><span style="color: #7e8691ff;">T2</span>
                </h1>
            </div>
        </div>
    </div>

    <!-- Formulario a la derecha -->
    <div class="w-1/2 h-screen flex items-center justify-center bg-gray-200">
        <form action="?action=iniciarSesion" method="post" class="w-full max-w-md bg-white p-8 rounded shadow-lg space-y-6">

            <h1 class="text-2xl font-bold text-center">Inicia Sesión</h1>

            <div>
                <label for="floatingInput" class="block text-gray-700 font-medium mb-1">Nombre de Usuario</label>
                <input type="text" name="nom" id="floatingInput" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                    value="<?php if(isset($_COOKIE['nom'])) echo $_COOKIE['nom']; ?>">
            </div>

            <div>
                <label for="floatingPassword" class="block text-gray-700 font-medium mb-1">Contraseña</label>
                <input type="password" name="psw" id="floatingPassword" placeholder="Contraseña"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" name="rec" id="flexCheckDefault" class="form-checkbox text-blue-600"
                    <?php if(isset($_COOKIE['nom'])) echo 'checked'; ?>>
                <label for="flexCheckDefault" class="text-gray-700">Recuérdame</label>
            </div>

            <button type="submit" name="fini"
                class="w-full text-white font-semibold py-2 rounded transition duration-200"
                style="background-color: #1964ab;" 
                onmouseover="this.style.backgroundColor='#0d3a7d'"
                onmouseout="this.style.backgroundColor='#1964ab'">
                Iniciar Sesión
            </button>

            <button type="submit"  action="./crearUsuario.php" name="fini"
                class="w-full text-white font-semibold py-2 rounded transition duration-200"
                style="background-color: #1964ab;" 
                onmouseover="this.style.backgroundColor='#0d3a7d'"
                onmouseout="this.style.backgroundColor='#1964ab'">
Registrar            </button>

           <?php if (isset($err)) : ?>
                <p class="text-red-500 text-sm text-center"><?php echo $err; ?></p>
            <?php endif; ?>

        </form>
    </div>

    <!-- Modal de error centralizado -->
    <?php if (isset($err)): ?>
    <div id="errorModal" class="fixed inset-0 z-50 flex items-center justify-center">
      <div class="absolute inset-0 bg-black opacity-70"></div>
      <div class="relative bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 mx-4 text-center">
        <h3 class="text-xl font-semibold text-red-600 mb-2">Error</h3>
        <p class="mb-4">Contraseña Incorrecta<br>Vuelve a intentarlo</p>
        
        <div class="flex justify-center">
          <button id="closeModal" class="px-4 py-2 text-white rounded"
            style="background-color: #1964ab;">
            Cerrar
          </button>
        </div>
      </div>
    </div>

    <script>
      (function(){
        const modal = document.getElementById('errorModal');
        const btn = document.getElementById('closeModal');
        btn.addEventListener('click', () => modal.remove());
        // cerrar con ESC
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') modal.remove(); });
      })();
    </script>
    <?php endif; ?>

</body>
<script src="https://cdn.tailwindcss.com"></script>
</html>