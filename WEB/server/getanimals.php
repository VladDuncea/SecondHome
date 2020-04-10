<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

//0 - get all animals waiting for addoption
if($_POST['request_type'] == 0)
{
    $sql="SELECT * FROM Pets";
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
        $response['animals'][$poz]['name'] = $row['pet_name'];
        $response['animals'][$poz]['birthdate'] = $row['pet_birthdate'];
        $response['animals'][$poz]['state'] = $row['pet_state'];
        $response['animals'][$poz]['description'] = $row['pet_description'];
        $response['animals'][$poz]['image'] = $row['pet_image'];
        $response['animals'][$poz]['food'] = $row['pet_food'];
        $response['animals'][$poz]['type'] = $row['pet_type'];
        $response['animals'][$poz]['breed'] = $row['pet_breed'];
        $poz++;
    }
}
else{
    //LUTHER
}

//No error
$response["status"] = 1; 
echo json_encode($response);
$response['animals'] = "A lot of data...";
entry_log($UID, $response);   //Data logging
?>
