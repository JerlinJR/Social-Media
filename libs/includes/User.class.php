<?php

class User
{   
    public static function signup($username, $password, $email, $phone)
    {
        
        $options = [
            'cost' => 8,
        ];
        $pass = password_hash($password, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();
        // $pass = md5($password);
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `blocked`, `active`)
    VALUES ('$username', '$pass', '$email', '$phone', '0', '1');";

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
    public static function login($username, $password)
    {
        $conn = Database::getConnection();

        // $pass = md5($password);

        $sql = "SELECT * FROM `auth` WHERE `username` = '$username';";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password,$row['password'])) {
                // echo "password verifying...";
                // print_r($row);
                return $row;
                // echo "Row returned";
            } else {
                return false;
            }
        } else {
            // No row returned
            return false;
        }
    }
}
