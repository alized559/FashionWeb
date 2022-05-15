<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include '../includes/config.php';

$userID = $_POST["userID"] ?? 0;
$prod_id = $_POST["prod_id"] ?? 0;
$type = $_POST["type"] ?? "remove";

if($type == "add") {
    $text = $_POST["text"];
    $rate = $_POST["rate"];
    $sql = "INSERT INTO reviews(`user_id`,product_id,text,rate) VALUE ('$userID','$prod_id','$text','$rate')";
    $result = mysqli_query($db, $sql);
    if($result){
        echo mysqli_insert_id($db);
    }else {
        die("Error: Database Fatal Error!");
    }
}else {
    $rev_id = $_POST["id"];
    $sql = "DELETE FROM reviews WHERE rev_id='$rev_id' AND `user_id`='$userID' AND `product_id`='$prod_id'";
    $result = mysqli_query($db, $sql);
    if($result){
        die("Success");
    }else {
        die("Error: Database Fatal Error!");
    }
}

?>