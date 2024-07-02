<?php

require_once(dirname(__FILE__) . '/database.php');

class api_database extends Dao
{
    public function get_all_users()
    {
        $sql = 'SELECT username AS user, email, role FROM Users';
        
        $result = $this->runQuery($sql);
        return $result;
    }

    public function get_all_products()
    {
        $sql = 'SELECT * FROM Products';
        $result = $this->runQuery($sql);
        return $result;
    }
};
