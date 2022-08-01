<pre>
<?php
include 'libs/load.php';



// print_r($_POST);

// $conn = Database::getConnection();
// $conn = Database::getConnection();
// $conn = Database::getConnection();


$user = "admin";
$pass = "1";




if (isset($_GET['logout'])) {
    Session::destroy();
    die("Session Destroyed, <a href='logintest.php'>Login again</a>");
}

$result = null;
if (Session::get('isLoggedIn')) {
    $username = Session::get('session_username');
    $userobj =  new User($username);
    // printf("Welcome Back, $userdata[username]");
    printf("Welcome Back, ".$userobj->getFirstname());
} else {
    printf("No session found, trying to login now");
    $result = User::login($user, $pass);
    if ($result) {
        $userobj =  new User($user);

        // print_r($userobj); 
        echo "Login Sucess," .$userobj->getBio();
        Session::set('isLoggedIn', true);
        Session::set('session_username', $result);
    } else {
        echo "Login Failed,$user <br>";
    }
} 

echo <<<EOL
<br><br><a href="logintest.php?logout">Logout</a>
EOL;









?>

</pre>