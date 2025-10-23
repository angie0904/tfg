<main>
    <?php
        if(isset($_POST["modificar"])){
            echo "<h1>Modificar Usuario</h1>";
            echo "<form action='../Controlador/index.php?action=modificarUsuario' method='post'>";
                echo "<table border='1'>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Nuevo Nombre</label><br>";
                            echo "<input type='text' name='nombreModif' value='".$usuario[0][1]."'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nueva Contraseña</label><br>";
                            echo "<input type='text' name='pswdModif' value='".$usuario[0][2]."'>";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
                echo "<input type='hidden' name='idUsu' value='".$usuario[0][0]."'>";
                echo "<input type='submit' value='Modificar' name='modificar'>";
            echo "</form>";
        }else{
    ?>
    <form action="../Controlador/index.php?action=insertarUsuario" method="post">
        <h1>Insertar Usuario</h1>

        <div>
            <label for="floatingInput">Nombre</label>
            <br>
            <input type="text" name="nom">
        </div>
        <div>
            <label for="floatingInput">Contraseña</label>
            <br>
            <input type="password" name="psw">
        </div>
        <div>
            <label for="date">Fecha de nacimiento</label>
            <br>
            <input type="date" name="fnac">
        </div>
        <div>
            <label for="floatingInput">DNI</label>
            <br>
            <input type="text" name="dni">
        </div>
        <button value="Enviar" type="submit">Crear Cuenta</button>
    </form>

    <?php
        }
        ?>
    <a href="index.php?action=volverUsuarios">Atrás</a>
</main>