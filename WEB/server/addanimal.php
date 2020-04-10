<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

if(!isset($_POST['pet_name'], $_POST['pet_description'], $_POST['pet_type'], $_POST['pet_breed'], $_POST['pet_age']))
{
    //Not all parameters received
    $response["status"]=0;
    entry_log("Unknown",$response);     
    echo json_encode($response);    
    return;
}
//the user id is not provided, try to extract it from SESSION
if(!isset($_POST['UID']))
{
    $UID = $_SESSION['userId'];
}
else
{
    $UID = $_POST['UID'];
}

//ALL THE QUERIES SHOUL BE DONE TOGHETER!!!

//Reading data from request and sanitizing
$pet_name = mysqli_real_escape_string( $conn, $_POST['pet_name'] );
$pet_description = mysqli_real_escape_string( $conn, $_POST['pet_description']);    
$pet_type  = mysqli_real_escape_string( $conn, $_POST['pet_type']);
$pet_breed  = mysqli_real_escape_string( $conn, $_POST['pet_breed']);
$pet_age  = mysqli_real_escape_string( $conn, $_POST['pet_age']);
//Convert pet_age to pet birthday
$pet_birthdate = (date('Y')-$pet_age).date("-m-d");

//Add the pet
$sql="INSERT INTO Pets (pet_name, pet_description, pet_type, pet_breed, pet_birthdate) 
    VALUES ('$pet_name','$pet_description','$pet_type','$pet_breed', '$pet_birthdate');";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}

//Take PID and link user to pet
$sql = "SELECT LAST_INSERT_ID() AS ID;";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}
$PID = mysqli_fetch_assoc($result)["ID"];
$sql="INSERT INTO Users_Pets (UID, PID) VALUES ('$UID','$PID')";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}

//Add request
$sql="INSERT INTO Requests (UID, PID, request_type,request_state,request_description) VALUES ('$UID','$PID','0','0','Cerere dare spre adoptie')";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}

//No error
$response["status"] = 1; 
echo json_encode($response);
entry_log($UID, $response);   //Data logging
?>
