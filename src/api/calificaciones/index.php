<?php
include(__DIR__ . "/../../models/calificaciones/calificaciones.php");

$db = new Db();
$objCalificaciones = new Calificaciones($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        echo "GET: \n";
        $Mostrar = $objCalificaciones->getCalificaciones();
        echo json_encode($Mostrar);
        break;
    case 'POST':
        echo "POST: \n";
        $CalificacionesId = $_GET['id'];
        $Mostrar = $objCalificaciones->mostrarCalificacionesPorId($CalificacionesId);
        echo json_encode($Mostrar);
        break;
    case 'DELETE':
        echo "DELETE: \n";
        $profesorId = $_GET['id'];
        // Obtén información sobre el profesor antes de eliminarlo
        $objProfesores->eliminarProfesor($profesorId);
        break;

    default:
        echo "No lo tenemos contemplado";
        break;
}
?>