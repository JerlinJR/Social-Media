<?php

include_once "libs/load.php";

$fname = $_GET['name'];

$upload_path = get_config('upload_path');

$image_path = $upload_path.$fname;

//This code prevent directory traversal vulnerablity
$image_path = str_replace("..","",$image_path);

if(is_file($image_path)){
    
    //TODO: Security Things to be done
    // TODO: Caching Not working
    header('Content-Type:'.mime_content_type($image_path));
    header('Content-Length:'.filesize($image_path));
    header('Cache-Control: max-age=172800');
    echo file_get_contents($image_path);
}



