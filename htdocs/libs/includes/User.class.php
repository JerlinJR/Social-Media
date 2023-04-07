<?php

include_once __DIR__.'/../traits/SQLGetterSetter.trait.php';


    /**
     *  User Class  __construct($username) Check the existence of user in DB
     *
     * @param return the User id
     */
class User
{
    use SQLGetterSetter;

    private $conn;

    public function __construct($username)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->username = $username;
        $this->id = null;
        $this->table = 'auth';
        // echo "Username : ".$this->username."\n";
        $sql = "SELECT `id` FROM `auth` WHERE `username`= '$username' OR `id` = '$username' OR `email` = '$username' LIMIT 1";
        // echo $sql;
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            // echo "ID : ".$this->id."\n";
            return $this->id;
        } else {
            // echo "User not found";
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


        //PHP 7.4 - all MySQLi errors are throws as Exceptions
        // $error = false;
        // if ($conn->query($sql) === true) {
        //     $error = false;
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        //     $error = $conn->error;
        // }

        //PHP 8.1 - all MySQLi errors are throws as Exceptions
        try {
            return $conn->query($sql);
        } catch (Exception $e) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            return false;
        }
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
            // echo "Login Aagala :(";
            } else {
                return false;
            }
        } else {
            // No row returned
            return false;
        }
    }



    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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
