<?php

namespace framework;

use framework\Except;

class Controller extends BaseSingleClass
{
    public $layout = 'base';
    public $viewPath = '';


    function __construct(){
        $this->tplPath = BASE_DIR.'views/';
        $cnrl = str_replace('\\', DIRECTORY_SEPARATOR . 'views/', get_called_class());
        $this->viewPath = BASE_DIR.strtolower(str_replace('Controller','',$cnrl) ).'/';
    }

    public function renderView($filename, $variables=array())
    {
        $fullpath = $this->viewPath . str_replace('..','',$filename).'.php';
        extract($variables);
        if( file_exists($fullpath) ){
            ob_start();
            include $fullpath;
            return ob_get_clean();
        }else
            throw new Except('Файл '.$fullpath.' не найден');
    }

    function __call($methodName, $args=array()){
        if (method_exists($this, $methodName))
            return call_user_func_array(array($this,$methodName),$args);
        else
            throw new Except('Контроллер '.get_called_class().' НЕ содержит метод '.$methodName);
    }
}