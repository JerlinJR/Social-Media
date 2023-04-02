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
            throw new Exception(__CLASS__."::__call() -> $name, function unavaliable");
        }
    }

    private function _get_data($name)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        try{
            $sql = "SELECT `$name` FROM `$this->table` WHERE `id` = '$this->id'";
            $result = $this->conn->query($sql);
            if ($result->num_rows) {
                $row = $result->fetch_assoc()["$name"];
                return $row;
            } else {
                return null;
            }
        } catch (Exception $e){
            throw new Exception(__CLASS__."::get_data() -> $name, function unavaliable");
        }

    }

        
    private function _set_data($name, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        try{
            $sql = "UPDATE `$this->table` SET `$name` ='$data' WHERE `id` = $this->id";

            print($sql."\n");
            print($this->id."\n");
    
            if ($this->conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        } catch(Exception $e){
            throw new Exception(__CLASS__."::setdata() -> $name, function unavaliable");
        }
    }
}