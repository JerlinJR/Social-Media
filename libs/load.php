<?php

include_once 'includes/Mic.class.php';

    function load_template($name)
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/templates/$name.php";
    }

    function validate_credentials($username, $password)
    {
        if ($username=="jerlin@jerlin.com" && $password == "1") {
            return true;
        } else {
            return false;
        }
    }


    function signup($username, $phone, $email, $password)
    {
        $servername = "localhost";
        $user_name = "root";
        $pass_word = "jerlin0853";
        $dbname = "app";

        // Create connection
        $conn = new mysqli($servername, $user_name, $pass_word, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO `auth` (`id`, `username`, `password`, `email`, `phone`, `blocked`, `active`) 
        VALUES (NULL, '$username', '$password', '$email', '$phone', '0', '1');";
        $error = false;
        if ($conn->query($sql) === true) {
            echo "New record created successfully";
            $error = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $error = $conn->error;
        }

        $conn->close();
        return $error;
    }
