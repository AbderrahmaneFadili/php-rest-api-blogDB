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

    //get single post
    public function read_single()
    {
        //Create single
        $query = "SELECT p.id,c.title AS category_title,c.id AS category_id,p.title,p.body,
                  p.author,p.createdAt FROM  " . $this->table . "  p INNER JOIN categories c  
                  ON p.category_Id = c.id  WHERE p.id = :id ORDER BY p.id DESC  LIMIT 1";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(":id", $this->id);

        // Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        extract($row);

        //Set properties

        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->category_id = $category_id;
        $this->category_title = $category_title;
        $this->createdAt = $createdAt;
    }

    //create a single post
    public function create()
    {
        //Create Query
        $query =
            "INSERT INTO  " . $this->table . "(title,body,author,category_id ,createdAt)  VALUES  (:title,:body,:author,:category_id,:createdAt)
          ";

        $stmt = $this->conn->prepare($query);

        //Clean Data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->createdAt = htmlspecialchars(strip_tags($this->createdAt));

        //Bind Data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':createdAt', $this->createdAt);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Update post
    public function update()
    {
        //Create Query
        $query = 'UPDATE ' . $this->table . ' SET  title = :title , body = :body ,   author = :author , category_id = :category_id , createdAt = :createdAt WHERE 
        id = :id
        ';

        $stmt = $this->conn->prepare($query);

        //Clean Data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->createdAt = htmlspecialchars(strip_tags($this->createdAt));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind Data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':createdAt', $this->createdAt);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //delete post
    public function delete()
    {
        //Create Query
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //Clear data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind Data
        $stmt->bindParam(":id", $this->id);

        //Execute Query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
