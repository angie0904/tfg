<?php

// Procesar modificación
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
    $nhc = trim($_POST['nhc'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $f_nac = trim($_POST['f_nac'] ?? '');
    $edad = trim($_POST['edad'] ?? '');
    $sexo = trim($_POST['sexo'] ?? '');
    $tlf = trim($_POST['tlf'] ?? '');

    if (empty($nhc) || empty($nombre) || empty($apellidos)) {
        $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Por favor rellena los campos obligatorios.</div>';
    } else {
        $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $model = new admin();
            
            if ($model->modificarPacientes($nhc, $nombre, $apellidos, $f_nac, $edad, $sexo, $tlf)) {
                $msg = '<div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300">Paciente modificado correctamente.</div>';
            } else {
                $msg = '<div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">Error al modificar el paciente.</div>';
            }
        }
    }
}
?>

<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Pacientes</h1>

    <?php if (!empty($msg)) echo $msg; ?>

    <div class="bg-white rounded shadow overflow-hidden">
        <div class="overflow-y-auto" style="max-height:500px;">
            <table class="min-w-full table-fixed border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white text-left">
                        <th class="sticky top-0 px-4 py-3 border">NHC</th>
                        <th class="sticky top-0 px-4 py-3 border">Nombre</th>
                        <th class="sticky top-0 px-4 py-3 border">Apellidos</th>
                        <th class="sticky top-0 px-4 py-3 border">Fecha Nacimiento</th>
                        <th class="sticky top-0 px-4 py-3 border">Edad</th>
                        <th class="sticky top-0 px-4 py-3 border">Sexo</th>
                        <th class="sticky top-0 px-4 py-3 border">Telefono</th>
                        <th class="sticky top-0 px-4 py-3 border">Login</th>
                        <th class="sticky top-0 px-4 py-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $medicos = [];
                    $modelPath = __DIR__ . '/../../Modelo/class.admin.php';
                    if (file_exists($modelPath)) {
                        require_once $modelPath;
                        $model = new admin();
                        $medicos = $model->getPacientes() ?? [];
                    }
                    ?>
                    <?php if (!empty($medicos)): ?>
                        <?php foreach ($medicos as $medico): ?>
                            <tr class="even:bg-gray-50 hover:bg-gray-100 border-b">
                                <td class="px-4 py-3"><?php echo htmlspecialchars($medico[0] ?? ''); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($medico[1] ?? ''); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($medico[2] ?? ''); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($medico[3] ?? ''); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($medico[4] ?? ''); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($medico[5] ?? ''); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($medico[6] ?? ''); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($medico[7] ?? ''); ?></td>
                                <td class="px-4 py-3">
                                    <button type="button" 
                                            onclick="abrirModalModificar(<?php echo htmlspecialchars(json_encode($medico)); ?>)"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                                        ✏️ Modificar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="px-4 py-3 text-center text-gray-500">No hay pacientes registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de modificación -->
<div id="modalModificar" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative bg-white rounded-2xl shadow-2xl w-11/12 max-w-2xl p-8 mx-4 max-h-96 overflow-y-auto">
        <button onclick="cerrarModalModificar()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-6">Modificar Paciente</h3>

        <form id="formModificar" action="?action=modificarPacientes" method="post" class="space-y-4">
            <input type="hidden" id="nhc" name="nhc">
            <input type="hidden" name="modificar" value="1">

            <div class="grid grid-cols-2 gap-4">
                
                <div>
                    <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                    <input id="nombre" name="nombre" type="text" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label for="apellidos" class="block text-gray-700 font-semibold mb-2">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label for="f_nac" class="block text-gray-700 font-semibold mb-2">Fecha Nacimiento</label>
                    <input id="f_nac" name="f_nac" type="date" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label for="edad" class="block text-gray-700 font-semibold mb-2">Edad</label>
                    <input id="edad" name="edad" type="number" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label for="sexo" class="block text-gray-700 font-semibold mb-2">Sexo</label>
                    <select id="sexo" name="sexo" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">Selecciona sexo</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>

                <div>
                    <label for="tlf" class="block text-gray-700 font-semibold mb-2">Teléfono</label>
                    <input id="tlf" name="tlf" type="text" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
            </div>

            <div class="flex gap-4 pt-6">
                <button type="submit" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200">
                    💾 Guardar Cambios
                </button>
                <button type="button" onclick="cerrarModalModificar()"
                        class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-lg transition duration-200">
                    ✕ Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function abrirModalModificar(paciente) {
        document.getElementById('nhc').value = paciente[0];
        document.getElementById('nombre').value = paciente[1];
        document.getElementById('apellidos').value = paciente[2];
        document.getElementById('f_nac').value = paciente[3];
        document.getElementById('edad').value = paciente[4];
        document.getElementById('sexo').value = paciente[5];
        document.getElementById('tlf').value = paciente[6];
        document.getElementById('modalModificar').classList.remove('hidden');
    }

    function cerrarModalModificar() {
        document.getElementById('modalModificar').classList.add('hidden');
    }

    // Cerrar con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            cerrarModalModificar();
        }
    });
</script>