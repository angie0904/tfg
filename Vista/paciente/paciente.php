<?php


$action = $_REQUEST['action'] ?? '';

$arrayResultados = null;
if ($action === 'listaResul' || $action === '' || $action === null) {
    $modelPath = __DIR__ . '/../../Modelo/class.paciente.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
        $model = new paciente();
        $login = $_SESSION['id_usuario'] ?? '';
        $arrayResultados = $model->getResultados($login);
    } else {
        $errorModel = "Modelo no encontrado: $modelPath";
    }
}

// Determinar si mostrar el menú lateral (no mostrar en home)
$showSidebar = !($action === 'inicio' || $action === '' || $action === null);
?>

<div class="flex h-[calc(100vh-80px)]">
  <!-- Menú fijo a la izquierda -->
  <?php if ($showSidebar): ?>
  <aside class="w-64 border-r border-gray-200 p-6 shadow-lg bg-blue-200 overflow-y-auto">
    <nav class="space-y-2">
      <a href="?action=listaResul" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">📋</span>Ver resultados</a>
      <a href="?action=solicitarPrueba" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">🧬</span>Solicitar prueba</a>
    </nav>
  </aside>
  <?php endif; ?>

  <!-- Contenido principal -->
  <div class="flex-1 flex flex-col overflow-hidden">
    <div class="flex-1 p-6 bg-gray-50 overflow-y-auto">
      <div class="container mx-auto">
        <section id="contenido-principal" class="<?php echo $showSidebar ? 'bg-white rounded-lg p-6 shadow' : ''; ?>">
          <?php
          if ($action === 'listaResul') {
              if (isset($arrayResultados)) {
                  require __DIR__ . '/resultados.php';
              } else {
                  echo "<p>No se han encontrado resultados.</p>";
              }
          } elseif ($action === 'solicitarPrueba') {
              require __DIR__ . '/formularioprueba.php';
          } elseif ($action === 'inicio' || $action === '' || $action === null) {
              require __DIR__ . '/home.html';
          } else {
              require __DIR__ . '/home.html';
          }
          ?>
        </section>
      </div>
    </div>
  </div>
</div>