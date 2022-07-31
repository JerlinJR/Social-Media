<?php

class User
{
    private $conn;


    public static function signup($username, $password, $email, $phone)
    {
        $options = [
            'cost' => 8,
        ];
        $pass = password_hash($password, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();
        // $pass = md5($password);
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `blocked`, `active`)
    VALUES ('$username', '$pass', '$email', '$phone', '0', '1');";

        $error = false;
        if ($conn->query($sql) === true) {
            $error = false;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $error = $conn->error;
        }

        $conn->close();
        return $error;
    }
    public static function login($username, $password)
    {
        $conn = Database::getConnection();

        // $pass = md5($password);

        $sql = "SELECT * FROM `auth` WHERE `username` = '$username';";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // echo "password verifying...";
                // print_r($row);
                return $row;
            // echo "Row returned";
            } else {
                return false;
            }
        } else {
            // No row returned
            return false;
        }
    }

    public function __construct($username)
    {
        $conn = Database::getConnection();

        $this->username = $username;

        $this->sql = "SELECT * FROM `auth` WHERE `username` = '$this->username'";
        $this->result = $conn->query($this->sql);

        if ($this->result->num_rows == 1) {
            $this->row = $this->result->fetch_assoc();
            $this->id = $this->row['id'];
        // return $this->row;
        } else {
            throw new Exception('User not found,Try to signup..');
        }

        // Exception for the username which is not found in database
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


    private function setData($name, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "UPDATE `users` SET `$name` ='$data' WHERE `id` = $this->id";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            // echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    private function getData($name)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "SELECT `$name` FROM `users` WHERE `id` = '$this->id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc()["$name"];
            return $row;
        } else {
            return null;
        }
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    public function setbio($bio)
    {
        return $this->setData('bio', $bio);
    }

    public function getbio()
    {
        return $this->getData('bio');
    }

    public function getavatar()
    {
        return $this->getData('avatar');
    }
    
    public function setavatar($link)
    {
        return $this->setData('avatar',$link);
    }
    public function getFirstName()
    {
        return $this->getData('firstname');
    }
    public function setFirstName($firstname)
    {
        return $this->setData('firstname',$firstname);

    }

    public function getLastName()
    {
        return $this->getData('lastname');
    }
    public function setLastName($lastname)
    {
        return $this->setData('lastname',$lastname);
    }

    public function getdob()
    {
        return $this->getData('dob');
    }


    // Need to be checked
    public function setdob($date)
    {
        return $this->setData('dob',$date);
    }
    public function getInstagramLink()
    {
        return $this->getData('instagram');
    }
    public function setInstagramLink($instagramLink)
    {
        return $this->setData('instagram', $instagramLink);
    }
    public function getFacebookLink()
    {
        return $this->getData('facebook');
    }
    public function setFacebookLink($facebookLink)
    {
        return $this->setData('facebook', $facebookLink);
    }
    public function getTwitterLink()
    {
        return $this->getData('twitter');
    }
    public function setTwitterLink($twitterLink)
    {
        return $this->setData('twitter', $twitterLink);
    }
}

