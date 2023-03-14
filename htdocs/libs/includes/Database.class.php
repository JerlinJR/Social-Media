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
            $servername = get_config('db_server');
            $user_name = get_config('db_username');
            $pass_word = get_config('db_password');
            $dbname = get_config('db_name');
     
       
        //     $connection = new mysqli($servername, $user_name, $pass_word, $dbname);
    
        //     if ($connection->connect_error) {
        //         die("Connection failed: " . $connection->connect_error);
        //     } else {

        //         echo "Initial Database Connection";

        //         Database::$conn = $connection;
        //         return Database::$conn;
        //     }
        // } else {

        //     echo "Reusing Database Connection";
        //         return Database::$conn;
        // }

        $conn = mysqli_connect($servername, $username, $password, $dbname);

                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }
                echo "Connected successfully";
                        Database::$conn = $conn;
                        return Database::$conn;
                }  else {
                    return Database::$conn;
                }
}

}