<?php
include "php/connection.php";
include "php/header.php";

$response["password_reset"] = 0;      //Password is not yet reset
$response["correct_code"] = 0;      //Presume code does not exist

//Check request data
if(!isset($_POST['user_password'],$_POST['code']))
{
    $response["status"]=0;
    $response["err_message"]="Missing parameters!";  
    entry_log("newpassword","Unknown",$response);   //Error logging
    echo json_encode($response);
    return;
}

$user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);   //Reading data from request
$reset_code = mysqli_real_escape_string( $conn,$_POST['code']);

$sql ="SELECT * FROM PassReset WHERE code='$reset_code'";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
    echo json_encode($response);
    return;
}
if($row = mysqli_fetch_assoc($result))
{
    $response["correct_code"] = 1; //Code exists
    $user_email = $row["user_email"];
}
else //Code does not exist
{
    entry_log("newpassword","Unknown",$response);     //Data logging
    echo json_encode($response);    //Send data to requester
    return;
}

$sql ="UPDATE Users SET user_password='$user_password' WHERE user_email='$user_email'";      //Send new password to database
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
    echo json_encode($response);
    return;
}
$response["password_reset"] = 1; //Password is reset

$sql ="DELETE FROM PassReset WHERE code='$reset_code'";      //Delete used code
if(!$result = mysqli_query($conn,$sql))
{
    error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
}

$response["status"]=1;
entry_log("newpassword",$user_email,$response);     //Data logging
echo json_encode($response);    //Send data to requester
?>
