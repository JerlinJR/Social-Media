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
            $fingerprint = $_POST['fingerprint'];
            // echo $_POST['fingerprint'];
            $token = md5(rand(0, 999999) .$ip.$user_agent.time());
            $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `finger_print`, `active`)
            VALUES ('$user->id', '$token', now(), '$ip', '$user_agent', '$fingerprint', '1')";
            // echo $sql;
            if ($conn->query($sql)) {
                Session::set('session_token', $token);
                Session::set('fingerprint',$fingerprint);
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
                            if($_SESSION['fingerprint'] == $session->getFingerPrint()){
                                Session::$user = $session->getUser();
                                // echo Session::$user;
                                return $session;
                            } else {
                                throw new Exception("FigerPrint does'nt match");
                            }
                        } else {
                            throw new Exception("User Agent does'nt match");
                        }
                    } else {
                        throw new Exception("IP Adress does'nt match");
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

    public function getUser()
    {
        return new User($this->uid);
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

    public function getFingerPrint(){
        if(isset($this->data['finger_print'])){
            return $this->data['finger_print'];
        } else {
            throw new Exeception("Fingerprint not found in Database");
            return false;
        }
    }




}
