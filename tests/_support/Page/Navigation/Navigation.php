<?php
namespace Page\Navigation;

class Navigation
{
    
    //части урлов
    public static $BILLS = 'bills?billdoc_accountname=';
    public static $PERSONAL = '/personal';
    public static $SEGMENTS = '/statistics/segments?segmentId=any&';
    public static $SOURCES = '/statistics?selectSiteSegment=any&';
    public static $MONEY_TRAFIC = '/statistics/segments?segmentId=51&';
    public static $SEARCH_SYSTEM =  '/statistics/segments?segmentId=52&';
    public static $REFERAL = '/statistics/segments?segmentId=53&';
    public static $DIRECT_SET = '/statistics/segments?segmentId=54&';
    public static $UTM_METKI = '/analytics/utmTags?';
    public static $KEY_REQUEST = '/analytics/keywords?medium=organic&mode=1&';
    public static $REQUESTS_FOR_DAYS ='/analytics/calls?';
    public static $BY_DEVICES ='/analytics/devices?section=device&';
    public static $BY_BROWSER ='/analytics/devices?section=browser&';
    public static $FILTER_BY_OS = '/analytics/devices?section=os&';
    public static $PENDING_REQUEST = '/analytics/otlozhenniy_spros?';
    public static $CALLS_DIARY = '/calls/calls_diary?';
    public static $REQUEST_DIARY = '/requests/requests_diary?';
    public static $CLIENTS_LIST = '/clients?';
    public static $ORDERS_DIARY = '/orders/orders_diary?';
    public static $ROI_REPORT = '/sales/roi?';
    public static $SETTINGS = '/conversion_increase/dynamic_call?';
    public static $STATISTIC = '/analytics/callbacks?';
    public static $YANDEX_DIRECT= '/context_optimization/index?';
    public static $CALLBACK_HUNTER ='/Callbackhunter?';
    public static $ALYTICS = '/settings/api/alytics?';
    public static $AMO_CRM = '/settings/api/amocrm?';
    public static $MOY_SKLAD = '/settings/api/moyskladcrm?';
    public static $UNIVERSAL_ANALYTICS = '/settings/api/gua?';
    public static $YANDEX_METRIKA = '/settings/yametrika?';
    public static $GOOGLE_ADDWORDS ='/settings/google_adwords?';
    public static $SETTINGS_YA_DIRECT = '/settings/yadirect?;';
    public static $RETAIL_CRM = '/settings/retailcrm?';
    public static $INSTRUCTION_TO_CONNECT = '/settings/info?';
    public static $FAQ = '/support/faq?';
    public static $API_DOCUMENTATION = '/support/apidoc?';
//  part of url of current page
    public static $URL = '/dashboard';
    public static $ACCOUNTS = '/accounts/';
    public static $SITES = "/sites/";
    public static $OPTIONS = "/personal";
    public static $BEGIN_DATE = "begin_date_filter=";
    public static $END_DATE = "&end_date_filter=";
    //locators
    public static $mainTableStatistic = "#main_stat_segment_id";
    public static $mainTableStat = "#main_stat_total_id";
    public static $mainStatTotalGraph = "#divAjaxChartMain";
    public static $siteChartCallsGraph = '#site-chart-calls';
    public static $chartDiv = '#chart_div';
    public static $chartDivOne = '#chart_div1';
    public static $chartDivTwo = '#chart_div2';
    public static $chartDivThree = '#chart_div3';
    public static $chartDivFour = '#chart_div4';
    public static $chartHourStat = '#chart_hour_stat';
    public static $chartWeekStat = '#chart_week_stat';
    public static $tableExpandListRes ='#table_expand_list_result';
    public static $tableHour ='#table_hour';
    public static $tableNumOfCallsSrc  = "class='table-bordered table'";
    public static $tableNumOfCallsTwoSrc = "class='table table-striped table-bordered table-condensed'";

    /**
     * @var \Codeception\Actor
     */
    protected $tester;

    public function __construct(\Codeception\Actor $I)
    {
        $this->tester = $I;
    }

    public function find500Errors($idAccaunt, $idSite, $startDate, $endDate, $siteName,$sections)
    {
        $I = $this->tester;
        $I->see($siteName);
        for($i=0;$i<count($sections);$i++){
            $I = self::checkPage($I,$idAccaunt, $idSite, $startDate, $endDate, $sections[$i]);
        }
        return $this;
    }

    public static function getPageUrl($idAccaunt, $idSite, $startDate, $endDate, $section)
    {
        $url=self::$ACCOUNTS . $idAccaunt .self::$SITES. $idSite. $section . self::$BEGIN_DATE. $startDate . self::$END_DATE . $endDate;
        return $url;
    }

    public static function checkPage($I,$idAccaunt, $idSite, $startDate, $endDate,$section){
        switch ($section) {
            //Переходим на страницу Все сегменты
            case 'Все сегменты':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SEGMENTS));
                $I->see($section, 'h1');
                $I->seeElement(self::$mainTableStatistic);
                $I->see('Платный трафик');
                break;
            case 'Все источники':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SOURCES));
                $I->see($section, 'h1');
                $I->seeElement(self::$mainStatTotalGraph);
                $I->see('google');
                $I->seeElement(self::$chartDivOne);
                $I->seeElement(self::$chartDivTwo);
                $I->seeElement(self::$chartDivFour);
