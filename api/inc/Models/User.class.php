<?php

require_once(dirname(__DIR__) . "/config.php");

class User extends Dao
{   
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
}