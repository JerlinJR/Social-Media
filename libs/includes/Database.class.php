<?php

class Database
{
    public static $conn = null;

    public static function getConnection()
    {
print("Entering to GetConnection()");
        if (Database::$conn == null) {
print("Database conn null");

            $servername = "localhost";
            $username = "root";
            $password = "jerlin0853";
            $dbname = "app";
     
            // Create connection
            $connection = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            } else {
print("New connection");
                
                Database::$conn = $connection;
                return Database::$conn;
            }
        } else {
            print("exixting conn");


            return Database::$conn;
        }
    }
}
