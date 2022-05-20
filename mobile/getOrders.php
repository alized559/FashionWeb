<?php 
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    include '../includes/config.php';
    $filter = $_GET['filter'] ?? "invalid";
                    
    $sql = "SELECT * FROM orders WHERE state='$filter' ORDER BY date";
    if($filter == "invalid"){
        $sql = "SELECT * FROM orders ORDER BY date";
    }
    if ($result = mysqli_query($db, $sql)) {
        $emparray = array();
        while($row =mysqli_fetch_assoc($result)){
            $emparray[] = $row;
    }
    echo(json_encode($emparray));
    mysqli_free_result($result);
    mysqli_close($db);
}

?>