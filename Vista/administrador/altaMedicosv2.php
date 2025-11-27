<?php
// Vista para mostrar estudios pendientes
?>

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
        <h1>Alta Medicos v2</h1>
        
        <?php
        // Verificar si hay estudios pendientes
        if (isset($arrayResultados) && is_array($arrayResultados) && count($arrayResultados) > 0) {
        ?>
        
            <table class="min-w-max w-full border-collapse">
                <thead>
                    <tr>
                        <th>ID Estudio</th>
                        <th>NHC Paciente</th>
                        <th>Código Prueba</th>
                        <th>Descripción</th>
                        <th>Estado</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($arrayResultados as $estudio) {
                        $id_estudio = htmlspecialchars($estudio[0]);
                        $nhc = htmlspecialchars($estudio[1]);
                        $cod_prueba = htmlspecialchars($estudio[2]);
                        $descripcion = htmlspecialchars($estudio[3]);
                    ?>
                        <tr>
                            <td><?php echo $id_estudio; ?></td>
                            <td><?php echo $nhc; ?></td>
                            <td><?php echo $cod_prueba; ?></td>
                            <td><?php echo $descripcion; ?></td>
                            
                            <td>
                                <a href="?action=formularioAltaMedicos&id=<?php echo urlencode($id_estudio); ?>" class="btn-accion">Modificar</a>
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
</body>
</html>
