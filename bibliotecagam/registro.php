<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include('./db-connect.php');

    $errores = array();
    $success = false; // Corregí la variable de éxito, cambié $succes a $success

    $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : null;
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $licenciatura = isset($_POST['licenciatura']) ? $_POST['licenciatura'] : null;
    $semestre = isset($_POST['semestre']) ? $_POST['semestre'] : null;
    $confirmarPassword = isset($_POST['confirmarPassword']) ? $_POST['confirmarPassword'] : null; // Añadí la variable $confirmarPassword

    if(empty($nombres)){
        $errores['nombres'] = "El campo nombres es requerido";
    }
    if(empty($apellidos)){
        $errores['apellidos'] = "El campo apellidos es requerido";
    }
    if(empty($licenciatura)){
        $errores['licenciatura'] = "El campo licenciatura es requerido";
    }
    if(empty($semestre)){
        $errores['semestre'] = "El campo semestre es requerido";
    }

    if(empty($email)){
        $errores['email'] = "El campo email es requerido";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email'] = "El email no es válido";
    }

    if(empty($password)){
        $errores['password'] = "El campo password es requerido";
    }

    if(empty($confirmarPassword)){
        $errores['confirmarPassword'] = "Confirma la contraseña";
    } elseif($password != $confirmarPassword){
        $errores['confirmarPassword'] = "Las contraseñas no coinciden";
    }

    foreach($errores as $error){
        echo "<br/>".$error."<br/>";
    }

    if (empty($errores)) {
        $nuevoPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `usuarios` (`nombres`, `apellidos`, `email`, `password`, `licenciatura`, `semestre`)
        VALUES ('$nombres', '$apellidos', '$email', '$nuevoPassword', '$licenciatura', '$semestre')";


        if ($conn->query($sql) === TRUE) {
            $success = true;
        } else {
            echo "Error al registrar: " . $conn->error;
        }
    } else {
        echo "No se registraron los datos";
    }

}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8">

                        

                    <?php if (isset($success)){ ?>
                        <div
                            class="alert alert-success alert-dismissible fade show"
                            role="alert"
                        >
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                            ></button>
                        
                            <strong>¡Registro exitoso!</strong> Puede ingresar al sistema
                            en el siguiente enlace:
                            <a href="login.html" class="btn btn-success">Login</a>
                        </div>
                    <?php } ?>
                        
                        <div class="card">
                            <div class="card-header">Formulario de registro</div>
                            <div class="card-body">
                                <form action="./registro.php" id="formularioderegistro" method="post">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="nombres" class="form-label">Nombres</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="nombres"
                                                    id="nombres"
                                                    aria-describedby="helpId"
                                                    placeholder="Escribe tu nombre"
                                                    required
                                                />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="apellidos" class="form-label">Apellidos</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="apellidos"
                                                    id="apellidos"
                                                    aria-describedby="helpId"
                                                    placeholder="Escribe tu apellido"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            id="email"
                                            aria-describedby="emailHelpId"
                                            placeholder="abc@mail.com"
                                            required
                                        />
                                    </div>
        
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    name="password"
                                                    id="password"
                                                    placeholder="Escribe una contraseña"
                                                    required
                                                />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="confirmarPassword" class="form-label">Repetir contraseña</label>
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    name="confirmarPassword"
                                                    id="confirmarPassword"
                                                    placeholder="Repite la contraseña"
                                                    required
                                                />
                                                <div class="invalid-feedback">Las contraseñas no coinciden</div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="licenciatura" class="form-label">
                                                Licenciatura
                                            </label>
        
                                            <select class="form-select" name="licenciatura" id="licenciatura" required>
                                                <option value="">Seleccione su licenciatura</option>
                                                <option value="Ciencia Política y Administración Urbana">Ciencia Política y Administración Urbana</option>
						<option value="Ciencias Ambientales">Ciencias Ambientales</option>
						<option value="Ciencias Ambientales y Cambio Climático">Ciencias Ambientales y Cambio Climático</option>
						<option value="Ciencias Genómicas">Ciencias Genómicas</option>
						<option value="Ciencias Sociales">Ciencias Sociales</option>
						<option value="Comunicación y Cultura">Comunicación y Cultura</option>
						<option value="Creación Literaria">Creación Literaria</option>
						<option value="Derecho">Derecho</option>
						<option value="Filosofía e Historia de las Ideas">Filosofía e Historia de las Ideas</option>
						<option value="Historia y Sociedad Contemporánea">Historia y Sociedad Contemporánea</option>
						<option value="Ingeniería de Software">Ingeniería de Software</option>
						<option value="Ingeniería en Sistemas de Transoporte Urbano">Ingeniería en Sistemas de Transoporte Urbano</option>
						<option value="Ingeniería en Sistemas Electrónicos Industriales">Ingeniería en Sistemas Electrónicos Industriales</option>
						<option value="Ingeniería en Sistemas Electrónicos y de Telecomunicaciones">Ingeniería en Sistemas Electrónicos y de Telecomunicaciones</option>
						<option value="Ingeniería en Sistemas Energéticos">Ingeniería en Sistemas Energéticos</option>
						<option value="Modelación Matemática">Modelación Matemática</option>
						<option value="Nutrición y Salud">Nutrición y Salud</option>
						<option value="Promoción de la Salud">Promoción de la Salud</option>

                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
        
                                        <div class="col">
                                            <label for="semestre" class="form-label">
                                                Semestre
                                            </label>
                                            <select class="form-select" name="semestre" id="semestre" required>
                                                <option value="">Seleccione su semestre</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
        
                                    <button type="submit" class="btn btn-success">Registrarse</button>
                                    <a href="login.html" class="btn btn-secondary">Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
        
                document.getElementById("formularioderegistro").addEventListener('submit', function (event) {
                    
                    var password = document.getElementById("password").value;
                    var confirmarPassword = document.getElementById("confirmarPassword").value;
        
                    // Verificar la contraseña
                    if (password !== confirmarPassword) {
                        document.getElementById('confirmarPassword').classList.add("is-invalid");
                        event.preventDefault(); // Detiene el envío del formulario si la validación falla
                    } else {
                        document.getElementById("confirmarPassword").classList.remove("is-invalid");
                    }
                });
            });
        </script>
        


    </body>
</html>
