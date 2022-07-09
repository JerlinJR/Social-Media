<?php 

    function load_template($name){
        include $_SERVER['DOCUMENT_ROOT'] . "/app/templates/$name.php";
    }

