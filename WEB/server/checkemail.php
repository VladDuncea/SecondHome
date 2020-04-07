<?php
include "php/connection.php";
include "php/header.php";
$response["status"] = -1;

//check if all parameters are received
if(!isset($_POST['user-email']))
{
    $response["status"]=0;
    entry_log("Unknown",$response);     //Data logging
    echo json_encode($response);    //Send data to requester
    return;
}

$escaped_email = mysqli_real_escape_string( $conn, $_POST['user-email'] );
$val = check_email($escaped_email,$conn);


if($val == -1)
{
    //error
    $response['status'] = -1;
}
else
{
    //send data to requester
    $response['status'] = 1;
    $response['email-used'] = $val;
}

entry_log("Unknown",$response);     //Data logging
echo json_encode($response);    //Send data to requester
?>
