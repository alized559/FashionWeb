<?php

    session_start();

    $id = $_GET["id"] ?? 0;
    include "includes/config.php";
    if($id == 0){
        die("Invalid Product, No Content Was Found");
    }

    $sql = "SELECT * FROM products WHERE prod_id='$id'";
    $result = mysqli_query($db, $sql);

    $name = "";
    $description = "";
    $details = "";
    $price = 0;
    $delivery_time = 0;
    $discount = 0;
    $likes = 0;
    $department = "m";
    $category = "shoes";
    $brand = "Local Brand";
    $imagefile = "";
    $bannerfile = "";

    $currentUserImageFile = "none";
    $currentUserUsername = "none";
    $didPostReview = false;
    if(isset($_SESSION["userID"])){
        $user_id = $_SESSION["userID"];

        $sql2 = "SELECT username FROM users WHERE `user_id`='$user_id'";
        $result2 = mysqli_query($db, $sql2);
        if($result2){
            if(mysqli_num_rows($result2) == 1) {
                while($row2 = mysqli_fetch_assoc($result2)){
                    $currentUserUsername = $row2['username'];
                }
            }
        }

        $currentUserImageFile = "images/users/$user_id/logo.jpg";
        if(!file_exists($currentUserImageFile)){//Deletes the image if it exists
            $currentUserImageFile = "images/users/$user_id/logo.png";
            if(!file_exists($currentUserImageFile)){//Deletes the image if it exists
                $currentUserImageFile = "images/users/$user_id/logo.gif";
                if(!file_exists($currentUserImageFile)){//Deletes the image if it exists
                    $currentUserImageFile = "images/users/default.png";
                }
            }
        }
    }

    if($result){
        if(mysqli_num_rows($result) == 1){
            while($row = mysqli_fetch_assoc($result)){
                $name = $row["name"];
                $description = $row["description"];
                $details = $row["details"];
                $price = $row["price"];
                $delivery_time = $row["delivery_time"];
                $likes = $row["likes"];
                $discount = $row["discount"];
                $department = $row["department"];
                $category = $row["category"];
                $brand = $row["brand"];

                $file = "images/products/" . $id . "/logo.jpg";

                if(!file_exists($file)){//Deletes the image if it exists
                    $file = "images/products/" . $id . "/logo.png";
                    if(!file_exists($file)){//Deletes the image if it exists
                        $file = "images/products/" . $id . "/logo.gif";
                        if(!file_exists($file)){//Deletes the image if it exists
                            $file = "images/products/default.png";
                        }
                    }
                }
                $imagefile = $file;

                $file = "images/products/" . $id . "/banner.jpg";

                if(!file_exists($file)){//Deletes the image if it exists
                    $file = "images/products/" . $id . "/banner.png";
                    if(!file_exists($file)){//Deletes the image if it exists
                        $file = "images/products/" . $id . "/banner.gif";
                        if(!file_exists($file)){//Deletes the image if it exists
                            $file = "images/products/default.png";
                        }
                    }
                }
                $bannerfile = $file;
            }
        }else {
            die("Invalid Product, Multiple Instances Were Found");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | <?= $name?></title>

    <?php include('header.php') ?>
    <link href="css/viewProduct.css" rel="stylesheet" media="screen">
    <link href="css/heartAnimation.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="image-container">
        <?php 
        echo "<img class='backImg' src='$bannerfile' alt='Background Image'>";
        echo "<img class='productImg' src='$imagefile' alt='Product Image'>";
        ?>
    </div>

    <div class="favorite">
        <?php
            if(isset($_SESSION['userID'])){
                $userID = $_SESSION['userID'];
                $sql = "SELECT * FROM favorites WHERE `user_id`='$userID' AND `product_id`='$id'";
                $result = mysqli_query($db, $sql);
                if($result){
                    if(mysqli_num_rows($result) == 1) {
                        echo "<div class='heart is-active'></div>";
                    } else {
                        echo "<div class='heart'></div>";
                    }
                }
            }else {
                echo "<a href='login.php'><div class='heart'></div></i></a>";
            }
        ?>
        <script>
            var id = "<?php echo $id; ?>";
            $(function() {
                $(".heart").on("click", function() {
                    if($(this).hasClass("is-active"))//Remove
                    {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "updateFavorite.php?id=" + id + "&type=remove", true);
                        xmlhttp.addEventListener('error', handleEvent);
                        xmlhttp.send();
                        $("#totalLikes").html(parseInt($("#totalLikes").html()) - 1);
                    }else {//Add Like
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "updateFavorite.php?id=" + id + "&type=add", true);
                        xmlhttp.addEventListener('error', handleEvent);
                        xmlhttp.send();
                        $("#totalLikes").html(parseInt($("#totalLikes").html()) + 1);
                    }
                    $(this).toggleClass("is-active");
                    
                });
            });
            function handleEvent(e) {
                alert("Failed To Update Like, Please Contact The System Administrator.");
            }
        </script>
    </div>

    <div class="container-fluid">
        <h3 class="product-title"><?= $name?></h3>

        <div class="product-flex">
            <div class="product-default">
                <?php echo "<img id='default-img' src='$imagefile' alt='Product Image'>"; ?>
            </div>

            <div class="product-colors">
                <?php
                    $sql = "SELECT * FROM product_items WHERE product_id='$id'";
                    $result = mysqli_query($db, $sql);
                    $currentIndex = 0;
                    $currentDivIndex = 0;

                    $firstItemName = "";
                    $firstItemQuantity = 0;
                    $firstItemID = -1;

                    if($result){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $itemID = $row["item_id"];
                                $itemName = $row["name"];
                                $itemQuantity = $row["quantity"];
                                if($currentIndex < 4){
                                    $file = "images/products/" . $id . "/items/$itemID.jpg";

                                    if(!file_exists($file)){//Deletes the image if it exists
                                        $file = "images/products/" . $id . "/items/$itemID.png";
                                        if(!file_exists($file)){//Deletes the image if it exists
                                            $file = "images/products/" . $id . "/items/$itemID.gif";
                                            if(!file_exists($file)){//Deletes the image if it exists
                                                $file = "images/products/default.png";
                                            }
                                        }
                                    }
                                    if($currentDivIndex == 0 && $currentIndex == 0){
                                        $firstItemID = $itemID;
                                        $firstItemName = $itemName;
                                        $firstItemQuantity = $itemQuantity;
                                        echo "<img class='color hasBorder' data-name='$itemName' data-id='$itemID' data-quantity='$itemQuantity' src='$file' alt='Product Image'>";
                                    }else {
                                        echo "<img class='color' data-name='$itemName' data-id='$itemID' data-quantity='$itemQuantity' src='$file' alt='Product Image'>";
                                    }
                                    $currentIndex = $currentIndex + 1;
                                    if($currentIndex == 4){
                                        $currentIndex = 0;
                                        $currentDivIndex = $currentDivIndex + 1;
                                    }
                                }
                            }
                        }
                    }

                ?>
                </div>
            </div>
            <div class="details-flex">
                <div class="name-price-size">
                    <div class="name-price-container">
                        <h3 id="itemNameText"><?= $firstItemName?></h3>
                        <?php
                            if($discount > 0){
                                $newprice = $price - $discount;
                                echo "<div class='price'><del>$price$</del> <span class='price2'>$newprice$</span></div>";
                            }else {
                                echo "<div class='price'>$price$</div>";
                            }
                        ?>
                        
                    </div>

                    <div class="size">
                        <h4 id="extraDataName">Size</h4>
                        <select name="select" id="extraDataSelect">
                            <option>33.5</option>
                            <option>34</option>
                            <option>35</option>
                            <option>36</option>
                            <option>40</option>
                        </select>
                    </div>
                </div>

                <div class="product-details">
                    <h3>Product Details</h3>
                        <?php
                            $lines = explode("\n", $details);
                            $keys = array();
                            $values = array();
                            for($i = 0; $i < count($lines); $i++){
                                $data = explode("<>", $lines[$i]);
                                array_push($keys, $data[0]);
                                array_push($values, $data[1]);
                            }
                            array_push($keys, "Department");
                            if($department == "m"){
                                array_push($values, "Men");
                            }else if($department == "f"){
                                array_push($values, "Female");
                            }else if($department == "u"){
                                array_push($values, "Uni Sex");
                            }else {
                                array_push($values, "Unknown");
                            }
                            array_push($keys, "Quantity");
                            array_push($values, $firstItemQuantity);
                            array_push($keys, "Delivery Time");
                            array_push($values, $delivery_time . " Days");
                            array_push($keys, "Likes");
                            array_push($values, $likes);
                            array_push($keys, "Ratings");
                            echo "<table class='table borderless'>";
                            echo "<tbody>";
                            for($i = 0; $i < count($keys); $i++){
                                $itemKey = $keys[$i];
                                if($i == count($values)){ //Ratings
                                    echo "<th scope='col'>$itemKey</th>";
                                    echo "<th scope='col'>";
                                    echo "<span class='rating-flex' id='rating'>";
                                        //Get Rating Info
                                        $sql2 = "SELECT * FROM reviews WHERE `product_id`='$id'";
                                        $result2 = mysqli_query($db, $sql2);
                                        $currentTotal = 0;
                                        $currentIndex = 0;
                                        if($result2){
                                            if(mysqli_num_rows($result2) > 0) {
                                                while($row = mysqli_fetch_assoc($result2)){
                                                    $currentTotal = $currentTotal + $row["rate"];
                                                    $currentIndex = $currentIndex + 1; 
                                                }
                                            }
                                        }
                                        if($currentTotal != 0){
                                            $rate = $currentTotal / $currentIndex;
                                            $limitReached = false;
                                            for($i = 1; $i < 6; $i++){
                                                if($limitReached){
                                                    echo "<i class='fa fa-star'></i>";
                                                }else {
                                                    //2.5, 2
                                                    if($rate < $i){
                                                        $limitReached = true;
                                                        echo "<i class='fa fa-star-half-stroke rating-enabled'></i>";
                                                    }else {
                                                        if($rate - $i == 0){
                                                            echo "<i class='fa fa-star rating-enabled'></i>";
                                                            $limitReached = true;
                                                        }
                                                        else if($rate - $i >= 0.5){
                                                            echo "<i class='fa fa-star rating-enabled'></i>";
                                                        }else {
                                                            echo "<i class='fa fa-star-half-stroke rating-enabled'></i>";
                                                            $limitReached = true;
                                                        }
                                                    }
                                                }
                                                
                                            }
                                        }else {
                                            echo "<i class='fa fa-star'></i>";
                                            echo "<i class='fa fa-star'></i>";
                                            echo "<i class='fa fa-star'></i>";
                                            echo "<i class='fa fa-star'></i>";
                                            echo "<i class='fa fa-star'></i>";
                                        }
                                        
                                    echo "</span>";
                                    echo "</th>";  
                                    
                                }else if($i == count($values) - 1){ //Likes
                                    $itemValue = $values[$i];
                                    echo"<tr>";
                                    echo "<th scope='col'>$itemKey</th>";
                                    echo "<th scope='col' id='totalLikes'>$itemValue</th>";
                                    echo"</tr>";
                                    
                                }else {//Everything Else
                                    $itemValue = $values[$i];
                                    echo"<tr>";
                                    echo "<th scope='col'>$itemKey</th>";
                                    if($i == count($values) - 3){
                                        echo "<th scope='col' id='itemQuantityText'>$itemValue</th>";
                                    }else {
                                        echo "<th scope='col'>$itemValue</th>";
                                    }
                                    echo"</tr>";
                                }
                                
                            }
                            echo "</tbody>";
                            echo "</table>";
                        ?>
                </div>
            </div>

            <div class="prod-desc">
                <h3>Product Description</h3>
                <p><?=$description?></p>
            </div>

            <div id="addToCartDiv">
            <?php
                if(isset($_SESSION["userID"])){
                    if($firstItemQuantity > 0){
                        echo "<button id='add' class='btn' onclick='AddItemToCart()' style='height: 40px; margin-top: 30px; background-color: #ffd814; border-radius: 10px; font-weight: bold; width: 200px;'>Add To Cart</button>";
                    }else {
                        echo "<button id='noadd' class='btn' style='pointer-events: none; height: 40px; margin-top: 30px; background-color: #E5E5E5; border-radius: 10px; font-weight: bold; width: 200px;'>Out Of Stock</button>";
                    }
                }else {
                    echo "<a id='add' class='btn' href='login.php' style='height: 40px; margin-top: 30px; background-color: #ffd814; border-radius: 10px; font-weight: bold; width: 200px;'>Add To Cart</a>";
                }
            ?>
            </div>

            <div class="reviewsContainer">
                <h3>Customer Reviews</h3>
                <?php
                    if($currentUserImageFile != "none"){
                        ?>
                        <div class="leaveAReview" id="leaveAReview">
                            <div class="comment-area"> 
                            <textarea id="ratingReview" class="form-control" placeholder="Would you like to leave a review?" rows="2"></textarea>
                        </div>
                        <div>
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="5" onclick="PostReview(5)" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4half" name="rating" value="4.5" onclick="PostReview(4.5)" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" onclick="PostReview(4)" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3half" name="rating" value="3.5" onclick="PostReview(3.5)" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" onclick="PostReview(3)" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2half" name="rating" value="2.5" onclick="PostReview(2.5)" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" onclick="PostReview(2)" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1half" name="rating" value="1.5" onclick="PostReview(1.5)" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1" onclick="PostReview(1)" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                <input type="radio" id="starhalf" name="rating" value="0.5" onclick="PostReview(0.5)" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                            </fieldset>
                        </div>
                    </div>
                    <?php
                    }

                ?>
                <div class="reviewsFlex mt-5 p-4" id="reviewBox">
                    <?php
                        $sql = "SELECT * FROM reviews WHERE `product_id`='$id'";
                        $result = mysqli_query($db, $sql);
                        if($result){
                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)){
                                    
                                    $user_id = $row["user_id"];
                                    $rev_id =$row["rev_id"];
                                    $file = "images/users/" . $user_id . "/logo.jpg";
                                    $text = str_replace("<lb>","<br>",$row["text"]);
                                    $rate = $row["rate"];

                                    if(!file_exists($file)){//Deletes the image if it exists
                                        $file = "images/users/" . $user_id . "/logo.png";
                                        if(!file_exists($file)){//Deletes the image if it exists
                                            $file = "images/users/" . $user_id . "/logo.gif";
                                            if(!file_exists($file)){//Deletes the image if it exists
                                                $file = "images/users/default.png";
                                            }
                                        }
                                    }

                                    if(isset($_SESSION['userID'])){
                                        if($_SESSION['userID'] == $user_id){
                                            $didPostReview = true;
                                        }
                                    }

                                    $sql2 = "SELECT username FROM users WHERE `user_id`='$user_id'";
                                    $result2 = mysqli_query($db, $sql2);
                                    if($result2){
                                        if(mysqli_num_rows($result2) == 1) {
                                            while($row2 = mysqli_fetch_assoc($result2)){
                                                $username = $row2['username'];
                                                echo "<div class='review-box' >";
                                                echo "<div><img src='$file' alt='User Image'></div>";
                                                echo "<div class='vertical-line'></div>";
                                                echo "<div class='column'>";
                                                echo "<h5>$username</h5>";
                                                echo "<p>";
                                                echo $text;
                                                echo "<span class='rating-flex'>";
                                                $limitReached = false;
                                                for($i = 1; $i < 6; $i++){
                                                    if($limitReached){
                                                        echo "<i class='fa fa-star'></i>";
                                                    }else {
                                                        //2.5, 2
                                                        if($rate < $i){
                                                            $limitReached = true;
                                                            echo "<i class='fa fa-star-half-stroke rating-enabled'></i>";
                                                        }else {
                                                            if($rate - $i == 0){
                                                                echo "<i class='fa fa-star rating-enabled'></i>";
                                                                $limitReached = true;
                                                            }
                                                            else if($rate - $i >= 0.5){
                                                                echo "<i class='fa fa-star rating-enabled'></i>";
                                                            }else {
                                                                echo "<i class='fa fa-star-half-stroke rating-enabled'></i>";
                                                                $limitReached = true;
                                                            }
                                                        }
                                                    }
                                                   
                                                }
                                                echo "</span>";
                                                echo "</p>";
                                                if(isset($_SESSION['userID'])){
                                                    if($username == $currentUserUsername || (isset($_SESSION['type']) && $_SESSION['type'] == "admin")){
                                                        echo "<div class='delete-review' onclick='DeleteReview(this, $rev_id)'><i class='fa-solid fa-trash-can mb-2'></i></div>";
                                                    }
                                                }
                                                echo "</div>";
                                                echo "</div>";
                                            }
                                        }
                                    }
                                }
                            } else {
                                echo "<p id='noReviewsYet'>No Reviews Yet, Like This Product? Leave A Review!</p>";

                            }
                        }
                    ?>
                </div>
            </div>

    </div>

    <?php include('footer.php') ?>
