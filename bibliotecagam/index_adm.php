<?php

session_start();
if(!isset($_SESSION['usuario_id'])){
    header("location:login.html");
    exit();

}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Panel de bienvenida</title>
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

<nav
    class="navbar navbar-expand-lg navbar-light bg-light"
>
    <div class="container">
        <a class="navbar-brand" href="#">Panel administrador</a>
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="calendario.php">Ir al Sistema de Reservas</a>
                
                </li>
                <li class="nav-item">
                <a class="nav-link" href="https://www.uacm.edu.mx">UACM</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cerrar.php">Cerrar</a>
                </li>
                
            </ul>
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <img src="images/logo.jpg" alt="Logo" style="height: 150px;">
                                </a>
                            </li>
                        </ul>
            
        </div>
    </div>
</nav>



<br>

<div
    class="container"
>
    <div
        class="row justify-content-center align-items-center"
    >
        <div class="col"><h2> Bienvenido a la aplicación <?php echo $_SESSION['usuario_nombre'];?></h2>
<p> Podrás reservar un cubículo o una computadora en la Biblioteca del plantel Cuautepec </p>
<ul>
<h3>Instrucciones de uso:</h3>
    <li>Ingresa al Sistema de Reservas.</li>
    <li>Para registrar una nueva reserva, utiilza el formulario Solicitud</li>
    <li>Para elegir un Cubículo, usa el formato C1, C2, C3 o PC1, PC2, PC3</li>
    <li>Elige la hora que se comenzará de usar el Cubículo o la Computadora</li>
    <li>Elige la hora que se terminará de usar el Cubículo o la Computadora. Se recomiendoa que el tiempo máximo sea 1:30 horas</li>
    <li>Con el botón Guardar, guarda la reserva y confírmala.</li>
    <li>Si tienes duda con tu reserva, ingresa de nuevo al Sistema de Reservas para consultarla.</li>
    <li>Para cambiar una reserva, elígela del Calendario, edítala en el formulario y guarda los cambios. Confirma los cambios.</li>
    <li>Para cancelar tu reserva, elígela del Calendario, elimínala en el formulario y guarda los cambios. Confirma los cambios.</li>
</ul>
        </div>
        
    </div>

    <div
        class="row justify-content-center"
    >
        <div class="col-md-4">
            <div class="card">
                                    
                    <a class = "btn btn-success" href="calendario.php">Sistema de Reservas</a>

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
    </body>
</html>
