<?php

require_once(dirname(__FILE__) . '/database.php');

class api_database extends Dao
{

    public function get_all_users($params = null)
    {
        $sql = 'SELECT username AS user, email, role FROM Users';

        if(isset($params['active']))
        {
            if ($params['active'] != 'true' && $params['active'] != 'false') {
                return false;
            }
            
            $active = ($params['active'] == 'true' ? true : false);
            
            if ($active == true) 
            {
                $sql .= ' WHERE status IS NOT FALSE';
            }

            if ($active == false) 
            {
                $sql .= ' WHERE status IS FALSE';
            }
        }

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
