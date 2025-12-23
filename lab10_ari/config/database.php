<?php
class Database {
    protected $host = "localhost";
    protected $user = "root";
    protected $pass = "";
    protected $db   = "latihan1";
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );

        if ($this->conn->connect_error) {
            die("Koneksi database gagal");
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function escape($value) {
        return $this->conn->real_escape_string($value);
    }
}
