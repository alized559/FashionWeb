<?php
include "includes/validateAuth.php";
include 'includes/config.php';

$userID = $_SESSION['userID'];

$currentCartID = -1;
$totalCartItems = 0;
$totalItemsPrice = 0;
$sql = "SELECT cart_id FROM cart WHERE `user_id`='$userID'";
$result = mysqli_query($db, $sql);
if($result){
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $currentCartID = $row["cart_id"];
        }
    }
}

if($currentCartID != -1){
    $sql = "SELECT item_id FROM cart_items WHERE cart_id='$currentCartID'";
    $result = mysqli_query($db, $sql);
    if($result){
        $totalCartItems = mysqli_num_rows($result);
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
                <h3 class="heading">Shopping Cart</h3>
                <?php 
                    if($totalCartItems != 0){
                        echo "<h5 class='action'>Remove all</h5>";
                    }
                ?>
            </div>
            <?php
                if($currentCartID != -1 && $totalCartItems > 0){
                    $sql = "SELECT cart_items.item_id,cart_items.quantity,cart_items.prod_item_id,products.prod_id,products.name AS product_name,products.price,products.discount,product_items.name AS product_item_name, product_items.quantity AS total_quantity,data FROM cart_items,products,product_items WHERE cart_id='$currentCartID' AND products.prod_id=cart_items.prod_id AND prod_item_id=product_items.item_id";
                    $result = mysqli_query($db, $sql);
                    if($result){
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

                            echo "<div class='cart-items'>";
                            echo "<div class='image-box'>";
                            echo "<img src='$file' style='height: 150px;' alt='Product Cart Image'/>";
                            echo "</div>";
                            echo "<div class='about'>";
                            echo "<h1 class='title'>$product_name</h1>";
                            echo "<h3 class='subtitle'>$product_item_name</h3>";
                            echo "<h3 class='subtitle'>$extra_data</h3>";
                            echo "</div>";
                            echo "<div class='counter'>";
                            echo "<div class='btn-minus noselect' data-id='$cart_item_id' data-price='$basePrice'>-</div>";
                            echo "<div class='count noselect'>$cart_item_quantity</div>";
                            echo "<div class='btn-plus noselect' data-id='$cart_item_id' data-max='$product_total_quantity' data-price='$basePrice'>+</div>";
                            echo "</div>";
                            echo "<div class='prices'>";
                            echo "<div class='amount'>$$totalPrice</div>";
                            echo "<div class='remove' data-id='$cart_item_id'><u>Remove</u></div>";
                            echo "</div>";
                            echo "</div>";
                            $totalItemsPrice = $totalItemsPrice + $totalPrice;
                        }
                    }
                }else {
                    echo "<p>There No Items In Your Cart Yet, Browse Through The Website To Add More!</p>";
                }

            ?>

            <div class="vertical-line"></div>
            <div class="checkout">
                <div class="total">
                    <div>
                        <div class="Subtotal">Sub-Total</div>
                        <div class="items" id="total_items"><?= $totalCartItems ?> Items</div>
                    </div>

                    <div class="total-amount" id="total_price">$<?= $totalItemsPrice ?></div>
                </div>

                <button class="button">Checkout</button>
            </div>
        </div>
    </div>

    <script>
        $('.remove').click(function() {
            var $this = $(this);
            var itemID = $(this).data("id");
            var totalPrice = parseFloat($(this).parent().find(".amount").html().replace("$", ""));
            var currentTotal = parseFloat($('#total_price').html().replace("$", "")) - totalPrice;
            $('#total_price').html("$" + currentTotal);
            $(this).parent().parent().remove();
            UpdateCartItem(itemID, 0);
        });
        $('.btn-minus').click(function() {
            var $this = $(this);
            var itemID = $(this).data("id");
            var basePrice = $(this).data("price");
            var counter = $(this).parent().find(".count");
            var currentPriceText = $(this).parent().parent().find(".amount");
            var currentAmount = parseInt(counter.html());
            if(currentAmount > 1){
                var currentTotal = parseFloat($('#total_price').html().replace("$", "")) - basePrice;
                $('#total_price').html("$" + currentTotal);
                currentAmount--;
                counter.html(currentAmount);
                currentPriceText.html("$" + (currentAmount * basePrice));
                UpdateCartItem(itemID, currentAmount);
            }
        });
        $('.btn-plus').click(function() {
            var $this = $(this);
            var itemID = $(this).data("id");
            var basePrice = $(this).data("price");
            var maxAmount = $(this).data("max");
            var counter = $(this).parent().find(".count");
            var currentPriceText = $(this).parent().parent().find(".amount");
            var currentAmount = parseInt(counter.html());
            if(currentAmount < maxAmount){
                var currentTotal = parseFloat($('#total_price').html().replace("$", "")) + basePrice;
                $('#total_price').html("$" + currentTotal);
                currentAmount++;
                counter.html(currentAmount);
                currentPriceText.html("$" + (currentAmount * basePrice));
                UpdateCartItem(itemID, currentAmount);
            }
        });

        function UpdateCartItem(id, amount){
            var xmlhttp = new XMLHttpRequest();
            if(amount > 0){
                xmlhttp.open("GET", "manageCart.php?id=" + id + "&type=edit&amount=" + amount, true);
            }else {
                xmlhttp.open("GET", "manageCart.php?id=" + id + "&type=remove", true);
            }
            xmlhttp.addEventListener('error', handleCartEvent);
            xmlhttp.send();
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var data = JSON.parse(xmlhttp.responseText);
                    if(data.state == "SUCCESS"){
                        console.log("Updated Cart Item Succesfully");
                    }else {
                        console.log("Failed To Update Cart Item");
                    }
                }
            }
        }



        function handleCartEvent(e) {
            alert("Failed To Update Cart, Please Contact The System Administrator.");
        }
    </script>

    <?php include "footer.php"; ?>
</body>
</html>