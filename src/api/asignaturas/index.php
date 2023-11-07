<?php


include(__DIR__ . "/../../models/asignaturas/asignaturas.php");

$db = new Db();
$objAsignaturas = new asignaturas($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        echo "GET: \n";
        $Mostrar = $objAsignaturas->getAsignaturas();
        echo json_encode($Mostrar);
        break;
    case 'POST':
        echo "POST: \n";
        $asignaturaId = $_GET['id'];
        $Mostrar = $objAsignaturas->mostrarAsignaturaPorId($asignaturaId);
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

