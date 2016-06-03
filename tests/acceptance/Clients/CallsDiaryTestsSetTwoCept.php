<?php

//@group setTwo
$callsDataProvider = [
  //skolkovskiy.ru
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
    ]
];

$I = new AcceptanceTester($scenario);
$I->wantTo('Проверить');

$login = new \Page\AuthFunctional\AuthFunctional($I);

$calls = new \Page\Clients\CallsDiary($I);
$login->login($I->getProperty('admin'),$I->getProperty('psw'));

$calls->testCallsDiarySetOne($callsDataProvider);

$login->logout();