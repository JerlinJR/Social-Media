<?php



include "libs/load.php";

// print_r($__site_config);

print(get_config('db_server'));
print(get_config('db_username'));
print(get_config('db_password'));
print(get_config('db_name'));




// $servername = "mysql.selfmade.ninja";
// $username = "Jerlin";
// $password = "7@XuGQYijiKBFWm";
// $dbname = "Jerlin_app";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successffully";

