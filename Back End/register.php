<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("connection.php");

if(isset($_POST["FName"]) && $_POST["FName"] != "" && isset($_POST["LName"]) && $_POST["LName"] != "" && isset($_POST["Username"]) && $_POST["Username"] != ""&& isset($_POST["Password"]) && $_POST["Password"] != "" ){
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
}else{
     $response = [];
     $response["success"] = false;   
     echo json_encode($response);
     return; 
 }

$query = $mysqli->prepare("Select * from users WHERE Username = ?");
$query->bind_param("s", $Username);
$query->execute();

$array = $query->get_result();

$response = [];
$response_success = [];

while($accounts = $array->fetch_assoc()){
    $users[] = $accounts;
}

if($users){ //if list is not empty
    $response["success"] = "user already exit";
    echo json_encode($users);
}

else{

    $query = $mysqli->prepare("INSERT INTO users( FName, LName, Username, Password) VALUES ( ?, ?, ?, ?)");
    $query->bind_param("ssss", $FName, $LName, $Username, $Password);
    $query->execute();
    $response["success"] = true;
    echo json_encode($response);
}
