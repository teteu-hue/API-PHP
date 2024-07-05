<?php

require_once(dirname(__FILE__) . '/database.php');

class api_database extends Dao
{
    private $sql;

    public function check_active_param($params){
        if(isset($params['active']))
        {
            if ($params['active'] != 'true' && $params['active'] != 'false') {
                return 'active';
            }
            
            $active = ($params['active'] == 'true' ? true : false);
            
            if ($active == true) 
            {
                $this->sql .= ' WHERE status IS NOT FALSE';
            }

            if ($active == false) 
            {
                $this->sql .= ' WHERE status IS FALSE';
            }   
        }
        return $this->sql;
    }

    public function check_email_param($params)
    {
        
        if(isset($params['email']))
        {
            if(isset($params['active'])){
                
                $email = ($params['email'] == 'true' ? true : false);

                if($email == true)
                {
                    $this->sql .= ' AND email IS NOT NULL';
                }

                if($email == false)
                {
                    $this->sql .= ' AND email IS NULL';
                }

            } else {
                $email = ($params['email'] == 'true' ? true : false);

                if($email == true)
                {
                    $this->sql .= ' WHERE email IS NOT NULL';
                }

                if($email == false)
                {
                    $this->sql .= ' WHERE email IS NULL';
                }
            }
        }
        return $this->sql;
    }

    public function get_all_users($params = null)
    {
        $this->sql = 'SELECT username AS user, email, role FROM Users';

        $this->check_active_param($params);
        $this->check_email_param($params);

        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_products()
    {
        $sql = 'SELECT * FROM Products';
        $result = $this->runQuery($sql);
        return $result;
    }
};
