<?php
$servername ="localhost";       //Database connection data
$username="fragment_secondhome";
$password="SecondHome123";
$ubname="fragment_secondhome";
$conn=mysqli_connect($servername,$username,$password,$ubname); //Estabilishing connection
if(!$conn)      //Connection error
{
    echo("Connection failed".mysqli_connect_error());     //Error logging
    return;
}
?>
