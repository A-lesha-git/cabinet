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
    public $durationLower;
    public $durationUpper;
    public $numOfCalls;
    public $calls;
    
    
    public $callTag;
    public $phoneCaller;
    public $whereCalled;
    
    
    public static function createCallsFilter(array $callsFilterData){
        $callsDiaryFilter = new static;
        $callsDiaryFilter->setSource($callsFilterData['source']);
        $callsDiaryFilter->setMedium($callsFilterData['medium']);
        $callsDiaryFilter->setDurationLower($callsFilterData['duration_low']);
        $callsDiaryFilter->setDurationUpper($callsFilterData['duration_up']);
        
        if(isset($callsFilterData['num_of_calls']))
            $callsDiaryFilter->setNumOfCalls($callsFilterData['num_of_calls']);
        
        if(isset($callsFilterData['calls']))
            $callsDiaryFilter->setCalls ($callsFilterData['calls']);
        
        return $callsDiaryFilter;
    }
    
    public static function createCalls(array $callsFilterData){
        $calls = new static;
        $calls->setId($callsFilterData['id']);
        $calls->setPhoneCaller($callsFilterData['ani']);
        $calls->setWhereCalled($callsFilterData['phone_number']);
        
        return $calls;
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
    
    public  function setDurationLower($durationLower){
        $this->durationLower = $durationLower;
    }
    public function getDurationLower() {
        return $this->durationLower;
    }
    
    public  function setDurationUpper($durationUpper){
        $this->durationUpper = $durationUpper;
    }
    public function getDurationUpper() {
        return $this->durationUpper;
    }
    
    
    public  function setPhoneCaller($phoneCaller){
        $this->phoneCaller = $phoneCaller;
    }
    public function getPhoneCaller() {
        return $this->phoneCaller;
    }
    
    public  function setWhereCalled($whereCalled){
        $this->whereCalled = $whereCalled;
    }
    public function getWhereCalled() {
        return $this->whereCalled;
    }
    
        public  function setCalls(array $calls){
        $this->calls = $calls;
    }
    public function getCalls() {
        return $this->calls;
    }
    
    
}
