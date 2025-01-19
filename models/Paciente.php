<?php
include_once 'db.php';

class Paciente
{
    private $conn;
    private $table_name = "pacientes";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para obtener la lista de pacientes
    public function getPacientes() {
        $query = "SELECT id, nombre, email, telefono, direccion FROM pacientes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array asociativo con todas las columnas
    }
    
    

    // Método para añadir un nuevo paciente
    public function addPaciente($nombre, $email, $telefono, $direccion, $historial)
    {
        // Verificar si el email ya existe
        $checkQuery = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE email = :email";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':email', $email);
        $checkStmt->execute();
        $emailExists = $checkStmt->fetchColumn();

        if ($emailExists > 0) {
            // Retornar un error indicando que el email ya existe
            throw new Exception("El correo electrónico ya está registrado.");
        }

        // Si el email no existe, procedemos a insertar
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre, email, telefono, direccion, historial_clinico) 
                  VALUES (:nombre, :email, :telefono, :direccion, :historial)";
        $stmt = $this->conn->prepare($query);

        // Bind de parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':historial', $historial);

        return $stmt->execute();
    }
}
