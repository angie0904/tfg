<form action="index.php?action=crearModalidades"></form>

<div class="flex items-center justify-center  bg-gray-50">
    <form action="index.php?action=crearPrueba" method="POST"
          class="w-full max-w-lg bg-white p-8 rounded-xl shadow-md border border-gray-200 space-y-6">

        <h2 class="text-2xl font-bold text-center text-blue-600">
            Crear Nueva Modalidad
        </h2>

        <!-- Código de la prueba -->
        <div>
            <label class="block text-gray-700 font-medium mb-1" for="codigo">
                Código Modalidad
            </label>
            <input id="codigo" name="codigo" type="text" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 
                          focus:outline-none focus:ring-2 focus:ring-blue-300 
                          focus:border-blue-400 transition">
        </div>

        

        <!-- Modalidad -->
        <div>
            <label class="block text-gray-700 font-medium mb-1" for="modalidad">
                Modalidad
            </label>
            <select id="modalidad" name="modalidad" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2
                           focus:outline-none focus:ring-2 focus:ring-blue-300 
                           focus:border-blue-400 transition">
                <option value="">Seleccione una modalidad</option>
                <option value="Analítica">CR</option>
                <option value="Radiología">CT</option>
                <option value="Diagnóstico">DX</option>
                <option value="Especial">MR</option>
                <option value="Especial">US</option>

            </select>
        </div>

        <!-- Botón -->
        <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white 
                       font-semibold py-2 rounded-lg transition duration-200">
            Crear Prueba
        </button>
    </form>
</div>
