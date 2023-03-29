<?php

include 'libs/load.php';


if (isset($_GET['logout'])) {
    if(Session::get('session_token') and Session::get('fingerprint')){
        $Session = new UserSession(Session::get('session_token'));
            if($Session->removeSession()){
                echo "<h3>Removing Session Token from Database.</h3>";
            } else {
                echo "<h3>Unable to remove token from Database/<h3>";
            }
    }
    Session::destroy();
    header("Location:/");
    die();
} else {

    Session::renderPage();

}





