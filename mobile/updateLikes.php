<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include '../includes/config.php';

$userID = $_POST["userID"] ?? 0;
$prod_id = $_POST["prod_id"] ?? 0;
$type = $_POST["type"] ?? "remove";

if(isset($type) && isset($userID) && isset($prod_id)){
    if($type == "add") {
        $sql = "INSERT INTO favorites(`user_id`,product_id) VALUE ('$userID','$prod_id')";
        $result = mysqli_query($db, $sql);
        if ($result) {
            $sql = "UPDATE products SET likes=likes + 1 WHERE prod_id='$prod_id'";
            $result = mysqli_query($db, $sql);
            die("Like Added Successfuly!");
        }else {
            die("Error: Database Fatal Error!");
        }
    }else {
        $sql = "DELETE FROM favorites WHERE `user_id`='$userID' AND product_id='$prod_id'";
        $result = mysqli_query($db, $sql);
        if($result){
            $sql = "UPDATE products SET likes=likes - 1 WHERE prod_id='$prod_id'";
            $result = mysqli_query($db, $sql);
            die("Like Removed Successfuly!");
        }else {
            die("Error: Database Fatal Error!");
        }
    }
}else {
    die("Error: Invalid Request");
}

?>