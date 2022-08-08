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
    if(Session::get('session_token')){
        $Session = new UserSession(Session::get('session_token'));
        if($Session->removeSession()){
            echo "Removing Session Token from Database and Logging out..";
        } else {
            echo "Unable to remove token from Database";

        }
    }
    Session::destroy();
    die("Session Destroyed, <a href='logintest.php'>Login again</a>");
} 


$result = null;
if (Session::get('session_token')) {
    if(UserSession::authorize(Session::get('session_token'))){
        echo "Welcome Back , $user";
        // echo Session::get('session_token');
    } else {
        $session_obj = new UserSession(Session::get('session_token'));
        if($session_obj->removeSession()){
        Session::destroy();
        }
        die("Sorry,Session Timed Out, <a href='logintest.php'>Login Again</a>");
    }

} else {

    if(UserSession::authenticate($user,$pass)){
    echo "New Login Sucess ",$user;
    } else {
        die("New Login Failed");
    }
}

echo <<<EOL
<br><br><a href="logintest.php?logout">Logout</a>
EOL;





// if (Session::get('session_token')) {
//     if(Session::authorize(Session::get('session_token')))

// } else {
//     printf("No session found, trying to login now");
//     $result = UserSession::authenticate($user, $pass);

//     if ($result) {
//         $userobj =  new User($user);
//         // print_r($userobj);
//         echo "Login Sucess," .$userobj->getFirstname()."\n";
//         echo "Your token is :" . $result."\n";
//         Session::set('session_token', $result);
//         Session::set('session_username', $userobj->username);
//         echo "This is session_username : ".Session::get('session_username');
//     // echo $userobj->username;
//     } else {
//         echo "Login Failed,$user <br>";
//     }
// }

// echo <<<EOL
// <br><br><a href="logintest.php?logout">Logout</a>
// EOL;




?>

</pre>