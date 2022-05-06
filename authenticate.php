<?php
    include "includes/config.php";
    session_start();

    if(isset($_SESSION["username"])){//User already logged in
        header("location:panel.php");
    }else {
        if(isset($_POST["login"])){
            $username = $_POST["username"];
            $password = md5($_POST["password"]);

            $sql = "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'";
            $result = mysqli_query($db, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    while($row =mysqli_fetch_assoc($result)){
                        $_SESSION['username'] = $username;
                        $_SESSION['type'] = $row["type"];
                        $_SESSION['userID'] = $row["user_id"];
                        header("location:panel.php");
                        break;
                    }
                }else {
                    header("location:login.php?error=1");//Error 1 Invalid User Name Or Password
                }
            }else {
                header("location:login.php?error=0");//Error 0 Database error
            }
        }else {
            $username = $_POST["username"];
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            echo "test";
            $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $result = mysqli_query($db, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    header("location:signup.php?error=1");//Error 1 User already exsists
                }else {
                    $sql = "INSERT INTO users(username,fullname,email,password) VALUE ('$username','$fullname','$email','$password')";
                    mysqli_query($db, $sql) or die(mysqli_error($db));
                    $_SESSION['username'] = $username;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['email'] = $email;
                    $_SESSION['type'] = 'user';
                    $_SESSION['userID'] = mysqli_insert_id($db);
                    header("location:panel.php");
                }
            }else {
                header("location:signup.php?error=0");//Error 0 Database error
            }
            
        }
    }

?>