<?php

// importamos el fichero donde tenemos la clase Db
// siempre con rutas absolutas usando __DIR__ constante reservada del sistema
include(__DIR__ . "/../../middleware/db.php");

// Creamos el objeto Db    
class inscripciones
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    // ejecucion del codigo SQL para extraer los datos
    function getInscripciones()
    {
        $sql = 'SELECT * FROM Inscripciones';
        $result = $this->db->executeQuery($sql);
        // tratamiento de los datos
        $users = [];

        while ($data = $result->fetch_object()) {
            $users[] = $data;
        }
        return $users; // Devuelve el array de Inscripciones
    }

    function mostrarInscripcionesPorId($inscripcionesId)
    {

        $sql = "SELECT * FROM Inscripciones WHERE inscripcion_id = $inscripcionesId";
        $result = $this->db->executeQuery($sql);
        while ($data = $result->fetch_object()) {
            $users[] = $data;
        }
        return $users;
    }


    function eliminarEstudiante($estudianteId)
    {
        $sql = 'DELETE FROM Estudiantes WHERE estudiante_id = $estudianteId';
        $result = $this->db->executeQuery($sql);
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