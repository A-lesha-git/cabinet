<?php
//@group callManualy
$callsDataProvider = [
    
    [
        'accountId'=>77,
        'siteId'=>303,
        'beginDate'=>'2016-05-26',
        'endDate'=>'2016-05-28',
        'section'=>'Журнал Звонков',
        //проверка возможности вводить текст, выбирать опции в селектах, нажимать чекбоксы
        'callsData'=>[
            [
                'source'=>'google',
                'medium'=>'cpc',
                'where'=>'http://calltouch.ru/features?specific_id=3&client_id=1638617693.1464242748',
                'keyword'=>'moscow',
                'phone_number'=>'74957293370',
                'ani'=>'74952418571',
                'utm_source'=>'google',
                'utm_term'=>'сервис подмена номера',
                'utm_medium'=>'cpc',
                'utm_content'=>'kwd-64124853210',
                'utm_campaign' => 'brendovaya_regiony_poisk_g',
                'is_marked' => true,
                'is_target' => true,
                'is_target_uniq' => true,
                'with_comments' => true,
                'successful' => true,
                'no_successful' => true,
                'is_unique' => true,
                'is_repeated' => true,
                'with_orders' => true,
                'num_of_calls'=>0,
            ],
        ],
    ],
     [
        'accountId'=>77,
        'siteId'=>303,
        'beginDate'=>'2016-05-26',
        'endDate'=>'2016-05-28',
        'section'=>'Журнал Звонков',        
        'callsData'=>[
            [
                'is_target' => true,
                'num_of_calls' => 157,
            ]
        ],
    ],
    [
        'accountId'=>77,
        'siteId'=>303,
        'beginDate'=>'2016-04-16',
        'endDate'=>'2016-04-16',
        'section'=>'Журнал Звонков',      
        'callsData'=>[
            [
                'source'=>'yandex',
                'medium'=>'organic',
// в список подгружается только 5 первых значений, выбрать другие значения
// которые не попали в первые 5 нельзя  
//             'where'=>'www.calltouch.ru',
//             'keyword'=>'calltouch.ru',
                'phone_number'=>'74953088160',
                'ani'=>'79639664550',                
                'is_marked' => true,
                'num_of_calls'=>1,
            ]
        ],
    ],
    [
        'accountId'=>77,
        'siteId'=>303,
        'beginDate'=>'2016-05-18',
        'endDate'=>'2016-05-21',
        'section'=>'Журнал Звонков',
        'callsData'=>[
            [
                'utm_source'=>'yandex',
                'utm_medium'=>'cpc',
                'utm_term'=>'www calltouch ru',              
                // почему-то не отрабатывает-разобраться 'utm_campaign'=>'brendovaya_spb_poisk_ya',
                'num_of_calls'=>1,
            ]
        ],
    ],
 
    [
        'accountId'=>77,
        'siteId'=>303,
        'beginDate'=>'2016-04-16',
        'endDate'=>'2016-04-16',
        'section'=>'Журнал Звонков',
        //проверка возможности вводить текст, выбирать опции в селектах, нажимать чекбоксы
        'callsData'=>[
            [                
                'with_comments' => true,
                'num_of_calls'=>1,
            ]
        ],
    ],
    [
        'accountId'=>77,
        'siteId'=>303,
        'beginDate'=>'2016-05-04',
        'endDate'=>'2016-05-11',
        'section'=>'Журнал Звонков',
        'callsData'=>[
            [                
                'successful' => true,
                'no_successful' => true,
                'is_unique' => true,
                'num_of_calls'=>81,
            ]
        ],
    ],
    
];

$I = new AcceptanceTester($scenario);
$I->wantTo('Хочу протестировать ручной ввод данных в форму с фильтрами ');

$login = new \Page\AuthFunctional\AuthFunctional($I);
$login->login($I->getProperty('admin'),$I->getProperty('psw'));

$calls = new \Page\Clients\CallsDiary($I);
$calls->testCallsDiaryFormManualy($callsDataProvider);


$login->logout();