<?php

namespace Page\Sources;
use Objects\UtmTag as utmTag;
class UTMLabels {

    protected $tester;
    
    //количество колонок в отчете по UTM меткам
    CONST NUM_OF_PARAMS_IN_REPORT = 42;
    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    //поля выбора периода времени
    public static $beginDateField = "#begin_date";
    public static $endDateField = "#end_date";
    //селекторы выбора UTM меток
    public static $UTMCampaignMultySelect = "#utm_campaign_select";
    public static $UTMMediumMultySelect = "#utm_medium_select";
    public static $UTMContentMultySelect = "#utm_content_select";
    public static $UTMSourceMultySelect = "#utm_source_select";
    public static $UTMTermMultySelect = "#utm_term_select";
    //Поле "Спецразмещение или гарантия"
    public static $positionTypeSelectField = "#position_type_select";
    //кнопка показать(верхняя)
    public static $btnShowOne = "//input[@class='btn']";
    
    //селекторы к таблице-отчету по utm меткам
    // таблица - отчет по utm меткам
    public static $tableUtmReport = "//table[@id='table_expand_list_result']";
    // строки в таблице
    public static $rowUtmReportTable = "//table[@id='table_expand_list_result']/tbody/tr";
    // столбцы в таблице
    public static $tdUtmReportTable = "//table[@id='table_expand_list_result']/tbody/tr[1]/td";
    
    //колонки определенной %row% строки
    public static $rowsUtmReportData = "//table[@id='table_expand_list_result']/tbody/tr[%row%]/td";

    //селектор utm фильтров: UTM campaign; UTM content; UTM Term; UTM Source
    // %filter% - по номеру элемента li определяется какой именно фильтр выбрать
    public static $utmTabFilter = "//ul[@id='tabs']/li[%filter%]/a";

    //форма поиска utm меток
    public  static $formUtmTagsFilter = "//form[@class='utm_tags_filter']";
    //select Utm campaign
    public static $selectUTMCampaign = '#utm_campaign_select';
    //select UTM Medium
    public static $selectUTMMedium = 'select id="utm_medium_select"';
    //select UTM Medium
    public static $selectUTMContent = "#utm_content_select";
    //select UTM Source
    public static $selectUTMSource = "#utm_source_select";
    //select UTM Term
    public static $selectUTMTerm = "#utm_term_select";
    //select спецразмещение или гарантия
    public static $selectPositionType = "#position_type_select";

    //ссылки и значения на журнал звонков
    public static $callsAndHrefs = ".//*[@id='table_expand_list_result']/tbody/tr/td[3]/a";
    //utm name coll
    public static $utmNameColl = ".//*[@id='table_expand_list_result']/tbody/tr/td[2]";

    //части uri для страниц utm меток

    CONST BEGIN_DATE = '&begin_date_filter=';
    CONST END_DATE = '&end_date_filter=';

    //параметр tag
    CONST TAG = '&tag=';
    //значения которые принимает параметр tag в url
    CONST TAG_UTM_CAMPAIGN = 'utm_campaign';
    CONST TAG_UTM_MEDIUM = 'utm_medium';
    CONST TAG_UTM_SOURCE = 'utm_source';
    CONST TAG_UTM_CONTENT = 'utm_content';
    CONST TAG_UTM_TERM = 'utm_term';
    CONST TAG_UTM_POSITION_TYPE = 'position_type';

    CONST UTM_CAMPAIGN = '&utm_campaign[]=';
    CONST UTM_MEDIUM = '&utm_medium[]=';
    CONST UTM_SOURCE = '&utm_source[]=';
    CONST UTM_CONTENT = '&utm_content[]=';
    CONST UTM_TERM = '&utm_term[]=';
    CONST UTM_POSITION_TYPE = '&position_type[]=';


    public function __construct(\Codeception\Actor $I) {
        $this->tester = $I;
    }


