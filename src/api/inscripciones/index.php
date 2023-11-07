<?php

include(__DIR__ . "/../../models/inscripciones/inscripciones.php");

$db = new Db();
$objInscripciones = new inscripciones($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        echo "GET: \n";
        $Mostrar = $objInscripciones->getInscripciones();
        echo json_encode($Mostrar);
        break;
    case 'POST':
        echo "POST: \n";
        $inscripcionesId = $_GET['id'];
        $Mostrar = $objInscripciones->mostrarInscripcionesPorId($inscripcionesId);
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