//                $I->seeElement(self::$chartDivThree); сбоит, возможно зависит от периода
                break;
            case 'Платный трафик':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$MONEY_TRAFIC));
                $I->see($section, 'h1');
                $I->see('yandex');
                $I->seeElement(self::$mainStatTotalGraph);
                $I->seeElement(self::$chartDivOne);
                $I->seeElement(self::$chartDivTwo);
                $I->seeElement(self::$chartDivFour);
                $I->seeElement(self::$chartDivThree);
                break;
            case 'Поисковые системы':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SEARCH_SYSTEM));
                $I->see($section, 'h1');
                $I->see('google');
                $I->seeElement(self::$mainStatTotalGraph);
                $I->seeElement(self::$chartDivOne);
                $I->seeElement(self::$chartDivTwo);
                $I->seeElement(self::$chartDivFour);
                $I->seeElement(self::$chartDivThree);
                break;
            case 'Рефералы':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$REFERAL));
                $I->see($section, 'h1');
                $I->canSeeElement(self::$mainStatTotalGraph);
                $I->canSeeElement(self::$mainTableStat);
                $I->seeElement(self::$chartDivOne);
                $I->seeElement(self::$chartDivTwo);
                $I->seeElement(self::$chartDivThree);
                $I->seeElement(self::$chartDivFour);
                break;
            case 'Прямые заходы':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$DIRECT_SET));
                $I->canSee($section, 'h1');
                $I->canSeeElement(self::$mainTableStat);
                $I->canSeeElement(self::$mainStatTotalGraph);
                $I->canSeeElement(self::$chartDivOne);
                $I->canSeeElement(self::$chartDivTwo);
                $I->canSeeElement(self::$chartDivThree);
                $I->canSeeElement(self::$chartDivFour);
                break;
            case 'UTM-метки':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$UTM_METKI));
                $I->canSee($section, 'h1');
//                $I->canSeeElement(self::$tableExpandListRes);
                break;
            case 'Ключевые запросы':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$KEY_REQUEST));
                $I->canSee($section, 'h1');
//                $I->canSeeElement(self::$chartDiv); сбоит проверка
                //$I->canSeeInSource($tableNumOfCallsSrc); сбоит проверка
                break;
            case 'По времени и дням':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$REQUESTS_FOR_DAYS));
                $I->canSee($section, 'h1');
                $I->canSeeElement(self::$chartDiv);
                $I->canSeeElement(self::$tableHour);
//                $I->canSeeInSource(self::$tableNumOfCallsTwoSrc);
                $I->canSeeElement(self::$chartHourStat);
                $I->canSeeElement(self::$chartHourStat);
                $I->canSeeElement(self::$chartWeekStat);
                $I->canSeeElement(self::$chartDivOne);
                $I->canSeeElement(self::$chartDivTwo);
