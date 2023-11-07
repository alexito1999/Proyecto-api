<?php

// importamos el fichero donde tenemos la clase Db
// siempre con rutas absolutas usando __DIR__ constante reservada del sistema
include(__DIR__ . "/../../middleware/db.php");

// Creamos la clase para poder instanciar funciones fuera    
class asignaturas
{
    //  Creamos la variable db
    private $db;
    //  En el constructor metemos la variable 
    public function __construct($db)
    {
        $this->db = $db;
    }

    /* Funciones */
    
    function getAsignaturas()
    {
        //  Sentencia sql y ejecucion del codigo SQL 
        $sql = 'SELECT * FROM Asignaturas';         
        $result = $this->db->executeQuery($sql);   

        // tratamiento de los datos
        $users = [];    
        while ($data = $result->fetch_object()) {
            $users[] = $data;
        }
        return $users; // Devuelve el array de Asignaturas
    }

    function mostrarAsignaturaPorId($asignaturaId)
    {
        $sql = "SELECT * FROM Asignaturas WHERE asignatura_id = $asignaturaId";
        $result = $this->db->executeQuery($sql);

        // Conversion de la informacion de toda la fila en un objeto 
        $Asignaturas=$result->fetch_object();
        return $Asignaturas;
    }

    function eliminarAsignatura($asignaturaId)
    {
        $sql = 'DELETE FROM Asignaturas WHERE asignatura_id = $asignaturaId';
        $result = $this->db->executeQuery($sql);

        //  Comprobacion si ejecucion de la sentencia tiene exito
        if ($result) {
            return true; // Asignatura eliminado con éxito
        } else {
            return false; // Error al eliminar la Asignatura
        }
    }
    public function insertarAsignatura($nombre, $apellido, $especialidad, $correoElectronico)
    {
        // Crear la consulta SQL de inserción
        $sql = "INSERT INTO Profesores (nombre, apellido, especialidad, correo_electronico) 
                VALUES ('$nombre', '$apellido', '$especialidad', '$correoElectronico')";

        $result = $this->db->executeQuery($sql);

        //  Comprobacion si ejecucion de la sentencia tiene exito
        if ($result) {
            return true; // Estudiante insertado con éxito
        } else {
            return false; // Error al insertar el Estudiante
        }
    }
}
?>