<?php 
include "includes/validateAuth.php";
include 'includes/config.php';
include_once "includes/utils.php";

$userID = $_SESSION['userID'];

$currentCurrency = $_GET['currency'] ?? 'US, USD';

$currentCartID = -1;
$totalCartItems = 0;
$totalItemsPrice = 0;
$currentEmail = "";
$sql = "SELECT cart_id,email FROM cart,users WHERE cart.user_id='$userID' AND users.user_id='$userID'";
$result = mysqli_query($db, $sql);
if($result){
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $currentCartID = $row["cart_id"];
            $currentEmail = $row["email"];
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

$fullname = "";
$address = "";
$country ="Lebanon";
$countryCode = "961";
$phoneNumber = "";
$sql = "SELECT * FROM address WHERE `user_id`='$userID'";
$result = mysqli_query($db, $sql);
if($result){
    if(mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
            $fullname = $row['fullname'];
            $address = $row['address'];
            $country = $row['country'];
            $countryCode = $row['code'];
            $phoneNumber = $row['phone'];
        }
    }
}

if($totalCartItems == 0){
    header("location:cart.php");
    die();
}

// use this to get country code (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
// (+961) Lebanon -> 961

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Checkout</title>
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    <link href="css/popup.css" rel="stylesheet" media="screen">
    <link href="css/checkout.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c530224477.js" crossorigin="anonymous"></script>

</head>
<body>
    <div id="snackbar">Please fill all the info!</div>
    <div class="navbar">
        <div class="help">
            <p>Need Help? <a href="help.php"><u>Chat with us now</u></a></p>
        </div>

        <div class="logo">
            <a href="index.php"><img src="imgs/logo.png"></a>
        </div>

        <div class="secure-checkout">
            <i class="fa fa-lock" style="margin: 4px 5px 0 0;"></i>
            <p>Secure Checkout</p>
        </div>
    </div>

    <div class="title">
        <h1>Checkout</h1>
    </div>

    <div class="checkout">
        <div class="box">
            <div class="leftside">
                <img src="imgs/back.png" alt="Checkout Image">
            </div>

            <div class="rightside">
                <form action="createOrder.php" method="POST">
                    <div class="slideshow-container">
                        <div class="mySlides">
                            <h3>Your Information</h3>

                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <!-- value from php -->
                                <input type="text" value="<?= $fullname ?>" name="fullname" class="form-control" id="fullname" aria-describedby="fullnameHelp" placeholder="Enter your fullname">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" value="<?= $address ?>" name="address" class="form-control" id="address" aria-describedby="addressHelp" placeholder="City, House, Floor, Street Address">
                            </div>

                            <div class="form-group" id="country">
                                <select class="form-control" id="countryname" name="country">
                                    <option value="United States" <?=$country == 'United States' ? ' selected="selected"' : '';?>>United States</option>
                                    <option value="Lebanon" <?=$country == 'Lebanon' ? ' selected="selected"' : '';?>>Lebanon</option>
                                </select>
                            </div>

                            <div class="mobile-number">
                                <div class="form-group" style="width: 100%; margin-right: 20px">
                                    <label for="countryCode">Country Code</label>
                                    <select class="form-control" id="countryCode" name="countryCode">
                                        <option value="961" <?=$countryCode == '961' ? ' selected="selected"' : '';?>>(+961) Lebanon</option>
                                        <option value="1" <?=$countryCode == '1' ? ' selected="selected"' : '';?>>(+1) United States</option>
                                    </select>
                                </div>

                                <div class="form-group" style="width: 100%;">
                                    <label for="number">Mobile Number</label>
                                    <input type="text" value="<?= $phoneNumber ?>" class="form-control" name="phoneNumber" id="number" aria-describedby="numberHelp" placeholder="3 908070">
                                </div>
                            </div>

                            <br>

                            <input type="button" value="Next" name="slide" class="btn next" id="dot" onclick="SendInfo()" style="width: 100%; background-color: black; color: white; height: 45px; border-radius: 10px"/>
                        </div>

                        <div class="mySlides">
                            <h3>Payment Information</h3>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                                <label class="form-check-label" for="inlineRadio1">Cash On Delivery</label>
                            </div>

                            <p class="delivery-name">DHL will deliver your order and you will pay on delivery.</p>

                            <p>
                                Production & Shipping may take up to 10 − 14 days. Designers do their best to craft your items earlier.
                                Every item is handmade and customized to fit your every need. 100% refund and exchange guaranteed
                                within 14 days of receiving item. For more information, please read our policy.
                                <br><br>
                                We are confident that you will love your designer-made apparel. Just in case, you have 14 days for return.
                                Just send us an email with your order number (#) to info@fashion.com”. Include the reason why
                                your outfit did not work and we will take care of the rest.
                            </p>

                            <div class="slide-btns">
                                <input type="button" value="Next" class="btn next" id="dot" onclick="currentSlide(3)" style="width: 100%; background-color: black; color: white; height: 45px; border-radius: 10px"/>
                                <input type="button" value="Back" class="btn back" id="dot" onclick="currentSlide(1)" style="width: 100%; background-color: white; color: black; height: 45px; border-radius: 10px; margin-top: 10px; border: 1px solid black"/>
                            </div>
                        </div>

                        <div class="mySlides">
                            <div class="column">

                                <!-- info from inputs in first and second slides -->

                                <h5>Shipping Contact Info</h5>
                                <p id="shippingInfo">
                                    Ali Zein Al Dine<br>
                                    alized559@gmail.com<br>
                                    (+961) 70156042
                                </p>
                            </div>

                            <div class="column">
                                <h5>Delivery Address</h5>
                                <p id="deliveryAddress">
                                    Beirut...<br>
                                    Lebanon
                                </p>
                            </div>

                            <div>
                                <h5>Payment Method</h5>
                                <p>
                                    Cash On Delivery
                                </p>
                            </div>

                            <div class="slide-btns">
                                <?php echo "<input type='hidden' name='cart_id' value='$currentCartID'>"; ?>
                                <?php echo "<input type='hidden' name='currency' value='$currentCurrency'>"; ?>
                                <button class="btn" id="dot" name="pay" style="width: 100%; background-color: black; color: white; height: 45px; border-radius: 10px">Pay On Delivery</button>
                                <input type="button" value="Back" class="btn back" id="dot" onclick="currentSlide(2)" style="width: 100%; background-color: white; color: black; height: 45px; border-radius: 10px; margin-top: 10px; border: 1px solid black"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="summary">
            <h3>Summary</h3>

            <div class="vertical-line"></div>

            <?php 
            
                if ($currentCartID != -1 && $totalCartItems > 0){
                    $sql = "SELECT cart_items.quantity,cart_items.prod_item_id,products.name AS product_name,products.price,products.discount,product_items.name AS product_item_name, product_items.quantity AS total_quantity,data FROM cart_items,products,product_items WHERE cart_id='$currentCartID' AND products.prod_id=cart_items.prod_id AND prod_item_id=product_items.item_id";
                    $result = mysqli_query($db, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cart_item_quantity = $row['quantity'];
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

                            $basePrice = $product_price - $product_discount;

                            $totalPrice = $basePrice * $cart_item_quantity;

                            echo "<div class='summary-info'>";
                            echo "<div class='name-size'>";
                            echo "$product_name<br>";
                            echo "<span>Qty: $cart_item_quantity, $extra_data, ($product_item_name)</span>";
                            echo "</div>";
                            if($currentCurrency != "LBP"){
                                echo "<span class='price'>$totalPrice$</span>";
                            }else {
                                $totalPrice2 = "LBP " . number_format($totalPrice * GetConversionRate('LBP'));
                                echo "<span class='price'>$totalPrice2</span>";
                            }
                            
                            echo "</div>";

                            $totalItemsPrice = $totalItemsPrice + $totalPrice;
                        }
                    }
                } else {
                    // go shop;
                }

            ?>

            <div class='vertical-line1'></div>
            <div class='price-info'>
                Subtotal
                <span><?php
                    $paymentInfo = "";
                    if($currentCurrency != "LBP"){
                        $paymentInfo = "$totalItemsPrice$";
                        echo "$totalItemsPrice$";
                    }else {
                        $totalPrice2 = "LBP " . number_format($totalItemsPrice * GetConversionRate('LBP'));
                        $paymentInfo = $totalPrice2;
                        echo "$totalPrice2";
                    }
                ?></span>
            </div>
            <a href='cart.php'>Back To Cart</a>
        </div>

    </div>

    <!--<div class="p-2 copyrighttext text-white" style="background-color: #8567FF; margin-top: 20px;">
        <div style="text-align:center;">
            Copyright © 2022
            <a class="text-reset fw-bold" style="color: white;" href="#">fashion.com</a>
        </div>
    </div>-->
