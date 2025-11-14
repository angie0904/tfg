<!-- <div class=" flex items-center justify-center ">
        <form action="?action=buscarPaciente" method="post" class="w-full max-w-md bg-white p-8 rounded shadow-lg space-y-6">

            <h1 class="text-2xl font-bold text-center">Busca</h1>

            <div>
                <label for="floatingInput" class="block text-gray-700 font-medium mb-1">Numero historia clinica del Paciente</label>
                <input type="text" name="nom" id="floatingInput" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                    value="<?php if(isset($_COOKIE['NHC'])) echo $_COOKIE['NHC']; ?>">
            </div>

            

           

            <button type="submit" name="fini"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition duration-200">
Buscar            </button>
        </form>
</div> -->

<?php

// Procesar búsqueda cuando se envía el formulario
$nhcSearched = '';
$pac = null;
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fini'])) {
    $nhcSearched = trim($_POST['nom'] ?? '');
    if ($nhcSearched === '') {
        $msg = '<div class="mt-4 text-red-600">Introduce un NHC válido.</div>';
    } else {
        $modelPath = __DIR__ . '/../../Modelo/class.medico.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $med = new medico();
            $pac = $med->getPacienteByNHC($nhcSearched);
            if (!$pac) {
                $msg = '<div class="mt-4 text-yellow-600">No existe ningún paciente con ese NHC.</div>';
            }
        } else {
            $msg = '<div class="mt-4 text-red-600">Error: modelo no encontrado.</div>';
        }
    }
}
?>



<!-- Tabla con TH fijo arriba. El cuerpo solo se rellena tras buscar -->
<div class="max-w-4xl mx-auto bg-white rounded shadow m-6">
    <div class="overflow-y-auto" style="max-height:300px;">
        <table class="min-w-full table-fixed border-collapse">
            <thead>
                <tr class="text-left">
                    <th class="sticky top-0 bg-gray-100 px-4 py-2 border">NHC</th>
                    <th class="sticky top-0 bg-gray-100 px-4 py-2 border">Nombre</th>
                    <th class="sticky top-0 bg-gray-100 px-4 py-2 border">Apellidos</th>
                    <th class="sticky top-0 bg-gray-100 px-4 py-2 border">Fecha Nacimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($pac): ?>
                    <tr class="even:bg-gray-50">
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($pac[0][0] ??  ''); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($pac[0][1] ?? ''); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($pac[0][2] ?? ''); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($pac[0][3] ?? ''); ?></td>
                    </tr>
                <?php else: ?>
                    <!-- Sin resultados: no mostrar filas (solo headers) -->
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Procesar búsqueda cuando se envía el formulario
$nhcSearched = '';
$pac = null;
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fini'])) {
    $nhcSearched = trim($_POST['nom'] ?? '');
    if ($nhcSearched === '') {
        $msg = '<div class="mt-4 text-red-600">Introduce un NHC válido.</div>';
    } else {
        $modelPath = __DIR__ . '/../../Modelo/class.medico.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $med = new medico();
            $pac = $med->getPacienteByNHC($nhcSearched);
            if (!$pac) {
                $msg = '<div class="mt-4 text-yellow-600">No existe ningún paciente con ese NHC.</div>';
            }
        } else {
            $msg = '<div class="mt-4 text-red-600">Error: modelo no encontrado.</div>';
        }
    }
}
?>

<div class="flex items-center justify-center mb-6">
    <form action="?action=buscarPaciente" method="post" class="w-full max-w-md bg-white p-6 rounded shadow space-y-4">
        <h3 class="text-2xl  text-center">Buscar paciente por NHC</h3>

        <div>
            <input id="nhc" name="nom" type="text" placeholder="Numero de historia clínica (NHC)"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                   value="<?php echo htmlspecialchars($nhcSearched); ?>">

        </div>

        <button type="submit" name="fini"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition duration-200">
            Buscar
        </button>

        <?php echo $msg; ?>
    </form>
</div>
    <table class="min-w-full table-fixed border-collapse mb-6">
        <thead>
                <tr class="text-center">
                    <th class="sticky top-0 bg-gray-100 px-4 py-2 border">Prueba</th>
                    <th class="sticky top-0 bg-gray-100 px-4 py-2 border">Resultados</th>
                    <th class="sticky top-0 bg-gray-100 px-4 py-2 border">Valores</th>
                    <th class="sticky top-0 bg-gray-100 px-4 py-2 border">Descripcion</th>
                </tr>
            </thead>
            <?php foreach($pac as $key => $value):?>
                <tr class="min-w-full table-fixed border-collapse mb-6">
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($value[5] ?? ''); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($value[6] ?? ''); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($value[7] ?? ''); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($value[8] ?? ''); ?></td>
                    </tr>
            <?php endforeach; ?>
                
    </table>


