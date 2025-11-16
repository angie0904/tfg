<?php

$action = $_REQUEST['action'] ?? '';

$arrayResultados = null;
if ($action === 'buscarPaciente') {
    $modelPath = __DIR__ . '/../../Modelo/class.medico.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
        $model = new medico();
        $arrayResultados = $model->getPacientes();
    } else {
        $errorModel = "Modelo no encontrado: $modelPath";
    }
}
?>

<div class="flex h-[calc(100vh-80px)]">
  <!-- Menú fijo a la izquierda -->
  <aside class="w-64 border-r border-gray-200 p-6 shadow-lg bg-blue-200 overflow-y-auto">
    <nav class="space-y-2">
      <a href="?action=buscarPaciente" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">🔍</span>Buscar paciente</a>
      <a href="?action=solicitarPrueba" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">📊</span>Mis estudios Pendientes</a>
      <a href="?action=estudiosPendientes" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">📊</span>Estudios Pendientes</a>
      <a href="?action=otro" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition">Chat</a>
    </nav>
  </aside>

  <!-- Contenido principal -->
  <div class="flex-1 flex flex-col overflow-hidden">
    <div class="flex-1 p-6 bg-gray-50 overflow-y-auto">
      <div class="container mx-auto">
        <div class="text-center mb-6">
          <p class="text-lg text-gray-700">
            Bienvenido, <?php echo htmlspecialchars($_SESSION['nom'] ?? 'Usuario'); ?>
          </p>
        </div>

        <section id="contenido-principal" class="bg-white rounded-lg p-6 shadow">
          <?php
          if ($action === 'buscarPaciente') {
              if (isset($arrayResultados)) {
                  require __DIR__ . '/busqueda.php';
              } else {
                  echo "<p>No se han encontrado resultados.</p>";
              }
        }elseif ($action === 'solicitarPrueba') {
              misEstudiosPendientes();
            // require __DIR__ . '/estudiosPendientes.php';
        } elseif ($action === 'estudiosPendientes') {
              estudiosPendientes();
            // require __DIR__ . '/estudiosPendientes.php';
        } elseif ($action === 'informe') {
            // incluir la vista informe como página independiente dentro del contenedor
            getInforme();
            // require __DIR__ . '/informe.php';
        } elseif ($action === 'otro') {
            echo "<p>Contenido de la acción 'otro'.</p>";
        } elseif ($action === 'validarInforme') {
           validarInforme();
        } elseif ($action === 'guardarInforme') {
            guardarInforme();
        } else {
            require __DIR__ . '/busqueda.php';
        }
          ?>
        </section>
      </div>
    </div>
  </div>
</div>