<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("connection.php");

if(isset($_POST["User_id"]) && $_POST["User_id"] != "" && isset($_POST["Image_id"]) && $_POST["Image_id"] != "" && isset($_POST["comment"]) && $_POST["comment"] != ""){
    $User_id = $_POST["User_id"];
    $Image_id = $_POST["Image_id"];
    $commment = $_POST["comment"];


}else{
     $response = [];
     $response["success"] = false;   
     echo json_encode($response);
     return; 
 }

$query = $mysqli->prepare("INSERT INTO comments(User_id, Image_id, comment) VALUES(?, ?, ?)");
$query->bind_param("iis",$User_id, $Image_id, $commment);
$query->execute();

$array = $query->get_result();

$response = [];
$response["success"] = "success";
echo json_encode($response);



