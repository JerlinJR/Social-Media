<?php

include_once 'includes/Database.class.php';

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT'] . "/app/templates/$name.php";
}

function validate_credentials($username, $password)
{
    $servername = "mysql.selfmade.ninja";
    $user_name = "Jerlin";
    $pass_word = "7@XuGQYijiKBFWm";
    $dbname = "Jerlin_app";

    // Create connection
    $conn = new mysqli($servername, $user_name, $pass_word, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
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
    $servername = "mysql.selfmade.ninja";
    $user_name = "Jerlin";
    $pass_word = "7@XuGQYijiKBFWm";
    $dbname = "Jerlin_app";

    // Create connection
    $conn = new mysqli($servername, $user_name, $pass_word, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
