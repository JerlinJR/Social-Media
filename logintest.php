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
if (Session::get('session_token')) {
    $username = Session::get('session_username');
    $userobj =  new User($username);
    printf("Welcome Back, ".$userobj->getFirstname()."\n");
    // $user_session = new UserSession($userobj->id);
    $id = $userobj->id;
    $user_session = new UserSession($id);
    echo $user_session->token;
    echo $user_session->isValid();
} else {
    printf("No session found, trying to login now");
    $result = UserSession::authenticate($user, $pass);

    if ($result) {
        $userobj =  new User($user);
        // print_r($userobj);
        echo "Login Sucess," .$userobj->getFirstname()."\n";
        echo "Your token is :" . $result."\n";
        Session::set('session_token', $result);
        Session::set('session_username', $userobj->username);
        echo "This is session_username : ".Session::get('session_username');
    // echo $userobj->username;
    } else {
        echo "Login Failed,$user <br>";
    }
}

echo <<<EOL
<br><br><a href="logintest.php?logout">Logout</a>
EOL;









?>

</pre>