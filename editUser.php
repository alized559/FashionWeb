<?php 

    include './includes/config.php';

    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($db, $sql);

    $new_user_id = $user_id;

    $username = "";
    $email = "";
    $type = "";

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
                $email = $row['email'];
                $type = $row['type'];
            }
        }
    }

    if (isset($_POST['edit'])) {
        $username1 = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $type = $_POST['type'];

        if ($username !== $username1) {
            $sql = "SELECT username FROM users WHERE username='$username1'";
            $result = mysqli_query($db, $sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0 && $password !== '') {
                    $sql = "UPDATE users SET username = '$username1', password = '$password', email = '$email', type='$type' WHERE user_id = '$user_id'";
                    $result = mysqli_query($db, $sql);
                    header('location: manageAllUsers.php');
                } else {
                    header("location: editUser.php?id=$user_id&error=0");
                }
            }
        } else if ($password !== '') {
            $sql = "UPDATE users SET username = '$username1', password = '$password', email = '$email', type='$type' WHERE user_id = '$user_id'";
            $result = mysqli_query($db, $sql);
            header('location: manageAllUsers.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Edit User</title>

    <link href="css/addProduct.css" rel="stylesheet" media="screen">

    <?php include 'header.php' ?>
</head>
<body>
    
<h2>Exploring Users, Again! Huh?</h2>
    <br>
    <br>
    <br>
    <form method="POST" action="editUser.php?id=<?php echo $new_user_id?>" enctype="multipart/form-data">
        <?php if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "<i class='fa fa-exclamation-circle'></i>";
            echo " username already exists!</div>";
        } ?>
        <h5>Lets Start With Username</h5>
        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $username ?>" name="username" aria-describedby="username" placeholder="Enter user's username" required>
        </div>

        <h5>What About Password?</h5>
        <div class="form-group">
            <input type="password" class="form-control" name="password" aria-describedby="password" placeholder="Enter user's password">
        </div>

        <h5>Want To Change Email?</h5>
        <div class="form-group">
            <input type="email" class="form-control" value="<?php echo $email ?>" name="email" aria-describedby="email" placeholder="Enter user's email" required>
        </div>

        <h5>Choose Type, ex: user, admin, driver</h5>
        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $type ?>" name="type" aria-describedby="type" placeholder="Enter user's type" required>
        </div>

        <button type="submit" class="btn btn-warning mb-1" name="edit">Edit User</button>
        <a class="btn btn-danger" href="manageAllUsers.php">Cancel</a>
    </form>

    <?php include 'footer.php' ?>
</body>
</html>