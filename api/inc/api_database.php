<?php

require_once(dirname(__FILE__) . '/database.php');
require_once(dirname(__FILE__) . '/config.php');

class api_database extends Dao
{
    /*
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
    */
    // analisa um array de parâmetros
    /**
     * @param params -> array de parâmetros vindos da query string
     * @param param -> array de parâmetros que precisam estar na query string para serem analisados
     * @return SQLString
     * Se o @param 1 'status' e o @param 2 'texto', você consegue analisar usando essa função
     */
    /*
    private function check_array_param($arr, $param)
    {
        if (count($param) > 2) {
            die("Many arguments in function 'check_array_param'");
        }
        // se existir o parâmetro a ser analisado
        if (isset($arr[$param[0]])) {

            $analyzed_parameter = $arr[$param[0]];

            // verifica se os valores passados são diferentes de true ou false
            if (($analyzed_parameter != 'true' && $analyzed_parameter != 'false')) {
                return $param[0];
            }

            // converte os valores 'true' e 'false' para boolean
            $analyzed_parameter = ($analyzed_parameter == 'true' ? true : false);

            // serve para manipular strings
            if (isset($arr[$param[1]])) {

                if ($analyzed_parameter == true) {
                    $this->sql .= "AND $param[0] IS NOT NULL ";
                }

                if ($analyzed_parameter == false) {
                    $this->sql .= "AND $param[0] IS NULL ";
                }
            } else {
                if ($analyzed_parameter == true) {
                    $this->sql .= "WHERE $param[0] IS NOT NULL ";
                }

                if ($analyzed_parameter == false) {
                    $this->sql .= "WHERE $param[0] IS NULL ";
                }
            }
        }

        return $this->sql;
    }
    */

    /** ***** G E T S ***** */
    public function get_all_users()
    {
        $this->sql = BASE_SELECT_QUERY_USERS;
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_user($id)
    {
        $this->sql = BASE_SELECT_QUERY_USERS . " WHERE id_user = $id";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_active_users()
    {
        // return all active clients
        $this->sql = BASE_SELECT_QUERY_USERS . " WHERE status IS TRUE";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_inactive_users()
    {
        // return all active clients
        $this->sql = BASE_SELECT_QUERY_USERS . " WHERE status IS FALSE";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_products()
    {
        $this->sql = BASE_SELECT_QUERY_PRODUCT;
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_product($id)
    {
        $this->sql = BASE_SELECT_QUERY_PRODUCT . " WHERE id_product = $id";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_active_products()
    {
        $this->sql = BASE_SELECT_QUERY_PRODUCT . " WHERE status IS TRUE";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_inactive_products()
    {
        $this->sql = BASE_SELECT_QUERY_PRODUCT . " WHERE status IS FALSE";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_clients()
    {
        $this->sql = BASE_SELECT_QUERY_CLIENTS;
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_client($id)
    {
        $this->sql = BASE_SELECT_QUERY_CLIENTS . " WHERE id_client = $id";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_active_clients()
    {
        $this->sql = BASE_SELECT_QUERY_CLIENTS . " WHERE status is TRUE";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_inactive_clients()
    {
        $this->sql = BASE_SELECT_QUERY_CLIENTS . " WHERE status is FALSE";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    /* ***** P O S T ***** */

    public function create_client()
    {

    }

};
