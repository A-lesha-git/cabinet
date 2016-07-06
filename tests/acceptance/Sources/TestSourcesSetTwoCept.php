<?php
$dataProvider = [
    [
        'login'=>'admin',
        'accountId'=>5221,
        'siteId'=>4119,
        'beginDate'=>'2016-06-15',
        'endDate'=>'2016-06-21',
        'section'=>'Все источники',
        'sources_data'=>
        [
            [
                'begin_date'=>'2016-06-15',
                'end_date'=>'2016-06-21',
                'utm_filter'=>'UTM Medium',
                'utm_campaign' => '',
                'utm_medium'=>'',
                'utm_source'=>'',
                'utm_term'=>'',
                'utm_content'=>'',
                'utm_position_type'=>'',
                'calls'=>
                [
                    [


                    ],



                ]

            ]
        ]
    ],


];


$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
