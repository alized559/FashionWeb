<?php
    include "includes/validateAuth.php";
    include 'includes/config.php';

    $userID = $_SESSION['userID'];
    if(isset($_GET["id"])){
        $prod_id = $_GET["id"];
        $type = $_GET["type"] ?? "invalid";
        if($type == "add"){
            $sql = "INSERT INTO favorites(`user_id`,product_id) VALUE ('$userID','$prod_id')";
            $result = mysqli_query($db, $sql);
            if($result){
                $sql = "UPDATE products SET likes=likes + 1 WHERE prod_id='$prod_id'";
                $result = mysqli_query($db, $sql);
            }
        }else {
            $sql = "DELETE FROM favorites WHERE `user_id`='$userID' AND product_id='$prod_id'";
            $result = mysqli_query($db, $sql);
            if($result){
                $sql = "UPDATE products SET likes=likes - 1 WHERE prod_id='$prod_id'";
                $result = mysqli_query($db, $sql);
            }
        }
        header("location:viewProduct.php?id=$prod_id");
        die();
    }
?>