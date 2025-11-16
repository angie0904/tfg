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


    <div class="">
            <?php
            
               

             

                // Tabla de resultados detallada
                echo "<table border='1' style='width:100%;border-collapse:collapse;'>";
                echo "<tr><th style='padding:8px;text-align:left;'>Prueba</th><th style='padding:8px;text-align:left;'>Resultados</th><th style='padding:8px;text-align:left;'>Valores normales</th></tr>";

                    
                    $cod_prueba = htmlspecialchars($value[1] ?? '');
                    $resul = htmlspecialchars($value[1] ?? '');
                    $valores = htmlspecialchars($value[2] ?? '');
                    echo "<tr>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$2</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>hola</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$400</td>";
                    
                    echo "</tr>";
                    
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$1</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>jj</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$300</td>";
                    echo "</tr>";


                echo "</table>";
     

            if (isset($msg)) echo $msg;
            ?>
            
<div class="max-w-4xl mx-auto p-6">
    <form method="post" action="index.php?action=guardarInfo">
          <div>
            <textarea id="descripcion" name="descripcion" rows="3" required
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 
                             focus:outline-none focus:ring-2 focus:ring-blue-300 
                             focus:border-blue-400 transition"></textarea>

        </div>
        <div class="flex gap-4">
            <button href='index.php?action=guardarInfo' type="submit" name="guardar" value="1" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">
                Guardar
            </button>

            <button href='index.php?action=validarInfo' type="submit" name="validar" value="1" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Validar
            </button>
        </div>
    </form>
</div>
        </div>


