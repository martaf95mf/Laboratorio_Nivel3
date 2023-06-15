<!DOCTYPE HTML>
<html>

    <head>
        <title>Samsung Desarrollo Full-Stack (Nivel 3). Laboratorio</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="js/index.js" defer></script>
        <script src="https://kit.fontawesome.com/b37653d681.js"></script>
        <link  href="estilos.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>

        <!-- MENU -->
        <nav>
            <div class="left-items">
                <a class="item selected" href="registro.html">REGISTRO</a>
                <a class="item" href="consulta.php">CONSULTA</a>
            </div>
            <a class="toggle" href="#" onclick="toggle();"><i class="fas fa-bars fa-2x"></i></a>
        </nav>

        <?php

            if($_POST){
                
                // Connect to DB
                require_once("conexion.php");
                $conn = connect_to_db();

                // Get data from form
                $nombre = trim($_POST["nombre"]);
                $apellido1 = trim($_POST["apellido1"]);
                $apellido2 = trim($_POST["apellido2"]);
                $email = trim($_POST["email"]);
                $user = trim($_POST["user"]);


                // Comprobar si usuario de login existe
                $sql_complete_user = "SELECT * FROM USUARIOS 
                                            WHERE USER='$user' 

                $complete_user_duplicates = $conn->query($sql_complete_user);
                if ($complete_user_duplicates->num_rows > 0) {
                    echo "<div class='registration-error'>";
                    echo "ERROR: Este usuario ya existe. Pruebe uno nuevo. ";
                    echo "Será redirigido al formulario en 5 segundos.";
                    echo "</div>";
                    header("refresh:5;url=registro.html" );
                    exit;
                }

                // Check if user e-mail already exists
                $sql_email_query = "SELECT * FROM USUARIOS 
                                    WHERE EMAIL='$email'";
                $email_duplicates = $conn->query($sql_email_query);
                if ($email_duplicates->num_rows > 0) {
                    echo "<div class='registration-error'>";
                    echo "ERROR: Este e-mail ya se encuentra registrado en nuestra base de datos. ";
                    echo "Será redirigido al formulario en 5 segundos.";
                    echo "</div>";
                    header("refresh:5;url=registro.html" );
                    exit;
                }

                // Insert data into DB
                try {
                    $sql_insert = "INSERT INTO USUARIOS (NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, EMAIL, USUARIO) 
                                   VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$user')";

                    // Successful insert
                    if ($conn->query($sql_insert) === TRUE) {
                        echo "<div class='registration-success'>";
                        echo "Registro completado con éxito.";
                        echo '<div><input class="search-button" type="button" value="CONSULTA" onclick="location.href=\'consulta.php\'"></div>';
                        echo "</div>";
                    } 
                } catch (mysqli_sql_exception $e) {
                    // Show error in Spanish if variable exceeds the maximum number of characters (30)
                    if (str_contains($e, "Data too long for column")) {
                        $long_var = explode(" ", $e)[6];
                        echo "<div class='registration-error'>";
                        echo "ERROR: Se ha sobrepasado el número máximo de carácteres (30) en el campo " . $long_var . ". ";
                        echo "Será redirigido al formulario en 5 segundos.";
                        echo "</div>";
                        header("refresh:5;url=registro.html" );
                    
                    // Show other errors
                    } else {
                        echo "<div class='registration-error'>";
                        echo "No se han podido registrar los datos. ";
                        echo "ERROR: " . $e;
                        echo "</div>";
                    }
                    exit;
                }

                $conn->close();
            }

        ?>

    </body>

</html>