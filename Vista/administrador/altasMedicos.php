<?php

// Procesar formulario de alta de médico
$msg = '';
$altaSatisfactoria = false;
$usuarioAlta = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $password_confirm = trim($_POST['password_confirm'] ?? '');
    $tipo = trim($_POST['tipo'] ?? '');

    // Validaciones
    if (empty($login) || empty($password) || empty($tipo)) {
        $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Por favor rellena todos los campos obligatorios.</div>';
    } elseif ($password !== $password_confirm) {
        $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Las contraseñas no coinciden.</div>';
    } elseif (strlen($password) < 6) {
        $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">La contraseña debe tener al menos 6 caracteres.</div>';
    } else {
        $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $model = new admin();
            
            // Crear el usuario
            if ($model->crearUsuario($login, $password, $tipo)) {
                $altaSatisfactoria = true;
                $usuarioAlta = $login;
            } else {
                $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Error al crear el usuario. El login podría estar duplicado.</div>';
            }
        }
    }
}
?>

<!-- Modal de confirmación de alta satisfactoria -->
<?php if ($altaSatisfactoria): ?>
<div id="modalAlta" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="relative bg-white rounded-2xl shadow-2xl w-11/12 max-w-md p-8 mx-4 animate-bounce-in">
        <!-- Icono de éxito -->
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center border-2 border-green-200">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <!-- Contenido del modal -->
        <h3 class="text-2xl font-bold text-center text-gray-900 mb-2">¡Alta Exitosa!</h3>
        <p class="text-center text-gray-600 mb-6 text-sm">
            El usuario ha sido registrado correctamente en el sistema
        </p>

        <!-- Detalles del alta -->
        <div class="bg-green-50 border-2 border-green-200 rounded-lg p-6 mb-6 space-y-3">
            <div class="flex items-center gap-3">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-200">
                    <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-600 font-medium">LOGIN</p>
                    <p class="text-gray-900 font-bold"><?php echo htmlspecialchars($usuarioAlta); ?></p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-200">
                    <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-600 font-medium">ESTADO</p>
                    <p class="text-gray-900 font-bold">Activo</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-200">
                    <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-600 font-medium">FECHA Y HORA</p>
                    <p class="text-gray-900 font-bold"><?php echo date('d/m/Y H:i:s'); ?></p>
                </div>
            </div>
        </div>

        <!-- Botón cerrar -->
        <button id="closeAltaModal" 
                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
            Aceptar
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('closeAltaModal');
        const modal = document.getElementById('modalAlta');
        
        closeBtn.addEventListener('click', function() {
            modal.classList.add('fade-out');
            setTimeout(() => {
                modal.style.display = 'none';
                window.location.href = '?action=altasMedicos';
            }, 300);
        });
        
        // Cerrar con ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                modal.classList.add('fade-out');
                setTimeout(() => {
                    modal.style.display = 'none';
                    window.location.href = '?action=altasMedicos';
                }, 300);
            }
        });
    });
</script>

<style>
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.8) translateY(-20px);
        }
        50% {
            opacity: 1;
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    @keyframes fadeOut {
        0% {
            opacity: 1;
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(0.8);
        }
    }
    
    .animate-bounce-in {
        animation: bounceIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .fade-out {
        animation: fadeOut 0.3s ease-out;
    }
</style>
<?php endif; ?>

<main>
    <div class="max-w-2xl mx-auto">
        <!-- Título -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Alta de Medico</h1>
            <p class="text-gray-600 mt-2">Registra  un empleado Medico en el sistema</p>
        </div>

        <!-- Formulario de alta -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <form action="?action=altasMedicos" method="post" class="space-y-6">
                
                <!-- Login -->
                <div>
                    <label for="login" class="block text-gray-700 font-semibold mb-2">Login *</label>
                    <input id="login" name="login" type="text" placeholder="Usuario para acceso"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña *</label>
                    <input id="password" name="password" type="password" placeholder="Contraseña segura"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Mínimo 6 caracteres</p>
                </div>

                <!-- Confirmar Password -->
                <div>
                    <label for="password_confirm" class="block text-gray-700 font-semibold mb-2">Confirmar Contraseña *</label>
                    <input id="password_confirm" name="password_confirm" type="password" placeholder="Confirma la contraseña"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                 <div>
                    <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                    <input id="nombre" name="nombre" type="text" placeholder="Usuario para acceso"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                <div>
                    <label for="apellidos" class="block text-gray-700 font-semibold mb-2">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" placeholder="Usuario para acceso"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                 <div>
                    <label for="num_Colegiado" class="block text-gray-700 font-semibold mb-2">Nº</label>
                    <input id="num_Colegiado" name="num_Colegiado" type="text" placeholder="Usuario para acceso"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                

                
               

                <!-- Botones -->
                <div class="flex gap-4 pt-6">
                    <button type="submit" name="crear"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200 shadow-md">
                        ✓ Crear Usuario
                    </button>
                    <button type="reset"
                            class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-lg transition duration-200 shadow-md">
                        ✕ Limpiar
                    </button>
                </div>

                <?php if (!empty($msg)) echo $msg; ?>
            </form>
        </div>
    </div>
</main>