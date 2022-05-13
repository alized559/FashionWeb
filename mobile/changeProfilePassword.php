<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include '../includes/config.php';

$id = $_POST['id'] ?? 0;
$current = md5($_POST['oldPassword']);
$new = md5($_POST['newPassword']);

$sql = "SELECT * FROM users WHERE `user_id`=$id AND password='$current'";
$result = mysqli_query($db, $sql);
if($result){
    if(mysqli_num_rows($result) > 0){
        $sql = "UPDATE users SET password='$new' WHERE `user_id`=$id";
        $result = mysqli_query($db, $sql);
        if($result){
            die("Password changed successfully");
        }else {
            die("Error: Database Failed 102!");
        }
    }else {
        die("Error: Invalid Password");
    }
}else {
    die("Error: Database Failed 101!");
}

?>