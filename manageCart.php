<?php
    include "includes/validateAuth.php";
    include 'includes/config.php';

    $userID = $_SESSION['userID'];
    if(isset($_GET["id"])){
        $type = $_GET["type"] ?? "invalid";

        $currentCartID = -1;
        $sql = "SELECT cart_id FROM cart WHERE `user_id`='$userID'";
        $result = mysqli_query($db, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    $currentCartID = $row["cart_id"];
                }
            }
        }

        if($currentCartID == -1){
            $sql = "INSERT INTO cart(`user_id`) VALUE ('$userID')";
            $result = mysqli_query($db, $sql);
            if($result){
                $currentCartID = mysqli_insert_id($db);
            }else {
                echo json_encode(array('state' => "FAIL"));
                die();
            }
        }

        if($type == "add"){
            $prod_id = $_GET["id"];
            $prod_item_id = $_GET["item"];
            $extraData = $_GET["dataName"] . ": " . $_GET["dataValue"];

            $sql = "SELECT item_id FROM cart_items WHERE prod_item_id='$prod_item_id' AND cart_id='$currentCartID' AND data='$extraData'";
            $result = mysqli_query($db, $sql);
            if($result){
                if(mysqli_num_rows($result) == 1) {
                    while($row = mysqli_fetch_assoc($result)){
                        $currentItemID = $row["item_id"];
                        $sql = "UPDATE cart_items SET quantity=quantity+1 WHERE item_id='$currentItemID'";
                        $result = mysqli_query($db, $sql);
                        if($result){
                            echo json_encode(array('state' => "SUCCESS", 'id' => $currentItemID));
                            die();
                        }else {
                            echo json_encode(array('state' => "FAIL"));
                            die();
                        }
                    }
                }else {
                    $sql = "INSERT INTO cart_items(cart_id,prod_id,prod_item_id,data) VALUE ('$currentCartID','$prod_id','$prod_item_id','$extraData')";
                    $result = mysqli_query($db, $sql);
                    if($result){
                        echo json_encode(array('state' => "SUCCESS", 'id' => mysqli_insert_id($db)));
                        die();
                    }else {
                        echo json_encode(array('state' => "FAIL"));
                        die();
                    }
                }
            }

        }else if($type == "edit"){
            $item_id = $_GET["id"];
            $amount = $_GET["amount"];
            $sql2 = "UPDATE cart_items SET quantity='$amount' WHERE item_id='$item_id'";
            $result2 = mysqli_query($db, $sql2);
            if($result2){
                echo json_encode(array('state' => "SUCCESS"));
                die();
            }else {
                echo json_encode(array('state' => "FAIL"));
                die();
            }
        }else if($type == "remove"){
            $item_id = $_GET["id"];
            $sql2 = "DELETE FROM cart_items WHERE item_id='$item_id'";
            $result2 = mysqli_query($db, $sql2);
            if($result2){
                echo json_encode(array('state' => "SUCCESS"));
                die();
            }else {
                echo json_encode(array('state' => "FAIL"));
                die();
            }
        }else if($type == "removeall"){
            $sql2 = "DELETE FROM cart_items WHERE cart_id='$currentCartID'";
            $result2 = mysqli_query($db, $sql2);
            if($result2){
                echo json_encode(array('state' => "SUCCESS"));
                die();
            }else {
                echo json_encode(array('state' => "FAIL"));
                die();
            }
        }
    }
?>