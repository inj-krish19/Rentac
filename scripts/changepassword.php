<title>Profile</title>
<link rel="shortcut icon" href="../Images/logos/user.jpg" type="image/x-icon">
<?php   
    
    session_start();    

    require_once("../scripts/connection.php");

    if(
        $_SESSION["user"] == "guest"
    ){
        echo "<script> setTimeout(() => { window.location.href = '../pages/login.html'; }, 3000 ); </script>";
    }

    $query = "select * from customer where customer_id = ". $_SESSION["user"] ." ";

    $result = mysqli_query($conn,$query);

    $personal = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- include the site stylesheet -->
    <link
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
        rel='stylesheet' type='text/css'>
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/icon-fonts.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>
    <!-- main container of all the page elements -->
    <div id="wrapper">
        <!-- Page Loader -->
        <div id="pre-loader" class="loader-container">
            <div class="loader">
                <img src="../Images/rings.svg" alt="loader">
            </div>
        </div>
        <div class="w1">
            <!-- mt header style4 start here -->
            <header id="mt-header" class="style4">
                <!-- mt bottom bar start here -->
                <div class="mt-bottom-bar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- mt logo start here -->
                                <div class="mt-logo"><a href="../scripts/home.php"><img src="../Images/logos/Rentac.jpg"
                                            alt="Rentac"></a>
                                </div>
                                <!-- mt icon list start here -->
                                <ul class="mt-icon-list">
                                    <li class="hidden-lg hidden-md">
                                        <a href="#" class="bar-opener mobile-toggle">
                                            <span class="bar"></span>
                                            <span class="bar small"></span>
                                            <span class="bar"></span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- mt icon list end here -->
                                <!-- navigation start here -->
                                <nav id="nav">
                                    <ul>
                                        <li>
                                            <a href="../scripts/home.php">HOME <i
                                                    class="fa fa-angle-down hidden-lg hidden-md"
                                                    aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <a href="../scripts/product.php">PRODUCTS <i
                                                    class="fa fa-angle-down hidden-lg hidden-md"
                                                    aria-hidden="true"></i></a>
                                        </li>
                                        <li class="drop">
                                            <a href="#">Events <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <!-- mt dropmenu start here -->
                                            <div class="mt-dropmenu text-left" style="left:60%; right:0%;">
                                                <!-- mt frame start here -->
                                                <div class="mt-frame"
                                                    style="max-width: 500px; width: 300px; padding: 15px;">
                                                    <!-- mt f box start here -->
                                                    <div class="mt-col-3">
                                                        <div class="sub-dropcont">
                                                            <strong class="title"><a href="product-grid-view.html"
                                                                    class="mt-subopener">Social
                                                                    Events</a></strong>
                                                            <div class="sub-drop">
                                                                <ul>
                                                                    <li><a
                                                                            href="../scripts/product.php?event=birthday"></a>Birthday</a>
                                                                    </li>
                                                                    <li><a
                                                                            href="../scripts/product.php?event=seminar">Seminar</a>
                                                                    </li>
                                                                    <li><a
                                                                            href="../scripts/product.php?event=party">Party</a>
                                                                    </li>
                                                                    <li><a
                                                                            href="../scripts/product.php?event=wedding">Wedding</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- mt col3 end here -->
                                                    </div>
                                                    <!-- mt f box end here -->
                                                </div>
                                                <!-- mt frame end here -->
                                            </div>
                                            <!-- mt dropmenu end here -->
                                            <span class="mt-mdropover"></span>
                                        </li>
                                        <li><a href="aboutus.html">About</a></li>
                                        <li>
                                            <a href="contactus.html">Contact <i
                                                    class="fa fa-angle-down hidden-lg hidden-md"
                                                    aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <?php 
                                                if( (!isset($_SESSION["user"]) || $_SESSION["user"] == "guest" ) ){
                                            ?>
                                              <a href="../pages/login.html">Login <i
                                                      class="fa fa-angle-down hidden-lg hidden-md"
                                                      aria-hidden="true"></i></a>
                                            <?php   }else{   ?>
                                              <a href="../scripts/userprofile.php">User Profile <i
                                                      class="fa fa-angle-down hidden-lg hidden-md"
                                                      aria-hidden="true"></i></a>
                                            <?php   }   ?>

                                        </li>
                                    </ul>
                                </nav>
                                <!-- mt icon list end here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- mt bottom bar end here -->
                <span class="mt-side-over"></span>
            </header>
            <main id="mt-main">
                <!-- Mt Contact Banner of the Page -->
                <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <h1>CHANGE PASSWORD</h1>
                                <nav class="breadcrumbs">
                                    <ul class="list-unstyled">
                                        <li><a href="../scripts/home.php">Home <i class="fa fa-angle-right"></i></a>
                                        </li>
                                        <li><a href="#">Change Password</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </section><!-- Mt Contact Banner of the Page -->
                <!-- Mt Contact Detail of the Page -->
                <section class="mt-contact-detail content-info wow fadeInUp" data-wow-delay="0.4s">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-6 col-sm-12 col-sm-offset-2">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="holder" style="margin: 0;">
                                            <div class="mt-side-widget">
                                                <header>
                                                    <h2>Personal Information</h2>
                                                </header>
                                                <form method="post" >
                                                    <fieldset>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-6">
                                                                <input type="text" placeholder="First Name" class="input" name="ufname" value= <?php echo $personal["fname"];   ?> >
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6">
                                                                <input type="text" placeholder="Last Name" class="input" name="ulname" value= <?php echo $personal["lname"]; ?>>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-6">
                                                                <input type="text" placeholder="Verify Email" class="input" name="uemail" >
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6">
                                                                <input type="text" placeholder="Verify Phone" class="input" name="ucont" >
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-6">
                                                                <input type="password" placeholder="Enter New Password" class="input" name="upass" >
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6">
                                                                <button type="submit" class="btn-type1 text-center" name="upersonal">Change Password</button>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Mt Contact Detail of the Page end -->

            </main>
            <!-- footer of the Page -->
            <footer id="mt-footer" class="style7 wow fadeInUp" data-wow-delay="0.4s">
                <div class="footer-holder bg-grey">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 mt-paddingbottomsm">
                                <!-- F Widget About of the Page -->
                                <div class="f-widget-about">
                                    <div class="logo">
                                        <a href="index.html"><img src="../Images/logos/Rentac.jpg" alt="Rentac"></a>
                                    </div>
                                    <ul class="list-unstyled address-list">
                                        <li><i class="fa fa-map-marker"></i>
                                            <address>Department of Computer Science, Gujarat University <br>Ahmedabad -
                                                384002
                                            </address>
                                        </li>
                                        <li><i class="fa fa-phone" style="margin-bottom: 10px;"></i><a
                                                href="tel:15553332211">+1 XX
                                                XX XX
                                                XX</a></li>
                                        <li><i class="fa fa-envelope-o"></i><a
                                                href="../scripts/home.php">rentac01@gmail.com</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- F Widget About of the Page end -->
                            </div>
                            <nav class="col-xs-12 col-sm-8 col-md-5 mt-paddingbottomsm">
                                <!-- Footer Nav of the Page -->
                                <div class="nav-widget-1">
                                    <h3 class="f-widget-heading">Categories</h3>
                                    <ul class="list-unstyled f-widget-nav">
                                        <li><a href="../scripts/product.php?category=chair">Chairs</a></li>
                                        <li><a href="../scripts/product.php?category=sofa">Sofas</a></li>
                                        <li><a href="../scripts/product.php?category=table">Tables</a></li>
                                    </ul>
                                </div>
                                <!-- Footer Nav of the Page end -->
                                <!-- Footer Nav of the Page -->
                                <div class="nav-widget-1">
                                    <h3 class="f-widget-heading">Information</h3>
                                    <ul class="list-unstyled f-widget-nav">
                                        <li><a href="aboutus.html">About Us</a></li>
                                        <li><a href="contactus.html">Contact Us</a></li>
                                    </ul>
                                </div>
                                <!-- Footer Nav of the Page end -->
                                <!-- Footer Nav of the Page -->
                                <div class="nav-widget-1">
                                    <h3 class="f-widget-heading">Account</h3>
                                    <ul class="list-unstyled f-widget-nav">
                                        <li><a href="../scripts/userprofile.php">My Account</a></li>
                                        <li><a href="../scripts/trackorder.php">Order Tracking</a></li>
                                        <li><a href="../scripts/cart.php">Shopping Cart</a></li>
                                    </ul>
                                </div>
                                <!-- Footer Nav of the Page end -->
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Area of the Page -->
                    <div class="footer-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <p>© <a href="index.html">Rentac.</a> - All rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Area of the Page end -->
            </footer><!-- footer of the Page end -->
        </div>
        <span id="back-top" class="fa fa-arrow-up"></span>
    </div>
    <!-- include jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- include jQuery -->
    <script src="../js/plugins.js"></script>
    <!-- include jQuery -->
    <script src="../js/jquery.main.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
</body>
<?php
    
    if (
    isset($_POST["ufname"]) &&
    isset($_POST["ulname"]) &&
    isset($_POST["uemail"]) &&
    isset($_POST["ucont"]) &&
    isset($_POST["upass"])
) {
    if (
        $_POST["uemail"] == $personal["email"] &&
        $_POST["ucont"] == $personal["contact_no"]
    ) {
        $hashed_password = password_hash($_POST["upass"], PASSWORD_DEFAULT);
        $email = mysqli_real_escape_string($conn, $_POST["uemail"]);
        $contact_no = mysqli_real_escape_string($conn, $_POST["ucont"]);
        $customer_id = $_SESSION["user"];
        
        $query = "update customer set password = '$hashed_password',email = '$email',contact_no = '$contact_no' where customer_id = $customer_id";

        echo $query;

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script> setTimeout(() => { window.location.href = '../scripts/changepassword.php'; }, 3000); </script>";
        } else {
            // echo "Error updating record: " . mysqli_error($conn);
        }
    }
}


?>
</html>