<?php

class Database
{
    //DB params
    private $host = "localhost";
    private $db_name = "blogDB";
    private $username = "root";
    private $password = "123456789";
    private $conn;

    //DB connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $pde) {
            echo  "Connection Error : " . $pde->getMessage();
        }

        return $this->conn;
    }
}
