<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/4
 * Time: 11:01
 */
return [
    'sort'=>7,
    'title'=>'真人娱乐操作',
    'icon'=>'fa-street-view',
    'menus' => [
		// '体育注单'=>'#/live/pe',
        '查看真人注单'=>'#/live/order',
		// '电子游艺注单'=>'#/live/egame',
		// '真人实时金额'=>'#/live/order/moneyonly',
		'平台账号列表'=>'#/live/user',
		'所有转账记录'=>'#/live/log',
		'待审核的转账'=>'#/live/log&status=4',
		'未结算的转账'=>'#/live/log&status=0',
		'一键反水列表'=>'#/live/fs',
    ]
];