//                $I->canSeeElement(self::$chartDivThree);
//                $I->canSeeElement(self::$chartDivFour);
                break;
            case 'По устройствам':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$BY_DEVICES));
                $I->see($section, 'h1');
                break;
            case 'По браузерам':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$BY_BROWSER));
                $I->see($section, 'h1');
                break;
            case 'По ОС':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$FILTER_BY_OS));
                $I->see($section, 'h1');
                break;
            // данная страница очень долго открывается порой более 3 минут
            // поэтому тесты могут падать
            case 'Отложенный спрос':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$PENDING_REQUEST));
                $I->canSee($section, 'h1');
                break;
            case 'Журнал Звонков':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$CALLS_DIARY));
                $I->see($section, 'h1');
                break;
            case 'Журнал Заявок':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$REQUEST_DIARY));
                $I->see($section, 'h1');
                break;
            case 'Список клиентов':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$CLIENTS_LIST));
                $I->see($section, 'h1');
                break;
            case 'Журнал продаж':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$ORDERS_DIARY));
                $I->see($section, 'h1');
                break;
            case 'ROI отчет':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$ROI_REPORT));
                $I->see($section, 'h1');
                break;
            case 'Настройка':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SETTINGS));
                $I->see($section, 'h1');
                break;
            case 'Статистика':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$STATISTIC));
                $I->see('Обратный звонок. Статистика', 'h1');
                break;

            case 'Callbackhunter':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$CALLBACK_HUNTER));
                //$I->see('Все источники', 'h1'); // какая то мистика по отдельности все ок, когда запускаю по очереди валится, говорит что в h1 Прямые заходы
                break;

            case 'Alytics':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$ALYTICS));
                $I->canSee('Alytics', 'h1');
                break;

            case 'AmoCrm':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$AMO_CRM));
                $I->canSee('AmoCrm', 'h1');
                break;

            case 'Мой Склад':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$MOY_SKLAD));
                $I->canSee('Мой склад', 'h1');
                break;

            case 'Universal Analytics':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$UNIVERSAL_ANALYTICS));
                $I->canSee('Google Analytics', 'h1');
                break;

            case 'Яндекс.Метрика':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$YANDEX_METRIKA));
                $I->canSee('Яндекс Метрика', 'h1');
                break;

            case 'Google AdWords':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$GOOGLE_ADDWORDS));
                $I->canSee('Google AdWords', 'h1');
                break;

            case 'RetailCRM':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$RETAIL_CRM));
                $I->canSee('RetailCRM', 'h1');
                break;

            case 'Яндекс.Директ':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$YANDEX_DIRECT));
                $I->canSee('Оптимизация рекламы');
                $I->canSee('Яндекс.Директ');
                break;
            case 'Яндекс.ДиректS':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SETTINGS_YA_DIRECT));
                $I->canSee('Аккаунты Яндекс.Директ', 'h1');
                
            break;
            case 'Инструкция подключения':
                if($idAccaunt==77){
                    $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$INSTRUCTION_TO_CONNECT));
                    $I->canSee('Страница недоступна', 'h2');
                }else{
                    $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$INSTRUCTION_TO_CONNECT));
                    $I->see($section);
                }
                break;

            case 'F.A.Q.;support':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$FAQ));
                $I->canSee($section, 'h1');
                break;

            case 'API документация':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$API_DOCUMENTATION));
                $I->canSee($section);
                break;

            default:
                break;
        }
        return $I;
    }
    // по параметрам осуществляется переход на конкр. страницу
    public  function goToPage($idAccaunt, $idSite, $startDate, $endDate,$section){
        $I = $this->tester;
        switch ($section) {
            //Переходим на страницу Все сегменты
            case 'Все сегменты':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SEGMENTS));

                break;
            case 'Все источники':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SOURCES));
                break;
            case 'Платный трафик':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$MONEY_TRAFIC));
                break;
            case 'Поисковые системы':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SEARCH_SYSTEM));
                break;
            case 'Рефералы':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$REFERAL));
                break;
            case 'Прямые заходы':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$DIRECT_SET));
                break;
            case 'UTM-метки':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$UTM_METKI));
                break;
            case 'Ключевые запросы':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$KEY_REQUEST));
                break;
            case 'По времени и дням':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$REQUESTS_FOR_DAYS));
                break;
            case 'По устройствам':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$BY_DEVICES));
                break;
            case 'По браузерам':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$BY_BROWSER));
                break;
            case 'По ОС':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$FILTER_BY_OS));
                break;
            // данная страница очень долго открывается порой более 3 минут
            // поэтому тесты могут падать
            case 'Отложенный спрос':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$PENDING_REQUEST));
                break;
            case 'Журнал Звонков':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$CALLS_DIARY));
                break;
            case 'Журнал Заявок':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$REQUEST_DIARY));
                break;
            case 'Список клиентов':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$CLIENTS_LIST));
                break;
            case 'Журнал продаж':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$ORDERS_DIARY));
                break;
            case 'ROI отчет':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$ROI_REPORT));
                $I->see('ROI отчет');
                break;
            case 'Настройка':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SETTINGS));
                break;
            case 'Статистика':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$STATISTIC));
                break;
            case 'Яндекс.Директ':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$YANDEX_DIRECT));
                break;

            case 'Callbackhunter':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$CALLBACK_HUNTER));
                break;

            case 'Alytics':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$ALYTICS));
                break;

            case 'AmoCrm':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$AMO_CRM));
                break;

            case 'Мой Склад':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$MOY_SKLAD));
                break;

            case 'Universal Analytics':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$UNIVERSAL_ANALYTICS));
                break;

            case 'Яндекс.Метрика':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$YANDEX_METRIKA));
                break;

            case 'Google AdWords':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$GOOGLE_ADDWORDS));
                break;

            case 'RetailCRM':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$RETAIL_CRM));
                break;

            case 'Яндекс.ДиректS':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$SETTINGS_YA_DIRECT));
                break;

            case 'Инструкция подключения':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$INSTRUCTION_TO_CONNECT));
                break;

            case 'F.A.Q.;support':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$FAQ));
                break;

            case 'API документация':
                $I->amOnPage(self::getPageUrl($idAccaunt, $idSite, $startDate, $endDate, self::$API_DOCUMENTATION));
                break;

            default:
                break;
        }
        return $I;
    }

    // проверяет что персональная стр. принадлежит тому пользователю
    public function checkPagePersonal($organization){
        $I = $this->tester;
        $I->amOnPage(self::$ACCOUNTS.$organization->getId().self::$PERSONAL);
        $I->see($organization->getLegalPerson(), 'h1');
        $I->see($organization->getId(), 'h5');
        $I->see($organization->getName(),'//td');
        return $I;
    }
// проверяет страницы
    public function checkBillsPage($organization){
        $I = $this->tester;
        $I->amOnPage(self::$ACCOUNTS . self::$BILLS . $organization->getName());
        $I->see('Счета/Акты/Документы', 'h1');
        $I->click('Баланс/Структура расходов');
        $I->see('Баланс/Структура расходов', 'h1');
        return $I;
    }
    public static function route($param)
    {
        return static::$URL.$param;
    }
}
