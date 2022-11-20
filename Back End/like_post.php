<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("connection.php");

if(isset($_POST["User_id"]) && $_POST["User_id"] != "" && isset($_POST["Image_id"]) && $_POST["Image_id"] != "" ){
    $User_id = $_POST["User_id"];
    $Image_id = $_POST["Image_id"];

}else{
     $response = [];
     $response["success"] = false;   
     echo json_encode($response);
     return; 
 }



 $query = $mysqli->prepare("Select Is_liked from likes WHERE User_id = ? && Image_id =? ");
 $query->bind_param("ii", $User_id, $Image_id);
 $query->execute();
 
 $array = $query->get_result();
 
 $response = [];
 
 while($likes = $array->fetch_assoc()){
     $is_liked[] = $likes; //array of the blocks by user1
 }
 
 if($is_liked){ //if list is not empty
    // update like (the user may like or dislike as much as they want)

    $query = $mysqli->prepare("UPDATE likes SET Is_liked= 1 WHERE User_id=? && Image_id=?");
    $query->bind_param("ii", $User_id, $Image_id);
    $query->execute();

    $response["succes"] = "success";
    echo json_encode($response);

 }
 else{ //liking the post for the first time
    $query = $mysqli->prepare("INSERT INTO likes( User_id, Image_id, Is_liked) VALUES ( ?, ?, 1)");
    $query->bind_param("ii", $User_id, $Image_id);
    $query->execute();

    $response["succes"] = "success";
    echo json_encode($response);
 }



