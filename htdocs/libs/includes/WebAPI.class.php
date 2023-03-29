<?php

class WebAPI{

    public function __construct()
    {
        

        // if(php_sapi_name() == "cli"){
        //     global $__siteConfig;
        //     $__siteConfig = file_get_contents("/home/Jerlin/htdocs/app/htdocs/project/databaseConfig.json");
        //     print($__siteConfig);
        // } else if(php_sapi_name() == "apache2handler") {
        //     global $__siteConfig;
        //     $__siteConfig = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../databaseConfig.json');

        // }
        
        //TODO: $__siteConfig_path is a Doubtable thing 
        $__siteConfig_path = __DIR__."/../../../project/databaseConfig.json";
        // print($__siteConfig_path);
        
        // $__siteConfig_path = $_SERVER['DOCUMENT_ROOT'].'/../project/databaseConfig.json';
        $__siteConfig = file_get_contents($__siteConfig_path);

        if(php_sapi_name() == "cli"){
            global $__siteConfig;
            $__siteConfig = file_get_contents("/home/Jerlin/htdocs/app/project/databaseConfig.json");
            print($__siteConfig);
        } else if(php_sapi_name() == "apache2handler") {
            global $__siteConfig;
            $__siteConfig = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../project/databaseConfig.json');

        }

        Database::getConnection();
    }

    public function initiateSession()
    {

        Session::start();
        if(Session::isset('session_token')){
            try{
                $session = UserSession::authorize(Session::get('session_token'));
                Session::set('user_session',$session);
            } catch (Exception $e){
                echo "Unable to create session";
            }
        } else {
            // echo "No session found try login";
            return false;
        }

    }

}