    /*
     * в методе
     */
    public function testSourcesUtmAndCalls($sourcesUtmCallsData){
        $I = $this->tester;

        $callPage = new \Page\Clients\CallsDiary($I);

        foreach ($sourcesUtmCallsData as $key) {
            $beginDate = $key['begin_date'];
            $endDate = $key['end_date'];
            $tagFilter = $key['utm_filter'];
            $utmCampaign = $key['utm_campaign'];
            $utmMedium = $key['utm_medium'];
            $utmContent = $key['utm_content'];
            $utmSource = $key['utm_source'];
            $utmTerm = $key['utm_term'];
            $utmPositionType = $key['utm_position_type'];
            $currentUrl = $I->grabFromCurrentUrl();

            $uri = self::generateUTMURI($currentUrl, $beginDate, $endDate,$tagFilter,
                $utmCampaign, $utmMedium, $utmContent, $utmSource,
                $utmTerm, $utmPositionType);
            $I->amOnPage($uri);

            $hrefs = $I->grabMultiple(self::$callsAndHrefs, 'href');

            for($i = 0; $i < count($hrefs); $i++){
                $I->amOnPage($hrefs[$i]);
                $callPage->verifyThatCallsExistsById($key['calls'][$i]);
            }

        }


        return $I;

    }


    /*
     * тест поиска utm меток по значениям UTM Campaign, UTM Source и т.д.
     *  @param array() $utmData
     */
    public function testSearchByUtmValues($utmData){
        $I = $this->tester;

        foreach ($utmData as $key) {
            $beginDate = $key['begin_date'];
            $endDate = $key['end_date'];
            $tagFilter = $key['utm_filter'];
            $utmCampaign = $key['utm_campaign'];
            $utmMedium = $key['utm_medium'];
            $utmContent = $key['utm_content'];
            $utmSource = $key['utm_source'];
            $utmTerm = $key['utm_term'];
            $utmPositionType = $key['utm_position_type'];
            $currentUrl = $I->grabFromCurrentUrl();

            $uri = self::generateUTMURI($currentUrl, $beginDate, $endDate,$tagFilter,
                                        $utmCampaign, $utmMedium, $utmContent, $utmSource,
                                        $utmTerm, $utmPositionType);
            $I->amOnPage($uri);


            self::verifyThatSearchUtmtagsFormExist();
            self::checkUtmData($key['utm_data_to_check']);
        }

        return $I;
    }



    /* тест поиск utm меток по датам
     * @param array() $utmData
     */

    public function testSearchUtmLabelsByDates($utmData) {
        $I = $this->tester;

        foreach ($utmData as $key) {
            $beginDate = $key['begin_date'];
            $endDate = $key['end_date'];
            if (isset($key['utm_filter']))
                self::chooseUTMTabFilter($key['utm_filter']);
            self::fillFormUtmDates($beginDate, $endDate);

            self::checkUtmData($key['utm_data_to_check']);
        }

        return $I;
    }

    /*
     * Функция заполняет форму с полями начальная и конечная даты и нажимает кнопку найти
     * если date == now, то смотрим результаты за текущий день
     * @param string  $beginDate (дд-мм-гггг) 
     * @param string $endDate (дд-мм-гггг) 
     */

