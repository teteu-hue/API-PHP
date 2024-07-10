<?php

require_once(dirname(__DIR__) . "/config.php");

class Client extends Dao
{
    public function create_client(string $name, string $phone = null, string $address = null)
    {
        $this->sql = "CALL insert_customer('$name', '$phone', '$address')";
        
        $result = $this->runQuery($this->sql);
        return $result;
    }
}