<?php 
//@group callOne

$callsDataProvider = [
    //calltouch.ru
    [
        
        'accountId'=>77,
        'siteId'=>303,
        'beginDate'=>'2016-04-05',
        'endDate'=>'2016-04-13',
        'section'=>'Журнал Звонков',
        'callsData'=>
        [
//            [
//            'source'=>'Callback', 
//            'medium'=>'cpc', 
//            'duration_low'=>'50', 
//            'duration_up'=>'50' 
//            ], 
            [
            'source'=>'yandex,google,Callback', 
            'medium'=>'cpc', 
            'duration_low'=>'50', 
            'duration_up'=>'50',
            'num_of_calls'=>100
            ], 
            
        ]
   ]
           
];

$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');

$login = new \Page\AuthFunctional\AuthFunctional($I);

$calls = new \Page\Clients\CallsDiary($I);
$login->login($I->getProperty('admin'),$I->getProperty('psw'));

$calls->testCallsDiarySetOne($callsDataProvider);

$login->logout();
