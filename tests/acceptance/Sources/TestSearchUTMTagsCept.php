<?php
//@group searchUTMTags
$utmDataProvider =
    [
        /*
         * Positive tests
         */
        [
            'login'=>'admin',
            'accountId'=>7100,
            'siteId'=>6603,
            'beginDate'=>'2016-06-09',
            'endDate'=>'2016-06-09',
            'section'=>'UTM-метки',
            'utm_data'=>

            [
                [
                'begin_date'=>'2016-06-09',
                'end_date'=>'2016-06-09',
                'utm_filter'=>'UTM Campaign',
                'utm_campaign' => 'msk_studio_network,msk_remarketing_googl',
                'utm_medium'=>'cpc',//cpc
                'utm_source'=>'yandex,google',//yandex,google
                'utm_term'=>'квартира студия в москве,купить квартиру в москве',
                'utm_content'=>'kt_zastroy-2,tgb:0110',// kt_zastroy-2,tgb:0110
                'utm_position_type'=>'__any',//__any - означает [Пустое значение]
                'utm_data_to_check'=>
                    [
                        [
                            'num_of_results'=>0,

                        ],
                    ]
                ]
            ]
        ],
   ];
$I = new AcceptanceTester($scenario);

$I->wantTo('Хочу проверить поиск UTM меток');
$login = new \Page\AuthFunctional\AuthFunctional($I);
$utmPage = new \Page\Sources\UTMLabels($I);
$navigate = new \Page\Navigation\Navigation($I);

foreach ($utmDataProvider as $key){
    $login->login($I->getProperty($key['login']), $I->getProperty('psw'));
    $navigate->goToPage($key['accountId'], $key['siteId'], $key['beginDate'], $key['endDate'], $key['section']);
    $utmPage->testSearchByUtmValues($key['utm_data']);
    $login->logout();
}
