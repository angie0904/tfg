<main>
        
        <form action="index.php?action=vistaModificarUsuario" method="post">
            <?php
                echo "<table border='1'>";
                    echo "<tr><th>NHC</th><th>Nombre</th><th>Apellidos</th><th>Fecha de Nacimiento</th></tr>";
                        foreach ($listaPacientes as $key => $value) {
                            for($i = 0; $i < strlen($value[2]); $i++){
                                $value[2][$i] = "*";
                            }
                            echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td><input type='radio' name='nomUsu' value='$value[1]' required></td></tr>";
                        }
                        echo "</table>";
                if(isset($msg)) echo $msg;
            ?>
        <input type="submit" value="Modificar" name="modificar">
        </form>
    </main>