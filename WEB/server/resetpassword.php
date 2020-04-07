<?php
include "php/connection.php";
include "php/header.php";

// $response["registered-email"] = false;  //Email presumably not used
// $response["code-generated"]=false;

// $user_email = $_POST['user-email']; //Reading data from request

// $sql ="SELECT  * FROM hrtusers WHERE usr_email='$user_email'";
// if(!$result = mysqli_query($conn,$sql))
// {
//     $response["status"]=-1;  // Database error
//     error_log("Connection failed".mysqli_error($conn));  //Error logging
//     return;
// }
// if($row = mysqli_fetch_assoc($result))
// {
//     $response["registered-email"] = true; //Email is in use
// }
// else
// {
//     entry_log("-",$response);     //Data logging
//     echo json_encode($response);    //Send data to requester
//     return;
// }
// $code = bin2hex(random_bytes(5)); // 20 chars.
// $sql ="INSERT INTO passreset (usr_email,reset_code) VALUES ('$user_email','$code') ";      //Create link
// if(!$result = mysqli_query($conn,$sql))
// {
//     $response["status"]=-1;  // Database error
//     error_log("Connection failed".mysqli_error($conn));  //Error logging
//     return;
// }
// //Send link to users Email
// $subject = "Resetare parola";
// $txt = "Buna ziua, va puteti reseta parola online la linkul: http://hearthratethingy.fragmentedpixel.com/resetpassword.php?code=$code \n sau din aplicatie folosind codul: $code  \n Codul este valabil in urmatoarele 24h.";
// $headers = "From: heartratethingy@fragmentedpixel.com";

// if(mail($user_email,$subject,$txt,$headers))       //Email
// {
//     $response["code-generated"]=true;
// }

//Not yet implemented
$response["status"]=-1;  
entry_log("-",$response);    
echo json_encode($response);    
?>
