<?php 
//@group utmDates
$utmDataProvider = 
[
    /*
     * Positive tests
     */
    [
    'login'=>'welhome',
    'accountId'=>879,
    'siteId'=>1034,
    'beginDate'=>'2016-06-09',
    'endDate'=>'2016-06-09',
    'section'=>'UTM-метки',
    'utm_data'=>
        [
            [
            'begin_date'=>'2016-05-09',
            'end_date'=>'2016-05-19',
            'utm_filter'=>'UTM Content',
    //        'utm_source'=>'',
    //        'utm_term'=>'',
    //        'utm_medium'=>'',
    //        'utm_content'=>'',
    //        'utm_campaign' => '',
             'utm_data_to_check'=>
                [
                    [                     
                        'num_of_results'=>18,

                    ],
                ]
            ],
            [
            'begin_date'=>'2016-05-20',
            'end_date'=>'2016-05-20',
            'utm_filter'=>'UTM Medium', 
             'utm_data_to_check'=>
                [
                    [                     
                        'num_of_results'=>0
                    ],
                ]
            ]
        ],
    
    ],
    [
        //fsk-lider.ru 
    'login'=>'fsk-lider',
    'accountId'=>7411,
    'siteId'=>7339,
    'beginDate'=>'2016-06-03',
    'endDate'=>'2016-06-09',
    'section'=>'UTM-метки',
    'utm_data'=>
        [
            [
            'begin_date'=>'2016-06-04',
            'end_date'=>'2016-06-06',
            'utm_filter'=>'UTM Campaign',
            'utm_data_to_check'=>
                [
                    [                     
                        'num_of_results'=>14
                    ],
                ]
            ],
            [
            'begin_date'=>'2016-05-20',
            'end_date'=>'2016-05-20',
            'utm_filter'=>'UTM Source',    
             'utm_data_to_check'=>
                [
                    [                     
                        'num_of_results'=>2
                    ],
                ]
            ]
        ],
    
    ],
       //uservice.kia.ru
    [
    'login'=>'uservice_kia',
    'accountId'=>8391,
    'siteId'=>8349,
    'beginDate'=>'2016-06-09',
    'endDate'=>'2016-06-09',
    'section'=>'UTM-метки',
    'utm_data'=>
        [
            [
            'begin_date'=>'now',
            'end_date'=>'now',
            'utm_filter'=>'UTM Source',
            'utm_data_to_check'=>
                [
                    [                     
                        'num_of_results'=>9999
                    ],
                ]
            ],

        ]
    ],
    
    /*
     * Negative tests
     */
    
   // dkolumb.ru
    [
    'login'=>'dkolumb',
    'accountId'=>7743,
    'siteId'=>7519,
    'beginDate'=>'2016-06-09',
    'endDate'=>'2016-06-09',
    'section'=>'UTM-метки',
    'utm_data'=>
        [
            [
            'begin_date'=>'2036-05-20',
            'end_date'=>'2038-05-25',
            'utm_data_to_check'=>
                [
                    [                     
                        'num_of_results'=> null
                    ],
                ]
            ],
            [
            'begin_date'=>'fasdf',
            'end_date'=>'456$#9LKF><!',
            'utm_data_to_check'=>
                [
                    [                     
                        'num_of_results'=> null
                    ],
                ]
            ],
        ]
    ],
];
$I = new AcceptanceTester($scenario);
$I->wantTo('Хочу протестировать поиск utm меток по датам. ');

$login = new \Page\AuthFunctional\AuthFunctional($I);
$utmPage = new \Page\Sources\UTMLabels($I);
$navigate = new \Page\Navigation\Navigation($I);

foreach ($utmDataProvider as $key){
    $login->login($I->getProperty($key['login']), $I->getProperty('psw'));
    $navigate->goToPage($key['accountId'], $key['siteId'], $key['beginDate'], $key['endDate'], $key['section']);
    $utmPage->testSearchUtmLabelsByDates($key['utm_data']);
    $login->logout();
}



