<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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
    <style>
        .mt-holder {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-close {
            display: inline-block;
            cursor: pointer;
        }

        .search-close span {
            display: block;
            width: 20px;
            height: 2px;
            background: #000;
            position: absolute;
            top: 50%;
            left: 96%;
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .search-close span:last-child {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .mt-frame {
            flex-grow: 1;
        }

        fieldset {
            border: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .icon-microphone {
            margin-left: 10px;
            cursor: pointer;
        }

        .icon-magnifier {
            background: none;
            border: none;
            cursor: pointer;
            margin-left: -50px;
        }

        a {
            text-decoration: none;
        }

        .centerMe {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 95vh; /* Full height of the viewport */
            width: 100%;
        }
    </style>
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
