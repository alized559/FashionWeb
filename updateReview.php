<?php
    include "includes/validateAuth.php";
    include 'includes/config.php';

    $userID = $_SESSION['userID'];
    if(isset($_GET["id"])){
        $prod_id = $_GET["id"];
        $type = $_GET["type"] ?? "invalid";
        if($type == "add"){
            $text = $_GET["text"];
            $rate = $_GET["rate"];
            if($text == ""){
                $text = "Posted a review.";
            }
            $sql = "INSERT INTO reviews(`user_id`,product_id,text,rate) VALUE ('$userID','$prod_id','$text','$rate')";
            $result = mysqli_query($db, $sql);
            if($result){
                echo json_encode(array('state' => "SUCCESS", 'id' => mysqli_insert_id($db)));
            }else {
                echo json_encode(array('state' => "FAIL"));
            }
        }else {
            $rev_id = $_GET["id"];
            $sql = "SELECT * FROM reviews WHERE `user_id`='$userID' AND rev_id='$rev_id'";
            $result = mysqli_query($db, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0) {
                    $sql = "DELETE FROM reviews WHERE rev_id='$prod_id'";
                    $result = mysqli_query($db, $sql);
                    if($result){
                        echo json_encode(array('state' => "SUCCESS"));
                    }else {
                        echo json_encode(array('state' => "FAIL"));
                    }
                }else {
                    if(isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
                        $sql = "DELETE FROM reviews WHERE rev_id='$prod_id'";
                        $result = mysqli_query($db, $sql);
                        if($result){
                            echo json_encode(array('state' => "SUCCESS"));
                        }else {
                            echo json_encode(array('state' => "FAIL"));
                        }
                    }else {
                        echo json_encode(array('state' => "FAIL"));
                        die("A non admin tried to delete a comment");
                    }
                }
            }
        }
    }
?>