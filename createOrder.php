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

        $sql = "SELECT cart_items.item_id,cart_items.quantity,cart_items.prod_item_id,products.prod_id,products.name AS product_name,products.price,products.discount,product_items.name AS product_item_name, product_items.quantity AS total_quantity,data FROM cart_items,products,product_items WHERE cart_id='$cart_id' AND products.prod_id=cart_items.prod_id AND prod_item_id=product_items.item_id";
        $result = mysqli_query($db, $sql);
        $cart_items = "";
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cart_item_id = $row['item_id'];
                $cart_item_quantity = $row['quantity'];
                $product_id = $row['prod_id'];
                $product_item_id = $row['prod_item_id'];
                $product_name = $row['product_name'];
                $product_price = $row['price'];
                $product_discount = $row['discount'];
                $product_item_name = $row['product_item_name'];
                $product_total_quantity = $row['total_quantity'];
                $extra_data = $row['data'];
                if($cart_item_quantity > $product_total_quantity){
                    $cart_item_quantity = $product_total_quantity;
                    $sql2 = "UPDATE cart_items SET quantity='$product_total_quantity' WHERE item_id='$cart_item_id'";
                    $result2 = mysqli_query($db, $sql2);
                }

                $sql2 = "UPDATE product_items SET quantity=quantity - $cart_item_quantity WHERE item_id='$product_item_id'";
                $result2 = mysqli_query($db, $sql2);

                $basePrice = $product_price - $product_discount;
                $currentPayment = "";
                $currentPrice = $basePrice * $cart_item_quantity;
                if($currentCurrency != "LBP"){
                    $currentPayment = "$currentPrice$";
                }else {
                    $currentPayment = "LBP " . number_format($currentPrice * GetConversionRate('LBP'));
                }
                $cart_items = $cart_items . "<a href=<qm>viewProduct.php?id=$product_id<qm>>$product_name</a> ($product_item_name, $extra_data) x $cart_item_quantity $currentPayment <ilb>";
                $totalPrice = $totalPrice + $currentPrice;
            }
        }

        if($currentCurrency != "LBP"){
            $payment = "$totalPrice$";
        }else {
            $payment = "LBP " . number_format($totalPrice * GetConversionRate('LBP'));
        }
        echo "$cart_items";
        $sql2 = "INSERT INTO orders(`user_id`,cart_id,fullname,address,country,countryCode,number,payment,cart_items) VALUE ('$userID', '$cart_id', '$fullname', '$address', '$country', '$countryCode', '$phoneNumber', '$payment', '$cart_items')";
        $result2 = mysqli_query($db, $sql2);
        if($result2){
            $order_id = mysqli_insert_id($db);
            $sql2 = "UPDATE cart SET `user_id`='-1' WHERE cart_id=$cart_id";
            $result2 = mysqli_query($db, $sql2);
            header("location:viewOrder.php?id=" . $order_id);
            die();
        }else {
            echo("Error description: " . $db -> error);
            echo json_encode(array('state' => "FAIL"));
            die();
        }
    }
    echo json_encode(array('state' => "FAIL"));
    die();
?>