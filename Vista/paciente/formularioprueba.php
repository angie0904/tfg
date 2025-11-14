<?php

require_once __DIR__ . '/../../Modelo/class.paciente.php';

$pac = new paciente();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_prueba = isset($_POST['prueba']) ? intval($_POST['prueba']) : 0;
    $NHC = isset($_SESSION['NHC']) ? $_SESSION['NHC'] : null;
    
    if ($cod_prueba === 0 || $NHC === null) {
        $msg = 'Datos inválidos.';
    } else {
        $ok = $pac->insertPrueba($cod_prueba, $NHC);
        $msg = $ok ? 'Prueba solicitada con éxito.' : 'Error al solicitar la prueba.';
    }
}

$pruebas = $pac->solicitarPrueba();
?>
<div class="max-w-4xl mx-auto bg-white rounded shadow m-6 p-4">
    <?php if ($msg !== ''): ?>
        <div class="mb-4 text-sm <?= strpos($msg, 'éxito') !== false ? 'text-green-700' : 'text-red-700' ?>">
            <?= htmlspecialchars($msg, ENT_QUOTES) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="?action=insertarPrueba">
        <div class="mb-4">
            <label for="selectPrueba" class="block font-medium mb-1">Nuestras pruebas</label>
            <select id="selectPrueba" name="prueba" class="w-full border rounded px-3 py-2" required>
                <option value="">Seleccione una prueba</option>
                <?php foreach ($pruebas as $prueba): ?>
                    <option value="<?= htmlspecialchars($prueba, ENT_QUOTES) ?>">        
                        <?= htmlspecialchars($prueba, ENT_QUOTES) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <button type="submit" action="index.php?action=insertarPrueba"  class="bg-blue-500 text-white px-4 py-2 rounded">Solicitar</button>
        </div>
    </form>
</div>