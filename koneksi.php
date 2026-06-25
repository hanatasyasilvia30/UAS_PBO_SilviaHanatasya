<?php
// koneksi.php

class Database {
    private string $host = "localhost";
    private string $username = "root"; // sesuaikan dengan xampp kamu
    private string $password = "";     // sesuaikan dengan xampp kamu
    private string $dbname = "DB_UAS_PBO_TI1D_SILVIAHANATASYA"; // sesuaikan dengan nama databasemu
    public ?PDO $conn = null;

    public function getConnection(): ?PDO {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname, 
                $this->username, 
                $this->password
            );
            // Mengatur error mode ke exception untuk keamanan
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Koneksi Database Gagal: " . $exception->getMessage();
        }
        return $this->conn;
    }
}