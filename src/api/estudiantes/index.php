<?php

include(__DIR__ . "/../../models/estudiantes/estudiantes.php");

$db = new Db();
$objEstudiantes = new Estudiantes($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        echo "GET: \n";
        $Mostrar = $objEstudiantes->getEstudiantes(); //funcion
        echo json_encode($Mostrar);     //la paso a formato json para represntar
        break;

    case 'POST':
        echo "POST: \n";
            /* Llamamos funcion para obtener el id */
        $estudianteId = $_GET['id'];        //Pido por URL el id
        $Mostrar = $objEstudiantes->mostrarEstudiantePorId($estudianteId);//Paso por parametro el id para la funcion
        echo json_encode($Mostrar);

        /* Manejamos la inserción de un nuevo profesor. */

        // Puedes obtener los datos desde el cuerpo (body) de la solicitud POST.
        // Recupera los datos del formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $correoElectronico = $_POST["correoElectronico"];

        // Los campos requeridos están completos, procede con la inserción
        $infoestudiante = $objEstudiantes->insertarEstudiante($nombre, $apellido, $especialidad, $correoElectronico);
        echo json_encode($infoestudiante);
        break;

    case 'DELETE':
        echo "DELETE: ";
        $estudianteId = $_GET['id'];        //Pido por URL el id a eliminar
        // Obtén información sobre el profesor antes de eliminarlo
        $objEstudiantes->eliminarEstudiante($estudianteId); //Paso id del estudiante a eliminar
        break;

    case 'PUT':
        echo "PUT: \n";
        $estudianteId = $_GET['id'];    //Pido por URL el id a actualizar
        /* Procesamiento de la Solicitud del postman que hizimos en el json en la pestaña body */
        
        $json = file_get_contents('php://input');   //Recupero la peticion del json que uso en el postman con los datos
        $data = json_decode($json, true);//decodificamos el json para usarlo dentro para cada parametro del array
        /* ARRAY con los datos del json */
        $nuevosdatos = [
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono']
        ];
        /* LLamo a la funcion para actualizar los datos del estudiante*/
        $objEstudiantes->actualizarEstudiantes($estudianteId, $nuevosdatos);
        echo "Estos son los datos del estudiante actualizado: ".json_encode($data);
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
    <h1>Insertar un Nuevo Estudiante</h1>
    <form action="index.php" method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="apellido">Apellido: </label>
        <input type="text" name="apellido" id="apellido" required><br>

        <label for="fecha_nacimiento">fecha_nacimiento: </label>
        <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" required><br>

        <label for="direccion">direccion: </label>
        <input type="text" name="direccion" id="direccion" required><br>

        <label for="telefono">telefono: </label>
        <input type="text" name="telefono" id="telefono" required><br>
        <input type="submit" value="Insertar Profesor">
    </form>
</body>

</html>