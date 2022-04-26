<?php 

session_start();

include('config.php');

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = md5(mysqli_real_escape_string($db, $_POST['password']));

    $query = $db -> query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    if (mysqli_fetch_assoc($query)) {
        header('location: test.php');
    } else {
        header('location: login.php?error');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fashion | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">

    <link href="css/auth.css" rel="stylesheet" media="screen">
    <link href="css/header.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c530224477.js" crossorigin="anonymous"></script>

    <?php include('header.php') ?>
</head>
<body>
    <div class="flexbox">
        <div class="flex-item">
            <img src="./imgs/auth.png">
        </div>

        <div class="flex-item">
            <?php
                if (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "<i class='fa fa-exclamation-circle'></i>";
                    echo " Account Not Found";
                    echo "</div>";
                }
            ?>
            <h5>Login</h5>
            <br>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
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