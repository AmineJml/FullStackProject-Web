<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("connection.php");

if(isset($_GET["User1_id"]) && $_GET["User1_id"] != "" ){
    $User1_id = $_GET["User1_id"];


}else{
     $response = [];
     $response["success"] = false;   
     echo json_encode($response);
     return; 
 }

 $query = $mysqli->prepare("Select User2_id from blocks WHERE User1_id = ? ");
 $query->bind_param("i", $User1_id);
 $query->execute();
 
 $array = $query->get_result();
 $response = [];
 
 while($accounts = $array->fetch_assoc()){
     $blocks[] = $accounts; //array of the blocks by user1
 }
 
 if($blocks){ //if list is not empty
    // (previously blocked user - so we dont set duplicated)
    //- set_visibility to 1
    $response[] = $blocks;
    echo json_encode($response);

 }
 
 else{
 $response["success"] = "no_blocks_by_this_user";
 echo json_encode($response);
 }

