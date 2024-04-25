<?php

namespace MyProject\Config;

use PDO;
use PDOException;
use Exception;

class Database {
    private $host = "localhost:3306";
    private $db_name = "taskmanagementdb";
    private $username = "root";
    private $password = "12102002";
    public $conn;

    public function getConnection() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
            return $this->conn;
        } catch(PDOException $exception) {
            // Ném ra một ngoại lệ để bắt lỗi ở nơi sử dụng class này
            throw new Exception("Kết nối CSDL thất bại: " . $exception->getMessage());
        }
    }
}
