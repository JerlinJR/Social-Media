<?php

class UserSession
{
    private $conn;

    public function __construct($token)
    {
        
        $this->conn = Database::getConnection();
        $this->token = $token;
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `token` = '$token' LIMIT 1";

        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            // print_r($this->data = $row);
            $this->uid = $row['uid'];
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error."\n";
            throw new Exception('Session is invalid');
        }
    }

    public static function authenticate($user, $pass)
    {
        $username = User::login($user, $pass);
        if ($username) {
            $user = new User($username);
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 999999) .$ip.$user_agent.time());
            $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`)
            VALUES ('$user->id', '$token', now(), '$ip', '$user_agent', '1');";
            if ($conn->query($sql)) {
                Session::set('session_token', $token);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function authorize($token){
        try{
            $session = new UserSession($token);
            if(isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER['HTTP_USER_AGENT'])){
                if($session->isValid() and $session->isActive()){
                    if($_SERVER['REMOTE_ADDR'] == $session->getIP()){
                        if($_SERVER['HTTP_USER_AGENT'] == $session->getUserAgent()){
                            return true;
                        } else {
                            throw new Exception("User Agent does'nt matched");
                        }
                    } else {
                        throw new Exception("IP Adress does'nt matched");
                    }
                } else {
                    throw new Exception("Invalid Session");
                }


            } else {
                throw new Exception("UserAgent and IP Address are empty");
            }
        }
        catch (Exception $e){
            return false;
        }

    }


    public function isValid()
    {

        if(isset($this->data['login_time'])){
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
            if (3600 > time() - $login_time->getTimestamp()) {
                return true;
            } else {
                // return $this->removeSession();
                return false;
            }
        } else {
            throw new Exception("Invalid Login");
        }

    }

    public function isActive(){
        if(isset($this->data['active'])){
            return $this->data['active'] ? true : false;
        }
    }

    public function getIp(){
        if(isset($this->data['ip'])){
            return $this->data['ip'];
        } else {
            return false;
        }
    }

    public function getUserAgent(){
        if(isset($this->data['user_agent'])){
            return $this->data['user_agent'];
        } else {
            return false;
        }
    }

    public function removeSession(){
        if(Session::get('session_token')){
            if(!$this->conn){
                $this->conn = Database::getConnection();
            }
            $sql = "DELETE FROM `session` WHERE `uid` = $this->uid";
            if($this->conn->query($sql)){
                return true;
            }
        } else {
            return false;
        }
    }




}
