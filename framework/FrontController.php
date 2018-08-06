<?php


class FrontController
{
    private $routes;
    private $request;
    private $requestParams = null;

    public function __construct()
    {
        $this->routes = require('router.php');
        $this->request = $_SERVER;
    }

    /**
     * Добываем строку URI
     * @return mixed
     */
    public function getParams()
    {

        $params = null;
        $method = $this->request['REQUEST_METHOD'];
        if ($method == 'GET') {
            $params = $this->request['REQUEST_URI'];
            if (isset($_GET)){
                $this->requestParams = $_GET;
            }
        }elseif ($method == 'POST'){
            $params = $this->request['REQUEST_URI'];
            // Делать ТАК! Для API с JSON $_POST не заполняется!!!!!!
            $rest_json = file_get_contents("php://input");
            $_POST = json_decode($rest_json, true);

            if (isset($_POST)){
                $this->requestParams = $_POST;
            }
        }

        return $params;
    }

    /**
     * Ищем в роутах
     * @param $params
     * @return array|string
     */
    public function getControllerByRoute($params)
    {

        foreach ($this->routes as $key=>$val){
            if($key === $params ){
                return explode('->', $val);
            }
        }
        return '';
    }

    /**
     * Создаём контроллер по параметрам из массива
     * @param $arr
     * @return null
     */
    public function makeController($arr)
    {
        $responce = null;
        if (isset($arr[0]) && isset($arr[1])){
            $controller = $arr[0];
            $method = 'action'.ucfirst($arr[1]);

            if (class_exists($controller)){
                $Controller = new $controller();
                if (method_exists($Controller, $method)){
                    $responce = $Controller->$method($this->requestParams);
                }
            }
        }
        return $responce;
    }

}