</body>

<script>

    var currentEmail = "<?php echo $currentEmail; ?>";
    var currentCartID = "<?php echo $currentCartID; ?>";
    var paymentInfo = "<?php echo $paymentInfo; ?>";

    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function SendInfo(){

        var fullname = $('#fullname').val();
        var address = $('#address').val();
        var number = $('#number').val();

        if (fullname != "" && address != "" && number != "") {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "manageAddress.php?fullname=" + $('#fullname').val() + "&address=" + $('#address').val() + "&country=" + $('#countryname').val() + "&code=" + $('#countryCode').val() + "&number=" + $('#number').val(), true);
            xmlhttp.addEventListener('error', handleAddressEvent);
            xmlhttp.send();
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var data = JSON.parse(xmlhttp.responseText);
                    if(data.state == "SUCCESS"){
                        showSlides(slideIndex = 2);
                        console.log("Updated Address Details Succesfully");
                    }else {
                        console.log("Failed To Update Address Details");
                    }
                }
            }
        }else {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
    }

    function currentSlide(n) {
        if(n == 3){
            $('#shippingInfo').html($('#fullname').val() + "<br>" + currentEmail + "<br>(+" + $('#countryCode').val() + ") " + $('#number').val());
            $('#deliveryAddress').html($('#address').val() + "<br>" + $('#countryname').val());
        }
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {return;}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }

    function handleAddressEvent(e) {
        alert("Failed To Update Cart, Please Contact The System Administrator.");
    }

    /*function CheckoutCompleted(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "createOrder.php?cart_id=" + currentCartID + "&fullname=" + $('#fullname').val() + "&address=" + $('#address').val() + "&country=" + $('#countryname').val() + "&code=" + $('#countryCode').val() + "&number=" + $('#number').val() + "&payment=" + paymentInfo, true);
        xmlhttp.addEventListener('error', handleAddressEvent);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var data = JSON.parse(xmlhttp.responseText);
                if(data.state == "SUCCESS"){
                    console.log("Created Order Succesfully");
                    window.location.href = "/orderDetails.php?id=" + data.id;
                }else {
                    console.log("Failed To Create Order Details");
                }
            }
        }
    }*/

</script>
</html>