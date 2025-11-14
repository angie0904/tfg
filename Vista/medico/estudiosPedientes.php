
<main>
    <form action="index.php?action=listaResul" method="post">
        <div class="">
            <?php
            
               

             

                // Tabla de resultados detallada
                echo "<table border='1' style='width:100%;border-collapse:collapse;'>";
                echo "<tr><th style='padding:8px;text-align:left;'>Prueba</th><th style='padding:8px;text-align:left;'>Resultados</th><th style='padding:8px;text-align:left;'>Valores normales</th></tr>";

                    
                    $cod_prueba = htmlspecialchars($value[1] ?? '');
                    $resul = htmlspecialchars($value[1] ?? '');
                    $valores = htmlspecialchars($value[2] ?? '');
                    echo "<tr>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$cod_prueba</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$resul</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$valores</td>";
                    echo "</tr>";


                echo "</table>";
     

            if (isset($msg)) echo $msg;
            ?>
        </div>
    </form>
</main>



