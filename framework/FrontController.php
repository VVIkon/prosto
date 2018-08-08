<?php
namespace framework;
use framework\AbstractRequest;
use framework\HandelMethodGet;
use framework\HandelMethodPost;
use framework\OperController;


//require_once(dirname(__FILE__).'/AbstractRequest.php');
//
//require_once(dirname(__FILE__) . '/HandelMethodGet.php');
//require_once(dirname(__FILE__) . '/HandelMethodPost.php');

/**
 *  @property  AbstractRequest $Method
 */

class FrontController
{
    private $routes;
    private $request;
    private $requestParams = null;
    private $Method;

    public function __construct()
    {
        $this->routes = require('router.php');
        $this->request = $_SERVER;
    }

    private function setMethod(){
        $this->Method = AbstractRequest::getMethod($this->request['REQUEST_METHOD']);
    }

    /**
     * Добываем строку URI
     * @return mixed
     */
    public function getParams()
    {
        $params = null;
        $this->setMethod();
        $this->Method->setParamesFromRequest($this->request);
        $this->requestParams = $this->Method->getParams();
        $params = $this->Method->getURL();
        return $params;
    }

    /**
     * Ищем в роутах
     * @param $params
     * @return array|string
     */
    private function getControllerByRoute($params)
    {

        foreach ($this->routes as $key=>$val){
            if($key === $params ){
                return explode('->', $val);
            }
        }
        return null;
    }

    /**
     * Создаём контроллер по параметрам из массива
     * @param $arr
     * @return null
     */
    public function makeController($params)
    {
        $responce = null;
        $arr = $this->getControllerByRoute($params);
        if (is_null($arr)){
            return "Error: Путь {$params} не найден";
        }

        if (isset($arr[0]) && isset($arr[1])){
            $controller = "framework\\".$arr[0];
            $method = 'action'.ucfirst($arr[1]);

            if (class_exists($controller)){
                $Controller = new $controller();
                if (method_exists($Controller, $method)){
                    $responce = $Controller->$method($this->requestParams);
                }else{
                    $responce = "Error: Метод {$method} не найден";
                }
            }else{
                $responce = "Error: Контроллер {$controller} не найден";
            }
        }
        return $responce;
    }

}