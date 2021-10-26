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

// get id
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get post query
$post->read_single();



//Create Array
$post_arr = array(
    "id" => $post->id,
    "title" => $post->title,
    "body" => $post->body,
    "author" => $post->author,
    "category_id" => $post->category_id,
    "category_title" => $post->category_title,
    "createdAt" => $post->createdAt
);
//Make JSON

echo json_encode($post_arr);
