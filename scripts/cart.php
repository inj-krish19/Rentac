<?php
session_start();
if( (!isset($_SESSION["user"])) || $_SESSION["user"] == "guest" ){
  echo "<script> setTimeout(() => { window.location.href = '../scripts/home.php'; }, 3000);  </script>";
  exit;
}
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
        return null; 
    } else {
        document.getElementById('error').innerText = "";
        return total.toFixed(2); 
    }
}

  </script>
</head>
<body>
<?php
require_once("connection.php");

try{

if (empty($_REQUEST["pid"])) {
  echo "<script> setTimeout(() => { window.location.href = '../scripts/product.php'; }, 3000);  </script>";
  exit;
}

$pid = mysqli_real_escape_string($conn, $_REQUEST["pid"]);

$query = "SELECT productid, product_name, price, description, quant, image_path FROM product WHERE productid = '$pid'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $record = mysqli_fetch_assoc($result);
} else {
  echo "<script> setTimeout(() => { window.location.href = '../scripts/product.php'; }, 3000);  </script>";
  exit;
}

$quantity = 1; 
$amount = $record['price'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pid = mysqli_real_escape_string($conn, $_POST["pid"]);
    $customer_id = $_SESSION["user"];
    $payment_method = "Cash";

    $query = "SELECT productid, product_name, price FROM product WHERE productid = '$pid'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        $price = $record['price'];
        $quantity = isset($_SESSION["udQ"]) ? $_SESSION["udQ"] : 1;
        $amount = isset($_SESSION["udV"]) ? $_SESSION["udV"] : $quantity * $price;

        $insert_query = "INSERT INTO cart (product_id, customer_id, payment_method, quantity, amount) 
                         VALUES ($pid, $customer_id, 'Cash', '$quantity', '$amount')";

        if (mysqli_query($conn, $insert_query)) {
          $cart_id = mysqli_insert_id($conn);
          $_SESSION["cart_id"] = $cart_id;
          echo "<script> setTimeout(() => { window.location.href = '../scripts/billingdetail.php'; }, 3000);  </script>";
          exit;
        } else {
            echo "Error: " . mysqli_error($conn); 
        }
    } else {
        echo "No product found.";
    }
}

}catch( Exception ){
    echo "<div class='container text-center' style='color:#868686;'> Wait a Minute </div>";
}

mysqli_close($conn);
?>
<div id="wrapper">
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
                <li><a href="../scripts/home.php">HOME</a></li>
                <li><a href="../scripts/product.php">PRODUCTS</a></li>
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
                </li>
                <li><a href="../pages/aboutus.html">About</a></li>
                <li><a href="../pages/contactus.html">Contact</a></li>
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
          <div class="col-xs-12 col-sm-2">
            <strong class="title">PRODUCT</strong>
          </div>
          <div class="col-xs-12 col-sm-4">
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
                    <span class="total-amount"><span id="cart-subtotal"><?php echo $amount; ?></span></span>
                  </div>
                </div>
              </li>
            </ul>
            <form method="post">
              <input type="hidden" name="pid" value="<?php echo $record['productid']; ?>">
              <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
              <button type="submit" class="process-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
            </form>
          </div>
        </div>
      </div>
    </section>

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
  <script src="../js/console clear.js"></script>
  <script src="../js/jquery.main.js"></script>
</body>
</html>