
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Medicos v2</title>
    <link rel="stylesheet" href="../../Recursos/css/app.css">
    <style>
        h1 {
            
            font-weight: bold;
            margin-bottom: 20px;
            color: #226bbeff;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4caaafff;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .status-pendiente {
            color: #ff9800;
            font-weight: bold;
        }
        .status-informado {
            color: #4CAF50;
            font-weight: bold;
        }
        .btn-accion {
            background-color: #008CBA;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-accion:hover {
            background-color: #007399;
        }
    </style>
</head>
<body>
    <div class="container w-full overflow-x-auto mt-4">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:16px;">
            <h1>Medicos</h1>
            <div style="margin-left:auto;">
                <a href="?action=altasMedicos" class="btn-accion" style="background-color:#226bbe; padding:10px 16px; border-radius:6px; text-decoration:none;">+ Dar de Alta</a>
            </div>
        </div>
        
        <?php
        // Mostrar mensaje si existe
        if (isset($msg) && !empty($msg)) {
            echo $msg;
        }

        // Verificar si hay medicos
        if (isset($arrayResultados) && is_array($arrayResultados) && count($arrayResultados) > 0) {
        ?>
        
            <table class="min-w-max w-full border-collapse">
                <thead>
                    <tr>
                        <th>Login Medico</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($arrayResultados as $medico) {
                        $login = htmlspecialchars($medico[0]);
                        $password = htmlspecialchars($medico[1]);
                        $nombre = htmlspecialchars($medico[2]);
                        $apellidos = htmlspecialchars($medico[3]);
                    ?>
                        <tr>
                            <td><?php echo $login; ?></td>
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo $apellidos; ?></td>
                            <td>
                                <button type="button" 
                                            onclick="abrirModalModificar(<?php echo htmlspecialchars(json_encode($medico)); ?>)"
                                            class="btn-accion">
                                        ✏️ Modificaaar
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<p style='color: #ff9800; font-size: 16px;'><strong>No hay estudios pendientes en este momento.</strong></p>";
        }
        ?>
    </div>

    <div id="modalModificar" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative bg-white rounded-2xl shadow-2xl w-11/12 max-w-2xl p-8 mx-4 max-h-200 overflow-y-auto">
        <button onclick="cerrarModalModificar()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-6">Modificar Médico</h3>

        <form id="formModificar" action="?action=altaMedicosv2" method="post" class="space-y-4">
            <input type="hidden" id="original_login" name="original_login">
            <input type="hidden" name="modificarMedicos" value="1">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="login" class="block text-gray-700 font-semibold mb-2">Login</label>
                    <input id="login" name="login" type="text" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                    <input id="nombre" name="nombre" type="text" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label for="apellidos" class="block text-gray-700 font-semibold mb-2">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
            </div>

            <div class="flex gap-4 pt-6">
                <button type="submit" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200">
                    💾 Guardar Cambios
                </button>
                <button type="button" onclick="cerrarModalModificar()"
                        class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-lg transition duration-200">
                    ✕ Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function abrirModalModificar(medico) {
        document.getElementById('original_login').value = medico[0];
        document.getElementById('login').value = medico[0];
        document.getElementById('nombre').value = medico[2];
        document.getElementById('apellidos').value = medico[3];
        document.getElementById('modalModificar').classList.remove('hidden');
    }

    function cerrarModalModificar() {
        document.getElementById('modalModificar').classList.add('hidden');
    }

    // Cerrar con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            cerrarModalModificar();
        }
    });
</script>