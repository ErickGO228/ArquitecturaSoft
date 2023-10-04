<?php
// Módulo de manejo de personas
$personasModule = (function () {
    // Incluye el archivo de conexión a la base de datos
    include_once './bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // Función para obtener personas
    function obtenerPersonas() {
        global $conexion;
        $consulta = "SELECT id, nombre, matricula, carrera FROM personas";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Función para mostrar la tabla de personas
    function mostrarTablaPersonas() {
        $data = obtenerPersonas();
        echo '<table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">';
        echo '<thead class="text-center">
                <tr>
                    <th>Id</th>
                    <th>Nombre y Apellido</th>
                    <th>Matricula</th>
                    <th>Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>';
        echo '<tbody>';
        foreach ($data as $dat) {
            echo '<tr>';
            echo '<td>' . $dat['id'] . '</td>';
            echo '<td>' . $dat['nombre'] . '</td>';
            echo '<td>' . $dat['matricula'] . '</td>';
            echo '<td>' . $dat['carrera'] . '</td>';
            echo '<td></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }

    // Agrega aquí otras funciones públicas si es necesario

    return [
        'mostrarTablaPersonas' => mostrarTablaPersonas,
        // Agrega aquí otras funciones públicas si es necesario
    ];
})();

// Utiliza las funciones del módulo
$personasModule['mostrarTablaPersonas']();
?>

<!-- Resto del código HTML -->

<?php require_once "vistas/parte_inferior.php" ?>
