<?php
//Headers for POST request
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$category->title = $data->title;
$category->createdAt = date("Y-m-d H:i:s");

if ($category->create()) {
    echo json_encode(array("message" => "Category Created"));
} else {
    echo json_encode(array("message" => "Category not  Created"));
}
