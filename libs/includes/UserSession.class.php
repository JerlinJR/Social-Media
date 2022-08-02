<?php

class UserSession
{
    public static function authenticate($user, $pass)
    {
        $username = User::login($user, $pass);
        $user = new User($username);
        if ($username) {
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 999999) .$ip.$user_agent.time());
            $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`)
            VALUES ('$user->id', '$token', now(), '$ip', '$user_agent', '1');";
            if($conn->query($sql)) {
                Session::set('session_token', $token);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function __construct($id)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->id = $id;
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `$id` = '$this->id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid'];
            return $this->id;
        } else {
            throw new Exception('Session is invalid');
        }
    }
}
