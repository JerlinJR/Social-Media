<?php

class Session
{

    public static $isError = false;
    public static $user = null;
    public static $usersession = null;
    public static function start()
    {
        session_start();

    }

    public static function unset()
    {
        sesstion_unset();

    }

    public static function destroy()
    {
        session_destroy();

    }

    public static function getUser()
    {
        return Session::$user;
    }


    public static function set($key,$value)
    {
        $_SESSION[$key] = $value;
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public static function isset($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function get($key,$default=false)
    {
        if(Session::isset($key)){
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    public static function getUserSession(){
        return Session::get('user_session');
    }

    public static function loadTemplate($name){
        $script = $_SERVER['DOCUMENT_ROOT'] .get_config("base_path")."templates/$name.php";
        if(is_file($script)){
            include_once $script;
        } else {
            Session::loadTemplate('_error');
        }
    }

    public static function renderPage(){
        Session::loadTemplate('_master');
    }

    /**
     * Return PHP  without .php
     *
     * @return filename
     */
    public static function currentScript(){
        return basename($_SERVER["PHP_SELF"],'.php');
    }

    public static function isAuthenticated(){
        //TODO:Is it a correct Implementation?
        return Session::getUserSession();
        // return true;
    
    }





}