<?php
// Formulario de informe médico
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Informe</title>
    <link rel="stylesheet" href="../../Recursos/css/app.css">
    <style>
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }
        .info-paciente {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 30px;
        }
        .info-paciente h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #3896c8ff;
            padding-bottom: 10px;
        }
        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 10px;
        }
        .info-field {
            display: flex;
            flex-direction: column;
        }
        .info-field label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        .info-field span {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulario de Informe Médico</h1>
        
        <!-- Mostrar información del estudio y del paciente -->
        <?php
        if (isset($arrayResultados) && is_array($arrayResultados) && count($arrayResultados) > 0) {
            $estudio = $arrayResultados[0];
            $nhc = htmlspecialchars($estudio[0] ?? '');
            $nombre = htmlspecialchars($estudio[1] ?? '');
            $apellidos = htmlspecialchars($estudio[2] ?? '');
            $f_nac = htmlspecialchars($estudio[3] ?? '');
            $descripcion = htmlspecialchars($estudio[4] ?? '');
            $resultados = htmlspecialchars($estudio[5] ?? '');
            $id_informe = htmlspecialchars($estudio[6] ?? '');
        ?>
            <div class="info-paciente">
                <h2>Información del Paciente y Estudio</h2>
                <div class="info-row">
                    <div class="info-field">
                        <label>NHC:</label>
                        <span><?php echo $nhc; ?></span>
                    </div>
                    <div class="info-field">
                        <label>Nombre:</label>
                        <span><?php echo $nombre; ?></span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-field">
                        <label>Apellidos:</label>
                        <span><?php echo $apellidos; ?></span>
                    </div>
                    <div class="info-field">
                        <label>Fecha de Nacimiento:</label>
                        <span><?php echo $f_nac; ?></span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-field">
                        <label>Descripción de Prueba:</label>
                        <span><?php echo $descripcion; ?></span>
                    </div>
                </div>
                 <div class="info-row">
                    <div class="info-field">
                        <label>ID informe:</label>
                        <span><?php echo $id_informe; ?></span>
                    </div>
                </div>
            </div>
        <?php
        } else {
            echo "<p style='color: #ff9800; font-weight: bold;'>No se encontraron datos del estudio.</p>";
        }
        ?>
        
        <!-- Formulario para crear informe -->
        <form method="POST">
            <input type="hidden" name="id_estudio" value="<?php echo htmlspecialchars($id_estudio ?? ''); ?>">
            <input type="hidden" name="id_informe" value="<?php echo isset($id_informe) ? intval($id_informe) : ''; ?>">

            <div class="form-group">
                <label for="diagnostico">Diagnóstico / Resultados:</label>
                <textarea id="diagnostico" name="diagnostico" ><?php echo isset($resultados) ? $resultados : ''; ?></textarea>
            </div>

            <div style="display:flex; gap:12px; margin-top:10px;">
                <button type="submit" formaction="index.php?action=validarInforme" class="btn-submit" style="background-color:#4CAF50">Validar</button>
                <button type="submit" formaction="index.php?action=guardarInforme" class="btn-submit" style="background-color:#f39c12">Guardar</button>
            </div>
        </form>
    </div>
</body>
</html>


