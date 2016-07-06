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
    private $tagsAndCategory;




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
    private $costsGoogleAdwords;
    private $numOfSales;
    private $conversionFromTreatmentToSale;
    private $costOfSaleCAC;
    private $treatment;
    private $costOfTreatment;
    private $ordersOnCalls;
    private $revenueCalls;
    private $totalRevenue;
    private $ROI;
    private $DRR;
    private $showsInSpecPlacement;
    private $showsInWarantyYD;
    private $rationOfShowsOfSpecOrWarantyYD;
    private $numOfVisitsYM;
    private $failuresYM;
    private $averageLengthOfSessionYM;
    private $depthOfViewYM;
    private $goalYMOne;
    private $goalYMTwo;


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
        if(isset($utmReportTotalData['tags_and_categories'])){
            $report->setTagsAndCategory($utmReportTotalData['tags_and_categories']);
        }
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
        $report->setCostsGoogleAdwords($utmReportTotalData['costs_google_adwords']); ;
        $report->setNumOfSales($utmReportTotalData['num_of_sales']);
        $report->setConversionFromTreatmentToSale($utmReportTotalData['conversion_from_treatment_to_sale']);
        $report->setCostOfSaleCAC($utmReportTotalData['cost_of_sale_CAC']);
        $report->setTreatment($utmReportTotalData['treatment']);
        $report->setCostOfTreatment($utmReportTotalData['cost_of_treatment']);
        $report->setOrdersOnCalls($utmReportTotalData['orders_on_calls']);
        $report->setRevenueCalls($utmReportTotalData['revenue_calls']);
        $report->setTotalRevenue($utmReportTotalData['total_revenue']);
        $report->setROI($utmReportTotalData['ROI']);
        $report->setDRR($utmReportTotalData['DRR']);
        $report->setShowsInSpecPlacement($utmReportTotalData['shows_in_spec_placement']);
        $report->setShowsInWarantyYD($utmReportTotalData['shows_in_waranty_YD']);
        $report->setRationOfShowsOfSpecOrWarantyYD($utmReportTotalData['ration_of_shows_of_spec_or_warantyYD']);
        $report->setNumOfVisitsYM($utmReportTotalData['num_of_visits_YM']);
        $report->setFailuresYM($utmReportTotalData['failures_YM']);
        $report->setAverageLengthOfSessionYM($utmReportTotalData['average_length_of_session_YM']);
        $report->setDepthOfViewYM($utmReportTotalData['depth_of_view_YM']);
//        $report->setGoalYMOne($utmReportTotalData['goal_YM_one']);
//        $report->setGoalYMTwo($utmReportTotalData['goal_YM_two']);


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
    public function setTagsAndCategory($tagsAndCategory)
    {
        $this->tagsAndCategory = $tagsAndCategory;
    }

    public function getTagsAndCategory()
    {
        return $this->tagsAndCategory;
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
    public function setConversionFromTreatmentToSale($conversionFromTreatmentToSale)
    {
        $this->conversionFromTreatmentToSale = $conversionFromTreatmentToSale;
    }

    public function getConversionFromTreatmentToSale()
    {
        return $this->conversionFromTreatmentToSale;
    }

    public function setCostOfSaleCAC($costOfSaleCAC)
    {
        $this->costOfSaleCAC = $costOfSaleCAC;
    }

    public function getCostOfSaleCAC()
    {
        return $this->costOfSaleCAC;
    }

    public function setCostOfTreatment($costOfTreatment)
    {
        $this->costOfTreatment = $costOfTreatment;
    }

    public function getCostOfTreatment()
    {
        return $this->costOfTreatment;
    }

    public function setCostsGoogleAdwords($costsGoogleAdwords)
    {
        $this->costsGoogleAdwords = $costsGoogleAdwords;
    }

    public function getCostsGoogleAdwords()
    {
        return $this->costsGoogleAdwords;
    }

    public function setNumOfSales($numOfSales)
    {
        $this->numOfSales = $numOfSales;
    }

    public function getNumOfSales()
    {
        return $this->numOfSales;
    }

    public function setOrdersOnCalls($ordersOnCalls)
    {
        $this->ordersOnCalls = $ordersOnCalls;
    }

    public function getOrdersOnCalls()
    {
        return $this->ordersOnCalls;
    }

    public function setRevenueCalls($revenueCalls)
    {
        $this->revenueCalls = $revenueCalls;
    }

    public function getRevenueCalls()
    {
        return $this->revenueCalls;
    }

    public function setTotalRevenue($totalRevenue)
    {
        $this->totalRevenue = $totalRevenue;
    }

    public function getTotalRevenue()
    {
        return $this->totalRevenue;
    }

    public function setTreatment($treatment)
    {
        $this->treatment = $treatment;
    }

    public function getTreatment()
    {
        return $this->treatment;
    }

    public function setDRR($DRR)
    {
        $this->DRR = $DRR;
    }

    public function getDRR()
    {
        return $this->DRR;
    }

    public function setROI($ROI)
    {
        $this->ROI = $ROI;
    }

    public function getROI()
    {
        return $this->ROI;
    }

    public function setAverageLengthOfSessionYM($averageLengthOfSessionYM)
    {
        $this->averageLengthOfSessionYM = $averageLengthOfSessionYM;
    }

    public function getAverageLengthOfSessionYM()
    {
        return $this->averageLengthOfSessionYM;
    }

    public function setDepthOfViewYM($depthOfViewYM)
    {
        $this->depthOfViewYM = $depthOfViewYM;
    }

    public function getDepthOfViewYM()
    {
        return $this->depthOfViewYM;
    }

    public function setFailuresYM($failuresYM)
    {
        $this->failuresYM = $failuresYM;
    }

    public function getFailuresYM()
    {
        return $this->failuresYM;
    }

    public function setGoalYMOne($goalYMOne)
    {
        $this->goalYMOne = $goalYMOne;
    }

    public function getGoalYMOne()
    {
        return $this->goalYMOne;
    }

    public function setGoalYMTwo($goalYMTwo)
    {
        $this->goalYMTwo = $goalYMTwo;
    }

    public function getGoalYMTwo()
    {
        return $this->goalYMTwo;
    }

    public function setNumOfVisitsYM($numOfVisitsYM)
    {
        $this->numOfVisitsYM = $numOfVisitsYM;
    }

    public function getNumOfVisitsYM()
    {
        return $this->numOfVisitsYM;
    }

    public function setRationOfShowsOfSpecOrWarantyYD($rationOfShowsOfSpecOrWarantyYD)
    {
        $this->rationOfShowsOfSpecOrWarantyYD = $rationOfShowsOfSpecOrWarantyYD;
    }

    public function getRationOfShowsOfSpecOrWarantyYD()
    {
        return $this->rationOfShowsOfSpecOrWarantyYD;
    }

    public function setShowsInSpecPlacement($showsInSpecPlacement)
    {
        $this->showsInSpecPlacement = $showsInSpecPlacement;
    }

    public function getShowsInSpecPlacement()
    {
        return $this->showsInSpecPlacement;
    }

    public function setShowsInWarantyYD($showsInWarantyYD)
    {
        $this->showsInWarantyYD = $showsInWarantyYD;
    }

    public function getShowsInWarantyYD()
    {
        return $this->showsInWarantyYD;
    }


}
