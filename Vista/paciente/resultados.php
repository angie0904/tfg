
<main>
    <form action="index.php?action=listaResul" method="post">
        
        <div class="">
            <?php
            if (empty($arrayResultados)) {
                echo "<p>No hay resultados para mostrar.</p>";
                
            } else {
                // Extraer datos del paciente a partir del primer resultado (usa el SELECT existente)
                // $value = [Prueba, Resultados, Valores, Descripción, login_pa, login_sa]
                $first = $arrayResultados[0];
                $login_pa = htmlspecialchars($first[2] ?? '');
                $login_sa = htmlspecialchars($first[5] ?? '');
                $total_pruebas = count($arrayResultados);

                // Tabla superior con datos del paciente (usando lo que devuelve tu SELECT)
                echo "<table border='1' style='margin-bottom:1rem;width:100%;border-collapse:collapse;'>";
                echo "<tr style='background:#f3f4f6;'>";
                echo "<th style='padding:8px;text-align:left;'>Nº Historia Clinica</th>";
                echo "<th style='padding:8px;text-align:left;'>Centro/Responsable</th>";
                echo "<th style='padding:8px;text-align:left;'>Total pruebas</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='padding:8px;'>$login_pa</td>";
                echo "<td style='padding:8px;'>$login_sa</td>";
                echo "<td style='padding:8px;'>$total_pruebas</td>";
                echo "</tr>";
                echo "</table>";

                // Tabla de resultados detallada
                echo "<table border='1' style='width:100%;border-collapse:collapse;'>";
                echo "<tr><th style='padding:8px;text-align:left;'>Prueba</th><th style='padding:8px;text-align:left;'>Resultados</th><th style='padding:8px;text-align:left;'>Valores normales</th></tr>";

                foreach ($arrayResultados as $key => $value) {
                    $prueba = htmlspecialchars($value[0] ?? '');
                    $resul = htmlspecialchars($value[1] ?? '');
                    $valores = htmlspecialchars($value[2] ?? '');
                    echo "<tr>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$prueba</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$resul</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$valores</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }

            if (isset($msg)) echo $msg;
            ?>
        </div>
    </form>
</main>
