<?php

// importamos el fichero donde tenemos la clase Db
// siempre con rutas absolutas usando __DIR__ constante reservada del sistema
include(__DIR__ . "/../../middleware/db.php");

// Creamos la clase para poder instanciar funciones fuera    
class Profesores
{
    //  Creamos la variable db
    private $db;
    //  En el constructor metemos la variable 

    public function __construct($db)
    {
        $this->db = $db;
    }

    /* Funciones */

    function getProfesores()
    {
        //  Sentencia sql y ejecucion del codigo SQL 
        $sql = 'SELECT * FROM Profesores';
        $result = $this->db->executeQuery($sql);
        // tratamiento de los datos
        $users = [];
        while ($data = $result->fetch_object()) {
            $users[] = $data;
        }
        return $users; // Devuelve el array de profesores
    }

    function mostrarProfesorPorId($profesorId)
    {
        $sql = "SELECT * FROM Profesores WHERE profesor_id = $profesorId";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetch_object(); // Conversion de la informacion de toda la fila en un objeto
        return $data;
    }
    function eliminarProfesor($profesorId)
    {
        /* Crear la consulta SQL de inserción */
        $sql = "DELETE FROM Profesores WHERE profesor_id = $profesorId";
        $result = $this->db->executeQuery($sql);
        
        /* Comprobacion la sentencia SQL */
        if ($result) {
            return true; // Profesor insertado con éxito
        } else {
            return false; // Error al insertar el profesor
        }
    }
    public function insertarProfesor($nombre, $apellido, $especialidad, $correoElectronico)
    {
        /* Crear la consulta SQL de inserción */
        $sql = "INSERT INTO Profesores (nombre, apellido, especialidad, correo_electronico) 
                VALUES ('$nombre', '$apellido', '$especialidad', '$correoElectronico')";

        $result = $this->db->executeQuery($sql);

        /* Comprobacion la sentencia SQL */
        if ($result) {
            return true; // Profesor insertado con éxito
        } else {
            return false; // Error al insertar el profesor
        }
    }
    public function actualizarProfesor($profesorId, $nuevosdatos)
    {
        /* Variables que introducir en el array asociativo */
        //Introducimos parametro a parametro hasta tener los campos del array lleno
        $nNombre = $nuevosdatos['nombre'];
        $nApellido = $nuevosdatos['apellido'];
        $nfechaNacimiento = $nuevosdatos['fecha_nacimiento'];
        $ntelefono = $nuevosdatos['telefono'];

        /* Crear la consulta SQL de inserción */
        $sql = "UPDATE Profesores SET nombre = '$nNombre', apellido = '$nApellido', fecha_Nacimiento = '$nfechaNacimiento',
        correo_electronico = '$ntelefono'  WHERE estudiante_id = $profesorId";
        $result = $this->db->executeQuery($sql);

        /* Comprobacion la sentencia SQL */
        if ($result) {
            return true; // Profesor insertado con éxito
        } else {
            return false; // Error al insertar el profesor
        }
    }
}

?>