<?php
include "includes/validateAuth.php";
include 'includes/config.php';

$userID = $_SESSION['userID'];

$currentOrderID = $_GET["id"] ?? -1;

$currentCartID = -1;
$totalCartItems = 0;
$sql = "SELECT * FROM orders WHERE `user_id`='$userID' AND order_id='$currentOrderID'";
if(isset($_SESSION['type']) && $_SESSION['type'] != "admin"){
    $sql = "SELECT * FROM orders WHERE `order_id`='$currentOrderID'";
}

$result = mysqli_query($db, $sql);

$fullname = "";
$address = "";
$country = "";
$countryCode = "";
$phoneNumber = "";
$state = "";
$payment = "";
$driver_id = -1;
$driver_fullname = "Not Yet Assigned";
$date = "";
$user_id = 0;

if($result){
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $user_id = $row["user_id"];
            $currentCartID = $row["cart_id"];
            $fullname = $row["fullname"];
            $address = $row["address"];
            $country = $row["country"];
            $countryCode = $row["countryCode"];
            $phoneNumber = $row["number"];
            $payment = $row["payment"];
            $state = $row["state"];
            $driver_id = $row["driver"];
            $date = $row["date"];
        }
    }
}

if($currentCartID != -1){
    $sql = "SELECT item_id FROM cart_items WHERE cart_id='$currentCartID'";
    $result = mysqli_query($db, $sql);
    if($result){
        $totalCartItems = mysqli_num_rows($result);
    }
    $sql = "SELECT fullname FROM users WHERE `userid`='$driver_id'";
    $result = mysqli_query($db, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $driver_fullname = $row["fullname"];
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Cart</title>

    <link href="css/cart.css" rel="stylesheet" media="screen">

    <?php include "header.php"; ?>
</head>
<body>
    <div class="cart">
        <div class="cart-container">
            <div class="header">
                <h3 class="heading">Order Summary</h3>
            </div>
            <div class="header2">
                <p>User ID: <?= $user_id ?></p>
                <p>Fullname: <?= $fullname ?></p>
                <p>Deliver To: <?= $country ?>, <?= $address ?></p>
                <p>Phone Number: (+<?= $countryCode ?>) <?= $phoneNumber ?></p>
                <p>Order Date: <?= $date ?></p>
                <p>Delivery State: <?= $state ?></p>
                <p>Assigned Driver: <?= $driver_fullname ?></p>
            </div>
            <br>
            <div class="header">
                <h3 class="heading">Items Summary</h3>
            </div>
            <?php
                if($currentCartID != -1 && $totalCartItems > 0){
                    $sql = "SELECT cart_items.item_id,cart_items.quantity,cart_items.prod_item_id,products.prod_id,products.name AS product_name,products.price,products.discount,product_items.name AS product_item_name, product_items.quantity AS total_quantity,data FROM cart_items,products,product_items WHERE cart_id='$currentCartID' AND products.prod_id=cart_items.prod_id AND prod_item_id=product_items.item_id";
                    $result = mysqli_query($db, $sql);
                    if($result){
                        echo "<table>";
                        while($row = mysqli_fetch_assoc($result)){
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

                            $file = "images/products/" . $product_id . "/items/$product_item_id.jpg";
                            if(!file_exists($file)){//Deletes the image if it exists
                                $file = "images/products/" . $product_id . "/items/$product_item_id.png";
                                if(!file_exists($file)){//Deletes the image if it exists
                                    $file = "images/products/" . $product_id . "/items/$product_item_id.gif";
                                    if(!file_exists($file)){//Deletes the image if it exists
                                        $file = "images/products/default.png";
                                    }
                                }
                            }

                            $basePrice = $product_price - $product_discount;

                            $totalPrice = $basePrice * $cart_item_quantity;

                            echo "<tr>";
                            echo "<td><div class='image-box'>";
                            echo "<img src='$file' style='height: 150px;' alt='Product Cart Image'/>";
                            echo "</div></td>";
                            echo "<td><div class='about'>";
                            echo "<a href='viewProduct.php?id=$product_id' style='text-decoration:none;'><h1 class='title'>$product_name</h1></a>";
                            echo "<h3 class='subtitle'>$product_item_name</h3>";
                            echo "<h3 class='subtitle'>$extra_data</h3>";
                            echo "</div></td>";
                            echo "<td><div class='prices'>";
                            echo "<div class='amount'>$$totalPrice</div>";
                            echo "</div></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }else {
                    //echo "<p>There No Items In Your Cart Yet, Browse Through The Website To Add More!</p>";
                }

            ?>

            <div class="vertical-line"></div>
            <div class="checkout">
                <div class="total">
                    <div>
                        <div class="Subtotal">Total</div>
                        <div class="items" id="total_items"><?= $totalCartItems ?> Items</div>
                    </div>

                    <div class="total-amount2" id="total_price"><?= $payment ?></div>
                </div>
                <div id="gotoCheckoutDiv">
                <?php
                    if($totalCartItems > 0){
                        echo "<button class='button' onclick='OnCheckoutClicked()'>Back To Panel</button>";
                    }else {
                        echo "<button onclick='OnCheckoutClicked()' class='button noselect' style='background-color: #E5E5E5; color: black;'>Back To Panel</button>";
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script>
        function OnCheckoutClicked(){
            window.location.href = "/panel.php";
        }

    </script>
</body>
</html>