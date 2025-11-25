<?php


require_once __DIR__ . '/../../Modelo/class.paciente.php';

$pac = new paciente();
$msg = '';
$showModal = false;
$pruebaSolicitada = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prueba = isset($_POST['prueba']) ? $_POST['prueba'] : '';
    $login = $_SESSION['id_usuario'] ?? null;
    
    if ($prueba === '' || $login === null) {
        $msg = 'Datos inválidos.';
    } else {
        $cod_prueba = $pac->buscarPrueba($prueba);
        $NHC = $pac->buscarPaciente($login);
        
        if ($cod_prueba && $NHC) {
            if ($pac->insertarPrueba($cod_prueba, $NHC)) {
                $showModal = true;
                $pruebaSolicitada = $prueba;
            } else {
                $msg = 'Error al solicitar la prueba.';
            }
        } else {
            $msg = 'Error: no se encontraron datos del paciente o prueba.';
        }
    }
}

$pruebas = $pac->solicitarPrueba();
?>

<div class="max-w-4xl mx-auto bg-white rounded shadow m-6 p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Solicitar Nueva Prueba</h1>
    
    <?php if ($msg !== '' && !$showModal): ?>
        <div class="mb-4 p-4 rounded text-sm <?= strpos($msg, 'éxito') !== false ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
            <?= htmlspecialchars($msg, ENT_QUOTES) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="?action=solicitarPrueba">
        <div class="mb-6">
            <label for="selectPrueba" class="block text-gray-700 font-semibold mb-2">Selecciona una prueba</label>
            <select id="selectPrueba" name="prueba" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
                <option value="">-- Seleccione una prueba --</option>
                <?php foreach ($pruebas as $prueba): ?>
                    <option value="<?= htmlspecialchars($prueba, ENT_QUOTES) ?>">        
                        <?= htmlspecialchars($prueba, ENT_QUOTES) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
            Solicitar Prueba
        </button>
    </form>
</div>

<!-- Modal de éxito -->
<?php if ($showModal): ?>
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-10 overflow-hidden " >
    <div class="bg-white rounded-lg  p-10 m-20 max-w-md text-center transform transition-all animate-fade-in ">
        <!-- Icono de éxito -->
        <div class="mb-6 flex justify-center">
            <div class="bg-green-100 rounded-full p-4">
                <svg class="w-16 h-16 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <!-- Título -->
        <h2 class="text-3xl font-bold text-gray-800 mb-3">¡Prueba Solicitada!</h2>

        <!-- Mensaje -->
        <p class="text-gray-600 mb-6 text-lg">
            Tu solicitud ha sido registrada correctamente en el sistema.
        </p>

        <!-- Detalles de la prueba -->
        <div class="bg-blue-50 rounded-lg p-5 mb-6 text-left border-l-4 border-blue-500">
            <p class="text-gray-700 mb-3">
                <span class="font-semibold text-gray-800">Prueba solicitada:</span><br>
                <span class="text-blue-600 font-semibold text-lg"><?= htmlspecialchars($pruebaSolicitada, ENT_QUOTES) ?></span>
            </p>
            <p class="text-gray-700">
                <span class="font-semibold text-gray-800">Fecha y hora:</span><br>
                <span class="text-blue-600"><?= date('d/m/Y \a \l\a\s H:i') ?></span>
            </p>
        </div>

        <!-- Mensaje informativo -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-6 text-left">
            <p class="text-sm text-gray-700">
                <strong>📌 Nota:</strong> Tu médico recibirá la solicitud y realizará el seguimiento correspondiente.
            </p>
        </div>

        <!-- Botones -->
        <div class="flex gap-3 justify-center">
            <button onclick="closeModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition">
                Cerrar
            </button>
            
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
</style>

<script>
function closeModal() {
    const modal = document.getElementById('successModal');
    modal.style.opacity = '0';
    modal.style.transform = 'scale(0.9)';
    modal.style.transition = 'all 0.3s ease-out';
    setTimeout(() => {
        window.location.href = '?action=solicitarPrueba';
    }, 300);
}

// Cerrar modal al presionar Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const modal = document.getElementById('successModal');
        if (modal) {
            closeModal();
        }
    }
});

// Cerrar modal al hacer click fuera (en el fondo oscuro)
document.getElementById('successModal').addEventListener('click', (e) => {
    if (e.target === document.getElementById('successModal')) {
        closeModal();
    }
});
</script>
<?php endif; ?>