<?php   session_start();    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="shortcut icon" href="../Images/logos/order.jpg" type="image/x-icon">
    <!-- include the site stylesheet -->
    <link
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
        rel='stylesheet' type='text/css'>
    <!-- include the site stylesheet -->
    <!-- <link rel="stylesheet" href="../css/bootstrap.css">    from connection.php -->
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/icon-fonts.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<?php

    if( (!isset($_SESSION["user"])) || $_SESSION["user"] == "guest" ){
        echo "<script> setTimeout(() => { window.location.href = '../scripts/home.php'; }, 3000);  </script>";
        exit;
    }

    $notFound = true;

    require_once("connection.php");

    $query = "SELECT P.productid, P.product_name, P.price,P.image_path,C.quantity,C.payment_method,C.amount  FROM product P,cart C where P.productid = C.product_id and C.customer_id = ". $_SESSION["user"] ." group by P.productid";

    $result = mysqli_query($conn,$query);

?>

<?php

    function makeUrl($phrase){


        parse_str($phrase, $newParams);

        parse_str($_SERVER["QUERY_STRING"], $currentParams);

        $mergedParams = array_merge($currentParams, $newParams);

        $newQueryString = http_build_query($mergedParams);

        $newUrl = $_SERVER["PHP_SELF"] . "?" . $newQueryString;

        echo $newUrl;

    }

    // print_r($_SERVER);

?>

