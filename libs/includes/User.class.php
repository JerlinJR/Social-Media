<?php

class User
{
    private $conn;

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));

        if (substr($name, 0, 3) == 'get') {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == 'set') {
            $value = strtolower(substr("$name", 3, strlen($name)-3));
            return $this->_set_data($value, $arguments[0]);
        // return $this->_set_data($value);
        } else {
            // print("User::__call() -> $name");
            throw new Exception("User::__call() -> $name, function unavaliable");
        }
    }

    public function __construct($username)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }

        $this->username = $username;
        $sql = "SELECT `id` FROM `auth` WHERE `username` OR `id` = `$username` = '$this->username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            // echo "ID : ".$this->id."\n";
            return $this->id;
        } else {
            echo "User not found";
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            // throw new Exception('User not found,Try to signup..');
        }
    }


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
                return $row['username'];
            // echo "Row returned";
            } else {
                return false;
            }
        } else {
            // No row returned
            return false;
        }
    }



    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


    private function _set_data($name, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        print($this->id."\n");

        $sql = "UPDATE `users` SET `$name` ='$data' WHERE `id` = $this->id";

        print($sql."\n");
        print($this->id."\n");

        if ($this->conn->query($sql)) {
            echo "Data Insertedd";

            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    private function _get_data($name)
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
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return null;
        }
    }
    public function setdob($date)
    {
        if (checkdate($year, $month, $day)) {
            return $this->_set_data('dob', $date);
        } else {
            return false;
        }
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//     public function setbio($bio)
//     {
//         return $this->_set_data('bio', $bio);
//     }

//     public function getbio()
//     {
//         return $this->_get_data('bio');
//     }

//     public function getavatar()
//     {
//         return $this->_get_data('avatar');
//     }

//     public function setavatar($link)
//     {
//         return $this->_set_data('avatar', $link);
//     }
//     public function getFirstName()
//     {
//         return $this->_get_data('firstname');
//     }
//     public function setFirstName($firstname)
//     {
//         return $this->_set_data('firstname', $firstname);
//     }

//     public function getLastName()
//     {
//         return $this->_get_data('lastname');
//     }
//     public function setLastName($lastname)
//     {
//         return $this->_set_data('lastname', $lastname);
//     }

//     public function getdob()
//     {
//         return $this->_get_data('dob');
//     }





//     // Need to be checked

//     public function getInstagramLink()
//     {
//         return $this->_get_data('instagram');
//     }
//     public function setInstagramLink($instagramLink)
//     {
//         return $this->_set_data('instagram', $instagramLink);
//     }
//     public function getFacebookLink()
//     {
//         return $this->_get_data('facebook');
//     }
//     public function setFacebookLink($facebookLink)
//     {
//         return $this->_set_data('facebook', $facebookLink);
//     }
//     public function getTwitterLink()
//     {
//         return $this->_get_data('twitter');
//     }
//     public function setTwitterLink($twitterLink)
//     {
//         return $this->_set_data('twitter', $twitterLink);
//     }
}
