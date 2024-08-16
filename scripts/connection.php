<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Connection</title> -->
    <!-- <link rel="shortcut icon" href="../Images/logos/Rentac.jpg" type="image/x-icon"> -->
    <link
    href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
    rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/icon-fonts.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
</body>
</html>
<?php

    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "rentac";
    $portNumber = "3000";

    $conn = mysqli_connect($serverName,$userName,$password,$databaseName);

    echo "<div class='conatiner mx-5 my-5'>";
    
    try{

        if( $conn ){
            // echo "<div class='alert alert-success text-center' role='success'><h1>Connection Established Successfully</h1></div>";
        }else{
            echo "<div class='alert alert-danger text-center' role='success'><h1>Internal Server Error</h1></div>";
            exit;
        }

    }catch(Exception $e){
        // echo "<div class='alert alert-danger text-center' role='success'><h1>Internal Server Error</h1></div>";
    }

    echo "</div>";


?>