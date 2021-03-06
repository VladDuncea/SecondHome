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
        entry_log("animalrequest","Unknown",$response);     
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
    entry_log("animalrequest","Unknown",$response);     
    echo json_encode($response);  
    return;
}

//Get parameters
if(!isset($_POST['PID'],$_POST['request_type']))
{
    $response["status"]=0;
    $response["err_message"] = "Missing parameters!";
    entry_log("animalrequest","Unknown",$response);     
    echo json_encode($response);  
    return;
}
$PID = mysqli_real_escape_string( $conn,$_POST['PID']);
$req_type = mysqli_real_escape_string( $conn,$_POST['request_type']);


if($req_type == 2)
{
    //Ask for adoption

    //Verify that pet is avaialble for adoption
    $sql = "SELECT  pet_state FROM Pets WHERE PID=$PID";
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1;  //Database error
        $response["err_message"] = "SQL error";
        error_log("Connection failed".mysqli_error($conn));   //Error logging
        echo json_encode($response);
        return;
    }
    if(mysqli_fetch_assoc($result)["pet_state"] != 10)
    {
        //Not available for adoption
        $response["status"]=0;
        $response["err_message"] = "Unauthorized access!";
        echo json_encode($response);
        return;
    }

    //Verify that user did not already request
    $sql = "SELECT COUNT(*) nr FROM Requests WHERE PID=$PID AND UID=$UID AND request_type = 2";
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1;  //Database error
        $response["err_message"] = "SQL error";
        error_log("Connection failed".mysqli_error($conn));   //Error logging
        echo json_encode($response);
        return;
    }
    if(mysqli_fetch_assoc($result)["nr"] != 0)
    {
        //Not available for adoption
        $response["status"]=0;
        $response["err_message"] = "Already requested!";
        entry_log("animalrequest",$UID, $response);   //Data logging
        echo json_encode($response);
        return;
    }

}
else
{
    //Give to hotel/give to adoption

    //Verify that user has that pet
    $sql = "SELECT COUNT(PID) nr FROM Users_Pets WHERE PID=$PID AND UID=$UID";
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1;  //Database error
        $response["err_message"] = "SQL error";
        error_log("Connection failed".mysqli_error($conn));   //Error logging
        echo json_encode($response);
        return;
    }
    if(mysqli_fetch_assoc($result)["nr"] == 0)
    {
        //Not his pet
        $response["status"]=0;
        $response["err_message"] = "Unauthorized access!";
        echo json_encode($response);
        return;
    }
    //Verify that pet has no current request
    $sql = "SELECT COUNT(PID) nr FROM Requests WHERE PID=$PID AND UID=$UID";
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1; 
        $response["err_message"] = "SQL error";
        error_log("Connection failed".mysqli_error($conn));   //Error logging
        echo json_encode($response);
        return;
    }
    if(mysqli_fetch_assoc($result)["nr"] > 0)
    {
        //Pet already has request
        $response["status"]=0;
        $response["err_message"] = "Wrong action!";
        echo json_encode($response);
        return;
    }
}

//Add request
if($req_type == 0)
{
    $sql="INSERT INTO Requests (UID, PID, request_type,request_state,request_description) VALUES ('$UID','$PID','0','0','Cerere dare spre adoptie')";
}
else if($req_type == 1)
{
    $sql="INSERT INTO Requests (UID, PID, request_type,request_state,request_description) VALUES ('$UID','$PID','1','0','Cerere dare spre cazare')";
}
else if($req_type == 2)
{
    $sql="INSERT INTO Requests (UID, PID, request_type,request_state,request_description) VALUES ('$UID','$PID','2','0','Cerere adoptie animal')";
}

if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    $response["err_message"] = "SQL error";
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}

//No error
$response["status"] = 1; 
echo json_encode($response);
entry_log("animalrequest",$UID, $response);   //Data logging
?>