<body>
    <!-- main container of all the page elements -->
    <div id="wrapper">
        <!-- Page Loader -->
        <!-- <div id="pre-loader" class="loader-container">
            <div class="loader">
                <img src="../Images/rings.svg" alt="loader">
            </div>
        </div> -->
        <!-- W1 start here -->
        <div class="w1">
            <!-- mt header style4 start here -->
            <header id="mt-header" class="style4">
                <!-- mt bottom bar start here -->
                <div class="mt-bottom-bar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- mt logo start here -->
                                <div class="mt-logo" style="height:50px;    width:50px;">
                                    <a href="../scripts/home.php"><img src="../Images/logos/Rentac.jpg"
                                            alt="Rentac"></a>
                                </div>
                                <!-- mt icon list end here -->
                                <ul class="mt-icon-list">
                                    <li class="hidden-lg hidden-md">
                                        <a href="#" class="bar-opener mobile-toggle">
                                            <span class="bar"></span>
                                            <span class="bar small"></span>
                                            <span class="bar"></span>
                                        </a>
                                    </li>
                                    <li><a onclick="window.location.href='search.php'" class="icon-magnifier"></a></li>
                                    <li class="drop">
                                        <a href="../scripts/trackorder.php" class="cart-opener">
                                            <span class="icon-handbag"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="bar-opener side-opener">
                                            <span class="bar"></span>
                                            <span class="bar small"></span>
                                            <span class="bar"></span>
                                        </a>
                                    </li>
                                </ul>
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
                                            <div class="mt-dropmenu text-left" style="left:30%; right:0%;">
                                                <!-- mt frame start here -->
                                                <div class="mt-frame"
                                                    style="max-width: 500px; width: 300px; padding: 15px;">
                                                    <!-- mt f box start here -->
                                                    <div class="mt-col-3">
                                                        <div class="sub-dropcont">
                                                            <strong class="title"><a href="product.php"
                                                                    class="mt-subopener">Social
                                                                    Events</a></strong>
                                                            <div class="sub-drop">
                                                                <ul>
                                                                    <li><a
                                                                            href=<?php  makeUrl("event=birthday");  ?> >Birthday</a>
                                                                    </li>
                                                                    <li><a href=<?php  makeUrl("event=seminar");  ?> >Seminar</a>
                                                                    </li>
                                                                    <li><a href=<?php  makeUrl("event=party");  ?> >Party</a></li>
                                                                    <li><a href=<?php  makeUrl("event=wedding");  ?> >Wedding</a>
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
                                        <li><a href="../pages/aboutus.html">About</a></li>
                                        <li>
                                            <a href="../pages/contactus.html">Contact <i
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
            </header><!-- mt header style4 end here -->
            <!-- mt side menu start here -->
            <div class="mt-side-menu ">
                <!-- mt holder start here -->
                <div class="mt-holder">
                    <a href="#" class="side-close"><span></span><span></span></a>
                    <strong class="mt-side-title">MY ACCOUNT</strong>
                    <!-- mt side widget start here -->
                    <div class="mt-side-widget">
                        <header>
                            <span class="mt-side-subtitle">SIGN IN</span>
                            <p>Welcome back! Sign in to Your Account</p>
                        </header>
                        <form action="../scripts/login.php">
                            <fieldset>
                                <input type="text" placeholder="Email Address" class="input">
                                <input type="password" placeholder="Password" class="input">
                                <button type="submit" class="btn-type1">Login</button>
                            </fieldset>
                        </form>
                    </div>
                    <!-- mt side widget end here -->
                    <div class="or-divider"><span class="txt">or</span></div>
                    <!-- mt side widget start here -->
                    <div class="mt-side-widget">
                        <header>
                            <span class="mt-side-subtitle">CREATE NEW ACCOUNT</span>
                            <p>Create your very own account</p>
                        </header>
                        <form action="../scripts/signup.php">
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" placeholder="First Name" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" placeholder="Last Name" class="input">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" placeholder="Your Email" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" placeholder="Your Phone" class="input">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="password" placeholder="Password" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <button type="submit" class="btn-type1" style="margin-right: 70%;">Sign Up</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- mt side widget end here -->
                </div>
                <!-- mt holder end here -->
            </div><!-- mt side menu end here -->
            <!-- mt main start here -->
            <main id="mt-main">
                <!-- Mt Contact Banner of the Page -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h1>CART</h1><!-- Breadcrumbs of the Page end -->
                        </div>
                    </div>
                </div>
                <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
                        <div class="container"> 
                            <div class="row border">
                            <div class="col-xs-12 col-sm-2">
                                <strong class="title">PRODUCT</strong>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <strong class="title">PRODUCT NAME</strong>
                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <strong class="title">PRICE</strong>
                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <strong class="title">QUANTITY</strong>
                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <strong class="title">AMOUNT</strong>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <strong class="title">PAYMENT METHOD</strong>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <strong class="title">STATUS</strong>
                            </div>
                        </div>
                        <?php   while( $record = mysqli_fetch_assoc( $result) ){    $notFound = false;  ?>
                            <div class="row border ">
                                <div class="col-xs-12 col-sm-2">
                                    <div class="img-holder">
                                    <img src="../<?php echo $record['image_path']; ?>" alt="image description" style="width: 105px; height: 105px;">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <strong class="product-name"><?php echo $record['product_name']; ?></strong>
                                </div>
                                <div class="col-xs-12 col-sm-1">
                                    <strong class="price "><i class="fa fa-rupee"></i> <?php echo $record['price']; ?></strong>
                                </div>
                                <div class="col-xs-12 col-sm-1">
                                    <strong class="price "><?php echo $record['quantity']; ?></strong>
                                </div>
                                <div class="col-xs-12 col-sm-1">
                                    <strong class="price "><i class="fa fa-rupee"></i> <span id="total"><?php echo $record['amount']; ?></span></strong>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <strong class="price text-right"><?php if( $record['payment_method'] ){ echo $record['payment_method']; }else{ echo "Cash"; } ?></strong>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <strong class="price "><span id="total"> Arriving </span></strong>
                                </div>
                            </div>
                        <?php   }   ?>
                        <?php   if($notFound){  ?>
                            <div class="mx-3 my-3 " style="color:#868686;"><h1 style=" font-weight : 900;"> Cart Is Empty </h1></div>
                        <?php   }   ?>
                    </div>
                </div>
            </main><!-- mt main end here -->
            <!-- footer of the Page -->
            <footer id="mt-footer" class="style7 wow fadeInUp" data-wow-delay="0.4s">
                <div class="footer-holder bg-grey">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 mt-paddingbottomsm">
                                <!-- F Widget About of the Page -->
                                <div class="f-widget-about">
                                    <div class="logo">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-8">
                                                <a href="../scripts/home.php"><img src="../Images/logos/Rentac.jpg"
                                                        alt="Rentac"></a>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 text-center">
                                                <h3 style="margin : 19px 0 0 0"> Rentac </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled address-list">
                                        <li><i class="fa fa-map-marker"></i>
                                            <address>Department of Computer Science, Gujarat University <br>Ahmedabad -
                                                384002
                                            </address>
                                        </li>
                                        <li><i class="fa fa-phone" style="margin-bottom: 10px;"></i><a
                                                href="../scripts/home.php">+91 XX
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
                                        <li><a href="../pages/aboutus.html">About Us</a></li>
                                        <li><a href="../pages/contactus.html">Contact Us</a></li>
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
                                    <p>© <a href="../scripts/home.php">Rentac.</a> - All rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Area of the Page end -->
            </footer><!-- footer of the Page end -->
        </div><!-- W1 end here -->
        <span id="back-top" class="fa fa-arrow-up"></span>
    </div>
    <!-- include jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- include jQuery -->
    <script src="../js/plugins.js"></script>
    <!-- include clear console -->
    <script src="../js/clear console.js"></script>
    <!-- include jQuery -->
    <script src="../js/jquery.main.js"></script>
</body>
</html>
<?php
/*

select P.productid,P.product_name, P.price as 'price', P.image_path 
from product P 
inner join (
    select A.product_id 
    from product_chairs A 
    inner join product P ON P.productid = A.product_id 
    where A.event_id = (select event_id from event where event_name = 'Party')
    
    union all 
    
    select B.product_id 
    from product_sofas B 
    inner join product P ON P.productid = B.product_id 
    where B.event_id = (select event_id from event where event_name = 'Party')
    
    union all 
    
    select C.product_id 
    from product_tables C 
    inner join product P ON P.productid = C.product_id 
    where C.event_id = (select event_id from event where event_name = 'Party')
) as A ON P.productid = A.product_id;
        */

        /*

        select COUNT(P.productid) as total_products
from product P
inner join (
    select product_id
    from product_chairs
    where event_id = (select event_id from event where event_name = 'Party')
    
    union all
    
    select product_id
    from product_sofas
    where event_id = (select event_id from event where event_name = 'Party')
    
    union all
    
    select product_id
    from product_tables
    where event_id = (select event_id from event where event_name = 'Party')
) as A ON P.productid = A.product_id;

*/
?>