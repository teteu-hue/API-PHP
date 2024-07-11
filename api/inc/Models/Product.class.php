<?php

require_once(dirname(__DIR__) . "/config.php");

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

}