<?php
include "php/connection.php";
include "php/header.php";
$response["status"]=-1;

for($i = 1;$i<=6;$i++)
{
    $response[$i]['nr_registered'] = 0;
    $response[$i]['nr_saved'] = 0;
}

$sql="SELECT pet_type, COUNT(PID) nr FROM Pets WHERE pet_state BETWEEN 10 AND 11 GROUP BY pet_type";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}


while($row = mysqli_fetch_assoc($result))
{
    $response[$row['pet_type']]['nr_registered'] = $row["nr"];  
}

$sql="SELECT pet_type, COUNT(PID) nr FROM Pets WHERE pet_state = 11 GROUP BY pet_type";
if(!$result = mysqli_query($conn,$sql))
{
    $response["status"]=-1;  //Database error
    error_log("SQL ERROR: ".mysqli_error($conn));
    echo json_encode($response);
    return;
}

while($row = mysqli_fetch_assoc($result))
{
    $response[$row['pet_type']]['nr_saved'] = $row["nr"];
}



//No error
$response["status"] = 1; 
echo json_encode($response);
$response=NULL;
$response["status"] = 1;
entry_log("getstatistics","Unknown", $response);   //Data logging
?>