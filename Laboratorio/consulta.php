<!DOCTYPE HTML>
<html>

    <head>
        <title>Samsung Desarrollo Full-Stack (Nivel 3). Laboratorio</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="js/index.js" defer></script>
        <script src="https://kit.fontawesome.com/b37653d681.js"></script>
        <link  href="estilos.css"rel="stylesheet" type="text/css" />
    </head>

    <body>

        <!-- MENU -->
        <nav>
            <div class="left-items">
                <a class="item" href="registro.html">REGISTRO</a>
                <a class="item selected" href="consulta.php">CONSULTA</a>
            </div>
            <a class="toggle" href="#" onclick="toggle();"><i class="fas fa-bars fa-2x"></i></a>
        </nav>

        <!-- SEARCH FORM -->
        <div id="search">  
            <h1>Consulta de registros</h1>
            <?php
                // Connect to DB
                require_once("conexion.php");
                $conn = connect_to_db();

                $search_query = "SELECT * FROM USUARIOS"; 
                $result = $conn->query($search_query);
                
                if ($result->num_rows > 0) {
            ?>
                    <table id="usuarios">
                        <tr>
                            <th>Nombre</th>
                            <th>Primer apellido</th>
                            <th>Segundo apellido</th>
                            <th>Email</th>
                            <th>Usuario</th>
                        </tr>
                        <?php
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row['NOMBRE'] . "</td>";
                                echo "<td>" . $row['PRIMER_APELLIDO'] . "</td>";
                                echo "<td>" . $row['SEGUNDO_APELLIDO'] . "</td>";
                                echo "<td>" . $row['EMAIL'] . "</td>";
                                echo "<td>" . $row['USUARIO'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
            <?php
                } else {
                    echo "No hay registros. Inscríbete: <a href='registration.html'>aquí</a>.";
                }       
                $conn->close();
            ?>
        <div>
    </body>

</html>