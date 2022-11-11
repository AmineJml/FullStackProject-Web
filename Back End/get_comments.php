<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("connection.php");

if(isset($_GET["Img_id"]) ){
    $Img_id = $_GET["Img_id"];
}else{
    $response = [];
    $response["success"] = false;   
    echo json_encode($response);
    return;  
}


$query = $mysqli->prepare("SELECT Comment FROM comments WHERE Img_id = ?");
$query->bind_param("i", $Img_id);
$query->execute();

$array = $query->get_result();
$response = [];
while($comments = $array->fetch_assoc()){
    $response[] = $comments;
}

if(!$response ){ //list is empty
    $response["success"] = "no_comments_for_this_post";   
}

echo json_encode($response);