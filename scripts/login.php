<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
<?php

    require_once("connection.php");

    if(
        isset( $_POST["luemail"] )      &&
        isset( $_POST["lupass"] )       &&
        isset( $_POST["lusubmit"] )     
    ){

        echo "<div class='conatiner mx-5 my-5'>";

        $email = $_POST["luemail"];
        $pass = $_POST["lupass"];

        $pattern = "/^([A-Za-z0-9_\-\.])+\@([A-Za-z_\-\.])+\.([A-Za-z]{2,4})$/";

        if( preg_match($pattern,$email) ){
            echo "<div class='alert alert-success' role=alert>Email Validated Successfully</div>";
        }else{
            echo "<div class='alert alert-danger' role=alert>Invalid Email</div>";
        }

        $pattern = "/^([A-Za-z0-9_\-\.])/";

        if( preg_match($pattern,$pass) ){
            echo "<div class='alert alert-success' role=alert>Password Validated Successfully</div>";

            // query 

        }else{
            echo "<div class='alert alert-danger' role=alert>Invalid Password Format</div>";
        }

        echo "</div> ";

        echo "<script> setTimeout(() => { window.location.href = '../pages/product.html'; }, 1500);  </script>";

    }

?>
</html>