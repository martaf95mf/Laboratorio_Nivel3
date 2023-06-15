<?php
    function connect_to_db() {
        
        // Create connection
        require_once("credenciales.php");
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("No es posible conectarse a la base de datos: " . $conn->connect_error);
        }

        return $conn;
    }
?>