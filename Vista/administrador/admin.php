<?php


$action = $_REQUEST['action'] ?? '';

$arrayResultados = null;
if ($action === 'listaResul') {
    $modelPath = __DIR__ . '/../../Modelo/class.paciente.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
        $model = new paciente();
        $arrayResultados = $model->getResultados();
    } else {
        $errorModel = "Modelo no encontrado: $modelPath";
    }
}

// Determinar si mostrar el menú lateral (no mostrar en home)
$showSidebar = !($action === 'inicio' || $action === '' || $action === null);
?>

<div class="flex h-[calc(100vh-80px)]">
  <!-- Menú fijo a la izquierda, debajo del header -->
  <?php if ($showSidebar): ?>
  <aside class="w-64 border-r border-gray-200 p-6 shadow-lg bg-blue-200 overflow-y-auto">
    <nav class="space-y-2">
      <a href="?action=bajas" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"> <span class="inline-block mr-2">📋</span>Bajas</a>
      <a href="?action=modificarPacientes" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">👥</span>Modificar Pacientes</a>
      <a href="?action=altasMedicos" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">👨‍⚕️</span>Altas Medicos</a>
      <a href="?action=crearPruebas" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">🧪</span>Crear Nuevas Pruebas</a>
      <a href="?action=crearModalidades" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">⚙️</span>Crear Nuevas Modalidades</a>
      <a href="?action=desvalidarInformes" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">✓</span>Desvalidar Informes</a>
            <a href="?action=altaMedicosv2" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">✓</span>Altas medicos v2</a>

    </nav>
  </aside>
  <?php endif; ?>

  <!-- Contenido principal -->
  <div class="flex-1 flex flex-col overflow-hidden">
    <div class="flex-1 p-6 bg-gray-50 overflow-y-auto">
      <div class="container mx-auto">
        <section id="contenido-principal" class="<?php echo $showSidebar ? 'bg-white rounded-lg p-6 shadow' : ''; ?>">
          <?php
          if ($action === 'bajas') {
              bajas();
          } elseif ($action === 'modificarPacientes') {
              modificarPacientes();
          } elseif ($action === 'altasMedicos') {
              altaMedicos();
          } elseif ($action === 'crearPruebas') {
              crearPruebas();
          } elseif ($action === 'crearModalidades') {
              crearModalidades();
          }  elseif ($action === 'desvalidarInformes') {
              desvalidarInformes();
          }  elseif ($action === 'altaMedicosv2') {
              altaMedicosv2();
          } elseif ($action === 'inicio' || $action === '' || $action === null) {
              require __DIR__ . '/home.html';
          }
          ?>
        </section>
      </div>
    </div>
  </div>
</div>