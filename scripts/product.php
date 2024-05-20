<?php   session_start();    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
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

    require_once("connection.php");

    $query = "select productid,product_name,price,description,image_path from product limit 30";

    if( isset($_REQUEST["category"]) ){
        $tableName = "product_".$_REQUEST["category"]."s";
        $query = "select P.productid,P.product_name,P.price,P.description,P.image_path from product P 
        inner join $tableName on P.productid = product_id limit 30 ";
    }

    if( isset($_REQUEST["event"]) ){

        /*

SELECT P.productid,P.product_name, P.price, P.image_path 
FROM product P 
INNER JOIN (
    SELECT A.product_id 
    FROM product_chairs A 
    INNER JOIN product P ON P.productid = A.product_id 
    WHERE A.event_id = (SELECT event_id FROM event WHERE event_name = 'Party')
    
    UNION ALL 
    
    SELECT B.product_id 
    FROM product_sofas B 
    INNER JOIN product P ON P.productid = B.product_id 
    WHERE B.event_id = (SELECT event_id FROM event WHERE event_name = 'Party')
    
    UNION ALL 
    
    SELECT C.product_id 
    FROM product_tables C 
    INNER JOIN product P ON P.productid = C.product_id 
    WHERE C.event_id = (SELECT event_id FROM event WHERE event_name = 'Party')
) AS A ON P.productid = A.product_id;
        */

        /*

        SELECT COUNT(P.productid) AS total_products
FROM product P
INNER JOIN (
    SELECT product_id
    FROM product_chairs
    WHERE event_id = (SELECT event_id FROM event WHERE event_name = 'Party')
    
    UNION ALL
    
    SELECT product_id
    FROM product_sofas
    WHERE event_id = (SELECT event_id FROM event WHERE event_name = 'Party')
    
    UNION ALL
    
    SELECT product_id
    FROM product_tables
    WHERE event_id = (SELECT event_id FROM event WHERE event_name = 'Party')
) AS A ON P.productid = A.product_id;

*/

        $eventName = $_REQUEST["event"];

        $query = "select P.productid,P.product_name,P.price,P.description,P.image_path from product P inner join (
                    
                    select A.product_id from product_chairs A 
                    inner join product P ON P.productid = A.product_id 
                    where A.event_id = (select event_id from event where event_name = '$eventName')

                union all 

                    select B.product_id from product_sofas B
                    inner join product P ON P.productid = B.product_id 
                    where B.event_id = (select event_id from event where event_name = '$eventName')

                union all 

                    select C.product_id from product_tables C 
                    inner join product P ON P.productid = C.product_id 
                    where C.event_id = (select event_id from event where event_name = '$eventName')
                
                ) as Events on P.productid = Events.product_id limit 30";

    }

    $result = mysqli_query($conn,$query);

?>

