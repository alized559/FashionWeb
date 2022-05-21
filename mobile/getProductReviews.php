<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include '../includes/config.php';

$id = $_GET["id"] ?? 0;
$limit = $_GET["limit"] ?? -1;

$sql = "";

if($limit == -1){
    $sql = "SELECT rev_id,reviews.user_id,product_id,text,rate,username FROM reviews,users WHERE `product_id`='$id' AND reviews.user_id=users.user_id";
}else {
    $sql = "SELECT rev_id,reviews.user_id,product_id,text,rate,username FROM reviews,users WHERE `product_id`='$id' AND reviews.user_id=users.user_id LIMIT $limit";
}
$emparray = array();
if ($result = mysqli_query($db, $sql)) {
    while($row =mysqli_fetch_assoc($result)){
        $emparray[] = $row;
    }
    echo(json_encode($emparray));
    mysqli_free_result($result);
    mysqli_close($db);
}else {
    echo(json_encode($emparray));
}

?>