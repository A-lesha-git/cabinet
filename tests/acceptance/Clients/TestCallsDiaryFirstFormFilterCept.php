<?php 
//@group firstForm
$callsDataProvider = [
    //positive tests
  //skolkovskiy.ru
    [        
        'accountId'=>4079,
        'siteId'=>3464,
        'beginDate'=>'2016-05-19',
        'endDate'=>'2016-04-26',
        'section'=>'Журнал Звонков',
        'filterData'=>
        [
            [
                'startDate'=>'2016-04-13',
                'endDate'=>'2016-04-20',
                'segment'=>'Все сегменты',
                'numOfCalls'=>277
            ],
            [
                'startDate'=>'2016-03-17',
                'endDate'=>'2016-03-25',
                'segment'=>'Платный трафик',
                'numOfCalls'=>105
            ]
        ]
        ],
//krost.ru
        [        
        'accountId'=>3363,
        'siteId'=>2902,
        'beginDate'=>'2016-05-05',
        'endDate'=>'2016-05-07',
        'section'=>'Журнал Звонков',
        'filterData'=>[
            [
                'startDate'=>'2016-04-07',
                'endDate'=>'2016-04-10',
                'segment'=>'Рефералы',
                'numOfCalls'=>39
            ],
            [
                'startDate'=>'2016-03-23',
                'endDate'=>'2016-03-25',
                'segment'=>'NEVSKY',
                'numOfCalls'=>4
            ],
        ]
        ],    
        
    //sevgorod.ru
        [        
        'accountId'=>6627,
        'siteId'=>6390,
        'beginDate'=>'2016-05-05',
        'endDate'=>'2016-05-07',
        'section'=>'Журнал Звонков',
        'filterData'=>[
            [
                'startDate'=>'2016-05-15',
                'endDate'=>'2016-05-18',
                'segment'=>'Рефералы',
                'numOfCalls'=>1
            ],
            [
                'startDate'=>'2016-05-20',
                'endDate'=>'2016-05-25',
                'segment'=>'Весь платный трафик',
                'numOfCalls'=>14
            ],
        ]
        ],
    // negative tests
     [        
        'accountId'=>5014,
        'siteId'=>8215,
        'beginDate'=>'2016-05-05',
        'endDate'=>'2016-05-07',
        'section'=>'Журнал Звонков',
        'filterData'=>[
            [
                'startDate'=>'2016-05-05',
                'endDate'=>'2016-05-07',
                'segment'=>'Рефералы',
                'numOfCalls'=>0
            ],
        ]
        ],
        //alexfitness.ru
        [        
        'accountId'=>6134,
        'siteId'=>8252,
        'beginDate'=>'2016-05-20',
        'endDate'=>'2016-05-26',
        'section'=>'Журнал Звонков',
        'filterData'=>[
            [
                'startDate'=>'gsdf',
                'endDate'=>'2dfg07',
                'segment'=>'Все сегменты',
                'numOfCalls'=>9999
            ],
            [
                'startDate'=>'-1',
                'endDate'=>'12232345345',
                'segment'=>'Все сегменты',
                'numOfCalls'=>9999
            ],
        ]
        ],


];

$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$login = new \Page\AuthFunctional\AuthFunctional($I);
$login->login($I->getProperty('admin'),$I->getProperty('psw'));

$calls = new \Page\Clients\CallsDiary($I);

$calls->testCallsDiaryFirstFormFilter($callsDataProvider);

$login->logout();