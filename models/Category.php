<?php

class Category
{
    //DB stuff
    private $conn;
    private $table = 'categories';

    // Properties
    private $id;
    private $title;
    private $createdAt;

    //Constructor With DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Categories
    public function read()
    {
        //query
        $query = 'SELECT * FROM categories;';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;
    }
}
