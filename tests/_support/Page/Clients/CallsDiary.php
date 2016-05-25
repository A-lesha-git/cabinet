<?php
namespace Page\Clients;
use \Objects\Call as call;
class CallsDiary
{
    // include url of current page
    public static $URL = '';
    protected $tester;
   
    const SOURCE = '&source%5B%5D=';
    const MEDIUM = '&medium=';
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
           $calls = array();
           $calls = $key['callsData'];
           
           self::checkCallsDiaryFilters($calls);
        }
        
        return $this;
        
    }
    
    
    public function checkCallsDiaryFilters($calls){
        $I = $this->tester;
        
        $currentUrl = $I->grabFromCurrentUrl();
        
        $callsObjects = array();
        foreach ($calls as $callsData) {
           
            $call = call::createCall($callsData);
            array_push($callsObjects, $call);
            
//            $I->amOnPage($currentUrl . self::SOURCE . $key['источник']  
//                     . self::MEDIUM . $key['средство'] 
//                     . self::DURATION_LOWER .  $key['duration_low'] 
//                     .  self::DURATION_UPPER . $key['duration_up']
//                    );
        }
        
       foreach ($callsObjects as $call) {
           $tail = self::generateTailUrl($call);
           $I->amOnPage($currentUrl . $tail);  
//                     . self::MEDIUM . $key['средство'] 
//                     . self::DURATION_LOWER .  $key['duration_low'] 
//                     .  self::DURATION_UPPER . $key['duration_up']
//                    );
       }
        
        return $this;
    }
    
 
    public function generateTailUrl($call){
        $tail = '';
        $isMultiSources = false;
        $isMultiMedium = false;
        
        if(strpos($call->getSource(), ',') != false){
            $isMultiSources = true;
            $sources = explode(",", $call->getSource());
            $numOfSources = count($sources);
            for($i=0;$i<$numOfSources;$i++){
                $tail .= self::SOURCE . $sources[$i];
            }
        }else{
             $tail .= self::SOURCE . $call->getSource();
        }
        
        return $tail;
    }
    
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
