<?php

require(__DIR__ . "/../../models/profesores/profesores.php");

$db = new Db();
$objProfesores = new Profesores($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        echo "GET: \n";
        $infoProfe = $objProfesores->getProfesores();
        echo json_encode($infoProfe);
        break;

    case 'POST':
        echo "POST: \n";
        /* Llamamos funcion para obtener el id */
        $profesorId = $_GET['id'];  //Pido por URL el id
        $infoProfe = $objProfesores->mostrarProfesorPorId($profesorId);
        echo json_encode($infoProfe);

        /* Manejamos la inserción de un nuevo profesor. */

        // Puedes obtener los datos desde el cuerpo (body) de la solicitud POST.
        // Recupera los datos del formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $correoElectronico = $_POST["correoElectronico"];

        // Los campos requeridos están completos, procede con la inserción
        $infoProfe = $objProfesores->insertarProfesor($nombre, $apellido, $especialidad, $correoElectronico);
        echo json_encode($infoProfe);

        break;

    case 'DELETE':
        echo "DELETE: \n";
        $profesorId = $_GET['id'];
        // Obtén información sobre el profesor antes de eliminarlo
        $objProfesores->eliminarProfesor($profesorId);
        break;

    case 'PUT':
        echo "PUT: \n";
        $profesorId = $_GET['id'];
        $datosActualizados = [
            'nombre' => 'Nuevo Nombre',
            'apellido' => 'Nuevo Apellido',
            'fecha_nacimiento' => 'Nueva Fecha',
            'telefono' => 'Nuevo Teléfono'
        ];
    
        // Llama a la función para actualizar la información del estudiante
        $resultado = $objProfesores->actualizarProfesor($estudianteId, $datosActualizados);

        
        break;
    default:
        echo "No lo tenemos contemplado";
        break;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Insertar Profesor</title>
</head>

<body>
    <h1>Insertar un Nuevo Profesor</h1>
    <form action="index.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" required><br>

        <label for="especialidad">especialidad:</label>
        <input type="text" name="especialidad" id="especialidad" required><br>

        <label for="correoElectronico">correoElectronico:</label>
        <input type="text" name="correoElectronico" id="correoElectronico" required><br>
        <input type="submit" value="Insertar Profesor">
    </form>
</body>

</html>