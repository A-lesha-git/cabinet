<?php 

$callsDataProvider = [
  //skolkovskiy.ru
    [        
        'accountId'=>4079,
        'siteId'=>3464,
        'beginDate'=>'2016-05-19',
        'endDate'=>'2016-04-26',
        'section'=>'Журнал Звонков',
        'calls'=>[
            [
                
            ],
        ]
        ],  
];

$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$login = new \Page\AuthFunctional\AuthFunctional($I);
$login->login($I->getProperty('admin'),$I->getProperty('psw'));

$calls = new \Page\Clients\CallsDiary($I);

$calls->testCallsDiaryFirstFormWithFilters($callsDataProvider);

$login->logout();