</body>
<script>

    var id = "<?php echo $id; ?>";
    var currentSelectedItemID = <?= $firstItemID ?>;
    var isLoggedIn = "<?= isset($_SESSION["userID"]) ?>";

    function AddItemToCart(){
        if(currentSelectedItemID != -1){
            var dataNameText = document.getElementById("extraDataName").innerHTML;
            var dataSelect = document.getElementById("extraDataSelect");
            var dataSelectText = dataSelect.options[dataSelect.selectedIndex].text;
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "manageCart.php?id=" + id + "&type=add&item=" + currentSelectedItemID + "&dataName=" + dataNameText + "&dataValue=" + dataSelectText, true);
            xmlhttp.addEventListener('error', handleReviewEvent);
            xmlhttp.send();
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var data = JSON.parse(xmlhttp.responseText);
                    if(data.state == "SUCCESS"){
                        alert("Added Item To Cart");
                    }else {
                        alert("Failed Adding To Cart, Please Contact A System Administrator");
                    }
                }
            }
        }
    }

    $('.color').click(function() {
        var $this = $(this);
        if ($this.hasClass('hasBorder')) {
            $this.removeClass('hasBorder');
        } else {
            $('.hasBorder').removeClass('hasBorder');
            $this.addClass('hasBorder');
            document.getElementById('default-img').src = $this.attr('src');
            let itemName = document.getElementById('itemNameText');
            let itemQuantity = document.getElementById('itemQuantityText');
            itemName.innerHTML = $(this).data("name");
            itemQuantity.innerHTML = $(this).data("quantity");
            currentSelectedItemID = $(this).data("id");

            if(isLoggedIn == "1"){
                var maxAvailable = $(this).data("quantity");
                if(maxAvailable > 0){
                    $("#addToCartDiv").empty();
                    $("#addToCartDiv").append("<button id='add' class='btn' onclick='AddItemToCart()' style='height: 40px; margin-top: 30px; background-color: #ffd814; border-radius: 10px; font-weight: bold; width: 200px;'>Add To Cart</button>");
                }else {
                    $("#addToCartDiv").empty();
                    $("#addToCartDiv").append("<button id='noadd' class='btn' style='pointer-events: none; height: 40px; margin-top: 30px; background-color: #E5E5E5; border-radius: 10px; font-weight: bold; width: 200px;'>Out Of Stock</button>");
                }
            }
        }
    });

    $("#add").hover(
        function() {
            document.getElementById('add').style.backgroundColor = "#fbea94";
        }, function() {
            document.getElementById('add').style.backgroundColor = "#ffd814";
        }
    );
    var imageFile = "<?php echo $currentUserImageFile; ?>";
    var username = "<?php echo $currentUserUsername; ?>";
    function PostReview(rate){
        var currentReview = $('#ratingReview').val();
        $('#leaveAReview *').prop('disabled', true);
        var xmlhttp = new XMLHttpRequest();
        var text = currentReview;
        currentReview = currentReview.replaceAll("\n","<lb>");
        xmlhttp.open("GET", "updateReview.php?id=" + id + "&type=add&text=" + currentReview + "&rate=" + rate, true);
        xmlhttp.addEventListener('error', handleReviewEvent);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var data = JSON.parse(xmlhttp.responseText);
                if(data.state == "SUCCESS"){
                    $('#noReviewsYet').remove();
                    var toAppEnd = "<div class='review-box' >" + "<div><img src='" + imageFile + "' alt='User Image'></div>" +
                    "<div class='vertical-line'></div>" + "<div class='column'>" + "<h5>" + username + "</h5>" + "<p>" + text +
                    "<span class='rating-flex'>";
                    var limitReached = false;
                    for(var i = 1; i < 6; i++){
                        if(limitReached){
                            toAppEnd += "<i class='fa fa-star'></i>";
                        }else {
                            //2.5, 2
                            if(rate < i){
                                limitReached = true;
                                toAppEnd += "<i class='fa fa-star-half-stroke rating-enabled'></i>";
                            }else {
                                if(rate - i == 0){
                                    toAppEnd += "<i class='fa fa-star rating-enabled'></i>";
                                    limitReached = true;
                                }
                                else if(rate - i >= 0.5){
                                    toAppEnd += "<i class='fa fa-star rating-enabled'></i>";
                                }else {
                                    toAppEnd += "<i class='fa fa-star-half-stroke rating-enabled'></i>";
                                    limitReached = true;
                                }
                            }
                        } 
                    }
                    toAppEnd += "</span>" + "</p>" + 
                    "<div class='delete-review' onclick='DeleteReview(this, " + data.id + ")'><i class='fa-solid fa-trash-can mb-2'></i></div>" + "</div>" + "</div>";
                    $('#reviewBox').append(toAppEnd);
                }else {
                    alert("Failed To Add Review, Please Contact A System Administrator");
                }
            }
        }
    }

    function DeleteReview(element, revid){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "updateReview.php?id=" + revid + "&type=remove", true);
        xmlhttp.addEventListener('error', handleCartEvent);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var data = JSON.parse(xmlhttp.responseText);
                if(data.state == "SUCCESS"){
                    $('#leaveAReview *').prop('disabled', false);
                }
            }
        }
        const parent = element.closest('div.review-box');
        parent.remove();
    }

    function handleCartEvent(e) {
        alert("Failed To Update Cart, Please Contact The System Administrator.");
    }

    function handleReviewEvent(e) {
        alert("Failed To Update Review, Please Contact The System Administrator.");
    }

    $(function() {
        var didPostReview = "<?php echo $didPostReview; ?>";
        if(didPostReview == 1){
            $('#leaveAReview *').prop('disabled', true);
        }
    });
</script>

</html>