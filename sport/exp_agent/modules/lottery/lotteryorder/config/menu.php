<?php
//彩票结果管理
return [
    'sort'=>2,
    'title'=>'彩票注单管理',
    'icon'=>'fa-dashboard',
    'menus'=> [
        [
            '重庆时时彩<span style="padding-left: 1px;"></span>'=>'#/lotteryorder/index&type=CQ&js=0,1,2,3&p=1',
            '重庆十分彩'=>'#/lotteryorder/index&type=CQSF&js=0,1,2,3&p=1',
        ],
        [
            '北京PK拾<div style="display:inline-block;width:10px;"></div>'=>'#/lotteryorder/index&type=BJPK&js=0,1,2,3&p=1',
            '北京快乐8'=>'#/lotteryorder/index&type=BJKN&js=0,1,2,3&p=1',
        ],
        [
            '极速时时彩'=>'#/lotteryorder/index&type=TJ&js=0,1,2,3&p=1',
            '天津十分彩'=>'#/lotteryorder/index&type=TJSF&js=0,1,2,3&p=1',
        ],
        [
            '广东11选5<div style="display:inline-block;width:3px;"></div>'=>'#/lotteryorder/index&type=GD11&js=0,1,2,3&p=1',
            '广东十分彩'=>'#/lotteryorder/index&type=GDSF&js=0,1,2,3&p=1',
        ],
        [
            '上海时时乐'=>'#/lotteryorder/index&type=T3&js=0,1,2,3&p=1',
            '广西十分彩'=>'#/lotteryorder/index&type=GXSF&js=0,1,2,3&p=1',
        ],
        [
            '福彩3D<div style="display:inline-block;width:21px;"></div>'=>'#/lotteryorder/index&type=D3&js=0,1,2,3&p=1',
            '排列三'=>'#/lotteryorder/index&type=P3&js=0,1,2,3&p=1',
        ],
         '全部彩票注单'=>'#/lotteryorder/index&type=ALL_LOTTERY&js=0,1,2,3&p=1',
         '未结算彩票注单'=>'#/lotteryorder/index&type=ALL_LOTTERY&js=0&p=1',
         '重新结算过的彩票注单'=>'#/lotteryorder/index&type=ALL_LOTTERY&js=2&p=1',
         '按用户分类的彩票注单'=>'#/lotteryorder/index/lotteryuser&type=ALL_LOTTERY&js=0,1,2,3',
    ]
];
