
  <style>
    .form-container{max-width:480px;margin:2rem auto;padding:1.25rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff}
    .field{margin-bottom:0.75rem}
    label{display:block;margin-bottom:0.25rem;font-weight:600}
    input{width:100%;padding:0.5rem;border:1px solid #cbd5e1;border-radius:6px}
    button{display:inline-block;padding:0.6rem 1rem;background:#2563eb;color:#fff;border:none;border-radius:6px;cursor:pointer}
  </style>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php if (isset($err)): ?>
            <div id="errorModal" class="fixed inset-0  flex items-start justify-center pt-12">
              
              <div class=" bg-red-600/40 backdrop-blur-sm rounded-lg shadow-lg w-11/12  text-center">
                <h3 class="text-xl font-semibold text-red-600 mb-2">Error</h3>
                <p class="mb-4">Contraseña Incorrecta<br>Vuelve a intentarlo</p>
                
                <div class="flex justify-center">
                  <button id="closeModal" class="px-4 py-2 bg-blue-600 text-white rounded">Cerrar</button>
                </div>
              </div>
            </div>
            
            <script>
            (function(){
              const modal = document.getElementById('errorModal');
              const btn = document.getElementById('closeModal');
              btn.addEventListener('click', () => modal.remove());
              // cerrar con ESC
              document.addEventListener('keydown', (e) => { if (e.key === 'Escape') modal.remove(); });
            })();
            </script>
          <?php endif; ?>
<body>
  
  <main>
    
   <div class="max-w-2xl mx-auto">
        <!-- Título -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Alta de Medico</h1>
            <p class="text-gray-600 mt-2">Registra  un empleado Medico en el sistema v2</p>
        </div>

        <!-- Formulario de alta -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <form action="?action=altasMedicos" method="post" class="space-y-6">
                
                <!-- Login -->
                <div>
                    <label for="login" class="block text-gray-700 font-semibold mb-2">Login *</label>
                    <input id="login" name="login" type="text" placeholder="Usuario para acceso"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña *</label>
                    <input id="password" name="password" type="password" placeholder="Contraseña segura"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Mínimo 6 caracteres</p>
                </div>

                <!-- Confirmar Password -->
                <div>
                    <label for="password_confirm" class="block text-gray-700 font-semibold mb-2">Confirmar Contraseña *</label>
                    <input id="password_confirm" name="password_confirm" type="password" placeholder="Confirma la contraseña"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                 <div>
                    <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                    <input id="nombre" name="nombre" type="text" placeholder="Usuario para acceso"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                <div>
                    <label for="apellidos" class="block text-gray-700 font-semibold mb-2">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" placeholder="Usuario para acceso"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                 <div>
                    <label for="num_Colegiado" class="block text-gray-700 font-semibold mb-2">Nº Colegiado</label>
                    <input id="num_Colegiado" name="num_Colegiado" type="text" placeholder="Usuario para acceso"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>
                <!-- Botones -->
                <div class="flex gap-4 pt-6">
                    <button type="submit" action= "?action=altasMedicos" name="crear"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200 shadow-md">
                        ✓ Crear Usuario
                    </button>
                    <button type="reset"
                            class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-lg transition duration-200 shadow-md">
                        ✕ Limpiar
                    </button>
                </div>

                <?php if (!empty($msg)) echo $msg; ?>
            </form>
        </div>
    </div>
  </main>

  