<?php

include_once 'includes/Database.class.php';
include_once 'includes/User.class.php';
include_once 'includes/Session.class.php';

Session::start();

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT'] . "/app/templates/$name.php";
}

function validate_credentials($username, $password)
{
    $conn = Database::getConnection();

    $sql = "SELECT `id`, `username`, `password`,`email` FROM `auth` WHERE username = '$username';";
    $result = $conn->query($sql);

    $error = false;
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row['username'] == $username and $row['password'] == $password){
            echo 'Login sucess';
            $error = false;
        } else {
            echo 'Login failed';
            $error = true;
        }

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $error = $conn->error;
    }
    return $error;
    print($error);
}

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
