(<?php
    include "includes/config.php";
    session_start();

    if(isset($_SESSION["username"])){//User already logged in
        header("location:panel.php");
    }else {
        if(isset($_POST["login"])){
            $username = $_POST["usernameText"];
            $password = $_POST["passwordText"];

            $sql = "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'";
            $result = mysqli_query($db, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    while($row =mysqli_fetch_assoc($result)){
                        $_SESSION['username'] = $username;
                        $_SESSION['isAdmin'] = $row["admin"];
                        $_SESSION['userID'] = $row["id"];
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
            $username = $_POST["usernameText"];
            $email = $_POST["emailText"];
            $password = $_POST["passwordText"];
            
            $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $result = mysqli_query($db, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    header("location:login.php?register=true&error=1");//Error 1 User already exsists
                }else {
                    $sql = "INSERT INTO users(username,email,password) VALUE ('$username','$email','$password')";
                    mysqli_query($db, $sql) or die(mysqli_error($db));
                    $_SESSION['username'] = $username;
                    $_SESSION['isAdmin'] = 0;
                    $_SESSION['userID'] = mysqli_insert_id($db);
                    header("location:panel.php");
                }
            }else {
                header("location:login.php?register=true&error=0");//Error 0 Database error
            }
    
        }
    }

?>