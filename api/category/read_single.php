<?php
//Headers
header('Access-Control-Allow-origin:*');
header('Content-Type: application/json');

include_once "../../config/Database.php";
include_once '../../models/Category.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

//get id
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

//get category query
$category->read_single();

//Create Array
$category_array = array(
    "id" => $category->id,
    "title" => $category->title,
    "createdAt" => $category->createdAt,
);

//Make JSON
echo json_encode($category_array);
