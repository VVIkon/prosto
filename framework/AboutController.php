<?php


class AboutController
{
    public function actionAbout($params = null)
    {
        return '<h2>О нас ...</h2>';
    }

    public function actionSave($params)
    {
        $out = 'чёт не то...';
        if (isset($params) && count($params) > 0){
            $out  = "<h2>{$params['name']} {$params['lastName']}</h2>";
            $out .= "<p>Возраст: {$params['age']}</p>";
            $out .= "<p>Рост: {$params['height']}</p>";
        }

        return $out;

    }
}