<?php

require_once(dirname(__FILE__) . '/Models/Client.class.php');
require_once(dirname(__FILE__) . '/Models/User.class.php');
require_once(dirname(__FILE__) . '/Models/Product.class.php');

class api_logic
{

    private $endpoint;
    private $params;

    // ===============================================
    public function __construct($endpoint, $params = null)
    {
        // define the object/class properties
        $this->endpoint = $endpoint;
        $this->params = $params;
    }

    // check if the endpoint is a valid class
    public function endpoint_exists()
    {
        return method_exists($this, $this->endpoint);
    }

    // standard response
    private function send_data($status = '', $message = '', $body = null)
    {
        $data = [
            'status' => $status,
            'message' => $message,
            'body' => $body
        ];
        return $data;
    }

    /** VERIFY IF PARAMS IN URL EXIST */
    private function params_exists($param)
    {
        if (key_exists($param, $this->params)) {

            if (empty($this->params[$param])) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function status()
    {
        return $this->send_data('SUCCESS', 'API IS RUNNING OK');
    }

    /* GET ROUTES */
    public function get_all_clients()
    {
        $client = new Client();
        $result = $client->get_all_clients();
        return $this->send_data(200, '', $result);
    }

    public function get_client()
    {
        if ($this->params_exists('id')) {

            if ($clean_id = filter_var($this->params['id'], FILTER_SANITIZE_NUMBER_INT)) {
                $id = filter_var($clean_id, FILTER_VALIDATE_INT);

                $client = new Client();
                $result = $client->get_client($id);
                if (count($result) <= 0) {
                    return $this->send_data(404);
                } else {
                    return $this->send_data(200, '', $result);
                }
            }
        } else {
            return $this->send_data(415, 'To use this endpoint you need to specify a ID', []);
        }
    }

    public function get_all_active_clients()
    {
        $client = new Client();
        $result = $client->get_all_active_clients();
        return $this->send_data(200, '', $result);
    }

    public function get_all_inactive_clients()
    {
        $client = new Client();
        $result = $client->get_all_inactive_clients();
        return $this->send_data(200, '', $result);
    }

    public function get_all_users()
    {
        $user = new User();
        $result = $user->get_all_users();
        return $this->send_data(200, '', $result);
    }

    public function get_user()
    {
        if ($this->params_exists('id')) {

            if ($clean_id = filter_var($this->params['id'], FILTER_SANITIZE_NUMBER_INT)) {
                $id = filter_var($clean_id, FILTER_VALIDATE_INT);

                $user = new User();
                $result = $user->get_user($id);
                if (count($result) <= 0) {
                    return $this->send_data(404);
                } else {
                    return $this->send_data(200, '', $result);
                }
            }
        } else {
            return $this->send_data(415, "Please inform a 'id' to user");
        }
    }

    public function get_all_active_users()
    {
        $user = new User();
        $result = $user->get_all_active_users();
        return $this->send_data(200, '', $result);
    }

    public function get_all_inactive_users()
    {
        $user = new User();
        $result = $user->get_all_inactive_users();
        return $this->send_data(200, '', $result);
    }

    public function get_all_products()
    {
        $product = new Product();
        $result = $product->get_all_products();
        return $this->send_data(200, '', $result);
    }

    public function get_product()
    {
        if ($this->params_exists('id')) {
            $clean_id = filter_var($this->params['id'], FILTER_SANITIZE_NUMBER_INT);
            $id = filter_var($clean_id, FILTER_VALIDATE_INT);

            $product = new Product();
            $result = $product->get_product($id);
            if (count($result) <= 0) {
                return $this->send_data(404);
            } else {
                return $this->send_data(200, '', $result);
            }
        } else {
            return $this->send_data(415, "Please inform a 'id'");
        }
    }

    public function get_all_active_products()
    {
        $product = new Product();
        $result = $product->get_all_active_products();
        unset($product);
        return $this->send_data(200, '', $result);
    }

    public function get_all_inactive_products()
    {
        $product = new Product();
        $result = $product->get_all_inactive_products();
        return $this->send_data(200, '', $result);
    }

    public function get_all_products_without_stock()
    {
        $product = new Product();
        $result = $product->get_all_products_without_stock();
        return $this->send_data(200, '', $result);
    }

    public function get_all_products_with_stock()
    {
        $product = new Product();
        $result = $product->get_all_products_with_stock();
        return $this->send_data(200, '', $result);
    }

    public function get_all_products_with_min_and_max_stock()
    {
        $product = new Product();
        $status_code = 200;
        if ($this->params_exists('min') && $this->params_exists('max'))
        {
            $min = $this->params['min'];
            $max = $this->params['max'];
            $result = $product->get_all_products_with_min_and_max_stock($min, $max);
        } else if($this->params_exists('min') && !$this->params_exists('max'))
        {
            $min = $this->params['min'];
            $max = null;
            $result = $product->get_all_products_with_min_and_max_stock($min, $max);
        } else if(!$this->params_exists('min') && $this->params_exists('max'))
        {
            $min = null;
            $max = $this->params['max'];
            $result = $product->get_all_products_with_min_and_max_stock($min, $max);
        } else {
            $result = "@param 'min' and @param 'max' not exist's";
            $status_code = 415;
        }
        return $this->send_data($status_code, '', $result);
    }

    public function get_all_orders()
    {
    }

    /* INSERTS FUNCTIONS */
    public function create_client()
    {
        $client = new Client();

        if (isset($this->params['name'])) {
            if (empty($this->params['name'])) {
                $name = null;
            } else {
                $name = $this->params['name'];
            }
        } else {
            return $this->send_data(415, "You need to inform at least param 'name'");
        }

        if (empty($this->params['phone'])) {
            $phone = null;
        } else {
            $phone = $this->params['phone'];
        }

        if (empty($this->params['address'])) {
            $address = null;
        } else {
            $address = $this->params['address'];
        }

        $result = $client->create_client($name, $phone, $address);

        return $this->send_data(201, 'SUCCESS!', $result);
    }
}
