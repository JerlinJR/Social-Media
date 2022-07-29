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
        $this->conn = Database::getConnection();

        $this->username = $username;

        $this->sql = "SELECT * FROM `auth` WHERE `username` = '$this->username'";
        $this->result = $this->conn->query($this->sql);

        if ($this->result->num_rows == 1) {
            $this->row = $this->result->fetch_assoc();
            $this->id = $this->row['id'];
        // return $this->row;
        } else {
            throw new Exception('User not found,Try to signup..');
        }

        // Exception for the username which is not found in database
    }

    public function setbio($longText)
    {
        $this->$conn = Database::getConnection();

        // $id = $this->id;
        // echo $id;
        $this->sql = "UPDATE users SET bio='$longText' WHERE id = $this->id;";
        $this->result = $this->conn->query($this->sql);
        if ($this->result == true) {
            return true;
        } else {
            // echo "Something went wrong,".$this->conn->error;
            return false;
        }
    }

    public function getbio()
    {
        $this->conn = Database::getConnection();

        $this->sql = "SELECT bio FROM users WHERE id = $this->id";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            $this->row = $this->result->fetch_assoc();
            return $this->row['bio'];
        } else {
            return false;
        }
    }

    public function getavatar()
    {
        $this->$conn = Database::getConnection();
        $this->sql = "SELECT avatar FROM users WHERE id = $this->id";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            $this->row = $this->result->fetch_assoc();
            // print_r($this->row);
            return $this->row['avatar'];
        } else {
            return false;
        }
    }
    
    public function setavatar($link)
    {
        $this->$conn = Database::getConnection();

        // $id = $this->id;
        // echo $id;
        $this->sql = "UPDATE users SET avatar = '$link' WHERE id = $this->id;";
        $this->result = $this->conn->query($this->sql);
        if ($this->result == true) {
            return true;
        } else {
            // echo "Something went wrong,".$this->conn->error;
            return false;
        }
    }
    public function getFirstName()
    {
        $this->conn = Database::getConnection();

        $this->sql = "SELECT firstname FROM users WHERE id = $this->id";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            $this->row = $this->result->fetch_assoc();
            // print_r($this->row);
            return $this->row['firstname'];
        } else {
            return false;
        }
    }
    public function setFirstName($firstname)
    {
        $this->$conn = Database::getConnection();

        // $id = $this->id;
        // echo $id;
        $this->sql = "UPDATE users SET firstname='$firstname' WHERE id = $this->id;";
        $this->result = $this->conn->query($this->sql);
        if ($this->result == true) {
            return true;
        } else {
            // echo "Something went wrong,".$this->conn->error;
            return false;
        }
    }

    public function getLastName()
    {
        $this->conn = Database::getConnection();

        $this->sql = "SELECT lastname FROM users WHERE id = $this->id";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            $this->row = $this->result->fetch_assoc();
            // print_r($this->row);
            return $this->row['lastname'];
        } else {
            return false;
        }
    }
    public function setLastName($lastname)
    {
        $this->$conn = Database::getConnection();

        // $id = $this->id;
        // echo $id;
        $this->sql = "UPDATE users SET lastname='$lastname' WHERE id = $this->id;";
        $this->result = $this->conn->query($this->sql);
        if ($this->result == true) {
            return true;
        } else {
            // echo "Something went wrong,".$this->conn->error;
            return false;
        }
    }

    public function getdob()
    {
        $this->conn = Database::getConnection();

        $this->sql = "SELECT dob FROM users WHERE id = $this->id";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            $this->row = $this->result->fetch_assoc();
            return $this->row['dob'];
        } else {
            return false;
        }
    }


    // Need to be checked
    public function setdob($date)
    {
        $this->$conn = Database::getConnection();

        // $id = $this->id;
        // echo $id;
        
        if (strtotime($date) > strtotime(0)) {
            $this->sql = "UPDATE users SET dob='$date' WHERE id = $this->id;";
            $this->result = $this->conn->query($this->sql);
            if ($this->result == true) {
                return true;
            } else {
                // echo "Something went wrong,".$this->conn->error;
                return false;
            }
        }
    }
    public function getInstagramLink()
    {
        $this->conn = Database::getConnection();

        $this->sql = "SELECT instagram FROM users WHERE id = $this->id";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            $this->row = $this->result->fetch_assoc();
            return $this->row['instagram'];
        } else {
            return false;
        }
    }
    public function setInstagramLink($instagramLink)
    {
        $this->$conn = Database::getConnection();

        // $id = $this->id;
        // echo $id;
        $this->sql = "UPDATE users SET instagram='$instagramLink' WHERE id = $this->id;";
        $this->result = $this->conn->query($this->sql);
        if ($this->result == true) {
            return true;
        } else {
            // echo "Something went wrong,".$this->conn->error;
            return false;
        }
    }
    public function getFacebookLink()
    {
        $this->conn = Database::getConnection();

        $this->sql = "SELECT facebook FROM users WHERE id = $this->id";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            $this->row = $this->result->fetch_assoc();
            return $this->row['facebook'];
        } else {
            return false;
        }
    }
    public function setFacebookLink($facebookLink)
    {
        $this->$conn = Database::getConnection();

        // $id = $this->id;
        // echo $id;
        $this->sql = "UPDATE users SET facebook='$facebookLink' WHERE id = $this->id;";
        $this->result = $this->conn->query($this->sql);
        if ($this->result == true) {
            return true;
        } else {
            // echo "Something went wrong,".$this->conn->error;
            return false;
        }
    }
    public function getTwitterLink()
    {
        $this->conn = Database::getConnection();

        $this->sql = "SELECT twitter FROM users WHERE id = $this->id";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            $this->row = $this->result->fetch_assoc();
            return $this->row['twitter'];
        } else {
            return false;
        }
    }
    public function setTwitterLink($twitterLink)
    {
        $this->$conn = Database::getConnection();

        // $id = $this->id;
        // echo $id;
        $this->sql = "UPDATE users SET twitter='$twitterLink' WHERE id = $this->id;";
        $this->result = $this->conn->query($this->sql);
        if ($this->result == true) {
            return true;
        } else {
            // echo "Something went wrong,".$this->conn->error;
            return false;
        }
    }
}
