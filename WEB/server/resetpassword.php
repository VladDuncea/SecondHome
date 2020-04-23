<?php
include "php/connection.php";
include "php/header.php";

$response["registered-email"] = 0;  //Email presumably not used

if(!isset($_POST['user_email']))
{
    $response["status"]=0;
    $response["err_message"]="Missing parameters!";  
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}

$user_email = mysqli_real_escape_string( $conn,$_POST['user_email']);

$sql ="SELECT 'c' FROM Users WHERE user_email='$user_email'";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
    echo json_encode($response);
    return;
}

if($row = mysqli_fetch_assoc($result))
{
    //Email exists
    $response["registered-email"] = 1;

    $code = bin2hex(random_bytes(20)); // 20 chars.
    $sql ="INSERT INTO PassReset (code,user_email) VALUES ('$code','$user_email')"; 
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1;  //Database error
        error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
        echo json_encode($response);
        return;
    }
    //Send link to users Email
    $subject = "Resetare parola";
    $txt = "Buna ziua, va puteti reseta parola online la linkul: \r\n http://secondhome.fragmentedpixel.com/recover-password.php?code=$code  \r\n Codul este valabil in urmatoarele 24h.";
    $headers = 'From: SecondHome <secondhome@fragmentedpixel.com>' . "\r\n" .
    'Reply-To: secondhome@fragmentedpixel.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if(mail($user_email,$subject,$txt,$headers))       //Email
    {
        $response["email-sent"]=1;
    }
    else
        $response["email-sent"]=0;
}
else
{
    entry_log("resetpassword", "Unknown", $response);   //Data logging
    echo json_encode($response);    //Send data to requester
    return;
}

//Not yet implemented
$response["status"]=1;  
entry_log("resetpassword","Unknown",$response);    
echo json_encode($response);    
?>
