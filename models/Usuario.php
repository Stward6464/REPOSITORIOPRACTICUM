<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT id, username, rol FROM usuarios WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Supongamos que no está encriptada
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el registro como un array asociativo
    }
    
    
}
?>
