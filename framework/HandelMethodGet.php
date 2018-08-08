<?php
namespace framework;


class HandelMethodGet extends AbstractRequest
{
    private $params;
    private $requestParams;

    public function __construct()
    {
        $this->params = null;
    }

    public function setParamesFromRequest($params)
    {
        $this->params = $params['REQUEST_URI'];
        if (isset($_GET)){
            $this->requestParams = $_GET;
        }
    }

    public function getParams()
    {
       return $this->requestParams;
    }

    public function getURL()
    {
       return $this->params;
    }

}