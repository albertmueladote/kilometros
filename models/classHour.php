<?php
class Hour extends DDBB{

    protected $table = 'hour';

    public function __construct() {
        parent::__construct();
    } 

    public function save($hours, $date)
    {
        if($hours > 0) {
            if($hour = $this->get(['date' => $date])) {
                if($this->update(['date' => $date], ['hours' => $hours])) {
                    return $hour['id'];
                }
            } else {
                return $this->insert(['hours' => $hours, 'date' => $date]);
            }
        } else {
            if($hour = $this->get(['date' => $date])) {
                return $this->remove($hour['id']);
            }
        }
    }

    public function get($params) 
    {
        return parent::get($params);
    }

    public function getAll() 
    {
        return parent::getAll();
    }
}
?>