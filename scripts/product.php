<?php   session_start();    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="shortcut icon" href="../Images/logos/product.jpg" type="image/x-icon">
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

    $notFound = true;

    require_once("connection.php");

    $query = "select productid,product_name,price,description,image_path from product ";

    if( isset($_REQUEST["category"]) ){
        
        $tableName = "product_".$_REQUEST["category"]."s";
        $query = "select P.productid,P.product_name,P.price as 'price',P.description,P.image_path from product P 
        inner join $tableName on P.productid = product_id ";
    
    }

    if( isset($_REQUEST["event"]) ){

        $eventName = $_REQUEST["event"];
        $query = "select P.productid,P.product_name,P.price as 'price',P.description,P.image_path from product P inner join (
                    
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
                
                ) as Events on P.productid = Events.product_id";

    }

    if(
        isset($_REQUEST["category"])       &&
        isset($_REQUEST["event"])    
    ){

        $tableName = "product_".$_REQUEST["category"]."s";
        $eventName = $_REQUEST["event"];
        $query = "select P.productid,P.product_name,P.price as 'price',P.description,P.image_path from product P 
                inner join $tableName on P.productid = product_id where 
                event_id = (select event_id from event where event_name = '$eventName') ";
    }

    if( isset($_REQUEST["range"]) ){
        
        if(
            empty($_REQUEST["category"])    &&    
            empty($_REQUEST["event"])       &&
            empty($_REQUEST["type"])       
        ){
            $query = $query . " where price between " . $_REQUEST["range"];
        }
        else{
            $query = $query . " and price between " . $_REQUEST["range"];
        }
        // echo $query;
    }
    
    if( isset($_REQUEST["type"]) ){
        
        if( $_REQUEST["type"] == "ecn" ){
            $query = $query . " order by price";
        }

        
        if( $_REQUEST["type"] == "pre" ){
            $query = $query . " order by price desc";
        }
        
    }
    
    $result = mysqli_query($conn,$query);

?>

