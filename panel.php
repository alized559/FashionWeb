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

    <link href="css/profile.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
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

        <button class="btn" data-toggle="modal" data-target="#editProfile" style="margin-top: 10px; background-color: #EBEBEB; border-radius: 10px; width: 200px;">Manage Profile</button>
        <a class="logoutButton" href="logout.php">
            <button class="btn" style="margin-top: 10px; background-color: #dc143c; color: white; border-radius: 10px; width: 100px;">Logout</button>
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
                            <button type="submit" id="submitbtn" class="btn btn-primary mt-1" name="editPhoto">Change Picture</button>
                        </form>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </div>
                    
                </div>
            </div>
        </div>
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
                            
                            $id = $row["product_id"];
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
                            echo "<a href='viewProduct.php?id=$id'><img src='$file' alt='Product Image'></a>";
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
            <a href="showAllOrders.php">Show More</a>
        </div>
        <div class="previous-orders">
            <img src='imgs/9.png' alt='Product Image'>
            <img src='imgs/9.png' alt='Product Image'>
            <img src='imgs/9.png' alt='Product Image'>
        </div>

        <br>
        <br>
        <br>
        <div class="showMoreDiv">
            <h3 class="favorites-title">Posted Reviews</h3>
            <a href="showAllReviews.php">Show More</a>
        </div>
        <div class="reviewsContainer">
            <div class="reviewsFlex">
                <div class="review-box">
                    <img src="imgs/user_photo.png" alt="User Image">
                    <div class="vertical-line"></div>
                    <div class="column">
                        <h5>John</h5>
                        <p>Great Product, Feels So Comfy The Colors Are Amazing!!
                        </p>
                        <div class="rating-flex" id="rating1">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
                    
                <div class="review-box">
                    <img src="imgs/user_photo.png" alt="User Image">
                    <div class="vertical-line"></div>
                    <div class="column">
                        <h5>John</h5>
                        <p>Great Product, Feels So Comfy The Colors Are Amazing!!
                        </p>
                        <div class="rating-flex" id="rating1">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php include('footer.php') ?>
</body>
<script>

    var currentDataError = "<?php echo $error ?>";
    if(currentDataError != "none"){
        alert(currentDataError);
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