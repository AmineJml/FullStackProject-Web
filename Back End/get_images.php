<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("connection.php");

if(isset($_GET["User_id"]) ){
    $User_id = $_GET["User_id"];
}else{
    $response = [];
    $response["success"] = false;   
    echo json_encode($response);
    return;  
}
// we need to select the comments and the image_URL and at the same time dont show the images where this user is blocked
/*
    1- select all the users who blocked the logged in user and add them to an array
    2- select all images Where user_id is different then the ones in the array
*/

$query = $mysqli->prepare("Select Tweet from tweets WHERE User_id = ?");
$query->bind_param("i", $User_id);
$query->execute();

$array = $query->get_result();
$response = [];
while($tweets = $array->fetch_assoc()){
    $response[] = $tweets;
}

if(!$response ){ //list is empty
    $response["success"] = "no_tweets_by_this_user";   
}

echo json_encode($response);