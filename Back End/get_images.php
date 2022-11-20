<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("connection.php");

// if(isset($_GET["User_id"]) ){
//     $User_id = $_GET["User_id"];
// }else{
//     $response = [];
//     $response["success"] = false;   
//     echo json_encode($response);
//     return;  
// }
// we need to select the  image_URL and at the same time dont show the images where this user is blocked
/*
    1- select all the users who blocked the logged in user and add them to an array
    2- select all images Where user_id is different then the ones in the array
*/

//select all users normally without blocks

$query = $mysqli->prepare("Select Image_URL from images ");
$query->execute();
$array = $query->get_result();
$response = [];
while($images = $array->fetch_assoc()){
    $response[] = $images;
}
echo json_encode($response);


/* 
$query = $mysqli->prepare("Select User1_id from blocks WHERE User2_id = ?");
$query->bind_param("i", $User_id);
$query->execute();

$array = $query->get_result();
$response = [];

while($accounts = $array->fetch_assoc()){
    $blocks[] = $accounts; //array of the blocks by user1
}

$sports = array(1, "Cricket", "Football", "Shooting");

if($blocks){ //if list is not empty
    echo json_encode($blocks);

}


else{
    $query = $mysqli->prepare("Select image_URL from images ");
    $query->execute();
    //select all users normally
    $array = $query->get_result();
    echo json_encode($array);
}

*/

