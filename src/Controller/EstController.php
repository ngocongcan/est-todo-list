<?php
/**
 * Class EstController
 *
 * @package  Est\TodoApp\Controller
 * @author   canngo
 *
 */

namespace Est\TodoApp\Controller;


use Est\TodoApp\Config;

class EstController
{
    private $params = array();

    /**
     * EstController constructor.
     */
    public function __construct()
    {
        $this->_parseParams();
    }

    public function get($name, $default = null) {
        if (isset($this->params[$name])) {
            return $this->params[$name];
        } else {
            return $default;
        }
    }

    private function _parseParams() {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
            $this->params = $_GET;
        } else if ($method == "POST") {
            $this->params = $_POST;
        }
    }

}
