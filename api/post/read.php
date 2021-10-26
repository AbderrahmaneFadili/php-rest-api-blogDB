<?php

//Headers
header('Access-Control-Allow-origin:*');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Blog posts query
$result =  $post->read();

//Row Count
$num = $result->rowCount();

//Check if any posts
if ($num > 0) {

    //Posts array
    $posts_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(

            "id" => $id,
            "title" => $title,
            "body" => html_entity_decode($body),
            "author" => $author,
            "category_id" => $category_id,
            "category_title" => $category_title,
            "createdAt" => $createdAt
        );
        //push to posts_arr
        array_push($posts_arr, $post_item);
    }

    //push to posts_arr
    echo json_encode($posts_arr);
} else {
    //No Posts
    echo json_encode(array('message' => 'No Posts Found !'));
}
