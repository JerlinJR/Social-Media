<?php

class UserSession
{
    private $conn;

    public function __construct($id)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->id = $id;
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `uid` = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            // print_r($this->data = $row);
            $this->uid = $row['uid'];
            $this->token = $row['token'];
            return $this->id;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            throw new Exception('Session is invalid');
        }
    }

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

    public function isValid()
    {
        $id = $this->id;
        // $sql = "SELECT * FROM `session` WHERE `uid` = $id";
        $sql = "SELECT DATE(login_time) as mydate, TIME(login_time) as mytime FROM `session`";

        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // echo $row['login_time'];
            // echo $row['mydate'];
            echo "\n".$row['mytime'];
            $as = strtotime('+ 30 minute', strtotime($row['mytime']));

            echo $as;


        // echo date('H:i:s', $row['login_time']);
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
}
