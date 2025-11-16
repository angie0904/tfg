<?php


// Procesar búsqueda cuando se envía el formulario
$informeSearched = '';
$informe = null;
$msg = '';
$desvalidacionExitosa = false;
$informeDesvalidado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $informeSearched = trim($_POST['id_informe'] ?? '');
    if ($informeSearched === '') {
        $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Busca el ID del informe que quieres desvalidar.</div>';
    } else {
        $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $model = new admin();
            $informe = $model->getInformeById($informeSearched);
            if (!$informe) {
                $msg = '<div class="mt-4 p-4 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-300">No existe ningún informe validado con ese ID.</div>';
            } elseif ($informe[2] == 0) {
                $msg = '<div class="mt-4 p-4 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-300">Este informe ya está desvalidado.</div>';
                $informe = null;
            }
        } else {
            $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Error: modelo no encontrado.</div>';
        }
    }
}

// Procesar confirmación de desvalidación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    $idInforme = trim($_POST['id_informe'] ?? '');
    if (!empty($idInforme)) {
        $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $model = new admin();
            
            // Llamar a la función que desvalida el informe
            if ($model->desvalidarInforme($idInforme)) {
                $desvalidacionExitosa = true;
                $informeDesvalidado = $idInforme;
                $informe = null; // Limpiar datos del informe
                $informeSearched = ''; // Limpiar búsqueda
            } else {
                $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Error al desvalidar el informe.</div>';
            }
        }
    }
}
?>

<!-- Modal de confirmación de desvalidación exitosa -->
<?php if ($desvalidacionExitosa): ?>
<div id="modalDesvalidacion" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
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
        <h3 class="text-2xl font-bold text-center text-gray-900 mb-2">¡Desvalidación Exitosa!</h3>
        <p class="text-center text-gray-600 mb-6 text-sm">
            El informe ha sido desvalidado correctamente
        </p>

        <!-- Detalles de la desvalidación -->
        <div class="bg-green-50 border-2 border-green-200 rounded-lg p-6 mb-6 space-y-3">
            <div class="flex items-center gap-3">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-200">
                    <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-600 font-medium">ID INFORME</p>
                    <p class="text-gray-900 font-bold"><?php echo htmlspecialchars($informeDesvalidado); ?></p>
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
                    <p class="text-gray-900 font-bold">Desvalidado</p>
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
        <button id="closeDesvalidacionModal" 
                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
            Aceptar
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('closeDesvalidacionModal');
        const modal = document.getElementById('modalDesvalidacion');
        
        closeBtn.addEventListener('click', function() {
            modal.classList.add('fade-out');
            setTimeout(() => {
                modal.style.display = 'none';
                window.location.href = '?action=desvalidarInformes';
            }, 300);
        });
        
        // Cerrar con ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                modal.classList.add('fade-out');
                setTimeout(() => {
                    modal.style.display = 'none';
                    window.location.href = '?action=desvalidarInformes';
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


<!-- Mostrar tabla de datos del informe si existe -->
<?php if ($informe): ?>
    <div class="max-w-6xl mx-auto mb-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Datos del Informe Encontrado</h3>
        
        <div class="bg-white rounded-xl shadow-lg border-l-4 border-blue-600 overflow-hidden">
            <div class="overflow-y-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-left">
                            <th class="sticky top-0 px-4 py-3 border">ID Informe</th>
                            <th class="sticky top-0 px-4 py-3 border">Resultados</th>
                            <th class="sticky top-0 px-4 py-3 border">Estado</th>
                            <th class="sticky top-0 px-4 py-3 border">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-blue-50 border-b transition-colors">
                            <td class="px-4 py-3 border font-medium text-gray-900"><?php echo htmlspecialchars($informe[0] ?? ''); ?></td>
                            <td class="px-4 py-3 border"><?php echo htmlspecialchars($informe[1] ?? ''); ?></td>
                            <td class="px-4 py-3 border">
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                    <?php echo ($informe[2] == 1) ? 'Validado ✓' : 'Desvalidado'; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 border"><?php echo htmlspecialchars($informe[3] ?? ''); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Formulario de confirmación de desvalidación -->
        <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
            <h4 class="text-lg font-bold text-yellow-700 mb-4">⚠️ Confirmación de Desvalidación</h4>
            <p class="text-yellow-600 mb-6">¿Estás seguro de que deseas desvalidar el informe <strong><?php echo htmlspecialchars($informe[0]); ?></strong>? El estado cambiará a desvalidado.</p>
            
            <form action="?action=desvalidarInformes" method="post">
                <input type="hidden" name="id_informe" value="<?php echo htmlspecialchars($informe[0]); ?>">
                
                <div class="flex gap-4">
                    <button type="submit" name="confirmar" 
                            class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                        ✓ Confirmar Desvalidación
                    </button>
                    <a href="?action=desvalidarInformes" 
                       class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 rounded-lg transition duration-200 text-center">
                        ✕ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<!-- Tabla de todos los informes validados -->
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Informes Validados</h1>

    <div class="bg-white rounded shadow overflow-hidden">
        <div class="overflow-y-auto" style="max-height:500px;">
            <table class="min-w-full table-fixed border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white text-left">
                        <th class="sticky top-0 px-4 py-3 border">ID Informe</th>
                        <th class="sticky top-0 px-4 py-3 border">Resultados</th>
                        <th class="sticky top-0 px-4 py-3 border">Estado</th>
                        <th class="sticky top-0 px-4 py-3 border">Fecha Informe</th>
                        <th class="sticky top-0 px-4 py-3 border">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
                    $informes = [];
                    if (file_exists($modelPath)) {
                        require_once $modelPath;
                        $model = new admin();
                        $todosInformes = $model->getInforme() ?? [];
                        
                        // Filtrar solo informes validados (Validado = 1)
                        foreach ($todosInformes as $inf) {
                            if ($inf[2] == 1) {
                                $informes[] = $inf;
                            }
                        }
                    }
                    ?>
                    
                    <?php if (!empty($informes)): ?>
                        <?php foreach ($informes as $informe): ?>
                            <tr class="even:bg-gray-50 hover:bg-gray-100 border-b">
                                <td class="px-4 py-3"><?php echo htmlspecialchars($informe[0] ?? ''); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($informe[1] ?? ''); ?></td>
                                <td class="px-4 py-3">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                        ✓ Validado
                                    </span>
                                </td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($informe[3] ?? ''); ?></td>
                                <td class="px-4 py-3">
                                    <form action="?action=desvalidarInformes" method="post" style="display:inline;">
                                        <input type="hidden" name="id_informe" value="<?php echo htmlspecialchars($informe[0]); ?>">
                                        <button type="submit" name="confirmar"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition"
                                                onclick="return confirm('¿Desvalidar este informe?');">
                                            ✗ Desvalidar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">No hay informes validados
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>