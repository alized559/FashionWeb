<?php
session_start();
if(isset($_SESSION['username'])) {
    header("location:panel.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fashion | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header.php') ?>
    <link href="css/auth.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="flexbox">
        <div class="flex-item">
            <img src="./imgs/auth.png">
        </div>

        <div class="flex-item">
            <h5>Login</h5>
            <?php
                if (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "<i class='fa fa-exclamation-circle'></i>";
                    $error = $_GET['error'];
                    if($error == 1){
                        echo " Invalid Username Or Password";
                    }else if($error == 0){
                        echo " A Database Error Has Occured";
                    }
                    echo "</div>";
                }
            ?>
            <br>
            <form method="POST" action="authenticate.php">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter email or username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" aria-describedby="passwordHelp" placeholder="Enter password" required>
                </div>
                <p>Not a member yet? <a href="signup.php" style="text-decoration: none;">Signup</a></p>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>

    <?php include('footer.php') ?>
</body>
</html>