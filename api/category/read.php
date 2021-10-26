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

// Category query
$result = $category->read();

//Row Count
$num = $result->rowCount();

//check if any category
if ($num > 0) {
    //Categories array
    $categories_array = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            "id" => $id,
            "title" => $title,
            "createdAt" => $createdAt,
        );

        array_push($categories_array, $category_item);
    }

    //Turn into JSON 
    echo json_encode($categories_array);
} else {
    echo json_encode(array("message" => "No Categories Found !"));
}
