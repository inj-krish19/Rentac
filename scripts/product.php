<?php   session_start();    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="shortcut icon" href="../Images/logos/product.jpg" type="image/x-icon">
    <link
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/icon-fonts.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<?php

    $notFound = true;

    require_once("connection.php");

    $query = "SELECT P.productid, P.product_name, P.price AS 'price', P.description, P.image_path FROM product P";

    $joins = [];

    $conditions = [];

    if (isset($_REQUEST["category"])) {
        $tableName = "product_" . $_REQUEST["category"] . "s";
        $joins[] = "INNER JOIN $tableName ON P.productid = product_id";
    }

    if (isset($_REQUEST["event"])) {
        $eventName = $_REQUEST["event"];
        $joins[] = "INNER JOIN (
                    SELECT A.product_id FROM product_chairs A 
                    WHERE A.event_id = (SELECT event_id FROM event WHERE event_name = '$eventName')
                UNION ALL 
                    SELECT B.product_id FROM product_sofas B
                    WHERE B.event_id = (SELECT event_id FROM event WHERE event_name = '$eventName')
                UNION ALL 
                    SELECT C.product_id FROM product_tables C 
                    WHERE C.event_id = (SELECT event_id FROM event WHERE event_name = '$eventName')
                ) AS Events ON P.productid = Events.product_id";
    }

    if (isset($_REQUEST["category"]) && isset($_REQUEST["event"])) {
        $tableName = "product_" . $_REQUEST["category"] . "s";
        $eventName = $_REQUEST["event"];
        $joins = [
            "INNER JOIN $tableName ON P.productid = product_id"
        ];
        $conditions[] = "event_id = (SELECT event_id FROM event WHERE event_name = '$eventName')";
    }

    if (isset($_REQUEST["search"])) {
        $search = $_REQUEST["search"];
        $conditions[] = "(P.product_name LIKE '%$search%' OR P.description LIKE '%$search%')";
    }

    if (isset($_REQUEST["range"])) {
        $range = $_REQUEST["range"];
        $conditions[] = "P.price BETWEEN $range";
    }

    if (!empty($joins)) {
        $query .= " " . implode(" ", $joins);
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    if (isset($_REQUEST["type"])) {
        if ($_REQUEST["type"] == "ecn") {
            $query .= " ORDER BY P.price";
        } elseif ($_REQUEST["type"] == "pre") {
            $query .= " ORDER BY P.price DESC";
        }
    }

    /*$query = "select productid,product_name,price,description,image_path from product ";

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

    if(
        isset($_REQUEST["search"])   
    ){
        if(
            empty($_REQUEST["category"])    &&    
            empty($_REQUEST["event"])       &&
            empty($_REQUEST["type"])        &&
            empty($_REQUEST["range"])        
        ){
            $query = $query . " where product_name like '%" . $_REQUEST["search"] ."%' or description like '%" . $_REQUEST["search"] ."%'";
        }
        else{
            $query = $query . " and price between " . $_REQUEST["search"];
        }

        echo $query;
    }

    if( isset($_REQUEST["range"]) ){
        
        if(
            empty($_REQUEST["category"])    &&    
            empty($_REQUEST["event"])       &&
            empty($_REQUEST["type"])        && 
            empty($_REQUEST["search"])       
        ){
            $query = $query . " where price between " . $_REQUEST["range"];
        }
        else{
            $query = $query . " and price between " . $_REQUEST["range"];
        }
        echo $query;
    }
    
    if( isset($_REQUEST["type"]) ){
        
        if( $_REQUEST["type"] == "ecn" ){
            $query = $query . " order by price";
        }

        
        if( $_REQUEST["type"] == "pre" ){
            $query = $query . " order by price desc";
        }
        
    }   */
    
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

?>

<body>
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
                                    <li><a onclick="window.location.href='search.php'" class="icon-magnifier"></a></li>
                                    <li class="drop">
                                        <a href="../scripts/trackorder.php">
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
                                            <div class="mt-dropmenu text-left" style="left:30%; right:0%;">
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
            <div class="mt-side-menu ">
                <div class="mt-holder">
                    <a href="#" class="side-close"><span></span><span></span></a>
                    <strong class="mt-side-title">MY ACCOUNT</strong>
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
                    <div class="or-divider"><span class="txt">or</span></div>
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
                </div>
            </div>
            <main id="mt-main">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h1>RENTAC</h1>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
                            <section class="shop-widget filter-widget bg-grey">
                                <h2>FILTER</h2>
                                <span class="sub-title">Filter by Events</span>
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
                                </ul>
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
                                            <li>
                                                <span class="fake-label"><a href = <?php makeUrl("range="."$lower[$keyR] and $upper[$keyR]"); ?> > <?php    echo $lower[$keyR] ?> - <?php echo $upper[$keyR]   ?> </a></span>
                                                <span class="num"> <?php echo $rangeCount;    ?> </span>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </section>
                            <section class="shop-widget">
                                <h2>CATEGORIES</h2>
                                <ul class="list-unstyled category-list">
                                <?php 

                                    $categories = array("chairs","sofas","tables");
                                
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
                                </ul>
                            </section>
                        </aside>
                        <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
                            <header class="mt-shoplist-header">
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
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </header>
                        </div>
                        <div>
                            <ul class="mt-holder" style="display: flex; flex-wrap: wrap; justify-content: space-around; align-items: center;list-style :none;">
                                <?php   while($record = mysqli_fetch_assoc($result) ){  $notFound = false;  ?>
                                    <li>
                                        <div class="product-3">
                                            <div class="img" style="height:250px; width:250px;">
                                                <img alt="Preview Unavailable" src="<?php echo "../" . $record["image_path"]; ?>">
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><?php echo $record["product_name"]; ?></strong>
                                                <span class="price"><i class="fa fa-rupee"></i> <?php echo $record["price"]; ?>.00 </span>
                                            </div>
                                            <ul class="links">
                                                <li><a href="cart.php?pid=<?php echo $record['productid']; ?>"><i class="icon-handbag"></i></a></li>
                                                <li><a href="productdetail.php?pid=<?php echo $record['productid']; ?>" class="lightbox"><i class="icomoon icon-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php   }   ?>
                                <?php   if($notFound){  ?>
                                    <div class="mx-3 my-3" style="color:#868686;"><h1 style=" font-weight : 900;"> Record Not Found </h1></div>
                                <?php   }   ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
            <footer id="mt-footer" class="style1 wow fadeInUp" data-wow-delay="0.4s">
                <div class="footer-holder dark">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
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
                                    <p>At Rentac, we believe that furnishing your space should be easy, flexible, and affordable. 
                        Whether you're looking to furnish your home, office, or event, we have a wide selection of high-quality 
                        furniture to meet your needs. From stylish chairs and tables to comfortable sofas, Rentac offers a convenient 
                        way to transform any space with minimal hassle</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
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
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 col-md-3 text-right">
                                <div class="f-widget-about">
                                    <h3 class="f-widget-heading">Information</h3>
                                    <ul class="list-unstyled address-list align-right">
                                        <li><i class="fa fa-map-marker"></i>
                                            <address>Department of Computer Science, Gujarat University, Ahmedabad - 384002</address>
                                        </li>
                                        <li><i class="fa fa-phone" style="margin-bottom: 1%;"></i><a
                                                href="../scripts/home.php">+91 XX XX XX XX</a>
                                        <li><i class="fa fa-envelope-o"></i><a
                                                href="../scripts/home.php">rentac01@gmail.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <p>© <a href="../scripts/home.php">Rentac</a> - All rights Reserved</p>
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