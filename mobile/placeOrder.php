<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include '../includes/config.php';
include '../includes/utils.php';

$userID = $_POST['userID'];
$fullname = $_POST["fullname"];
$address = $_POST["address"];
$country = $_POST["country"];
$countryCode = $_POST["countryCode"];
$phoneNumber = $_POST["phoneNumber"];
$currentCurrency = $_POST["currency"] ?? "US, USD";

$currentUserID = -1;
$sql = "SELECT `user_id` FROM address WHERE `user_id`='$userID'";
$result = mysqli_query($db, $sql);
if($result){
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $currentUserID = $row["user_id"];
        }
    }
}

if($currentUserID == -1){
    $sql = "INSERT INTO address(`user_id`) VALUE ('$userID')";
    $result = mysqli_query($db, $sql);
}

$sql2 = "UPDATE address SET fullname='$fullname', address='$address', country='$country', code='$countryCode', phone='$phoneNumber' WHERE `user_id`='$userID'";
$result2 = mysqli_query($db, $sql2);
    
$cart_id = -1;
$sql = "SELECT cart_id,email FROM cart,users WHERE cart.user_id='$userID' AND users.user_id='$userID'";
$result = mysqli_query($db, $sql);
if($result){
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $cart_id = $row["cart_id"];
        }
    }
}

if($cart_id == -1){
    $sql = "SELECT order_id FROM orders where `user_id`='$userID' ORDER BY date DESC LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result){
        $order_id = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $order_id = $row['order_id'];
        }
        die ("" . $order_id);
    } else {
        die("Error");
    }
}else {

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
            if($currentCurrency != "LB, LBP"){
                $currentPayment = "$currentPrice$";
            }else {
                $currentPayment = "LBP " . number_format($currentPrice * GetConversionRate('LBP'));
            }
            $cart_items = $cart_items . "<a href=<qm>viewProduct.php?id=$product_id<qm>>$product_name</a> ($product_item_name, $extra_data) x $cart_item_quantity $currentPayment <ilb>";
            $totalPrice = $totalPrice + $currentPrice;
        }
    }

    if($currentCurrency != "LB, LBP"){
        $payment = "$totalPrice$";
    }else {
        $payment = "LBP " . number_format($totalPrice * GetConversionRate('LBP'));
    }
    $sql2 = "INSERT INTO orders(`user_id`,cart_id,fullname,address,country,countryCode,number,payment,cart_items) VALUE ('$userID', '$cart_id', '$fullname', '$address', '$country', '$countryCode', '$phoneNumber', '$payment', '$cart_items')";
    $result2 = mysqli_query($db, $sql2);
    if($result2){
        $order_id = mysqli_insert_id($db);
        $sql2 = "UPDATE cart SET `user_id`='-1' WHERE cart_id=$cart_id";
        $result2 = mysqli_query($db, $sql2);
        die ("" . $order_id);
    } else {
        die("Error");
    }
}
?>