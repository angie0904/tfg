<style>
    h2 {
       
        font-weight: bold;
        margin-bottom: 1.5rem;
        color: #226bbeff;
    }
</style>

<form action="index.php?action=crearModalidades"></form>

<div class="flex items-center justify-center  bg-gray-50">
    <form action="index.php?action=crearModalidades" method="POST"
          class="w-full max-w-lg bg-white p-8 rounded-xl shadow-md border border-gray-200 space-y-6">

        <h2 class="text-2xl font-bold text-center text-blue-600">
            Crear Nueva Modalidad
        </h2>

        <!-- Código de la prueba -->
        <div>
            <label class="block text-gray-700 font-medium mb-1" for="codigoModalidad">
                Código Modalidad
            </label>
            <input id="codigoModalidad" name="codigoModalidad" type="text" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 
                          focus:outline-none focus:ring-2 focus:ring-blue-300 
                          focus:border-blue-400 transition">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1" for="modalidad">
                Descripcion Modalidad
            </label>
            <input id="modalidad" name="modalidad" type="text" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 
                          focus:outline-none focus:ring-2 focus:ring-blue-300 
                          focus:border-blue-400 transition">
        </div>

        <!-- Botón -->
        <button type="submit" action="index.php?action=crearModalidades" name="crear"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white 
                       font-semibold py-2 rounded-lg transition duration-200">
            Crear Modalidad
        </button>
    </form>
</div>
