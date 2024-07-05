<?php

require_once(dirname(__FILE__) . '/database.php');

class api_database extends Dao
{
    private $sql;

    private function check_active_param($params, $param)
    {
        if (isset($params[$param])) {
            if (($params[$param] != 'true' && $params[$param] != 'false')) {
                return $param;
            }

            $active = ($params[$param] == 'true' ? true : false);

            if ($active == true) {
                $this->sql .= 'WHERE status IS NOT FALSE ';
            }

            if ($active == false) {
                $this->sql .= 'WHERE status IS FALSE ';
            }
        }
        return $this->sql;
    }

    private function check_array_param($params, $param)
    {

        if (isset($params[$param[0]])) {
            if (($params[$param[0]] != 'true' && $params[$param[0]] != 'false')) {
                return 'email';
            }

            $email = ($params[$param[0]] == 'true' ? true : false);

            if (isset($params[$param[1]])) {

                if ($email == true) {
                    $this->sql .= 'AND email IS NOT NULL';
                }

                if ($email == false) {
                    $this->sql .= 'AND email IS NULL';
                }
            } else {
                if ($email == true) {
                    $this->sql .= 'WHERE email IS NOT NULL ';
                }

                if ($email == false) {
                    $this->sql .= 'WHERE email IS NULL ';
                }
            }
        }
        return $this->sql;
    }

    public function get_all_users($params = null)
    {
        $this->sql = 'SELECT username AS user, email, role FROM Users ';

        if ($this->check_active_param($params, 'active') == 'active') {
            $result = 'active';
            return $result;
        }

        if ($this->check_array_param($params, ['email', 'active']) == 'email') {
            $result = 'email';
            return $result;
        }

        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_products($params = null)
    {
        
        $this->sql = 'SELECT * FROM Products ';

        if($this->check_active_param($params, 'status') == 'status'){
            $result = 'status';
            return $result;
        }

        $result = $this->runQuery($this->sql);
        return $result;
    }
};
