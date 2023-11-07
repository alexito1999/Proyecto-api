<?php

// importamos el fichero donde tenemos la clase Db
// siempre con rutas absolutas usando __DIR__ constante reservada del sistema
include(__DIR__ . "/../../middleware/db.php");

// Creamos la clase para poder instanciar funciones fuera    
class Calificaciones
{
    //  Creamos la variable db
    private $db;
    //  En el constructor metemos la variable 

    public function __construct($db)
    {
        $this->db = $db;
    }

        /* Funciones */

    function getCalificaciones()
    {
        //  Sentencia sql y ejecucion del codigo SQL 
        $sql = 'SELECT * FROM Calificaciones';
        $result = $this->db->executeQuery($sql);

        // tratamiento de los datos
        $users = [];
        while ($data = $result->fetch_object()) {
            $users[] = $data;
        }
        return $users;      // Devuelve el array de las calificaciones
    }

    function mostrarCalificacionesPorId($CalificacionesId)
    {
        $sql = "SELECT * FROM Calificaciones WHERE Calificacion_id = $CalificacionesId";
        $result = $this->db->executeQuery($sql);
        $calificacion=$result->fetch_object();        // Conversion de la informacion de toda la fila en un objeto 
        return $calificacion;
    }

    function eliminarEstudiante($estudianteId)
    {
        $sql = 'DELETE FROM Estudiantes WHERE estudiante_id = $estudianteId';
        $result = $this->db->executeQuery($sql);
        //  Comprobacion si ejecucion de la sentencia tiene exito
        if ($result) {
            return true; // Estudiante eliminado con éxito
        } else {
            return false; // Error al eliminar el Estudiante
        }
    }
    public function insertarEstudiante($nombre, $apellido, $especialidad, $correoElectronico)
    {
        // Crear la consulta SQL de inserción
        $sql = "INSERT INTO Profesores (nombre, apellido, especialidad, correo_electronico) 
                VALUES ('$nombre', '$apellido', '$especialidad', '$correoElectronico')";

        $result = $this->db->executeQuery($sql);

        if ($result) {
            return true; // Estudiante insertado con éxito
        } else {
            return false; // Error al insertar el Estudiante
        }
    }
}
?>