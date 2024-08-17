<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="shortcut icon" href="../Images/logos/detail.jpg" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/icon-fonts.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>
    <div id="wrapper">
        <?php
            if (empty($_REQUEST["pid"])) {
                echo "<script> setTimeout(() => { window.location.href = '../scripts/product.php'; }, 3000 ); </script>";
                exit;
            }

            require_once("connection.php");
            $pid = mysqli_real_escape_string($conn, $_REQUEST["pid"]);

            $query = "SELECT productid, product_name, price, description, image_path FROM product WHERE productid = '$pid'";
            $result = mysqli_query($conn, $query);
            
            if (mysqli_num_rows($result) > 0) {
                $record = mysqli_fetch_assoc($result);
                echo "<script> document.title = '". $record["product_name"] ."' </script>";
            } else {
                echo "<script> setTimeout(() => { window.location.href = '../scripts/product.php'; }, 3000 ); </script>";
                exit;
            }
            
            $reco = (float) $record["price"];
            $sql_related = "SELECT productid, product_name, price, image_path FROM product WHERE productid != $pid AND ( productid > $pid or productid > 207) LIMIT 6";
            $result_related = mysqli_query($conn, $sql_related);

            if (!$result_related) {
                die('Error fetching related products: ' . mysqli_error($conn));
            }

            mysqli_close($conn);
        ?>
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
                                    <li><a href="../scripts/home.php">HOME <i class="fa fa-angle-down hidden-lg hidden-md"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="../scripts/product.php">PRODUCTS <i
                                                class="fa fa-angle-down hidden-lg hidden-md" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="drop">
                                        <a href="#">Events <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        <div class="mt-dropmenu text-left" style="left:60%; right:0%;">
                                            <div class="mt-frame" style="max-width: 500px; width: 300px; padding: 15px;">
                                                <div class="mt-col-3">
                                                    <div class="sub-dropcont">
                                                        <strong class="title"><a href="product.php"
                                                                class="mt-subopener">Social
                                                                Events</a></strong>
                                                        <div class="sub-drop">
                                                            <ul>
                                                                <li><a href="../scripts/product.php?event=birthday">Birthday</a></li>
                                                                <li><a href="../scripts/product.php?event=seminar">Seminar</a></li>
                                                                <li><a href="../scripts/product.php?event=party">Party</a></li>
                                                                <li><a href="../scripts/product.php?event=wedding">Wedding</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="mt-mdropover"></span>
                                    </li>
                                    <li><a href="../pages/aboutus.html">About</a></li>
                                    <li><a href="../pages/contactus.html">Contact <i class="fa fa-angle-down hidden-lg hidden-md"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="../scripts/trackorder.php"><i class="icon-handbag"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <span class="mt-side-over"></span>
        </header>
        <main id="mt-main">
            <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h1>Product Details</h1>
                            <nav class="breadcrumbs">
                                <ul class="list-unstyled">
                                    <li><a href="../scripts/home.php">home <i class="fa fa-angle-right"></i></a></li>
                                    <li><a href="../scripts/product.php">product <i class="fa fa-angle-right"></i></a></li>
                                    <li>Product Details</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mt-product-detial" style="margin-bottom:3%;">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="slider">
                                <div class="product-slider">
                                    <div class="slide">
                                        <img src="<?php echo "../" . $record["image_path"]; ?>"
                                            style="margin-top: 50px;width:400px; height:350px;" alt="Product Image">
                                    </div>
                                </div>
                            </div>
                            <div class="detial-holder">
                                <ul class="list-unstyled breadcrumbs">
                                    <li><a href="product.php">Product <i class="fa fa-angle-right"></i></a></li>
                                    <li><a href="product.php">Category <i class="fa fa-angle-right"></i></a>
                                    </li>
                                    <li><a href="product.php">Event <i class="fa fa-angle-right"></i></a></li>
                                </ul>
                                <h2><?php echo $record["product_name"]; ?></h2>
                                <div class="text-holder">
                                    <span class="price"><i class="fa fa-rupee"></i> <?php echo $record["price"]; ?></span>
                                </div>
                                <div class="row-val">
                                    <h3><?php   echo $record['description'];   ?></h3>
                                    <button type="submit" style=" width: 173px;
                                        padding: 12px 10px 10px;
                                        margin-top:30px;
                                        text-align: center;
                                        text-transform: uppercase;
                                        display: block;
                                        font-size: 14px;
                                        line-height: 20px;
                                        font-family: 'Montserrat', sans-serif;
                                        font-weight: 700;
                                        border: none;
                                        outline: none;
                                        border-radius: 25px;
                                        -webkit-transition: all 0.25s linear;
                                        -o-transition: all 0.25s linear;
                                        transition: all 0.25s linear;
                                        background: #ff8283;
                                        color: #fff;"
                                        onclick="window.location.href='cart.php?pid=<?php  echo $record['productid'];   ?>'">ADD TO CART</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="related-products wow fadeInUp" data-wow-delay="0.4s">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2>RELATED PRODUCTS</h2>
                            <div class="row">
                            <ul class="mt-holder" style="display: flex;flex-wrap: wrap;justify-content: space-around;align-items: center;list-style: none;">    
                            <?php while ($row = mysqli_fetch_assoc($result_related)) : ?>
                                    <li>
                                        <div class="product-3">
                                            <div class="img" style="height:300px; width:300px;">
                                                <img alt="Preview Unavailable" src="<?php echo "../" . $row["image_path"]; ?>">
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><?php echo $row["product_name"]; ?></strong>
                                                <span class="price"><i class="fa fa-rupee"></i> <?php echo $row["price"]; ?>.00 </span>
                                            </div>
                                            <ul class="links">
                                                <li><a href="cart.php?pid=<?php echo $row['productid']; ?>"><i class="icon-handbag"></i></a></li>
                                                <li><a href="productdetail.php?pid=<?php echo $row['productid']; ?>" class="lightbox"><i class="icomoon icon-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                href="../scripts/home.php">+1 XX
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
            </footer>
        </div>
        <span id="back-top" class="fa fa-arrow-up"></span>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/clear console.js"></script>
    <script src="../js/jquery.main.js"></script></body>
</html>