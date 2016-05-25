<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Objects;


class Call {
    //put your code here
    
    public $id;
    public $source;
    public $medium;
    public $beginDuration;
    public $endDuration;
    public $numOfCalls;
    
    public $callTag;
    public $phoneCaller;
    public $whereCalled;
    
    
    public static function createCall(array $callsData){
        $call = new static;
        $call->setSource($callsData['source']);
        $call->setMedium($callsData['medium']);
        $call->setBeginDuration($callsData['duration_low']);
        $call->setEndDuration($callsData['duration_up']);
        
        if(isset($callsData['num_of_calls']))
            $call->setNumOfCalls($callsData['num_of_calls']);
        return $call;
    }
    
    

    
    public  function setId($id){
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    public  function setSource($source){
        $this->source = $source;
    }
    public function getSource() {
        return $this->source;
    }
    
    public  function setMedium($medium){
        $this->medium = $medium;
    }
    public function getMedium() {
        return $this->medium;
    }
    
    public  function setNumOfCalls($numOfCalls){
        $this->numOfCalls = $numOfCalls;
    }
    public function getNumOfCalls() {
        return $this->numOfCalls;
    }
    
    public  function setBeginDuration($beginDuration){
        $this->beginDuration = $beginDuration;
    }
    public function getBeginDuration() {
        return $this->beginDuration;
    }
    
    public  function setEndDuration($endDuration){
        $this->endDuration = $endDuration;
    }
    public function getEndDuration() {
        return $this->endDuration;
    }
    
}
