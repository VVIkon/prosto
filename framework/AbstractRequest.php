<?php
namespace framework;
use framework\HandelMethodGet;
use framework\HandelMethodPost;

abstract class AbstractRequest
{

    public static function getMethod($method)
    {
        $methodClass = "framework\HandelMethod".ucfirst(strtolower($method));
        if (class_exists($methodClass)){
            return new $methodClass();
        }
        return null;

    }

    abstract public function setParamesFromRequest($params);
    abstract public function getURL();
    abstract public function getParams();


}