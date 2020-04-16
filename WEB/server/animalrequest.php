<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

if(!isset($_POST['security_code']) || $_POST['security_code']!= '8981ASDGHJ22123')
{
    //WEB
    //Verify account level
    session_start();
    if(!isset($_SESSION['userType']))
    {
        $response["status"]=-1;
        $response["err_message"] = "Unauthoried access";
        entry_log("addanimal","Unknown",$response);     
        echo json_encode($response);  
        return;
    }
    $UID = $_SESSION['userId'];
    
}
else if($_POST['security_code']== '8981ASDGHJ22123')
{
    //ANDROID
    $UID = $_POST['UID'];
}
else
{
    $response["status"]=0;
    $response["err_message"] = "Missing parameters!";
    entry_log("addanimal","Unknown",$response);     
    echo json_encode($response);  
    return;
}

//Get parameters
if(!isset($_POST['PID'],$_POST['request_type']))
{
    $response["status"]=0;
    $response["err_message"] = "Missing parameters!";
    entry_log("addanimal","Unknown",$response);     
    echo json_encode($response);  
    return;
}
$PID = mysqli_real_escape_string( $conn,$_POST['PID']);
$req_type = mysqli_real_escape_string( $conn,$_POST['request_type']);


//Add request
if($req_type == 0)
{
    $sql="INSERT INTO Requests (UID, PID, request_type,request_state,request_description) VALUES ('$UID','$PID','0','0','Cerere dare spre adoptie')";
}
else if($req_type == 1)
{
    $sql="INSERT INTO Requests (UID, PID, request_type,request_state,request_description) VALUES ('$UID','$PID','1','0','Cerere dare spre cazare')";
}

if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}

?>