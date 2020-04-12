<?php
include "php/connection.php";
include "php/header.php";
$response["status"] = -1;


//check if parameters are received
if(!isset($_POST['user-email'])||!isset($_POST['user-password']))
{
    $response["status"]=0;
    entry_log("login","Unknown",$response);     //Data logging
    echo json_encode($response);    //Send data to requester
    return;
}

//Reading data from request and sanitizing
$user_email = mysqli_real_escape_string( $conn, $_POST['user-email'] );
$user_password = $_POST['user-password'];

$sql ="SELECT * FROM Users WHERE user_email='$user_email'";
if(!$result = mysqli_query($conn,$sql))
{
    //Database error
    $response["status"] = -1;                         
    error_log("Connection failed".mysqli_error($conn));
    echo json_encode($response);
    return;
}

//Account data is wrong if id does not exist
$response["correct-credentials"] = 0; 
if($row = mysqli_fetch_assoc($result))
{
    if(password_verify($user_password,$row["user_password"]))
    {
        //Account data is correct
        $response["correct-credentials"] = 1;  
        //Returning user data
        $response["UID"] = $row["UID"];                
        $response["user-firstname"] = $row["first_name"];  
        $response["user-lastname"] = $row["last_name"];
        $response["user-type"] = $row["user_type"];
    }
}

$response["status"] = 1;  //No error code
echo json_encode($response);    //Sending data to requester
entry_log("login",$user_email,$response);   //Data logging
?>
