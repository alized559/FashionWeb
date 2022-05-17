<?php 
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    include '../includes/config.php';
    include_once "../includes/utils.php";

    $currency = $_GET["currency"] ?? "US, USD";

    $isFirstItem = true;

    $prodsql = "";

    function AddToSQL($sql){
        global $isFirstItem;
        global $prodsql;
        if($isFirstItem){
            $isFirstItem = false;
            $prodsql = $prodsql . "WHERE " . $sql . " ";
        }else {
            $prodsql = $prodsql . "AND $sql ";
        }
    }

    $orderBy = "";
    $isFirstOrderItem = true;

    function AddToSQLOrder($sql){
        global $isFirstOrderItem;
        global $orderBy;
        if($isFirstOrderItem){
            $isFirstOrderItem = false;
            $orderBy = "ORDER BY " . $sql . " ";
        }else {
            $orderBy = $orderBy . ", $sql ";
        }
    }

    $gender = $_GET['gender'] ?? "none";
    $gender = str_replace("w", "f", $gender);
    $category = $_GET['category'] ?? "none";
    $type = $_GET['type'] ?? "none";
    $brand = $_GET['brand'] ?? "none";
    $price = $_GET['price'] ?? "none";
    $sale = $_GET['sale'] ?? "none";
    $name = $_GET['name'] ?? "none";

    if($sale == "none" && $gender == "none" && $category == "none" && $type == "none" && $brand  == "none" && $price  == "none" && $name == "none"){
        $prodsql = "SELECT prod_id,name,price,discount,brand FROM products";
    }else {
        $prodsql = "SELECT prod_id,name,price,discount,brand FROM products ";
        $isFirstItem = true;
        if($gender != "none"){
            AddToSQL("department='$gender'");
        }
        if($category != "none"){
            AddToSQL("category='$category'");
        }
        if($type != "none"){
            if($type != "all"){
                AddToSQL("type='$type'");
            }
        }
        if($brand != "none"){
            AddToSQL("brand='$brand'");
        }
        if($price != "none"){
            AddToSQLOrder("price $price");
        }
        if($sale != "none"){
            AddToSQL("discount > 0");
            AddToSQLOrder("discount $sale");
        }
        if($name != "none"){
            AddToSQL("name LIKE '%$name%'");
        }
    }

    $prodsql = $prodsql . $orderBy;

if ($result = mysqli_query($db, $prodsql)) {
    $emparray = array();
    while($row =mysqli_fetch_assoc($result)){
        if($currency != "LB, LBP"){
        }else {
          $row['price'] = $row['price'] * GetConversionRate('LBP');
          $row['discount'] = $row['discount'] * GetConversionRate('LBP');
        }
        $emparray[] = $row;
    }
    echo(json_encode($emparray));
    mysqli_free_result($result);
    mysqli_close($db);
}

?>