<?php
session_start();
require_once("connection.php");

if( (!isset($_SESSION["user"])) || $_SESSION["user"] == "guest" ){
  echo "<script> setTimeout(() => { window.location.href = '../scripts/home.php'; }, 3000);  </script>";
  exit;
}

if (empty($_SESSION["cart_id"])) {
    echo "<script> setTimeout(() => { window.location.href = '../scripts/product.php'; }, 3000);  </script>";
    exit;
}

$cart_id = mysqli_real_escape_string($conn, $_SESSION["cart_id"]);

$query = "
    SELECT C.fname,C.lname,C.email,C.contact_no from customer C where C.customer_id = ". $_SESSION["user"] ."
";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $details = mysqli_fetch_assoc($result);
} else {
    echo "No order details found.";
    exit;
}

$query = "
  select * from cart C,product P where C.product_id =  P.productid and C.cart_id = ". $_SESSION["cart_id"] .";
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $order_details = mysqli_fetch_assoc($result);
} else {
    echo "No order details found.";
    exit;
}

$addressQuery = "select * from address where person_id = ". $_SESSION["user"] ." and person_type = 'Customer' ";

$addressResult = mysqli_query($conn,$addressQuery);

$addressRecord = mysqli_fetch_assoc($addressResult);

// print_r($addressRecord);

