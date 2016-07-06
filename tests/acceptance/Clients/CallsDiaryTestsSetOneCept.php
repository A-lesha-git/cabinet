<?php
//@group Agroup1
//@group Bgroup1
//@group Cgroup1
//@group callSetOne
// значения которые может принимать ключ num_of_calls
//num_of_calls > 0 - кол-во звонков за период времени
//num_of_calls == 0 - ноль означает что звонков вообще не должно быть


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
            // фича, если выставить начало и конец слайдера(длительность) на 0 то слайдер сбрасывается 
//            [
//            'source'=>'google,yandex,(direct)', 
//            'medium'=>'cpc', 
//            'duration_low'=>'0', 
//            'duration_up'=>'0' 
//            ], 
                        [
            'source'=>'(direct)', 
            'medium'=>'referral', 
            'duration_low'=>'50', 
            'duration_up'=>'3000',
            'num_of_calls'=>0
            ], 
            [
            'source'=>'google,yandex,(direct)', 
            'medium'=>'cpc,organic', 
            'duration_low'=>'3000', 
            'duration_up'=>'1500',
            'num_of_calls'=>0,
            ],
            [
            'source'=>'google,yandex', 
            'medium'=>'cpc', 
            'duration_low'=>'3000', 
            'duration_up'=>'3000',
            'num_of_calls'=>0,
            ],         
            [
            'source'=>'(direct)', 
            'medium'=>'cpc', 
            'duration_low'=>'1500', 
            'duration_up'=>'1500',
            'num_of_calls'=>0,
            ], 
            [
            'source'=>'google', 
            'medium'=>'referral', 
            'duration_low'=>'1500', 
            'duration_up'=>'0',
            'num_of_calls'=>0
            ], 
            //positive
            [
            'source'=>'google,yandex', 
            'medium'=>'cpc,organic', 
            'duration_low'=>0, 
            'duration_up'=>'50',
            'num_of_calls'=>23,
            'calls' =>
                [
                    [
                    'call_id'=>'79169125050',
                    'ani'=>74996535814,
                    'phone_number'=>74952369216,
                    'date_call'=> '10.04.2016 12:19:45',
                    'call_duration'=>'00:00:17'
                    ],
                    [
                    'call_id'=>'12626589',
                    'ani'=>79619248114,
                    'phone_number'=>74952418572,
                    'date_call'=> '09.04.2016 09:50:05',
                    'call_duration'=>'00:00:29'
                    ],
                    [
                    'call_id'=>'12541558',
                    'ani'=>74952815088,
                    'phone_number'=>74953088160,
                    'date_call'=> '05.04.2016 14:55:23',
                    'call_duration'=>'00:00:09'
                    ],
                ]
            ],           
            [
            'source'=>'yandex', 
            'medium'=>'cpc', 
            'duration_low'=>'150', 
            'duration_up'=>'150',
            'num_of_calls'=>1,
            'calls' => 
                [
                    [
                    'call_id'=>'12713656',
                    'ani'=>79252115401,
                    'phone_number'=>74952418572,
                    'date_call'=> '13.04.2016 13:30:53',
                    'call_duration'=>'00:02:28',
                    'call_waiting' => '00:00:02'
                    ]
                ]
               
            ], 
            [
            'source'=>'google,yandex,(direct)', 
            'medium'=>'cpc,organic,refferal', 
            'duration_low'=>'50', 
            'duration_up'=>'1500',
            'num_of_calls'=>77,
            'calls' =>
                [
                    [
                    'call_id'=>'12709618',
                    'ani'=>79252792622,
                    'phone_number'=>74952418569,
                    'date_call'=> '13.04.2016 11:37:22',
                    'call_duration'=>'00:02:11',
                    'call_waiting' => '00:00:02'
                    ]
                ]
             
                
            ], 
            
        ]
    ],
      //rg_gorodkahovskaya   
    [
        
        'accountId'=>6416,
        'siteId'=>5732,
        'beginDate'=>'2016-05-25',
        'endDate'=>'2016-05-31',
        'section'=>'Журнал Звонков',
        'callsData'=>
        [
            //negative
            // если в фильтрах указано direct + referral, то кол-во звонков равно 0
            [
            'source'=>'(direct)', 
            'medium'=>'referral', 
            'duration_low'=>'0', 
            'duration_up'=>'1500',
            'num_of_calls'=>0,
            ],
            // если в фильтрах указано direct + cpc, то кол-во звонков равно 0
            [
            'source'=>'(direct)', 
            'medium'=>'cpc', 
            'duration_low'=>'0', 
            'duration_up'=>'1500',
            'num_of_calls'=>0,
            ], 
            [
            'source'=>'google', 
            'medium'=>'(none)', 
            'duration_low'=>'0', 
            'duration_up'=>'1500',
            'num_of_calls'=>0,
            ],
            [
            'source'=>'', 
            'medium'=>'Не определено', 
            'duration_low'=>'150', 
            'duration_up'=>'1500',
            'num_of_calls'=>0,
            ],
            
            //positive
            
            [
            'source'=>'Choister-звонки', 
            'medium'=>'', 
            'duration_low'=>'0', 
            'duration_up'=>'1500',
            'num_of_calls'=>1,
            ],
            [
            'source'=>'', 
            'medium'=>'', 
            'duration_low'=>'150', 
            'duration_up'=>'1500',
            'num_of_calls'=>104,
            ],

            
        ],
        
        //laserpribor.ru node 2
        [
        'accountId'=>8055,
        'siteId'=>7884,
        'beginDate'=>'2016-05-18',
        'endDate'=>'2016-06-21',
        'section'=>'Журнал Звонков',
        'callsData'=>
        [
            [
            'source'=>'tm.fru-it.ru', 
            'medium'=>'referral', 
            'duration_low'=>'0', 
            'duration_up'=>'150',
            'num_of_calls'=>1,
            ],
            [
            'source'=>'mastercity.ru', 
            'medium'=>'referral', 
            'duration_low'=>'0', 
            'duration_up'=>'3000',
            'num_of_calls'=>6,
            ],
        ]
    ]
        ]
            
    
];

$I = new AcceptanceTester($scenario);
$I->wantTo("Проверить что корректно выдаются звонки при применении фильтроф");

$login = new \Page\AuthFunctional\AuthFunctional($I);

$calls = new \Page\Clients\CallsDiary($I);
$login->login($I->getProperty('admin'),$I->getProperty('psw'));

$calls->testCallsDiarySetOne($callsDataProvider);

$login->logout();