<?php

    function makeUrl($phrase){


        parse_str($phrase, $newParams);

        // Parse the existing query string into an associative array
        parse_str($_SERVER["QUERY_STRING"], $currentParams);

        // Merge the current query parameters with the new one(s)
        $mergedParams = array_merge($currentParams, $newParams);

        // Build the new query string
        $newQueryString = http_build_query($mergedParams);

        // Construct the new URL
        $newUrl = $_SERVER["PHP_SELF"] . "?" . $newQueryString;

        echo $newUrl;

    }

    // print_r($_SERVER);

    // makeUrl("");

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
                                <div class="mt-logo"><a href="../scripts/home.php"><img src="../Images/logos/Rentac.jpg" alt="Rentac"></a></div>
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
                                            <a href="../pages/../scripts/home.php">HOME <i
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
                                    <?php 

                                        $events = array("Birthday","Seminar","Party","Wedding");
                                    
                                        foreach ($events as $keyE => $event) {
                                    
                                            $eventQuery = "select COUNT(P.productid) as '$event'
                                                        from product P
                                                        inner join (
                                                            select product_id
                                                            from product_chairs
                                                            where event_id = (select event_id from event where event_name = '$event')
                                                            
                                                            union all
                                                            
                                                            select product_id
                                                            from product_sofas
                                                            where event_id = (select event_id from event where event_name = '$event')
                                                            
                                                            union all
                                                            
                                                            select product_id
                                                            from product_tables
                                                            where event_id = (select event_id from event where event_name = '$event')
                                                        ) as Event ON P.productid = Event.product_id";

                                                $eventResult = mysqli_query($conn,$eventQuery);

                                                $eventRecord = mysqli_fetch_assoc($eventResult);

                                                $eventRecord = $eventRecord[$event];

                                    ?>
                                        <li>
                                            <span class="fake-label"><a href = <?php makeUrl("event=".strtolower($event)); ?> > <?php    echo $event;   ?> </a></span>
                                            <span class="num"> <?php echo $eventRecord;    ?> </span>
                                        </li>
                                    <?php 
                                        } 
                                    ?>
                                </ul><!-- nice-form end here -->
                                <span class="sub-title">Filter by Price</span>
                                <div class="price-range">
                                    <ul class="list-unstyled nice-form">
                                        <?php 
                                            $lower = array(10,50,100,200,350,750,1250);
                                            $upper = array(50,100,200,350,750,1250,2000);

                                            for ($keyR=0; $keyR < count($lower); $keyR++) {

                                                $rangeQuery = "select COUNT(P.productid) as 'rangeCount'
                                                        from product P where price between  $lower[$keyR] and $upper[$keyR] ";

                                                $rangeResult = mysqli_query($conn,$rangeQuery);

                                                $rangeRecord = mysqli_fetch_assoc($rangeResult);

                                                $rangeCount = $rangeRecord["rangeCount"];
                                        ?>
                                            <!-- <label for="check-<?php /*echo $keyR+1;    ?>">
                                                <input id="check-<?php echo $keyR+1; ?>" checked="checked" type="checkbox">
                                                <span class="fake-input"></span>
                                                <span class="fake-label"> <?php echo $lower[$keyR] ?> - <?php echo $upper[$keyR] ?> </span>
                                            </label>
                                            <span class="num"> <?php echo $rangeCount;  */ ?> </span> -->
                                            <li>
                                                <span class="fake-label"><a href = <?php makeUrl("range="."$lower[$keyR] and $upper[$keyR]"); ?> > <?php    echo $lower[$keyR] ?> - <?php echo $upper[$keyR]   ?> </a></span>
                                                <span class="num"> <?php echo $rangeCount;    ?> </span>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </section><!-- shop-widget filter-widget of the Page end here -->
                            <!-- shop-widget of the Page start here -->
                            <section class="shop-widget">
                                <h2>CATEGORIES</h2>
                                <!-- category list start here -->
                                <ul class="list-unstyled category-list">
                                <?php 

                                    $categories = array("CHAIRS","SOFAS","TABLES");
                                
                                    foreach ($categories as $key => $category) {
                                    
                                        $categoryTable = "product_".$category;

                                        $categoryQuery = "select COUNT(*) as '$category'
                                                          from $categoryTable";

                                                $categoryResult = mysqli_query($conn,$categoryQuery);

                                                $categoryRecord = mysqli_fetch_assoc($categoryResult);

                                                $categoryRecord = $categoryRecord[$category];
                                ?>
                                
                                    <li>
                                        <a href="<?php  echo makeUrl("category=". strtolower(substr($category,0,strlen($category)-1))); ?>">
                                            <span class="name"> <?php   echo $category;  ?> </span>
                                            <span class="num"> <?php    echo $categoryRecord;   ?></span>
                                        </a>
                                    </li>

                                <?php
                                    }
                                ?> 
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
                                                    <li><a href= <?php makeUrl("type="."ecn"); ?> > Economical </a></li>
                                                    <li><a href= <?php makeUrl("type="."pre"); ?> > Premium </a></li>
                                                    <li><a href= "../scripts/product.php" > Reset Filter </a></li>
                                                    <!-- <li><a href="?type=price">Name</a></li>
                                                    <li><a href="?type=relevance">Relevance</a></li> -->
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </header><!-- mt shoplist header end here -->
                        </div><!-- mt-textbox end here -->
                            <!-- mt productlisthold start here -->
                            <ul class="mt-holder" style="display: flex; flex-wrap: wrap; justify-content: space-around; align-items: center;">
                            <!-- <ul class="productlist list-inline"> -->
                                <?php   while($record = mysqli_fetch_assoc($result) ){  $notFound = false;  ?>
                                    <li>
                                        <!-- <div class="mt-product1"> -->
                                        <div class="product-3">
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
                                                <li><a href="productdetail.php?pid=<?php echo $record['productid']; ?>" class="lightbox"><i class="icomoon icon-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div><!-- mt product 3 end here -->
                                    </li>
                                <?php   }   ?>
                                <?php   if($notFound){  ?>
                                    <div class="mx-3 my-3" style="color:#868686;"><h1 style=" font-weight : 900;"> Record Not Found </h1></div>
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
                                        <a href="index.html"><img src="../Images/logos/Rentac.jpg" alt="Rentac"></a>
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
                                        <li><a href=<?php  makeUrl("category=sofa");  ?> >Sofas</a></li>
                                        <li><a href=<?php  makeUrl("category=chair");  ?> >Chairs</a></li>
                                        <li><a href=<?php  makeUrl("category=table");  ?> >Tables</a></li>
                                        <li><a href=<?php  makeUrl("event=birthday");  ?> >Birthday</a></li>
                                        <li><a href=<?php  makeUrl("event=seminar");  ?> >Seminar</a></li>
                                        <li><a href=<?php  makeUrl("event=wedding");  ?> >Wedding</a></li>
                                        <li><a href=<?php  makeUrl("event=wedding");  ?> >Marriage</a></li>
                                        <li><a href=<?php  makeUrl("event=party");  ?> >Party</a></li>
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
                                            <address>Department of Computer Science, Gujarat University, Ahmedabad - 384002</address>
                                        </li>
                                        <li><i class="fa fa-phone" style="margin-bottom: 1%;"></i><a
                                                href="tel: 1 XX XX XX XX">+1 XX XX XX XX</a>
                                        <li><i class="fa fa-envelope-o"></i><a
                                                href="../pages/../scripts/home.php">rentac01@gmail.com</a></li>
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
                                <p>© <a href="../scripts/home.php">Rentac</a> - All rights Reserved</p>
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