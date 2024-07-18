<?php

require_once(dirname(__DIR__) . "/config.php");
require_once(dirname(__DIR__) . "/Dao.php");

class Product extends Dao
{
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

    public function get_all_products_without_stock()
    {
        $this->sql = BASE_SELECT_QUERY_PRODUCT . " WHERE stock_quantity <= 0";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_products_with_stock()
    {
        $this->sql = BASE_SELECT_QUERY_PRODUCT . " WHERE stock_quantity > 0";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_products_with_min_and_max_stock($min = null, $max = null)
    {
        $this->sql = BASE_SELECT_QUERY_PRODUCT;

        if($min > $max){
            return "The @param 'min' is greather than @param 'max'";
        }

        if($min == null && $max == null) {
            $this->sql;
        } else if($min != null && $max != null) {
            $this->sql .= " WHERE stock_quantity BETWEEN $min AND $max";
        } else if($min != null && $max == null){
            $this->sql .= " WHERE stock_quantity >= $min";
        } else if($min == null && $max != null){
            $this->sql .= " WHERE stock_quantity <= $max";
        }
        
        $result = $this->runQuery($this->sql);
        return $result;
    }

}