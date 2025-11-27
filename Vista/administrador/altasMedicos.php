

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('closeAltaModal');
        const modal = document.getElementById('modalAlta');
        
        closeBtn.addEventListener('click', function() {
            modal.classList.add('fade-out');
            setTimeout(() => {
                modal.style.display = 'none';
                window.location.href = '?action=altasMedicos';
            }, 300);
        });
        
        // Cerrar con ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                modal.classList.add('fade-out');
                setTimeout(() => {
                    modal.style.display = 'none';
                    window.location.href = '?action=altasMedicos';
                }, 300);
            }
        });
    });
</script>

<style>
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.8) translateY(-20px);
        }
        50% {
            opacity: 1;
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    @keyframes fadeOut {
        0% {
            opacity: 1;
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(0.8);
        }
    }
    
    .animate-bounce-in {
        animation: bounceIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .fade-out {
        animation: fadeOut 0.3s ease-out;
    }


    h1 {
       
        font-weight: bold;
        margin-bottom: 1.5rem;
        color: #226bbeff;
    }

</style>


<main>
    <?php if (!empty($msg)) echo $msg; ?>
    <div class="max-w-2xl mx-auto">
        <!-- Título -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Alta de Medico</h1>
            <p class="text-gray-600 mt-2">Registra  un empleado Medico en el sistema</p>
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


                

                
               

                <!-- Botones -->
                <div class="flex gap-4 pt-6">
                    <button type="submit" name="crear"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200 shadow-md">
                        ✓ Crear Usuario
                    </button>
                    <button type="reset"
                            class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-lg transition duration-200 shadow-md">
                        ✕ Limpiar
                    </button>
                </div>

                
            </form>
        </div>
    </div>
</main>