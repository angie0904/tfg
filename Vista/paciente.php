<main>
  <form action="index.php?action=formPaciente" method="post">

    <?php
session_start();

// Verificamos que esté logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

echo "Bienvenido, " . $_SESSION['nombre'];
?>

<div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
      <!-- Card: Análisis Clínicos -->
      <div class="rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow bg-blue-50 bg-cover bg-center hover:scale-110 transition-transform duration-300">
        <div class="bg-white/40 p-4 rounded-lg h-full flex flex-col">

          <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
              <img src="../recursos/img/revision-medica.png" alt="">
            </span>
            <h3 class="text-lg font-semibold text-gray-900">Resultados Clínicos</h3>
          </div>
        
        </div>
      </div>

      <div class="rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow bg-blue-50 bg-cover bg-center hover:scale-110 transition-transform duration-300">
        <div class="bg-white/40 p-4 rounded-lg h-full flex flex-col">

          <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
              <img src="../recursos/img/historial-medico.png" alt="">
            </span>
            <h3 class="text-lg font-semibold text-gray-900">Historial Clínicos</h3>
          </div>
        
        </div>
      </div>

      <div class="rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow bg-blue-50 bg-cover bg-center hover:scale-110 transition-transform duration-300">
        <div class="bg-white/40 p-4 rounded-lg h-full flex flex-col">

          <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
              <img src="../recursos/img/datos-de-contacto.png" alt="">
            </span>
            <h3 class="text-lg font-semibold text-gray-900">Contacto</h3>
          </div>
        
        </div>
      </div>

     

      
</main>
</form>
 <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
