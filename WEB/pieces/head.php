<?php 
//Start PHP session, needed on every page with $_SESSION variables
session_start();
//If  user has cookie but is not logged in relog him
//TODO: redirect back to same page after
if(isset($_COOKIE["SecondHomeWeb"]) && !isset($_SESSION['userType']))
    echo"<script>window.location = 'login.php';</script>";
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SecondHome</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!--icons animale-->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-POYwD7xcktv3gUeZO5s/9nUbRJG/WOmV6jfEGikMJu77LGYO8Rfs2X7URG822aum" crossorigin="anonymous">

<!-- <link rel="icon" href="favicon.ico ?v=2" type="image/x-icon" /> -->
<link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon" >