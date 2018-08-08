<?php
namespace framework;
use framework\FlyRoute;

//require_once('FlyRoute.php');

class OperController
{
    /** сортировка
     * "id": [12,5,3,11,4,9,1,10,2,6,8,7]
     * @param $params
     * @return string
     */
    public function actionSort($params)
    {
        $outs = [];
        if (isset($params['id']) && count($params['id']) > 0) {
            $outs = $params['id'];
            $i = 1;
            $cnt = count($outs);
            while ($i < $cnt){
                $tmp = [];
                $first = array_shift($outs);
                while (count($outs) > 0) {
                    $second = array_shift($outs);
                    if ($first < $second) {
                        $resCompare = $first;
                        $last = $second;
                    } else {
                        $resCompare = $second;
                        $last = $first;
                    }
                    array_push($tmp, $resCompare);

                    if (count($outs) == 0) {
                        array_push($tmp, $last);
                    }
                    $first = $last;
                }
                $outs = $tmp;
                $i++;
            }
        }

        return json_encode($outs);

    }

    public function actionChain($params)
    {
        $FR = new FlyRoute();
        $FR->setParams($params);
        //$segments = $FR->getSegments();
        $FR->makeRoutes();
        $routes = $FR->getRoutes();

        return $routes;
    }
}