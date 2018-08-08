<?php
namespace framework;
use DateTime;

class Segment
{
    protected $from;
    protected $to;
    protected $ddate;

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