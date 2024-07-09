<?php

require_once(dirname(__DIR__) . "/config.php");

class Client extends Dao
{
    public function create_client($name, $phone = null, $address = null)
    {
        $this->sql = "CALL insert_customer('$name', '$phone', '$address')";
        $result = $this->runQuery($this->sql);
        var_dump($result);
        return $result;
    }
}