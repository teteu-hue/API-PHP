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

    // analisa um array de parâmetros
    /**
     * @param params -> array de parâmetros vindos da query string
     * @param param -> array de parâmetros que precisam estar na query string para serem analisados
     * @return SQLString
     * Se o @param 1 'status' e o @param 2 'texto', você consegue analisar usando essa função
     */
    private function check_array_param($params, $param)
    {
        if (count($param) > 2) {
            die("Many arguments in function 'check_array_param'");
        }
        // se existir o parâmetro a ser analisado
        if (isset($params[$param[0]])) {

            $analyzed_parameter = $params[$param[0]];

            // verifica se os valores passados são diferentes de true ou false
            if (($analyzed_parameter != 'true' && $analyzed_parameter != 'false')) {
                return $param[0];
            }

            // converte os valores 'true' e 'false' para boolean
            $analyzed_parameter = ($analyzed_parameter == 'true' ? true : false);

            // serve para manipular strings
            if (isset($params[$param[1]])) {

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
        $this->sql = "SELECT p.name, p.description, p.price, p.stock_quantity, c.name as categorie, status 
                      FROM products p 
                      INNER JOIN categories c ON c.id_categorie = p.id_categorie ";

        if($this->check_active_param($params, 'status') == 'status'){
            $result = 'status';
            return $result;
        }

        if($this->check_array_param($params, ['description', 'status']) == 'description'){
            $result = 'description';
            return $result;   
        }

        $result = $this->runQuery($this->sql);
        return $result;
    }
};
