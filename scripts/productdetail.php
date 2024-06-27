<?php session_start();  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodcut Details</title>
    <link rel="shortcut icon" href="../Images/logos/detail.jpg" type="image/x-icon">
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
<?php
    if(
        empty($_REQUEST["pid"])
    ){
        header("Location:../scripts/product.php");
    }else{
        
        require_once("connection.php");

        $query = "select productid,product_name,price,description,image_path from product where productid = ".$_REQUEST["pid"]." ";

        $result = mysqli_query($conn,$query);

        $record = mysqli_fetch_assoc($result);

    }


?>
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
                                            <a href="../scripts/home.php">HOME <i class="fa fa-angle-down hidden-lg hidden-md"
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
            </header><!-- mt header style4 end here -->
            <!-- Main of the Page -->
            <main id="mt-main">
                <!-- Mt Content Banner of the Page -->
                <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <h1>Product Details</h1>
                                <nav class="breadcrumbs">
                                    <ul class="list-unstyled">
                                        <li><a href="../scripts/home.php">home <i class="fa fa-angle-right"></i></a></li>
                                        <li><a href="../scripts/product.php">product <i
                                                    class="fa fa-angle-right"></i></a></li>
                                        <li>Product Details</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Mt Content Banner of the Page end -->
                <!-- Mt About Section of the Page -->
                <section class="mt-product-detial" style="margin-bottom:3%;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- Slider of the Page -->
                                <div class="slider">
                                    <!-- Product Slider of the Page -->
                                    <div class="product-slider">
                                        <div class="slide">
                                            <img src="<?php  echo "../".$record["image_path"]; ?>" style="margin-top: 50px;width:500px; height:450px;" alt="image descrption">
                                        </div>
                                    </div><!-- Product Slider of the Page end -->
                                </div><!-- Slider of the Page end -->
                                <!-- Detail Holder of the Page -->
                                <div class="detial-holder">
                                    <!-- Breadcrumbs of the Page -->
                                    <ul class="list-unstyled breadcrumbs">
                                        <li><a href="product.php">Product <i class="fa fa-angle-right"></i></a></li>
                                        <li><a href="product.php?category=abc">Category <i class="fa fa-angle-right"></i></a></li>
                                        <li><a href="product.php?event=abc">Event <i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                    <!-- Breadcrumbs of the Page end -->
                                    <h2> <?php  echo $record["product_name"]  ?> </h2>
                                    <div class="txt-wrap">
                                        <p> <?php  echo $record["description"]  ?> </p>
                                    </div>
                                    <div class="text-holder">
                                        <span class="price"><i class="fa fa-rupee"></i>  <?php  echo $record["price"]  ?>  </span>
                                    </div><!-- Product Form of the Page -->
                                    <form action="#" class="product-form">
                                        <fieldset>
                                            <div class="row-val">
                                                <label for="qty">qty</label>
                                                <select id="clr">
                                                    <option>1</option>
                                                </select>
                                            </div>
                                            <div class="row-val">
                                                <button type="submit" onclick="window.location.href='addincart.php'">ADD
                                                    TO CART</button>
                                            </div>
                                        </fieldset>
                                    </form><!-- Product Form of the Page end -->
                                </div><!-- Detail Holder of the Page end -->
                            </div>
                        </div>
                    </div>
                </section><!-- Mt Product Detial of the Page end -->
                <!-- Mt Workspace Section of the Page -->
                <div class="related-products wow fadeInUp" data-wow-delay="0.4s">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2>RELATED PRODUCTS</h2>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img
                                                                src="http://placehold.it/215x215"
                                                                alt="image description"></a>
                                                        <ul class="links">
                                                            <li><a href="addincart.php?pid="><i class="icon-handbag"></i><span>Add to
                                                                        Cart</span></a></li> 
                                                            <li><a href="product.php?pid="><i class="icomoon icon-exchange"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">Puff
                                                        Chair</a></strong>
                                                <span class="price"><i class="fa fa-rupee"></i> <span>287,00</span></span>
                                            </div>
                                        </div><!-- mt product1 center end here -->
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img
                                                                src="http://placehold.it/215x215"
                                                                alt="image description"></a>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                        Cart</span></a></li> 
                                                            <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">Bombi
                                                        Chair</a></strong>
                                                <span class="price"><i class="fa fa-rupee"></i> <span>399,00</span></span>
                                            </div>
                                        </div><!-- mt product1 center end here -->
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img
                                                                src="http://placehold.it/215x215"
                                                                alt="image description"></a>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                        Cart</span></a></li> 
                                                            <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">Wood
                                                        Chair</a></strong>
                                                <span class="price"><i class="fa fa-rupee"></i> <span>198,00</span></span>
                                            </div>
                                        </div><!-- mt product1 center end here -->
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img
                                                                src="http://placehold.it/215x215"
                                                                alt="image description"></a>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                        Cart</span></a></li> 
                                                            <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">Bombi
                                                        Chair</a></strong>
                                                <span class="price"><i class="fa fa-rupee"></i> <span>200,00</span></span>
                                            </div>
                                        </div><!-- mt product1 center end here -->
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img
                                                                src="http://placehold.it/215x215"
                                                                alt="image description"></a>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                        Cart</span></a></li> 
                                                            <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">Bombi
                                                        Chair</a></strong>
                                                <span class="price"><i class="fa fa-rupee"></i> <span>200,00</span></span>
                                            </div>
                                        </div><!-- mt product1 center end here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- related products end here -->
                </div>
            </main><!-- Main of the Page end -->
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
                                        <li><i class="fa fa-envelope-o"></i><a href="../scripts/home.php">rentac01@gmail.com</a>
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
</body>

</html>