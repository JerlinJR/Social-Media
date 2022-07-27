<?php

class Database
{
    public static $conn = null;

    public static function getConnection()
    {
        if (Database::$conn == null) {

            $servername = "mysql.selfmade.ninja";
            $user_name = "Jerlin";
            $pass_word = "7@XuGQYijiKBFWm";
            $dbname = "Jerlin_app";
     
            // Create connection
            $connection = new mysqli($servername, $user_name, $pass_word, $dbname);
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            } else {
                Database::$conn = $connection;
                return Database::$conn;
            }
        } else {
            return Database::$conn;
        }
    }
}