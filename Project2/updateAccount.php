<?php 
  
    include "includes/validateAuth.php";
    include "includes/config.php";

    $userid = $_SESSION["userID"] ?? 0;

    if(isset($_POST["changeUsername"])){

        $username = $_POST["usernameText"];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($db, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){
                header("location:panel.php?error=1");//Error 1 User already exsists
            }else {
                $sql = "UPDATE users SET username='$username' WHERE id='$userid'";
                mysqli_query($db, $sql) or die(mysqli_error($db));
                $_SESSION['username'] = $username;
                header("location:panel.php?success=0");
            }
        }else {
            header("location:panel.php?error=0");//Error 0 Database error
        }
        die();
    }else if(isset($_POST["changePassword"])){
        $password = $_POST["passwordText"];
        $sql = "UPDATE users SET password='$password' WHERE id='$userid'";
        mysqli_query($db, $sql) or die(mysqli_error($db));
        header("location:panel.php?success=1");
        die();
    }else if(isset($_POST["changeProfile"])){
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        $str = explode('.',$_FILES['image']['name']);                        
        $file_ext = strtolower(end($str));
        
        $extensions = array("jpg");
        
        if(in_array($file_ext,$extensions)=== false){
            header("location:panel.php?error=2");
            die();
        }
        
        if($file_size > 2097152) {
            header("location:panel.php?error=3");
            die();
        }

        $file = "imgs/users/user_$userid." . $file_ext;
        if(file_exists($file)){//Deletes the image if it exists
            unlink($file);
        }
        move_uploaded_file($file_tmp, $file);

        header("location:panel.php?success=2");
        die();
    } 
?>