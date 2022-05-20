<?php 
    include "includes/validateAuth.php";
    include 'includes/config.php';

    $id = $_SESSION['userID'];

    $username = "";
    $fullname = "";
    $email = "";
    $photo = "";
    $currentPassword = "";
    $error = "none";

    $sql = "SELECT * FROM users WHERE `user_id`='$id'";
    $result = mysqli_query($db, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
                $fullname = $row['fullname'];
                $email = $row['email'];
                $currentPassword = $row['password'];
            }
        }
    }

    $fileDirectory = "images/users/$id";
    if (!file_exists($fileDirectory)) {
        mkdir($fileDirectory, 0777, true);
    }

    $file = "images/users/$id/logo.jpg";

    if(!file_exists($file)){//Deletes the image if it exists
        $file = "images/users/$id/logo.png";
        if(!file_exists($file)){//Deletes the image if it exists
            $file = "images/users/$id/logo.gif";
            if(!file_exists($file)){//Deletes the image if it exists
                $file = "images/users/default.png";
            }
        }
    }
    $photo = $file;

    if(isset($_POST["fullname"])){
        $newFullname = $_POST["fullname"];
        $sql = "UPDATE users SET fullname='$newFullname' WHERE `user_id`='$id'";
        $result = mysqli_query($db, $sql);
        if ($result) {
            $fullname = $newFullname;
      }
    }else if(isset($_POST["editPassword"])){
        $oldPassword = $_POST["oldPassword"];
        $newPassword = md5($_POST["newPassword"]);
        if(md5($oldPassword) != $currentPassword){
            $error = "Your Password Was Invalid!";
        }else {
            $sql = "UPDATE users SET password='$newPassword' WHERE `user_id`='$id'";
            $result = mysqli_query($db, $sql);
        }
    }else if(isset($_POST["editPhoto"])){
        $fileDirectory = "images/users/$id";
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $file_tmp = $_FILES['image']['tmp_name'];
            $str = explode('.',$_FILES['image']['name']);                        
            $file_ext = strtolower(end($str));

            $file = $fileDirectory . "/logo." . $file_ext;
            $testFile = $fileDirectory . "/logo." . "png";
            if(file_exists($testFile)){//Deletes the image if it exists
                unlink($testFile);
            }
            $testFile = $fileDirectory . "/logo." . "jpg";
            if(file_exists($testFile)){//Deletes the image if it exists
                unlink($testFile);
            }
            if(file_exists($file)){//Deletes the image if it exists
                unlink($file);
            }
            move_uploaded_file($file_tmp, $file);
            $photo = $file;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | User Panel</title>

    <link href="css/popup.css" rel="stylesheet" media="screen">
    <link href="css/profile.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>

    <div id="snackbar">Your password was incorrect!</div>

    <div class="image-container">
        <img class='backImg' src='imgs/profile-back.png' alt='Background Image'>
        <img class='productImg' src='<?php echo $photo ?>' alt='Product Image'>
    </div>

    <div class="container-fluid">
        <h3 class="user-title"><?php echo $fullname ?></h3>
        <div class="table-container">
            <table class="table borderless">
                <thead>
                    <tr>
                        <th scope="col" class="title">Username</th>
                        <th scope="col"><?php echo $username ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col" class="title">Email Address</th>  
                        <th scope="col"><?php echo $email ?></th>                              
                    </tr>
                </tbody>
            </table>
        </div>

        <button class="btn" data-toggle="modal" data-target="#editProfile" style="font-family: Inter-Medium; margin-top: 10px; background-color: #EBEBEB; border-radius: 10px; width: 200px;">Manage Profile</button>
        <a class="logoutButton" href="logout.php">
            <button class="btn" style="font-family: Inter-Medium; margin-top: 10px; background-color: #dc143c; color: white; border-radius: 10px; width: 100px;">Logout</button>
        </a>

        <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Your Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="panel.php" enctype="multipart/form-data">
                            <label>Change Your Fullname</label>
                            <input type="text" name="fullname" value='<?php echo $fullname ?>' class="form-control" aria-describedby="fullname" placeholder="Enter your fullname" required>
                            <button type="submit" class="btn btn-primary mt-2" name="editFullname">Update Fullname</button>
                        </form>
                        <br>
                        <hr>
                        <form method="POST" action="panel.php" enctype="multipart/form-data">
                            <label>Change Your Password</label>
                            <input type="password" name="oldPassword" class="form-control mt-1" aria-describedby="password" placeholder="Enter your current password">
                            <input type="password" name="newPassword" id="password" class="form-control mt-1" aria-describedby="newpassword" placeholder="Enter your new password">
                            <input type="password" name="repeatPassword" id="confirm_password" class="form-control mt-1" aria-describedby="newpassword" placeholder="Repeat your new password">
                            <p id="message">&nbsp;</p>
                            <button type="submit" id="submitbtn" class="btn btn-primary mt-1" name="editPassword">Change Password</button>
                        </form>
                        <br>
                        

                        <form method="POST" id="edit_form" action="panel.php" enctype="multipart/form-data">
                            <label for="exampleInputEmail1">Profile Picture</label><br>
                            <img class="profile-photo" src="<?php echo $photo; ?>">
                            <div class="upload-button">Upload Photo</div>
                            <input class="file-upload" type="file" name="image"/>
                            <button type="submit" id="submitbtn2" class="btn btn-primary mt-1" name="editPhoto">Change Picture</button>
                        </form>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
            if(isset($_SESSION['type']) && $_SESSION['type'] == "admin"){?>
                
                <br>
                <br>
                <br>
                <div style="font-family: Inter-Medium;">
                    <h3 class="favorites-title">Admin Tools</h3>
                    <a href="manageAllProducts.php" style="text-decoration:none;">
                        <button class="btn btn-primary" style="margin-top: 10px; border-radius: 10px; width: 200px;">Manage Products</button>
                    </a>
                    <a href="manageAllUsers.php" style="text-decoration:none;">
                        <button class="btn btn-info" style="margin-top: 10px; border-radius: 10px; width: 200px;">Manage Users</button>
                    </a>
                    <a href="manageAllBrands.php" style="text-decoration:none;">
                        <button class="btn btn-warning" style="margin-top: 10px; border-radius: 10px; width: 200px;">Manage Brands</button>
                    </a>
                    <a href="orders.php" style="text-decoration:none;">
                        <button class="btn btn-primary" style="margin-top: 10px; border-radius: 10px; width: 200px;">Manage Orders</button>
                    </a>
                </div>
            <?php } else if (isset($_SESSION['type']) && $_SESSION['type'] == "driver") { ?>
                        <br>
                        <br>
                        <br>
                        <div style="font-family: Inter-Medium;">
                            <h3 class="favorites-title">Driver Tools</h3>
                            <a href="orders.php" style="text-decoration:none;">
                                <button class="btn btn-primary" style="margin-top: 10px; border-radius: 10px; width: 200px;">Manage Orders</button>
                            </a>
                        </div>
            <?php } ?>
        <br>
        <br>
        <br>
        <div class="showMoreDiv">
            <h3 class="favorites-title">Favorites</h3>
            <?php
                $sql = "SELECT product_id FROM favorites WHERE `user_id`='$id' LIMIT 7";
                $result = mysqli_query($db, $sql);
                if($result){
                    if(mysqli_num_rows($result) > 0) {
                        echo "<a href='showAllFavorites.php'>Show More</a>";
                        echo "<div class='favorite-products'>";
                        while($row = mysqli_fetch_assoc($result)){
                            
                            $prod_id = $row["product_id"];
                            $filep = "images/products/" . $prod_id . "/logo.jpg";

                            if(!file_exists($filep)){//Deletes the image if it exists
                                $filep = "images/products/" . $prod_id . "/logo.png";
                                if(!file_exists($filep)){//Deletes the image if it exists
                                    $filep = "images/products/" . $prod_id . "/logo.gif";
                                    if(!file_exists($filep)){//Deletes the image if it exists
                                        $filep = "images/products/default.png";
                                    }
                                }
                            }
                            echo "<a href='viewProduct.php?id=$prod_id'><img src='$filep' alt='Product Image'></a>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No Favorite Items Yet, Browse Through Our Store To Add More!</p>";

                    }
                }
            ?>
        </div>
        <br>
        <br>
        <div class="showMoreDiv">
            <h3 class="favorites-title">Previous Orders</h3>
                <?php
                    $sql = "SELECT * FROM orders WHERE `user_id`='$user_id' LIMIT 7";

                    $result = mysqli_query($db, $sql);

                    $order_id = 0;
                    $address = "";
                    $country = "";
                    $countryCode = "";
                    $phoneNumber = "";
                    $state = "";
                    $payment = "";
                    $date = "";

                    if($result){
                        if(mysqli_num_rows($result) > 0) {
                            echo "<a href='showAllOrders.php'>Show More</a>";
                            echo "<div class='previous-orders'>";
                            while($row = mysqli_fetch_assoc($result)){
                                $order_id = $row["order_id"];
                                $address = $row["address"];
                                $country = $row["country"];
                                $countryCode = $row["countryCode"];
                                $phoneNumber = $row["number"];
                                $payment = $row["payment"];
                                $state = $row["state"];
                                $date = $row["date"];

                                $stateClass = $state == 'Pending' ? 'status-pending' : ($state == 'Returned' ? 'status-returned' : ($state == 'On The Way' ? 'status-ontheway' : 'status'));

                                echo "<a class='text-reset' href='viewOrder.php?id=$order_id' style='text-decoration: none;'>";
                                echo "<h3>Order № $order_id</h3>";
                                echo "<p>$country, $address";
                                echo "<br>(+$countryCode) $phoneNumber";
                                echo "<br><span class='$stateClass'>$state</span>";
                                echo "<br>$date";
                                echo "<br>$payment</p>";
                                echo "</a>";
                            }
                            echo "</div>";
                        }
                    }
                ?>
        </div>
        
                
        <br>
        <br>
        <br>
        <div class="showMoreDiv">
            <h3 class="favorites-title">Posted Reviews</h3>
            <?php
                $sql3 = "SELECT * FROM reviews WHERE `user_id`='$id' LIMIT 7";
                $result3 = mysqli_query($db, $sql3);
                if($result3){
                    if(mysqli_num_rows($result3) > 0) {
                        echo "<a href='showAllReviews.php'>Show More</a>";
                        echo "<div class='reviewsContainer'>";
                        echo "<div class='reviewsFlex p-4'>";
                        while($row3 = mysqli_fetch_assoc($result3)){
                            $text = str_replace("<lb>","<br>",$row3["text"]);
                            $rate = $row3["rate"];
                            $prod_id = $row3["product_id"];
                            $sql2 = "SELECT name FROM products WHERE `prod_id`='$prod_id'";
                            $result2 = mysqli_query($db, $sql2);
                            if($result2){
                                if(mysqli_num_rows($result2) == 1) {
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                        $prod_name = $row2['name'];
                                        echo "<a href='viewProduct.php?id=$prod_id' class='text-reset' style='text-decoration:none;'>";
                                        echo "<div class='review-box'>";
                                        echo "<div><img src='$file' alt='User Image'></div>";
                                        echo "<div class='vertical-line'></div>";
                                        echo "<div class='column'>";
                                        echo "<h5>$username • $prod_name</h5>";
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
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</a>";
                                    }
                                }
                            }
                        }
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "<p style='font-family: Inter-Medium;'>No Reviews Yet, Browse Through Our Store To Make Some!</p>";

                    }
                }
            ?>
        </div>
    </div>
    <?php include('footer.php') ?>
</body>
<script>

    var currentDataError = "<?php echo $error ?>";
    if(currentDataError != "none"){
        var x = document.getElementById("snackbar");
        x.className = "show";
        x.innerHTML = "Your password was incorrect!";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }

    $(document).ready(function() {    
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.profile-photo').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload").on('change', function(){
            readURL(this);
        });

        $(".upload-button").on('click', function() {
            $(".file-upload").click();
        });
        $('#message').html('').css('color', 'red');
    });

    $('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
        $('#message').html('').css('color', 'red');
        document.getElementById("submitbtn").disabled = false;
    } else {
        $('#message').show();
        $('#message').html('Passwords Must Be Matching').css('color', 'red');
        document.getElementById("submitbtn").disabled = true;
    }
    });

</script>
</html>