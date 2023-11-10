<?php
//La ruta del archivo donde albergo las rfunciones
require(__DIR__ . "/../../models/profesores/profesores.php");
//Instancio el objeto de base de datos para poder ejecutar los metodos
$db = new Db();
//Instancio el objeto de profesores para usar las funciones
$objProfesores = new Profesores($db);
//Con esta variable puedo hacer que los metodos que seleccione en el postman coincidadn con el swirtch
$method = $_SERVER["REQUEST_METHOD"];
//Condicional para elegir el metodo a usar
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
        $profesorId = $_GET['id'];  //Obtengo el id del profesor
        $json = file_get_contents('php://input');   //Recupero la peticion del json que uso en el postman con los datos
        $data = json_decode($json, true);   //Convierto el json en un array y lo guardo en una variable
        /* Manejo de datos  */
        //metemos en un array mas grande los datos del json para poder llevarlo a la funcion
        $datosActualizados = [
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'especialidad' => $data['especialidad'],
            'correo_electronico' => $data['correo_electronico']
        ];
        // Llama a la función para actualizar la información del estudiante
        $objProfesores->actualizarProfesor($estudianteId, $datosActualizados);
        break;
    default:
        echo "No lo tenemos contemplado";
        break;
}

?>
