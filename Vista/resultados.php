<main>
        
        <form action="index.php?action=listaResul" method="post">
            <?php
                echo "<table border='1'>";
                    echo "<tr><th>Prueba</th><th>Resultados</th><th>Valores normales</th><th>Interpretación</th></tr>";
                        foreach ($resul as $key => $value) {
                            $value[2] = str_repeat("*", strlen($value[2]));
                            echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td><input type='radio' name='nomUsu' value='$value[1]' required></td></tr>";
                        }
                        echo "</table>";
                if(isset($msg)) echo $msg;
            ?>
        <input type="submit" value="Modificar" name="modificar">
        </form>
    </main>