<?php
//彩票结果管理
return [
    'sort'=>4,
    'title'=>'彩票赔率管理',
    'icon'=>'fa-crosshairs',
    'menus'=> [
        // [
        //     '重庆时时彩<span style="padding-left: 1px;"></span>'=>'#/lotteryodds/cqssc/index',
        //     '重庆十分彩'=>'#/lotteryodds/cqsf/index',
        // ],
        // [
        //     '北京PK拾<div style="display:inline-block;width:10px;"></div>'=>'#/lotteryodds/pk10/index',
        //     '北京快乐8'=>'#/lotteryodds/kl8/index',
        // ],
        [
            '极速时时彩'=>'#/lotteryodds/tjssc/index',
            // '天津十分彩'=>'#/lotteryodds/tjsf/index',
        ],
        // [
        //     '广东11选5<div style="display:inline-block;width:3px;"></div>'=>'#/lotteryodds/gd11/index',
        //     '广东十分彩'=>'#/lotteryodds/gdsf/index',
        // ],
        // [
        //     '上海时时乐'=>'#/lotteryodds/shssl/index',
        //     '广西十分彩'=>'#/lotteryodds/gxsf/index',
        // ],
        // [
        //     '福彩3D<div style="display:inline-block;width:21px;"></div>'=>'#/lotteryodds/fc3d/index',
        //     '排列三'=>'#/lotteryodds/pl3/index',
        // ],
        [
            // '幸运飞艇<div style="display:inline-block;width:10px;"></div>'=>'#/lotteryodds/mlaft/index',
            '极速赛车'=>'#/lotteryodds/ssrc/index',
        ],
        [
            // '腾讯分分彩<div style="display:inline-block;width:10px;"></div>'=>'#/lotteryodds/ts5/index',
            '老PK拾'=>'#/lotteryodds/orpk/index',
        ],

        //  '时时彩程序设置'=>'#/lotteryodds/default/index',
         '彩票金额设置'=>'#/lotteryodds/default/money-set',
    ]
];
