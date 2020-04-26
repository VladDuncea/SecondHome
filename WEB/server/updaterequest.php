<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;
$response["request_updated"] = 0;

//GENERAL UID/UType getter
if(!isset($_POST['security_code']))
{
    //WEB
    //Verify account level
    session_start();
    if(!isset($_SESSION['userType']))
    {
        $response["status"]=-1;
        $response["err_message"] = "Unauthoried access";
        entry_log("updaterequest","Unknown",$response);     
        echo json_encode($response);  
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
    $response["status"]=0;
    $response["err_message"] = "Missing parameters!";
    entry_log("updaterequest","Unknown",$response);     
    echo json_encode($response);  
    return;
}

//Verify minimum acces level
if($UType<1)
{
    $response["status"]=-1;
    $response["err_message"] = "Unauthoried access";
    entry_log("updaterequest","Unknown",$response);     
    echo json_encode($response);  
    return;
}

//GET REQUEST TYPE
if(!isset($_POST['RID'],$_POST['value']))
{
    $response["status"]=0;
    $response["err_message"]="Missing parameters!";  
    error_log("Connection failed".mysqli_error($conn));   //Error logging
    echo json_encode($response);
    return;
}

$RID = mysqli_real_escape_string( $conn,$_POST['RID']);
$value = mysqli_real_escape_string( $conn,$_POST['value']);

//Check if request is still waiting 
$sql ="SELECT PID,request_state,request_type FROM Requests WHERE RID = $RID";

if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
    echo json_encode($response);
    return;
}

if($data = mysqli_fetch_assoc($result))
{
    if($data['request_state']!=0)
    {
        //Request is already changed
        $response["status"]=1;
        echo json_encode($response);
        return;
    }
    //Update request
    $sql ="UPDATE Requests SET request_state = '$value' WHERE RID = $RID";
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1;  //Database error
        error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
        echo json_encode($response);
        return;
    }
    $response["request_updated"] = 1;

    //Other actions

    //Request for adoption
    if($data['request_type']==0 && $value == 1)
    {
        $sql ="UPDATE Pets SET pet_state='10' WHERE PID = {$data['PID']}";
        if(!$result = mysqli_query($conn,$sql))
        {
            $response["status"]=-1;  //Database error
            error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
            echo json_encode($response);
            return;
        }
    }
    
}

//No error
$response["status"] = 1; 
echo json_encode($response);
entry_log("updaterequest",$UID, $response);   //Data logging
?>