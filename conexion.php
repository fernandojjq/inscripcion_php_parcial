<?php
// Archivo: conexion.php

class Conexion {
    private $host = 'localhost';
    private $db_name = 'itech_parcial'; // Asegúrate que coincida con la BD que creaste
    private $username = 'root';         // Usuario por defecto en WAMP
    private $password = '';             // Contraseña por defecto en WAMP es vacía
    private $conn;

    // Esta función es la que nos devolverá la conexión lista para usar
    public function getConexion() {
        $this->conn = null;

        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8';
            $this->conn = new PDO($dsn, $this->username, $this->password);
            
            // Configuramos PDO para que nos notifique de errores
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Si algo sale mal, muestra un error y detiene todo
            die("Error de conexión: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
?>