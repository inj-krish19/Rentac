<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="shortcut icon" href="../Images/logos/product.jpg" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/icon-fonts.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/search.css">
</head>
<body>
    <div class="centerMe">
        <div class="container" style="width:inherit;">
            <div class="mt-holder">
                <a href="#" class="search-close" onclick="window.location.href='../scripts/product.php';"><span></span><span></span></a>
                <div class="mt-frame">
                    <form action="../scripts/product.php" method="get">
                        <fieldset>
                            <input type="text" name="search" id="searchInput" placeholder="Search...">
                            <a onclick="redirectToSearch()" class="icon-magnifier"></a>
                            <span class="icon-microphone"></span>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/search.js"></script>
    <script src="../js/clear console.js"></script>
</body>
</html>