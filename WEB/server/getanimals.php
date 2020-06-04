<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;
$response["hasAccount"] = 0;

//GET REQUEST TYPE
if(!isset($_POST['request_type']))
{
    $response["status"]=0;
    $response["err_message"]="Missing parameters!";
    entry_log("getanimals","Unknown",$response);   
    echo json_encode($response);
    return;
}

$req_type = $_POST['request_type'];


//get user data
getUserData($UID,$UType,"getanimals",$conn);
if($UID == -2)
{
    return;
}


//0 - get all animals waiting for addoption
if($req_type == 0)
{
    //type of animals to be returned
    if($UID != -1)
    {
        $sql="SELECT * FROM Pets 
                LEFT JOIN (SELECT PID,request_state 
                            FROM Requests 
                            WHERE UID = $UID AND request_type = 2) aux USING (PID) WHERE ";
    }
    else
    {
        $sql="SELECT * FROM Pets WHERE ";
    }
    
    if(isset($_POST['pet_type']) && $_POST['pet_type']!=0)
    {
        $pet_type = mysqli_real_escape_string( $conn,$_POST['pet_type']);
        $sql .= "pet_type = $pet_type AND ";
    }   
    $sql .="pet_state=10 ORDER BY PID";
    

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
        $response['animals'][$poz]['description'] = $row['pet_description'];
        $response['animals'][$poz]['image'] = $row['pet_image'];
        $response['animals'][$poz]['type'] = $row['pet_type'];
        $response['animals'][$poz]['breed'] = $row['pet_breed'];
        if($UID!=-1)
        {
            if($row['request_state']!= null)
            {
                $response['animals'][$poz]['has_request'] = 1;
                $response['animals'][$poz]['request_state'] = $row['request_state'];
            }
            else
            {
                $response['animals'][$poz]['has_request'] = 0;
            }
        }
        
        $poz++;
    }
}   //ELEVATED ACCES FUNCTIONS(MY PETS + GET REQUEST PETS)
else if($req_type >= 1 && $req_type <= 5)
{
    if($UID == -1)
    {
        $response["status"]=0;
        $response["err_message"] = "Unauthorized access";
        entry_log("getanimals","Unknown",$response);     
        echo json_encode($response);  
        return;
    }

    //PETS ADOPTED BY CERTAIN USER
    if($req_type == 5)
    {
        //Get animals bound to user
        $sql="  SELECT * FROM Pets
        LEFT JOIN (SELECT PID,request_type,request_state FROM Requests WHERE UID = $UID) aux USING (PID) 
        WHERE PID IN (SELECT PID FROM Users_Pets WHERE UID = $UID)
            AND pet_state = 11
        ORDER BY PID DESC";

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
            $response['animals'][$poz]['description'] = $row['pet_description'];
            $response['animals'][$poz]['type'] = $row['pet_type'];
            $response['animals'][$poz]['breed'] = $row['pet_breed'];

            if($row['request_type']!= null)
            {
                $response['animals'][$poz]['has_request'] = 1;
                $response['animals'][$poz]['request_type'] = $row['request_type'];
                $response['animals'][$poz]['request_state'] = $row['request_state'];
            }
            else
            {
                $response['animals'][$poz]['has_request'] = 0;
            }

            $response['animals'][$poz]['image'] = $row['pet_image'];
            $poz++;
        }
    }

    //PETS OF CERTAIN USER
    if($req_type == 1)
    {
        //Get animals bound to user
        $sql="  SELECT * FROM Pets
        LEFT JOIN (SELECT PID,request_type,request_state FROM Requests WHERE UID = $UID) aux USING (PID) 
        WHERE PID IN (SELECT PID FROM Users_Pets WHERE UID = $UID)
        AND pet_state <> 11
        ORDER BY PID DESC";

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
            $response['animals'][$poz]['description'] = $row['pet_description'];
            $response['animals'][$poz]['type'] = $row['pet_type'];
            $response['animals'][$poz]['breed'] = $row['pet_breed'];

            if($row['request_type']!= null)
            {
                $response['animals'][$poz]['has_request'] = 1;
                $response['animals'][$poz]['request_type'] = $row['request_type'];
                $response['animals'][$poz]['request_state'] = $row['request_state'];
            }
            else
            {
                $response['animals'][$poz]['has_request'] = 0;
            }

            $response['animals'][$poz]['image'] = $row['pet_image'];
            $poz++;
        }
    }

    //PETS WAITING FOR ADOPTION/HOTEL
    if($req_type == 2 || $req_type == 3 || $req_type == 4)
    {
        //Check user permision
        if($UType<1)
        {
            $response["status"] = -1;
            $response["err_message"]="Unauthorized access!";  
            error_log("Connection failed".mysqli_error($conn));   //Error logging
            echo json_encode($response);
            return;
        }

        $sql = "SELECT RID,PID,request_description,pet_name,pet_birthdate,pet_description,pet_image,pet_type,
                    pet_breed,UID,first_name,last_name 
                FROM Requests 
                JOIN Pets USING (PID)
                JOIN Users USING (UID)
                WHERE request_type = ($req_type-2) AND request_state = 0";

        //Get animals and format them
        if(!$result = mysqli_query($conn,$sql))
        {
            $response["status"]=-1;  //Database error
            error_log("SQL ERROR: ".mysqli_error($conn)."\nQUERY: ".$sql);   //Error logging
            echo json_encode($response);
            return;
        }

        $response['nr_animals'] = $result->num_rows;
        $poz = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            $response['animals'][$poz]['RID'] = $row['RID'];
            $response['animals'][$poz]['PID'] = $row['PID'];
            $response['animals'][$poz]['name'] = $row['pet_name'];
            $response['animals'][$poz]['birthdate'] = date_diff(date_create("now") , date_create($row['pet_birthdate']))->y;
            $response['animals'][$poz]['description'] = $row['pet_description'];
            $response['animals'][$poz]['type'] = $row['pet_type'];
            $response['animals'][$poz]['breed'] = $row['pet_breed'];
            $response['animals'][$poz]['image'] = $row['pet_image'];

            //User data
            $response['animals'][$poz]['UID'] = $row['UID'];
            $response['animals'][$poz]['first_name'] = $row['first_name'];
            $response['animals'][$poz]['last_name'] = $row['last_name'];

            $poz++;
        }
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

if($UID != -1)
{
    $response["hasAccount"] = 1;
}

    

//No error
$response["status"] = 1; 
echo json_encode($response);
$response['animals'] = "A lot of data...";
entry_log("getanimals",$user, $response);   //Data logging
?>
