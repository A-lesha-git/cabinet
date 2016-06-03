<?php
//@group callManualy
$callsDataProvider = [
    //skolkovskiy.ru
    [
        'accountId'=>77,
        'siteId'=>303,
        'beginDate'=>'2016-05-26',
        'endDate'=>'2016-05-28',
        'section'=>'Журнал Звонков',
        'callsData'=>[
            [
                'source'=>'google',
                'medium'=>'cpc',
                'where'=>'http://calltouch.ru/features?specific_id=3&client_id=1638617693.1464242748',
                'keyword'=>'moscow',
                'phone_number'=>'74957293370',
                'ani'=>'74952418571',
                'utm_source'=>'google',
                //'utm_term'=>'0',
                'utm_medium'=>'cpc',
                'utm_content'=>'kwd-64124853210',
                'utm_campaign'=>'brendovaya_regiony_poisk_g',
                'num_of_calls'=>11,
            ]
        ],
    ]
];

$I = new AcceptanceTester($scenario);
$I->wantTo('Хочу протестировать ручной ввод данных в форму с фильтрами ');

$login = new \Page\AuthFunctional\AuthFunctional($I);
$login->login($I->getProperty('admin'),$I->getProperty('psw'));

$calls = new \Page\Clients\CallsDiary($I);
$calls->testCallsDiaryFormManualy($callsDataProvider);


$login->logout();