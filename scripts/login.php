<?php   session_start();    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="shortcut icon" href="../Images/logos/login.jpg" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
<?php

        if(
            isset( $_POST["luemail"] )      &&
            isset( $_POST["lupass"] )       &&
            isset( $_POST["lusubmit"] )     
        ){
            
            try{

                $_SESSION["user"] = "guest";

                require_once("connection.php");
                
                echo "<div class='container mx-5 my-5 text-center'>";

                $email = $_POST["luemail"];
                $pass = $_POST["lupass"];

                $pattern = "/^([A-Za-z0-9_\-\.])+\@([A-Za-z_\-\.])+\.([A-Za-z]{2,4})$/";

                if( preg_match($pattern,$email) ){
                    // echo "<div class='alert alert-success' role=alert>Email Validated Successfully</div>";
                }else{
                    
                    echo "<div class='alert alert-danger' role=alert>Invalid Email</div>";
                    echo "<script> setTimeout(() => { window.location.href = '../pages/login.html'; }, 3000);  </script>";
                    exit;
                    
                }

                $pattern = "/^([A-Za-z0-9_\-\.])/";

                if( preg_match($pattern,$pass) ){
                    
                    // echo "<div class='alert alert-success' role=alert>Password Validated Successfully</div>";

                    $query = "select count(*) as 'count' from customer where email='$email'";

                    $result = mysqli_query($conn,$query);

                    $record = mysqli_fetch_assoc($result);

                    if( $record["count"] < 1 ){
                        
                        echo "<div class='alert alert-info' role='alert'>Record Not Found </div>";
                        echo "<script> setTimeout(() => { window.location.href = '../pages/signup.html'; }, 3000);  </script>";
                        exit;
                    
                    }else{

                        $query = "select customer_id,fname,email,password from customer where email='$email'";
 
                        $result = mysqli_query($conn,$query);

                        $flag = 0;
                        
                        while( $record = mysqli_fetch_assoc($result) ){

                            if( password_verify( $pass,$record["password"]) ){
                                $_SESSION["user"] = $record["customer_id"];
                                echo "<div class='alert alert-success' role='alert'> Hello ".  $record['fname'] .", Redirecting to Product Page </div>";
                                echo "<script> setTimeout(() => { window.location.href = '../pages/product.html'; }, 3000);  </script>";
                                $flag = 1;
                                break;
                            }

                        }

                        if( $flag == 0 ){

                            echo "<div class='alert alert-success' role='alert'> Misleading Information </div>";
                            echo "<script> setTimeout(() => { window.location.href = '../pages/login.html'; }, 3000);  </script>";
                        
                        }

                    }
                    
                }else{

                    echo "<div class='alert alert-danger' role='alert'>Invalid Password Format</div>";
                    echo "<script> setTimeout(() => { window.location.href = '../pages/login.html'; }, 3000);  </script>";

                }

                echo "</div> ";
                
            }catch(Exception $e){

                echo "<div class='conatiner'>";
                echo "<div class='alert alert-warning text-center' role='alert'>Something Went Wrong</div>";
                echo "</div>";
                
                echo "<script> setTimeout(() => { window.location.href = '../pages/../scripts/home.php'; }, 3000);  </script>";

            }
            
        }else{
            
            $_SESSION["user"] = "guest";

            echo "<div class='conatiner'>";
            echo "<div class='alert alert-warning text-center' role='alert'> Unable To Fetch Information </div>";
            echo "</div>";

            echo "<script> setTimeout(() => { window.location.href = '../pages/login.html'; }, 3000);  </script>";

        }

    

?>
</html>