<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$id = $_POST['id'] ?? 0;
$b64 = $_POST['file'];
$img_file = "../images/users/$id/logo.jpg";
if (file_exists($img_file)) {
    unlink($img_file);
}

$img_file2 = "../images/users/$id/logo.png";
if (file_exists($img_file2)) {
    unlink($img_file2);
}

$img_file2 = "../images/users/$id/logo.gif";
if (file_exists($img_file2)) {
    unlink($img_file2);
}

$bin = base64_decode($b64);
$im = imageCreateFromString($bin);
if (!$im) {
  die('Error: Failed To Decode Image');
}
imagejpeg($im, $img_file);
imagedestroy($im);
echo "Profile Picture Changed!";
?>