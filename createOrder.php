<?php
    include "includes/validateAuth.php";
    include 'includes/config.php';
    include 'includes/utils.php';

    if(isset($_POST["cart_id"])){
        $userID = $_SESSION['userID'];
        $cart_id = $_POST["cart_id"];
    
        $fullname = $_POST["fullname"];
        $address = $_POST["address"];
        $country = $_POST["country"];
        $countryCode = $_POST["countryCode"];
        $phoneNumber = $_POST["phoneNumber"];
        $currentCurrency = $_POST["currency"];
        $payment = "";
        $totalPrice = 0;

        $sql = "SELECT cart_items.quantity,products.price,products.discount, product_items.quantity AS total_quantity,data FROM cart_items,products,product_items WHERE cart_id='$cart_id' AND products.prod_id=cart_items.prod_id AND prod_item_id=product_items.item_id";
        $result = mysqli_query($db, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cart_item_quantity = $row['quantity'];
                $product_price = $row['price'];
                $product_discount = $row['discount'];
                $product_total_quantity = $row['total_quantity'];
                if($cart_item_quantity > $product_total_quantity){
                    $cart_item_quantity = $product_total_quantity;
                    $sql2 = "UPDATE cart_items SET quantity='$product_total_quantity' WHERE item_id='$cart_item_id'";
                    $result2 = mysqli_query($db, $sql2);
                }

                $basePrice = $product_price - $product_discount;
                $totalPrice = $totalPrice + ($basePrice * $cart_item_quantity);
            }
        }

        if($currentCurrency != "LBP"){
            $payment = "$totalPrice$";
        }else {
            $payment = "LBP " . number_format($totalPrice * GetConversionRate('LBP'));
        }

        $sql2 = "INSERT INTO orders(`user_id`,cart_id,fullname,address,country,countryCode,number,payment) VALUE ('$userID', '$cart_id', '$fullname', '$address', '$country', '$countryCode', '$phoneNumber', '$payment')";
        $result2 = mysqli_query($db, $sql2);
        if($result2){
            $order_id = mysqli_insert_id($db);
            $sql2 = "UPDATE cart SET `user_id`='-1' WHERE cart_id=$cart_id";
            $result2 = mysqli_query($db, $sql2);
            header("location:viewOrder.php?id=" . $order_id);
            die();
        }else {
            echo json_encode(array('state' => "FAIL"));
            die();
        }
    }
    echo json_encode(array('state' => "FAIL"));
    die();
?>