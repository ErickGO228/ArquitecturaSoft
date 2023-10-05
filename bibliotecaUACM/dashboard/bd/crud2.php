<?php
// Módulo de manejo de personas
$personasModule = (function () {
    // Incluye el archivo de conexión a la base de datos
    include_once '../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // Función para agregar una nueva persona
    function agregarPersona($nombre, $matricula, $carrera) {
        global $conexion;
        $consulta = "INSERT INTO personas (nombre, matricula, carrera) VALUES('$nombre', '$matricula', '$carrera') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, matricula, carrera FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Función para modificar una persona existente
    function modificarPersona($id, $nombre, $matricula, $carrera) {
        global $conexion;
        $consulta = "UPDATE personas SET nombre='$nombre', matricula='$matricula', carrera='$carrera' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, matricula, carrera FROM personas WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Función para eliminar una persona
    function eliminarPersona($id) {
        global $conexion;
        $consulta = "DELETE FROM personas WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
    }

    return [
        'agregarPersona' => agregarPersona,
        'modificarPersona' => modificarPersona,
        'eliminarPersona' => eliminarPersona,
    ];
})();

// Recepción de los datos enviados mediante POST desde el JS   
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$matricula = (isset($_POST['matricula'])) ? $_POST['matricula'] : '';
$carrera = (isset($_POST['carrera'])) ? $_POST['carrera'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$data = [];

switch ($opcion) {
    case 1: //alta
        $data = $personasModule['agregarPersona']($nombre, $matricula, $carrera);
        break;
    case 2: //modificación
        $data = $personasModule['modificarPersona']($id, $nombre, $matricula, $carrera);
        break;
    case 3: //baja
        $personasModule['eliminarPersona']($id);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>
