<?php
namespace framework;
use DateTime;

class Segment
{
    protected $from;
    protected $to;
    protected $ddate;

    protected $homeWay=[]; // Содержит путь от точки старта до текущего сегмента

    public function __construct($arrSegment)
    {
        $this->from = $arrSegment['from'];
        $this->to = $arrSegment['to'];
        $this->ddate = DateTime::createFromFormat('d.m.Y', $arrSegment['ddate']);
    }


    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }


    /**
     * @param array $homeWay
     */
    public function setHomeWay($key, $homeWay): void
    {
        if (isset($homeWay)){
                $this->homeWay[$key][] = $homeWay;
        }
    }

    /**
     * @return array
     */
    public function getHomeWay($index)
    {
        $key = $index;
        if(!key_exists($index, $this->homeWay)){
            $key = count($this->homeWay) -1;
        }
        return $this->homeWay[$key];
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return bool|DateTime
     */
    public function getDdate()
    {
        return $this->ddate;
    }





}