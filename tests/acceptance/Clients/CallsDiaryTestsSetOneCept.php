<?php 
//@group callSetOne

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
                        //negative
//            [
//            'source'=>'google,yandex,(direct)', 
//            'medium'=>'cpc,organic', 
//            'duration_low'=>'3000', 
//            'duration_up'=>'1500' 
//            ],
//            //positive
//            [
//            'source'=>'google,yandex', 
//            'medium'=>'cpc,organic', 
//            'duration_low'=>0, 
//            'duration_up'=>'50' 
//            ],
            //+
            [
            'source'=>'yandex', 
            'medium'=>'cpc', 
            'duration_low'=>'150', 
            'duration_up'=>'150',
            'num_of_calls'=>1,
            'calls' => 
                [
                    'call_id'=>'12713656',
                    'ani'=>79252115401,
                    'phone_number'=>74952418572
                ]
               
            ], 
//            [
//            'source'=>'(direct)', 
//            'medium'=>'cpc', 
//            'duration_low'=>'1500', 
//            'duration_up'=>'1500' 
//            ], 
//            [
//            'source'=>'google,yandex,(direct)', 
//            'medium'=>'cpc', 
//            'duration_low'=>'0', 
//            'duration_up'=>'0' 
//            ], 
//            [
//            'source'=>'google,yandex', 
//            'medium'=>'cpc', 
//            'duration_low'=>'3000', 
//            'duration_up'=>'3000' 
//            ], 
//            [
//            'source'=>'google', 
//            'medium'=>'organic', 
//            'duration_low'=>'150', 
//            'duration_up'=>'1500' 
//            ], 
//            [
//            'source'=>'yandex', 
//            'medium'=>'organic', 
//            'duration_low'=>'50', 
//            'duration_up'=>'0' 
//            ], 
//            [
//            'source'=>'(direct)', 
//            'medium'=>'organic', 
//            'duration_low'=>'0', 
//            'duration_up'=>'50' 
//            ], 
//            [
//            'source'=>'google,yandex,(direct)', 
//            'medium'=>'organic', 
//            'duration_low'=>'1500', 
//            'duration_up'=>'150' 
//            ], 
//            [
//            'source'=>'google,yandex', 
//            'medium'=>'organic', 
//            'duration_low'=>'50', 
//            'duration_up'=>'150' 
//            ], 
//            [
//            'source'=>'google', 
//            'medium'=>'referral', 
//            'duration_low'=>'1500', 
//            'duration_up'=>'0' 
//            ], 
//            [
//            'source'=>'yandex', 
//            'medium'=>'referral', 
//            'duration_low'=>'0', 
//            'duration_up'=>'1500' 
//            ], 
//            [
//            'source'=>'(direct)', 
//            'medium'=>'referral', 
//            'duration_low'=>'50', 
//            'duration_up'=>'3000' 
//            ], 
//            [
//            'source'=>'google,yandex,(direct)', 
//            'medium'=>'referral', 
//            'duration_low'=>'150', 
//            'duration_up'=>'50' 
//            ], 
//            [
//            'source'=>'google,yandex', 
//            'medium'=>'referral', 
//            'duration_low'=>'150', 
//            'duration_up'=>'0' 
//            ], 
//            [
//            'source'=>'google', 
//            'medium'=>'cpc,organic,refferal', 
//            'duration_low'=>'0', 
//            'duration_up'=>'150' 
//            ], 
//            [
//            'source'=>'yandex', 
//            'medium'=>'cpc,organic,refferal', 
//            'duration_low'=>'1500', 
//            'duration_up'=>'50' 
//            ], 
//            [
//            'source'=>'(direct)', 
//            'medium'=>'cpc,organic,refferal', 
//            'duration_low'=>'150', 
//            'duration_up'=>'0' 
//            ], 
//            [
//            'source'=>'google,yandex,(direct)', 
//            'medium'=>'cpc,organic,refferal', 
//            'duration_low'=>'50', 
//            'duration_up'=>'1500' 
//            ], 
//            [
//            'source'=>'google,yandex', 
//            'medium'=>'cpc,organic,refferal', 
//            'duration_low'=>'1500', 
//            'duration_up'=>'3000' 
//            ], 
//            [
//            'source'=>'google', 
//            'medium'=>'cpc,organic', 
//            'duration_low'=>'3000', 
//            'duration_up'=>'50' 
//            ], 
//            [
//            'source'=>'yandex', 
//            'medium'=>'cpc,organic', 
//            'duration_low'=>'150', 
//            'duration_up'=>'3000' 
//            ], 
//            [
//            'source'=>'(direct)', 
//            'medium'=>'cpc,organic', 
//            'duration_low'=>'0', 
//            'duration_up'=>'150' 
//            ], 
 
//            [
//            'source'=>'google', 
//            'medium'=>'cpc,refferal', 
//            'duration_low'=>'0', 
//            'duration_up'=>'3000' 
//            ], 
//            [
//            'source'=>'yandex', 
//            'medium'=>'cpc,refferal', 
//            'duration_low'=>'3000', 
//            'duration_up'=>'150' 
//            ], 
//            [
//            'source'=>'(direct)', 
//            'medium'=>'cpc,refferal', 
//            'duration_low'=>'3000', 
//            'duration_up'=>'0' 
//            ], 
//            [
//            'source'=>'google,yandex,(direct)', 
//            'medium'=>'cpc,refferal', 
//            'duration_low'=>'50', 
//            'duration_up'=>'50' 
//            ], 
//            [
//            'source'=>'google,yandex', 
//            'medium'=>'cpc,refferal', 
//            'duration_low'=>'150', 
//            'duration_up'=>'1500' 
//            ], 
//            [
//            'source'=>'google,yandex,(direct)', 
//            'medium'=>'organic', 
//            'duration_low'=>'3000', 
//            'duration_up'=>'3000' 
//            ], 
//            [
//            'source'=>'~google', 
//            'medium'=>'referral', 
//            'duration_low'=>'3000', 
//            'duration_up'=>'150' 
//            ], 
//            [
//            'source'=>'~google', 
//            'medium'=>'cpc,organic', 
//            'duration_low'=>'50', 
//            'duration_up'=>'0' 
//            ], 
//            [
//            'source'=>'~google', 
//            'medium'=>'cpc,organic,refferal', 
//            'duration_low'=>'3000', 
//            'duration_up'=>'1500' 
//            ], 
//            [
//            'source'=>'~yandex', 
//            'medium'=>'cpc,organic', 
//            'duration_low'=>'1500', 
//            'duration_up'=>'1500' 
//            ], 
//            [
//            'source'=>'~google', 
//            'medium'=>'cpc,refferal', 
//            'duration_low'=>'1500', 
//            'duration_up'=>'3000' 
//            ], 

            
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
