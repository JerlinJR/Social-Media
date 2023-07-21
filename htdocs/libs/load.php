<?php

//TODO: Implement autoload with spl_autoload_register();
require 'vendor/autoload.php';
include_once 'includes/Database.class.php';
include_once 'includes/User.class.php';
include_once 'includes/Session.class.php';
include_once 'includes/UserSession.class.php';
include_once 'includes/WebAPI.class.php';
include_once 'app/Post.class.php';
include_once 'traits/SQLGetterSetter.trait.php';
include_once 'includes/REST.class.php';
include_once 'includes/API.class.php';


global $__site_config;
/*
Note: Location of configuration
in lab : /home/user/phtogramconfig.json
in server: /var/www/photogramconfig.json
*/


$wapi = new WebAPI();
$wapi->initiateSession();

function get_config($key, $default=null)
{
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

function get_config2($key, $default = null, $configString = null)
{
    if ($configString === null) {
        global $__site_config;
        $configString = $__site_config;
    }

    $array = json_decode($configString, true);
    if ($array !== null && isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT'] .get_config("base_path")."/templates/$name.php";
    // include $_SERVER['DOCUMENT_ROOT']."/templates/$name.php";

    // include $_SERVER['DOCUMENT_ROOT'] .get_config('base_path')."templates/$name.php";

}

// function validate_credentials($username, $password)
// {
//     $conn = Database::getConnection();

//     $sql = "SELECT `id`, `username`, `password`,`email` FROM `auth` WHERE username = '$username';";
//     $result = $conn->query($sql);

//     $error = false;
//     if ($result->num_rows > 0) {
//         $row = mysqli_fetch_assoc($result);
//         if ($row['password'] == $password) {
//             echo 'Login sucess';
//             $error = false;
//         } else {
//             echo 'Login failed';
//             $error = true;
//         }
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//         $error = $conn->error;
//     }
//     return $error;
//     print($error);
// }

function signup($username, $password, $email, $phone)
{
    $conn = Database::getConnection();

    $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `blocked`, `active`)
VALUES ('$username', '$password', '$email', '$phone', '0', '1');";

    $error = false;
    if ($conn->query($sql) === true) {
        $error = false;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $error = $conn->error;
    }

    $conn->close();
    return $error;
}
