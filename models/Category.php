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

    public function create()
    {
        //Query
        $query = "INSERT INTO " . $this->table . " (title,createdAt) VALUES (:title,:createdAt)";

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Clean Data
        $this->title = htmlspecialchars(strip_tags($this->title));

        //Bind Data
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":createdAt", $this->createdAt);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update()
    {
        //Query
        $query = "UPDATE " . $this->table . " SET title = :title , createdAt = :createdAt WHERE id = :id";

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Clean Data
        $this->id =  htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->createdAt = htmlspecialchars(strip_tags($this->createdAt));

        //Bind Data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":createdAt", $this->createdAt);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        //Query
        $query = " DELETE FROM " . $this->table . " WHERE id = :id; ";

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Clean Data
        $this->id =  htmlspecialchars(strip_tags($this->id));

        //Bind Data
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
