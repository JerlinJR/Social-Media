<?php

include_once "libs/load.php";

$fname = $_GET['name'];

$upload_path = get_config('upload_path');

$image_path = $upload_path.$fname;

if(is_file($image_path)){
    $image_path = str_replace("..","",$image_path);
    // echo $image_path;
    header('Content-Type:'.mime_content_type($image_path));
    header('Content-Length:'.filesize($image_path));
    echo file_get_contents($image_path);
}



