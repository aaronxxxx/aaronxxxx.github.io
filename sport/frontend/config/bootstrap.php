<?php
Yii::setAlias('cacheroot', 'http://182.16.24.26:81');

// 一级模块
Yii::setAlias('game', dirname(__DIR__) . '/modules/game');
Yii::setAlias('live', dirname(__DIR__) . '/modules/live');
Yii::setAlias('lottery', dirname(__DIR__) . '/modules/lottery');
Yii::setAlias('member', dirname(__DIR__) . '/modules/general/member');
Yii::setAlias('mobile', dirname(__DIR__) . '/modules/general/mobile');
Yii::setAlias('six', dirname(__DIR__) . '/modules/six');
Yii::setAlias('spsix', dirname(__DIR__) . '/modules/spsix');
Yii::setAlias('sport', dirname(__DIR__) . '/modules/sport');

// 二级模块 lottery
Yii::setAlias('cqsf', dirname(__DIR__) . '/modules/lottery/modules/cqsf');
Yii::setAlias('cqssc', dirname(__DIR__) . '/modules/lottery/modules/cqssc');
Yii::setAlias('fc3d', dirname(__DIR__) . '/modules/lottery/modules/fc3d');
Yii::setAlias('gd11', dirname(__DIR__) . '/modules/lottery/modules/gd11');
Yii::setAlias('gdsf', dirname(__DIR__) . '/modules/lottery/modules/gdsf');
Yii::setAlias('gxsf', dirname(__DIR__) . '/modules/lottery/modules/gxsf');
Yii::setAlias('jxssc', dirname(__DIR__) . '/modules/lottery/modules/jxssc');
Yii::setAlias('kl8', dirname(__DIR__) . '/modules/lottery/modules/kl8');
Yii::setAlias('pk10', dirname(__DIR__) . '/modules/lottery/modules/pk10');
Yii::setAlias('pl3', dirname(__DIR__) . '/modules/lottery/modules/pl3');
Yii::setAlias('shssl', dirname(__DIR__) . '/modules/lottery/modules/shssl');
Yii::setAlias('tjsf', dirname(__DIR__) . '/modules/lottery/modules/tjsf');
Yii::setAlias('tjssc', dirname(__DIR__) . '/modules/lottery/modules/tjssc');
//设置保存文件根目录
Yii::setAlias('resource', dirname(__DIR__) . '/resource');