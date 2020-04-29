<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

//GENERAL UID/UType getter
if(!isset($_POST['security_code']))
{
    //WEB
    //Verify account level
    session_start();
    if(!isset($_SESSION['userType']))
    {
        $response["status"]=-1;
        $response["err_message"] = "Unauthoried access!1";
        echo json_encode($response);  
        $response['image'] = "Imagine";
        entry_log("getanimalextended","Unknown",$response);     
        return;
    }
    $UID = $_SESSION['userId'];
    $UType = $_SESSION['userType'];
    
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
    $response["status"]=-1;
    $response["err_message"] = "Unauthoried access!1";
    echo json_encode($response);  
    entry_log("getuser","Unknown",$response);     
    return;
}

if(isset($_POST['WantedUID']))
{
    //Get parameters
    $WantedUID = mysqli_real_escape_string( $conn,$_POST['WantedUID']);
}
else
{
    $WantedUID = $UID;
}


//No clearance
if($UType <=0 && $UID != $WantedUID)
{
    $response["status"]=-1;
    $response["err_message"] = "Unauthoried access!1";
    echo json_encode($response);  
    entry_log("getuser","Unknown",$response);     
    return;
}


//Get user data
$sql="SELECT * FROM Users WHERE UID = $WantedUID";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}
if($row = mysqli_fetch_assoc($result))
{
    $response['first_name'] = $row['first_name'];
    $response['last_name'] = $row['last_name'];
    $response['user_email'] = $row['user_email'];
    $response['user_type'] = $row['user_type'];
    
}
else
{
    //User doesn't exist
    $response["status"]=0;
    $response["err_message"] = "Wrong UID";
    entry_log("getuser","Unknown",$response);     
    echo json_encode($response);  
    return;
}

//Get nr of pets for owner
$sql="SELECT COUNT(UID) nr FROM Users_Pets WHERE UID = $UID AND relation_type = 0";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}
$response['nr_owned_pets'] = mysqli_fetch_assoc($result)["nr"];


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
entry_log("getuser",$user, $response);   //Data logging
?>