<body>
    <!-- main container of all the page elements -->
    <div id="wrapper">
        <!-- Page Loader -->
        <div id="pre-loader" class="loader-container">
            <div class="loader">
                <img src="../images/svg/rings.svg" alt="loader">
            </div>
        </div>
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
                                <div class="mt-logo"><a href="home.html"><img src="../Images/logos/final.png" alt="Rentac"></a></div>
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
                                <ul class="mt-icon-list">
                                    <li class="hidden-lg hidden-md">
                                        <a href="#" class="bar-opener mobile-toggle">
                                            <span class="bar"></span>
                                            <span class="bar small"></span>
                                            <span class="bar"></span>
                                        </a>
                                    </li>
                                    <li><a href="search.php" class="icon-magnifier"></a></li>
                                    <li class="drop">
                                        <a href="cart.php" class="cart-opener">
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
                                            <a class="drop-link" href="home.html">HOME <i
                                                    class="fa fa-angle-down hidden-lg hidden-md"
                                                    aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <a class="drop-link" href="product.html">PRODUCTS <i
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
                                                                            href="product.php?event=birthday">Birthday</a>
                                                                    </li>
                                                                    <li><a href="product.php?event=seminar">Seminar</a>
                                                                    </li>
                                                                    <li><a href="product.php?event=party">Party</a></li>
                                                                    <li><a href="product.php?event=wedding">Wedding</a>
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
                                        <li><a href="about-us.html">About</a></li>
                                        <li>
                                            <a href="contact-us.html">Contact <i
                                                    class="fa fa-angle-down hidden-lg hidden-md"
                                                    aria-hidden="true"></i></a>
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
                        <form action="#">
                            <fieldset>
                                <input type="text" placeholder="Username or email address" class="input">
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
                        <form action="#">
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
                                        <input type="text" placeholder="Username" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" placeholder="Your Email" class="input">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" placeholder="Your Phone" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <textarea placeholder="Address" class="input"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="password" placeholder="Password" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="password" placeholder="Re-type Password" class="input">
                                    </div>
                                </div>
                                <button type="submit" class="btn-type1" style="margin-right: 70%;">Sign Up</button>
                            </fieldset>
                        </form>
                    </div>
                    <!-- mt side widget end here -->
                </div>
                <!-- mt holder end here -->
            </div><!-- mt side menu end here -->
            <!-- mt search popup start here -->
            <div class="mt-search-popup">
                <div class="mt-holder">
                    <a href="#" class="search-close"><span></span><span></span></a>
                    <div class="mt-frame">
                        <form action="search.php">
                            <fieldset>
                                <input type="text" placeholder="Search...">
                                <span class="icon-microphone"></span>
                                <button class="icon-magnifier" type="submit"></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- mt search popup end here -->
            <!-- mt main start here -->
            <main id="mt-main">
                <!-- Mt Contact Banner of the Page -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h1>RENTAC</h1><!-- Breadcrumbs of the Page end -->
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <!-- sidebar of the Page start here -->
                        <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
                            <!-- shop-widget filter-widget of the Page start here -->
                            <section class="shop-widget filter-widget bg-grey">
                                <h2>FILTER</h2>
                                <span class="sub-title">Filter by Events</span>
                                <!-- nice-form start here -->
                                <ul class="list-unstyled nice-form">
                                    <li>
                                        <label for="check-1">
                                            <input id="check-1" checked="checked" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Birthday</span>
                                        </label>
                                        <span class="num">2</span>
                                    </li>
                                    <li>
                                        <label for="check-2">
                                            <input id="check-2" checked="checked" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Seminar</span>
                                        </label>
                                        <span class="num">12</span>
                                    </li>
                                    <li>
                                        <label for="check-3">
                                            <input id="check-3" checked="checked" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Party</span>
                                        </label>
                                        <span class="num">4</span>
                                    </li>
                                    <li>
                                        <label for="check-4">
                                            <input id="check-4" checked="checked" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Wedding</span>
                                        </label>
                                        <span class="num">4</span>
                                    </li>
                                </ul><!-- nice-form end here -->
                                <span class="sub-title">Filter by Price</span>
                                <div class="price-range">
                                    <ul class="list-unstyled nice-form">
                                        <li>
                                            <label for="check-1">
                                                <input id="check-1" type="checkbox">
                                                <span class="fake-input"></span>
                                                <span class="fake-label">10 - 50</span>
                                            </label>
                                            <span class="num">2</span>
                                        </li>
                                        <li>
                                            <label for="check-2">
                                                <input id="check-2" type="checkbox">
                                                <span class="fake-input"></span>
                                                <span class="fake-label">50 - 100</span>
                                            </label>
                                            <span class="num">12</span>
                                        </li>
                                        <li>
                                            <label for="check-3">
                                                <input id="check-3" checked="checked" type="checkbox">
                                                <span class="fake-input"></span>
                                                <span class="fake-label">100 - 200</span>
                                            </label>
                                            <span class="num">4</span>
                                        </li>
                                        <li>
                                            <label for="check-4">
                                                <input id="check-4" type="checkbox">
                                                <span class="fake-input"></span>
                                                <span class="fake-label">200 - 350</span>
                                            </label>
                                            <span class="num">4</span>
                                        </li>
                                        <li>
                                            <label for="check-5">
                                                <input id="check-5" type="checkbox">
                                                <span class="fake-input"></span>
                                                <span class="fake-label">350 - 750</span>
                                            </label>
                                            <span class="num">6</span>
                                        </li>
                                        <li>
                                            <label for="check-6">
                                                <input id="check-6" type="checkbox">
                                                <span class="fake-input"></span>
                                                <span class="fake-label">750 - 1250</span>
                                            </label>
                                            <span class="num">10</span>
                                        </li>
                                        <li>
                                            <label for="check-7">
                                                <input id="check-7" type="checkbox">
                                                <span class="fake-input"></span>
                                                <span class="fake-label">1250 - 2000</span>
                                            </label>
                                            <span class="num">3</span>
                                        </li>
                                    </ul>
                                </div>
                            </section><!-- shop-widget filter-widget of the Page end here -->
                            <!-- shop-widget of the Page start here -->
                            <section class="shop-widget">
                                <h2>CATEGORIES</h2>
                                <!-- category list start here -->
                                <ul class="list-unstyled category-list">
                                    <li>
                                        <a href="product.php?category=chair">
                                            <span class="name">CHAIRS</span>
                                            <span class="num">12</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="product.php?category=sofa">
                                            <span class="name">SOFAS</span>
                                            <span class="num">24</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="product.php?category=table">
                                            <span class="name">TABLES</span>
                                            <span class="num">9</span>
                                        </a>
                                    </li>
                                </ul><!-- category list end here -->
                            </section><!-- shop-widget of the Page end here -->
                        </aside><!-- sidebar of the Page end here -->
                        <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
                            <!-- mt shoplist header start here -->
                            <header class="mt-shoplist-header">
                                <!-- btn-box start here -->
                                <div class="btn-box">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="#" class="drop-link">
                                                Default Sorting <i aria-hidden="true" class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="drop">
                                                <ul class="list-unstyled">
                                                    <li><a href="filter.php?type=asc">Ascending</a></li>
                                                    <li><a href="filter.php?type=desc">Descending</a></li>
                                                    <li><a href="filter.php?type=price">Price</a></li>
                                                    <li><a href="filter.php?type=relevance">Relevance</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-large"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-list"
                                                    aria-hidden="true"></i></a></li>
                                    </ul>
                                </div><!-- mt-textbox end here -->
                            </header><!-- mt shoplist header end here -->
                            <!-- mt productlisthold start here -->
                            <ul class="mt-productlisthold list-inline">
                                <?php   while($record = mysqli_fetch_assoc($result) ){    ?>
                                    <li>
                                        <div class="product-3 mx-2">
                                            <!-- img start here -->
                                            <div class="img" style="height:300px; width:300px;">
                                                <img alt="Preview Unavailable" src="<?php echo "../" . $record["image_path"]; ?>">
                                            </div>
                                            <!-- txt start here -->
                                            <div class="txt">
                                                <strong class="title"><?php echo $record["product_name"]; ?></strong>
                                                <span class="price"><i class="fa fa-rupee"></i> <?php echo $record["price"]; ?>.00 </span>
                                            </div>
                                            <!-- <p class="text-left pd-3" style="margin-bottom:auto;"><?php echo $record["description"]; ?></p> -->
                                            <!-- links start here -->
                                            <ul class="links">
                                                <li><a href="addincart.php?pid=<?php echo $record['productid']; ?>"><i class="icon-handbag"></i></a></li>
                                                <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div><!-- mt product 3 end here -->
                                    </li>
                                <?php   }   ?>
                            </ul><!-- mt productlisthold end here -->
                        </div>
                    </div>
                </div>
            </main><!-- mt main end here -->
            <!-- footer of the Page -->
            <footer id="mt-footer" class="style1 wow fadeInUp" data-wow-delay="0.4s">
                <!-- Footer Holder of the Page -->
                <div class="footer-holder dark">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
                                <!-- F Widget About of the Page -->
                                <div class="f-widget-about">
                                    <div class="logo">
                                        <a href="index.html"><img src="../Images/logos/final.png" alt="Rentac"></a>
                                    </div>
                                    <p>Exercitation ullamco laboris nisi ut aliquip ex commodo consequat. Duis aute
                                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                        nulla pariatur.</p>
                                </div>
                                <!-- F Widget About of the Page end -->
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
                                <!-- Footer Tabs of the Page -->
                                <div class="f-widget-tabs">
                                    <h3 class="f-widget-heading">Product Tags</h3>
                                    <ul class="list-unstyled tabs">
                                        <li><a href="product.php?category=sofa">Sofas</a></li>
                                        <li><a href="product.php?category=chair">Chairs</a></li>
                                        <li><a href="product.php?category=table">Tables</a></li>
                                        <li><a href="product.php?event=birthday">Birthday</a></li>
                                        <li><a href="product.php?event=seminar">Seminar</a></li>
                                        <li><a href="product.php?event=wedding">Wedding</a></li>
                                        <li><a href="product.php?event=marriage">Marriage</a></li>
                                        <li><a href="product.php?event=party">Party</a></li>
                                    </ul>
                                </div>
                                <!-- Footer Tabs of the Page -->
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 text-right">
                                <!-- F Widget About of the Page -->
                                <div class="f-widget-about">
                                    <h3 class="f-widget-heading">Information</h3>
                                    <ul class="list-unstyled address-list align-right">
                                        <li><i class="fa fa-map-marker"></i>
                                            <address>Connaugt Road Central Suite 18B, 148 <br>New Yankee</address>
                                        </li>
                                        <li><i class="fa fa-phone" style="margin-bottom: 1%;"></i><a
                                                href="tel:15553332211">+1 XX XX XX XX</a>
                                        <li><i class="fa fa-envelope-o"></i><a
                                                href="../pages/home.html">rentac01@gmail.com</a></li>
                                    </ul>
                                </div>
                                <!-- F Widget About of the Page end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Holder of the Page end -->
                <!-- Footer Area of the Page -->
                <div class="footer-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <p>© <a href="home.html">Rentac</a> - All rights Reserved</p>
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
    <!-- include jQuery -->
    <script src="../js/jquery.main.js"></script>
</body>

</html>