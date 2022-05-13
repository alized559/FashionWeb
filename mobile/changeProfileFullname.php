<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include '../includes/config.php';

$id = $_POST['id'] ?? 0;
$fullname = $_POST['fullname'];

$sql = "UPDATE users SET fullname='$fullname' WHERE `user_id`=$id";
$result = mysqli_query($db, $sql);
if($result){
    die("Fullname changed successfully");
}else {
    die("Error: Database Failed 102!");
}


?>