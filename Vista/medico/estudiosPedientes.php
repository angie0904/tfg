
<main>
    <form action="" method="post">
        <div class="">
            <?php
            
               

             

                // Tabla de resultados detallada
                echo "<table border='1' style='width:100%;border-collapse:collapse;'>";
                echo "<tr><th style='padding:8px;text-align:left;'>Prueba</th><th style='padding:8px;text-align:left;'>Resultados</th><th style='padding:8px;text-align:left;'>Valores normales</th></tr>";

                    
                    $cod_prueba = htmlspecialchars($value[1] ?? '');
                    $resul = htmlspecialchars($value[1] ?? '');
                    $valores = htmlspecialchars($value[2] ?? '');
                    echo "<tr>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$2</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>hola</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$400</td>";
                    
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'><a href='index.php?action=informe' class='bg-blue-500 text-white px-3 py-1 rounded text-sm'>Informar</a></td> </form>";
                    echo "</tr>";
                    
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$1</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>jj</td>";
                    echo "<td style='padding:8px;border-top:1px solid #e5e7eb;'>$300</td>";
                    echo "</tr>";


                echo "</table>";
     

            if (isset($msg)) echo $msg;
            ?>
            

        </div>
    </form>
</main>



