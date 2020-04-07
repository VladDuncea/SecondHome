<?php
include "php/connection.php";
include "php/header.php";

// $response["password-reset"] = false;      //Password is not yet reset
// $response["correct-code"] = false;      //Presume code does not exist

// $user_new_password = $_POST['user-new-password'];   //Reading data from request
// $reset_code = $_POST['reset-code'];

// $sql ="SELECT  * FROM passreset WHERE reset_code='$reset_code'";
// if(!$result = mysqli_query($conn,$sql))
// {
//     $response["status"]=-1;  // Database error
//     error_log("Connection failed".mysqli_error($conn));  //Error logging
//     return;
// }
// if($row = mysqli_fetch_assoc($result))
// {
//     $response["correct-code"] = true; //Code exists
//     $user_email = $row["usr_email"];
// }
// else //Code does not exist
// {
//     entry_log("-",$response);     //Data logging
//     echo json_encode($response);    //Send data to requester
//     return;
// }

// $sql ="UPDATE hrtusers SET usr_password='$user_new_password' WHERE usr_email='$user_email'";      //Send new password to database
// if(!$result = mysqli_query($conn,$sql))
// {
//     $response["status"]=-1;  // Database error
//     error_log("Connection failed".mysqli_error($conn));  //Error logging
//     return;
// }
// $response["password-reset"] = true; //Password is reset

// $sql ="DELETE FROM passreset WHERE reset_code='$reset_code'";      //Delete used code
// if(!$result = mysqli_query($conn,$sql))     //Silent error
// {
//     error_log("Connection failed".mysqli_error($conn));  //Error logging
// }

//Not yet implemented
$response["status"]=-1;  
entry_log("-",$response);     //Data logging
echo json_encode($response);    //Send data to requester
?>
