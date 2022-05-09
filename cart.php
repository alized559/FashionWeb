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
                        echo "<h5 class='action' id='removeAll'>Remove all</h5>";
                    }
                ?>
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
                            echo "<a href='viewProduct.php?id=$product_id' style='text-decoration:none; text-align:left;'><h1 class='title' style='text-align:left;'>$product_name</h1></a>";
                            echo "<h3 class='subtitle'>$product_item_name</h3>";
                            echo "<h3 class='subtitle'>$extra_data</h3>";
                            echo "</div></td>";
                            echo "<td><div class='counter'>";
                            echo "<div class='btn-minus noselect' data-id='$cart_item_id' data-price='$basePrice'>-</div>";
                            echo "<div class='count noselect'>$cart_item_quantity</div>";
                            echo "<div class='btn-plus noselect' data-id='$cart_item_id' data-max='$product_total_quantity' data-price='$basePrice'>+</div>";
                            echo "</div></td>";
                            echo "<td><div class='prices'>";
                            echo "<div class='amount'>$$totalPrice</div>";
                            echo "<div class='remove' data-id='$cart_item_id'><u>Remove</u></div>";
                            echo "</div></td>";
                            echo "</tr>";
                            $totalItemsPrice = $totalItemsPrice + $totalPrice;
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
                        <div class="Subtotal">Sub-Total</div>
                        <div class="items" id="total_items"><?= $totalCartItems ?> Items</div>
                    </div>

                    <div class="total-amount" id="total_price">$<?= $totalItemsPrice ?></div>
                </div>
                <div id="gotoCheckoutDiv">
                <?php
                    if($totalCartItems > 0){
                        echo "<button class='button' onclick='OnCheckoutClicked()'>Checkout</button>";
                    }else {
                        echo "<button class='button noselect' style='pointer-events: none; background-color: #E5E5E5; color: black;'>No Items In Your Cart</button>";
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script>
        $('.remove').click(function() {
            var $this = $(this);
            var itemID = $(this).data("id");
            var currentTotalItems = parseInt($('#total_items').html().replace("Items", "")) - 1;
            if(currentCurrency == "LB, LBP"){
                var totalPrice = parseFloat($(this).parent().find(".amount").html().replace("LBP", "").replaceAll(",", ""));
                var currentTotal = parseFloat($('#total_price').html().replace("LBP", "").replaceAll(",", "")) - totalPrice;
                $('#total_price').html(formatMoney("LBP", currentTotal.toFixed(0)));
            }else {
                var totalPrice = parseFloat($(this).parent().find(".amount").html().replace("$", ""));
                var currentTotal = parseFloat($('#total_price').html().replace("$", "")) - totalPrice;
                $('#total_price').html("$" + currentTotal.toFixed(2));
            }
            $('#total_items').html(currentTotalItems + " Items");
            $(this).parent().parent().parent().remove();
            if(currentTotalItems == 0){
                $('#removeAll').remove();
                $("#gotoCheckoutDiv").empty();
                $("#gotoCheckoutDiv").append("<button class='button noselect' style='pointer-events: none; background-color: #E5E5E5; color: black;'>No Items In Your Cart</button>");
            }
            UpdateCartItem(itemID, 0);
        });
        $('#removeAll').click(function() {
            if(currentCurrency == "LB, LBP"){
                $('#total_price').html("LBP 0");
            }else {
                $('#total_price').html("$0.00");
            }
            $('#total_items').html("0 Items");
            $("table").remove();
            $(this).remove();
            $("#gotoCheckoutDiv").empty();
            $("#gotoCheckoutDiv").append("<button class='button noselect' style='pointer-events: none; background-color: #E5E5E5; color: black;'>No Items In Your Cart</button>");
            UpdateCartRemoveAll();
        });
        $('.btn-minus').click(function() {
            var $this = $(this);
            var itemID = $(this).data("id");
            var basePrice = $(this).data("price");
            var counter = $(this).parent().find(".count");
            var currentPriceText = $(this).parent().parent().parent().find(".amount");
            var currentAmount = parseInt(counter.html());
            if(currentAmount > 1){
                if(currentCurrency == "LB, LBP"){
                    var currentTotal = parseFloat($('#total_price').html().replace("LBP", "").replaceAll(",", "")) - (basePrice * ConversionRates[currentCurrency]);
                    $('#total_price').html(formatMoney("LBP", currentTotal.toFixed(0)));
                    currentAmount--;
                    counter.html(currentAmount);
                    currentPriceText.html(formatMoney("LBP", (currentAmount * basePrice * ConversionRates[currentCurrency]).toFixed(0)));
                    UpdateCartItem(itemID, currentAmount);
                }else {
                    var currentTotal = parseFloat($('#total_price').html().replace("$", "")) - basePrice;
                    $('#total_price').html("$" + currentTotal.toFixed(2));
                    currentAmount--;
                    counter.html(currentAmount);
                    currentPriceText.html("$" + (currentAmount * basePrice).toFixed(2));
                    UpdateCartItem(itemID, currentAmount);
                }
            }
        });
        $('.btn-plus').click(function() {
            var $this = $(this);
            var itemID = $(this).data("id");
            var basePrice = $(this).data("price");
            var maxAmount = $(this).data("max");
            var counter = $(this).parent().find(".count");
            var currentPriceText = $(this).parent().parent().parent().find(".amount");
            var currentAmount = parseInt(counter.html());
            if(currentAmount < maxAmount){
                if(currentCurrency == "LB, LBP"){
                    var currentTotal = parseFloat($('#total_price').html().replace("LBP", "").replaceAll(",", "")) + (basePrice * ConversionRates[currentCurrency]);
                    $('#total_price').html(formatMoney("LBP", currentTotal.toFixed(0)));
                    currentAmount++;
                    counter.html(currentAmount);
                    currentPriceText.html(formatMoney("LBP", (currentAmount * basePrice * ConversionRates[currentCurrency]).toFixed(0)));
                    UpdateCartItem(itemID, currentAmount);
                }else {
                    var currentTotal = parseFloat($('#total_price').html().replace("$", "")) + basePrice;
                    $('#total_price').html("$" + currentTotal.toFixed(2));
                    currentAmount++;
                    counter.html(currentAmount);
                    currentPriceText.html("$" + (currentAmount * basePrice).toFixed(2));
                    UpdateCartItem(itemID, currentAmount);
                }
                
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

        function UpdateCartRemoveAll(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "manageCart.php?id=-1&type=removeall", true);
            xmlhttp.addEventListener('error', handleCartEvent);
            xmlhttp.send();
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var data = JSON.parse(xmlhttp.responseText);
                    if(data.state == "SUCCESS"){
                        console.log("Updated Cart Items Succesfully");
                    }else {
                        console.log("Failed To Update Cart Items");
                    }
                }
            }
        }

        function OnCheckoutClicked(){
            window.location.href = "/checkout.php?currency=" + currentCurrency.split(', ')[1];
        }

        function handleCartEvent(e) {
            alert("Failed To Update Cart, Please Contact The System Administrator.");
        }
    </script>
</body>
</html>