    public function fillFormUtmDates($beginDate, $endDate) {
        $I = $this->tester;

        if ($beginDate == "now" && $endDate == "now") {
            $I->fillField(self::$beginDateField, date("Y-m-d"));
            $I->fillField(self::$endDateField, date("Y-m-d"));
        } else {
            $I->fillField(self::$beginDateField, $beginDate);
            $I->fillField(self::$endDateField, $endDate);
        }
        $I->click('Показать', self::$btnShowOne);

        return $I;
    }


    
    /*
     * С помощью данного метода выбирается нужная вкладка(фильтр) utm метки
     * @param String $utmFilter
     */
     public function chooseUTMTabFilter($utmFilter) {
        $I = $this->tester;

        switch ($utmFilter) {
            case 'UTM Campaign':
                $selector = str_replace("%filter%", 1, self::$utmTabFilter);
                $I->click($selector);
                break;

            case 'UTM Medium':
                $selector = str_replace("%filter%", 2, self::$utmTabFilter);
                $I->click($selector);
                break;

            case 'UTM Content':
                $selector = str_replace("%filter%", 3, self::$utmTabFilter);
                $I->click($selector);
                break;

            case 'UTM Term':
                $selector = str_replace("%filter%", 4, self::$utmTabFilter);
                $I->click($selector);
                break;

            case 'UTM Source':
                $selector = str_replace("%filter%", 5, self::$utmTabFilter);
                $I->click($selector);
                break;

            default:
                break;
        }

        return $I;
    }

    /*
     * Метод проверяет что форма поиска utm меток существует на странице
     */
    public function verifyThatSearchUtmtagsFormExist(){
        $I = $this->tester;

        $I->seeElement(self::$formUtmTagsFilter);
        $I->seeElement(self::$selectUTMCampaign);
        $I->seeInSource(self::$selectUTMMedium);
        $I->seeElement(self::$selectUTMContent);
        $I->seeElement(self::$selectUTMSource);
        $I->seeElement(self::$selectUTMTerm);
        $I->seeElement(self::$selectPositionType);

        return $I;
    }



    /*
     * В методе происходит проверка utm данных
     * @param array() $utmData
     */

    public function checkUtmData($utmData) {
        $I = $this->tester;

        foreach ($utmData as $key) {
            self::checkNumberOfResults($key['num_of_results']);
            if(isset($key['utm_report_data'])){
                self::checkUtmReport($key['utm_report_data']);
            }
        }

        return $I;
    }

    /*
     * в методе происходит проверка utm отчетов
     * 
     * @param int $numOfResults может принимать следующие значения
     * null - таблица-отчет вообще не выводится
     * 0 - отчет пустой 
     * > 0  изначально известно кол-во результатов
     * 9999 - не известно сколько именно результатов 
     */

    public function checkNumberOfResults($numOfResults) {
        $I = $this->tester;

        if ($numOfResults > 0) {
            if ($numOfResults == 9999) {
                // случай 1 когда изначально не известно кол-во результатов, например отчет за текущий день
                $I->seeElement(self::$rowUtmReportTable);
                self::verifyNumOfParamsInReport();
            } else {
                //тестовый случай 2 - изначально известно кол-во результатов
                $txt = $I->grabTextFrom("//table[@id='table_expand_list_result']/tbody/tr[1]/td[3]");
                $pos = strpos($txt, "Всего за период");
                //если строки с итоговыми данными нет
                if($pos === false){
                    $I->seeNumberOfElements(self::$rowUtmReportTable, $numOfResults);
                    //$I->see($pos);
                }
                else{
                    $I->seeNumberOfElements(self::$rowUtmReportTable, $numOfResults+1);// +1 т.к. есть строка(tr) с наименованием, остальные с результатами.
                    //$I->see($pos);
                }
                self::verifyNumOfParamsInReport();
            }
        } else if ($numOfResults === 0) {
            //тестовый случай 3 когда по выбранному фильтру нет результатов
            //$numOfResults = 0

            //$I->see('Для заданного фильтра значений UTM-меток не найдено.', '//h4');
            $tr = $I->grabMultiple(self::$rowUtmReportTable);
            if (count($tr) > 1)
                $I->dontSeeElement(self::$tableUtmReport); /// если проверка проваливается, значит изменились utm отчеты
           // self::verifyNumOfParamsInReport();
        }else if (is_null($numOfResults)) {
            //тестовый случай 4, когда ввели невалидные данные, то таблица не выводится
            $I->dontSeeElement(self::$tableUtmReport);
            $I->dontSeeElement(self::$rowUtmReportTable);
        }else{
            // неизвестно что за тестовый случай
            $I->see("safdjasjdlkfljkasdflj;*_)!Ё!(№;*)№*№)asdfljafsd");
        }

        return $I;
    }
    /*
     * Метод проверяет что кол-во колонок в отчете корректное
     */
    public function verifyNumOfParamsInReport(){
        $I = $this->tester;
        
        $tdArr = $I->grabMultiple(self::$tdUtmReportTable);
        $numOfParamsInReport = count($tdArr);
        
        $I->assertTrue($numOfParamsInReport >= self::NUM_OF_PARAMS_IN_REPORT);
        
        return $I;
    }
    /*
     * Проверка utm отчетов
     */
    public  function checkUtmReport($utmReportData) {
        $I = $this->tester;

        $utmReportObjects = self::getUtmReportObjects($utmReportData);
        

        $utmRepObgectsFromSite = self::getUtmReportObjectsFromSite();

        $I->assertEquals(count($utmRepObgectsFromSite), count($utmReportObjects));
        $I->assertEquals($utmReportObjects, $utmRepObgectsFromSite);
        
        return $I;
    }
    
