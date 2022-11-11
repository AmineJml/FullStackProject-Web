<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("connection.php");

if(isset($_GET["Image_id"]) ){
    $Image_id = $_GET["Image_id"];
}else{
    $response = [];
    $response["success"] = false;   
    echo json_encode($response);
    return;  
}


$query = $mysqli->prepare("SELECT Like_count FROM images WHERE Image_id = ?");
$query->bind_param("i", $Img_id);
$query->execute();

$array = $query->get_result();
$response = [];
$response[] = $array->fetch_asoc();
echo json_encode($response);