<?php
namespace framework;


class HandelMethodPost extends AbstractRequest
{
    private $params;
    private $requestParams;

    public function __construct()
    {
        $this->params = null;
        $this->requestParams = null;
    }

    public function setParamesFromRequest($params)
    {
        $this->params = $params['REQUEST_URI'];

        // Делать ТАК! Для API с JSON $_POST не заполняется!!!!!!
        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);

        if (isset($_POST)){
            $this->requestParams = $_POST;
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