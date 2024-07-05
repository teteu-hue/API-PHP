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

        if (isset($params[$param[0]]) && $param[0] == 'email') {

            $email = $params[$param[0]];

            if (($email != 'true' && $email != 'false')) {
                return 'email';
            }

            $email = ($email == 'true' ? true : false);

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
        } else if((isset($params[$param[0]])) && $param[0] == 'min'){
            
            if(!isset($params[$param[1]])){   

                $clean_min = filter_var($params[$param[0]], FILTER_SANITIZE_NUMBER_INT);
                var_dump($clean_min);
                $min = filter_var($clean_min, FILTER_VALIDATE_INT);
                var_dump($min);

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
        $this->sql = 'SELECT name, description, price, stock_quantity, id_categorie, status FROM Products ';
        
        if($this->check_active_param($params, 'status') == 'status'){
            $result = 'status';
            return $result;
        }

        if($this->check_array_param($params, ['min', 'max', 'status'])){
            
        }

        $result = $this->runQuery($this->sql);
        return $result;
    }
};
