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

    private function router($from)
    {

        $arrSegments = $this->findSegment($from);

        foreach ($arrSegments as $key => $segment){
            $to = $segment->getTo();
            if ($to  != $this->finish){
                $this->routeIndex +=$key;
                $this->router($to);
            }
                $this->routes[$this->routeIndex][] = $segment;

//            array_unshift($this->routes[$this->routeIndex][], $segment);
        }
    }

    public function makeRoutes()
    {
        $currFrom = $this->start;
        $this->routeIndex = 0;
        $this->router($currFrom);
        foreach ($this->routes as &$route){
            $route = array_reverse($route);
        }

    }

    public function getRoutes()
    {
       return $this->routes;
    }

}