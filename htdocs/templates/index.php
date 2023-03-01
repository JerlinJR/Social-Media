<main>
<?php

if(Session::isAuthenticated()){
    Session::loadTemplate('index/section');
} else {
    Session::loadTemplate('index/login');
}

Session::loadTemplate('index/main');

?>
</main>