// Handle form submission for address details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs
    $errors = [];
    $person_id = mysqli_real_escape_string($conn, $_SESSION["user"]); // Assuming you have stored customer_id in session

    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $district = mysqli_real_escape_string($conn, $_POST["district"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    $street = mysqli_real_escape_string($conn, $_POST["street"]);
    $pincode = mysqli_real_escape_string($conn, $_POST["pincode"]);

    // Simple validation
    if (empty($city)) {
        $errors[] = "City is required.";
    }
    // Add more validation as per your requirements

    if (empty($errors)) {
        // Insert into address table
        $insert_query = "INSERT INTO address (person_id, city, district, country, street, pincode)
                        VALUES (". $_SESSION['user'] .", '$city', '$district', '$country', '$street', '$pincode')";
        
        // echo $insert_query;
        
        mysqli_query($conn,$query);

        if (mysqli_query($conn, $insert_query)) {
            // Redirect to another page after successful insertion
            echo "<script> setTimeout(() => { window.location.href = '../scripts/orderplaced.php'; }, 3000);  </script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        foreach ($errors as $error) {
            // echo "<p>$error</p>";
        }
    }
}

mysqli_close($conn);
?>
<link rel="shortcut icon" href="../Images/logos/bill.jpg" type="image/x-icon">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billing Details</title>
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/icon-fonts.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/responsive.css">
</head>
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
                    <a href="../scripts/home.php"><img src="../Images/logos/Rentac.jpg" alt="Rentac"></a>
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
                  <li><a href="../scripts/home.php">HOME <i class="fa fa-angle-down hidden-lg hidden-md" aria-hidden="true"></i></a></li>
                  <li><a href="../scripts/product.php">PRODUCTS <i class="fa fa-angle-down hidden-lg hidden-md" aria-hidden="true"></i></a></li>
                  <li class="drop">
                    <a href="#">Events <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <div class="mt-dropmenu text-left" style="left:60%; right:0%;">
                      <div class="mt-frame" style="max-width: 500px; width: 300px; padding: 15px;">
                        <div class="mt-col-3">
                          <div class="sub-dropcont">
                            <strong class="title"><a href="product.php" class="mt-subopener">Social Events</a></strong>
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
                  <li><a href="../pages/contactus.html">Contact <i class="fa fa-angle-down hidden-lg hidden-md" aria-hidden="true"></i></a></li>
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
          <form >
            <fieldset>
              <input type="text" required placeholder="Search...">
              <span class="icon-microphone"></span>
              <button class="icon-magnifier" type="submit"></button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
    <main id="mt-main">
      <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h1 class="text-center" style="color:black;">BILLING DETAILS</h1>
              <nav class="breadcrumbs">
                <ul class="list-unstyled">
                  <li><a href="../scripts/home.php" style="color:black;">Home <i class="fa fa-angle-right"></i></a></li>
                  <li style="color:black;">Billing Details</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <div class="mt-process-sec wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <ul class="list-unstyled process-list">
                <li><span class="counter">01</span><strong class="title">Shopping Cart</strong></li>
                <li class="active"><span class="counter">02</span><strong class="title">Billing Details</strong></li>
                <li><span class="counter">03</span><strong class="title">Order Complete</strong></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <section class="mt-detail-sec toppadding-zero wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <h2>BILLING DETAILS</h2>
              <form method="post" class="bill-detail">
                
                <fieldset>
                  <div class="form-group">
                    <div class="col">
                      <input type="text" class="form-control" required placeholder="Name" value="<?php echo $details['fname']; ?>">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" required placeholder="Last Name" value="<?php echo $details['lname']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col">
                      <input type="email" class="form-control" required placeholder="Email Address" value="<?php echo $details['email']; ?>">
                    </div>
                    <div class="col">
                      <input type="tel" class="form-control" required placeholder="Phone Number" value="<?php echo $details['contact_no']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <select class="form-control" required name="country" >
                      <?php if( isset(  $addressRecord['country'] ) ){ echo $addressRecord['country'];  }else{ echo ""; } ?>
                      <option ><?php if( isset(  $addressRecord['country'] ) ){ echo strtoupper($addressRecord['country']);  }else{ echo "Select Country"; } ?></option>
                      <option >India</option>
                      <option >Others</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="street" required placeholder="Street" ><?php if( isset(  $addressRecord['street'] ) ){ echo $addressRecord['street'];  }else{ echo ""; } ?></textarea>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="city" required placeholder="Town / City" value="<?php if( isset(  $addressRecord['city'] ) ){ echo $addressRecord['city'];  }else{ echo ""; } ?>">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="district" required placeholder="State" value="<?php if( isset(  $addressRecord['district'] ) ){ echo $addressRecord['district'];  }else{ echo ""; } ?>">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="pincode" required placeholder="Postal Code" value="<?php if( isset(  $addressRecord['pincode'] ) ){ echo $addressRecord['pincode'];  }else{ echo ""; } ?>">
                  </div>
                  <div class="form-group">
                    <input style=" width: 173px;
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
                                        color: #fff;" type="submit" value="PROCEED">
                  </div>
                </fieldset>
              </form>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="holder">
                <h2>YOUR ORDER</h2>
                <ul class="list-unstyled block">
                  <li>
                    <div class="txt-holder">
                      <div class="text-wrap pull-left">
                        <strong class="title">PRODUCTS</strong>
                        <span><?php echo $order_details['product_name']; ?> x<?php echo $order_details['quantity']; ?></span>
                      </div>
                      <div class="text-wrap txt text-right pull-right">
                        <strong class="title">TOTALS</strong>
                        <span><i class="fa fa-rupee"></i> <?php echo $order_details['amount']; ?></span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">CART SUBTOTAL</strong>
                      <div class="txt pull-right">
                        <span><i class="fa fa-rupee"></i> <?php echo $order_details['amount']; ?></span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">SHIPPING</strong>
                      <div class="txt pull-right">
                        <span>Free Shipping</span>
                      </div>
                    </div>
                  </li>
                  <li style="border-bottom: none;">
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">ORDER TOTAL</strong>
                      <div class="txt pull-right">
                        <span><i class="fa fa-rupee"></i> <?php echo $order_details['amount']; ?></span>
                      </div>
                    </div>
                  </li>
                </ul>
                <h2>PAYMENT METHODS</h2>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          CASH
                          <span class="check"><i class="fa fa-check"></i></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <p>Make your payment directly to delivery person. Please use your order id as the payment reference. Your order won't be replaced after accepting.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex text-left" style="margin-bottom : 10%;">
                  <input type="checkbox" checked> <strong> I've read & accept the <a href="#">terms & conditions</a></strong>
                </div>
                <a href="orderplaced.php" class="process-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>      <!-- footer of the Page -->
     
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
                                        <li><a href="../scripts/orderplaced.php">Order Tracking</a></li>
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
                </div>    <!-- Footer Area of the Page end -->
            </footer><!-- footer of the Page end -->
      <!-- footer of the Page end -->
    </div>
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