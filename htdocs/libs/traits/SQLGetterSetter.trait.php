<?php

trait SQLGetterSetter{

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));

        if (substr($name, 0, 3) == 'get') {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == 'set') {
            return $this->_set_data($property, $arguments[0]);
        } else {
            throw new Exception($this->table."::__call() -> $name, function unavaliable");
        }
    }

    private function _get_data($name)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "SELECT `$name` FROM `$this->table` WHERE `id` = '$this->id'";
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc()["$name"];
            return $row;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return null;
        }
    }

        
    private function _set_data($name, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        print($this->id."\n");

        $sql = "UPDATE `$this->table` SET `$name` ='$data' WHERE `id` = $this->id";

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
}