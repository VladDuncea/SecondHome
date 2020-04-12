<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

if(!isset($_POST['user-firstname'])||!isset($_POST['user-lastname'])||!isset($_POST['user-email'])||!isset($_POST['user-password']))
{
    //Not all parameters received
    $response["status"]=0;
    entry_log("register","Unknown",$response);     
    echo json_encode($response);    
    return;
}

//Reading data from request and sanitizing
$user_email = mysqli_real_escape_string( $conn, $_POST['user-email'] );
$user_password = password_hash($_POST['user-password'], PASSWORD_DEFAULT);
$user_firstname = mysqli_real_escape_string( $conn, $_POST['user-firstname']);    
$user_lastname  = mysqli_real_escape_string( $conn, $_POST['user-lastname']);


$val = check_email($user_email,$conn);
if($val == -1 || $val == 1)
{
    //error or email in use
    $response['status'] = $val;
    entry_log("register","Unknown",$response);     
    echo json_encode($response);    
    return;
}

$response["account-created"] = 0; //Account is not yet created

$sql="INSERT INTO Users (first_name, last_name, user_password, user_email) VALUES ('$user_firstname','$user_lastname','$user_password','$user_email')";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}
else
{
    //Send welcome email to new User
    $subject = "Bine ati venit la SecondHome";
    $txt = "Buna ziua, \n va multumim ca ati ales sa fiti client SecondHome!";
    $headers = 'From: SecondHome <secondhome@fragmentedpixel.com>' . "\r\n" .
    'Reply-To: secondhome@fragmentedpixel.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if(mail($user_email,$subject,$txt,$headers))       //Email
    {
        $response["email-sent"]=1;
    }
    else
        $response["email-sent"]=0;

    $response["account-created"] = 1; //Account is created
}

//No error
$response["status"] = 1; 
echo json_encode($response);
entry_log("register",$user_email,$response);   //Data logging
?>
