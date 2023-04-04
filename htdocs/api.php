<?php

include 'libs/load.php';

$api = new API();
try{
    $api->processApi();
} catch (Expection $e){
    $api->die($e);
}