<?php
namespace framework;
use framework\FrontController;
//use router;

//require_once(dirname(__FILE__).'/FrontController.php');
//require_once(dirname(__FILE__).'/AboutController.php');
//require_once(dirname(__FILE__).'/OperController.php');



class VI
{
    private static  $webApp = null;
    private static $config;

    public static function createWebApp()
    {
        if (!isset(self::$webApp)){
            self::$webApp = new self();
        }
        return self::$webApp;
    }

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    public function run(){
        //echo 'Привет';
        $fc = new FrontController();
        $params = $fc->getParams();
        $responce = $fc->makeController($params);
        echo $responce;

    }

}