<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

//GET REQUEST TYPE
if(!isset($_POST['PID']))
{
    $response["status"]=0;
    $response["err_message"]="Missing parameters!";
    entry_log("getanimalextended","Unknown",$response);   
    echo json_encode($response);
    return;
}

//Get parameters
$PID = mysqli_real_escape_string( $conn,$_POST['PID']);

//Get pet data
$sql="SELECT * FROM Pets WHERE PID = $PID";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}
if($row = mysqli_fetch_assoc($result))
{
    $pet['PID'] = $row['PID'];
    $pet['LID'] = $row['LID'];
    $pet['name'] = $row['pet_name'];
    $pet['birthdate'] = date_diff(date_create("now") , date_create($row['pet_birthdate']))->y;
    $pet['description'] = $row['pet_description'];
    $pet['image'] = $row['pet_image'];
    $pet['state'] = $row['pet_state'];
    $pet['food'] = $row['pet_food'];
    $pet['type'] = $row['pet_type'];
    $pet['breed'] = $row['pet_breed'];
}
else
{
    //Pet doesn't exist in database
    $response["status"]=0;
    $response["err_message"] = "Wrong PID";
    entry_log("getanimalextended","Unknown",$response);     
    echo json_encode($response);  
    return;
}

//Get pet owner
$sql="SELECT * FROM Users_Pets WHERE PID = $PID AND relation_type = 0";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}
$owner = mysqli_fetch_assoc($result)["UID"];

//GENERAL UID/UType getter
if(!isset($_POST['security_code']))
{
    //WEB
    //Verify account level
    session_start();
    if(isset($_SESSION['userType']))
    {
        $UID = $_SESSION['userId'];
        $UType = $_SESSION['userType'];
    }
    else
    {
        $UID = -1;
        $UType = -1;
    }
}
else if($_POST['security_code'] == '8981ASDGHJ22123' && isset($_POST['UID']))
{
    //ANDROID
    $UID = mysqli_real_escape_string( $conn,$_POST['UID']);
    $sql = "SELECT user_type FROM Users WHERE UID = $UID";
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1;  //Database error
        error_log("SQL ERROR: ".mysqli_error($conn));   //Error logging
        echo json_encode($response);
        return;
    }
    $UType = mysqli_fetch_assoc($result)['user_type'];
}
else
{
    $response["status"]=0;
    $response["err_message"] = "Unauthorzed access!1";
    echo json_encode($response);  
    entry_log("getanimalextended","Unknown",$response);     
    return;
}

//Pet is public and user is guest
if($pet['state']==10 && ($UID == -1 || ($UType == 0 && $owner != $UID) ))
{
    //No error
    $response["status"] = 1;
    $response+=$pet; 
    echo json_encode($response);
    $response['image'] = "Imagine";
    entry_log("getanimalextended",$user, $response);   //Data logging
    return;
}

//Get requests
if($owner == $UID)
{
    $sql = "SELECT * FROM Requests WHERE PID = $PID AND UID = $UID";
}
else if($UType >=1)
{
    $sql = "SELECT * FROM Requests WHERE PID = $PID";
}
else
{
    $response["status"]=0;
    $response["err_message"] = "Unauthorzed access!2";
    echo json_encode($response);  
    $response['image'] = "Imagine";
    entry_log("getanimalextended","Unknown",$response);     
    return;
}

$response+=$pet; 

if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}
$response['nr_requests'] = $result->num_rows;
$poz = 0;
while($row = mysqli_fetch_assoc($result))
{
    $response['requests'][$poz]['UID'] = $row['UID'];
    $response['requests'][$poz]['type'] = $row['request_type'];
    $response['requests'][$poz]['state'] = $row['request_state'];
    $response['requests'][$poz]['description'] = $row['request_description'];
    $poz++;
}

//Data for entry_log
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['FirstName']))
    $user = $_SESSION['FirstName']." ".$_SESSION['LastName'];
else 
    $user = 'Guest';

//No error
$response["status"] = 1; 
echo json_encode($response);
$response['image'] = "Imagine";
entry_log("getanimalextended",$user, $response);   //Data logging
?>
