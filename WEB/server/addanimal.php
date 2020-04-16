<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

if(!isset($_POST['pet_name'], $_POST['pet_description'], $_POST['pet_type'], $_POST['pet_breed'], $_POST['pet_age']))
{
    //Not all parameters received
    $response["status"]=0;
    entry_log("addanimal","Unknown",$response);     
    echo json_encode($response);    
    return;
}
//the user id is not provided, try to extract it from SESSION
if(!isset($_POST['security_code']) || $_POST['security_code']!= '8981ASDGHJ22123')
{
    //Web access
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
else if ($_POST['security_code']== '8981ASDGHJ22123')
{
    //Android access
    $UID = $_POST['UID'];
}

$pet_image = null;
if(isset($_FILES['pet_image']['name']))
{
    /* Getting file name */
    $filename = $_FILES['pet_image']['name'];

    /* Location */
    $location = "upload/".$filename;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
  
    // Check extension
    if(in_array(strtolower($imageFileType),$extensions_arr) )
    {
      // Convert to base64 
      $image_base64 = base64_encode(file_get_contents($_FILES['pet_image']['tmp_name']) );
      $pet_image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    }
    else
    {
        $response["status"]=0;
        $response["err_message"] = "Extension type not supported: ".$imageFileType;
        entry_log("addanimal","Unknown",$response);     
        echo json_encode($response);  
        return;
    }

    //$pet_image = addslashes (file_get_contents($_FILES['pet_image']['tmp_name']));
}


//Reading data from request and sanitizing
$pet_name = mysqli_real_escape_string( $conn, $_POST['pet_name'] );
$pet_description = mysqli_real_escape_string( $conn, $_POST['pet_description']);    
$pet_type  = mysqli_real_escape_string( $conn, $_POST['pet_type']);
$pet_breed  = mysqli_real_escape_string( $conn, $_POST['pet_breed']);
$pet_age  = mysqli_real_escape_string( $conn, $_POST['pet_age']);
//Convert pet_age to pet birthday
$pet_birthdate = (date('Y')-$pet_age).date("-m-d");

//Add the pet
if($pet_image!=null)
    $sql="INSERT INTO Pets (pet_name, pet_description, pet_type, pet_breed, pet_birthdate,pet_image) 
    VALUES ('$pet_name','$pet_description','$pet_type','$pet_breed', '$pet_birthdate','$pet_image');";
else
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
entry_log("addanimal",$UID, $response);   //Data logging
?>
