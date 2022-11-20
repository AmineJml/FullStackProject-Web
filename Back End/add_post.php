<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");



include("connection.php");

if(isset($_POST["User_id"]) && $_POST["User_id"] != "" && isset($_POST["Image_URL"]) && $_POST["Image_URL"] != "" ){
    $User_id = $_POST["User_id"];
    $Image_URL = $_POST["Image_URL"];

}else{
     $response = [];
     $response["success"] = false;   
     echo json_encode($response);
     return; 
 }

$query = $mysqli->prepare("INSERT INTO Images(Image_URL, User_id) VALUES(?, ?)");
$query->bind_param("si",$Image_URL, $User_id);
$query->execute();

$response = [];
$response["success"] = "success";
echo json_encode($response);



