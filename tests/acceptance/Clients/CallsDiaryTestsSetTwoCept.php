<?php

//@group setTwo
$callsDataProvider = [
  //pik.ru
    [        
        'accountId'=>5304,
        'siteId'=>4218,
        'beginDate'=>'2016-05-26',
        'endDate'=>'2016-05-28',
        'section'=>'Журнал Звонков',
        'callsData'=>[
            [
            'utm_source'=>'yandex.direct',
            'utm_term'=>'пик',
            'utm_medium'=>'cpc',
            'utm_content'=>'brand',
            'utm_campaign'=>'pik',
            'duration_low'=>'0',
            'duration_up'=>'1500',
            'num_of_calls'=>18,
            ]
        ],
    ],
    //gk-mic.ru 
        [        
        'accountId'=>6123,
        'siteId'=>5393,
        'beginDate'=>'016-05-31',
        'endDate'=>'2016-06-03',
        'section'=>'Журнал Звонков',
        'callsData'=>[
            [
            'utm_source'=>'yandex.direct',
            'utm_term'=>'купить квартиру в рассрочку',
            'utm_medium'=>'cpc',
            'utm_content'=>'brand',
            'utm_campaign'=>'pik',
            'duration_low'=>'0',
            'duration_up'=>'1500',
            'num_of_calls'=>0
            ],
            [
            'utm_source'=>'google',
            'utm_term'=>'застройщик миц',
            'utm_medium'=>'cpc',
            'duration_low'=>'50',
            'duration_up'=>'3000',
            'num_of_calls'=>2
            ],
                        [
            'utm_source'=>'youtube',
            'utm_medium'=>'cpc',
            'utm_campaign'=>'16years',
            'duration_low'=>'0',
            'duration_up'=>'3000',
            'num_of_calls'=>7
            ],
        ],
    ],
    [        
        'accountId'=>3390,
        'siteId'=>3087,
        'beginDate'=>'2016-05-31',
        'endDate'=>'2016-06-06',
        'section'=>'Журнал Звонков',
        'callsData'=>[
            [
            'utm_source'=>'google',
            'utm_term'=>'оценщик бизнеса',
            'utm_medium'=>'cpc',
            'utm_content'=>'93176028131',
            'utm_campaign'=>'rk_biznesa_i_akcij_msk_mo',
            'duration_low'=>'0',
            'duration_up'=>'1500',
            'num_of_calls'=>1,
            ]
        ],
    ],
];

$I = new AcceptanceTester($scenario);
$I->wantTo('Проверить');

$login = new \Page\AuthFunctional\AuthFunctional($I);

$calls = new \Page\Clients\CallsDiary($I);
$login->login($I->getProperty('admin'),$I->getProperty('psw'));

$calls->testCallsDiarySetOne($callsDataProvider);

$login->logout();