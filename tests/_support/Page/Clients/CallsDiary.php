<?php
namespace Page\Clients;
use \Objects\Call as call;
class CallsDiary
{
    // include url of current page
    public static $URL = '';
    protected $tester;
   
    const SOURCE = '&source[]=';
    const MEDIUM = '&medium[]=';
    const DURATION_LOWER = '&dur_lower=';
    const DURATION_UPPER = '&dur_upper=';

    

    public function __construct(\Codeception\Actor $I)
    {
        $this->tester = $I;
    }
    

    
    /*
     * @param array()
     */
    public function testCallsDiarySetOne($callsDataProvider){
        $I = $this->tester;
        $navigate = new \Page\Navigation\Navigation($I);
        foreach ($callsDataProvider as $key){
           $navigate->goToPage($key['accountId'], $key['siteId'], $key['beginDate'], $key['endDate'], $key['section']);
           $callsFiltersData = array();
           $callsFiltersData = $key['callsData'];
           
           self::checkCallsDiaryFilters($callsFiltersData);
        }
        
        return $this;
        
    }
    
     /*
     * @param array()
     */
    public function testCallsDiaryFirstFormFilter($callsDataProvider){
        $I = $this->tester;
        $navigate = new \Page\Navigation\Navigation($I);
        foreach ($callsDataProvider as $key){
           $navigate->goToPage($key['accountId'], $key['siteId'], $key['beginDate'], $key['endDate'], $key['section']);
           self::fillFormDatesAndSegmentsFilter($key['filterData']);
           
        }
        return $this;
    }
    
    public function fillFormDatesAndSegmentsFilter($filterData){
         $I = $this->tester;
         
        foreach ($filterData as $key){
            $I->fillField('begin_date', $key['startDate']);
            $I->fillField('end_date', $key['endDate']);
            switch ($key['segment']) {
                case 'Платный трафик':
                    $I->selectOption("form select[name=selectSiteSegment]", '51');    
                    break;
                case 'Все сегменты':
                    $I->selectOption("form select[name=selectSiteSegment]", 'any');    
                    break;
                case 'Органический поиск':
                    $I->selectOption("form select[name=selectSiteSegment]", '52');    
                    break;
                case 'Рефералы':
                    $I->selectOption("form select[name=selectSiteSegment]", '53');    
                    break;
                case 'Прямые заходы':
                    $I->selectOption("form select[name=selectSiteSegment]", '54');    
                    break;
                //only account_id=3363
                case 'NEVSKY':
                    $I->selectOption("form select[name=selectSiteSegment]", '3059');    
                    break;
                //account_id=6627
                case 'Весь платный трафик':
                    $I->selectOption("form select[name=selectSiteSegment]", '8553');    
                    break;
                default:
                    break;
            }
            
            $I->click('Показать', "//input[@class='btn']");
            if($key['numOfCalls'] > 0)
                self::verifyNumOfCalls($key['numOfCalls']);
            else
                self::checkThatNoCallsExist();
        }
        
        return $this;
    } 
    
     /*
     * @param array() $callsFiltersData
     */
    public function checkCallsDiaryFilters($callsFiltersData){
        $I = $this->tester;
        
        $currentUrl = $I->grabFromCurrentUrl();
        
        $callsFiltersObjects = self::getCallsFilters($callsFiltersData);//array();

       foreach ($callsFiltersObjects as $obj) {
           $tail = self::generateUrlValues($obj);
           $I->amOnPage($currentUrl . $tail); 
           if($obj->getNumOfCalls() > 0){
               $I->see('из ' . $obj->getNumOfCalls());
               if($obj->getCallsData()){
                self::verifyThatCallsIsExists($obj->getCallsData());
               }
           }else {
              
               self::checkThatNoCallsExist();
               
           }
       }
        
        return $this;
    }
    
    public function checkThatNoCallsExist(){
         //если нет звонков то и таблицы со звонками и инфо по звонкам быть не должно.
        $I = $this->tester; 
        
        $I->dontSeeElement("//td[@data-path]");
        $I->dontSeeElement("//td[@text='Куда:']");
        $I->dontSeeElement("//td[@text='utm_term:']");
        $I->dontSeeElement("//td[@text='Город:']");
        $I->dontSeeElement("//td[@text='utm_campaign:']");
        
        return $this;
    }
    
    public function verifyNumOfCalls($numOfCalls){
        $I = $this->tester;
        if($numOfCalls != 9999)
            $I->see('из ' . $numOfCalls, '//a');
        //если не известно сколько звонков, но они есть
        else {
            $I->see('из', '//a');
            $I->seeElement("//td[@data-path]");
        }
        
        return $this;
    }
    
    /*
     * В методе осуществляется проверка
     * на существование в выдаче ид номеров, номеров телефонов и т.д.
     *@param array() $callsData
     */
    public function verifyThatCallsIsExists($callsData){
        $I = $this->tester; 
        $callsObjects = self::getCalls($callsData);
        
        foreach($callsObjects as $call){
            $I->seeInSource($call->getId());
            $I->see($call->getWhereCalled(), '//span');
            $I->seeInSource($call->getPhoneCaller(), './span');
            $I->seeInSource($call->getCallDuration());
            $I->seeInSource($call->getDateCall());
            if(!empty($call->getCallWaiting()))
                $I->seeInSource($call->getCallWaiting());
        }
        
        return $this;
    }
   
    /*
     * Метод получает массив объектов звонком
     * @param array()
     * 
    */
    
    public function getCalls($callsData){
        $callsObjects = array();
        
        foreach ($callsData as $callData) {
            $call = call::createCall($callData);
            array_push($callsObjects, $call);
        }
        return $callsObjects;
    
    }
    
    /*
    * @param array()
    */
    public function getCallsFilters($callsFiltersData){
        $callsFiltersObjects = array();
        foreach ($callsFiltersData as $callsData) {
            $callsFilter = call::createCallsFilter($callsData);
            array_push($callsFiltersObjects, $callsFilter);
        }
        
        return $callsFiltersObjects;
    }
    
     /*
     * Метод возвращает часть урла с get параметрами
     * @param array()
     * 
     */
    public function generateUrlValues($callFilter){
        $tail="";
        if(!empty($callFilter->getSource())){
            if(strpos($callFilter->getSource(), ',') != false){
                $sources = explode(",", $callFilter->getSource());
                $numOfSources = count($sources);
                for($i=0;$i<$numOfSources;$i++){
                    $tail .= self::SOURCE . $sources[$i];
                }
            }else{
                 $tail .= self::SOURCE . $callFilter->getSource();
                }
        }
        if(!empty($callFilter->getMedium())){
            if(strpos($callFilter->getMedium(), ',') != false){
                 $mediumArr = explode(",", $callFilter->getMedium());
                 $lengthMediumArr = count($mediumArr);
                 for($i=0;$i<$lengthMediumArr;$i++){
                   $tail .= self::MEDIUM . $mediumArr[$i];
                 }
            }else {
                $tail .= self::MEDIUM . $callFilter->getMedium();
            }
        }
        
        $tail .= self::DURATION_LOWER . $callFilter->getDurationLower() . self::DURATION_UPPER . $callFilter->getDurationUpper() ;
        
        return $tail;
    }
    
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
