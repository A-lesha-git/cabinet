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
    const UTM_SOURCE = '&utm_source[]=';
    const UTM_TERM = '&utm_term[]=';
    const UTM_MEDIUM = '&utm_medium[]=';
    const UTM_CONTENT = '&utm_content[]=';
    const UTM_CAMPAIGN = '&utm_campaign[]=';
    const DURATION_LOWER = '&dur_lower=';
    const DURATION_UPPER = '&dur_upper=';

    //локаторы полей фильтров

    //источник
    public static $sourceSelect = '#source_select';

    public static $mediumSelect = '#selectList';
    public static $refWhereSelect = '#url_select';
    public static $keywordSearchField = "//input[@name='keyword']";
    public static $aniSearchField  = "//input[@name='ani']";
    public static $phoneNumberSearchField  = "//input[@name='phone_number']";

    public static $utmSourceSelect = '#utm_source_select';
    public static $utmTermSelect = '#utm_term_select';
    public static $utmMediumSelect = '#utm_medium_select';
    public static $utmContentSelect = '#utm_content_select';
    public static $utmCampaignSelect = '#utm_campaign_select';

    public static $searchBtn = ".btn.btn-primary";


    public function __construct(\Codeception\Actor $I)
    {
        $this->tester = $I;
    }

    /*
     * Метод проверяет "ручной" ввод данных в форму поиска звонка, а не генерирует ссылку с get параметрами
     * @param array()
    */
    public function testCallsDiaryFormManualy($callsDataProvider){
        $I = $this->tester;
        $navigate = new \Page\Navigation\Navigation($I);

        foreach ($callsDataProvider as $key){
            $navigate->goToPage($key['accountId'], $key['siteId'], $key['beginDate'], $key['endDate'], $key['section']);
            $callsFiltersData = $key['callsData'];

            self::checkCallsDiaryFiltersManualy($callsFiltersData);
        }


        return $this;
    }

    public function checkCallsDiaryFiltersManualy($callsFiltersData){
        $I = $this->tester;
       // if(!empty($callsFiltersData['source']))
        foreach($callsFiltersData as $key){
            if(!empty($key['source']))
                $I->selectOption(self::$sourceSelect, $key['source']);

            if(!empty($key['medium']))
                $I->selectOption(self::$mediumSelect, $key['medium']);

            if(!empty($key['where']))
                $I->selectOption(self::$refWhereSelect, $key['where']);

            if(!empty($key['keyword']))
                $I->fillField(self::$keywordSearchField, $key['keyword']);

            if(!empty($key['ani']))
                $I->fillField(self::$keywordSearchField, $key['ani']);

            if(!empty($key['phone_number']))
                $I->fillField(self::$keywordSearchField, $key['phone_number']);

            if(!empty($key['utm_source']))
                $I->selectOption(self::$utmSourceSelect, $key['utm_source']);
            if(!empty($key['utm_term']))
                $I->selectOption(self::$utmTermSelect, $key['utm_term']);
            if(!empty($key['utm_medium']))
                $I->selectOption(self::$utmMediumSelect, $key['utm_medium']);
            if(!empty($key['utm_content']))
                $I->selectOption(self::$utmContentSelect, $key['utm_content']);
            if(!empty($key['utm_campaign']))
                $I->selectOption(self::$utmCampaignSelect, $key['utm_campaign']);

            $I->click(self::$searchBtn);
            self::verifyNumOfCalls($key['num_of_calls']);
        }

        //press btn "Показать"



        return $this;
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

    public function testCallsDiarySetTwo($callsDataProvider){
        $I = $this->tester;

        $navigate = new \Page\Navigation\Navigation($I);
        foreach ($callsDataProvider as $key){
            $navigate->goToPage($key['accountId'], $key['siteId'], $key['beginDate'], $key['endDate'], $key['section']);
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
     * Метод получает массив объектов звонков
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
     * Метод возвращает часть урла с get параметрами,
     * в зависимости от параметров фильтра
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
        if(!empty($callFilter->getUtmSource())){
            if(strpos($callFilter->getUtmSource(), ',') != false){
                $utmSources = explode(",", $callFilter->getUtmSource());
                $numOfUtmSources= count($utmSources);
                for($i=0;$i<$numOfUtmSources;$i++){
                    $tail .= self::UTM_SOURCE . $utmSources[$i];
                }
            }else{
                $tail .= self::UTM_SOURCE . $callFilter->getUtmSource();
            }
        }
        if(!empty($callFilter->getUtmTerm())){
            if(strpos($callFilter->getUtmTerm(), ',') != false){
                $utmTerms= explode(",", $callFilter->getUtmTerm());
                $numOfUtmTerms = count($utmTerms);
                for($i=0;$i<$numOfUtmTerms;$i++){
                    $tail .= self::UTM_TERM . $utmTerms[$i];
                }
            }else{
                $tail .= self::UTM_TERM . $callFilter->getUtmTerm();
            }
        }
        if(!empty($callFilter->getUtmMedium())){
            if(strpos($callFilter->getUtmTerm(), ',') != false){
                $utmMediums= explode(",", $callFilter->getUtmMedium());
                $numOfUtmMediums = count($utmMediums);
                for($i=0;$i<$numOfUtmMediums;$i++){
                    $tail .= self::UTM_MEDIUM . $utmMediums[$i];
                }
            }else{
                $tail .= self::UTM_MEDIUM . $callFilter->getUtmMedium();
            }
        }
        if(!empty($callFilter->getUtmContent())){
            if(strpos($callFilter->getUtmContent(), ',') != false){
                $utmContentArr= explode(",", $callFilter->getUtmContent());
                $lengthOfUtmContentArr= count($utmContentArr);
                for($i=0;$i<$lengthOfUtmContentArr;$i++){
                    $tail .= self::UTM_CONTENT . $utmContentArr[$i];
                }
            }else{
                $tail .= self::UTM_CONTENT . $callFilter->getUtmContent();
            }
        }
        if(!empty($callFilter->getUtmCampaign())){
            if(strpos($callFilter->getUtmCampaign(), ',') != false){
                $utmCampaigntArr= explode(",", $callFilter->getUtmCampaign());
                $lengthOfUtmCampaigntArr= count($utmCampaigntArr);
                for($i=0;$i<$lengthOfUtmCampaigntArr;$i++){
                    $tail .= self::UTM_CAMPAIGN . $utmCampaigntArr[$i];
                }
            }else{
                $tail .= self::UTM_CAMPAIGN . $callFilter->getUtmCampaign();
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
