<h1 align="center">Contenido</h1>

**carpeta src**: Donde guardo la Api-Restful.

**Docker-compose**: Usado para configurar las conexiones con php y msql para ser dockerizado. 

**Dockerfile**: Usado para configurar el php.

## Tabla de Contenido de la SRC
- [API](#api)
- [Configuración](#config)
- [Middleware](#/middleware)
- [Modelos](#models)
### API
- [estudiantes](src/api/estudiantes/index.php)
- [asignaturas](src/api/asignaturas/index.php)
- [calificaciones](src/api/calificaciones/index.php)
- [inscripciones](src/api/inscripciones/index.php)
- [profesores](src/api/profesores/index.php)
### Configuración
- [estudiantes](src/api/estudiantes/index.php)
- [asignaturas](src/api/asignaturas/index.php)
- [calificaciones](src/api/calificaciones/index.php)
- [inscripciones](src/api/inscripciones/index.php)
- [profesores](src/api/profesores/index.php)
### Middleware
- [middleware](src/middleware/config.php)
### Modelos
- [estudiantes](src/api/estudiantes/estudiantes.php)
- [asignaturas](src/api/asignaturas/asignaturas.php)
- [calificaciones](src/api/calificaciones/calificaciones.php)
- [inscripciones](src/api/inscripciones/inscripciones.php)
- [profesores](src/api/profesores/profesores.php)


<h1 align="center">FUNCIONAMIENTO</h1>

<h3>Tenemos cuatro carpetas principales:</h3>

**Midleware**: Se guarda la conexion a base de datos con la api y se creamos la funcion para ejecutar las consultas sql.

**Config**: Se guarda lasa variables para conectar con la base de datos como por ejempo usuario y contraseña.

**API**: Donde albergo las carpetas de cada uno de los componentes de mi api desde los cuales tengo en index principal que servira para hacer las llamadas a mis funciones como son:
GET, POST, DELETE Y PUT.

**Modelos**: Tengo las funciones que realizan las consultas sql.


<h3>Explicacion sustancial de las carpetas mas importantes</h3>

**API**: Aqui se encuentra el "index.php" que se usara para hacer las llamadas y probar nuestros metodos POST, GET ... 
Vamos a poner como ejemplo el index de profesor porque los demas se  replicaron con el mismo modelo.
<?php
include(__DIR__ . "/../../models/estudiantes/estudiantes.php");
$db = new Db();
$objEstudiantes = new Estudiantes($db);
$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case 'GET':
        echo "GET: \n";
        $objEstudiantes->getEstudiantes(); //funcion
        break;

    case 'POST':
        echo "POST: \n";
            /* Llamamos funcion para obtener el id */
        $estudianteId = $_GET['id'];        //Pido por URL el id
        $objEstudiantes->mostrarEstudiantePorId($estudianteId);//Paso por parametro el id para la funcion

        /* Manejamos la inserción de un nuevo profesor. */

        // Puedes obtener los datos desde el cuerpo (body) de la solicitud POST.
        // Recupera los datos del formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fechaNacimiento = $_POST["fechaNacimiento"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];

        // Los campos requeridos están completos, procede con la inserción
        $objEstudiantes->insertarEstudiante($nombre, $apellido, $fechaNacimiento, $direccion,$telefono);
        break;

    case 'DELETE':
        echo "DELETE: \n";
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
        /* ARRAY asociado con los datos del json */
        //A cada 
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


  

<h2 align="left">Explicacion estudiantes/profesor</h2>
E
