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
    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    

    public function __construct(\Codeception\Actor $I)
    {
        $this->tester = $I;
    }
    
    /*
     * @param array(Calls)
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
    
    
    public function checkCallsDiaryFilters($callsFiltersData){
        $I = $this->tester;
        
        $currentUrl = $I->grabFromCurrentUrl();
        
        $callsFilterObjects = array();
        foreach ($callsFiltersData as $callsData) {
            $callsFilter = call::createCallsFilter($callsData);
            array_push($callsFilterObjects, $callsFilter);
        }
        
       foreach ($callsFilterObjects as $call) {
           $tail = self::generateUrlValues($call);
           $I->amOnPage($currentUrl . $tail); 
           $I->see('из ' . $call->getNumOfCalls());
           
       }
        
        return $this;
    }
    
 
    public function generateUrlValues($call){
        $tail="";
        if(!empty($call->getSource())){
            if(strpos($call->getSource(), ',') != false){
                $sources = explode(",", $call->getSource());
                $numOfSources = count($sources);
                for($i=0;$i<$numOfSources;$i++){
                    $tail .= self::SOURCE . $sources[$i];
                }
            }else{
                 $tail .= self::SOURCE . $call->getSource();
                }
        }
        if(!empty($call->getMedium())){
            if(strpos($call->getMedium(), ',') != false){
                 $mediumArr = explode(",", $call->getMedium());
                 $lengthMediumArr = count($mediumArr);
                 for($i=0;$i<$lengthMediumArr;$i++){
                   $tail .= self::MEDIUM . $mediumArr[$i];
                 }
            }else {
                $tail .= self::MEDIUM . $call->getMedium();
            }
        }
        
        $tail .= self::DURATION_LOWER . $call->getDurationLower() . self::DURATION_UPPER . $call->getDurationUpper() ;
        
        return $tail;
    }
    
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
