<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;
$response["updated"] = 0;

if(!isset($_POST['PID'],$_POST['pet_name'], $_POST['pet_description'], $_POST['pet_breed'], $_POST['pet_age']))
{
    //Not all parameters received
    $response["status"]=0;
    $response["err_message"]="Missing parameters!";
    entry_log("updateanimal","Unknown",$response);     
    echo json_encode($response);    
    return;
}

#get user data
getUserData($UID,$UType,"updateanimal",$conn);
if($UID == -2)
{
    return;
}

# Check if pet belongs to user
$PID = mysqli_real_escape_string( $conn, $_POST['PID']);
$sql="SELECT COUNT(PID) nr FROM Users_Pets WHERE PID = $PID AND UID = $UID AND relation_type = 0";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}
if(mysqli_fetch_assoc($result)['nr'] != 1)
{
    $response["status"]=0;
    $response["err_message"] = "Unauthorzed access!2";
    echo json_encode($response);  
    entry_log($page,"Unknown",$response);     
    return;
}


#get image
$pet_image = null;
if(isset($_POST["imgbase64"]))
{
    $pet_image = $_POST["imgbase64"];
    $_POST["imgbase64"] = "Imagine...";
}
 
//Reading data from request and sanitizing
$pet_name = mysqli_real_escape_string( $conn, $_POST['pet_name'] );
$pet_description = mysqli_real_escape_string( $conn, $_POST['pet_description']);    
$pet_breed  = mysqli_real_escape_string( $conn, $_POST['pet_breed']);
$pet_age  = mysqli_real_escape_string( $conn, $_POST['pet_age']);
if(!is_numeric($pet_age))
    $pet_age = 1;
//Convert pet_age to pet birthday
$pet_birthdate = (date('Y')-$pet_age).date("-m-d");

//Add the pet
if($pet_image!=null)
    $sql="UPDATE Pets 
        SET pet_name = '$pet_name', pet_description ='$pet_description',
            pet_breed = '$pet_breed', pet_birthdate = '$pet_birthdate', pet_image ='$pet_image'
        WHERE PID = $PID";
else
    $sql="UPDATE Pets 
        SET pet_name = '$pet_name', pet_description ='$pet_description',
            pet_breed = '$pet_breed', pet_birthdate = '$pet_birthdate'
        WHERE PID = $PID";

if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}

//No error
$response["status"] = 1;
$response["updated"] = 1; 
echo json_encode($response);

entry_log("updateanimal",$UID, $response);   //Data logging
?>