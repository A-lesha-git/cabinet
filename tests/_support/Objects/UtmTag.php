<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Objects;


class UtmTag {
    
    private $utmName;
    private $calls;
    private $uniqueCalls;
    private $targetCalls;
    private $uniqueAndTargetCalls;
    private $callsInWorkTime;
    private $onlineRequests;
    private $orders;
    private $numOfVisits;
    private $conversionSpecialOrGaranty;
    private $callsFromSpecialOrGaranty;
    private $conversionToCallsFromSpecOrGaranty;
    private $conversionToOrders;
    private $conversionToTreatment;
    private $conversionFromYD;
    private $showsYDInSearch;
    private $showsRSY;
    private $costsYD;
    private $costsInRSY;
    private $costsToShowInSearchYD;
    private $conversionFromGoogleAdwords;

    public static function createReport(array $utmReportTotalData){
        $report = new static;

        $report->setUtmName($utmReportTotalData['utm_name']);
        $report->setCalls($utmReportTotalData['calls']);
        $report->setUniqueCalls($utmReportTotalData['unique_calls']);
        $report->setTargetCalls($utmReportTotalData['target_calls']);
        $report->setUniqueAndTargetCalls($utmReportTotalData['unique_target_calls']);
        $report->setCallsInWorkTime($utmReportTotalData['calls_in_work_time']);
        $report->setOnlineRequests($utmReportTotalData['online_requests']);;
        $report->setOrders($utmReportTotalData['orders']);
        $report->setNumOfVisits($utmReportTotalData['visits']);
        $report->setConversionSpecialOrGaranty($utmReportTotalData['conversion_from_spec_or_garanty']);
        $report->setCallsFromSpecialOrGaranty($utmReportTotalData['calls_from_spec_or_garanty']);
        $report->setConversionToCallsFromSpecOrGaranty($utmReportTotalData['conversion_to_calls_from_spec_or_garanty']);
        $report->setConversionToOrders($utmReportTotalData['conversion_to_orders']);
        $report->setConversionToTreatment($utmReportTotalData['conversion_to_treatment']);
        $report->setConversionFromYD($utmReportTotalData['conversion_from_YD']);
        $report->setShowsYDInSearch($utmReportTotalData['shows_YD_in_search']);
        $report->setShowsRSY($utmReportTotalData['shows_RSY']);
        $report->setCostsYD($utmReportTotalData['costs_YD']);
        $report->setCostsInRSY($utmReportTotalData['costs_in_RSY']);
        $report->setCostsToShowInSearchYD($utmReportTotalData['costs_to_show_in_search_YD']);
        $report->setConversionFromGoogleAdwords($utmReportTotalData['conversion_from_google_adw']);
        
        return $report;
    }

    public function setUtmName($utmName)
    {
        $this->utmName = $utmName;
    }

    public function getUtmName()
    {
        return $this->utmName;
    }
    
    public function getConversionToCallsFromSpecOrGaranty() {
        return $this->conversionToCallsFromSpecOrGaranty;
        
    }
    public function setConversionToCallsFromSpecOrGaranty($conversionToCallsFromSpecOrGaranty) {
        $this->conversionToCallsFromSpecOrGaranty = $conversionToCallsFromSpecOrGaranty;
        
    }
    
    public function getCalls() {
        return $this->calls;
        
    }
    public function setCalls($calls) {
        $this->calls = $calls;
        
    }

    
    function getUniqueCalls() {
        return $this->uniqueCalls;
    }

    function getTargetCalls() {
        return $this->targetCalls;
    }

    function getUniqueAndTargetCalls() {
        return $this->uniqueAndTargetCalls;
    }

    function getCallsInWorkTime() {
        return $this->callsInWorkTime;
    }

    function getOnlineRequests() {
        return $this->onlineRequests;
    }

    function getNumOfVisits() {
        return $this->numOfVisits;
    }

    function getConversionSpecialOrGaranty() {
        return $this->conversionSpecialOrGaranty;
    }

    function getCallsFromSpecialOrGaranty() {
        return $this->callsFromSpecialOrGaranty;
    }

    public function setOrders($orders)
    {
        $this->orders = $orders;
    }

    public function getOrders()
    {
        return $this->orders;
    }

    function setUniqueCalls($uniqueCalls) {
        $this->uniqueCalls = $uniqueCalls;
    }

    function setTargetCalls($targetCalls) {
        $this->targetCalls = $targetCalls;
    }

    function setUniqueAndTargetCalls($uniqueAndTargetCalls) {
        $this->uniqueAndTargetCalls = $uniqueAndTargetCalls;
    }

    function setCallsInWorkTime($callsInWorkTime) {
        $this->callsInWorkTime = $callsInWorkTime;
    }

    function setOnlineRequests($onlineRequests) {
        $this->onlineRequests = $onlineRequests;
    }


    function setNumOfVisits($numOfVisits) {
        $this->numOfVisits = $numOfVisits;
    }

    function setConversionSpecialOrGaranty($conversionSpecialOrGaranty) {
        $this->conversionSpecialOrGaranty = $conversionSpecialOrGaranty;
    }

    function setCallsFromSpecialOrGaranty($callsFromSpecialOrGaranty) {
        $this->callsFromSpecialOrGaranty = $callsFromSpecialOrGaranty;
    }




    public function setConversionFromGoogleAdwords($conversionFromGoogleAdwords)
    {
        $this->conversionFromGoogleAdwords = $conversionFromGoogleAdwords;
    }

    public function getConversionFromGoogleAdwords()
    {
        return $this->conversionFromGoogleAdwords;
    }

    public function setConversionFromYD($conversionFromYD)
    {
        $this->conversionFromYD = $conversionFromYD;
    }

    public function getConversionFromYD()
    {
        return $this->conversionFromYD;
    }

    public function setConversionToOrders($conversionToOrders)
    {
        $this->conversionToOrders = $conversionToOrders;
    }

    public function getConversionToOrders()
    {
        return $this->conversionToOrders;
    }

    public function setConversionToTreatment($conversionToTreatment)
    {
        $this->conversionToTreatment = $conversionToTreatment;
    }

    public function getConversionToTreatment()
    {
        return $this->conversionToTreatment;
    }

    public function setCostsInRSY($costsInRSY)
    {
        $this->costsInRSY = $costsInRSY;
    }

    public function getCostsInRSY()
    {
        return $this->costsInRSY;
    }

    public function setCostsToShowInSearchYD($costsToShowInSearchYD)
    {
        $this->costsToShowInSearchYD = $costsToShowInSearchYD;
    }

    public function getCostsToShowInSearchYD()
    {
        return $this->costsToShowInSearchYD;
    }

    public function setShowsRSY($showsRSY)
    {
        $this->showsRSY = $showsRSY;
    }

    public function getShowsRSY()
    {
        return $this->showsRSY;
    }

    public function setCostsYD($costsYD)
    {
        $this->costsYD = $costsYD;
    }

    public function getCostsYD()
    {
        return $this->costsYD;
    }

    public function setShowsYDInSearch($showsYDInSearch)
    {
        $this->showsYDInSearch = $showsYDInSearch;
    }

    public function getShowsYDInSearch()
    {
        return $this->showsYDInSearch;
    }
}
