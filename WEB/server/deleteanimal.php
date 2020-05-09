<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;
$response["deleted"] = 0;

if(!isset($_POST['PID']))
{
    //Not all parameters received
    $response["status"]=0;
    $response["err_message"]="Missing parameters!";
    entry_log("deleteanimal","Unknown",$response);     
    echo json_encode($response);    
    return;
}

#get user data
getUserData($UID,$UType,"deleteanimal",$conn);
if($UID == -2)
{
    return;
}

# Check if pet belongs to user and is stateless
$PID = mysqli_real_escape_string( $conn, $_POST['PID']);
$sql="SELECT COUNT(PID) nr 
        FROM Users_Pets
        JOIN Pets USING (PID)
        WHERE PID = $PID AND UID = $UID AND relation_type = 0 AND pet_state = 0";
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
    entry_log("deleteanimal","Unknown",$response);     
    return;
}


//Delete pet from Pets
$sql = "DELETE FROM Pets WHERE PID = $PID";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}

//Delete pet from Users_Pets 
$sql = "DELETE FROM Users_Pets WHERE PID = $PID";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}

//Delete pet from Requests
$sql = "DELETE FROM Requests WHERE PID = $PID";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}

//No error
$response["status"] = 1;
$response["deleted"] = 1; 
echo json_encode($response);
entry_log("deleteanimal",$UID, $response);   //Data logging
?>
