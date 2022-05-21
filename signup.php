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
    <title>Fashion | Signup</title>
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
            <h5>Signup</h5>
            <?php
                if (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "<i class='fa fa-exclamation-circle'></i>";
                    $error = $_GET['error'];
                    if ($error == 1) {
                        echo " User Already Exsists";
                    } else if($error == 0) {
                        echo " A Database Error Has Occured";
                    }
                    echo "</div>";
                }
            ?>
            <br>
            <form method="POST" action="authenticate.php">
                <div class="form-group">
                    <input type="text" class="form-control" minlength="6" name="fullname" aria-describedby="fullnameHelp" placeholder="Enter fullname" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" minlength="6" name="username" aria-describedby="usernameHelp" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" minlength="6" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" minlength="6" class="form-control" name="password"  aria-describedby="passwordHelp" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <input type="password" id="confirm_password" minlength="6" class="form-control" name="confirm_password"  aria-describedby="confirmPassHelp" placeholder="Confirm password" required>
                </div>
                <p id="message">&nbsp;</p>
                <p>Already a member? <a href="login.php" style="text-decoration: none;">Login</a></p>
                <button id="submitbtn" type="submit" class="btn btn-primary" name="signup" disabled>Signup</button>
            </form>
        </div>
    </div>
    <?php include('footer.php') ?>
</body>

<script>
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