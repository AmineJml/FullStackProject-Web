<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

include("connection.php");
//Username can be changed
//FName, LName, password
if(isset($_POST["User_id"]) && $_POST["User_id"] != "" && isset($_POST["Username"]) && $_POST["Username"] != "" && isset($_POST["FName"]) && $_POST["FName"] != "" && isset($_POST["LName"]) && $_POST["LName"] != "" && isset($_POST["Password"]) && $_POST["Password"] != ""  ){
    $User_id = $_POST["User_id"];
    $Username = $_POST["Username"];
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $Password = $_POST["Password"];
}
else{
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
    $response["success"] = "user_already_exit";
    echo json_encode($response);
}

else{
    $query = $mysqli->prepare("UPDATE users SET Username=?, FName=? , LName=?, Password=? WHERE User_id=?");
    $query->bind_param("ssssi", $Username, $FName, $LName, $Password, $User_id);
    $query->execute();
    $response = [];
    $response["success"] = true;
    echo json_encode($response);
}




