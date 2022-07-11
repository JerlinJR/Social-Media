<?php 

    function load_template($name){
        include $_SERVER['DOCUMENT_ROOT'] . "/app/templates/$name.php";
    }

    function validate_credentials($username,$password){
        if($username=="jerlin@jerlin.com" && $password == "1" ){
            return true;
        } else {
            return false;
        }
    }