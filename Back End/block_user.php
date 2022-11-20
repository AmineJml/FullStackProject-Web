<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

include("connection.php");

if(isset($_GET["User1_id"]) && $_GET["User1_id"] != "" && isset($_GET["User2_id"]) && $_GET["User2_id"] != "" ){
    $User1_id = $_GET["User1_id"];
    $User2_id = $_GET["User2_id"];


}else{
     $response = [];
     $response["success"] = false;   
     echo json_encode($response);
     return; 
 }

 $query = $mysqli->prepare("Select * from blocks WHERE User1_id = ? && User2_id=?");
 $query->bind_param("ii", $User1_id, $User2_id);
 $query->execute();
 
 $array = $query->get_result();
 
 $response = [];
 $response_success = [];
 
 while($accounts = $array->fetch_assoc()){
     $blocks[] = $accounts; //array of the blocks by user1
 }
 
 if($blocks){ //if list is not empty
    // (previously blocked user - so we dont set duplicated)
    //- set_visibility to 1

     $response["success"] = "user_already_blocked";
     echo json_encode($response);
 }
 
 else{ //Add 
 
     $query = $mysqli->prepare("INSERT INTO blocks( User1_id, User2_id) VALUES ( ?, ?)");
     $query->bind_param("ii", $User1_id, $User2_id);
     $query->execute();
     $response["success"] = true;
     echo json_encode($response);
 }
 


