<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include "../includes/config.php";
$sql = "";
$emparray = array();
if (isset($_GET['id'])){
    $sql = "SELECT product_id AS prod_id FROM favorites WHERE `user_id`='" . $_GET['id'] . "'";
    $result = mysqli_query($db, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $emparray[] = $row;
            }
            echo(json_encode($emparray));
            mysqli_free_result($result);
            mysqli_close($db);
        }else {
            echo(json_encode($emparray));
            mysqli_free_result($result);
            mysqli_close($db);
        }
    }

}else {
    die(json_encode($emparray));
}