<?php

// importamos el fichero donde tenemos la clase Db
// siempre con rutas absolutas usando __DIR__ constante reservada del sistema
include(__DIR__ . "/../../middleware/db.php");

// Creamos la clase para poder instanciar funciones fuera    
class Estudiantes
{
    //  Creamos la variable db
    private $db;
    //  En el constructor metemos la variable 

    public function __construct($db)
    {
        $this->db = $db;
    }

        /* Funciones */

        function getEstudiantes()
    {
        //  Sentencia sql y ejecucion del codigo SQL 
        $sql = 'SELECT * FROM Estudiantes';
        $result = $this->db->executeQuery($sql);
        // tratamiento de los datos
        $users = [];

        while ($data = $result->fetch_object()) {
            $users[] = $data;
        }
        return $users; // Devuelve el array de estudiantes
    }

    function mostrarEstudiantePorId($estudianteId)
    {

        $sql = "SELECT * FROM Estudiantes WHERE estudiante_id = $estudianteId";
        $result = $this->db->executeQuery($sql);
        $Estudiante=$result->fetch_object();      // Conversion de la informacion de toda la fila en un objeto 
        return $Estudiante;
    }


    function eliminarEstudiante($estudianteId)
    {
        $estudianteExiste = $this->mostrarEstudiantePorId($estudianteId); // Comprobacion de la existencia del profesor
        if ($estudianteExiste) {
        $sql = "DELETE FROM Estudiantes WHERE estudiante_id = $estudianteId";
        $this->db->executeQuery($sql);
        echo "Eliminaste a este profesor : " . json_encode($estudianteExiste);
        } else {
            return false; // El estudiante no existe
        }
    }

    public function insertarEstudiante($nombre, $apellido, $fechaNacimiento, $direccion)
    {
        // Crear la consulta SQL de inserción
        $sql = "INSERT INTO Estudiantes (nombre, apellido, fecha_nacimiento, direccion, telefono) 
                VALUES ('$nombre', '$apellido', '$fechaNacimiento', '$direccion')";

        $result = $this->db->executeQuery($sql);

        if ($result) {
            return true; // Estudiante insertado con éxito
        } else {
            return false; // Error al insertar el Estudiante
        }
    }
    public function actualizarEstudiantes($estudianteId, $nuevosdatos)
    {
        /* Variables que introducir en el array asociativo */
        //Introducimos parametro a parametro hasta tener los campos del array lleno
        $nNombre = $nuevosdatos['nombre'];
        $nApellido = $nuevosdatos['apellido'];
        $nfechaNacimiento = $nuevosdatos['fecha_nacimiento'];
        $ndireccion = $nuevosdatos['direccion'];
        $ntelefono = $nuevosdatos['telefono'];

        /* Crear la consulta SQL de inserción */
        $sql = "UPDATE Estudiantes SET nombre = '$nNombre', apellido = '$nApellido', fecha_nacimiento = '$nfechaNacimiento',
        direccion = '$ndireccion' ,telefono = '$ntelefono'  WHERE estudiante_id = $estudianteId";
        $result = $this->db->executeQuery($sql);

        /* Comprobacion la sentencia SQL */
        if ($result) {
            return true; // Estudiante insertado con éxito
        } else {
            return false; // Error al insertar el Estudiante
        }
    }
}

?>