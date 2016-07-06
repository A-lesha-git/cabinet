<?php
//@group sourcesUtmCalls
$dataProvider = [
    [
        'login'=>'admin',
        'accountId'=>5221,
        'siteId'=>4119,
        'beginDate'=>'2016-06-15',
        'endDate'=>'2016-06-21',
        'section'=>'UTM-метки',
        'sources_calls_utm_data'=>
        [
            [
                'begin_date'=>'2016-06-15',
                'end_date'=>'2016-06-21',
                'utm_filter'=>'UTM Medium',
                'utm_campaign' => '',
                'utm_medium'=>'',
                'utm_source'=>'',
                'utm_term'=>'',
                'utm_content'=>'',
                'utm_position_type'=>'',
                'calls'=>
                [
                    [
                       // 'utm_name'=>'cpc',
                        'num_of_calls'=>7,
                        'calls_id'=>'13934718,13982319,13991051,14029269,14040294,14042636,14046885',
                    ],



                ]

            ]
        ]
    ],
    [
        'login'=>'admin',
        'accountId'=>2852,
        'siteId'=>2621,
        'beginDate'=>'2016-06-21',
        'endDate'=>'2016-06-27',
        'section'=>'UTM-метки',
        'sources_calls_utm_data'=>

        [
            [
                'begin_date'=>'2016-06-21',
                'end_date'=>'2016-06-27',
                'utm_filter'=>'спецразмещение или гарантия',
                'utm_campaign' => 'pushkino_brand_search_15679669',
                'utm_medium'=>'cpc',
                'utm_source'=>'yandex',
                'utm_term'=>'новое пушкино, 1 комнатная квартира купить пушкино',
                'utm_content'=>'pushkino',
                'utm_position_type'=>'__any',
                'calls'=>
                [
                    [
                        'num_of_calls'=>6,
                        'calls_id'=>'14125507,14124161,14110169,14108675,14049185,14049120',
                    ],
                ]
            ]
        ]
    ],
    [
        'login'=>'welhome',
        'accountId'=>879,
        'siteId'=>1034,
        'beginDate'=>'2016-06-09',
        'endDate'=>'2016-06-09',
        'section'=>'UTM-метки',
        'sources_calls_utm_data'=>
        [
            [
                'begin_date'=>'2016-06-16',
                'end_date'=>'2016-06-16',
                'utm_filter'=>'UTM Content',
                'utm_campaign' => '',
                'utm_medium'=>'',
                'utm_source'=>'',
                'utm_term'=>'',
                'utm_content'=>'',
                'utm_position_type'=>'',
                'calls'=>
                [
                    [
                        'num_of_calls'=>2,
                        'calls_id'=>'13957861,13956198',
                    ],
                    [
                        'num_of_calls'=>2,
                        'calls_id'=>'13950010,13949290',
                    ],
                ]
            ]
        ]
    ]

];
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');

$login = new \Page\AuthFunctional\AuthFunctional($I);
$utmPage = new \Page\Sources\UTMLabels($I);
$navigate = new \Page\Navigation\Navigation($I);



foreach ($dataProvider as $key){
    $login->login($I->getProperty($key['login']), $I->getProperty('psw'));
    $navigate->goToPage($key['accountId'], $key['siteId'], $key['beginDate'], $key['endDate'], $key['section']);
    $utmPage->testSourcesUtmAndCalls($key['sources_calls_utm_data']);
    $login->logout();
}

