<?php 
include "includes/validateAuth.php";
include 'includes/config.php';

$id = $_SESSION['userID'];

$user = $db -> query("SELECT * FROM users WHERE `user_id`='$id'");

$username = "";
$fullname = "";
$email = "";
$photo = "";

$target_dir = "images/profile_photos/";
$target_file = $target_dir . 'profile'. $id .'.png';
if (file_exists($target_file)) {
    $photo = $target_file;
} else {
    $photo = "imgs/user-default-img.png";
}

if ($user) {
    if (mysqli_num_rows($user) > 0) {
        while ($row = mysqli_fetch_assoc($user)) {
            $username = $row['username'];
            $fullname = $row['fullname'];
            $email = $row['email'];
        }
    }
}

if (isset($_POST['edit'])) {
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    if ($fullname !== '' && $password !== '') {
        $password = md5($_POST['password']);
        $query = $db -> query("UPDATE users SET fullname='$fullname', password='$password' WHERE `user_id`='$id'");
    } else if ($fullname !== '' && $password === '') {
        $query = $db -> query("UPDATE users SET fullname='$fullname' WHERE `user_id`='$id'");
    } else if ($fullname === '' && $password !== ''){
        $password = md5($_POST['password']);
        $query = $db -> query("UPDATE users SET password='$password' WHERE `user_id`='$id'");
    }

    if (isset($_FILES['photo']) && $_FILES['photo']['name']) {
        $target_dir = "images/profile_photos/";
        $target_file = $target_dir . 'profile'. $id;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        if ($_FILES["photo"]["size"] > 500000) {
            $uploadOk = 0;
        }
    
        if ($uploadOk == 1) {
            move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file . $imageFileType);
        }

        header('Location: panel.php');
        exit;
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
                <form method="POST" id="edit_form" action="panel.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter New Fullname</label>
                        <input type="text" name="fullname" value='<?php echo $fullname ?>' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter fullname">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter New Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter New Photo</label><br>
                        <img class="profile-photo" src="http://cdn.cutestpaw.com/wp-content/uploads/2012/07/l-Wittle-puppy-yawning.jpg">
                        <div class="upload-button">Upload Photo</div>
                        <input class="file-upload" type="file" name="photo"/>
                    </div>
                    
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="edit" id="edit">Edit</button>
                    </div>
                </form>
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
    });
</script>
</html>