<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="shortcut icon" href="../Images/logos/cart.jpg" type="image/x-icon">
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/icon-fonts.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <script>
   
   
   function updateTotal(price, maxQuantity) {
    let quantity = parseInt(document.getElementById('quantity').value);
    let total = price * quantity;
    document.getElementById('total').innerText = total.toFixed(2);
    document.getElementById('cart-subtotal').innerText = total.toFixed(2);

    $.post("update_session.php", { res_id: total, res_level: quantity })
        .done(function(response) {
            let result = JSON.parse(response);
            if (result.status === "error") {
                document.getElementById('error').innerText = result.message;
            } else {
                document.getElementById('error').innerText = "";
            }
        })
        .fail(function() {
            document.getElementById('error').innerText = "An error occurred while updating the session.";
        });

    if (quantity > maxQuantity) {
        document.getElementById('error').innerText = "Quantity not available";
        document.getElementById('total').innerText = "N/A";
        return null; // Return null if quantity exceeds maxQuantity
    } else {
        document.getElementById('error').innerText = "";
        return total.toFixed(2); // Return the updated total value
    }
}

  </script>
</head>
<body>
<?php
require_once("connection.php");

if (empty($_REQUEST["pid"])) {
    header("Location: ../scripts/product.php");
    exit;
}

$pid = mysqli_real_escape_string($conn, $_REQUEST["pid"]);

$query = "SELECT productid, product_name, price, description, quant, image_path FROM product WHERE productid = '$pid'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $record = mysqli_fetch_assoc($result);
} else {
    header("Location: ../scripts/product.php");
    exit;
}

// Initialize quantity and amount
$quantity = 1; // Default quantity
$amount = $record['price']; // Initial amount based on default quantity

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $pid = mysqli_real_escape_string($conn, $_POST["pid"]);
    
    // Generate a random customer ID (1 to 10)
    $customer_id = mt_rand(1, 10);

    // Assuming payment method is null initially
    $payment_method = null;

    // Query to fetch product details
    $query = "SELECT productid, product_name, price FROM product WHERE productid = '$pid'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        $price = $record['price'];
        $quantity = $_SESSION["udQ"];
        $amount = $_SESSION["udV"];

        // Insert into cart table
        $insert_query = "INSERT INTO cart (product_id, customer_id, payment_method, quantity, amount) 
                         VALUES ('$pid', '$customer_id', '$payment_method', '$quantity', '$amount')";

        if (mysqli_query($conn, $insert_query)) {
          $cart_id = mysqli_insert_id($conn);
          // Redirect to order complete page with cart_id
          header("Location: billingdetail.php?cart_id=" . $cart_id);
          exit;
        } else {
            echo "Error: " . mysqli_error($conn); // Output MySQL error
        }
    } else {
        echo "No product found.";
    }
}

mysqli_close($conn);
?>
<div id="wrapper">
  <header id="mt-header" class="style4">
    <div class="mt-bottom-bar">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="mt-logo"><a href="../scripts/home.php"><img src="../Images/logos/Rentac.jpg" alt="Rentac"></a></div>
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
                <li><a href="../scripts/home.php">HOME</a></li>
                <li><a href="../scripts/product.php">PRODUCTS</a></li>
                <li class="drop">
                  <a href="#">Events <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                  <div class="mt-dropmenu text-left" style="left:60%; right:0%;">
                    <div class="mt-frame" style="max-width: 500px; width: 300px; padding: 15px;">
                      <div class="mt-col-3">
                        <div class="sub-dropcont">
                          <strong class="title"><a href="product-grid-view.html" class="mt-subopener">Social Events</a></strong>
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
                </li>
                <li><a href="aboutus.html">About</a></li>
                <li><a href="contactus.html">Contact</a></li>
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
                                    <li><a href="../scripts/home.php">Home <i class="fa fa-angle-right"></i></a></li>
                                    <li><a href="../scripts/product.php">Product <i class="fa fa-angle-right"></i></a></li>
                                    <li>Cart</li>
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
              <li class="active">
                <span class="counter">01</span>
                <strong class="title">Shopping Cart</strong>
              </li>
              <li>
                <span class="counter">02</span>
                <strong class="title">Billing Details</strong>
              </li>
              <li>
                <span class="counter">03</span>
                <strong class="title">Order Complete</strong>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row border">
          <div class="col-xs-12 col-sm-">
            <strong class="title">PRODUCT</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="title">PRODUCT NAME</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="title">PRICE</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="title">QUANTITY</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="title">TOTAL</strong>
          </div>
        </div>

        <div class="row border">
          <div class="col-xs-12 col-sm-2">
            <div class="img-holder">
              <img src="../<?php echo $record['image_path']; ?>" alt="image description" style="width: 105px; height: 105px;">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <strong class="product-name"><?php echo $record['product_name']; ?></strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="price"><i class="fa fa-rupee"></i> <?php echo $record['price']; ?></strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <form class="qyt-form">
              <fieldset>
                <input type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" min="1" max="<?php echo $record['quant']; ?>" onchange="updateTotal(<?php echo $record['price']; ?>, <?php echo $record['quant']; ?>)">
              </fieldset>
            </form>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="price"><i class="fa fa-rupee"></i> <span id="total"><?php echo $amount; ?></span></strong>
            <a href="product.php"><i class="fa fa-close"></i></a>
            <div id="error" style="color:red;"></div>
          </div>
        </div>

      </div>
    </div>

    <section class="mt-detail-sec style1 wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <h2>CART TOTAL</h2>
            <ul class="list-unstyled block cart">
              <li>  
                <div class="txt-holder">
                  <strong class="title sub-title pull-left">ORIGINAL VALUES</strong>
                  <div class="txt pull-right">
                    <span><i class="fa fa-rupee"></i><?php echo $record['price']; ?></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="txt-holder">
                  <strong class="title sub-title pull-left">SHIPPING</strong>
                  <div class="txt pull-right">
                    <strong>Free Shipping</strong>
                  </div>
                </div>
              </li>
              <li style="border-bottom: none;">
                <div class="txt-holder">
                  <strong class="title sub-title pull-left">CART TOTAL</strong>
                  <div class="txt pull-right">
                    <span> <span id="cart-subtotal"><?php echo $amount; ?></span></span>
                  </div>
                </div>
              </li>
            </ul>
            <form action="cart.php" method="POST">
              <input type="hidden" name="pid" value="<?php echo $record['productid']; ?>">
              <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
              <button type="submit" class="process-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
            </form>
          </div>
        </div>
      </div>
    </section><!-- Mt Detail Section of the Page end -->

  </main><!-- Main of the Page end here -->
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
                                    <p>© <a href="index.html">Rentac.</a> - All rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Area of the Page end -->
            </footer><!-- footer of the Page end -->
      <!-- footer of the Page end -->
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