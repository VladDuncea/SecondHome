<?php
include "php/connection.php";
include "php/header.php";

//TODO: this table is not yet in database
// $sql ="SELECT * FROM config WHERE ID='1'";         //Selecting default preset
// if(!$result = mysqli_query($conn,$sql))
// {
//   $response["status"] = -1;       //Database error
//   echo json_encode($response);
//   error_log("Connection failed".mysqli_error());   //Error logging
//   return;
// }

// if($row = mysqli_fetch_assoc($result))
// {
//   if($row["maintenance"]==1)        //Checking for maintenance
//   {
//       $response["maintenance"] = true;
//   }
//   else
//   {
//       $response["maintenance"]=false;
//   }
// }

$response["status"] = 1;        //No error
echo json_encode($response);
entry_log("-",$response);   //Data logging

?>
