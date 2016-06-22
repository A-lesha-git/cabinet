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

    public function __construct(\Codeception\Actor $I) {
        $this->tester = $I;
    }

    /*
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
                $I->seeNumberOfElements(self::$rowUtmReportTable, $numOfResults + 1); // +1 т.к. есть строка(tr) с наименованием, остальные с результатами. 
                self::verifyNumOfParamsInReport();
            }
        } else if ($numOfResults === 0) {
            //тестовый случай 3 когда по выбранному фильтру нет результатов
            //$numOfResults = 0
            $tr = $I->grabMultiple(self::$rowUtmReportTable);
            if (count($tr) > 1)
                $I->dontSeeElement(self::$tableUtmReport); /// если проверка проваливается, значит изменились utm отчеты
            self::verifyNumOfParamsInReport();
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

    public  function checkUtmReport($utmReportData) {
        $I = $this->tester;

        $utmReportObjects = self::getUtmReportObjects($utmReportData);
        
        $utmRepObgectsFromSite = array();
        $utmRepObgectsFromSite = self::getUtmReportObjectsFromSite();
        
//        foreach ($utmRepObgectsFromSite as $objSite) {
//         //   $I->see($objSite->getCalls());
//        }
        //$I->assertEquals(count($utmReportObjects), count($utmRepObgectsFromSite) );//+1 т.к. есть еще итоговый результат
        $I->assertEquals($utmRepObgectsFromSite, $utmReportObjects);
        
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

    public function getUtmReportObjectsFromSite() {
        $I = $this->tester;
        
        $rows = $I->grabMultiple(self::$rowUtmReportTable);

        $utmReportsObjectsFromSite = array();
        
        $utmReportFromSite = new utmTag();
        
        for($i=1;$i<=count($rows); $i++){
            $collsSelector = str_replace("%row%", $i, self::$rowsUtmReportData);
            $utmReportFromSite = new utmTag();


            for($j=1;$j<=self::NUM_OF_PARAMS_IN_REPORT;$j++){
                

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
                    //номер UTM метки в отчете
                    case 1:
                      // $utmNum
                        break;
                    //значение UTM метки в отчете
                    case 2:
                        if($j==1 && $i==1)
                            $utmReportFromSite->setUtmName(1);
                        $utmReportFromSite->setUtmName($value);
                        //$I->see($utmReportFromSite->getUtmName(),'//span');
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
                    // переходы из Спец\гарантия
                    case 11:
                        $utmReportFromSite->setConversionSpecialOrGaranty($value);
                        break;
                    //
                    case 12:
                        $utmReportFromSite->setCallsFromSpecialOrGaranty($value);
                        break;
                   //Конверсия в звонки в Спец/гарантия
                    case 13:
                        $utmReportFromSite->setConversionToCallsFromSpecOrGaranty($value);
                        break;
                    //Конверсия в сделки
                    case 14:
                        $utmReportFromSite->setConversionToOrders($value);
                        break;
                    //конверсия в обращения
                    case 15:
                        $utmReportFromSite->setConversionToTreatment($value);
                        break;
                    //переходы из Я.директ
                    case 16:
                        $utmReportFromSite->setConversionFromYD($value);
                        break;
                    //Показы я.директ в поиске
                    case 17:
                        $utmReportFromSite->setShowsYDInSearch($value);
                        break;
                    // Показы РСЯ
                    case 18:
                        $utmReportFromSite->setShowsRSY($value);
                        break;
                    //Затраты в Яндекс.директ
                    case 19:
                        $utmReportFromSite->setCostsYD($value);
                        break;
                    //Затраты на поиск в Я.директ
                    case 20:
                        $utmReportFromSite->setCostsToShowInSearchYD($value);
                        break;
                    //Затраты РСЯ
                    case 21:
                        $utmReportFromSite->setCostsInRSY($value);
                        break;
                    // Переходы из Google Adwords
                    case 22:
                        $utmReportFromSite->setConversionFromGoogleAdwords($value);
                        break;
                    // Затраты в google adwords
                    case 23:
                        $utmReportFromSite->setCostsGoogleAdwords($value);
                        break;
                    // количество продаж
                    case 24:
                        $utmReportFromSite->setNumOfSales($value);
                        break;
                    // конверсия из обращения в продажу
                    case 25:
                        $utmReportFromSite->setConversionFromTreatmentToSale($value);
                        break;
                    // Цена продажи (САС)
                    case 26:
                        $utmReportFromSite->setCostOfSaleCAC($value);
                        break;
                    // Обращения
                    case 27:
                        $utmReportFromSite->setTreatment($value);
                        break;
                    // Стоимость обращения
                    case 28:
                        $utmReportFromSite->setCostOfTreatment($value);
                        break;
                        // Сделки по звонкам
                    case 29:
                        $utmReportFromSite->setOrdersOnCalls($value);
                        break;
                    //выручка по звонкам
                    case 30:
                        $utmReportFromSite->setRevenueCalls($value);
                        break;
                    //Общая выручка
                    case 31:
                        $utmReportFromSite->setTotalRevenue($value);
                        break;
                   //ROI
                    case 32:
                        $utmReportFromSite->setROI($value);
                        break;
                    //ДРР
                    case 33:
                        $utmReportFromSite->setDRR($value);
                        break;

                    //Показы в спецразмещения Я.директ
                    case 34:
                        $utmReportFromSite->setShowsInSpecPlacement($value);
                        break;
                    //Показы в гарантии Я.директ
                    case 35:
                        $utmReportFromSite->setShowsInWarantyYD($value);
                        break;
                    //Соотношение показов Спец/Гарантия Я.Директ
                    case 36:
                        $utmReportFromSite->setRationOfShowsOfSpecOrWarantyYD($value);
                        break;
                    //Число посещений Я.Метрика
                    case 37:
                        $utmReportFromSite->setNumOfVisitsYM($value);
                        break;
                    //Отказы Я.Метрика %
                    case 38:
                        $utmReportFromSite->setFailuresYM($value);
                        break;
                        //Ср.длинна сессии Я.Метрика (сек)
                    case 39:
                        $utmReportFromSite->setAverageLengthOfSessionYM($value);
                        break;
                        //Глубина просмотра Я.Метрика
                    case 40:
                        $utmReportFromSite->setDepthOfViewYM($value);
                        break;
                        //Цели Я.Метрики 1 (посещения) Активность аудитории
                    case 41:
                        $utmReportFromSite->setGoalYMOne($value);
                        break;
                        //Цели Я.Метрики 2 (посещения) Загородка
                    case 42:
                        $utmReportFromSite->setGoalYMTwo($value);
                        break;
                    default:
                        break;
                }
                

            }
            array_push($utmReportsObjectsFromSite, $utmReportFromSite);
            $utmReportFromSite == null;
        }
        
        
        return $utmReportsObjectsFromSite;
    }

}