    public function getUtmReportObjects($utmReportData) {
         $utmReportObjects = array();
        foreach ($utmReportData as $utmReportUnit){
            
            $utmReportObject = utmTag::createReport($utmReportUnit);
            array_push($utmReportObjects,$utmReportObject);
        }
        
        return $utmReportObjects;
    }
    //@return  array() $utmReportsObjectsFromSite возвращает массив объектов
    public function getUtmReportObjectsFromSite() {
        $I = $this->tester;
        
        $rows = $I->grabMultiple(self::$rowUtmReportTable);

        $utmReportsObjectsFromSite = array();

        $tdArr = $I->grabMultiple(self::$tdUtmReportTable);
        $numOfColls = count($tdArr);
        //$I->see($numOfColls . "количество колонок");
        for($i=1;$i<=count($rows); $i++){
            $collsSelector = str_replace("%row%", $i, self::$rowsUtmReportData);
            $utmReportFromSite = new utmTag();


            for($j=1; $j<=$numOfColls; $j++){
                

                $tdData = $I->grabMultiple($collsSelector . '[' . $j . ']');
                $value = '';
                if(is_array($tdData)){
                    $value = trim($tdData[0]);
                }else{
                    $value = trim($tdData);
                }
                $value = str_replace("\n","",$value);
                if($i==1){
                    $value = str_replace(" ","",$value);
                }



                switch ($j) {
                    //комментарии к кейсам проставлены исходя из того что в отчете 42 колонки
                    //но может быть смещение в случае 43 колонок
                    //номер UTM метки в отчете
                    case 1:
                      // $utmNum
                        break;
                    //значение UTM метки в отчете
                    case 2:
                        if($j==1 && $i==1)
                            $utmReportFromSite->setUtmName(1);
                        $utmReportFromSite->setUtmName($value);
//                        $I->see($utmReportFromSite->getUtmName(),'//span');
                        break;
                    //все звонки по UTM метке 
                    case 3:
                        $utmReportFromSite->setCalls($value);
                        break;
                    //уникальные звонки по UTM метке 
                    case 4:
                        $utmReportFromSite->setUniqueCalls($value);
                        break;
                    
                    //целевые звонки по UTM метке 
                    case 5:
                        $utmReportFromSite->setTargetCalls($value);
                        break;
                    //уникально-целевые звонки по UTM метке 
                    case 6:
                        $utmReportFromSite->setUniqueAndTargetCalls($value);
                        break;
                    //Звонки в рабочее время
                    case 7:
                        $utmReportFromSite->setCallsInWorkTime($value);
                        break;

                    //Онлайн заявки
                    case 8:
                        $utmReportFromSite->setOnlineRequests($value);
                        break;
                    //Cделки(заказы)
                    case 9:
                        $utmReportFromSite->setOrders($value);

                       // $I->see($value, "//table [@id='table_expand_list_result']/tbody/tr[".$i . "]/td[".$j ."]");
                        break;
                    //посещения
                    case 10:
                        $utmReportFromSite->setNumOfVisits($value);
                        break;

//                    //Тэги и категории
//                    case 11:
//                        $utmReportFromSite->setConversionSpecialOrGaranty($value);
//                        break;
                    // переходы из Спец\гарантия
                    case 11:
                        if($numOfColls == 42)
                            $utmReportFromSite->setConversionSpecialOrGaranty($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setTagsAndCategory($value);
                        break;
                    //
                    case 12:
                        if($numOfColls == 42)
                            $utmReportFromSite->setCallsFromSpecialOrGaranty($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setConversionSpecialOrGaranty($value);
                        break;
                   //Конверсия в звонки в Спец/гарантия
                    case 13:
                        if($numOfColls == 42)
                            $utmReportFromSite->setConversionToCallsFromSpecOrGaranty($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setCallsFromSpecialOrGaranty($value);
                        break;
                    //Конверсия в сделки
                    case 14:
                        if($numOfColls == 42)
                            $utmReportFromSite->setConversionToOrders($value);
                        else if($numOfColls == 43){
                            $utmReportFromSite->setConversionToCallsFromSpecOrGaranty($value);
                           //$I->see($value);
                }
                        break;
                    //конверсия в обращения
                    case 15:
                        if($numOfColls == 42)
                            $utmReportFromSite->setConversionToTreatment($value);
                        else if($numOfColls == 43){
                            $utmReportFromSite->setConversionToOrders($value);
                            //$I->see($value);
                        }
                        break;
                    //переходы из Я.директ
                    case 16:
                        if($numOfColls == 42)
                            $utmReportFromSite->setConversionFromYD($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setConversionToTreatment($value);
                        break;
                    //Показы я.директ в поиске
                    case 17:
                        if($numOfColls == 42)
                            $utmReportFromSite->setShowsYDInSearch($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setConversionFromYD($value);
                        break;
                    // Показы РСЯ
                    case 18:
                        if($numOfColls == 42)
                            $utmReportFromSite->setShowsRSY($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setShowsYDInSearch($value);
                        break;
                    //Затраты в Яндекс.директ
                    case 19:
                        if($numOfColls == 42)
                            $utmReportFromSite->setCostsYD($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setShowsRSY($value);
                        break;
                    //Затраты на поиск в Я.директ
                    case 20:
                        if($numOfColls == 42)
                            $utmReportFromSite->setCostsToShowInSearchYD($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setCostsYD($value);
                        break;
                    //Затраты РСЯ
                    case 21:

                        if($numOfColls == 42)
                            $utmReportFromSite->setCostsInRSY($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setCostsToShowInSearchYD($value);
                        break;
                    // Переходы из Google Adwords
                    case 22:

                        if($numOfColls == 42)
                            $utmReportFromSite->setConversionFromGoogleAdwords($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setCostsInRSY($value);

                        break;
                    // Затраты в google adwords
                    case 23:

                        if($numOfColls == 42)
                            $utmReportFromSite->setCostsGoogleAdwords($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setConversionFromGoogleAdwords($value);
                        break;
                    // количество продаж
                    case 24:

                        if($numOfColls == 42)
                            $utmReportFromSite->setNumOfSales($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setCostsGoogleAdwords($value);
                        break;
                    // конверсия из обращения в продажу
                    case 25:

                        if($numOfColls == 42)
                            $utmReportFromSite->setConversionFromTreatmentToSale($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setNumOfSales($value);
                        break;
                    // Цена продажи (САС)
                    case 26:

                        if($numOfColls == 42)
                            $utmReportFromSite->setCostOfSaleCAC($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setConversionFromTreatmentToSale($value);
                        break;
                    // Обращения
                    case 27:
                        if($numOfColls == 42)
                            $utmReportFromSite->setTreatment($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setCostOfSaleCAC($value);
                        break;
                    // Стоимость обращения
                    case 28:

                        if($numOfColls == 42)
                            $utmReportFromSite->setCostOfTreatment($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setTreatment($value);
                        break;
                        // Сделки по звонкам
                    case 29:

                        if($numOfColls == 42)
                            $utmReportFromSite->setOrdersOnCalls($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setCostOfTreatment($value);
                        break;
                    //выручка по звонкам
                    case 30:

                        if($numOfColls == 42)
                            $utmReportFromSite->setRevenueCalls($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setOrdersOnCalls($value);
                        break;
                    //Общая выручка
                    case 31:

                        if($numOfColls == 42)
                            $utmReportFromSite->setTotalRevenue($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setRevenueCalls($value);
                        break;
                   //ROI
                    case 32:

                        if($numOfColls == 42)
                            $utmReportFromSite->setROI($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setTotalRevenue($value);
                        break;
                    //ДРР
                    case 33:

                        if($numOfColls == 42)
                            $utmReportFromSite->setDRR($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setROI($value);
                        break;

                    //Показы в спецразмещения Я.директ
                    case 34:

                        if($numOfColls == 42)
                            $utmReportFromSite->setShowsInSpecPlacement($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setDRR($value);
                        break;
                    //Показы в гарантии Я.директ
                    case 35:

                        if($numOfColls == 42)
                            $utmReportFromSite->setShowsInWarantyYD($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setShowsInSpecPlacement($value);
                        break;
                    //Соотношение показов Спец/Гарантия Я.Директ
                    case 36:

                        if($numOfColls == 42)
                            $utmReportFromSite->setRationOfShowsOfSpecOrWarantyYD($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setShowsInWarantyYD($value);
                        break;
                    //Число посещений Я.Метрика
                    case 37:

                        if($numOfColls == 42)
                            $utmReportFromSite->setNumOfVisitsYM($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setRationOfShowsOfSpecOrWarantyYD($value);
                        break;
                    //Отказы Я.Метрика %
                    case 38:

                        if($numOfColls == 42)
                            $utmReportFromSite->setFailuresYM($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setNumOfVisitsYM($value);
                        break;
                        //Ср.длинна сессии Я.Метрика (сек)
                    case 39:
                        if($numOfColls == 42)
                            $utmReportFromSite->setAverageLengthOfSessionYM($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setFailuresYM($value);
                        break;
                        //Глубина просмотра Я.Метрика
                    case 40:

                        if($numOfColls == 42)
                            $utmReportFromSite->setDepthOfViewYM($value);
                        else if($numOfColls == 43)
                            $utmReportFromSite->setAverageLengthOfSessionYM($value);
                        break;
                        //Цели Я.Метрики 1 (посещения) Активность аудитории
                    case 41:

//                        if($numOfColls == 42)
//                            $utmReportFromSite->setGoalYMOne($value);
//                        else
                            if($numOfColls == 43)
                            $utmReportFromSite->setDepthOfViewYM($value);
                        break;
                        //Цели Я.Метрики 2 (посещения) Загородка
//                    case 42:
//
//                        if($numOfColls == 42)
//                            $utmReportFromSite->setGoalYMTwo($value);
//                        else if($numOfColls == 43)
//                            $utmReportFromSite->setGoalYMOne($value);
//                        break;

//                    case 43:
//                            $utmReportFromSite->setGoalYMTwo($value);
//
//                        break;
                    default:
                        break;
                }
                

            }
            array_push($utmReportsObjectsFromSite, $utmReportFromSite);
            $utmReportFromSite == null;
        }
        
        
        return $utmReportsObjectsFromSite;
    }

    /*Метод возвращает нужный URI целиком
     * @param String $currentUrl
     * @param String $beginDate
     * @param String $endDate
     * @param String $tagFilter- активный фильтр по utm меткам
     *
     * Данные в форме поиска utm меток
     * @param String $utmContent
     * @param String $utmMedium
     * @param String $utmCampaign
     * @param String $utmSource
     * @param String $utmTerm
     * @param String $utmPositionType
     *
     * return String $uri
     */
    public function generateUTMURI($currentUrl, $beginDate, $endDate, $tagFilter, $utmCampaign, $utmMedium, $utmContent, $utmSource,$utmTerm, $utmPositionType){
        $arrUrl = explode("?", $currentUrl);
        $uriPartOne = $arrUrl[0].'?';
        $uriPartTwo = "";

        $utmCampaignURI = self::getUTMPartURI($utmCampaign, self::UTM_CAMPAIGN);
        $uriPartTwo .= $utmCampaignURI;

        $utmMediumURI = self::getUTMPartURI($utmMedium, self::UTM_MEDIUM);
        $uriPartTwo .= $utmMediumURI;

        $utmContentURI = self::getUTMPartURI($utmContent, self::UTM_CONTENT);
        $uriPartTwo .= $utmContentURI;

        $utmSourceURI = self::getUTMPartURI($utmSource, self::UTM_SOURCE);
        $uriPartTwo .= $utmSourceURI;

        $utmTermPartURI = self::getUTMPartURI($utmTerm, self::UTM_TERM);
        $uriPartTwo .= $utmTermPartURI;


        $utmPositionTypePartURI = self::getUTMPartURI($utmPositionType, self::UTM_POSITION_TYPE);
        $uriPartTwo .= $utmPositionTypePartURI;



        $partTagURI = self::getPartOfUTMTagURI($tagFilter);
        $uriPartTwo .= self::TAG . $partTagURI . self::BEGIN_DATE . $beginDate . self::END_DATE . $endDate;



        $uri = $uriPartOne . $uriPartTwo;
        $uri = str_replace("?&","?", $uri);

        return $uri;
    }


    /*
     * Метод возвращает часть uri parametr=value и т.д.
     * @param String $utmTagParamValues
     * @param String $utmTagNameParam
     *
     * @return возвращает часть uri с параметрами
     */
    public function getUTMPartURI($utmTagParamValues, $utmTagNameParam){
        $utmPartPartURI = '';
        if(!empty($utmTagParamValues)){
            $utmTagURI ="";
            $pos = strpos($utmTagParamValues,',');
            if($pos !== 0){
                $utmSourcePartURI =  explode(',', $utmTagParamValues);
                for($i=0;$i<count($utmSourcePartURI); $i++){
                   $utmTagURI .=   $utmTagNameParam . $utmSourcePartURI[$i];

                }
            }else {
                $utmTagURI .=   $utmTagNameParam . $utmTagParamValues;
            }

            $utmPartPartURI .= $utmTagURI;
        }

        return $utmPartPartURI;
    }

    /*
     * метод отдает кусок uri в зависимости от выбранного фильтра
     * @param String $tagFilter
     *
     * @return String
     */
    public function getPartOfUTMTagURI($tagFilter){
        $utmTagURI = "";
        switch ($tagFilter) {
            case 'UTM Campaign':
                $utmTagURI = self::TAG_UTM_CAMPAIGN;
                break;

            case 'UTM Source':
                $utmTagURI = self::TAG_UTM_SOURCE;
                break;
            case 'UTM Medium':
                $utmTagURI = self::TAG_UTM_MEDIUM;
                break;
            case 'UTM Term':
                $utmTagURI = self::TAG_UTM_TERM;
                break;
            case 'UTM Content':
                $utmTagURI = self::TAG_UTM_CONTENT;
                break;
            case 'спецразмещение или гарантия':
                $utmTagURI = self::TAG_UTM_POSITION_TYPE;
                break;


            default:
                break;
        }
        return $utmTagURI;

    }

}
