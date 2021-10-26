<?php

class Category
{
    //DB stuff
    private $conn;
    private $table = 'categories';

    // Properties
    public  $id;
    public  $title;
    public  $createdAt;

    //Constructor With DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Categories
    public function read()
    {
        //query
        $query = 'SELECT * FROM ' . $this->table . ';';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        //query
        $query = "SELECT * FROM  " . $this->table . "  WHERE id = :id LIMIT 1 ";

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Bin ID
        $stmt->bindParam(':id', $this->id);

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        extract($row);

        $this->id = $id;
        $this->title = $title;
        $this->createdAt = $createdAt;
    }
}
