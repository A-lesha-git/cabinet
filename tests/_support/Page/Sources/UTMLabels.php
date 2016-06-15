<?php

namespace Page\Sources;

class UTMLabels {

    protected $tester;

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
    // строка в таблице
    public static $rowUtmReportTable = "//table[@id='table_expand_list_result']/tbody/tr";
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
        }

        return $I;
    }

    /*
     * в методе происходит проверка utm отчетов
     * 0 - резльтатов нет
     * 9999 - не известно сколько именно результатов 
     * 
     * @param int $numOfResults
     */

    public function checkNumberOfResults($numOfResults) {
        $I = $this->tester;

        if ($numOfResults > 0) {
            if ($numOfResults == 9999) {
                // случай 1 когда изначально не известно кол-во результатов, например отчет за текущий день
                $I->seeElement(self::$rowUtmReportTable);
            } else {
                //тестовый случай 2 - изначально известно кол-во результатов
                $I->seeNumberOfElements(self::$rowUtmReportTable, $numOfResults + 1); // +1 т.к. есть строка(tr) с наименованием, остальные с результатами. 
            }
        } else if ($numOfResults === 0) {
            //тестовый случай 3 когда по выбранному фильтру нет результатов/
            //$numOfResults = 0
            $tr = $I->grabMultiple(self::$rowUtmReportTable);
            if (count($tr) > 1)
                $I->dontSeeElement(self::$tableUtmReport); /// если проверка проваливается, значит изменились utm отчеты
        }else if (is_null($numOfResults)) {
            //тестовый случай 4, когда ввели невалидные данные, то таблица не выводится/
            $I->dontSeeElement(self::$tableUtmReport);
            $I->dontSeeElement(self::$rowUtmReportTable);
        }else{
            // неизвестно что за тестовый случай
            $I->see("safdjasjdlkfljkasdfljasdfljafsd");
        }

        return $I;
    }

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

}
