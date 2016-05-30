<?php


namespace Objects;


class Call {
     
    public $id;
    public $source;
    public $medium;
    public $durationLower;
    public $durationUpper;
    public $numOfCalls;
    public $callsData;
    public $utmSource;
    public $utmMedium;
    public $utmTerm;
    public $utmContent;
    public $utmCampaign;
    public $where;
    public $from;
    public $keyword;
    public $city;
    public $callDuration;
    public $dateCall;   
    public $callWaiting;

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
            $callsDiaryFilter->setCallsData($callsFilterData['calls']);
        
        return $callsDiaryFilter;
    }
    
    public static function createCall(array $callsFilterData){
        $call = new static;
        $call->setId($callsFilterData['call_id']);
        $call->setPhoneCaller($callsFilterData['ani']);
        $call->setWhereCalled($callsFilterData['phone_number']);
        $call->setCallDuration($callsFilterData['call_duration']);
        $call->setDateCall($callsFilterData['date_call']);
        if(isset($callsFilterData['call_waiting']))
            $call->setCallWaiting($callsFilterData['call_waiting']);
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
    
    public  function setCallsData(array $callsData){
        $this->callsData = $callsData;
    }
    public function getCallsData() {
        return $this->callsData;
    }
    
    public function setUtmSource($utmSource){
        $this->utmSource = $utmSource;
    }
    public function getUtmSource() {
        return $this->utmSource;
    }
    
    public  function setUtmMedium($utmMedium){
        $this->utmMedium = $utmMedium;
    }
    public function getUtmMedium() {
        return $this->utmMedium;
    }
    
    public  function setUtmTerm($utmTerm){
        $this->utmTerm = $utmTerm;
    }
    public function getUtmTerm() {
        return $this->utmTerm;
    }
    
    public  function setUtmContent($utmContent){
        $this->utmContent = $utmContent;
    }
    public function getUtmContent() {
        return $this->utmContent;
    }
    
    public  function setUtmCampaign($utmCampaign){
        $this->utmCampaign = $utmCampaign;
    }
    public function getUtmCampaign() {
        return $this->utmCampaign;
    }
    
    public  function setWhere($where){
        $this->where = $where;
    }
    public function getWhere() {
        return $this->where;
    }
    
    public  function setFrom($from){
        $this->from = $from;
    }
    public function getFrom() {
        return $this->from;
    }
    
    public  function setKeyword($keyword){
        $this->keyword = $keyword;
    }
    public function getKeyword() {
        return $this->keyword;
    }
    
    public  function setCity($city){
        $this->city = $city;
    }
    public function getCity() {
        return $this->city;
    }
    
    public  function setCallDuration($callDuration){
        $this->callDuration = $callDuration;
    }
    public function getCallDuration() {
        return $this->callDuration;
    }
    
    public  function setDateCall($dateCall){
        $this->dateCall = $dateCall;
    }
    public function getDateCall() {
        return $this->dateCall;
    }
    
    public  function setCallWaiting($callWaiting){
        $this->callWaiting = $callWaiting;
    }
    public function getCallWaiting() {
        return $this->callWaiting;
    }
    
}
