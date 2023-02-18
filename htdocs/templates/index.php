<main>
<?php

if(Session::isAuthenticated()){
    Session::loadTemplate('index/section');
    
}

Session::loadTemplate('index/main');

?>
</main>
