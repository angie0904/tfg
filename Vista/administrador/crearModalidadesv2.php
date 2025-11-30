
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
            <h1>Modalidades</h1>
            <div style="margin-left:auto;">
                <a href="?action=crearModalidades" class="btn-accion" style="background-color:#226bbe; padding:10px 16px; border-radius:6px; text-decoration:none;">+ Crear Modalidad</a>
            </div>
        </div>
        
        <?php
        // Verificar si hay estudios pendientes
        if (isset($arrayResultados) && is_array($arrayResultados) && count($arrayResultados) > 0) {
        ?>
        
            <table class="min-w-max w-full border-collapse">
                <thead>
                    <tr>
                       
                        <th>Código Prueba</th>
                        <th>Descripción</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($arrayResultados as $estudio) {
                        
                        $cod_prueba = htmlspecialchars($estudio[0]);
                        $descripcion = htmlspecialchars($estudio[1]);
                    ?>
                        <tr>
                            
                            <td><?php echo $cod_prueba; ?></td>
                            <td><?php echo $descripcion; ?></td>
                            
                            <td>
                                <!-- <a href="?action=formularioAltaMedicos&id=<?php echo urlencode($id_estudio); ?>" class="btn-accion">Modificar</a> -->
                                <button type="button" onclick="abrirModalModificar(<?php echo urlencode($id_estudio); ?>)"
                                            class="btn-accion">
                                        ✏️ Modificar
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

        <h3 class="text-2xl font-bold text-gray-900 mb-6">Modificar Modalidades</h3>

        <form id="formModificar" action="?action=formularioAltasMedicos" method="post" class="space-y-4">
            <input type="hidden" id="nhc" name="nhc">
            <input type="hidden" name="modificar" value="1">

            <div class="grid grid-cols-2 gap-4">
                
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

                <div>
                    <label for="f_nac" class="block text-gray-700 font-semibold mb-2">Fecha Nacimiento</label>
                    <input id="f_nac" name="f_nac" type="date" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label for="edad" class="block text-gray-700 font-semibold mb-2">Edad</label>
                    <input id="edad" name="edad" type="number" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div>
                    <label for="sexo" class="block text-gray-700 font-semibold mb-2">Sexo</label>
                    <select id="sexo" name="sexo" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">Selecciona sexo</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>

                <div>
                    <label for="tlf" class="block text-gray-700 font-semibold mb-2">Teléfono</label>
                    <input id="tlf" name="tlf" type="text" 
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
    function abrirModalModificar(paciente) {
        document.getElementById('nhc').value = paciente[0];
        document.getElementById('nombre').value = paciente[1];
        document.getElementById('apellidos').value = paciente[2];
        document.getElementById('f_nac').value = paciente[3];
        document.getElementById('edad').value = paciente[4];
        document.getElementById('sexo').value = paciente[5];
        document.getElementById('tlf').value = paciente[6];
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