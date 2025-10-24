<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex">

    <!-- Imagen a la izquierda -->
    <div class="w-1/2 h-screen">
        <img src="./Recursos/img/login.jpg" alt="Login" class="w-full h-full object-cover bg-purple-50">
       
    </div>

    <!-- Formulario a la derecha -->
    <div class="w-1/2 h-screen flex items-center justify-center bg-gray-100">
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
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition duration-200">
                Iniciar Sesión
            </button>

            <!-- Mostrar errores si existen -->
            <?php if (isset($err)) : ?>
                <p class="text-red-500 text-sm text-center"><?php echo $err; ?></p>
            <?php endif; ?>

        </form>
    </div>

</body>
</html>
