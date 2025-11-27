<style>
    h2 {
       
        font-weight: bold;
        margin-bottom: 1.5rem;
        color: #226bbeff;
    }
</style>

<?php
$msg = $msg ?? '';
?>

<div class="flex items-center justify-center bg-gray-50">
    <form action="index.php?action=crearPruebas" method="POST"
          class="w-full max-w-lg bg-white p-8 rounded-xl shadow-md border border-gray-200 space-y-6">

        <h2 class="text-2xl font-bold text-center text-blue-600">
            Crear Nueva Prueba
        </h2>

        <!-- Código de la prueba -->
        <div>
            <label class="block text-gray-700 font-medium mb-1" for="codigo">
                Código de la prueba
            </label>
            <input id="codigo" name="codigo" type="text" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 
                          focus:outline-none focus:ring-2 focus:ring-blue-300 
                          focus:border-blue-400 transition">
        </div>

        <!-- Descripción -->
        <div>
            <label class="block text-gray-700 font-medium mb-1" for="descripcion">
                Nombre de la prueba
            </label>
            <textarea id="descripcion" name="descripcion" rows="3" required
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 
                             focus:outline-none focus:ring-2 focus:ring-blue-300 
                             focus:border-blue-400 transition"></textarea>
        </div>
        <!-- Botón -->
        <button type="submit" action="index.php?action=crearPruebas" name="crear"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white 
                       font-semibold py-2 rounded-lg transition duration-200">
            Crear Prueba
        </button>
    </form>
    
    <?php if (isset($msg)): ?>
        <?php echo $msg; ?>
    <?php endif; ?>
</div>