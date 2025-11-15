<?php

// Render dinámico de la página 
$action = $_REQUEST['action'] ?? '';

// Si la acción necesita datos (resultados) los cargamos aquí
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
<main>
  <!-- Menú fijo a la izquierda -->
  <aside class="fixed left-0 top-20 h-screen w-64 rounded-left-2xl border border-gray-200 p-6 shadow bg-blue-200">
    

    <nav class="space-y-2">
      <a href="?action=buscarPaciente" class="block px-3 py-2 rounded-md  hover:bg-blue-100 text-black text-decoration-none">Buscar paciente</a>
      <a href="?action=solicitarPrueba" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100 text-black text-decoration-none">Mis estudios Pendientes</a>
      <a href="?action=otro" class="block px-3 py-2 rounded-md bg-gray-300 hover:bg-blue-100  text-black text-decoration-none">Chat </a>
    </nav>
  </aside>

  
  <div class="ml-64 p-6 min-h-screen bg-gray-50">
    <div class="container mx-auto">
      <div class="text-center mb-6">
        <p class="text-lg text-gray-700">
          Bienvenido, <?php echo htmlspecialchars($_SESSION['nom'] ?? 'Usuario'); ?>
        </p>
      </div>

      <section id="contenido-principal" class="bg-white rounded-lg p-6 shadow">
       <?php
// ...existing code...
        // Cargar vistas según la acción
        if ($action === 'buscarPaciente') {
            // La vista resultados.php espera $arrayResultados
            if (isset($arrayResultados)) {
                require __DIR__ . '/busqueda.php';
            } else {
                echo "<p>No se han encontrado resultados.</p>";
            }
        } elseif ($action === 'solicitarPrueba') {
            require __DIR__ . '/estudiosPedientes.php';
        } elseif ($action === 'informe') {
            // incluir la vista informe como página independiente dentro del contenedor
            require __DIR__ . '/informe.php';
        } elseif ($action === 'guardar') {
            // incluir la vista informe como página independiente dentro del contenedor
            require __DIR__ . '../login.php';
        } elseif ($action === 'otro') {
            echo "<p>Contenido de la acción 'otro'.</p>";
        } else {
            require __DIR__ . '/busqueda.php';
        }
// ...existing code...
        ?>
      </section>
    </div>
  </div>
</main>
<!-- Si usas Tailwind via CDN -->
<!-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> -->



<!-- <main>
  <!-- <form action="index.php?action=formPaciente" method="post"> 
<div class="container ",id="paciente" >




        <aside class="fixed left-0 top-19 h-screen w-64 rounded-left-2xl border border-gray-200 p-6 shadow bg-white " >
       
          <h2 class="text-xl font-bold mb-3">Panel rápido</h2>

          <nav class="space-y-2">
            <a href="?action=listaResul" class="flex items-center gap-3 p-3 rounded-md text-decoration-none bg-gray-300 text-black">
              <span class="text-sm font-medium">Ver resultados</span>
            </a>

            <a href="?action=solicitarPrueba" class="flex items-center gap-3 p-3 text-decoration-none bg-gray-300 text-black">
              <span class="text-sm font-medium">Solicitar prueba</span>
            </a>

           
          </nav>

          
        
      </aside>
            </div>
       

     

      
</main> -->

 <!-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> -->
