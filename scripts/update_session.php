<?php
session_start();
if( (!isset($_SESSION["user"])) || $_SESSION["user"] == "guest" ){
    // $_SESSION["user"] = 1;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['res_id']) && isset($_POST['res_level'])) {
        $res_id = filter_var($_POST['res_id'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $res_level = filter_var($_POST['res_level'], FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['udV'] = $res_id;
        $_SESSION['udQ'] = $res_level;
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid parameters"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
echo "<script> setTimeout(() => { window.location.href = '../scripts/product.php'; }, 3000);  </script>";

?>
