<?php
namespace framework;
use Exception;


class FlyRoute
{


    protected $start;
    protected $finish;
    protected $segments=[];

    protected $routes=[];
    protected $routeIndex;

    public function setParams($params)
    {
        $this->start = $params['start'];
        $this->finish = $params['finish'];
        $segments = $params['segments'];
        $tmpArr = [];
        if (!empty($segments) && is_array($segments)){
            foreach ($segments as $param){
                if (isset($param) ){
                    $tmpArr[] = new Segment($param);
                }
            }
            $this->segments = $this->sortSegments($tmpArr);
        }
    }

    private function sortSegments($segmentArr)
    {
        return $segmentArr;
    }

    public function getSegments()
    {
        try {
            $retval = $this->segments;
            return $retval;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    private function findSegment($fromSegment):array 
    {
        $retArr=[];
        if (empty($this->segments)){
            return $retArr;
        }
        //TODO: Проверка даты: в следующем сегменте она д.б. больше. Иначе это не маршрут
        try {
            foreach ($this->segments as $segment) {
                $from = $segment->getFrom();
                $ddate = $segment->getDdate();
                if ($from == $fromSegment) {
                    $retArr[] = $segment;
                }
            }
            return $retArr;
        }
        catch (Exception $e){
            return [];
        }
    }

    private function router($from, $homeWay)
    {
        $arrSegments = $this->findSegment($from);
        foreach ($arrSegments as $key => $segment){
            $this->routeIndex +=$key;
            $segment->setHomeWay($this->routeIndex, $homeWay );
            if (isset($homeWay)){
                $parentHomeWays = $homeWay->getHomeWay($this->routeIndex);
                foreach ($parentHomeWays as $homeW) {
                    $segment->setHomeWay($this->routeIndex, $homeW);
                }
            }
            $to = $segment->getTo();
            if ($to  != $this->finish){
                $this->router($to,$segment);
            }else {
                $this->routes[$this->routeIndex][] = $segment;
                $hWs = $segment->getHomeWay($this->routeIndex);
                foreach ($hWs as $hw){
                    $this->routes[$this->routeIndex][] = $hw;
                }
            }
        }
    }

    public function makeRoutes()
    {
        $currFrom = $this->start;
        $this->routeIndex = 0;
        $this->router($currFrom,null);
        foreach ($this->routes as &$route){
            $route = array_reverse($route);
        }

    }

    public function getRoutes()
    {
       return $this->routes;
    }

    public function showRoute()
    {
        $out = [];
        foreach ($this->routes as $key=>$route){
            foreach ($route as $key2=>$segment){
                $out[$key][$key2]= [
                    'from'=> $segment->getFrom(),
                    'to' => $segment->getTo(),
                    'ddate' => $segment->getDdate()->format("d.m.Y")
                ];
            }
        }
        return $out;
//        return json_encode($out);
    }

}