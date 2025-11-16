<?php

// Procesar búsqueda cuando se envía el formulario
$loginSearched = '';
$pac = null;
$msg = '';
$bajaSatisfactoria = false;
$usuarioBaja = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fini'])) {
    $loginSearched = trim($_POST['nom'] ?? '');
    if ($loginSearched === '') {
        $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Busca el login que quieres dar de baja.</div>';
    } else {
        $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $model = new admin();
            $pac = $model->getPacienteByLogin($loginSearched);
            if (!$pac) {
                $msg = '<div class="mt-4 p-4 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-300">No existe ningún usuario con ese login.</div>';
            }
        } else {
            $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Error: modelo no encontrado.</div>';
        }
    }
}

// Procesar confirmación de baja
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    $loginBaja = trim($_POST['login'] ?? '');
    if (!empty($loginBaja)) {
        $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $model = new admin();
            
            // Llamar a la función que da de baja el usuario
            if ($model->darDeBaja($loginBaja)) {
                $bajaSatisfactoria = true;
                $usuarioBaja = $loginBaja;
                $pac = null; // Limpiar datos del paciente
                $loginSearched = ''; // Limpiar búsqueda
            } else {
                $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Error al dar de baja al usuario.</div>';
            }
        }
    }
}
?>

<!-- Modal de confirmación de baja satisfactoria -->
<?php if ($bajaSatisfactoria): ?>
<div id="modalBaja" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
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
        <h3 class="text-2xl font-bold text-center text-gray-900 mb-2">¡Baja Exitosa!</h3>
        <p class="text-center text-gray-600 mb-6 text-sm">
            El usuario ha sido dado de baja correctamente
        </p>

        <!-- Detalles de la baja -->
        <div class="bg-green-50 border-2 border-green-200 rounded-lg p-6 mb-6 space-y-3">
            <div class="flex items-center gap-3">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-200">
                    <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-600 font-medium">LOGIN</p>
                    <p class="text-gray-900 font-bold"><?php echo htmlspecialchars($usuarioBaja); ?></p>
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
                    <p class="text-gray-900 font-bold">Inactivo</p>
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
        <button id="closeBajaModal" 
                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
            Aceptar
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('closeBajaModal');
        const modal = document.getElementById('modalBaja');
        
        closeBtn.addEventListener('click', function() {
            modal.classList.add('fade-out');
            setTimeout(() => {
                modal.style.display = 'none';
                window.location.href = '?action=bajas';
            }, 300);
        });
        
        // Cerrar con ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                modal.classList.add('fade-out');
                setTimeout(() => {
                    modal.style.display = 'none';
                    window.location.href = '?action=bajas';
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

<!-- Formulario de búsqueda -->
<div class="flex items-center justify-center mb-8">
    <form action="?action=bajas" method="post" class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Dar de Baja Usuario</h2>

        <div>
            <label for="nom" class="block text-gray-700 font-medium mb-2">Login del usuario</label>
            <input id="nom" name="nom" type="text" placeholder="Introduce el login"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                   value="<?php echo htmlspecialchars($loginSearched); ?>">
        </div>

        <button type="submit" name="fini"
                class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
            Buscar
        </button>

        <?php if (!empty($msg)) echo $msg; ?>
    </form>
</div>

<!-- Mostrar tabla de datos del paciente si existe -->
<?php if ($pac): ?>
    <div class="max-w-6xl mx-auto mb-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Datos del Usuario Encontrado</h3>
        
        <div class="bg-white rounded-xl shadow-lg border-l-4 border-blue-600 overflow-hidden">
            <div class="overflow-y-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-left">
                            <th class="sticky top-0 px-4 py-3 border">Login</th>
                            <th class="sticky top-0 px-4 py-3 border">Tipo</th>
                            <th class="sticky top-0 px-4 py-3 border">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-blue-50 border-b transition-colors">
                            <td class="px-4 py-3 border font-medium text-gray-900"><?php echo htmlspecialchars($pac[0] ?? ''); ?></td>
                            <td class="px-4 py-3 border">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                                    <?php 
                                        $tipo = htmlspecialchars($pac[2] ?? '');
                                        if ($tipo == 1) echo 'Administrador';
                                        elseif ($tipo == 2) echo 'Médico';
                                        elseif ($tipo == 3) echo 'Paciente';
                                        else echo $tipo;
                                    ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 border">
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                    <?php echo ($pac[3] == 1) ? 'Activo' : 'Inactivo'; ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Formulario de confirmación de baja -->
        <div class="mt-8 bg-red-50 border border-red-200 rounded-xl p-6">
            <h4 class="text-lg font-bold text-red-700 mb-4">⚠️ Confirmación de Baja</h4>
            <p class="text-red-600 mb-6">¿Estás seguro de que deseas dar de baja al usuario <strong><?php echo htmlspecialchars($pac[0]); ?></strong>? Esta acción marcará el usuario como inactivo.</p>
            
            <form action="?action=bajas" method="post">
                <input type="hidden" name="login" value="<?php echo htmlspecialchars($pac[0]); ?>">
                
                <div class="flex gap-4">
                    <button type="submit" name="confirmar" 
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                        ✓ Confirmar Baja
                    </button>
                    <a href="?action=bajas" 
                       class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 rounded-lg transition duration-200 text-center">
                        ✕ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>