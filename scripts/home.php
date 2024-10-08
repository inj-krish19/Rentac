<?php session_start();  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="../Images/logos/home.jpg" type="image/x-icon">
    <link
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/icon-fonts.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<?php   require_once("../scripts/connection.php");  ?>
<body class="right-side">
    <div id="wrapper">
        <div id="pre-loader" class="loader-container">
            <div class="loader">
                <img src="../Images/rings.svg" alt="loader">
            </div>
        </div>
        <div class="w1">
            <header id="mt-header" class="style4">
                <div class="mt-bottom-bar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="mt-logo" style="height:50px;    width:50px;">
                                    <a href="../scripts/home.php"><img src="../Images/logos/Rentac.jpg"
                                            alt="Rentac"></a>
                                </div>
                                <ul class="mt-icon-list">
                                    <li class="hidden-lg hidden-md">
                                        <a href="#" class="bar-opener mobile-toggle">
                                            <span class="bar"></span>
                                            <span class="bar small"></span>
                                            <span class="bar"></span>
                                        </a>
                                    </li>
                                </ul>
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
                                            <div class="mt-dropmenu text-left" style="left:60%; right:0%;">
                                                <div class="mt-frame"
                                                    style="max-width: 500px; width: 300px; padding: 15px;">
                                                    <div class="mt-col-3">
                                                        <div class="sub-dropcont">
                                                            <strong class="title"><a href="product.php"
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
                                                    </div>
                                                </div>
                                            </div>
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
                            </div>
                        </div>
                    </div>
                </div>
                <span class="mt-side-over"></span>
            </header>
            <div class="mt-search-popup">
                <div class="mt-holder">
                    <a href="#" class="search-close"><span></span><span></span></a>
                    <div class="mt-frame">
                        <form action="#">
                            <fieldset>
                                <input type="text" placeholder="Search...">
                                <span class="icon-microphone"></span>
                                <button class="icon-magnifier" type="submit"></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <main id="mt-main">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="mt-productsc style2 wow fadeInUp" data-wow-delay="0.4s">
                                <div class="row">
                                    <div class="col-xs-12 mt-heading text-uppercase text-center">
                                        <h2 class="heading">FEATURED PRODUCTS</h2>
                                        <p>FURNITURE DESIGNS IDEAS</p>
                                    </div>
                                </div>
                                <div id="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm" class="row" style="display:flex;   align-items:center; justify-content:space-around;">
                                    <div class="mt-holder"  style="display: flex;flex-wrap: wrap;justify-content: space-around;">
                                    <?php   

                                        $num = array(5,30,55,73,82,110,147,158,172,183,198,210);

                                        for($i=0;$i<12;$i++){   
                                            $queryA = "select productid,product_name,image_path,price,description from product limit ". $num[$i] ." ,1 ";

                                            $resultA = mysqli_query($conn,$queryA);

                                            $recordA = mysqli_fetch_assoc($resultA);
                                    ?>
                                        <div class="mt-product1 large">
                                            <div class="box">
                                                <img alt="image description" src="<?php  echo "../" . $recordA["image_path"] ?>" style="height:290px;   width:275px;">
                                                <ul class="links">
                                                    <li><a href="cart.php?pid=<?php echo $recordA["productid"];  ?>"><i class="icon-handbag"></i></a></li>
                                                    <li><a href="productdetail.php?pid=<?php echo $recordA["productid"];  ?>"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"> <?php echo $recordA["product_name"]; ?> </strong>
                                                <span class="price"><i class="fa fa-rupee"></i>
                                                    <span> <?php echo $recordA["price"]; ?> </span></span>
                                            </div>
                                        </div>
                                    <?php   }   ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-smallproducts wow fadeInUp" data-wow-delay="0.4s">
                                <div class="row">

                                    <?php   
                                        $j = 0;
                                        $num = array(19,77,175,55,141,200,69,156,205,30,112,186);
                                        $events = array("Birthday","Seminar","Wedding","Party");
                                        foreach ($events as $key => $event) {   
                                            ?>
                                    <div class="col-xs-12 col-sm-6 col-md-3 ">
                                        <h3 class="heading"> <?php echo $event; ?> </h3>
                                        <?php   
                                            for($i=0;$i<3;$i++){   
                                                
                                                $queryB = "select productid,product_name,image_path,price,description from product limit ". $num[$j] ." ,1 ";
                                                $resultB = mysqli_query($conn,$queryB);

                                                $recordB = mysqli_fetch_assoc($resultB);

                                        ?>
                                        <div class="mt-product4 mt-paddingbottom20">
                                            <div class="img">
                                                <a href="product.php"><img src="<?php echo "../".$recordB["image_path"];  ?>"
                                                        style=" height:80px; width:80px; " alt="image description"></a>
                                            </div>
                                            <div class="text">
                                                <div class="frame">
                                                    <strong><a href="productdetail.php?pid=<?php echo $recordB["productid"];  ?>"> <?php  echo $recordB["product_name"];  ?> </a></strong>
                                                </div>
                                                <span class="price"><i class="fa fa-rupee"></i> <?php echo $recordB["price"];  ?> </span>
                                            </div>
                                        </div>
                                        <?php
                                            $j++;
                                           }   
                                        ?>
                                    </div>
                                    <?php   }   ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h1 class="text-center" style="color:black; margin-bottom:35px; text-transform: uppercase;font-family: 'Montserrat', sans-serif;">
                    Welcome to Rentac  </h1>
                    <h4 style="line-height : 150%;">At Rentac, we believe that furnishing your space should be easy, flexible, and affordable. 
                        Whether you're looking to furnish your home, office, or event, we have a wide selection of high-quality 
                        furniture to meet your needs. From stylish chairs and tables to comfortable sofas, Rentac offers a convenient 
                        way to transform any space with minimal hassle. </h4>
                <h2  style="color:black; font-family: 'Montserrat', sans-serif;">Our Services </h2>

                <h4> Chairs: From dining chairs to office chairs, we have a variety to suit every style and need.  </h4>
                <h4> Tables: Choose from our selection of coffee tables, dining tables, and desks. </h4>
                <h4> Sofas: Our range includes everything from cozy loveseats to spacious sectional sofas. </h4>
                
                <h2  style="color:black; font-family: 'Montserrat', sans-serif;" >Event Furniture Rentals:</h2>

                <h4> Parties: Create the perfect party atmosphere with our stylish and comfortable furniture. </h4>
                <h4> Birthdays: Make birthdays memorable with furniture that adds to the celebration. </h4>
                <h4> Seminars: Ensure your attendees are comfortable with our professional seminar setups. </h4>
                <h4> Weddings: Design your dream wedding with our elegant and sophisticated furniture options. </h4>
                
                <h2  style="color:black; font-family: 'Montserrat', sans-serif;" >Why Choose Rentac?</h2>          
                <h4> Quality and Style: We offer a curated selection of furniture that is both high-quality and stylish, ensuring your space looks great. </h4>
                <h4> Flexibility: Rent our furniture for as long as you need, with easy options for extending or returning your rental. </h4>
                <h4> Affordability: Enjoy beautiful furniture without the commitment of buying, saving you money and hassle. </h4>
                <h4> Convenience: With our simple online ordering process, getting the furniture you need is just a few clicks away. We also offer delivery and setup services to make your experience seamless. </h4>
                
                <h2  style="color:black; font-family: 'Montserrat', sans-serif;" >How It Works</h2>    
                <h4> Browse: Explore our wide range of furniture online. </h4>
                <h4> Select: Choose the items that best suit your needs. </h4>
                <h4> Schedule: Pick your delivery date and duration of the rental. </h4>
                <h4> Enjoy: Sit back and relax while we deliver and set up your furniture. </h4>
                </div>
            </main>
            <footer id="mt-footer" class="style7 wow fadeInUp" data-wow-delay="0.4s">
                <div class="footer-holder bg-grey">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 mt-paddingbottomsm">
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
                                        <li><i class="fa fa-envelope-o"></i><a href="../scripts/home.php">rentac01@gmail.com</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <nav class="col-xs-12 col-sm-8 col-md-5 mt-paddingbottomsm">
                                <div class="nav-widget-1">
                                    <h3 class="f-widget-heading">Categories</h3>
                                    <ul class="list-unstyled f-widget-nav">
                                        <li><a href="../scripts/product.php?category=chair">Chairs</a></li>
                                        <li><a href="../scripts/product.php?category=sofa">Sofas</a></li>
                                        <li><a href="../scripts/product.php?category=table">Tables</a></li>
                                    </ul>
                                </div>
                                <div class="nav-widget-1">
                                    <h3 class="f-widget-heading">Information</h3>
                                    <ul class="list-unstyled f-widget-nav">
                                        <li><a href="../pages/aboutus.html">About Us</a></li>
                                        <li><a href="../pages/contactus.html">Contact Us</a></li>
                                    </ul>
                                </div>
                                <div class="nav-widget-1">
                                    <h3 class="f-widget-heading">Account</h3>
                                    <ul class="list-unstyled f-widget-nav">
                                        <li><a href="../scripts/userprofile.php">My Account</a></li>
                                        <li><a href="../scripts/trackorder.php">Order Tracking</a></li>
                                        <li><a href="../scripts/cart.php">Shopping Cart</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="footer-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <p>© <a href="../scripts/home.php">Rentac.</a> - All rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </footer>
        </div>
        <span id="back-top" class="fa fa-arrow-up"></span>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/clear console.js"></script>
    <script src="../js/jquery.main.js"></script>
</body>
</html>