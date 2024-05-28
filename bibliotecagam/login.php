<?php

session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){

    include("./db-connect.php");
    $errores=array();

    $email=(isset($_POST['email']))?htmlspecialchars($_POST['email']):null; 
    $password=(isset($_POST['password']))?$_POST['password']:null;

    if(empty($email)){
        $errores['email']= "El campo email es requerido";        
        
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email']="El email no es válido";
    }

    if(empty($password)){
        $errores['password']= "El campo password es requerido";
    }

    if (empty($errores)) {

        $conn = new mysqli($host, $username, '', $dbname);
        //$conn = new mysqli($host, $username, 'root', $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM usuarios WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $login = false;
        while ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION["usuario_id"] = $row["id"];
                $_SESSION["usuario_nombre"] = $row["nombres"];

                // Si el inicio de sesión es exitoso, establecer login a true
                $login = true;

                // Verificar el rol del usuario
                if ($row['rol'] == 'Usuario') {
                    // Redirigir al usuario a index.php
                    header("Location: index.php");
                    exit(); // Es importante salir del script después de redirigir
                } elseif ($row['rol'] == 'Administrador') {
                    // Redirigir al administrador a index_adm.php
                    header("Location: index_adm.php");
                    exit(); // Es importante salir del script después de redirigir
                }
            }
        }

        // Si llega aquí, significa que el inicio de sesión falló
        echo'<script type="text/javascript">
    alert("El usuario no existe");
    window.location.href="login.html";
    </script>';

        $stmt->close();
        $conn->close();
    } else {

        foreach ($errores as $error) {
            echo "<br/>" . $error . "<br/>";
        }
        echo "<br/> <a href='./login.html'>Regresar al login</a>";
    }
}
?>
