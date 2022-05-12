<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include '../includes/config.php';
$emparray = array();
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if($_POST['login'] == "true"){//Login
        $sql = "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'";
        $result = mysqli_query($db, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $emparray[] = $row;
                }
                $emparray['state'] = "success";
                die(json_encode($emparray));
            }else {
                $emparray['state'] = "Error: Invalid Username Or Password";
                die(json_encode($emparray));
            }
        }else {
            $emparray['state'] = "Error: Database Failed!";
            die(json_encode($emparray));
        }
    }else {
        $email = $_POST['email'];
        $fullname = $_POST["fullname"];
        $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = mysqli_query($db, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){
                $emparray['state'] = "Error: User Already Exists!";
                die(json_encode($emparray));
            }else {
                $sql = "INSERT INTO users(username,fullname,email,password) VALUE ('$username','$fullname','$email','$password')";
                $result = mysqli_query($db, $sql);
                if ($result) {
                    $id = mysqli_insert_id($db);
                    $emparray = array('user_id' => $id, 'email' => $email, 'username' => $username, 'fullname' => $fullname, 'type' => 'user', 'state' => 'success');
                    die(json_encode($emparray));
                }else {
                    $emparray['state'] = "Error: Database Failed 101!";
                    die(json_encode($emparray));
                }
            }
        }else {
            $emparray['state'] = "Error: Database Failed 102!";
            die(json_encode($emparray));
        }
    }
}else {
    $emparray['state'] = "Error: Invalid Request";
    die(json_encode($emparray));
}
mysqli_close($db);
?>