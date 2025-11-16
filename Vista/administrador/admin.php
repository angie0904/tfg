<?php

// Render dinámico de la página 
$action = $_REQUEST['action'] ?? '';

// Si la acción necesita datos (resultados) los cargamos aquí
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
?>

<div class="flex h-[calc(100vh-80px)]">
  <!-- Menú fijo a la izquierda, debajo del header -->
  <aside class="w-64 border-r border-gray-200 p-6 shadow-lg bg-blue-200 overflow-y-auto">
    <nav class="space-y-2">
      <a href="?action=bajas" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"> <span class="inline-block mr-2">📋</span>Bajas</a>
      <a href="?action=modificarPacientes" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">👥</span>Modificar Pacientes</a>
      <a href="?action=altasMedicos" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">👨‍⚕️</span>Altas Medicos</a>
      <a href="?action=crearPruebas" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">🧪</span>Crear Nuevas Pruebas</a>
      <a href="?action=crearModalidades" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">⚙️</span>Crear Nuevas Modalidades</a>
      <a href="?action=desvalidarInformes" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none transition"><span class="inline-block mr-2">✓</span>Desvalidar Informes</a>
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
          // Cargar vistas según la acción
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
          } elseif ($action === 'desvalidarInformes') {
              desvalidarInformes();
          } else {
              bajas();
          }
          ?>
        </section>
      </div>
    </div>
  </div>
</div>