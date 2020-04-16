<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

//0 - get all animals waiting for addoption
if($_POST['request_type'] == 0)
{
    //type of animals to be returned
    if(!isset($_POST['pet_type']) || $_POST['pet_type']==0)
        $sql="SELECT * FROM Pets ORDER BY PID";
    else
        $sql="SELECT * FROM Pets WHERE pet_type = {$_POST['pet_type']} ORDER BY PID";

    //Get animals and format them
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1;  //Database error
        error_log("Connection failed".mysqli_error($conn));   //Error logging
        echo json_encode($response);
        return;
    }

    $response['nr_animals'] = $result->num_rows;
    $poz = 0;
    while($row = mysqli_fetch_assoc($result))
    {
        $response['animals'][$poz]['PID'] = $row['PID'];
        $response['animals'][$poz]['name'] = $row['pet_name'];
        $response['animals'][$poz]['birthdate'] = date_diff(date_create("now") , date_create($row['pet_birthdate']))->y;
        $response['animals'][$poz]['state'] = $row['pet_state'];
        $response['animals'][$poz]['description'] = $row['pet_description'];
        $response['animals'][$poz]['image'] = $row['pet_image'];
        $response['animals'][$poz]['food'] = $row['pet_food'];
        $response['animals'][$poz]['type'] = $row['pet_type'];
        $response['animals'][$poz]['breed'] = $row['pet_breed'];
        $poz++;
    }
}
else if($_POST['request_type'] == 1)
{
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

    //Get animals bound to user
    $sql="  SELECT * FROM Pets
            LEFT JOIN (SELECT PID,request_type,request_state FROM Requests WHERE UID = $UID) aux USING (PID) 
            WHERE PID IN (SELECT PID FROM Users_Pets WHERE UID = $UID)";

    //Get animals and format them
    if(!$result = mysqli_query($conn,$sql))
    {
        $response["status"]=-1;  //Database error
        error_log("Connection failed".mysqli_error($conn));   //Error logging
        echo json_encode($response);
        return;
    }

    $response['nr_animals'] = $result->num_rows;
    $poz = 0;
    while($row = mysqli_fetch_assoc($result))
    {
        $response['animals'][$poz]['PID'] = $row['PID'];
        $response['animals'][$poz]['name'] = $row['pet_name'];
        $response['animals'][$poz]['birthdate'] = date_diff(date_create("now") , date_create($row['pet_birthdate']))->y;
        $response['animals'][$poz]['state'] = $row['pet_state'];
        $response['animals'][$poz]['description'] = $row['pet_description'];
        $response['animals'][$poz]['food'] = $row['pet_food'];
        $response['animals'][$poz]['type'] = $row['pet_type'];
        $response['animals'][$poz]['breed'] = $row['pet_breed'];
        
        if($row['request_type']!= null)
        {
            $response['animals'][$poz]['has_request'] = 1;
            $response['animals'][$poz]['request_type'] = $row['request_type'];
            $response['animals'][$poz]['request_type'] = $row['request_state'];
        }
        else
        {
            $response['animals'][$poz]['has_request'] = 0;
        }
        
        $response['animals'][$poz]['image'] = $row['pet_image'];
        $poz++;
    }
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
$response['animals'] = "A lot of data...";
entry_log("getanimals",$user, $response);   //Data logging
?>
