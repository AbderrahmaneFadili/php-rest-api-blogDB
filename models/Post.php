<?php
class Post
{
    //DB stuff
    private $conn;
    private $table = 'posts';

    //Post properties
    public  $id;
    public $category_id;
    public $category_title;
    public $title;
    public $body;
    public $author;
    public $createdAt;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //get posts
    public function read()
    {
        //Create Query
        $query = 'SELECT p.id,c.title 
                  AS category_title,c.id AS category_id,p.title,p.body,p.author,p.createdAt
                  FROM ' . $this->table . ' p INNER JOIN categories c 
                  ON p.category_Id = c.id ORDER BY p.id DESC';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Execut Query
        $stmt->execute();

        return $stmt;
    }
}
