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


    function signup($username,$phone,$email,$password){
        
        $servername = "localhost";
        $username = "root";
        $password = "jerlin0853";
        $dbname = "app";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "";

        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    
    }