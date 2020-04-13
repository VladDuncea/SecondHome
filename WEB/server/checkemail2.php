<?php
include "php/connection.php";
include "php/header.php";
$response = "Acest email este deja asociat unui cont!";

//check if all parameters are received
if(!isset($_POST['user_email']))
{
    echo json_encode("nu vad variabila");    //Send data to requester
    return;
}

$escaped_email = mysqli_real_escape_string( $conn, $_POST['user_email'] );
$val = check_email($escaped_email,$conn);

if($val == 0)
{
    $response=true;
}

echo json_encode($response);    //Send data to requester
?>
