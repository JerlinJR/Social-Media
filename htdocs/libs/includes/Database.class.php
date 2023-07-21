<?php

class Database
{
    public static $conn = null;

    /**
     * This function will return the Database Connection
     *
     * @return mysqli
     */


    public static function getConnection()
    {
        if (Database::$conn == null) {
            $servername = get_config("db_server");
            $user_name = get_config("db_username");
            $pass_word = get_config("db_password");
            $dbname = get_config("db_name");
            
            // Create connection
            try {
                Database::$conn = new mysqli($servername, $user_name, $pass_word, $dbname);
            } catch (Exception $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

            // Check connection
            if (Database::$conn->connect_error) {
                die("Connection failed: " . Database::$conn->connect_error);
            }
            return Database::$conn;
    }

}