<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


$id = $_GET['id'] ?? 0;

$file = "../images/products/$id/banner.jpg";

if(!file_exists($file)){//Deletes the image if it exists
    $file = "../images/products/$id/banner.png";
    if(!file_exists($file)){//Deletes the image if it exists
        $file = "../images/products/$id/banner.gif";
        if(!file_exists($file)){//Deletes the image if it exists
            $file = "../images/products/defaultbanner.png";
        }
    }
}
$fp = fopen($file, 'rb');
// send the right headers
header("Content-Type: image/jpg");
header("Content-Length: " . filesize($file));
// dump the picture and stop the script
fpassthru($fp);
?>