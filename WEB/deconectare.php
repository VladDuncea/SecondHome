<?php
session_start();
if(isset($_SESSION['userType']))
{
	unset($_COOKIE["SecondHomeWeb"]);
	setcookie("SecondHomeWeb", null, -1, "/");
	session_unset();	
}
echo "<script>window.location = '/index.php';</script>";
?>