<?php

class WebAPI{

    public function __construct()
    {
        if(php_sapi_name() == "cli"){
            global $__siteConfig;
            $__siteConfig = file_get_contents("/home/Jerlin/databaseConfig.json");
            print($__siteConfig);
        } else if(php_sapi_name() == "apache2handler") {
            global $__siteConfig;
            $__siteConfig = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../databaseConfig.json');

        }
        Database::getConnection();
    }

    public function initiateSession(){
        // Session::start();

    }

}