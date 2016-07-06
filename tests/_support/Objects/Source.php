<?php


namespace Objects;


class Source {
    private $source;
    private $typeOfSource;
    private $calls;
    private $uniqueCalls;
    private $targetCalls;
    private $uniqueAndTargetCalls;
    private $callsInWorkTime;
    private $visits;
    private $conversionInCalls;
    private $conversionInUniqueCalls;
    private $onlineRequests;
    private $conversionInTreatment;
    private $tags;
    private $conversionByTags;

    public function setCalls($calls)
    {
        $this->calls = $calls;
    }

    public function getCalls()
    {
        return $this->calls;
    }

    public function setCallsInWorkTime($callsInWorkTime)
    {
        $this->callsInWorkTime = $callsInWorkTime;
    }

    public function getCallsInWorkTime()
    {
        return $this->callsInWorkTime;
    }

    public function setConversionByTags($conversionByTags)
    {
        $this->conversionByTags = $conversionByTags;
    }

    public function getConversionByTags()
    {
        return $this->conversionByTags;
    }

    public function setConversionInCalls($conversionInCalls)
    {
        $this->conversionInCalls = $conversionInCalls;
    }

    public function getConversionInCalls()
    {
        return $this->conversionInCalls;
    }

    public function setConversionInTreatment($conversionInTreatment)
    {
        $this->conversionInTreatment = $conversionInTreatment;
    }

    public function getConversionInTreatment()
    {
        return $this->conversionInTreatment;
    }

    public function setConversionInUniqueCalls($conversionInUniqueCalls)
    {
        $this->conversionInUniqueCalls = $conversionInUniqueCalls;
    }

    public function getConversionInUniqueCalls()
    {
        return $this->conversionInUniqueCalls;
    }

    public function setOnlineRequests($onlineRequests)
    {
        $this->onlineRequests = $onlineRequests;
    }

    public function getOnlineRequests()
    {
        return $this->onlineRequests;
    }

    public function setSource($source)
    {
        $this->source = $source;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTargetCalls($targetCalls)
    {
        $this->targetCalls = $targetCalls;
    }

    public function getTargetCalls()
    {
        return $this->targetCalls;
    }

    public function setTypeOfSource($typeOfSource)
    {
        $this->typeOfSource = $typeOfSource;
    }

    public function getTypeOfSource()
    {
        return $this->typeOfSource;
    }

    public function setUniqueAndTargetCalls($uniqueAndTargetCalls)
    {
        $this->uniqueAndTargetCalls = $uniqueAndTargetCalls;
    }

    public function getUniqueAndTargetCalls()
    {
        return $this->uniqueAndTargetCalls;
    }

    public function setUniqueCalls($uniqueCalls)
    {
        $this->uniqueCalls = $uniqueCalls;
    }

    public function getUniqueCalls()
    {
        return $this->uniqueCalls;
    }

    public function setVisits($visits)
    {
        $this->visits = $visits;
    }

    public function getVisits()
    {
        return $this->visits;
    }


}