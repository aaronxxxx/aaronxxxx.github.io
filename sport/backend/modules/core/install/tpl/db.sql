/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : new

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-11-25 14:14:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `agents_group`
-- ----------------------------
DROP TABLE IF EXISTS `agents_group`;
CREATE TABLE `agents_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT 'null' COMMENT '代理组名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of agents_group
-- ----------------------------
INSERT INTO `agents_group` VALUES ('1', 'null');

-- ----------------------------
-- Table structure for `agents_list`
-- ----------------------------
DROP TABLE IF EXISTS `agents_list`;
CREATE TABLE `agents_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agents_name` varchar(16) CHARACTER SET gbk NOT NULL COMMENT '用户名',
  `agents_pass` varchar(32) CHARACTER SET gbk NOT NULL COMMENT '用户密码',
  `real_name` varchar(255) DEFAULT NULL,
  `loginip` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT 'null' COMMENT '登陆IP',
  `logintime` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '登陆时间',
  `regtime` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '注册时间',
  `online` varchar(3) CHARACTER SET gbk NOT NULL DEFAULT '0' COMMENT '是否在线  1在线，0不在线',
  `lognum` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `status` varchar(4) CHARACTER SET gbk NOT NULL DEFAULT '正常' COMMENT '会员状态,0未审核，1正常，2异常，3停用',
  `birthday` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '生日',
  `tel` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT 'null' COMMENT '电话',
  `email` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT 'null' COMMENT '会员邮箱',
  `qq` int(12) NOT NULL DEFAULT '10000' COMMENT '会员QQ',
  `othercon` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT 'null' COMMENT '其他联系信息',
  `remark` text CHARACTER SET gbk NOT NULL COMMENT '备注信息',
  `agents_type` varchar(10) CHARACTER SET gbk NOT NULL DEFAULT '赢利分成' COMMENT '理代类型：流水分成，赢利分成',
  `total_1_1` decimal(11,0) NOT NULL DEFAULT '0' COMMENT '水流或赢利量等级1',
  `total_1_2` decimal(11,0) NOT NULL DEFAULT '10000',
  `total_2_1` decimal(11,0) NOT NULL DEFAULT '10001' COMMENT '水流或赢利量等级2',
  `total_2_2` decimal(11,0) NOT NULL DEFAULT '50000' COMMENT '水流或赢利量等级1',
  `total_3_1` decimal(11,0) NOT NULL DEFAULT '50001',
  `total_3_2` decimal(11,0) NOT NULL DEFAULT '100000',
  `total_4_1` decimal(11,0) NOT NULL DEFAULT '100001',
  `total_4_2` decimal(11,0) NOT NULL DEFAULT '200000',
  `total_5_1` decimal(11,0) NOT NULL DEFAULT '200001',
  `total_5_2` decimal(11,0) NOT NULL DEFAULT '500000',
  `total_1_scale` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '水流或赢利量等级1的 比例 百分比',
  `total_2_scale` decimal(10,3) NOT NULL DEFAULT '0.000',
  `total_3_scale` decimal(10,3) NOT NULL DEFAULT '0.000',
  `total_4_scale` decimal(10,3) NOT NULL DEFAULT '0.000',
  `total_5_scale` decimal(10,3) NOT NULL DEFAULT '0.000',
  `settlement` varchar(10) CHARACTER SET gbk NOT NULL DEFAULT '月结' COMMENT '结算方式:月结，半月结，周结',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of agents_list
-- ----------------------------

-- ----------------------------
-- Table structure for `agents_money_log`
-- ----------------------------
DROP TABLE IF EXISTS `agents_money_log`;
CREATE TABLE `agents_money_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agents_id` int(11) NOT NULL COMMENT '代理ID',
  `money` decimal(11,2) DEFAULT '0.00' COMMENT '算结金额',
  `s_time` date DEFAULT NULL COMMENT '结算开始日期',
  `e_time` date DEFAULT NULL COMMENT '结算结束日期',
  `do_time` datetime DEFAULT NULL COMMENT '操作时间',
  `ledger` decimal(11,2) DEFAULT NULL COMMENT '流水总额',
  `profig` decimal(11,2) DEFAULT NULL COMMENT '盈利总额',
  `ratio` int(11) DEFAULT '0' COMMENT '成分比例1=1%',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of agents_money_log
-- ----------------------------

-- ----------------------------
-- Table structure for `baseball_match`
-- ----------------------------
DROP TABLE IF EXISTS `baseball_match`;
CREATE TABLE `baseball_match` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Match_ID` varchar(50) NOT NULL,
  `Match_Date` varchar(20) DEFAULT NULL,
  `Match_Time` varchar(20) DEFAULT NULL,
  `Match_Name` varchar(250) NOT NULL,
  `Match_Master` varchar(250) NOT NULL,
  `Match_Guest` varchar(250) NOT NULL,
  `Match_IsLose` varchar(2) DEFAULT NULL,
  `Match_Type` tinyint(3) unsigned DEFAULT NULL,
  `Match_Ho` double DEFAULT NULL,
  `Match_Ao` double DEFAULT NULL,
  `Match_RGG` varchar(15) DEFAULT NULL,
  `Match_BzM` double DEFAULT NULL,
  `Match_BzG` double DEFAULT NULL,
  `Match_BzH` double DEFAULT NULL,
  `Match_DxGG` varchar(15) DEFAULT NULL,
  `Match_Dxdpl` double DEFAULT NULL,
  `Match_Dxxpl` double DEFAULT NULL,
  `Match_Dsdpl` double DEFAULT NULL,
  `Match_Dsspl` double DEFAULT NULL,
  `Match_Score` varchar(10) DEFAULT NULL,
  `Match_JS` tinyint(3) unsigned DEFAULT '0',
  `Match_AddDate` datetime DEFAULT NULL,
  `Match_CoverDate` datetime DEFAULT NULL,
  `Match_Allow` tinyint(3) unsigned DEFAULT '0',
  `Match_IsShow` tinyint(3) unsigned DEFAULT '1',
  `Match_MasterID` varchar(15) DEFAULT NULL,
  `Match_GuestID` varchar(15) DEFAULT NULL,
  `Match_StopUpdate` tinyint(3) unsigned DEFAULT '0',
  `MB_Inball` varchar(5) DEFAULT NULL,
  `TG_Inball` varchar(5) DEFAULT NULL,
  `MB_Inball_HR` varchar(5) DEFAULT NULL,
  `TG_Inball_HR` varchar(5) DEFAULT NULL,
  `scorecheck` tinyint(4) DEFAULT NULL,
  `Match_halfScore` varchar(10) DEFAULT NULL,
  `Match_MatchTime` varchar(30) DEFAULT NULL,
  `Match_ShowType` varchar(2) DEFAULT 'H',
  `score_time` datetime DEFAULT NULL,
  `remark` varchar(100) DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `Match_ID` (`Match_ID`),
  KEY `Match_Date` (`Match_Date`),
  KEY `Match_Type` (`Match_Type`),
  KEY `Match_CoverDate` (`Match_CoverDate`),
  KEY `Match_Name` (`Match_Name`),
  KEY `Match_BzM` (`Match_BzM`),
  KEY `Match_StopUpdate` (`Match_StopUpdate`)
) ENGINE=MyISAM AUTO_INCREMENT=3357 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baseball_match
-- ----------------------------

-- ----------------------------
-- Table structure for `bet_match`
-- ----------------------------
DROP TABLE IF EXISTS `bet_match`;
CREATE TABLE `bet_match` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Match_ID` varchar(50) NOT NULL,
  `Match_HalfId` varchar(50) DEFAULT NULL,
  `Match_Date` varchar(20) DEFAULT NULL,
  `Match_Time` varchar(20) DEFAULT NULL,
  `Match_Name` varchar(50) NOT NULL,
  `Match_Master` varchar(50) NOT NULL,
  `Match_Guest` varchar(50) NOT NULL,
  `Match_IsLose` varchar(4) DEFAULT NULL,
  `Match_State` varchar(7) DEFAULT NULL,
  `Match_Type` tinyint(3) unsigned DEFAULT '1' COMMENT '1日今，0早餐',
  `Match_ShowType` varchar(1) DEFAULT NULL,
  `Match_Ho` double DEFAULT NULL,
  `Match_Ao` double DEFAULT NULL,
  `Match_RGG` varchar(15) DEFAULT NULL,
  `Match_BzM` double DEFAULT NULL,
  `Match_BzG` double DEFAULT NULL,
  `Match_BzH` double DEFAULT NULL,
  `Match_DxGG` varchar(15) DEFAULT NULL,
  `Match_DxDpl` double DEFAULT NULL,
  `Match_DxXpl` double DEFAULT NULL,
  `Match_DsDpl` double DEFAULT NULL,
  `Match_DsSpl` double DEFAULT NULL,
  `Match_BHo` double DEFAULT NULL,
  `Match_BAo` double DEFAULT NULL,
  `Match_Bdpl` double DEFAULT NULL,
  `Match_Bxpl` double DEFAULT NULL,
  `Match_Bmdy` double DEFAULT NULL,
  `Match_Bgdy` double DEFAULT NULL,
  `Match_Bhdy` double DEFAULT NULL,
  `Match_Hr_ShowType` varchar(1) DEFAULT NULL,
  `Match_BRpk` varchar(15) DEFAULT NULL,
  `Match_Bdxpk` varchar(15) DEFAULT NULL,
  `Match_Total01Pl` double DEFAULT NULL,
  `Match_Total23Pl` double DEFAULT NULL,
  `Match_Total46Pl` double DEFAULT NULL,
  `Match_Total7upPl` double DEFAULT NULL,
  `Match_BqMM` double DEFAULT NULL,
  `Match_BqMH` double DEFAULT NULL,
  `Match_BqMG` double DEFAULT NULL,
  `Match_BqHM` double DEFAULT NULL,
  `Match_BqHH` double DEFAULT NULL,
  `Match_BqHG` double DEFAULT NULL,
  `Match_BqGM` double DEFAULT NULL,
  `Match_BqGH` double DEFAULT NULL,
  `Match_BqGG` double DEFAULT NULL,
  `Match_Bd10` double DEFAULT NULL,
  `Match_Bd20` double DEFAULT NULL,
  `Match_Bd21` double DEFAULT NULL,
  `Match_Bd30` double DEFAULT NULL,
  `Match_Bd31` double DEFAULT NULL,
  `Match_Bd32` double DEFAULT NULL,
  `Match_Bd40` double DEFAULT NULL,
  `Match_Bd41` double DEFAULT NULL,
  `Match_Bd42` double DEFAULT NULL,
  `Match_Bd43` double DEFAULT NULL,
  `Match_Bd00` double DEFAULT NULL,
  `Match_Bd11` double DEFAULT NULL,
  `Match_Bd22` double DEFAULT NULL,
  `Match_Bd33` double DEFAULT NULL,
  `Match_Bd44` double DEFAULT NULL,
  `Match_Bdup5` double DEFAULT NULL,
  `Match_upScore` varchar(10) DEFAULT NULL,
  `Match_NowScore` varchar(10) DEFAULT NULL,
  `Match_OverScore` varchar(10) DEFAULT NULL,
  `Match_JS` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowds` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowb` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowg` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowt` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowbq` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowbd` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowh` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowzc` tinyint(3) unsigned DEFAULT '0',
  `Match_AddDate` datetime DEFAULT NULL,
  `Match_CoverDate` datetime DEFAULT NULL,
  `Match_IsShowds` tinyint(3) unsigned DEFAULT '1',
  `Match_IsShowb` tinyint(3) unsigned DEFAULT '1',
  `Match_IsShowg` tinyint(3) unsigned DEFAULT '1',
  `Match_IsShowt` tinyint(3) unsigned DEFAULT '1',
  `Match_IsShowbq` tinyint(3) unsigned DEFAULT '1',
  `Match_IsShowbd` tinyint(3) unsigned DEFAULT '1',
  `Match_IsShowh` tinyint(3) unsigned DEFAULT '1',
  `Match_IsShowzc` tinyint(3) unsigned DEFAULT '1',
  `Match_MasterID` varchar(15) DEFAULT NULL,
  `Match_GuestID` varchar(15) DEFAULT NULL,
  `Match_StopUpdateds` tinyint(3) unsigned DEFAULT '0',
  `Match_StopUpdateb` tinyint(3) unsigned DEFAULT '0',
  `Match_StopUpdateg` tinyint(3) unsigned DEFAULT '0',
  `Match_StopUpdatet` tinyint(3) unsigned DEFAULT '0',
  `Match_StopUpdatebq` tinyint(3) unsigned DEFAULT '0',
  `Match_StopUpdatebd` tinyint(3) unsigned DEFAULT '0',
  `Match_StopUpdateh` tinyint(3) unsigned DEFAULT '0',
  `Match_StopUpdatezc` tinyint(3) unsigned DEFAULT '0',
  `Match_Bdg10` double DEFAULT NULL,
  `Match_Bdg20` double DEFAULT NULL,
  `Match_Bdg21` double DEFAULT NULL,
  `Match_Bdg30` double DEFAULT NULL,
  `Match_Bdg31` double DEFAULT NULL,
  `Match_Bdg32` double DEFAULT NULL,
  `Match_Bdg40` double DEFAULT NULL,
  `Match_Bdg41` double DEFAULT NULL,
  `Match_Bdg42` double DEFAULT NULL,
  `Match_Bdg43` double DEFAULT NULL,
  `Match_Bdgup5` double DEFAULT NULL,
  `Match_Hr_BqMM` double DEFAULT NULL,
  `Match_Hr_BqMH` double DEFAULT NULL,
  `Match_Hr_BqMG` double DEFAULT NULL,
  `Match_Hr_BqHM` double DEFAULT NULL,
  `Match_Hr_BqHH` double DEFAULT NULL,
  `Match_Hr_BqHG` double DEFAULT NULL,
  `Match_Hr_BqGM` double DEFAULT NULL,
  `Match_Hr_BqGH` double DEFAULT NULL,
  `Match_Hr_BqGG` double DEFAULT NULL,
  `Match_Hr_Bd10` double DEFAULT NULL,
  `Match_Hr_Bd20` double DEFAULT NULL,
  `Match_Hr_Bd21` double DEFAULT NULL,
  `Match_Hr_Bd30` double DEFAULT NULL,
  `Match_Hr_Bd31` double DEFAULT NULL,
  `Match_Hr_Bd32` double DEFAULT NULL,
  `Match_Hr_Bd40` double DEFAULT NULL,
  `Match_Hr_Bd41` double DEFAULT NULL,
  `Match_Hr_Bd42` double DEFAULT NULL,
  `Match_Hr_Bd43` double DEFAULT NULL,
  `Match_Hr_Bd00` double DEFAULT NULL,
  `Match_Hr_Bd11` double DEFAULT NULL,
  `Match_Hr_Bd22` double DEFAULT NULL,
  `Match_Hr_Bd33` double DEFAULT NULL,
  `Match_Hr_Bd44` double DEFAULT NULL,
  `Match_Hr_Bdup5` double DEFAULT NULL,
  `Match_Hr_Bdg10` double DEFAULT NULL,
  `Match_Hr_Bdg20` double DEFAULT NULL,
  `Match_Hr_Bdg21` double DEFAULT NULL,
  `Match_Hr_Bdg30` double DEFAULT NULL,
  `Match_Hr_Bdg31` double DEFAULT NULL,
  `Match_Hr_Bdg32` double DEFAULT NULL,
  `Match_Hr_Bdg40` double DEFAULT NULL,
  `Match_Hr_Bdg41` double DEFAULT NULL,
  `Match_Hr_Bdg42` double DEFAULT NULL,
  `Match_Hr_Bdg43` double DEFAULT NULL,
  `Match_Hr_Bdgup5` double DEFAULT NULL,
  `Match_TypePlay` varchar(5) DEFAULT NULL,
  `Match_Allowbz` tinyint(3) unsigned DEFAULT '0',
  `Match_IsShowbz` tinyint(3) unsigned DEFAULT '1',
  `Match_StopUpdatebz` tinyint(3) unsigned DEFAULT NULL,
  `Match_Allowrq` tinyint(3) unsigned DEFAULT '0',
  `Match_IsShowrq` tinyint(3) unsigned DEFAULT '1',
  `Match_StopUpdaterq` tinyint(3) unsigned DEFAULT '0',
  `Match_AddRoll` tinyint(3) unsigned DEFAULT '0',
  `Match_MatchTime` varchar(30) DEFAULT NULL,
  `Match_HRedCard` tinyint(3) unsigned DEFAULT '0',
  `Match_GRedCard` tinyint(3) unsigned DEFAULT '0',
  `MB_Inball` int(11) DEFAULT NULL,
  `TG_Inball` int(11) DEFAULT NULL,
  `MB_Inball_HR` int(11) DEFAULT NULL,
  `TG_Inball_HR` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `ScoreCheck` int(11) DEFAULT '0',
  `Match_LstTime` datetime DEFAULT NULL,
  `iPage` int(11) DEFAULT NULL,
  `iSn` int(11) DEFAULT NULL,
  `Match_SBJS` int(1) unsigned NOT NULL DEFAULT '0',
  `score_time` datetime DEFAULT NULL,
  `remark` varchar(100) DEFAULT '',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Match_ID` (`Match_ID`),
  KEY `IX_Bet_Match` (`Match_ID`,`Match_Type`),
  KEY `Match_HalfId` (`Match_HalfId`),
  KEY `Match_Date` (`Match_Date`),
  KEY `Match_CoverDate` (`Match_CoverDate`),
  KEY `Match_BqMM` (`Match_BqMM`),
  KEY `Match_Name` (`Match_Name`),
  KEY `Match_Type` (`Match_Type`),
  KEY `Match_IsShowbd` (`Match_IsShowbd`),
  KEY `Match_Bd21` (`Match_Bd21`),
  KEY `Match_IsShowt` (`Match_IsShowt`),
  KEY `Match_Total01Pl` (`Match_Total01Pl`),
  KEY `Match_Hr_Bd10` (`Match_Hr_Bd10`),
  KEY `Match_IsShowb` (`Match_IsShowb`),
  KEY `Match_StopUpdatebd` (`Match_StopUpdatebd`),
  KEY `Match_StopUpdatebq` (`Match_StopUpdatebq`),
  KEY `Match_StopUpdateds` (`Match_StopUpdateds`),
  KEY `Match_StopUpdatezc` (`Match_StopUpdatezc`),
  KEY `Match_StopUpdateg` (`Match_StopUpdateg`),
  KEY `Match_StopUpdatet` (`Match_StopUpdatet`),
  KEY `Match_StopUpdateb` (`Match_StopUpdateb`),
  KEY `Match_JS` (`Match_JS`),
  KEY `Match_SBJS` (`Match_SBJS`)
) ENGINE=MyISAM AUTO_INCREMENT=97415 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bet_match
-- ----------------------------

-- ----------------------------
-- Table structure for `config_p`
-- ----------------------------
DROP TABLE IF EXISTS `config_p`;
CREATE TABLE `config_p` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter_type` varchar(50) NOT NULL COMMENT '参数类型',
  `parameter_key` varchar(50) CHARACTER SET gbk NOT NULL COMMENT '参数键',
  `parameter_value` varchar(255) CHARACTER SET gbk NOT NULL COMMENT '参数值',
  `parameter_remark` varchar(255) CHARACTER SET gbk DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config_p
-- ----------------------------
INSERT INTO `config_p` VALUES ('14', 'SYS', 'REGSTER_ENABLE', 'on', '');
INSERT INTO `config_p` VALUES ('15', 'SYS', 'REGSTER_FROM', '新葡京娱乐城', null);
INSERT INTO `config_p` VALUES ('13', 'SYS', 'REGSTER_CONTENT', '欢迎光临新葡京娱乐场，请记好永久域名：www.lpj168.com以便下次访问！！！', '');
INSERT INTO `config_p` VALUES ('12', 'SYS', 'REGSTER_TITLE', '欢迎光临!', '');
INSERT INTO `config_p` VALUES ('11', 'SYS', 'TYC_ENABLE', 'enable_true', 'enable_false 是禁用,enable_true 是启用');

-- ----------------------------
-- Table structure for `game_type`
-- ----------------------------
DROP TABLE IF EXISTS `game_type`;
CREATE TABLE `game_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `skey` varchar(255) DEFAULT NULL,
  `en_name` varchar(255) DEFAULT NULL COMMENT '英文名',
  `cn_name1` varchar(255) DEFAULT NULL COMMENT '中文名1',
  `cn_name2` varchar(255) DEFAULT NULL COMMENT '中文名2',
  `type` varchar(255) DEFAULT NULL COMMENT '游戏代号',
  `url` varchar(255) DEFAULT NULL COMMENT '图片路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=445 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of game_type
-- ----------------------------
INSERT INTO `game_type` VALUES ('1', '﻿breakaway', '﻿BreakAway', '冰上曲棍球', '冰上曲棍球', 'breakaway', 'nmge/BreakAway.jpg');
INSERT INTO `game_type` VALUES ('2', 'reelgems', 'ReelGems', '宝石之轮', '寶石之輪', 'reelgems', 'nmge/ReelGems_250x250.png');
INSERT INTO `game_type` VALUES ('3', 'carnaval', 'Carnaval', '狂欢节', '狂歡節', 'Carnaval', 'nmge/Carnaval.png');
INSERT INTO `game_type` VALUES ('4', 'ladiesnite', 'LadiesNite', '淑女派对', '淑女派對', 'ladiesnite', 'nmge/LadiesNite_Logo.png');
INSERT INTO `game_type` VALUES ('5', 'immortalromance', 'ImmortalRomance', '不朽的浪漫', '不朽的浪漫', 'immortalromance', 'nmge/IR_Logo.jpg');
INSERT INTO `game_type` VALUES ('6', 'bustthebank', 'BustTheBank', '抢银行', '搶銀行', 'bustthebank', 'nmge/BustTheBank_Logo.jpg');
INSERT INTO `game_type` VALUES ('7', 'retroreels-diamondglitz', 'RetroReels-DiamondGlitz', '鑽石浮华', '鑽石浮華', 'retroreelsdiamondglitz', 'nmge/RetroReelsDiamondGlitz_WebIcon1.png');
INSERT INTO `game_type` VALUES ('8', 'springbreak', 'SpringBreak', '春假时光', '春假時光', 'springbreak', 'nmge/SpringBreak_Logo.png');
INSERT INTO `game_type` VALUES ('9', 'dragondance', 'DragonDance', '舞龙', '舞龍', 'dragondance', 'nmge/DragonDance.png');
INSERT INTO `game_type` VALUES ('10', 'playboy', 'Playboy', '花花公子', '花花公子', 'Playboy', 'nmge/Playboy_SquareLogo_PlainBackground_colour1_on_black.jpg');
INSERT INTO `game_type` VALUES ('11', 'thetwistedcircus', 'TheTwistedCircus', '反转马戏团', '反轉馬戲團', 'thetwistedcircus', 'nmge/MPTheTwistedCircus_Tournament_SquareLogo_WithBackground.png');
INSERT INTO `game_type` VALUES ('12', 'goldfactory', 'GoldFactory', '黄金工场', '黃金工場', 'goldfactory', 'nmge/GoldFactory_Logo.png');
INSERT INTO `game_type` VALUES ('13', 'retroreels', 'RetroReels', '经典老虎机', '經典老虎機', 'retroreels', 'nmge/RetroReels_WebIcon1.png');
INSERT INTO `game_type` VALUES ('14', 'mermaidsmillions', 'MermaidsMillions', '百万美人鱼', '百萬美人魚', 'mermaidsmillions', 'nmge/MPMermaidsMillions_StackedLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('15', 'bushtelegraph', 'BushTelegraph', '丛林快讯', '叢林快訊', 'bushtelegraph', 'nmge/BushTelegraph_Logo2.png');
INSERT INTO `game_type` VALUES ('16', 'basketballstar', 'BasketballStar', '篮球巨星', '籃球巨星', 'BasketballStar', 'nmge/BasketballStar.png');
INSERT INTO `game_type` VALUES ('17', 'thunderstruck', 'Thunderstruck', '雷霆万钧', '雷霆萬鈞', 'thunderstruck', 'nmge/Thunderstruck_HTML5_splashscreen.png');
INSERT INTO `game_type` VALUES ('18', 'sunquest', 'SunQuest', '追寻太阳', '追尋太陽', 'sunquest', 'nmge/SunQuest_Logo.png');
INSERT INTO `game_type` VALUES ('19', 'karatepig', 'KaratePig', '空手道猪', '空手道豬', 'karatepig', 'nmge/KaratePig_Logo_1.png');
INSERT INTO `game_type` VALUES ('20', 'bigkahuna', 'BigKahuna', '森林之王', '森林之王', 'bigkahuna', 'nmge/BigKahuna_Logo2.jpg');
INSERT INTO `game_type` VALUES ('21', '5reeldrive', '5ReelDrive', '侠盗猎车手', '俠盜獵車手', '5reeldrive', 'nmge/5ReelDrive_Icon.png');
INSERT INTO `game_type` VALUES ('22', 'breakdabank', 'BreakdaBank', '银行抢匪', '銀行搶匪', 'breakdabank', 'nmge/BreakDaBank.png');
INSERT INTO `game_type` VALUES ('23', 'tallyho', 'TallyHo', '狐狸爵士', '狐狸爵士', 'tallyho', 'nmge/TallyHo_Logo.png');
INSERT INTO `game_type` VALUES ('24', 'vinylcountdown', 'VinylCountdown', '恋曲1980', '戀曲1980', 'vinylcountdown', 'nmge/BTN_VinylCountdown.png');
INSERT INTO `game_type` VALUES ('25', 'whatahoot', 'WhataHoot', '猫头鹰乐园', '貓頭鷹樂園', 'WhatAHoot', 'nmge/WhatAHoo_Mobile_GameIcon.png');
INSERT INTO `game_type` VALUES ('26', 'luckyfirecracker', 'LuckyFirecracker', '招财鞭炮', '招財鞭炮', 'LuckyFirecracker', 'nmge/LuckyFirecracker_SquareLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('27', 'bikiniparty', 'BikiniParty', '比基尼派对', '比基尼派對', 'bikiniparty', 'nmge/BikiniParty_ZH.png');
INSERT INTO `game_type` VALUES ('28', 'bigtop', 'BigTop', '马戏团', '馬戲團', 'BigTop', 'nmge/BigTop_Logo.png');
INSERT INTO `game_type` VALUES ('29', 'retroreels-extremeheat', 'RetroReels-ExtremeHeat', '酷热经典', '酷熱經典', 'RetroReelsExtremeHeat', 'nmge/RetroReelsExtremeHeat_WebIcon1.png');
INSERT INTO `game_type` VALUES ('30', 'tombraider', 'TombRaider', '古墓丽影', '古墓麗影', 'tombraider', 'nmge/TombRaider_250x250.png');
INSERT INTO `game_type` VALUES ('31', 'leaguesoffortune', 'LeaguesofFortune', '富翁联盟', '富翁聯盟', 'leaguesoffortune', 'nmge/LeaguesOfFortune_250x250.jpg');
INSERT INTO `game_type` VALUES ('32', 'coolwolf', 'CoolWolf', '酷派狼人', '酷派狼人', 'CoolWolf', 'nmge/CoolWolf_01_WildLogo.jpg');
INSERT INTO `game_type` VALUES ('33', 'thunderstruckii', 'ThunderstruckII', '雷神2', '雷神2', 'thunderstruck2', 'nmge/TSII_Thor_1024x768.jpg');
INSERT INTO `game_type` VALUES ('34', 'starlightkiss', 'StarlightKiss', '星光之吻', '星光之吻', 'StarlightKiss', 'nmge/StarlightKiss_Logo_Square_WithBackground.jpg');
INSERT INTO `game_type` VALUES ('35', 'bridesmaids', 'Bridesmaids', '伴娘我最大', '伴娘我最大', 'Bridesmaids', 'nmge/Bridesmaids_01_Wild_Logo.png');
INSERT INTO `game_type` VALUES ('36', 'burningdesire', 'BurningDesire', '燃烧欲望', '燃燒慾望', 'BurningDesire', 'nmge/BurningDesire_logo.png');
INSERT INTO `game_type` VALUES ('37', 'ariana', 'Ariana', '阿丽亚娜', '阿麗亞娜', 'Ariana', 'nmge/Ariana_SquareLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('38', 'hotink', 'HotInk', '刺青酒店', '刺青酒店', 'HotInk', 'nmge/HotInk_250x250.png');
INSERT INTO `game_type` VALUES ('39', 'hohoho', 'HoHoHo', '圣诞节狂欢', '聖誕節狂歡', 'hohoho', 'nmge/HoHoHo_Logo2.png');
INSERT INTO `game_type` VALUES ('40', 'pistoleras', 'Pistoleras', '神秘女枪手', '神秘女槍手', 'Pistoleras', 'nmge/Pistoleras_StackedLogo_GraphicBackground_ZH.png');
INSERT INTO `game_type` VALUES ('41', 'houseofdragons', 'HouseofDragons', '龙宫', '龍宮', 'HouseofDragons', 'nmge/HouseOfDragons_Logo.png');
INSERT INTO `game_type` VALUES ('42', 'avalon', 'Avalon', '阿瓦隆', '阿瓦隆', 'Avalon', 'nmge/Avalon_Logo.png');
INSERT INTO `game_type` VALUES ('43', 'footballstar', 'FootballStar', '足球之巅', '足球之巔', 'FootballStar', 'nmge/FootballStar.jpg');
INSERT INTO `game_type` VALUES ('44', 'reelthunder', 'ReelThunder', '雷霆风暴', '雷霆風暴', 'reelthunder', 'nmge/ReelThunder_Phone_AddToHomeScreen.png');
INSERT INTO `game_type` VALUES ('45', 'reelstrike', 'ReelStrike', '海洋争夺', '海洋爭奪', 'reelstrike', 'nmge/ReelStrike.png');
INSERT INTO `game_type` VALUES ('46', 'rivierariches', 'RivieraRiches', '瑞维拉财宝', '瑞維拉財寶', 'montecarloriches', 'nmge/RivieraRiches_HiDef.png');
INSERT INTO `game_type` VALUES ('47', 'ageofdiscovery', 'AgeofDiscovery', '大航海时代', '大航海時代', 'AgeOfDiscovery', 'nmge/AgeOfDiscovery_Logo.png');
INSERT INTO `game_type` VALUES ('48', 'thefinerreelsoflife', 'TheFinerReelsofLife', '精彩人生', '精彩人生', 'TheFinerReelsOfLife', 'nmge/TheFinerReelsofLife_SquareLogo_WithBackground.jpg');
INSERT INTO `game_type` VALUES ('49', 'jasonandthegoldenfleece', 'JasonandtheGoldenFleece', '金毛骑士团', '金毛騎士團', 'jasonandthegoldenfleece', 'nmge/JasonAndTheGoldenFleece.jpg');
INSERT INTO `game_type` VALUES ('50', 'hotashades', 'HotAsHades', '地府烈焰', '地府烈焰', 'HotAsHades', 'nmge/HotAsHades.png');
INSERT INTO `game_type` VALUES ('51', 'dolphinquest', 'DolphinQuest', '寻访海豚', '尋訪海豚', 'DolphinQuest', 'nmge/DolphinQuest.jpg');
INSERT INTO `game_type` VALUES ('52', 'jacksorbetter', 'JacksorBetter', '对J高手5PK', '對J高手5PK', 'jacks', 'nmge/JacksorBetter.png');
INSERT INTO `game_type` VALUES ('53', 'cashcrazy', 'CashCrazy', '疯狂现金', '瘋狂現金', 'cashcrazy', 'nmge/CashCrazy_Logo.png');
INSERT INTO `game_type` VALUES ('54', 'secretadmirer', 'SecretAdmirer', '暗恋', '暗戀', 'secretadmirer', 'nmge/SecretAdmirer_250x250.png');
INSERT INTO `game_type` VALUES ('55', 'pureplatinum', 'PurePlatinum', '白金俱乐部', '白金俱樂部', 'PurePlatinum', 'nmge/PurePlatinum_Mobile_Logo.png');
INSERT INTO `game_type` VALUES ('56', 'redhotdevil', 'RedHotDevil', '炙热魔鬼', '炙熱魔鬼', 'RedHotDevil', 'nmge/RedHotDevil_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('57', 'happynewyear', 'HappyNewYear', '新年快乐', '新年快樂', 'HappyNewYear', 'nmge/HappyNewYear_Logo.png');
INSERT INTO `game_type` VALUES ('58', 'doublewammy', 'DoubleWammy', '双倍惊喜', '雙倍驚喜', 'doublewammy', 'nmge/DoubleWammySlot_Logo.png');
INSERT INTO `game_type` VALUES ('59', 'crazychameleons', 'CrazyChameleons', '疯狂变色龙', '瘋狂變色龍', 'crazychameleons', 'nmge/CrazyChameleons_Logo.png');
INSERT INTO `game_type` VALUES ('60', 'luckywitch', 'LuckyWitch', '幸运女巫', '幸運女巫', 'luckywitch', 'nmge/LuckyWitch.jpg');
INSERT INTO `game_type` VALUES ('61', 'chainmail', 'ChainMail', '连锁战甲', '連鎖戰甲', 'ChainMail', 'nmge/ChainMail.png');
INSERT INTO `game_type` VALUES ('62', 'kingsofcash', 'KingsofCash', '现金之王', '現金之王', 'kingsofcash', 'nmge/KingsOfCash_Mobile_HiDef.png');
INSERT INTO `game_type` VALUES ('63', 'fishparty', 'FishParty', '海底派对', '海底派對', 'FishParty', 'nmge/FishParty.jpg');
INSERT INTO `game_type` VALUES ('64', 'rugbystar', 'RugbyStar', '橄榄球明星', '橄欖球明星', 'RugbyStar', 'nmge/RugbyStar_StackedLogo_PlainBackground_ZH.png');
INSERT INTO `game_type` VALUES ('65', 'adventurepalace', 'AdventurePalace', '冒险丛林(HD)', '冒險叢林(HD)', 'AdventurePalace', 'nmge/AdventurePalace_SquareLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('66', 'wildorient', 'WildOrient', '东方珍兽', '東方珍獸', 'wildorient', 'nmge/WildOrient_StackedLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('67', 'asianbeauty', 'AsianBeauty', '亚洲风情', '亞洲風情', 'AsianBeauty', 'nmge/AsianBeauty_Logo.png');
INSERT INTO `game_type` VALUES ('68', 'alaskanfishing', 'AlaskanFishing', '阿拉斯加垂钓', '阿拉斯加垂釣', 'AlaskanFishing', 'nmge/AlaskanFishing_Logo.png');
INSERT INTO `game_type` VALUES ('69', 'riverofriches', 'RiverofRiches', '金字塔的财富', '金字塔的財富', 'RiverofRiches', 'nmge/RiverOfRiches_Logo.png');
INSERT INTO `game_type` VALUES ('70', 'luckyzodiac', 'LuckyZodiac', '幸运生肖', '幸運生肖', 'LuckyZodiac', 'nmge/LuckyZodiac_StackedLogo_GraphicBackground_ZH.png');
INSERT INTO `game_type` VALUES ('71', 'luckyleprechaunsloot', 'LuckyLeprechaunsLoot', '幸运小妖', '幸運小妖', 'LuckyLeprechaunsLoot', 'nmge/LuckyLeprechaun_SquareLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('72', 'highsociety', 'HighSociety', '上流社会', '上流社會', 'HighSociety', 'nmge/HighSociety.jpg');
INSERT INTO `game_type` VALUES ('73', 'drwattsup', 'DrWattsUp', '瓦特博士', '瓦特博士', 'drwattsup', 'nmge/DrWattsUp.jpg');
INSERT INTO `game_type` VALUES ('74', 'girlswithguns-jungleheat', 'GirlsWithGuns-JungleHeat', '女孩与枪(丛林热)', '女孩與槍(叢林熱)', 'girlswithguns', 'nmge/GWGJungleHeat_Logo.jpg');
INSERT INTO `game_type` VALUES ('75', 'greatgriffin', 'GreatGriffin', '伟大的狮鹫兽', '偉大的獅鷲獸', 'greatgriffin', 'nmge/GreatGriffin_Logo.png');
INSERT INTO `game_type` VALUES ('76', 'untamed-giantpanda', 'Untamed-GiantPanda', '野生熊猫', '野生熊貓', 'untamedgiantpanda', 'nmge/UntamedGiantPanda_200x200.jpg');
INSERT INTO `game_type` VALUES ('77', 'highfive', 'HighFive', '幸运连线', '幸運連線', 'highfive', 'nmge/High5_LogoFull.png');
INSERT INTO `game_type` VALUES ('78', 'luckykoi', 'LuckyKoi', '幸运锦鲤', '幸運錦鯉', 'LuckyKoi', 'nmge/LuckyKoi_01_WildLogo.jpg');
INSERT INTO `game_type` VALUES ('79', 'santaswildride', 'SantasWildRide', '圣诞大镖客', '聖誕大鏢客', 'SantasWildRide', 'nmge/SantasWildRide_Santa_1920x1200.jpg');
INSERT INTO `game_type` VALUES ('80', 'couchpotato', 'CouchPotato', '慵懒土豆', '慵懶土豆', 'couchpotato', 'nmge/CouchPotato_Icon.png');
INSERT INTO `game_type` VALUES ('81', 'gophergold', 'GopherGold', '黄金地鼠', '黃金地鼠', 'gophergold', 'nmge/GopherGold_MainLogo.png');
INSERT INTO `game_type` VALUES ('82', 'silverfang', 'SilverFang', '银狼', '銀狼', 'SilverFang', 'nmge/SilverFang_Mobile_Logo.png');
INSERT INTO `game_type` VALUES ('83', 'eagleswings', 'EaglesWings', '疾风老鹰', '疾風老鷹', 'eagleswings', 'nmge/EaglesWings_250x250.png');
INSERT INTO `game_type` VALUES ('84', 'bubblebonanza', 'BubbleBonanza', '泡泡矿坑', '泡泡礦坑', 'bubblebonanza', 'nmge/BubbleBonanza_Logo.png');
INSERT INTO `game_type` VALUES ('85', 'agentjaneblonde', 'AgentJaneBlonde', '特工珍尼', '特工珍尼', 'AgentJaneBlonde', 'nmge/AgentJaneBlonde_Logo_01.png');
INSERT INTO `game_type` VALUES ('86', 'rabbitinthehat', 'RabbitInTheHat', '魔术兔', '魔術兔', 'RabbitInTheHat', 'nmge/RabbitInTheHat_StackedLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('87', 'terminatorii', 'TerminatorII', '魔鬼终结者2', '魔鬼終結者2', 'Terminator2', 'nmge/T2_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('88', 'allaces', 'AllAces', '全能王牌', '全能王牌', 'AllAces', 'nmge/AllAcesPoker.png');
INSERT INTO `game_type` VALUES ('89', 'kittycabana', 'KittyCabana', '凯蒂小屋', '凱蒂小屋', 'KittyCabana', 'nmge/KittyCabana.png');
INSERT INTO `game_type` VALUES ('90', 'orientalfortune', 'OrientalFortune', '东方之旅', '東方之旅', 'orientalfortune', 'nmge/OrientalFortune_Logo.png');
INSERT INTO `game_type` VALUES ('91', 'monstermania', 'MonsterMania', '怪兽大进击', '怪獸大進擊', 'monstermania', 'nmge/MonsterMania_Icon2.png');
INSERT INTO `game_type` VALUES ('92', 'serenity', 'Serenity', '宁静', '寧靜', 'Serenity', 'nmge/Serenity_StackedLogo_GraphicBackground_ZH.png');
INSERT INTO `game_type` VALUES ('93', 'battlestargalactica', 'BattlestarGalactica', '太空堡垒', '太空堡壘', 'battlestargalactica', 'nmge/BattlestarGalactica.jpg');
INSERT INTO `game_type` VALUES ('94', '7oceans', '7Oceans', '幸运海洋', '幸運海洋', 'oceans', 'nmge/7Oceans_Logo.png');
INSERT INTO `game_type` VALUES ('95', 'thedarkknightrises', 'TheDarkKnightRises', '黑暗骑士：黎明昇起', '黑暗騎士：黎明昇起', 'TheDarkKnightRises', 'nmge/TDKR_Logo_PlainBackground_Colour.jpg');
INSERT INTO `game_type` VALUES ('96', 'skullduggery', 'SkullDuggery', '神鬼奇航', '神鬼奇航', 'skullduggery', 'nmge/SkullDuggery_Logo.png');
INSERT INTO `game_type` VALUES ('97', 'cashclams', 'CashClams', '贝壳大亨', '貝殼大亨', 'cashclams', 'nmge/CashClams_Logo.png');
INSERT INTO `game_type` VALUES ('98', 'girlswithgunsii-frozendawn', 'GirlsWithGunsII-FrozenDawn', '女孩与枪(寒冷的黎明)', '女孩與槍(寒冷的黎明)', 'GirlsWithGunsFrozenDawn', 'nmge/GWGFrozenDawn.jpg');
INSERT INTO `game_type` VALUES ('99', 'shoot!', 'Shoot!', '射门高手', '射門高手', 'shoot', 'nmge/BTN_Shoot_icon.png');
INSERT INTO `game_type` VALUES ('100', 'luckytwins', 'LuckyTwins', '幸运双星', '幸運雙星', 'luckytwins', 'nmge/LuckyTwins_Logo.png');
INSERT INTO `game_type` VALUES ('101', 'peek-a-boo', 'Peek-a-Boo', '躲猫猫', '躲貓貓', 'PeekaBoo5Reel', 'nmge/PeekABoo_Logo.png');
INSERT INTO `game_type` VALUES ('102', 'roulette', 'Roulette', '欧洲21点', '歐洲21點', 'roulette', '');
INSERT INTO `game_type` VALUES ('103', 'europeanroulettegold', 'EuropeanRouletteGold', '欧洲轮盘(Gold)', '歐洲輪盤(Gold)', 'EuroRouletteGold', 'nmge/EuropeanRouletteGoldSeries_Logo.png');
INSERT INTO `game_type` VALUES ('104', 'premierroulette(allcasinos)', 'PremierRoulette(AllCasinos)', '總理輪盤（所有賭場）', '总理轮盘（所有赌场）', 'PremierRoulette', 'nmge/PremierRoulette_Logo.png');
INSERT INTO `game_type` VALUES ('105', 'premierroulettediamondedition', 'PremierRouletteDiamondEdition', '鑽石总统轮盘', '鑽石總統輪盤', 'premierroulettede', 'nmge/PremierRouletteDiamondEdition_Logo.png');
INSERT INTO `game_type` VALUES ('106', 'fantasticsevens', 'FantasticSevens', '炫目缤纷', '炫目繽紛', 'fan7', 'nmge/Fantastic7s_Logo.png');
INSERT INTO `game_type` VALUES ('107', 'pharaohsfortune', 'PharaohsFortune', '法老王的财富', '法老王的財富', 'pharaohs', 'nmge/PharaohsFortune_Logo.png');
INSERT INTO `game_type` VALUES ('108', 'piratesparadise', 'PiratesParadise', '海盗天堂', '海盜天堂', 'pirates', 'nmge/PiratesParadise_Logo.png');
INSERT INTO `game_type` VALUES ('109', 'cutesypie', 'CutesyPie', '嬌媚餡餅', '娇媚馅饼', 'CutesyPie', 'nmge/CutesyPie_Logo.png');
INSERT INTO `game_type` VALUES ('110', 'diamondsevens', 'DiamondSevens', '鑽石七人欖球', '钻石七人欖球', 'Diamond7s', 'nmge/Diamond7s_Logo.png');
INSERT INTO `game_type` VALUES ('111', 'grandsevens', 'GrandSevens', '盛大七人欖球', '盛大七人榄球', 'Grand7s', 'nmge/Grand7s_Logo.png');
INSERT INTO `game_type` VALUES ('112', 'floriditafandango', 'FloriditaFandango', '西班牙凡丹戈', '西班牙凡丹戈', 'FloriditaFandango', 'nmge/FloriditaFandango_Logo.png');
INSERT INTO `game_type` VALUES ('113', 'fruit', 'Fruit', '水果老虎机', '水果老虎機', 'fruits', 'nmge/FruitSlots_Logo.png');
INSERT INTO `game_type` VALUES ('114', 'doublemagic', 'DoubleMagic', '双倍魔术', '雙倍魔術', 'dm', 'nmge/DoubleMagic_Button.png');
INSERT INTO `game_type` VALUES ('115', 'fortunecookie', 'FortuneCookie', '幸运饼乾', '幸運餅乾', 'fortunecookie', 'nmge/FortuneCookie_Logo.png');
INSERT INTO `game_type` VALUES ('116', 'cherryred', 'CherryRed', '樱桃红', '櫻桃紅', 'cherryred', 'nmge/CherryRed_Logo.png');
INSERT INTO `game_type` VALUES ('117', 'rocktheboat', 'RocktheBoat', '摇滚航道', '搖滾航道', 'rocktheboat', 'nmge/RocktheBoat_Logo.png');
INSERT INTO `game_type` VALUES ('118', 'doubledose', 'DoubleDose', '双倍剂量', '雙倍劑量', 'DoubleDose', 'nmge/DoubleDose_Logo.png');
INSERT INTO `game_type` VALUES ('119', 'cityofgold', 'CityofGold', '黄金之城', '黄金之城', 'CityofGold', 'nmge/CityofGold_Logo.png');
INSERT INTO `game_type` VALUES ('120', '1000islands', '1000Islands', '千群岛', '千群島', 'ThousandIslands', 'nmge/ThousandIslands_Logo.png');
INSERT INTO `game_type` VALUES ('121', 'dondeal', 'DonDeal', '黑手交易', '黑手交易', 'DonDeal', 'nmge/DonDeal_Logo.png');
INSERT INTO `game_type` VALUES ('122', 'mochaorange', 'MochaOrange', '摩卡橘子', '摩卡橘子', 'MochaOrange', 'nmge/MochaOrange_Logo.png');
INSERT INTO `game_type` VALUES ('123', 'blackjack', 'Blackjack', '经典21点', '經典21點', '', '');
INSERT INTO `game_type` VALUES ('124', 'scratchcard', 'ScratchCard', '刮刮乐', '刮刮樂', 'scratch', '');
INSERT INTO `game_type` VALUES ('125', 'flipcard', 'FlipCard', '扑克游戏', '撲克遊戲', 'flipcard', 'nmge/FlipCard.png');
INSERT INTO `game_type` VALUES ('126', 'craps', 'Craps', '花旗骰', '花旗骰', 'craps', '');
INSERT INTO `game_type` VALUES ('127', 'big5', 'Big5', '丛林五霸', '叢林五霸', 'big5', 'nmge/Big5_Logo.png');
INSERT INTO `game_type` VALUES ('128', 'jestersjackpot', 'JestersJackpot', '欢乐小丑', '歡樂小丑', 'jesters', 'nmge/JestersJackpot_Logo.png');
INSERT INTO `game_type` VALUES ('129', 'flosdiner', 'FlosDiner', '弗洛晚餐', '弗洛晚餐', 'FlosDiner', 'nmge/FlosDiner_Logo.png');
INSERT INTO `game_type` VALUES ('130', 'jackpotexpress', 'JackpotExpress', '奖金快递', '獎金快遞', 'jexpress', 'nmge/JackpotExpress_Logo.png');
INSERT INTO `game_type` VALUES ('131', 'goldendragon', 'GoldenDragon', '黄金龙', '黃金龍', 'gdragon', 'nmge/GoldenDragon_Logo.png');
INSERT INTO `game_type` VALUES ('132', 'romansriches', 'RomansRiches', '罗马富豪', '羅馬富豪', 'romanriches', 'nmge/RomanRiches_Logo.png');
INSERT INTO `game_type` VALUES ('133', 'belissimo', 'Belissimo', '贝利西餐厅', '貝利西餐廳', 'belissimo', 'nmge/Belissimo_Logo.png');
INSERT INTO `game_type` VALUES ('134', 'captaincash', 'CaptainCash', '派金船长', '派金船長', 'CaptainCash', 'nmge/CaptainCash_Logo.png');
INSERT INTO `game_type` VALUES ('135', 'funhouse', 'Funhouse', '开心乐园', '開心樂園', 'Funhouse', 'nmge/FunHouse_Logo.png');
INSERT INTO `game_type` VALUES ('136', 'crazycrocs', 'CrazyCrocs', '疯狂鳄鱼', '瘋狂鱷魚', 'crocs', 'nmge/CrazyCrocs_Logo.png');
INSERT INTO `game_type` VALUES ('137', 'blackjackbonanza', 'BlackjackBonanza', '21点矿坑', '21點礦坑', 'BlackjackBonanza', 'nmge/BlackjackBonanza_Logo.png');
INSERT INTO `game_type` VALUES ('138', 'chiefsmagic', 'ChiefsMagic', '魔术酋长', '魔術酋長', 'chiefsmagic', 'nmge/ChiefsMagic_Logo.png');
INSERT INTO `game_type` VALUES ('139', 'reelsroyce', 'ReelsRoyce', '劳斯莱斯', '勞斯萊斯', 'royce', 'nmge/ReelsRoyce_Logo.png');
INSERT INTO `game_type` VALUES ('140', 'trickortreat', 'TrickorTreat', '不给糖就捣蛋', '不給糖就搗蛋', 'trickortreat', 'nmge/TrickorTreat_Logo.png');
INSERT INTO `game_type` VALUES ('141', 'gladiatorsgold', 'GladiatorsGold', '金角斗士', '金角鬥士', 'gladiatorsgold', '');
INSERT INTO `game_type` VALUES ('142', 'heavymetal', 'HeavyMetal', '摇滚重金属', '搖滾重金屬', 'HeavyMetal', 'nmge/HeavyMetal_Logo.png');
INSERT INTO `game_type` VALUES ('143', 'deuceswild', 'DeucesWild', '百搭二王', '百搭二王', 'deuceswi', 'nmge/DeucesWild.png');
INSERT INTO `game_type` VALUES ('144', 'deucesandjoker', 'DeucesandJoker', '百搭二王与小丑', '百搭二王與小丑', 'deucesandjoker', 'nmge/DeucesJoker.png');
INSERT INTO `game_type` VALUES ('145', 'cyberstudpoker', 'CyberstudPoker', '加勒比海扑克', '加勒比海撲克', 'cyberstud', '');
INSERT INTO `game_type` VALUES ('146', 'keno', 'Keno', '快乐彩', '快樂彩', 'keno', '');
INSERT INTO `game_type` VALUES ('147', 'jokerpoker', 'JokerPoker', '双倍小丑百搭5PK', '雙倍小丑百搭5PK', 'jokerpok', 'nmge/JokerPoker50Play_Logo.png');
INSERT INTO `game_type` VALUES ('148', 'pokerpursuit', 'PokerPursuit', '扑克追击', '撲克追擊', 'pokerpursuit', '');
INSERT INTO `game_type` VALUES ('149', 'louisianadouble', 'LouisianaDouble', '路易斯安那5PK', '路易斯安那5PK', 'louisianadouble', '');
INSERT INTO `game_type` VALUES ('150', 'aces&faces', 'Aces&Faces', '经典5PK', '經典5PK', 'acesfaces', 'nmge/BTN_Aces&Faces.png');
INSERT INTO `game_type` VALUES ('151', 'tensorbetter', 'TensorBetter', '对十天王5PK', '對十天王5PK', 'tensorbetter', 'nmge/TensOrBetter4PlayPowerPoker_Button.png');
INSERT INTO `game_type` VALUES ('152', 'doublejokerpoker', 'DoubleJokerPoker', '小丑百搭5PK', '小丑百搭5PK', 'doublejoker', 'nmge/DoubleJokerPokerLevelUp_Logo.png');
INSERT INTO `game_type` VALUES ('153', 'baccarat', 'Baccarat', '百家乐', '百家樂', 'baccarat', 'nmge/Baccarat.png');
INSERT INTO `game_type` VALUES ('154', 'sicbo', 'SicBo', '骰宝', '骰寶', 'sicbo', 'nmge/Sicbo_01_StackedLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('155', 'threewheeler', 'ThreeWheeler', '三辆车夫', '三輛車夫', 'ThreeWheeler', 'nmge/ThreeWheeler_Logo.png');
INSERT INTO `game_type` VALUES ('156', 'winningwizards', 'WinningWizards', '巫师梅林', '巫師梅林', 'wwizards', 'nmge/WinningWizards.png');
INSERT INTO `game_type` VALUES ('157', 'geniesgems', 'GeniesGems', '精灵宝石', '精靈寶石', 'geniesgems', 'nmge/GeniesGems.png');
INSERT INTO `game_type` VALUES ('158', 'reddog', 'RedDog', '红狗', '紅狗', 'reddog', 'nmge/RedDog_Logo.png');
INSERT INTO `game_type` VALUES ('159', 'jurassicjackpot', 'JurassicJackpot', '侏儸纪彩金', '侏儸紀彩金', 'jurassicjackpot', 'nmge/Jurassicjackpot_Logo.png');
INSERT INTO `game_type` VALUES ('160', 'jurassicbigreels', 'JurassicBigReels', '侏儸纪彩金(超级)', '侏儸紀彩金(超級)', 'jurassicbr', '');
INSERT INTO `game_type` VALUES ('161', 'frostbite', 'FrostBite', '结霜冻疮', '結霜凍瘡', 'FrostBite', 'nmge/FrostBite_Logo.png');
INSERT INTO `game_type` VALUES ('162', 'cosmiccat', 'CosmicCat', '宇宙猫', '宇宙貓', 'cosmicc', 'nmge/CosmicCat_Logo.png');
INSERT INTO `game_type` VALUES ('163', 'mhbjclassic', 'Blackjack', '经典21点(多组牌)', '經典21點(多組牌)', 'mhbjclassic', '');
INSERT INTO `game_type` VALUES ('164', 'europeanblackjack', 'EuropeanBlackjack', '欧洲21点', '歐洲21點', 'europeanadvbj', 'nmge/EuropeanBlackjackGold_Button_1.png');
INSERT INTO `game_type` VALUES ('165', 'europeanblackjack-highlimittable', 'EuropeanBlackjack-HighLimitTable', '高限额欧洲21点', '高限額歐洲21點', 'hleuropeanadvbj', '');
INSERT INTO `game_type` VALUES ('166', 'multiwheel(8)europeanroulettegold', 'MultiWheel(8)EuropeanRouletteGold', '複式轮盘', '複式輪盤', 'MultiWheelRouletteGold', 'nmge/EuropeanRouletteGoldSeries_Logo_2.png');
INSERT INTO `game_type` VALUES ('167', 'baccaratgold', 'BaccaratGold', '咪牌百家乐', '咪牌百家樂', 'BaccaratGold', 'nmge/BaccaratGold.png');
INSERT INTO `game_type` VALUES ('168', 'europeanblackjackredealgold', 'EuropeanBlackjackRedealGold', '金牌欧洲Redeal21点', '金牌歐洲Redeal21點', 'europeanbjgoldredeal', 'nmge/EuropeanBlackjackGold_Logo_1.png');
INSERT INTO `game_type` VALUES ('169', 'americanroulette', 'AmericanRoulette', '美式轮盘', '美式輪盤', 'AmericanRoulette', 'nmge/AmericanRoulette.png');
INSERT INTO `game_type` VALUES ('170', 'vegasstripblackjack', 'VegasStripBlackjack', '拉斯维加斯21点', '拉斯維加斯21點', 'vegasstrip', 'nmge/VegasStripBlackjack.png');
INSERT INTO `game_type` VALUES ('171', 'vegasdowntownblackjack', 'VegasDowntownBlackjack', '拉斯维加斯21点', '拉斯維加斯21點', 'VegasDownTown', 'nmge/VegasDowtownBlackjackGold_Button_HiDef.png');
INSERT INTO `game_type` VALUES ('172', 'doubleexposurebj', 'DoubleExposureBJ', '决斗21点', '決鬥21點', 'doubleexposure', 'nmge/DoubleExposureBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('173', 'superfun21', 'SuperFun21', '超级乐21点', '超級樂21點', 'superfun21', 'nmge/SuperFun21.png');
INSERT INTO `game_type` VALUES ('174', 'atlanticcityblackjack', 'AtlanticCityBlackjack', '大西洋城21点', '大西洋城21點', 'atlanticcity', 'nmge/AtlanticCityBJGold_Logo_1.png');
INSERT INTO `game_type` VALUES ('175', 'spanishblackjack', 'SpanishBlackjack', '西班牙21点', '西班牙21點', 'spanish', 'nmge/Spanish21BlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('176', 'highlimitbaccarat', 'HighLimitBaccarat', '高限额百家乐', '高限額百家樂', 'HighLimitBaccarat', 'nmge/HighLimitBaccarat_Button.png');
INSERT INTO `game_type` VALUES ('177', 'bonuspoker', 'BonusPoker', '红利5PK', '紅利5PK', 'BonusPoker', 'nmge/BonusVideoPoker.png');
INSERT INTO `game_type` VALUES ('178', 'doublebonuspoker', 'DoubleBonusPoker', '两倍红利5PK', '兩倍紅利5PK', 'DoubleBonusPoker', 'nmge/DoubleBonusPoker.png');
INSERT INTO `game_type` VALUES ('179', 'bonuspokerdeluxe', 'BonusPokerDeluxe', '豪华红利5PK', '豪華紅利5PK', 'BonusPokerDeluxe', 'nmge/BonusPokerDeluxe_Logo.png');
INSERT INTO `game_type` VALUES ('180', 'doubledoublebonuspoker', 'DoubleDoubleBonusPoker', '四倍红利5PK', '四倍紅利5PK', 'doubledoublebonus', 'nmge/DoubleDoubleBonus_Logo.png');
INSERT INTO `game_type` VALUES ('181', 'acesandeights', 'AcesandEights', '对八5PK', '對八5PK', 'AcesAndEights', 'nmge/BTN_Aces&Eights.png');
INSERT INTO `game_type` VALUES ('182', 'allamericanpoker', 'AllAmericanPoker', '全美扑克', '全美撲克', 'AllAmerican', 'nmge/AllAmerican.png');
INSERT INTO `game_type` VALUES ('183', 'bonusdeuceswild', 'BonusDeucesWild', '红利狂野牌', '紅利狂野牌', 'BonusDeucesWild', 'nmge/BTN_BonusDeucesWild1.png');
INSERT INTO `game_type` VALUES ('184', 'frenchroulette', 'FrenchRoulette', '法式轮盘', '法式輪盤', 'FrenchRoulette', 'nmge/FrenchRoulette_Logo.png');
INSERT INTO `game_type` VALUES ('185', 'multihand-atlanticcityblackjack', 'MultiHand-AtlanticCityBlackjack', '大西洋城21点(多组牌)', '大西洋城21點(多組牌)', 'mhbjatlanticcity', '');
INSERT INTO `game_type` VALUES ('186', 'multi-handholdemhighgold', 'Multi-HandHoldemHighGold', '多手德州扑克改进版', '多手德州撲克改進版', 'MHHoldemHigh', 'nmge/HoldEmHighGold_Logo.png');
INSERT INTO `game_type` VALUES ('187', 'atlanticcityblackjackgold', 'AtlanticCityBlackjackGOLD', '金牌大西洋城21点', '金牌大西洋城21點', 'atlanticcitybjgold', 'nmge/AtlanticCityBJGold_Logo_1.png');
INSERT INTO `game_type` VALUES ('188', 'multihand-atlanticcityblackjackgold', 'MultiHand-AtlanticCityBlackjackGold', '金牌大西洋城21点(多组牌)', '金牌大西洋城21點(多組牌)', 'mhatlanticcitybjgold', 'nmge/AtlanticCityBJGold_Logo_2.png');
INSERT INTO `game_type` VALUES ('189', 'vegasstripblackjackgold', 'VegasStripBlackjackGOLD', '金牌拉斯维加斯21点', '金牌拉斯維加斯21點', 'VegasStripBlackjackGold', 'nmge/VegasStripBlackjackGold_Button_HiDef.png');
INSERT INTO `game_type` VALUES ('190', 'multihand-vegasdowntownblackjackgold', 'MultiHand-VegasDowntownBlackjackGold', '金牌拉斯維加斯中心21點', '金牌拉斯維加斯中心21點', 'MultiVegasDowntownBlackjackGold', 'nmge/MultiHandVegasDowntownBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('191', 'europeanblackjackgold', 'EuropeanBlackjackGOLD', '金牌欧洲21点', '金牌歐洲21點', 'europeanbjgold', 'nmge/EuropeanBlackjackGold_Logo_1.png');
INSERT INTO `game_type` VALUES ('192', 'multihand-europeanblackjackgold', 'MultiHand-EuropeanBlackjackGold', '金牌欧洲21点', '金牌歐洲21點', 'mheuropeanbjgold', 'nmge/MultiHandEuropeanBlackjackGold_ClarionButton.png');
INSERT INTO `game_type` VALUES ('193', 'beginnereuropeanblackjackgold', 'BeginnerEuropeanBlackjackGold', '金牌欧洲新手21点', '金牌歐洲新手21點', 'BeginnerMHEuropeanBJGold', 'nmge/EuropeanBlackjackGold_Logo_1.png');
INSERT INTO `game_type` VALUES ('194', 'premiermultihandeuroblackjackgold', 'PremierMultiHandEuroBlackjackGold', '金牌欧洲总理21点', '金牌歐洲總理21點', 'PBJMultiHand', 'nmge/MultiHandEuropeanBlackjackGold_ClarionButton.png');
INSERT INTO `game_type` VALUES ('195', 'classicblackjackgold', 'ClassicBlackjackGOLD', '金牌经典21点', '金牌經典21點', 'ClassicBlackjackGold', 'nmge/ClassicBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('196', 'vegassingledeckblackjackgold', 'VegasSingleDeckBlackjackGOLD', '金牌拉斯维加斯单牌21点', '金牌拉斯维加斯單牌21點', 'VegasSingleDeckBlackjackGold', 'nmge/VegasSingleDeckBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('197', 'premiermultihandeurobonusblackjackgold', 'PremierMultiHandEuroBonusBlackjackGold', '金牌欧洲总理21点（多组牌）', '金牌歐洲總理21點(多組牌)', 'PBJMultiHandBonus', 'nmge/MultiHandEuropeanBlackjackGold_ClarionButton.png');
INSERT INTO `game_type` VALUES ('198', 'big5blackjackgold', 'Big5BlackjackGOLD', '金牌大五21点', '金牌大五21點', 'BigFiveBlackjackGold', 'nmge/BigFiveBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('199', 'spanish21blackjackgold', 'Spanish21BlackjackGOLD', '金牌西班牙21点', '金牌西班牙21點', 'SpanishBlackjackGold', 'nmge/Spanish21BlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('200', 'doubleexposuregold', 'DoubleExposureGOLD', '金牌双重亮相', '金牌雙重亮相', 'DoubleExposureBlackjackGold', 'nmge/DoubleExposureBlackjackGold_Logo2.png');
INSERT INTO `game_type` VALUES ('201', 'multihand-classicblackjackgold', 'MultiHand-ClassicBlackjackGold', '金牌经典21点（多组牌）', '金牌經典21點(多組牌)', 'MultiClassicBlackjackGold', 'nmge/MultiHandClassicBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('202', 'triplepocketholdemgold', 'TriplePocketHoldemGold', '金牌三重扑克', '金牌三重撲克', 'TriplePocketPoker', 'nmge/TriplePocketHoldem_Logo.png');
INSERT INTO `game_type` VALUES ('203', 'hilo13europeanblackjackgold', 'HiLo13EuropeanBlackjackGold', '金牌欧洲高低1321点', '金牌歐洲高低1321點', 'HiLoBlackjackGold', 'nmge/HiLo13EuropeanBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('204', 'premierhilo13euroblackjackgold', 'PremierHiLo13EuroBlackjackGold', '', '超級金牌歐洲高低21點', 'PBJHiLo', 'nmge/PremierBlackjackHiLo_Logo_1.png');
INSERT INTO `game_type` VALUES ('205', 'highstreakeuroblackjackgold', 'HighStreakEuroBlackjackGold', '金牌欧洲连赢21点', '金牌歐洲連贏21點', 'HighStreakBJGold', 'nmge/EuropeanHighStreakBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('206', 'premierhighstreakeuroblackjackgold', 'PremierHighStreakEuroBlackjackGold', '超级金牌欧洲连赢21点', '超級金牌歐洲連贏21點', 'PBJHighStreak', 'nmge/PremierBlackjackHighStreak_Logo_2.png');
INSERT INTO `game_type` VALUES ('207', 'multihandperfectpairsblackjackgold', 'MultiHandPerfectPairsBlackjackGold', '超级完美对碰21点(多组牌)', '超級完美對碰21點(多組牌)', 'MHPerfectPairs', 'nmge/MultiHandEuroPerfectPairsBlackjackGold_Logo.png');
INSERT INTO `game_type` VALUES ('208', 'multi-handhighspeedpokergold', 'Multi-handHighSpeedPokerGold', '三张扑克(多组牌)', '三張撲克(多組牌)', 'highspeedpoker', 'nmge/HighSpeedPokerGold.png');
INSERT INTO `game_type` VALUES ('209', 'coolbuck', 'CoolBuck', '酷巴克', '酷巴克', 'coolbuck', 'nmge/CoolBuck_Logo.png');
INSERT INTO `game_type` VALUES ('210', 'jinglebells', 'JingleBells', '叮当响', '叮噹響', 'JingleBells', 'nmge/JingleBells_Logo.png');
INSERT INTO `game_type` VALUES ('211', 'fortuna', 'Fortuna', '幸運财神', '幸運財神', 'Fortuna', 'nmge/Fortuna_Logo.png');
INSERT INTO `game_type` VALUES ('212', 'rapidreels', 'RapidReels', '快速卷轴', '快速捲軸', 'RapidReels', 'nmge/RapidReels_Logo.png');
INSERT INTO `game_type` VALUES ('213', 'goldcoast', 'GoldCoast', '黃金海岸', '黃金海岸', 'GoldCoast', 'nmge/GoldCoast_Logo.png');
INSERT INTO `game_type` VALUES ('214', 'flyingace', 'FlyingAce', '王牌飞行员', '王牌飛行員', 'FlyingAce', 'nmge/FlyingAce_Icon.png');
INSERT INTO `game_type` VALUES ('215', 'legacy', 'Legacy', '黄金遗产', '黃金遺產', 'Legacy', 'nmge/Legacy_Logo.png');
INSERT INTO `game_type` VALUES ('216', 'goblinsgold', 'GoblinsGold', '黄金哥布林', '黃金哥布林', 'goblinsgold', 'nmge/GoblinsGold_Logo.png');
INSERT INTO `game_type` VALUES ('217', 'spellbound', 'SpellBound', '出神入化', '出神入化', 'SpellBound', 'nmge/SpellBound_Logo.png');
INSERT INTO `game_type` VALUES ('218', 'jewelthief', 'JewelThief', '珠宝神偷', '珠寶神偷', 'JewelThief', 'nmge/JewelThief_Logo.png');
INSERT INTO `game_type` VALUES ('219', 'samurai7s', 'Samurai7s', '武士7S', '武士7S', 'SamuraiSevens', 'nmge/Samurai7s_Logo_2.png');
INSERT INTO `game_type` VALUES ('220', 'lionsshare', 'LionsShare', '万兽之王', '萬獸之王', 'lions', 'nmge/LionsShare_Logo.png');
INSERT INTO `game_type` VALUES ('221', 'astronomical', 'Astronomical', '天文奇迹', '天文奇蹟', 'Astronomical', 'nmge/Astronomical_Logo.png');
INSERT INTO `game_type` VALUES ('222', 'monkeysmoney', 'MonkeysMoney', '猴子的宝藏', '猴子的寶藏', 'monkeys', '');
INSERT INTO `game_type` VALUES ('223', 'crackerjack', 'CrackerJack', '红利炮竹', '紅利炮竹', 'crackerjack', 'nmge/CrackerJack_Logo.png');
INSERT INTO `game_type` VALUES ('224', 'jackinthebox', 'JackintheBox', '魔法玩具箱', '魔法玩具箱', 'JackintheBox', 'nmge/JackintheBox_Logo.png');
INSERT INTO `game_type` VALUES ('225', 'totemtreasure', 'TotemTreasure', '图腾宝藏', '圖騰寶藏', 'totemtreasure', 'nmge/TotemTreasure_Button.jpg');
INSERT INTO `game_type` VALUES ('226', 'zanyzebra', 'ZanyZebra', '搞笑斑马', '搞笑斑馬', 'zebra', 'nmge/ZanyZebra_Logo.png');
INSERT INTO `game_type` VALUES ('227', 'ringsandroses', 'RingsandRoses', '戒指和玫瑰', '戒指和玫瑰', 'RingsnRoses', 'nmge/Rings&Roses_Logo.png');
INSERT INTO `game_type` VALUES ('228', 'peek-a-boo', 'Peek-a-Boo', '躲猫猫', '躲猫猫', 'PeekaBoo', 'nmge/PeekABoo_StackedLogo_GraphicBackground_ZH.png');
INSERT INTO `game_type` VALUES ('229', 'flowerpower', 'FlowerPower', '力量之花', '力量之花', 'flowerpower', 'nmge/FlowerPower_Logo.png');
INSERT INTO `game_type` VALUES ('230', 'fairyring', 'FairyRing', '神奇蘑菇圈', '神奇蘑菇圈', 'FairyRing', 'nmge/FairyRing.png');
INSERT INTO `game_type` VALUES ('231', 'fruitsalad', 'FruitSalad', '水果沙拉', '水果沙拉', 'FruitSalad', 'nmge/FruitSalad_Logo.png');
INSERT INTO `game_type` VALUES ('232', 'partytime', 'PartyTime', '派对时刻', '派對時刻', 'partytime', 'nmge/PartyTime_Logo.png');
INSERT INTO `game_type` VALUES ('233', 'crazy80s', 'Crazy80s', '疯狂80年代', '瘋狂80年代', 'Crazy80s', 'nmge/Crazy80s_Logo.png');
INSERT INTO `game_type` VALUES ('234', 'frootloot', 'FrootLoot', '水果圈圈', '水果圈圈', 'FrootLoot', 'nmge/FrootLoot_Logo.png');
INSERT INTO `game_type` VALUES ('235', 'hotshot', 'HotShot', '热拍', '熱拍', 'HotShot', 'nmge/HotShot_Logo.png');
INSERT INTO `game_type` VALUES ('236', 'summertime', 'Summertime', '夏令时间', '夏令時間', 'Summertime', 'nmge/Summertime_HiDef.png');
INSERT INTO `game_type` VALUES ('237', 'goodtogo', 'GoodtoGo', '开心出发', '開心出發', 'GoodToGo', 'nmge/GoodToGo_Logo.png');
INSERT INTO `game_type` VALUES ('238', 'triplemagic', 'TripleMagic', '三重魔力', '三重魔力', 'triplemagic', 'nmge/TripleMagic_Logo.png');
INSERT INTO `game_type` VALUES ('239', 'barbarblacksheep', 'BarBarBlackSheep', '黑羊酒吧', '黑羊酒吧', 'BarBarBlackSheep', 'nmge/BarBarBlackSheep_250x250.jpg');
INSERT INTO `game_type` VALUES ('240', 'sonicboom', 'SonicBoom', '超速音爆', '超速音爆', 'SonicBoom', 'nmge/SonicBoom_Logo.png');
INSERT INTO `game_type` VALUES ('241', 'junglejim', 'JungleJim', '丛林吉姆', '叢林吉姆', 'JungleJim', 'nmge/JungleJim_Logo.png');
INSERT INTO `game_type` VALUES ('242', 'harveys', 'Harveys', '哈维', '哈维', 'Harveys', 'nmge/Harveys_Button_HiDef.png');
INSERT INTO `game_type` VALUES ('243', 'munchkins', 'Munchkins', '梦境', '夢境', 'Munchkins', 'nmge/Munchkins.png');
INSERT INTO `game_type` VALUES ('244', 'twister', 'Twister', '谎者', '說謊者', 'Twister', 'nmge/Twister_Logo.png');
INSERT INTO `game_type` VALUES ('245', 'kathmandu', 'Kathmandu', '加德满都', '加德滿都', 'Kathmandu', 'nmge/Kathmandu_200x200.png');
INSERT INTO `game_type` VALUES ('246', 'isis', 'Isis', '伊西斯', '伊西斯', 'isis', 'nmge/Isis_Logo.png');
INSERT INTO `game_type` VALUES ('247', 'supeitup', 'SupeitUp', '苏佩起来', '蘇佩起來', 'SupeItUp', 'nmge/SupeItUp_Logo.png');
INSERT INTO `game_type` VALUES ('248', 'santapaws', 'SantaPaws', '圣诞老人爪子', '聖誕老人爪子', 'SantaPaws', '');
INSERT INTO `game_type` VALUES ('249', 'rhymingreelsheartsandtarts', 'RhymingReelsHeartsandTarts', '金牌大西洋城21点(多组牌)', '金牌大西洋城21點(多組牌)', 'rrqueenofhearts', 'nmge/RRHeartsAndTarts_Logo.png');
INSERT INTO `game_type` VALUES ('250', 'rrjackandjill96', 'RRJackandJill96', '杰克与吉儿', '傑克與吉兒', 'rrjackandjill', 'nmge/RR_JackandJill_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('251', 'rhymingreelsgeorgieporgie', 'RhymingReelsGeorgiePorgie', '乔治与柏志', '喬治與柏志', 'RRGeorgiePorgie', 'nmge/RhymingReelsGeorgiePorgie_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('252', 'sterlingsilver3dstereo', 'SterlingSilver3DStereo', '纯银3D', '純銀3D', 'SterlingSilver3d', 'nmge/SterlingSilver3D_Logo2.png');
INSERT INTO `game_type` VALUES ('253', 'dronewars', 'DroneWars', '雄蜂战争', '雄蜂戰爭', 'DroneWars', 'nmge/DroneWars_Logo.png');
INSERT INTO `game_type` VALUES ('254', 'thelandoflemuria', 'TheLandofLemuria', '利莫里亚的土地', '利莫裏亞的土地', 'TheLandofLemuria', 'nmge/TheForgottenLandofLemuria_Button.png');
INSERT INTO `game_type` VALUES ('255', 'mysticdreams', 'MysticDreams', '神秘的梦', '神秘的夢', 'MysticDreams', 'nmge/MysticDreams_SquareLogo_WithBackground.jpg');
INSERT INTO `game_type` VALUES ('256', 'victorianvillain', 'VictorianVillain', '维多利亚反派', '維多利亞反派', 'victorianvillain', 'nmge/VictorianVillain_Logo.png');
INSERT INTO `game_type` VALUES ('257', 'mountolympus', 'MountOlympus', '奥林匹斯山', '奧林匹斯山', 'mountolympus', 'nmge/MountOlympusRevengeOfMedusa_Logo.png');
INSERT INTO `game_type` VALUES ('258', 'jekyllandhyde', 'JekyllandHyde', '哲基尔&海德', '哲基爾&海德', 'jekyllandhyde', 'nmge/JekyllAndHyde_Logo.png');
INSERT INTO `game_type` VALUES ('259', 'hellsgrannies', 'HellsGrannies', '地狱的祖母', '地獄的祖母', 'hellsgrannies', 'nmge/HellsGrannies_Logo.png');
INSERT INTO `game_type` VALUES ('260', 'megaspin-breakdabankagain', 'Megaspin-BreakdaBankAgain', '多台-银行抢匪2', '多台-銀行搶匪2', 'msbreakdabankagain', 'nmge/MS_BreakdaBankAgain_Logo.png');
INSERT INTO `game_type` VALUES ('261', 'alaxeinzombieland', 'AlaxeinZombieland', '尸乐园的亚历克斯', '尸樂園的亞曆克斯', 'alaxeinzombieland', 'nmge/AlaxeInZombieland.png');
INSERT INTO `game_type` VALUES ('262', 'rollerderby', 'RollerDerby', '德比滚筒', '德比滾筒', 'rollerderby', 'nmge/RollerDerby_Logo.jpg');
INSERT INTO `game_type` VALUES ('263', 'untamed-bengaltiger', 'Untamed-BengalTiger', '野性孟加拉虎', '野性孟加拉虎', 'untamedbengaltiger', 'nmge/UntamedBengalTiger_SquareLogo.jpg');
INSERT INTO `game_type` VALUES ('264', 'luckyrabbitloot', 'LuckyRabbitLoot', '幸运兔的战利品', '幸運兔的戰利品', 'LuckyRabbitsLoot', 'nmge/LuckyRabbitLoot_Button.png');
INSERT INTO `game_type` VALUES ('265', 'bootytime', 'BootyTime', '宝藏时间', '寶藏時間', 'bootytime', 'nmge/BootyTime.png');
INSERT INTO `game_type` VALUES ('266', 'tigervsbear', 'TigervsBear', '虎VS熊', '虎VS熊', 'tigervsbear', 'nmge/TigerVsBear_Logo.png');
INSERT INTO `game_type` VALUES ('267', 'whitebuffalo', 'WhiteBuffalo', '白水牛', '白水牛', 'whitebuffalo', 'nmge/WhiteBuffalo_Logo.png');
INSERT INTO `game_type` VALUES ('268', 'mystiquegrove', 'MystiqueGrove', '神秘格罗夫', '神秘格羅夫', 'mystiquegrove', 'nmge/MystiqueGrove_Logo.png');
INSERT INTO `game_type` VALUES ('269', 'thelostprincessanastasia', 'TheLostPrincessAnastasia', '财富联盟', '財富聯盟', 'thelostprincessanastasia', 'nmge/TheLostPrincessAnastasia_Logo.png');
INSERT INTO `game_type` VALUES ('270', 'surfsafari', 'SurfSafari', '冲浪旅行', '衝浪旅行', 'surfsafari', 'nmge/SurfSafari_Logo.png');
INSERT INTO `game_type` VALUES ('271', 'phantomcash', 'PhantomCash', '幻影现金', '幻影現金', 'phantomcash', 'nmge/PhantomCash_Logo.png');
INSERT INTO `game_type` VALUES ('272', 'breakaway-highlimit', 'BreakAway-HighLimit', '上限解放', '上限解放', 'BreakAwayHighLimit', 'nmge/BreakAway.jpg');
INSERT INTO `game_type` VALUES ('273', 'cricketstar', 'CricketStar', '板球明星', '板球明星', 'CricketStar', 'nmge/CricketStar.jpg');
INSERT INTO `game_type` VALUES ('274', 'octopays', 'Octopays', '海底总动员', '海底總動員', 'Octopays', 'nmge/Octopays_Logo.png');
INSERT INTO `game_type` VALUES ('275', 'untamed-wolfpack', 'Untamed-WolfPack', '野狼', '野狼', 'untamedwolfpack', 'nmge/UntamedWolfPack_Logo_Wild.jpg');
INSERT INTO `game_type` VALUES ('276', 'mugshotmadness', 'MugshotMadness', '面具007', '面具007', 'mugshotmadness', 'nmge/MugshotMadness_SquareLogo_WithBackground.jpg');
INSERT INTO `game_type` VALUES ('277', 'thelegendofolympus', 'TheLegendofOlympus', '奥林帕斯山的传说', '奧林帕斯山的傳說', 'LegendOfOlympus', 'nmge/LegendOfOlympus_Logo.png');
INSERT INTO `game_type` VALUES ('278', 'galacticons', 'Galacticons', '迷走星球', '迷走星球', 'galacticons', 'nmge/Galacticons_Logo.png');
INSERT INTO `game_type` VALUES ('279', 'piggyfortunes', 'PiggyFortunes', '三隻小猪', '三隻小豬', 'piggyfortunes', 'nmge/PiggyFortunes_Logo.png');
INSERT INTO `game_type` VALUES ('280', 'bridezilla', 'Bridezilla', '新娘瑞拉', '新娘瑞拉', 'bridezilla', 'nmge/Bridezilla_Logo.png');
INSERT INTO `game_type` VALUES ('281', 'sweetharvest', 'SweetHarvest', '大丰收', '大豐收', 'sweetharvest', 'nmge/SweetHarvest_SquareLogo_WithBackground.jpg');
INSERT INTO `game_type` VALUES ('282', 'avalonii', 'AvalonII', '阿瓦隆2', '阿瓦隆2', 'Avalon2', 'nmge/AvalonII_200x200.jpg');
INSERT INTO `game_type` VALUES ('283', 'wildcatch', 'WildCatch', '野生捕获', '野生捕獲', 'wildcatch', 'nmge/WildCatch_GameLogo.png');
INSERT INTO `game_type` VALUES ('284', 'racingforpinks', 'RacingForPinks', '为粉红而战', '為粉紅而戰', 'RacingForPinks', 'nmge/RacingForPinks_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('285', 'secretsanta', 'SecretSanta', '神秘圣诞老人', '神秘聖誕老人', 'SecretSanta', 'nmge/SecretSanta_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('286', 'paradisefound', 'ParadiseFound', '寻找天堂', '尋找天堂', 'ParadiseFound', 'nmge/ParadiseFound_GameLogo.png');
INSERT INTO `game_type` VALUES ('287', 'loosecannon', 'LooseCannon', '海盗王', '海盜王', 'LooseCannon', 'nmge/LooseCannon_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('288', 'untamed-crownedeagle', 'Untamed-CrownedEagle', '狂野之鹰', '狂野之鷹', 'UntamedCrownedEagle', 'nmge/UntamedCrownedEagle_SquareLogo_PlainBackground.jpg');
INSERT INTO `game_type` VALUES ('289', 'scaryfriends', 'ScaryFriends', '炮炮堂', '炮炮堂', 'ScaryFriends', 'nmge/ScaryFriends_Logo.png');
INSERT INTO `game_type` VALUES ('290', 'happyholidays', 'HappyHolidays', '快乐假日', '快樂假日', 'HappyHolidays', 'nmge/HappyHolidays.png');
INSERT INTO `game_type` VALUES ('291', 'somuchsushi', 'SoMuchSushi', '寿司这么多', '壽司這麼多', 'SoMuchSushi', 'nmge/SoMuchSushi_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('292', 'somanymonsters', 'SoManyMonsters', '怪物这么多', '怪物這麼多', 'SoManyMonsters', 'nmge/SoManyMonsters_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('293', 'somuchcandy', 'SoMuchCandy', '糖果这么多', '糖果這麼多', 'SoMuchCandy', 'nmge/SoMuchCandy_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('294', 'castlebuilder', 'CastleBuilder', '城堡建筑师', '城堡建築師', 'CastleBuilder', 'nmge/CastleBuilder_Logo.png');
INSERT INTO `game_type` VALUES ('295', 'maxdamage', 'MaxDamage', '最大伤害', '最大傷害', 'MaxDamageSlot', 'nmge/MaxDamage_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('296', 'penguinsplash', 'PenguinSplash', '企鹅家族', '企鵝家族', 'PenguinSplash', 'nmge/PenguinSplash_Logo.png');
INSERT INTO `game_type` VALUES ('297', 'goldenprincess', 'GoldenPrincess', '千金小姐', '千金小姐', 'GoldenPrincess', 'nmge/GoldenPrincess.png');
INSERT INTO `game_type` VALUES ('298', 'robojack', 'Robojack', '机器人杰克', '機器人杰克', 'RoboJack', 'nmge/RoboJack_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('299', 'jurassicpark', 'JurassicPark', '侏儸纪公园', '侏儸紀公園', 'JurassicPark', 'nmge/JurassicPark_250x250.jpg');
INSERT INTO `game_type` VALUES ('300', 'forsakenkingdom', 'ForsakenKingdom', '失落的国度', '失落的國度', 'ForsakenKingdom', 'nmge/ForsakenKingdom.png');
INSERT INTO `game_type` VALUES ('301', 'treasureisland', 'TreasureIsland', '金银岛', '金銀島', 'TreasureIsland', 'nmge/TreasureIsland_Logo.png');
INSERT INTO `game_type` VALUES ('302', 'pinocchio', 'Pinocchio', '木偶奇遇记', '木偶奇遇記', 'Pinocchio', 'nmge/PinocchiosFortune_Logo.jpg');
INSERT INTO `game_type` VALUES ('303', 'vikingquest', 'VikingQuest', '海盗任务', '海盜任務', 'VikingQuest', 'nmge/VikingQuest_Logo.png');
INSERT INTO `game_type` VALUES ('304', 'bigchef', 'BigChef', '大厨师', '大廚師', 'BigChef', 'nmge/BigChef_SquareLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('305', 'luckyleprechaun', 'LuckyLeprechaun', '幸运妖精', '幸運妖精', 'LuckyLeprechaun', 'nmge/LuckyLeprechaun_HorizontalLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('306', 'goldenera', 'GoldenEra', '黄金时代', '黃金時代', 'GoldenEra', 'nmge/GoldenEra.jpg');
INSERT INTO `game_type` VALUES ('307', 'dragonâ€™smyth', 'Dragonâ€™sMyth', '飞龙史密斯', '飛龍史密斯', 'DragonsMyth', 'nmge/DragonsMyth_Logo.png');
INSERT INTO `game_type` VALUES ('308', 'houndhotel', 'HoundHotel', '猎犬酒店', '獵犬酒店', 'HoundHotel', 'nmge/HoundHotel.png');
INSERT INTO `game_type` VALUES ('309', 'titansofthesun-hyperion', 'TitansoftheSun-Hyperion', '太阳神之许珀里翁', '太陽神之許珀里翁', 'titansofthesunhyperion', 'nmge/TitansOfTheSun_Hyperion_StackedLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('310', '5reel', '5Reel', '黑绵羊咩咩叫', '黑綿羊咩咩叫', 'BarBarBlackSheep5Reel', 'nmge/BarBarBlackSheep_250x250.jpg');
INSERT INTO `game_type` VALUES ('311', 'titansofthesun-theia', 'TitansoftheSun-Theia', '太阳神之忒伊亚', '太陽神之忒伊亞', 'titansofthesuntheia', 'nmge/TitansOfTheSun_Theia_00_WildLogo.png');
INSERT INTO `game_type` VALUES ('312', 'suntide', 'SunTide', '太阳征程​', '太陽征程', 'SunTide', 'nmge/SunTide_StackedLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('313', 'winsumdimsum', 'WinSumDimSum', '开心点心', '開心點心', 'winsumdimsum', 'nmge/WinSumDimSum_StackedLogo_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('314', 'stardust', 'StarDust', '星尘', '星塵', 'StarDust', 'nmge/StarDust_StackedLogo_GraphicBackground_ZH.png');
INSERT INTO `game_type` VALUES ('315', 'breakdabankagain', 'BreakdaBankAgain', '智破银行', '智破銀行', 'BreakDaBankAgain', 'nmge/BreakdaBankAgain_Logo1.jpg');
INSERT INTO `game_type` VALUES ('316', 'cashapillar', 'Cashapillar', '现金虫虫', '現金蟲蟲', 'Cashapillar', 'nmge/Cashapillar_250x250.png');
INSERT INTO `game_type` VALUES ('317', 'theratpack', 'TheRatPack', '鼠包', '鼠包', 'TheRatPack', 'nmge/TheRatPack_Logo.png');
INSERT INTO `game_type` VALUES ('318', 'stashofthetitans', 'StashoftheTitans', '泰坦帝国', '泰坦帝國', 'StashOfTheTitans', 'nmge/stashofthetitans_Mobile.png');
INSERT INTO `game_type` VALUES ('319', 'gungpow', 'GungPow', '火炮战俘', '火炮戰俘', 'GungPow', 'nmge/GungPow.jpg');
INSERT INTO `game_type` VALUES ('320', 'deckthehalls', 'DecktheHalls', '好牌大厅', '好牌大廳', 'DeckTheHalls', 'nmge/DeckTheHalls_Logo.png');
INSERT INTO `game_type` VALUES ('321', 'ladyinred', 'LadyinRed', '红衣女郎', '紅衣女郎', 'ladyinred', 'nmge/LadyInRed_Logo.png');
INSERT INTO `game_type` VALUES ('322', 'centrecourt', 'CentreCourt', '中心球场', '中心球場', 'CentreCourt', 'nmge/MPCentreCourt_SquareLogo_WithBackground.png');
INSERT INTO `game_type` VALUES ('323', 'mayanprincess', 'MayanPrincess', '玛雅公主', '瑪雅公主', 'mayanprincess', 'nmge/MayanPrincess_01_LoadingScreen_iPhone5.jpg');
INSERT INTO `game_type` VALUES ('324', 'rroldkingcole', 'RROldKingCole', '老国王科尔', '老國王科爾', 'RROldKingCole', 'nmge/RhymingReelsOldKingCole_Logo.png');
INSERT INTO `game_type` VALUES ('325', 'chiefsfortune', 'ChiefsFortune', '幸运酋长', '幸運酋長', 'ChiefsFortune', '');
INSERT INTO `game_type` VALUES ('326', 'diamonddeal', 'DiamondDeal', '钻石交易', '鑽石交易', 'DiamondDeal', 'nmge/DiamondDeal_Logo.png');
INSERT INTO `game_type` VALUES ('327', 'wasabi-san', 'Wasabi-San', '芥末先生', '芥末先生', 'WasabiSan', 'nmge/WasabiSan_Logo.png');
INSERT INTO `game_type` VALUES ('328', 'worldcupmania', 'WorldCupMania', '疯狂世界杯', '瘋狂世界杯', 'WorldCupMania', 'nmge/WorldCupMania_Logo.png');
INSERT INTO `game_type` VALUES ('329', 'cabinfever', 'CabinFever', '狂热机舱', '狂熱機艙', 'CabinFever', 'nmge/CabinFever_Logo.png');
INSERT INTO `game_type` VALUES ('330', 'elementals(errorfileformat)', 'Elementals(errorfileformat)', '元素生物', '元素生物', 'Elementals', 'nmge/Elementals_Logo.png');
INSERT INTO `game_type` VALUES ('331', 'sizzlingscorpions', 'SizzlingScorpions', '灼热蝎子', '灼熱蝎子', 'SizzlingScorpions', 'nmge/BTN_SizzlingScorpions1.png');
INSERT INTO `game_type` VALUES ('332', 'wheelofwealth', 'WheelofWealth', '财富之轮', '財富之輪', 'WheelofWealth', 'nmge/WheelOfWealthSpecialEdition_Button.png');
INSERT INTO `game_type` VALUES ('333', 'bullseye', 'BullsEye', '命运靶心', '命運靶心', 'BullsEye', 'nmge/BTN_Bullseye_Gameshow.png');
INSERT INTO `game_type` VALUES ('334', 'witcheswealth', 'WitchesWealth', '女巫财富', '女巫財富', 'WitchesWealth', 'nmge/WitchesWealth_250x250.png');
INSERT INTO `game_type` VALUES ('335', 'spectacularwheelofwealth', 'SpectacularWheelofWealth', '华丽剧场', '華麗劇場', 'spectacular', 'nmge/SpectacularWheelOfWealth1.png');
INSERT INTO `game_type` VALUES ('336', 'freespirit', 'FreeSpirit', '自由精神', '自由精神', 'FreeSpirit', 'nmge/FreeSpiritWheelOfWealth_Logo.png');
INSERT INTO `game_type` VALUES ('337', 'whatonearth', 'WhatonEarth', '征服者入侵', '征服者入侵', 'whatonearth', 'nmge/WhatOnEarth_Logo.png');
INSERT INTO `game_type` VALUES ('338', '108heroes', '108Heroes', '108好汉', '108好漢', '108Heroes', '');
INSERT INTO `game_type` VALUES ('339', 'moonshine', 'Moonshine', '空想奇谈', '空想奇談', 'moonshine', 'nmge/Moonshine_Logo.png');
INSERT INTO `game_type` VALUES ('340', 'dinomight', 'DinoMight', '迪诺魔法门', '迪諾魔法門', 'dinomight', 'nmge/DinoMight_Logo1.png');
INSERT INTO `game_type` VALUES ('341', 'loaded', 'Loaded', '幸运嘻哈', '幸運嘻哈', 'loaded', 'nmge/Loaded_HD_Logo_Horizontal_GraphicBackground.png');
INSERT INTO `game_type` VALUES ('342', 'surewin', 'SureWin', '绝对胜利', '絕對勝利', 'SureWin', 'nmge/SureWin_120x60.jpg');
INSERT INTO `game_type` VALUES ('343', 'cashville', 'Cashville', '现金威乐', '現金威樂', 'cashville', 'nmge/Cashville_Logo.png');
INSERT INTO `game_type` VALUES ('344', 'pollennation', 'PollenNation', '蜜蜂乐园', '蜜蜂樂園', 'pollennation', 'nmge/PollenNation_250x250.png');
INSERT INTO `game_type` VALUES ('345', 'giftrap', 'GiftRap', '饶舌礼物', '饒舌禮物', 'giftrap', 'nmge/GiftRap_Logo.png');
INSERT INTO `game_type` VALUES ('346', 'halloweenies', 'Halloweenies', '万圣节怪谈', '萬聖節怪談', 'Halloweenies', 'nmge/Halloweenies_Button.png');
INSERT INTO `game_type` VALUES ('347', 'dogfather', 'Dogfather', '狗爸爸', '狗爸爸', 'Dogfather', 'nmge/DogFather.png');
INSERT INTO `game_type` VALUES ('348', 'madhatters', 'MadHatters', '疯狂帽匠', '瘋狂帽匠', 'madhatters', 'nmge/MadHatters_GameButton.png');
INSERT INTO `game_type` VALUES ('349', 'cashanova', 'Cashanova', '现金新星', '現金新星', 'Cashanova', 'nmge/Cashanova_Logo.png');
INSERT INTO `game_type` VALUES ('350', 'wheelofwealthspecialedition', 'WheelofWealthSpecialEdition', '特别版财富巨轮', '特別版財富巨輪', 'wheelofwealthse', 'nmge/WheelOfWealthSpecialEdition.png');
INSERT INTO `game_type` VALUES ('351', 'bars&stripes', 'Bars&Stripes', '酒吧和条纹', '酒吧和條紋', 'BarsAndStripes', 'nmge/Bars&Stripes_HiDef.png');
INSERT INTO `game_type` VALUES ('352', 'starscape', 'Starscape', '星光斗篷', '星光斗篷', 'starscape', 'nmge/BTN_StarScape1.png');
INSERT INTO `game_type` VALUES ('353', 'magicspell', 'MagicSpell', '魔法咒语', '魔法咒語', 'MagicSpell', 'nmge/MagicSpell_Logo.png');
INSERT INTO `game_type` VALUES ('354', 'primeproperty', 'PrimeProperty', '豪宅', '豪宅', 'PrimeProperty', 'nmge/PrimeProperty_Logo.png');
INSERT INTO `game_type` VALUES ('355', '3empires', '3Empires', '3帝国', '3帝國', '3Empires', '');
INSERT INTO `game_type` VALUES ('356', 'hitman', 'Hitman', '终极杀手', '終極殺手', 'rubyhitman', 'nmge/Hitman.jpg');
INSERT INTO `game_type` VALUES ('357', 'tombraidersecretofthesword', 'TombRaiderSecretoftheSword', '古墓丽影之神剑的秘密', '古墓麗影之神劍的秘密', 'TombRaiderII', 'nmge/TombRaider_250x250.png');
INSERT INTO `game_type` VALUES ('358', 'bigbreak', 'BigBreak', '重大突破', '重大突破', 'BigBreak', 'nmge/BigBreak_SC_Logo.png');
INSERT INTO `game_type` VALUES ('359', 'bigkahuna-snakesandladders', 'BigKahuna-SnakesandLadders', '大胡纳-青蛇与梯子', '大胡納-青蛇與梯子', 'BigKahunaSnakesAndLadders', 'nmge/BigKahunaSnakesAndLadders_250x250.png');
INSERT INTO `game_type` VALUES ('360', 'fatladysings', 'FatLadySings', '丰满歌手', '豐滿歌手', 'fatladysings', 'nmge/FatLadySings_Logo.png');
INSERT INTO `game_type` VALUES ('361', 'scrooge', 'Scrooge', '守财奴隶', '守財奴隸', 'Scrooge', 'nmge/Scrooge_Logo.png');
INSERT INTO `game_type` VALUES ('362', 'jewelsoftheorient', 'JewelsoftheOrient', '东方之珠', '東方之珠', 'jewelsoftheorient', 'nmge/JewelsOfTheOrient_Logo.png');
INSERT INTO `game_type` VALUES ('363', 'arcticfortune', 'ArcticFortune', '北极祕宝', '北極祕寶', 'ArcticFortune', 'nmge/ArcticFortune_Logo.png');
INSERT INTO `game_type` VALUES ('364', 'bullseyegameshow', 'BullseyeGameshow', '正中红心', '正中紅心', 'BullseyeGameshow', 'nmge/BTN_Bullseye_Gameshow.png');
INSERT INTO `game_type` VALUES ('365', 'hellboy', 'Hellboy', '地狱男爵', '地獄男爵', 'HellBoy', 'nmge/Hellboy_LOGO.jpg');
INSERT INTO `game_type` VALUES ('366', 'thunderstruckii-highlimit', 'ThunderstruckII-HighLimit', '雷神2-高级版', '雷神2-高級版', 'ThunderStruck2HighLimit', 'nmge/TSII_Thor_1024x768.jpg');
INSERT INTO `game_type` VALUES ('367', 'soccersafari', 'SoccerSafari', '足球乐园', '足球樂園', 'SoccerSafari', 'nmge/SoccerSafari_250x250.png');
INSERT INTO `game_type` VALUES ('368', 'throneofegypt', 'ThroneofEgypt', '埃及王朝', '埃及王朝', 'throneofegypt', 'nmge/ThroneOfEgypt_Logo.png');
INSERT INTO `game_type` VALUES ('369', 'goldfactory-highlimit', 'GoldFactory-HighLimit', '黄金工场-高级版', '黃金工場-高級版', 'GoldFactoryHighLimit', 'nmge/GoldFactory_Logo.png');
INSERT INTO `game_type` VALUES ('370', 'steampunkheroes', 'SteamPunkHeroes', '蒸汽朋克英雄', '蒸汽朋克英雄', 'steampunkheroes', 'nmge/SteamPunkHeroes_Logo.png');
INSERT INTO `game_type` VALUES ('371', 'chainmailnew', 'ChainMailNew', '锁子甲', '鎖子甲', 'ChainMailNew', 'nmge/ChainMail.png');
INSERT INTO `game_type` VALUES ('372', 'irisheyes', 'IrishEyes', '爱尔兰之眼', '愛爾蘭之眼', 'irisheyes', 'nmge/IrishEyes_Belly.png');
INSERT INTO `game_type` VALUES ('373', 'crocodopolis', 'Crocodopolis', '魔鳄大帝', '魔鱷大帝', 'crocodopolis', 'nmge/Crocodopolis_Logo.png');
INSERT INTO `game_type` VALUES ('374', 'doctorlove', 'DoctorLove', '爱情医生', '愛情醫生', 'doctorlove', 'nmge/DoctorLove_Belly.png');
INSERT INTO `game_type` VALUES ('375', 'ramessesriches', 'RamessesRiches', '拉美西斯宝藏', '拉美西斯寶藏', 'ramessesriches', 'nmge/RamessesRiches_Button.png');
INSERT INTO `game_type` VALUES ('376', 'maxdamage', 'MaxDamage', '最大伤害与外星人袭击', '最大傷害與外星人襲擊', 'maxdamage', 'nmge/MaxDamage_SquareLogo_GraphicBackground.jpg');
INSERT INTO `game_type` VALUES ('377', 'jacksorbetter', 'JacksorBetter', '对J高手5PK(多组牌)', '對J高手5PK(多組牌)', 'jackspwrpoker', 'nmge/JacksorBetterPowerPoker1.png');
INSERT INTO `game_type` VALUES ('378', 'deuceswild', 'DeucesWild', '百搭二王(多组)', '百搭二王(多組)', 'deuceswildpwrpoker', 'nmge/DeucesWildPowerPoker1.png');
INSERT INTO `game_type` VALUES ('379', 'jokerpoker', 'JokerPoker', '小丑扑克', '小丑撲克', 'jokerpwrpoker', 'nmge/JokerPokerPowerPoker1.png');
INSERT INTO `game_type` VALUES ('380', 'doublejoker', 'DoubleJoker', '小丑百搭5PK(多组牌)', '小丑百搭5PK(多組牌)', 'DoubleJokerPwrPoker', 'nmge/DoubleJokerPowerPoker1.png');
INSERT INTO `game_type` VALUES ('381', 'deuces&joker', 'Deuces&Joker', '百搭二王与小丑(多组)', '百搭二王與小丑(多組)', 'DeucesJokerPwrPoker', 'nmge/DeucesJokerPowerPoker1.png');
INSERT INTO `game_type` VALUES ('382', 'aces&faces', 'Aces&Faces', '经典5PK(多组牌)', '經典5PK(多組牌)', 'acesfacespwrpoker', 'nmge/Aces&Faces.png');
INSERT INTO `game_type` VALUES ('383', 'tensorbetter', 'TensorBetter', '对十天王5PK(多組牌)', '對十天王5PK(多組牌)', 'tensorbetterpwrpoker', 'nmge/TensOrBetter4PlayPowerPoker_Button.png');
INSERT INTO `game_type` VALUES ('384', 'moneymadmonkey', 'MoneyMadMonkey', '疯狂猴子', '瘋狂猴子', 'MoneyMadMonkey', 'nmge/MoneyMadMonkey_SmallLogo.png');
INSERT INTO `game_type` VALUES ('385', 'kingarthur', 'KingArthur', '亚瑟王', '亞瑟王', 'KingArthur', 'nmge/KingArthur_Logo.png');
INSERT INTO `game_type` VALUES ('386', 'aroundtheworld', 'AroundtheWorld', '环游世界', '環遊世界', 'AroundTheWorld', 'nmge/AroundTheWorld.png');
INSERT INTO `game_type` VALUES ('387', 'pubfruity', 'PubFruity', '酒吧果味', '果味酒吧', 'pubfruity', 'nmge/PubFruity_Logo.png');
INSERT INTO `game_type` VALUES ('388', 'spooksandladders', 'SpooksandLadders', '妖怪屋', '妖怪屋', 'SpooksAndLadders', 'nmge/Spooks&Ladders_Logo.png');
INSERT INTO `game_type` VALUES ('389', 'magnificentsevens', 'MagnificentSevens', '华丽七人榄球', '華麗七人欖球', 'MagnificentSevens', 'nmge/MagnificentSevens_Logo.png');
INSERT INTO `game_type` VALUES ('390', 'spinmagic', 'SpinMagic', '魔法回旋', '魔法迴旋', 'SpinMagic', 'nmge/SpinMagic_Logo.png');
INSERT INTO `game_type` VALUES ('391', 'wheelofriches', 'WheelOfRiches', '巨轮财富', '巨輪財富', 'WheelOfRiches', 'nmge/WheelOfWealth1_Button.png');
INSERT INTO `game_type` VALUES ('392', 'premierracing', 'PremierRacing', '超级赛马', '超級賽馬', 'premierracing', 'nmge/PremierRacing_Logo.png');
INSERT INTO `game_type` VALUES ('393', 'premiertrotting', 'PremierTrotting', '快步马驾车赛', '快步馬駕車賽', 'premiertrotting', 'nmge/PremierTrotting_logo.png');
INSERT INTO `game_type` VALUES ('394', 'dawnofthebread', 'DawnoftheBread', '面包黎明', '麵包黎明', 'DawnOfTheBread', 'nmge/DawnOfTheBread_Logo.png');
INSERT INTO `game_type` VALUES ('395', 'freezingfuzzballs', 'FreezingFuzzballs', '急冻天地', '急凍天地', 'FreezingFuzzballs', 'nmge/FreezingFuzzballs_Logo.png');
INSERT INTO `game_type` VALUES ('396', 'wildchampions', 'WildChampions', '野性冠军', '野性冠軍', 'WildChampions', 'nmge/WildChampions_Logo.png');
INSERT INTO `game_type` VALUES ('397', 'superzeroes', 'SuperZeroes', '超级零点', '超級零點', 'SuperZeroes', 'nmge/SuperZeroes_Logo.png');
INSERT INTO `game_type` VALUES ('398', 'cashapillar', 'Cashapillar', '现金虫虫', '現金蟲蟲', 'IWCashapillar', 'nmge/Cashapillar_250x250.png');
INSERT INTO `game_type` VALUES ('399', 'bigbreak', 'BigBreak', '雷霆破晓', '雷霆破曉', 'IWBigBreak', 'nmge/BigBreak_SC_Logo_GraphicBkg.png');
INSERT INTO `game_type` VALUES ('400', 'superzeroes', 'SuperZeroes', '刮刮乐玩家', '刮刮樂玩家', 'IWCardSelector', 'nmge/SuperZeroes_Logo.png');
INSERT INTO `game_type` VALUES ('401', 'grannyprix', 'GrannyPrix', '大奖赛老太', '大獎賽老太', 'GrannyPrix', 'nmge/GrannyPrix_Logo.png');
INSERT INTO `game_type` VALUES ('402', 'dragonsfortune', 'DragonsFortune', '龙的财富', '龍的財富', 'DragonsFortune', '');
INSERT INTO `game_type` VALUES ('403', 'slamfunk', 'SlamFunk', '大满贯芬克', '大滿貫芬克', 'SlamFunk', 'nmge/SlamFunk_Logo.png');
INSERT INTO `game_type` VALUES ('404', 'halloweenies', 'Halloweenies', '选择与交换', '萬聖節怪談', 'IWHalloweenies', 'nmge/Halloweenies_Mobile.png');
INSERT INTO `game_type` VALUES ('405', 'bunnyboiler', 'BunnyBoiler', '兔子锅炉', '兔子鍋爐', 'BunnyBoiler', 'nmge/BunnyBoiler_Button.png');
INSERT INTO `game_type` VALUES ('406', 'mumbaimagic', 'MumbaiMagic', '孟买魔术', '孟買魔術', 'MumbaiMagic', 'nmge/MumbaiMagic_Logo.png');
INSERT INTO `game_type` VALUES ('407', 'bingobonanza', 'BingoBonanza', '宾果富矿', '賓果富礦', 'BingoBonanza', 'nmge/BingoBonanza_Logo.png');
INSERT INTO `game_type` VALUES ('408', 'goldenghouls', 'GoldenGhouls', '黄金盗墓者', '黃金盜墓者', 'GoldenGhouls', 'nmge/GoldenGhouls_Logo.png');
INSERT INTO `game_type` VALUES ('409', 'ballisticbingo', 'BallisticBingo', '弹道宾果', '彈道賓果', 'BallisticBingo', 'nmge/BallisticBingo1.png');
INSERT INTO `game_type` VALUES ('410', 'superbonusbingo', 'SuperBonusBingo', '超级红利宾果', '超級紅利賓果', 'SuperBonusBingo', 'nmge/SuperBonusBingo_Logo.jpg');
INSERT INTO `game_type` VALUES ('411', 'luckynumbers', 'LuckyNumbers', '幸运数字', '幸運數字', 'LuckyNumbers', 'nmge/LuckyNumbers_Logo.png');
INSERT INTO `game_type` VALUES ('412', 'hairyfairies', 'HairyFairies', '毛绒仙女', '毛茸仙女', 'HairyFairies', 'nmge/HairyFairies_Logo.png');
INSERT INTO `game_type` VALUES ('413', 'cryptcrusade', 'CryptCrusade', '地穴远征', '地穴遠征', 'CryptCrusade', 'nmge/CryptCrusade_Logo.png');
INSERT INTO `game_type` VALUES ('414', 'six-shooterlooter', 'Six-ShooterLooter', '六掠夺射手', '六掠奪射手', 'SixShooterLooter', 'nmge/SixShooterLooter_Logo.png');
INSERT INTO `game_type` VALUES ('415', 'beerfest', 'BeerFest', '啤酒巨星', '啤酒巨星', 'BeerFest', 'nmge/BeerFest.png');
INSERT INTO `game_type` VALUES ('416', 'pharaohsgems', 'PharaohsGems', '法老的宝石', '法老的寶石', 'PharaohsGems', 'nmge/PharaohsGems1.png');
INSERT INTO `game_type` VALUES ('417', 'foamyfortunes', 'FoamyFortunes', '泡沫财富', '泡沫財富', 'FoamyFortunes', 'nmge/FoamyFortunes_Logo.png');
INSERT INTO `game_type` VALUES ('418', 'plunderthesea', 'PlundertheSea', '掠夺大海', '掠奪大海', 'PlunderTheSea', 'nmge/PlunderTheSea_Logo.png');
INSERT INTO `game_type` VALUES ('419', 'spaceevader', 'SpaceEvader', '太空入侵者', '太空入侵者', 'SpaceEvader', 'nmge/SpaceEvader_Logo.png');
INSERT INTO `game_type` VALUES ('420', 'bowledover', 'BowledOver', '击倒', '擊倒', 'BowledOver', 'nmge/BowledOver_Logo.png');
INSERT INTO `game_type` VALUES ('421', 'offsideandseek', 'OffsideandSeek', '越位和寻求', '越位和尋求', 'OffsideAndSeek', 'nmge/Offside&Seek_Logo.png');
INSERT INTO `game_type` VALUES ('422', 'turtleyawesome', 'TurtleyAwesome', '一级棒', '一級棒', 'TurtleyAwesome', 'nmge/TurtleyAwesome_Logo.png');
INSERT INTO `game_type` VALUES ('423', 'gamesetandscratch', 'GameSetandScratch', '网球王', '網球王', 'GameSetAndScratch', 'nmge/GameSet&Scratch_Logo.png');
INSERT INTO `game_type` VALUES ('424', 'whack-a-jackpot', 'Whack-a-Jackpot', '捶A-大奖', '捶A-大獎', 'WhackAJackpot', 'nmge/WhackAJackpot_Logo.png');
INSERT INTO `game_type` VALUES ('425', 'handtohandcombat', 'HandtoHandCombat', '肉搏战', '肉搏戰', 'HandToHandCombat', 'nmge/HandToHandCombat.png');
INSERT INTO `game_type` VALUES ('426', 'kashatoa', 'Kashatoa', '火山弹珠台', '火山彈珠台', 'Kashatoa', 'nmge/Kashatoa1.png');
INSERT INTO `game_type` VALUES ('427', 'cardclimber', 'CardClimber', '卡登山', '卡登山', 'CardClimber', 'nmge/CardClimber_Logo_Small.png');
INSERT INTO `game_type` VALUES ('428', 'killerclubs', 'KillerClubs', '杀手俱乐部', '殺手俱樂部', 'KillerClubs', 'nmge/KillerClubs1.png');
INSERT INTO `game_type` VALUES ('429', 'bunnyboilergold', 'BunnyBoilerGold', '黄金兔子锅炉', '黃金兔子鍋爐', 'BunnyBoilerGold', 'nmge/BunnyBoilerGold_Logo.png');
INSERT INTO `game_type` VALUES ('430', 'sixshooterlootergold', 'SixShooterLooterGold', '黄金六掠夺射手', '黃金六掠奪射手', 'SixShooterLooterGold', 'nmge/SixShooterLooter_Logo.png');
INSERT INTO `game_type` VALUES ('431', 'spaceevadergold', 'SpaceEvaderGold', '黄金太空入侵者', '黃金太空入侵者', 'SpaceEvaderGold', 'nmge/SpaceEvader_Logo.png');
INSERT INTO `game_type` VALUES ('432', 'cryptcrusadegold', 'CryptCrusadeGold', '黄金地穴远征', '黃金地穴遠征', 'CryptCrusadeGold', 'nmge/CryptCrusade_Logo.png');
INSERT INTO `game_type` VALUES ('433', 'picknswitch', 'PicknSwitch', '选择与交换', '選擇與交換', 'picknswitch', 'nmge/PickNSwitch_Logo.png');
INSERT INTO `game_type` VALUES ('434', 'enchantedwoods', 'EnchantedWoods', '魔法森林', '魔法森林', 'enchantedwoods', 'nmge/EnchantedWoods_Logo.png');
INSERT INTO `game_type` VALUES ('435', 'crownandanchor', 'CrownandAnchor', '皇冠骰子', '皇冠骰子', 'crownandanchor', 'nmge/Crown&Anchor_Logo.png');
INSERT INTO `game_type` VALUES ('436', 'germinator', 'Germinator', '细菌对对碰', '細菌對對碰', 'germinator', 'nmge/BTN_Germinator.png');
INSERT INTO `game_type` VALUES ('437', 'spingo', 'Spingo', '义大利轮盘', '義大利輪盤', 'spingo', 'nmge/Spingo_Logo.png');
INSERT INTO `game_type` VALUES ('438', 'pharaohbingoweb', 'PharaohBingoWeb', '法老宾果', '法老賓果', 'pharaohbingo', 'nmge/PharaohBingo_Logo_2.png');
INSERT INTO `game_type` VALUES ('439', 'sambabingoweb', 'SambaBingoWeb', '森巴宾果', '森巴賓果', 'sambabingo', 'nmge/SambaBingo_Logo.png');
INSERT INTO `game_type` VALUES ('440', 'mayanbingoweb', 'MayanBingoWeb', '玛雅宾果', '瑪雅賓果', 'mayanbingo', 'nmge/MayanBingo_Icon2.png');
INSERT INTO `game_type` VALUES ('441', 'electrobingoweb', 'ElectroBingoWeb', '电子宾果', '電子賓果', 'electrobingo', 'nmge/ElectroBingo_Logo.png');
INSERT INTO `game_type` VALUES ('442', 'fourbyfour', 'FourByFour', '四中四', '四中四', 'fourbyfour', 'nmge/FourByFour_Button.png');
INSERT INTO `game_type` VALUES ('443', 'hexaline', 'Hexaline', '彩色蜂窝', '彩色蜂窩', 'hexaline', 'nmge/Hexaline_Logo.png');
INSERT INTO `game_type` VALUES ('444', 'triangulation', 'Triangulation', '彩色三角', '彩色三角', 'triangulation', 'nmge/Triangulation_Logo.jpg');

-- ----------------------------
-- Table structure for `hacker`
-- ----------------------------
DROP TABLE IF EXISTS `hacker`;
CREATE TABLE `hacker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hacker
-- ----------------------------

-- ----------------------------
-- Table structure for `history_bank`
-- ----------------------------
DROP TABLE IF EXISTS `history_bank`;
CREATE TABLE `history_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `pay_card` varchar(45) NOT NULL,
  `pay_num` varchar(20) NOT NULL,
  `pay_address` varchar(45) NOT NULL,
  `pay_name` varchar(20) NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1012 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of history_bank
-- ----------------------------

-- ----------------------------
-- Table structure for `history_login`
-- ----------------------------
DROP TABLE IF EXISTS `history_login`;
CREATE TABLE `history_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `username` varchar(45) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `www` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `ip` (`ip`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=7999 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of history_login
-- ----------------------------

-- ----------------------------
-- Table structure for `hots`
-- ----------------------------
DROP TABLE IF EXISTS `hots`;
CREATE TABLE `hots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `ok` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hots
-- ----------------------------

-- ----------------------------
-- Table structure for `k_bet`
-- ----------------------------
DROP TABLE IF EXISTS `k_bet`;
CREATE TABLE `k_bet` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键编号',
  `user_id` int(11) NOT NULL COMMENT '下注者',
  `order_num` varchar(50) DEFAULT NULL COMMENT '单编号注',
  `ball_sort` varchar(10) DEFAULT NULL COMMENT '球类种类，足球，篮球',
  `point_column` varchar(20) DEFAULT NULL COMMENT '下注赔率字段',
  `match_name` varchar(100) DEFAULT NULL COMMENT '联赛名',
  `master_guest` varchar(100) DEFAULT NULL COMMENT '主客队',
  `match_id` varchar(20) DEFAULT NULL COMMENT '联赛ID',
  `bet_info` varchar(100) DEFAULT NULL COMMENT '下注详细信息',
  `match_showtype` varchar(5) DEFAULT NULL COMMENT '让球类型',
  `match_rgg` varchar(10) DEFAULT NULL COMMENT '让球数',
  `match_dxgg` varchar(10) DEFAULT NULL COMMENT '大小盘口',
  `match_nowscore` varchar(5) DEFAULT NULL COMMENT '当前比分',
  `match_type` int(1) DEFAULT NULL COMMENT '下注球赛类型',
  `bet_money` decimal(8,2) DEFAULT NULL COMMENT '下注金额',
  `ben_add` int(1) DEFAULT NULL,
  `bet_point` float DEFAULT NULL COMMENT '赔率',
  `bet_win` decimal(12,2) DEFAULT NULL COMMENT '最高赢后金额',
  `win` decimal(12,2) DEFAULT '0.00' COMMENT '已赢',
  `bet_time` datetime DEFAULT NULL COMMENT '下注时间(北京时间)',
  `bet_time_et` datetime DEFAULT NULL COMMENT '下注时间(美东时间)',
  `match_time` varchar(20) DEFAULT NULL COMMENT '比赛日期 或者 滚球进行时间',
  `match_endtime` datetime DEFAULT NULL COMMENT '封盘时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态，0代表未处理，1代表赢，2输，3代表取消,4赢一半,5输一半,6进球无效,7红卡无效,8和局',
  `lose_ok` int(1) NOT NULL DEFAULT '1' COMMENT '是否需要确认',
  `update_time` datetime DEFAULT NULL COMMENT '注单处理时间',
  `sys_about` varchar(200) DEFAULT '' COMMENT '注单无效的原因',
  `MB_Inball` varchar(30) DEFAULT NULL COMMENT '主进球',
  `TG_Inball` varchar(30) DEFAULT NULL COMMENT '客队进球',
  `balance` decimal(12,2) NOT NULL COMMENT '会员当前余额',
  `Match_HRedCard` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '队主红牌数',
  `Match_GRedCard` int(1) unsigned NOT NULL DEFAULT '0',
  `assets` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '下注前金额',
  `ip` varchar(20) DEFAULT NULL COMMENT '下注客户IP',
  `www` varchar(50) DEFAULT NULL,
  `match_coverdate` datetime DEFAULT NULL,
  `fs` decimal(8,2) NOT NULL DEFAULT '0.00',
  `check` int(1) NOT NULL DEFAULT '0' COMMENT '否是结算，1统系自动结算，2手工结算，0未结算',
  `bet_yx` decimal(8,2) DEFAULT '0.00' COMMENT '有效金额',
  `bet_reb` float DEFAULT '0' COMMENT '点返比例',
  `game_type` varchar(10) DEFAULT NULL COMMENT '冠军类型FT=足球冠军',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `match_id` (`match_id`),
  KEY `match_name` (`match_name`),
  KEY `match_type` (`match_type`),
  KEY `bet_time` (`bet_time`),
  KEY `lose_ok` (`lose_ok`),
  KEY `match_coverdate` (`match_coverdate`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3663 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='所有下注记录';

-- ----------------------------
-- Records of k_bet
-- ----------------------------

-- ----------------------------
-- Table structure for `k_bet_cg`
-- ----------------------------
DROP TABLE IF EXISTS `k_bet_cg`;
CREATE TABLE `k_bet_cg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键编号',
  `gid` int(11) DEFAULT NULL COMMENT '串关编号',
  `user_id` int(11) NOT NULL COMMENT '下注者',
  `ball_sort` varchar(10) DEFAULT NULL COMMENT '球类种类，足球，篮球',
  `point_column` varchar(20) DEFAULT NULL COMMENT '下注赔率字段',
  `match_name` varchar(100) DEFAULT NULL COMMENT '联赛名',
  `master_guest` varchar(100) DEFAULT NULL COMMENT '主客队',
  `match_id` varchar(20) DEFAULT NULL COMMENT '联赛ID',
  `bet_info` varchar(100) DEFAULT NULL COMMENT '下注详细信息',
  `bet_money` decimal(8,2) DEFAULT NULL COMMENT '下注金额',
  `bet_point` float DEFAULT NULL COMMENT '赔率',
  `ben_add` int(1) DEFAULT NULL COMMENT '是否带本金',
  `bet_time` datetime DEFAULT NULL COMMENT '下注时间',
  `bet_time_et` datetime DEFAULT NULL,
  `match_endtime` datetime DEFAULT NULL COMMENT '封盘时间',
  `match_showtype` varchar(10) DEFAULT NULL,
  `match_rgg` varchar(10) DEFAULT NULL,
  `match_dxgg` varchar(10) DEFAULT NULL,
  `match_nowscore` varchar(10) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态，0代表未处理，1代表赢，2输，3代表取消',
  `update_time` datetime DEFAULT NULL COMMENT '注单处理时间',
  `sys_about` varchar(200) DEFAULT NULL COMMENT '注单无效的原因',
  `MB_Inball` varchar(11) DEFAULT NULL COMMENT '主进球',
  `TG_Inball` varchar(11) DEFAULT NULL COMMENT '客队进球',
  `check` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`user_id`),
  KEY `gid` (`gid`),
  KEY `match_id` (`match_id`),
  KEY `match_name` (`match_name`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=326 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of k_bet_cg
-- ----------------------------

-- ----------------------------
-- Table structure for `k_bet_cg_group`
-- ----------------------------
DROP TABLE IF EXISTS `k_bet_cg_group`;
CREATE TABLE `k_bet_cg_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `cg_count` int(6) NOT NULL,
  `bet_money` decimal(8,2) NOT NULL,
  `win` decimal(12,2) DEFAULT '0.00',
  `bet_win` decimal(12,2) DEFAULT NULL COMMENT '可赢',
  `bet_time` datetime DEFAULT NULL,
  `bet_time_et` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '0' COMMENT '状态，0未结算，1已经结算,2输,3平手或无效',
  `update_time` datetime DEFAULT NULL COMMENT '审核时间',
  `balance` decimal(12,2) NOT NULL COMMENT '会员当前余额',
  `assets` decimal(12,2) NOT NULL DEFAULT '0.00',
  `ip` varchar(20) DEFAULT NULL,
  `www` varchar(50) DEFAULT NULL,
  `match_coverdate` datetime DEFAULT NULL,
  `fs` decimal(8,2) NOT NULL DEFAULT '0.00',
  `bet_reb` float DEFAULT '0',
  `check` int(1) NOT NULL DEFAULT '0' COMMENT '否是结算，1是，0否',
  `bet_yx` decimal(8,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `uid` (`user_id`),
  KEY `status` (`status`),
  KEY `match_coverdate` (`match_coverdate`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='串关组';

-- ----------------------------
-- Records of k_bet_cg_group
-- ----------------------------

-- ----------------------------
-- Table structure for `k_notice`
-- ----------------------------
DROP TABLE IF EXISTS `k_notice`;
CREATE TABLE `k_notice` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) NOT NULL,
  `is_show` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '类别ID',
  `end_time` datetime NOT NULL COMMENT '有效时间',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sort` int(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`nid`),
  KEY `end_time` (`end_time`)
) ENGINE=MyISAM AUTO_INCREMENT=2172 DEFAULT CHARSET=utf8 COMMENT='网站公告表';

-- ----------------------------
-- Records of k_notice
-- ----------------------------

-- ----------------------------
-- Table structure for `live_config`
-- ----------------------------
DROP TABLE IF EXISTS `live_config`;
CREATE TABLE `live_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `hall_name` varchar(50) NOT NULL COMMENT '厅名',
  `cagent` varchar(50) NOT NULL COMMENT '代理标识',
  `game_type` tinyint(2) unsigned NOT NULL COMMENT '真人游戏类型，参照接口文档',
  `e_game_type` tinyint(2) unsigned NOT NULL COMMENT '电子游艺-游戏类型',
  `live_type` varchar(50) NOT NULL COMMENT '真人标识',
  `deposit_name` varchar(50) NOT NULL COMMENT '存款标识，如''IN''、''DEPOSIT''',
  `withdraw_name` varchar(50) NOT NULL COMMENT '取款标识，如''OUT''、''WITHDRAW''',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '状态: -1 删除 0 禁用 1 启用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hall_name` (`hall_name`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='真人配置表';

-- ----------------------------
-- Records of live_config
-- ----------------------------
INSERT INTO `live_config` VALUES ('1', '0', 'AG', '', '0', '0', 'AG', 'IN', 'OUT', '0');
INSERT INTO `live_config` VALUES ('2', '0', 'DS', 'G05_DS', '0', '0', 'DS', 'DEPOSIT', 'WITHDRAW', '1');
INSERT INTO `live_config` VALUES ('3', '1', 'AG_JS', 'G05_AG', '1', '1', 'AG', 'IN', 'OUT', '1');
INSERT INTO `live_config` VALUES ('4', '1', 'AG_GJ', 'G05_AGIN', '2', '8', 'AGIN', 'IN', 'OUT', '1');
INSERT INTO `live_config` VALUES ('5', '1', 'AG_BBIN', 'G05_BBIN', '1', '1', 'AG_BBIN', 'IN', 'OUT', '1');
INSERT INTO `live_config` VALUES ('6', '1', 'AG_OG', 'G05_OG', '1', '1', 'AG_OG', 'IN', 'OUT', '1');
INSERT INTO `live_config` VALUES ('7', '1', 'AG_MG', 'G05_NMGE', '0', '2', 'AG_MG', 'IN', 'OUT', '1');

-- ----------------------------
-- Table structure for `live_fs_list`
-- ----------------------------
DROP TABLE IF EXISTS `live_fs_list`;
CREATE TABLE `live_fs_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) NOT NULL,
  `USERNAME_LIVE` varchar(50) NOT NULL,
  `VALIDMONEY` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '有效金额',
  `FSMONEY` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '反水金额',
  `ADDTIME` datetime DEFAULT NULL COMMENT '增加日期',
  `FSTIME` datetime DEFAULT NULL COMMENT '反水日期',
  `FS_RATE` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '反水比例',
  `live_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FS_LIST_MIX` (`USERNAME_LIVE`,`FSTIME`)
) ENGINE=MyISAM AUTO_INCREMENT=1007 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_fs_list
-- ----------------------------

-- ----------------------------
-- Table structure for `live_log`
-- ----------------------------
DROP TABLE IF EXISTS `live_log`;
CREATE TABLE `live_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(50) NOT NULL COMMENT '订单号',
  `live_type` varchar(10) NOT NULL DEFAULT '' COMMENT '人真娱乐场游戏类型如 AG,HG',
  `zz_type` varchar(10) NOT NULL DEFAULT '' COMMENT '账转类型，如果转入或转出 d，w',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `live_username` varchar(20) NOT NULL DEFAULT '' COMMENT '乐场娱中的用户名',
  `zz_money` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '账转金额',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态0未实行，1已执行',
  `result` varchar(255) DEFAULT '' COMMENT '行执结果反馈',
  `add_time` datetime DEFAULT NULL COMMENT '订单提交时间',
  `do_time` datetime DEFAULT NULL COMMENT '订单执行时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5466 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_log
-- ----------------------------

-- ----------------------------
-- Table structure for `live_order`
-- ----------------------------
DROP TABLE IF EXISTS `live_order`;
CREATE TABLE `live_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `live_username` varchar(50) DEFAULT NULL,
  `order_num` varchar(32) NOT NULL COMMENT '投注编号，也就是注单号',
  `order_time` datetime DEFAULT NULL COMMENT '投注日期',
  `live_th` varchar(20) NOT NULL COMMENT '台号',
  `live_type` varchar(50) DEFAULT NULL COMMENT '类型',
  `live_office` varchar(50) DEFAULT NULL COMMENT '局号',
  `office_num` varchar(20) DEFAULT NULL COMMENT '局数',
  `live_result` varchar(100) DEFAULT NULL COMMENT '结果',
  `bet_info` varchar(100) DEFAULT NULL COMMENT '投注内容',
  `bet_money` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '投注金额',
  `live_win` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '赢输金额',
  `ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `live_status` varchar(20) DEFAULT NULL COMMENT '状态',
  `game_room` varchar(20) DEFAULT NULL COMMENT '游戏厅',
  `game_type` varchar(20) NOT NULL DEFAULT 'AG' COMMENT 'AG   太阳城',
  `valid_bet_amount` decimal(9,2) DEFAULT NULL,
  `balanceAfter` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_num` (`order_num`)
) ENGINE=MyISAM AUTO_INCREMENT=326260 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_order
-- ----------------------------

-- ----------------------------
-- Table structure for `live_rpc_config`
-- ----------------------------
DROP TABLE IF EXISTS `live_rpc_config`;
CREATE TABLE `live_rpc_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `live_name_prefix` varchar(30) NOT NULL COMMENT '会员名称前缀',
  `rpc_client_name` varchar(100) NOT NULL COMMENT 'rpc客户端标识',
  `rpc_server_folder` varchar(100) NOT NULL COMMENT 'rpc服务端文件夹名称',
  `rpc_server_domain` varchar(100) NOT NULL COMMENT 'rpc服务端域名',
  `ag_server_class` varchar(250) NOT NULL COMMENT 'ag server类',
  `ds_server_class` varchar(250) NOT NULL COMMENT 'ds server类',
  `sys_server_class` varchar(250) NOT NULL COMMENT 'sys server类',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '状态: -1 删除 0 禁用 1 启用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rpc_client_name` (`rpc_client_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='真人rpc配置表';

-- ----------------------------
-- Records of live_rpc_config
-- ----------------------------
INSERT INTO `live_rpc_config` VALUES ('1', 'g05017', 'y12708101052', 'y12708101052.com', '182.16.6.158', '/RpcCenter/Server/server1/Service/live/AgServer.php', '/RpcCenter/Server/server1/Service/live/DsServer.php', '/RpcCenter/Auth/AdminServer.php', '1');

-- ----------------------------
-- Table structure for `live_user`
-- ----------------------------
DROP TABLE IF EXISTS `live_user`;
CREATE TABLE `live_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `live_type` varchar(10) NOT NULL DEFAULT '' COMMENT '人真娱乐场游戏类型如 AG,HG',
  `live_username` varchar(20) NOT NULL COMMENT '娱乐场中的用户名',
  `live_password` varchar(32) NOT NULL COMMENT '娱乐场用户密码',
  `live_money` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '乐场娱中的用户金额类型A，如AG中的普通厅',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `oddlists` varchar(5) DEFAULT 'A' COMMENT 'AG盘口',
  `live_bet_money` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '投注金额',
  `live_win_money` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '盈利金额',
  `fs_rate` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '反水比例',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1717 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_user
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_bjkn`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_bjkn`;
CREATE TABLE `lottery_result_bjkn` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `ball_6` int(2) DEFAULT NULL,
  `ball_7` int(2) DEFAULT NULL,
  `ball_8` int(2) DEFAULT NULL,
  `ball_9` int(2) DEFAULT NULL,
  `ball_10` int(2) DEFAULT NULL,
  `ball_11` int(2) DEFAULT NULL,
  `ball_12` int(2) DEFAULT NULL,
  `ball_13` int(2) DEFAULT NULL,
  `ball_14` int(2) DEFAULT NULL,
  `ball_15` int(2) DEFAULT NULL,
  `ball_16` int(2) DEFAULT NULL,
  `ball_17` int(2) DEFAULT NULL,
  `ball_18` int(2) DEFAULT NULL,
  `ball_19` int(2) DEFAULT NULL,
  `ball_20` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59298 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_bjkn
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_bjpk`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_bjpk`;
CREATE TABLE `lottery_result_bjpk` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `ball_6` int(2) DEFAULT NULL,
  `ball_7` int(2) DEFAULT NULL,
  `ball_8` int(2) DEFAULT NULL,
  `ball_9` int(2) DEFAULT NULL,
  `ball_10` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59153 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_bjpk
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_cq`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_cq`;
CREATE TABLE `lottery_result_cq` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39553 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_cq
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_cqsf`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_cqsf`;
CREATE TABLE `lottery_result_cqsf` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `ball_6` int(2) DEFAULT NULL,
  `ball_7` int(2) DEFAULT NULL,
  `ball_8` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=178147 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_cqsf
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_d3`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_d3`;
CREATE TABLE `lottery_result_d3` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=420 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_d3
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_gd11`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_gd11`;
CREATE TABLE `lottery_result_gd11` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27921 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_gd11
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_gdsf`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_gdsf`;
CREATE TABLE `lottery_result_gdsf` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `ball_6` int(2) DEFAULT NULL,
  `ball_7` int(2) DEFAULT NULL,
  `ball_8` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27863 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_gdsf
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_gxsf`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_gxsf`;
CREATE TABLE `lottery_result_gxsf` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `ball_quick` varchar(255) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16664 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_gxsf
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_jx`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_jx`;
CREATE TABLE `lottery_result_jx` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13385 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_jx
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_lhc`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_lhc`;
CREATE TABLE `lottery_result_lhc` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `ball_6` int(2) DEFAULT NULL,
  `ball_7` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_lhc
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_p3`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_p3`;
CREATE TABLE `lottery_result_p3` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=420 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_p3
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_t3`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_t3`;
CREATE TABLE `lottery_result_t3` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7744 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_t3
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_tj`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_tj`;
CREATE TABLE `lottery_result_tj` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27915 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_tj
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_result_tjsf`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_result_tjsf`;
CREATE TABLE `lottery_result_tjsf` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:正常  2:重新结算',
  `prev_text` varchar(2000) DEFAULT NULL,
  `ball_1` int(2) DEFAULT NULL,
  `ball_2` int(2) DEFAULT NULL,
  `ball_3` int(2) DEFAULT NULL,
  `ball_4` int(2) DEFAULT NULL,
  `ball_5` int(2) DEFAULT NULL,
  `ball_6` int(2) DEFAULT NULL,
  `ball_7` int(2) DEFAULT NULL,
  `ball_8` int(2) DEFAULT NULL,
  `from_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27928 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lottery_result_tjsf
-- ----------------------------

-- ----------------------------
-- Table structure for `lottery_schedule`
-- ----------------------------
DROP TABLE IF EXISTS `lottery_schedule`;
CREATE TABLE `lottery_schedule` (
  `id` smallint(22) NOT NULL,
  `lottery_type` varchar(255) NOT NULL,
  `qishu` varchar(255) DEFAULT NULL,
  `kaipan_time` time DEFAULT NULL,
  `fenpan_time` time DEFAULT NULL,
  `kaijiang_time` time DEFAULT NULL,
  `state` varchar(5) DEFAULT ' ',
  `type` varchar(10) DEFAULT ' ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12028 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lottery_schedule
-- ----------------------------
INSERT INTO `lottery_schedule` VALUES ('24', '广西十分彩', '24', '14:40:00', '14:53:00', '14:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1079', '广东十一选五', '81', '22:20:00', '22:29:00', '22:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('939', '江西时时彩', '028', '13:33:00', '13:41:00', '13:43:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('590', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('638', '重庆时时彩', '021', '01:40:00', '01:44:00', '01:45:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('182', '天津十分彩', '042', '15:44:00', '15:52:00', '15:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('165', '天津十分彩', '025', '12:54:00', '13:02:00', '13:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('36', '广西十分彩', '36', '17:40:00', '17:53:00', '17:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('399', '北京PK拾', '172', '23:17:00', '23:21:30', '23:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('578', '北京快乐8', '169', '22:58:00', '23:02:50', '23:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1266', '重庆十分彩', '061', '17:43:00', '17:51:00', '17:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('111', '广东十分彩', '58', '18:30:00', '18:39:00', '18:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('412', '北京快乐8', '3', '09:08:00', '09:12:50', '09:13:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('648', '重庆时时彩', '031', '11:00:00', '11:09:00', '11:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('574', '北京快乐8', '165', '22:38:00', '22:42:50', '22:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('201', '天津十分彩', '061', '18:54:00', '19:02:00', '19:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('280', '北京PK拾', '53', '13:22:00', '13:26:30', '13:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('128', '广东十分彩', '75', '21:20:00', '21:29:00', '21:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('592', '上海时时乐', '01', '09:58:00', '10:28:00', '10:30:00', 'OK', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('520', '北京快乐8', '111', '18:08:00', '18:12:50', '18:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('913', '江西时时彩', '002', '09:10:00', '09:18:00', '09:20:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('633', '重庆时时彩', '016', '01:15:00', '01:19:00', '01:20:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('756', '极速时时彩', '016', '11:29:00', '11:37:00', '11:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('760', '极速时时彩', '020', '12:09:00', '12:17:00', '12:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('330', '北京PK拾', '103', '17:32:00', '17:36:30', '17:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('700', '重庆时时彩', '083', '19:40:00', '19:49:00', '19:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('546', '北京快乐8', '137', '20:18:00', '20:22:50', '20:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('462', '北京快乐8', '53', '13:18:00', '13:22:50', '13:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('581', '北京快乐8', '172', '23:13:00', '23:17:50', '23:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('335', '北京PK拾', '108', '17:57:00', '18:01:30', '18:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('136', '广东十分彩', '83', '22:40:00', '22:49:00', '22:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('275', '北京PK拾', '48', '12:57:00', '13:01:30', '13:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1235', '重庆十分彩', '030', '12:33:00', '12:41:00', '12:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('750', '极速时时彩', '010', '10:29:00', '10:37:00', '10:39:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1010', '广东十一选五', '12', '10:50:00', '10:59:00', '11:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('307', '北京PK拾', '80', '15:37:00', '15:41:30', '15:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('714', '重庆时时彩', '097', '22:00:00', '22:04:00', '22:05:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('522', '北京快乐8', '113', '18:18:00', '18:22:50', '18:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('114', '广东十分彩', '61', '19:00:00', '19:09:00', '19:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('531', '北京快乐8', '122', '19:03:00', '19:07:50', '19:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('277', '北京PK拾', '50', '13:07:00', '13:11:30', '13:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('467', '北京快乐8', '58', '13:43:00', '13:47:50', '13:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1282', '重庆十分彩', '077', '20:23:00', '20:31:00', '20:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1202', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('511', '北京快乐8', '102', '17:23:00', '17:27:50', '17:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('105', '广东十分彩', '52', '17:30:00', '17:39:00', '17:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1208', '重庆十分彩', '003', '00:13:00', '00:21:00', '00:23:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1214', '重庆十分彩', '009', '01:13:00', '01:21:00', '01:23:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('619', '重庆时时彩', '002', '00:05:00', '00:09:00', '00:10:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('776', '极速时时彩', '036', '14:49:00', '14:57:00', '14:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('233', '北京PK拾', '6', '09:27:00', '09:31:30', '09:32:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('981', '江西时时彩', '070', '20:39:00', '20:47:00', '20:49:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1218', '重庆十分彩', '013', '01:53:00', '02:01:00', '02:03:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('262', '北京PK拾', '35', '11:52:00', '11:56:30', '11:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('616', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('100', '广东十分彩', '47', '16:40:00', '16:49:00', '16:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('821', '极速时时彩', '081', '22:19:00', '22:27:00', '22:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('351', '北京PK拾', '124', '19:17:00', '19:21:30', '19:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('14', '广西十分彩', '14', '12:10:00', '12:23:00', '12:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('340', '北京PK拾', '113', '18:22:00', '18:26:30', '18:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('192', '天津十分彩', '052', '17:24:00', '17:32:00', '17:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('270', '北京PK拾', '43', '12:32:00', '12:36:30', '12:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1290', '重庆十分彩', '085', '21:43:00', '21:51:00', '21:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1072', '广东十一选五', '74', '21:10:00', '21:19:00', '21:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('958', '江西时时彩', '047', '16:46:00', '16:54:00', '16:56:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('554', '北京快乐8', '145', '20:58:00', '21:02:50', '21:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('123', '广东十分彩', '70', '20:30:00', '20:39:00', '20:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('471', '北京快乐8', '62', '14:03:00', '14:07:50', '14:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('921', '江西时时彩', '010', '10:31:00', '10:39:00', '10:41:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('96', '广东十分彩', '43', '16:00:00', '16:09:00', '16:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('121', '广东十分彩', '68', '20:10:00', '20:19:00', '20:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('318', '北京PK拾', '91', '16:32:00', '16:36:30', '16:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('241', '北京PK拾', '14', '10:07:00', '10:11:30', '10:12:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('642', '重庆时时彩', '025', '10:00:00', '10:09:00', '10:10:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('624', '重庆时时彩', '007', '00:30:00', '00:34:00', '00:35:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('706', '重庆时时彩', '089', '20:40:00', '20:49:00', '20:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('929', '江西时时彩', '018', '11:52:00', '12:00:00', '12:02:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('623', '重庆时时彩', '006', '00:25:00', '00:29:00', '00:30:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('822', '极速时时彩', '082', '22:29:00', '22:37:00', '22:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('312', '北京PK拾', '85', '16:02:00', '16:06:30', '16:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1061', '广东十一选五', '63', '19:20:00', '19:29:00', '19:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('279', '北京PK拾', '52', '13:17:00', '13:21:30', '13:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('595', '上海时时乐', '04', '11:28:00', '11:58:00', '12:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('602', '上海时时乐', '11', '14:58:00', '15:28:00', '15:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('441', '北京快乐8', '32', '11:33:00', '11:37:50', '11:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('38', '广西十分彩', '38', '18:10:00', '18:23:00', '18:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('662', '重庆时时彩', '045', '13:20:00', '13:29:00', '13:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('566', '北京快乐8', '157', '21:58:00', '22:02:50', '22:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('564', '北京快乐8', '155', '21:48:00', '21:52:50', '21:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('503', '北京快乐8', '94', '16:43:00', '16:47:50', '16:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('406', '北京PK拾', '179', '23:52:00', '23:56:30', '23:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('814', '极速时时彩', '074', '21:09:00', '21:17:00', '21:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('248', '北京PK拾', '21', '10:42:00', '10:46:30', '10:47:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('207', '天津十分彩', '067', '19:54:00', '20:02:00', '20:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('643', '重庆时时彩', '026', '10:10:00', '10:19:00', '10:20:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('157', '天津十分彩', '017', '11:34:00', '11:42:00', '11:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1', '广西十分彩', '01', '08:55:00', '09:08:00', '09:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('954', '江西时时彩', '043', '16:05:00', '16:13:00', '16:15:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1260', '重庆十分彩', '055', '16:43:00', '16:51:00', '16:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('987', '江西时时彩', '076', '21:40:00', '21:48:00', '21:50:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('962', '江西时时彩', '051', '17:27:00', '17:35:00', '17:37:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('110', '广东十分彩', '57', '18:20:00', '18:29:00', '18:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('97', '广东十分彩', '44', '16:10:00', '16:19:00', '16:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('618', '重庆时时彩', '001', '00:00:00', '00:04:00', '00:05:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('469', '北京快乐8', '60', '13:53:00', '13:57:50', '13:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('347', '北京PK拾', '120', '18:57:00', '19:01:30', '19:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('468', '北京快乐8', '59', '13:48:00', '13:52:50', '13:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('484', '北京快乐8', '75', '15:08:00', '15:12:50', '15:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('23', '广西十分彩', '23', '14:25:00', '14:38:00', '14:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('696', '重庆时时彩', '079', '19:00:00', '19:09:00', '19:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('603', '上海时时乐', '12', '15:28:00', '15:58:00', '16:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('1234', '重庆十分彩', '029', '12:23:00', '12:31:00', '12:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1065', '广东十一选五', '67', '20:00:00', '20:09:00', '20:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('604', '上海时时乐', '13', '15:58:00', '16:28:00', '16:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('713', '重庆时时彩', '096', '21:50:00', '21:59:00', '22:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('646', '重庆时时彩', '029', '10:40:00', '10:49:00', '10:50:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('795', '极速时时彩', '055', '17:59:00', '18:07:00', '18:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('155', '天津十分彩', '015', '11:14:00', '11:22:00', '11:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('746', '极速时时彩', '006', '09:49:00', '09:57:00', '09:59:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('755', '极速时时彩', '015', '11:19:00', '11:27:00', '11:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1210', '重庆十分彩', '005', '00:33:00', '00:41:00', '00:43:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('600', '上海时时乐', '09', '13:58:00', '14:28:00', '14:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('634', '重庆时时彩', '017', '01:20:00', '01:24:00', '01:25:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('524', '北京快乐8', '115', '18:28:00', '18:32:50', '18:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('244', '北京PK拾', '17', '10:22:00', '10:26:30', '10:27:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('175', '天津十分彩', '035', '14:34:00', '14:42:00', '14:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('222', '天津十分彩', '082', '22:24:00', '22:32:00', '22:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('419', '北京快乐8', '10', '09:43:00', '09:47:50', '09:48:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('431', '北京快乐8', '22', '10:43:00', '10:47:50', '10:48:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('323', '北京PK拾', '96', '16:57:00', '17:01:30', '17:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1013', '广东十一选五', '15', '11:20:00', '11:29:00', '11:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('371', '北京PK拾', '144', '20:57:00', '21:01:30', '21:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('757', '极速时时彩', '017', '11:39:00', '11:47:00', '11:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('191', '天津十分彩', '051', '17:14:00', '17:22:00', '17:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1016', '广东十一选五', '18', '11:50:00', '11:59:00', '12:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1036', '广东十一选五', '38', '15:10:00', '15:19:00', '15:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('606', '上海时时乐', '15', '16:58:00', '17:28:00', '17:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('1012', '广东十一选五', '14', '11:10:00', '11:19:00', '11:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('370', '北京PK拾', '143', '20:52:00', '20:56:30', '20:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('514', '北京快乐8', '105', '17:38:00', '17:42:50', '17:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('299', '北京PK拾', '72', '14:57:00', '15:01:30', '15:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('108', '广东十分彩', '55', '18:00:00', '18:09:00', '18:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('443', '北京快乐8', '34', '11:43:00', '11:47:50', '11:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('346', '北京PK拾', '119', '18:52:00', '18:56:30', '18:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('8', '广西十分彩', '08', '10:40:00', '10:53:00', '10:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('214', '天津十分彩', '074', '21:04:00', '21:12:00', '21:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('498', '北京快乐8', '89', '16:18:00', '16:22:50', '16:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('808', '极速时时彩', '068', '20:09:00', '20:17:00', '20:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('629', '重庆时时彩', '012', '00:55:00', '00:59:00', '01:00:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('824', '极速时时彩', '084', '22:49:00', '22:57:00', '22:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('622', '重庆时时彩', '005', '00:20:00', '00:24:00', '00:25:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('363', '北京PK拾', '136', '20:17:00', '20:21:30', '20:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('589', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('78', '广东十分彩', '25', '13:00:00', '13:09:00', '13:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('767', '极速时时彩', '027', '13:19:00', '13:27:00', '13:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1257', '重庆十分彩', '052', '16:13:00', '16:21:00', '16:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('37', '广西十分彩', '37', '17:55:00', '18:08:00', '18:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('310', '北京PK拾', '83', '15:52:00', '15:56:30', '15:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1043', '广东十一选五', '45', '16:20:00', '16:29:00', '16:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('758', '极速时时彩', '018', '11:49:00', '11:57:00', '11:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1259', '重庆十分彩', '054', '16:33:00', '16:41:00', '16:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('815', '极速时时彩', '075', '21:19:00', '21:27:00', '21:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('769', '极速时时彩', '029', '13:39:00', '13:47:00', '13:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('465', '北京快乐8', '56', '13:33:00', '13:37:50', '13:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1254', '重庆十分彩', '049', '15:43:00', '15:51:00', '15:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('164', '天津十分彩', '024', '12:44:00', '12:52:00', '12:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1225', '重庆十分彩', '020', '10:53:00', '11:01:00', '11:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('708', '重庆时时彩', '091', '21:00:00', '21:09:00', '21:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('309', '北京PK拾', '82', '15:47:00', '15:51:30', '15:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('122', '广东十分彩', '69', '20:20:00', '20:29:00', '20:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('221', '天津十分彩', '081', '22:14:00', '22:22:00', '22:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('969', '江西时时彩', '058', '18:38:00', '18:46:00', '18:48:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('402', '北京PK拾', '175', '23:32:00', '23:36:30', '23:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('273', '北京PK拾', '46', '12:47:00', '12:51:30', '12:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1233', '重庆十分彩', '028', '12:13:00', '12:21:00', '12:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('474', '北京快乐8', '65', '14:18:00', '14:22:50', '14:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('193', '天津十分彩', '053', '17:34:00', '17:42:00', '17:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('726', '重庆时时彩', '109', '23:00:00', '23:04:00', '23:05:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1022', '广东十一选五', '24', '12:50:00', '12:59:00', '13:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1276', '重庆十分彩', '071', '19:23:00', '19:31:00', '19:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('197', '天津十分彩', '057', '18:14:00', '18:22:00', '18:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('525', '北京快乐8', '116', '18:33:00', '18:37:50', '18:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('171', '天津十分彩', '031', '13:54:00', '14:02:00', '14:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1004', '广东十一选五', '06', '09:50:00', '09:59:00', '10:00:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1298', '重庆十分彩', '093', '23:03:00', '23:11:00', '23:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('639', '重庆时时彩', '022', '01:45:00', '01:49:00', '01:50:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1018', '广东十一选五', '20', '12:10:00', '12:19:00', '12:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('517', '北京快乐8', '108', '17:53:00', '17:57:50', '17:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('505', '北京快乐8', '96', '16:53:00', '16:57:50', '16:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('362', '北京PK拾', '135', '20:12:00', '20:16:30', '20:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('455', '北京快乐8', '46', '12:43:00', '12:47:50', '12:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1021', '广东十一选五', '23', '12:40:00', '12:49:00', '12:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('802', '极速时时彩', '062', '19:09:00', '19:17:00', '19:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('204', '天津十分彩', '064', '19:24:00', '19:32:00', '19:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('568', '北京快乐8', '159', '22:08:00', '22:12:50', '22:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('152', '天津十分彩', '012', '10:44:00', '10:52:00', '10:54:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('256', '北京PK拾', '29', '11:22:00', '11:26:30', '11:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('135', '广东十分彩', '82', '22:30:00', '22:39:00', '22:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1029', '广东十一选五', '31', '14:00:00', '14:09:00', '14:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('150', '天津十分彩', '010', '10:24:00', '10:32:00', '10:34:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('257', '北京PK拾', '30', '11:27:00', '11:31:30', '11:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('527', '北京快乐8', '118', '18:43:00', '18:47:50', '18:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('457', '北京快乐8', '48', '12:53:00', '12:57:50', '12:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('817', '极速时时彩', '077', '21:39:00', '21:47:00', '21:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1074', '广东十一选五', '76', '21:30:00', '21:39:00', '21:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('58', '广东十分彩', '05', '09:40:00', '09:49:00', '09:50:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('816', '极速时时彩', '076', '21:29:00', '21:37:00', '21:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('302', '北京PK拾', '75', '15:12:00', '15:16:30', '15:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('743', '极速时时彩', '003', '09:19:00', '09:27:00', '09:29:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('143', '天津十分彩', '003', '09:14:00', '09:22:00', '09:24:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('675', '重庆时时彩', '058', '15:30:00', '15:39:00', '15:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('735', '重庆时时彩', '118', '23:45:00', '23:49:00', '23:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('489', '北京快乐8', '80', '15:33:00', '15:37:50', '15:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('76', '广东十分彩', '23', '12:40:00', '12:49:00', '12:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('210', '天津十分彩', '070', '20:24:00', '20:32:00', '20:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('725', '重庆时时彩', '108', '22:55:00', '22:59:00', '23:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('392', '北京PK拾', '165', '22:42:00', '22:46:30', '22:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1299', '重庆十分彩', '094', '23:13:00', '23:21:00', '23:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('591', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('344', '北京PK拾', '117', '18:42:00', '18:46:30', '18:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('125', '广东十分彩', '72', '20:50:00', '20:59:00', '21:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('644', '重庆时时彩', '027', '10:20:00', '10:29:00', '10:30:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('666', '重庆时时彩', '049', '14:00:00', '14:09:00', '14:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('115', '广东十分彩', '62', '19:10:00', '19:19:00', '19:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('461', '北京快乐8', '52', '13:13:00', '13:17:50', '13:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('730', '重庆时时彩', '113', '23:20:00', '23:24:00', '23:25:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('789', '极速时时彩', '049', '16:59:00', '17:07:00', '17:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1028', '广东十一选五', '30', '13:50:00', '13:59:00', '14:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1232', '重庆十分彩', '027', '12:03:00', '12:11:00', '12:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('183', '天津十分彩', '043', '15:54:00', '16:02:00', '16:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('242', '北京PK拾', '15', '10:12:00', '10:16:30', '10:17:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1055', '广东十一选五', '57', '18:20:00', '18:29:00', '18:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1269', '重庆十分彩', '064', '18:13:00', '18:21:00', '18:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('561', '北京快乐8', '152', '21:33:00', '21:37:50', '21:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('818', '极速时时彩', '078', '21:49:00', '21:57:00', '21:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('328', '北京PK拾', '101', '17:22:00', '17:26:30', '17:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('109', '广东十分彩', '56', '18:10:00', '18:19:00', '18:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('652', '重庆时时彩', '035', '11:40:00', '11:49:00', '11:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('400', '北京PK拾', '173', '23:22:00', '23:26:30', '23:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('212', '天津十分彩', '072', '20:44:00', '20:52:00', '20:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('733', '重庆时时彩', '116', '23:35:00', '23:39:00', '23:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('500', '北京快乐8', '91', '16:28:00', '16:32:50', '16:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1289', '重庆十分彩', '084', '21:33:00', '21:41:00', '21:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('485', '北京快乐8', '76', '15:13:00', '15:17:50', '15:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('803', '极速时时彩', '063', '19:19:00', '19:27:00', '19:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('917', '江西时时彩', '006', '09:50:00', '09:58:00', '10:00:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('389', '北京PK拾', '162', '22:27:00', '22:31:30', '22:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1243', '重庆十分彩', '038', '13:53:00', '14:01:00', '14:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('478', '北京快乐8', '69', '14:38:00', '14:42:50', '14:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('420', '北京快乐8', '11', '09:48:00', '09:52:50', '09:53:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('977', '江西时时彩', '066', '19:59:00', '20:07:00', '20:09:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('422', '北京快乐8', '13', '09:58:00', '10:02:50', '10:03:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('995', '江西时时彩', '084', '23:01:00', '23:09:00', '23:11:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('349', '北京PK拾', '122', '19:07:00', '19:11:30', '19:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('139', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('2', '广西十分彩', '02', '09:10:00', '09:23:00', '09:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('353', '北京PK拾', '126', '19:27:00', '19:31:30', '19:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('562', '北京快乐8', '153', '21:38:00', '21:42:50', '21:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('395', '北京PK拾', '168', '22:57:00', '23:01:30', '23:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('89', '广东十分彩', '36', '14:50:00', '14:59:00', '15:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('688', '重庆时时彩', '071', '17:40:00', '17:49:00', '17:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('358', '北京PK拾', '131', '19:52:00', '19:56:30', '19:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('220', '天津十分彩', '080', '22:04:00', '22:12:00', '22:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('90', '广东十分彩', '37', '15:00:00', '15:09:00', '15:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('418', '北京快乐8', '9', '09:38:00', '09:42:50', '09:43:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('959', '江西时时彩', '048', '16:56:00', '17:05:00', '17:07:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('752', '极速时时彩', '012', '10:49:00', '10:57:00', '10:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('416', '北京快乐8', '7', '09:28:00', '09:32:50', '09:33:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1045', '广东十一选五', '47', '16:40:00', '16:49:00', '16:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('782', '极速时时彩', '042', '15:49:00', '15:57:00', '15:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('274', '北京PK拾', '47', '12:52:00', '12:56:30', '12:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('410', '北京快乐8', '1', '08:58:00', '09:02:50', '09:03:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('999', '广东十一选五', '01', '09:00:00', '09:09:00', '09:10:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('386', '北京PK拾', '159', '22:12:00', '22:16:30', '22:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('943', '江西时时彩', '032', '14:14:00', '14:22:00', '14:24:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1040', '广东十一选五', '42', '15:50:00', '15:59:00', '16:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('945', '江西时时彩', '034', '14:34:00', '14:42:00', '14:44:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('577', '北京快乐8', '168', '22:53:00', '22:57:50', '22:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1081', '广东十一选五', '83', '22:40:00', '22:49:00', '22:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1067', '广东十一选五', '69', '20:20:00', '20:29:00', '20:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('211', '天津十分彩', '071', '20:34:00', '20:42:00', '20:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1296', '重庆十分彩', '091', '22:43:00', '22:51:00', '22:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('486', '北京快乐8', '77', '15:18:00', '15:22:50', '15:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('315', '北京PK拾', '88', '16:17:00', '16:21:30', '16:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('483', '北京快乐8', '74', '15:03:00', '15:07:50', '15:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1247', '重庆十分彩', '042', '14:33:00', '14:41:00', '14:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('337', '北京PK拾', '110', '18:07:00', '18:11:30', '18:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('426', '北京快乐8', '17', '10:18:00', '10:22:50', '10:23:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1060', '广东十一选五', '62', '19:10:00', '19:19:00', '19:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('710', '重庆时时彩', '093', '21:20:00', '21:29:00', '21:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('45', '广西十分彩', '45', '19:55:00', '20:08:00', '20:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('83', '广东十分彩', '30', '13:50:00', '13:59:00', '14:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1034', '广东十一选五', '36', '14:50:00', '14:59:00', '15:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('610', '上海时时乐', '19', '18:58:00', '19:28:00', '19:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('162', '天津十分彩', '022', '12:24:00', '12:32:00', '12:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('295', '北京PK拾', '68', '14:37:00', '14:41:30', '14:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('166', '天津十分彩', '026', '13:04:00', '13:12:00', '13:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('388', '北京PK拾', '161', '22:22:00', '22:26:30', '22:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('308', '北京PK拾', '81', '15:42:00', '15:46:30', '15:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('627', '重庆时时彩', '010', '00:45:00', '00:49:00', '00:50:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('530', '北京快乐8', '121', '18:58:00', '19:02:50', '19:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('989', '江西时时彩', '078', '22:00:00', '22:09:00', '22:11:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('227', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('992', '江西时时彩', '081', '22:31:00', '22:39:00', '22:41:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1275', '重庆十分彩', '070', '19:13:00', '19:21:00', '19:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('342', '北京PK拾', '115', '18:32:00', '18:36:30', '18:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('228', '北京PK拾', '1', '09:02:00', '09:06:30', '09:07:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('453', '北京快乐8', '44', '12:33:00', '12:37:50', '12:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('570', '北京快乐8', '161', '22:18:00', '22:22:50', '22:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('641', '重庆时时彩', '024', '01:55:00', '09:59:00', '10:00:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('694', '重庆时时彩', '077', '18:40:00', '18:49:00', '18:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('586', '北京快乐8', '177', '23:38:00', '23:42:50', '23:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('579', '北京快乐8', '170', '23:03:00', '23:07:50', '23:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('46', '广西十分彩', '46', '20:10:00', '20:23:00', '20:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('607', '上海时时乐', '16', '17:28:00', '17:58:00', '18:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('225', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('178', '天津十分彩', '038', '15:04:00', '15:12:00', '15:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1062', '广东十一选五', '64', '19:30:00', '19:39:00', '19:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('331', '北京PK拾', '104', '17:37:00', '17:41:30', '17:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('238', '北京PK拾', '11', '09:52:00', '09:56:30', '09:57:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('727', '重庆时时彩', '110', '23:05:00', '23:09:00', '23:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('936', '江西时时彩', '025', '13:03:00', '13:11:00', '13:13:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('663', '重庆时时彩', '046', '13:30:00', '13:39:00', '13:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('526', '北京快乐8', '117', '18:38:00', '18:42:50', '18:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('558', '北京快乐8', '149', '21:18:00', '21:22:50', '21:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('103', '广东十分彩', '50', '17:10:00', '17:19:00', '17:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1056', '广东十一选五', '58', '18:30:00', '18:39:00', '18:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('736', '重庆时时彩', '119', '23:50:00', '23:54:00', '23:55:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('159', '天津十分彩', '019', '11:54:00', '12:02:00', '12:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('73', '广东十分彩', '20', '12:10:00', '12:19:00', '12:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('707', '重庆时时彩', '090', '20:50:00', '20:59:00', '21:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('442', '北京快乐8', '33', '11:38:00', '11:42:50', '11:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('764', '极速时时彩', '024', '12:49:00', '12:57:00', '12:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('951', '江西时时彩', '040', '15:35:00', '15:43:00', '15:45:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('86', '广东十分彩', '33', '14:20:00', '14:29:00', '14:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('284', '北京PK拾', '57', '13:42:00', '13:46:30', '13:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1251', '重庆十分彩', '046', '15:13:00', '15:21:00', '15:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1015', '广东十一选五', '17', '11:40:00', '11:49:00', '11:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('765', '极速时时彩', '025', '12:59:00', '13:07:00', '13:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1231', '重庆十分彩', '026', '11:53:00', '12:01:00', '12:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('674', '重庆时时彩', '057', '15:20:00', '15:29:00', '15:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('451', '北京快乐8', '42', '12:23:00', '12:27:50', '12:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1239', '重庆十分彩', '034', '13:13:00', '13:21:00', '13:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('397', '北京PK拾', '170', '23:07:00', '23:11:30', '23:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1205', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('1032', '广东十一选五', '34', '14:30:00', '14:39:00', '14:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1035', '广东十一选五', '37', '15:00:00', '15:09:00', '15:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('717', '重庆时时彩', '100', '22:15:00', '22:19:00', '22:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('149', '天津十分彩', '009', '10:14:00', '10:22:00', '10:24:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('967', '江西时时彩', '056', '18:17:00', '18:25:00', '18:27:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('976', '江西时时彩', '065', '19:49:00', '19:57:00', '19:59:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('949', '江西时时彩', '038', '15:14:00', '15:23:00', '15:25:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('263', '北京PK拾', '36', '11:57:00', '12:01:30', '12:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('545', '北京快乐8', '136', '20:13:00', '20:17:50', '20:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('316', '北京PK拾', '89', '16:22:00', '16:26:30', '16:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('133', '广东十分彩', '80', '22:10:00', '22:19:00', '22:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('147', '天津十分彩', '007', '09:54:00', '10:02:00', '10:04:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('640', '重庆时时彩', '023', '01:50:00', '01:54:00', '01:55:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1250', '重庆十分彩', '045', '15:03:00', '15:11:00', '15:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('957', '江西时时彩', '046', '16:36:00', '16:44:00', '16:46:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('508', '北京快乐8', '99', '17:08:00', '17:12:50', '17:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('198', '天津十分彩', '058', '18:24:00', '18:32:00', '18:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('645', '重庆时时彩', '028', '10:30:00', '10:39:00', '10:40:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('612', '上海时时乐', '21', '19:58:00', '20:28:00', '20:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('74', '广东十分彩', '21', '12:20:00', '12:29:00', '12:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('605', '上海时时乐', '14', '16:28:00', '16:58:00', '17:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('354', '北京PK拾', '127', '19:32:00', '19:36:30', '19:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1001', '广东十一选五', '03', '09:20:00', '09:29:00', '09:30:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('491', '北京快乐8', '82', '15:43:00', '15:47:50', '15:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('343', '北京PK拾', '116', '18:37:00', '18:41:30', '18:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('682', '重庆时时彩', '065', '16:40:00', '16:49:00', '16:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('761', '极速时时彩', '021', '12:19:00', '12:27:00', '12:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('9', '广西十分彩', '09', '10:55:00', '11:08:00', '11:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('772', '极速时时彩', '032', '14:09:00', '14:17:00', '14:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('493', '北京快乐8', '84', '15:53:00', '15:57:50', '15:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('569', '北京快乐8', '160', '22:13:00', '22:17:50', '22:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('55', '广东十分彩', '02', '09:10:00', '09:19:00', '09:20:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('294', '北京PK拾', '67', '14:32:00', '14:36:30', '14:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('982', '江西时时彩', '071', '20:49:00', '20:58:00', '21:00:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1245', '重庆十分彩', '040', '14:13:00', '14:21:00', '14:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('6', '广西十分彩', '06', '10:10:00', '10:23:00', '10:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('762', '极速时时彩', '022', '12:29:00', '12:37:00', '12:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('952', '江西时时彩', '041', '15:45:00', '15:53:00', '15:55:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1009', '广东十一选五', '11', '10:40:00', '10:49:00', '10:50:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('998', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('230', '北京PK拾', '3', '09:12:00', '09:16:30', '09:17:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1229', '重庆十分彩', '024', '11:33:00', '11:41:00', '11:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('576', '北京快乐8', '167', '22:48:00', '22:52:50', '22:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('247', '北京PK拾', '20', '10:37:00', '10:41:30', '10:42:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('378', '北京PK拾', '151', '21:32:00', '21:36:30', '21:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('300', '北京PK拾', '73', '15:02:00', '15:06:30', '15:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1068', '广东十一选五', '70', '20:30:00', '20:39:00', '20:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('84', '广东十分彩', '31', '14:00:00', '14:09:00', '14:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('367', '北京PK拾', '140', '20:37:00', '20:41:30', '20:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('723', '重庆时时彩', '106', '22:45:00', '22:49:00', '22:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('240', '北京PK拾', '13', '10:02:00', '10:06:30', '10:07:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('205', '天津十分彩', '065', '19:34:00', '19:42:00', '19:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('365', '北京PK拾', '138', '20:27:00', '20:31:30', '20:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('95', '广东十分彩', '42', '15:50:00', '15:59:00', '16:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('306', '北京PK拾', '79', '15:32:00', '15:36:30', '15:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('966', '江西时时彩', '055', '18:07:00', '18:15:00', '18:17:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('267', '北京PK拾', '40', '12:17:00', '12:21:30', '12:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('249', '北京PK拾', '22', '10:47:00', '10:51:30', '10:52:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1014', '广东十一选五', '16', '11:30:00', '11:39:00', '11:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('930', '江西时时彩', '019', '12:02:00', '12:10:00', '12:12:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('993', '江西时时彩', '082', '22:41:00', '22:49:00', '22:51:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('609', '上海时时乐', '18', '18:28:00', '18:58:00', '19:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('1201', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('518', '北京快乐8', '109', '17:58:00', '18:02:50', '18:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('661', '重庆时时彩', '044', '13:10:00', '13:19:00', '13:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('934', '江西时时彩', '023', '12:42:00', '12:50:00', '12:52:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('187', '天津十分彩', '047', '16:34:00', '16:42:00', '16:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('534', '北京快乐8', '125', '19:18:00', '19:22:50', '19:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('301', '北京PK拾', '74', '15:07:00', '15:11:30', '15:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('499', '北京快乐8', '90', '16:23:00', '16:27:50', '16:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('251', '北京PK拾', '24', '10:57:00', '11:01:30', '11:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('482', '北京快乐8', '73', '14:58:00', '15:02:50', '15:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1241', '重庆十分彩', '036', '13:33:00', '13:41:00', '13:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('805', '极速时时彩', '065', '19:39:00', '19:47:00', '19:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('69', '广东十分彩', '16', '11:30:00', '11:39:00', '11:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('80', '广东十分彩', '27', '13:20:00', '13:29:00', '13:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('695', '重庆时时彩', '078', '18:50:00', '18:59:00', '19:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('366', '北京PK拾', '139', '20:32:00', '20:36:30', '20:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('246', '北京PK拾', '19', '10:32:00', '10:36:30', '10:37:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('206', '天津十分彩', '066', '19:44:00', '19:52:00', '19:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('542', '北京快乐8', '133', '19:58:00', '20:02:50', '20:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1252', '重庆十分彩', '047', '15:23:00', '15:31:00', '15:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('439', '北京快乐8', '30', '11:23:00', '11:27:50', '11:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('409', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('784', '极速时时彩', '044', '16:09:00', '16:17:00', '16:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('403', '北京PK拾', '176', '23:37:00', '23:41:30', '23:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('345', '北京PK拾', '118', '18:47:00', '18:51:30', '18:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('996', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('361', '北京PK拾', '134', '20:07:00', '20:11:30', '20:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('820', '极速时时彩', '080', '22:09:00', '22:17:00', '22:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('779', '极速时时彩', '039', '15:19:00', '15:27:00', '15:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('172', '天津十分彩', '032', '14:04:00', '14:12:00', '14:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('138', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('1271', '重庆十分彩', '066', '18:33:00', '18:41:00', '18:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('783', '极速时时彩', '043', '15:59:00', '16:07:00', '16:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('950', '江西时时彩', '039', '15:25:00', '15:33:00', '15:35:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1082', '广东十一选五', '84', '22:50:00', '22:59:00', '23:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('234', '北京PK拾', '7', '09:32:00', '09:36:30', '09:37:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1216', '重庆十分彩', '011', '01:33:00', '01:41:00', '01:43:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('380', '北京PK拾', '153', '21:42:00', '21:46:30', '21:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('64', '广东十分彩', '11', '10:40:00', '10:49:00', '10:50:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('567', '北京快乐8', '158', '22:03:00', '22:07:50', '22:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1206', '重庆十分彩', '001', '23:53:00', '00:01:00', '00:03:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('630', '重庆时时彩', '013', '01:00:00', '01:04:00', '01:05:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('381', '北京PK拾', '154', '21:47:00', '21:51:30', '21:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1052', '广东十一选五', '54', '17:50:00', '17:59:00', '18:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('965', '江西时时彩', '054', '17:57:00', '18:05:00', '18:07:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('293', '北京PK拾', '66', '14:27:00', '14:31:30', '14:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('407', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('1230', '重庆十分彩', '025', '11:43:00', '11:51:00', '11:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('488', '北京快乐8', '79', '15:28:00', '15:32:50', '15:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1025', '广东十一选五', '27', '13:20:00', '13:29:00', '13:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('445', '北京快乐8', '36', '11:53:00', '11:57:50', '11:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('754', '极速时时彩', '014', '11:09:00', '11:17:00', '11:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('516', '北京快乐8', '107', '17:48:00', '17:52:50', '17:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('377', '北京PK拾', '150', '21:27:00', '21:31:30', '21:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('434', '北京快乐8', '25', '10:58:00', '11:02:50', '11:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('63', '广东十分彩', '10', '10:30:00', '10:39:00', '10:40:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('341', '北京PK拾', '114', '18:27:00', '18:31:30', '18:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('797', '极速时时彩', '057', '18:19:00', '18:27:00', '18:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('396', '北京PK拾', '169', '23:02:00', '23:06:30', '23:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('777', '极速时时彩', '037', '14:59:00', '15:07:00', '15:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('774', '极速时时彩', '034', '14:29:00', '14:37:00', '14:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('154', '天津十分彩', '014', '11:04:00', '11:12:00', '11:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('21', '广西十分彩', '21', '13:55:00', '14:08:00', '14:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('544', '北京快乐8', '135', '20:08:00', '20:12:50', '20:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('724', '重庆时时彩', '107', '22:50:00', '22:54:00', '22:55:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('460', '北京快乐8', '51', '13:08:00', '13:12:50', '13:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('588', '北京快乐8', '179', '23:48:00', '23:52:50', '23:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('615', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('68', '广东十分彩', '15', '11:20:00', '11:29:00', '11:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('408', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('163', '天津十分彩', '023', '12:34:00', '12:42:00', '12:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('82', '广东十分彩', '29', '13:40:00', '13:49:00', '13:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('101', '广东十分彩', '48', '16:50:00', '16:59:00', '17:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('719', '重庆时时彩', '102', '22:25:00', '22:29:00', '22:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('53', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('681', '重庆时时彩', '064', '16:30:00', '16:39:00', '16:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('920', '江西时时彩', '009', '10:20:00', '10:29:00', '10:31:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('127', '广东十分彩', '74', '21:10:00', '21:19:00', '21:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('728', '重庆时时彩', '111', '23:10:00', '23:14:00', '23:15:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('979', '江西时时彩', '068', '20:19:00', '20:27:00', '20:29:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('974', '江西时时彩', '063', '19:28:00', '19:36:00', '19:38:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('650', '重庆时时彩', '033', '11:20:00', '11:29:00', '11:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('219', '天津十分彩', '079', '21:54:00', '22:02:00', '22:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('332', '北京PK拾', '105', '17:42:00', '17:46:30', '17:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1037', '广东十一选五', '39', '15:20:00', '15:29:00', '15:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('129', '广东十分彩', '76', '21:30:00', '21:39:00', '21:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('62', '广东十分彩', '09', '10:20:00', '10:29:00', '10:30:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('984', '江西时时彩', '073', '21:10:00', '21:18:00', '21:20:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('444', '北京快乐8', '35', '11:48:00', '11:52:50', '11:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1209', '重庆十分彩', '004', '00:23:00', '00:31:00', '00:33:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('379', '北京PK拾', '152', '21:37:00', '21:41:30', '21:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('970', '江西时时彩', '059', '18:48:00', '18:56:00', '18:58:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('532', '北京快乐8', '123', '19:08:00', '19:12:50', '19:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1285', '重庆十分彩', '080', '20:53:00', '21:01:00', '21:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('679', '重庆时时彩', '062', '16:10:00', '16:19:00', '16:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('697', '重庆时时彩', '080', '19:10:00', '19:19:00', '19:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('737', '重庆时时彩', '120', '23:55:00', '23:59:00', '23:59:59', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('15', '广西十分彩', '15', '12:25:00', '12:38:00', '12:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('142', '天津十分彩', '002', '09:04:00', '09:12:00', '09:14:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('702', '重庆时时彩', '085', '20:00:00', '20:09:00', '20:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('224', '天津十分彩', '084', '22:44:00', '22:52:00', '22:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('317', '北京PK拾', '90', '16:27:00', '16:31:30', '16:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('528', '北京快乐8', '119', '18:48:00', '18:52:50', '18:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('176', '天津十分彩', '036', '14:44:00', '14:52:00', '14:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1064', '广东十一选五', '66', '19:50:00', '19:59:00', '20:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('466', '北京快乐8', '57', '13:38:00', '13:42:50', '13:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('276', '北京PK拾', '49', '13:02:00', '13:06:30', '13:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('320', '北京PK拾', '93', '16:42:00', '16:46:30', '16:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('766', '极速时时彩', '026', '13:09:00', '13:17:00', '13:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('781', '极速时时彩', '041', '15:39:00', '15:47:00', '15:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('721', '重庆时时彩', '104', '22:35:00', '22:39:00', '22:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('338', '北京PK拾', '111', '18:12:00', '18:16:30', '18:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('433', '北京快乐8', '24', '10:53:00', '10:57:50', '10:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('85', '广东十分彩', '32', '14:10:00', '14:19:00', '14:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('991', '江西时时彩', '080', '22:21:00', '22:29:00', '22:31:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('786', '极速时时彩', '046', '16:29:00', '16:37:00', '16:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('812', '极速时时彩', '072', '20:49:00', '20:57:00', '20:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('181', '天津十分彩', '041', '15:34:00', '15:42:00', '15:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1300', '重庆十分彩', '095', '23:23:00', '23:31:00', '23:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('458', '北京快乐8', '49', '12:58:00', '13:02:50', '13:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1076', '广东十一选五', '78', '21:50:00', '21:59:00', '22:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('773', '极速时时彩', '033', '14:19:00', '14:27:00', '14:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('314', '北京PK拾', '87', '16:12:00', '16:16:30', '16:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('745', '极速时时彩', '005', '09:39:00', '09:47:00', '09:49:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('232', '北京PK拾', '5', '09:22:00', '09:26:30', '09:27:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1008', '广东十一选五', '10', '10:30:00', '10:39:00', '10:40:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('217', '天津十分彩', '077', '21:34:00', '21:42:00', '21:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('102', '广东十分彩', '49', '17:00:00', '17:09:00', '17:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('492', '北京快乐8', '83', '15:48:00', '15:52:50', '15:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('42', '广西十分彩', '42', '19:10:00', '19:23:00', '19:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('712', '重庆时时彩', '095', '21:40:00', '21:49:00', '21:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('620', '重庆时时彩', '003', '00:10:00', '00:14:00', '00:15:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('264', '北京PK拾', '37', '12:02:00', '12:06:30', '12:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('672', '重庆时时彩', '055', '15:00:00', '15:09:00', '15:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1023', '广东十一选五', '25', '13:00:00', '13:09:00', '13:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('626', '重庆时时彩', '009', '00:40:00', '00:44:00', '00:45:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('119', '广东十分彩', '66', '19:50:00', '19:59:00', '20:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('385', '北京PK拾', '158', '22:07:00', '22:11:30', '22:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('87', '广东十分彩', '34', '14:30:00', '14:39:00', '14:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('538', '北京快乐8', '129', '19:38:00', '19:42:50', '19:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('614', '上海时时乐', '23', '20:58:00', '21:28:00', '21:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('938', '江西时时彩', '027', '13:23:00', '13:31:00', '13:33:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('705', '重庆时时彩', '088', '20:30:00', '20:39:00', '20:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('329', '北京PK拾', '102', '17:27:00', '17:31:30', '17:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('506', '北京快乐8', '97', '16:58:00', '17:02:50', '17:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('430', '北京快乐8', '21', '10:38:00', '10:42:50', '10:43:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('94', '广东十分彩', '41', '15:40:00', '15:49:00', '15:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('258', '北京PK拾', '31', '11:32:00', '11:36:30', '11:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('956', '江西时时彩', '045', '16:25:00', '16:34:00', '16:36:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1267', '重庆十分彩', '062', '17:53:00', '18:01:00', '18:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('685', '重庆时时彩', '068', '17:10:00', '17:19:00', '17:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('826', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('16', '广西十分彩', '16', '12:40:00', '12:53:00', '12:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1246', '重庆十分彩', '041', '14:23:00', '14:31:00', '14:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('799', '极速时时彩', '059', '18:39:00', '18:47:00', '18:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1497', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('1253', '重庆十分彩', '048', '15:33:00', '15:41:00', '15:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('324', '北京PK拾', '97', '17:02:00', '17:06:30', '17:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('177', '天津十分彩', '037', '14:54:00', '15:02:00', '15:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('571', '北京快乐8', '162', '22:23:00', '22:27:50', '22:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('326', '北京PK拾', '99', '17:12:00', '17:16:30', '17:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1051', '广东十一选五', '53', '17:40:00', '17:49:00', '17:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1286', '重庆十分彩', '081', '21:03:00', '21:11:00', '21:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('919', '江西时时彩', '008', '10:10:00', '10:18:00', '10:20:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1041', '广东十一选五', '43', '16:00:00', '16:09:00', '16:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1224', '重庆十分彩', '019', '10:43:00', '10:51:00', '10:53:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1042', '广东十一选五', '44', '16:10:00', '16:19:00', '16:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('668', '重庆时时彩', '051', '14:20:00', '14:29:00', '14:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('925', '江西时时彩', '014', '11:11:00', '11:19:00', '11:21:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('922', '江西时时彩', '011', '10:41:00', '10:49:00', '10:51:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('39', '广西十分彩', '39', '18:25:00', '18:38:00', '18:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('184', '天津十分彩', '044', '16:04:00', '16:12:00', '16:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1058', '广东十一选五', '60', '18:50:00', '18:59:00', '19:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('61', '广东十分彩', '08', '10:10:00', '10:19:00', '10:20:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('659', '重庆时时彩', '042', '12:50:00', '12:59:00', '13:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1264', '重庆十分彩', '059', '17:23:00', '17:31:00', '17:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('926', '江西时时彩', '015', '11:21:00', '11:29:00', '11:31:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('540', '北京快乐8', '131', '19:48:00', '19:52:50', '19:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('450', '北京快乐8', '41', '12:18:00', '12:22:50', '12:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('161', '天津十分彩', '021', '12:14:00', '12:22:00', '12:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('26', '广西十分彩', '26', '15:10:00', '15:23:00', '15:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1031', '广东十一选五', '33', '14:20:00', '14:29:00', '14:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('13', '广西十分彩', '13', '11:55:00', '12:08:00', '12:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('229', '北京PK拾', '2', '09:07:00', '09:11:30', '09:12:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('552', '北京快乐8', '143', '20:48:00', '20:52:50', '20:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('126', '广东十分彩', '73', '21:00:00', '21:09:00', '21:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('231', '北京PK拾', '4', '09:17:00', '09:21:30', '09:22:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('60', '广东十分彩', '07', '10:00:00', '10:09:00', '10:10:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('665', '重庆时时彩', '048', '13:50:00', '13:59:00', '14:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('360', '北京PK拾', '133', '20:02:00', '20:06:30', '20:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('286', '北京PK拾', '59', '13:52:00', '13:56:30', '13:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('44', '广西十分彩', '44', '19:40:00', '19:53:00', '19:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1070', '广东十一选五', '72', '20:50:00', '20:59:00', '21:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('686', '重庆时时彩', '069', '17:20:00', '17:29:00', '17:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('285', '北京PK拾', '58', '13:47:00', '13:51:30', '13:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('303', '北京PK拾', '76', '15:17:00', '15:21:30', '15:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('393', '北京PK拾', '166', '22:47:00', '22:51:30', '22:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('17', '广西十分彩', '17', '12:55:00', '13:08:00', '13:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('749', '极速时时彩', '009', '10:19:00', '10:27:00', '10:29:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('703', '重庆时时彩', '086', '20:10:00', '20:19:00', '20:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('271', '北京PK拾', '44', '12:37:00', '12:41:30', '12:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('722', '重庆时时彩', '105', '22:40:00', '22:44:00', '22:45:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('501', '北京快乐8', '92', '16:33:00', '16:37:50', '16:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('575', '北京快乐8', '166', '22:43:00', '22:47:50', '22:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('632', '重庆时时彩', '015', '01:10:00', '01:14:00', '01:15:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('990', '江西时时彩', '079', '22:11:00', '22:19:00', '22:21:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('359', '北京PK拾', '132', '19:57:00', '20:01:30', '20:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('72', '广东十分彩', '19', '12:00:00', '12:09:00', '12:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('116', '广东十分彩', '63', '19:20:00', '19:29:00', '19:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('311', '北京PK拾', '84', '15:57:00', '16:01:30', '16:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('387', '北京PK拾', '160', '22:17:00', '22:21:30', '22:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('10', '广西十分彩', '10', '11:10:00', '11:23:00', '11:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1033', '广东十一选五', '35', '14:40:00', '14:49:00', '14:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1297', '重庆十分彩', '092', '22:53:00', '23:01:00', '23:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1287', '重庆十分彩', '082', '21:13:00', '21:21:00', '21:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('771', '极速时时彩', '031', '13:59:00', '14:07:00', '14:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1038', '广东十一选五', '40', '15:30:00', '15:39:00', '15:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('429', '北京快乐8', '20', '10:33:00', '10:37:50', '10:38:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('699', '重庆时时彩', '082', '19:30:00', '19:39:00', '19:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('740', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('813', '极速时时彩', '073', '20:59:00', '21:07:00', '21:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('693', '重庆时时彩', '076', '18:30:00', '18:39:00', '18:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('106', '广东十分彩', '53', '17:40:00', '17:49:00', '17:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('12', '广西十分彩', '12', '11:40:00', '11:53:00', '11:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('239', '北京PK拾', '12', '09:57:00', '10:01:30', '10:02:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1204', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('169', '天津十分彩', '029', '13:34:00', '13:42:00', '13:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('553', '北京快乐8', '144', '20:53:00', '20:57:50', '20:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('811', '极速时时彩', '071', '20:39:00', '20:47:00', '20:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1495', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('597', '上海时时乐', '06', '12:28:00', '12:58:00', '13:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('680', '重庆时时彩', '063', '16:20:00', '16:29:00', '16:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('209', '天津十分彩', '069', '20:14:00', '20:22:00', '20:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1272', '重庆十分彩', '067', '18:43:00', '18:51:00', '18:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('912', '江西时时彩', '001', '09:00:00', '09:08:00', '09:10:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('368', '北京PK拾', '141', '20:42:00', '20:46:30', '20:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('809', '极速时时彩', '069', '20:19:00', '20:27:00', '20:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1027', '广东十一选五', '29', '13:40:00', '13:49:00', '13:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('57', '广东十分彩', '04', '09:30:00', '09:39:00', '09:40:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('327', '北京PK拾', '100', '17:17:00', '17:21:30', '17:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('27', '广西十分彩', '27', '15:25:00', '15:38:00', '15:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('333', '北京PK拾', '106', '17:47:00', '17:51:30', '17:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1024', '广东十一选五', '26', '13:10:00', '13:19:00', '13:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('529', '北京快乐8', '120', '18:53:00', '18:57:50', '18:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('70', '广东十分彩', '17', '11:40:00', '11:49:00', '11:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('436', '北京快乐8', '27', '11:08:00', '11:12:50', '11:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('99', '广东十分彩', '46', '16:30:00', '16:39:00', '16:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1077', '广东十一选五', '79', '22:00:00', '22:09:00', '22:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1248', '重庆十分彩', '043', '14:43:00', '14:51:00', '14:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1026', '广东十一选五', '28', '13:30:00', '13:39:00', '13:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('4', '广西十分彩', '04', '09:40:00', '09:53:00', '09:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('744', '极速时时彩', '004', '09:29:00', '09:37:00', '09:39:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('521', '北京快乐8', '112', '18:13:00', '18:17:50', '18:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('438', '北京快乐8', '29', '11:18:00', '11:22:50', '11:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1066', '广东十一选五', '68', '20:10:00', '20:19:00', '20:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1292', '重庆十分彩', '087', '22:03:00', '22:11:00', '22:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('268', '北京PK拾', '41', '12:22:00', '12:26:30', '12:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('34', '广西十分彩', '34', '17:10:00', '17:23:00', '17:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1222', '重庆十分彩', '017', '10:23:00', '10:31:00', '10:33:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1211', '重庆十分彩', '006', '00:43:00', '00:51:00', '00:53:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('20', '广西十分彩', '20', '13:40:00', '13:53:00', '13:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1227', '重庆十分彩', '022', '11:13:00', '11:21:00', '11:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('778', '极速时时彩', '038', '15:09:00', '15:17:00', '15:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('585', '北京快乐8', '176', '23:33:00', '23:37:50', '23:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('322', '北京PK拾', '95', '16:52:00', '16:56:30', '16:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('120', '广东十分彩', '67', '20:00:00', '20:09:00', '20:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('587', '北京快乐8', '178', '23:43:00', '23:47:50', '23:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('18', '广西十分彩', '18', '13:10:00', '13:23:00', '13:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('405', '北京PK拾', '178', '23:47:00', '23:51:30', '23:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('502', '北京快乐8', '93', '16:38:00', '16:42:50', '16:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('373', '北京PK拾', '146', '21:07:00', '21:11:30', '21:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('953', '江西时时彩', '042', '15:55:00', '16:03:00', '16:05:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1213', '重庆十分彩', '008', '01:03:00', '01:11:00', '01:13:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('944', '江西时时彩', '033', '14:24:00', '14:32:00', '14:34:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('941', '江西时时彩', '030', '13:53:00', '14:01:00', '14:03:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('130', '广东十分彩', '77', '21:40:00', '21:49:00', '21:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1017', '广东十一选五', '19', '12:00:00', '12:09:00', '12:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('536', '北京快乐8', '127', '19:28:00', '19:32:50', '19:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('651', '重庆时时彩', '034', '11:30:00', '11:39:00', '11:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('961', '江西时时彩', '050', '17:17:00', '17:25:00', '17:27:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('916', '江西时时彩', '005', '09:40:00', '09:48:00', '09:50:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('448', '北京快乐8', '39', '12:08:00', '12:12:50', '12:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('25', '广西十分彩', '25', '14:55:00', '15:08:00', '15:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('519', '北京快乐8', '110', '18:03:00', '18:07:50', '18:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('81', '广东十分彩', '28', '13:30:00', '13:39:00', '13:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('195', '天津十分彩', '055', '17:54:00', '18:02:00', '18:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('798', '极速时时彩', '058', '18:29:00', '18:37:00', '18:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1274', '重庆十分彩', '069', '19:03:00', '19:11:00', '19:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('93', '广东十分彩', '40', '15:30:00', '15:39:00', '15:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('88', '广东十分彩', '35', '14:40:00', '14:49:00', '14:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('734', '重庆时时彩', '117', '23:40:00', '23:44:00', '23:45:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('490', '北京快乐8', '81', '15:38:00', '15:42:50', '15:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('806', '极速时时彩', '066', '19:49:00', '19:57:00', '19:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('671', '重庆时时彩', '054', '14:50:00', '14:59:00', '15:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('556', '北京快乐8', '147', '21:08:00', '21:12:50', '21:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1236', '重庆十分彩', '031', '12:43:00', '12:51:00', '12:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('131', '广东十分彩', '78', '21:50:00', '21:59:00', '22:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1240', '重庆十分彩', '035', '13:23:00', '13:31:00', '13:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('104', '广东十分彩', '51', '17:20:00', '17:29:00', '17:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('435', '北京快乐8', '26', '11:03:00', '11:07:50', '11:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('548', '北京快乐8', '139', '20:28:00', '20:32:50', '20:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1242', '重庆十分彩', '037', '13:43:00', '13:51:00', '13:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1277', '重庆十分彩', '072', '19:33:00', '19:41:00', '19:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('480', '北京快乐8', '71', '14:48:00', '14:52:50', '14:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('5', '广西十分彩', '05', '09:55:00', '10:08:00', '10:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('440', '北京快乐8', '31', '11:28:00', '11:32:50', '11:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('140', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('1030', '广东十一选五', '32', '14:10:00', '14:19:00', '14:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('475', '北京快乐8', '66', '14:23:00', '14:27:50', '14:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('741', '极速时时彩', '001', '08:59:00', '09:07:00', '09:09:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('170', '天津十分彩', '030', '13:44:00', '13:52:00', '13:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1258', '重庆十分彩', '053', '16:23:00', '16:31:00', '16:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('594', '上海时时乐', '03', '10:58:00', '11:28:00', '11:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('1069', '广东十一选五', '71', '20:40:00', '20:49:00', '20:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('801', '极速时时彩', '061', '18:59:00', '19:07:00', '19:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('255', '北京PK拾', '28', '11:17:00', '11:21:30', '11:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1053', '广东十一选五', '55', '18:00:00', '18:09:00', '18:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('711', '重庆时时彩', '094', '21:30:00', '21:39:00', '21:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1279', '重庆十分彩', '074', '19:53:00', '20:01:00', '20:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('297', '北京PK拾', '70', '14:47:00', '14:51:30', '14:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('715', '重庆时时彩', '098', '22:05:00', '22:09:00', '22:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('541', '北京快乐8', '132', '19:53:00', '19:57:50', '19:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('292', '北京PK拾', '65', '14:22:00', '14:26:30', '14:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1203', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('383', '北京PK拾', '156', '21:57:00', '22:01:30', '22:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('398', '北京PK拾', '171', '23:12:00', '23:16:30', '23:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('259', '北京PK拾', '32', '11:37:00', '11:41:30', '11:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('770', '极速时时彩', '030', '13:49:00', '13:57:00', '13:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('391', '北京PK拾', '164', '22:37:00', '22:41:30', '22:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1078', '广东十一选五', '80', '22:10:00', '22:19:00', '22:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1050', '广东十一选五', '52', '17:30:00', '17:39:00', '17:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1268', '重庆十分彩', '063', '18:03:00', '18:11:00', '18:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('11', '广西十分彩', '11', '11:25:00', '11:38:00', '11:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1283', '重庆十分彩', '078', '20:33:00', '20:41:00', '20:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('658', '重庆时时彩', '041', '12:40:00', '12:49:00', '12:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('427', '北京快乐8', '18', '10:23:00', '10:27:50', '10:28:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('113', '广东十分彩', '60', '18:50:00', '18:59:00', '19:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('738', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('793', '极速时时彩', '053', '17:39:00', '17:47:00', '17:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('775', '极速时时彩', '035', '14:39:00', '14:47:00', '14:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('980', '江西时时彩', '069', '20:29:00', '20:37:00', '20:39:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('153', '天津十分彩', '013', '10:54:00', '11:02:00', '11:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('804', '极速时时彩', '064', '19:29:00', '19:37:00', '19:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('687', '重庆时时彩', '070', '17:30:00', '17:39:00', '17:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('202', '天津十分彩', '062', '19:04:00', '19:12:00', '19:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('463', '北京快乐8', '54', '13:23:00', '13:27:50', '13:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('325', '北京PK拾', '98', '17:07:00', '17:11:30', '17:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('677', '重庆时时彩', '060', '15:50:00', '15:59:00', '16:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('298', '北京PK拾', '71', '14:52:00', '14:56:30', '14:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('261', '北京PK拾', '34', '11:47:00', '11:51:30', '11:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('787', '极速时时彩', '047', '16:39:00', '16:47:00', '16:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('384', '北京PK拾', '157', '22:02:00', '22:06:30', '22:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('180', '天津十分彩', '040', '15:24:00', '15:32:00', '15:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('669', '重庆时时彩', '052', '14:30:00', '14:39:00', '14:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('654', '重庆时时彩', '037', '12:00:00', '12:09:00', '12:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('549', '北京快乐8', '140', '20:33:00', '20:37:50', '20:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('334', '北京PK拾', '107', '17:52:00', '17:56:30', '17:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('788', '极速时时彩', '048', '16:49:00', '16:57:00', '16:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('580', '北京快乐8', '171', '23:08:00', '23:12:50', '23:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1219', '重庆十分彩', '014', '02:03:00', '10:01:00', '10:03:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('509', '北京快乐8', '100', '17:13:00', '17:17:50', '17:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('550', '北京快乐8', '141', '20:38:00', '20:42:50', '20:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('690', '重庆时时彩', '073', '18:00:00', '18:09:00', '18:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('948', '江西时时彩', '037', '15:04:00', '15:12:00', '15:14:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1212', '重庆十分彩', '007', '00:53:00', '01:01:00', '01:03:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('914', '江西时时彩', '003', '09:20:00', '09:28:00', '09:30:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('572', '北京快乐8', '163', '22:28:00', '22:32:50', '22:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('141', '天津十分彩', '001', '08:54:00', '09:02:00', '09:04:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1047', '广东十一选五', '49', '17:00:00', '17:09:00', '17:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('611', '上海时时乐', '20', '19:28:00', '19:58:00', '20:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('557', '北京快乐8', '148', '21:13:00', '21:17:50', '21:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('449', '北京快乐8', '40', '12:13:00', '12:17:50', '12:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('452', '北京快乐8', '43', '12:28:00', '12:32:50', '12:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1005', '广东十一选五', '07', '10:00:00', '10:09:00', '10:10:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('137', '广东十分彩', '84', '22:50:00', '22:59:00', '23:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('28', '广西十分彩', '28', '15:40:00', '15:53:00', '15:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1293', '重庆十分彩', '088', '22:13:00', '22:21:00', '22:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('963', '江西时时彩', '052', '17:37:00', '17:45:00', '17:47:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1002', '广东十一选五', '04', '09:30:00', '09:39:00', '09:40:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1281', '重庆十分彩', '076', '20:13:00', '20:21:00', '20:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('289', '北京PK拾', '62', '14:07:00', '14:11:30', '14:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1075', '广东十一选五', '77', '21:40:00', '21:49:00', '21:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('118', '广东十分彩', '65', '19:40:00', '19:49:00', '19:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('539', '北京快乐8', '130', '19:43:00', '19:47:50', '19:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('243', '北京PK拾', '16', '10:17:00', '10:21:30', '10:22:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('785', '极速时时彩', '045', '16:19:00', '16:27:00', '16:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('369', '北京PK拾', '142', '20:47:00', '20:51:30', '20:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('647', '重庆时时彩', '030', '10:50:00', '10:59:00', '11:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('304', '北京PK拾', '77', '15:22:00', '15:26:30', '15:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('656', '重庆时时彩', '039', '12:20:00', '12:29:00', '12:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('266', '北京PK拾', '39', '12:12:00', '12:16:30', '12:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('649', '重庆时时彩', '032', '11:10:00', '11:19:00', '11:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('701', '重庆时时彩', '084', '19:50:00', '19:59:00', '20:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1019', '广东十一选五', '21', '12:20:00', '12:29:00', '12:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('71', '广东十分彩', '18', '11:50:00', '11:59:00', '12:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1217', '重庆十分彩', '012', '01:43:00', '01:51:00', '01:53:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('477', '北京快乐8', '68', '14:33:00', '14:37:50', '14:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('635', '重庆时时彩', '018', '01:25:00', '01:29:00', '01:30:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('425', '北京快乐8', '16', '10:13:00', '10:17:50', '10:18:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('336', '北京PK拾', '109', '18:02:00', '18:06:30', '18:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('742', '极速时时彩', '002', '09:09:00', '09:17:00', '09:19:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1262', '重庆十分彩', '057', '17:03:00', '17:11:00', '17:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('35', '广西十分彩', '35', '17:25:00', '17:38:00', '17:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('282', '北京PK拾', '55', '13:32:00', '13:36:30', '13:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('621', '重庆时时彩', '004', '00:15:00', '00:19:00', '00:20:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('684', '重庆时时彩', '067', '17:00:00', '17:09:00', '17:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('437', '北京快乐8', '28', '11:13:00', '11:17:50', '11:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('376', '北京PK拾', '149', '21:22:00', '21:26:30', '21:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1265', '重庆十分彩', '060', '17:33:00', '17:41:00', '17:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('218', '天津十分彩', '078', '21:44:00', '21:52:00', '21:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('924', '江西时时彩', '013', '11:01:00', '11:09:00', '11:11:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('92', '广东十分彩', '39', '15:20:00', '15:29:00', '15:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('50', '广西十分彩', '50', '21:10:00', '21:23:00', '21:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('481', '北京快乐8', '72', '14:53:00', '14:57:50', '14:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('547', '北京快乐8', '138', '20:23:00', '20:27:50', '20:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('413', '北京快乐8', '4', '09:13:00', '09:17:50', '09:18:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('819', '极速时时彩', '079', '21:59:00', '22:07:00', '22:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('411', '北京快乐8', '2', '09:03:00', '09:07:50', '09:08:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1073', '广东十一选五', '75', '21:20:00', '21:29:00', '21:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('291', '北京PK拾', '64', '14:17:00', '14:21:30', '14:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('112', '广东十分彩', '59', '18:40:00', '18:49:00', '18:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1301', '重庆十分彩', '096', '23:33:00', '23:41:00', '23:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('30', '广西十分彩', '30', '16:10:00', '16:23:00', '16:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('305', '北京PK拾', '78', '15:27:00', '15:31:30', '15:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('678', '重庆时时彩', '061', '16:00:00', '16:09:00', '16:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('655', '重庆时时彩', '038', '12:10:00', '12:19:00', '12:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('942', '江西时时彩', '031', '14:03:00', '14:12:00', '14:14:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('65', '广东十分彩', '12', '10:50:00', '10:59:00', '11:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('194', '天津十分彩', '054', '17:44:00', '17:52:00', '17:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('971', '江西时时彩', '060', '18:58:00', '19:06:00', '19:08:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('235', '北京PK拾', '8', '09:37:00', '09:41:30', '09:42:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('364', '北京PK拾', '137', '20:22:00', '20:26:30', '20:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('763', '极速时时彩', '023', '12:39:00', '12:47:00', '12:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('75', '广东十分彩', '22', '12:30:00', '12:39:00', '12:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('146', '天津十分彩', '006', '09:44:00', '09:52:00', '09:54:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('584', '北京快乐8', '175', '23:28:00', '23:32:50', '23:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('49', '广西十分彩', '49', '20:55:00', '21:08:00', '21:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('414', '北京快乐8', '5', '09:18:00', '09:22:50', '09:23:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('188', '天津十分彩', '048', '16:44:00', '16:52:00', '16:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('290', '北京PK拾', '63', '14:12:00', '14:16:30', '14:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1223', '重庆十分彩', '018', '10:33:00', '10:41:00', '10:43:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('631', '重庆时时彩', '014', '01:05:00', '01:09:00', '01:10:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('608', '上海时时乐', '17', '17:58:00', '18:28:00', '18:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('1273', '重庆十分彩', '068', '18:53:00', '19:01:00', '19:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('975', '江西时时彩', '064', '19:38:00', '19:47:00', '19:49:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('296', '北京PK拾', '69', '14:42:00', '14:46:30', '14:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('827', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('593', '上海时时乐', '02', '10:28:00', '10:58:00', '11:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('216', '天津十分彩', '076', '21:24:00', '21:32:00', '21:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('288', '北京PK拾', '61', '14:02:00', '14:06:30', '14:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('357', '北京PK拾', '130', '19:47:00', '19:51:30', '19:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('213', '天津十分彩', '073', '20:54:00', '21:02:00', '21:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('158', '天津十分彩', '018', '11:44:00', '11:52:00', '11:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('352', '北京PK拾', '125', '19:22:00', '19:26:30', '19:27:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('47', '广西十分彩', '47', '20:25:00', '20:38:00', '20:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('417', '北京快乐8', '8', '09:33:00', '09:37:50', '09:38:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('512', '北京快乐8', '103', '17:28:00', '17:32:50', '17:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('278', '北京PK拾', '51', '13:12:00', '13:16:30', '13:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('915', '江西时时彩', '004', '09:30:00', '09:38:00', '09:40:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('573', '北京快乐8', '164', '22:33:00', '22:37:50', '22:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('144', '天津十分彩', '004', '09:24:00', '09:32:00', '09:34:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('31', '广西十分彩', '31', '16:25:00', '16:38:00', '16:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('237', '北京PK拾', '10', '09:47:00', '09:51:30', '09:52:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('339', '北京PK拾', '112', '18:17:00', '18:21:30', '18:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('653', '重庆时时彩', '036', '11:50:00', '11:59:00', '12:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('718', '重庆时时彩', '101', '22:20:00', '22:24:00', '22:25:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('186', '天津十分彩', '046', '16:24:00', '16:32:00', '16:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('372', '北京PK拾', '145', '21:02:00', '21:06:30', '21:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('236', '北京PK拾', '9', '09:42:00', '09:46:30', '09:47:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('923', '江西时时彩', '012', '10:51:00', '10:59:00', '11:01:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('321', '北京PK拾', '94', '16:47:00', '16:51:30', '16:52:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('759', '极速时时彩', '019', '11:59:00', '12:07:00', '12:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('199', '天津十分彩', '059', '18:34:00', '18:42:00', '18:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('375', '北京PK拾', '148', '21:17:00', '21:21:30', '21:22:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('709', '重庆时时彩', '092', '21:10:00', '21:19:00', '21:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('537', '北京快乐8', '128', '19:33:00', '19:37:50', '19:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1046', '广东十一选五', '48', '16:50:00', '16:59:00', '17:00:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('968', '江西时时彩', '057', '18:27:00', '18:36:00', '18:38:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('768', '极速时时彩', '028', '13:29:00', '13:37:00', '13:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('272', '北京PK拾', '45', '12:42:00', '12:46:30', '12:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('447', '北京快乐8', '38', '12:03:00', '12:07:50', '12:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('555', '北京快乐8', '146', '21:03:00', '21:07:50', '21:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1054', '广东十一选五', '56', '18:10:00', '18:19:00', '18:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('507', '北京快乐8', '98', '17:03:00', '17:07:50', '17:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('254', '北京PK拾', '27', '11:12:00', '11:16:30', '11:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('988', '江西时时彩', '077', '21:50:00', '21:58:00', '22:00:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('446', '北京快乐8', '37', '11:58:00', '12:02:50', '12:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('933', '江西时时彩', '022', '12:32:00', '12:40:00', '12:42:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1238', '重庆十分彩', '033', '13:03:00', '13:11:00', '13:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('972', '江西时时彩', '061', '19:08:00', '19:16:00', '19:18:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('319', '北京PK拾', '92', '16:37:00', '16:41:30', '16:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('22', '广西十分彩', '22', '14:10:00', '14:23:00', '14:25:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('355', '北京PK拾', '128', '19:37:00', '19:41:30', '19:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('747', '极速时时彩', '007', '09:59:00', '10:07:00', '10:09:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('739', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('582', '北京快乐8', '173', '23:18:00', '23:22:50', '23:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('203', '天津十分彩', '063', '19:14:00', '19:22:00', '19:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('390', '北京PK拾', '163', '22:32:00', '22:36:30', '22:37:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('464', '北京快乐8', '55', '13:28:00', '13:32:50', '13:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('287', '北京PK拾', '60', '13:57:00', '14:01:30', '14:02:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('794', '极速时时彩', '054', '17:49:00', '17:57:00', '17:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1071', '广东十一选五', '73', '21:00:00', '21:09:00', '21:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1059', '广东十一选五', '61', '19:00:00', '19:09:00', '19:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('601', '上海时时乐', '10', '14:28:00', '14:58:00', '15:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('596', '上海时时乐', '05', '11:58:00', '12:28:00', '12:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('1288', '重庆十分彩', '083', '21:23:00', '21:31:00', '21:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('807', '极速时时彩', '067', '19:59:00', '20:07:00', '20:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('185', '天津十分彩', '045', '16:14:00', '16:22:00', '16:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1278', '重庆十分彩', '073', '19:43:00', '19:51:00', '19:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('657', '重庆时时彩', '040', '12:30:00', '12:39:00', '12:40:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('283', '北京PK拾', '56', '13:37:00', '13:41:30', '13:42:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1284', '重庆十分彩', '079', '20:43:00', '20:51:00', '20:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1261', '重庆十分彩', '056', '16:53:00', '17:01:00', '17:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('523', '北京快乐8', '114', '18:23:00', '18:27:50', '18:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('997', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('196', '天津十分彩', '056', '18:04:00', '18:12:00', '18:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('269', '北京PK拾', '42', '12:27:00', '12:31:30', '12:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1228', '重庆十分彩', '023', '11:23:00', '11:31:00', '11:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('985', '江西时时彩', '074', '21:20:00', '21:28:00', '21:30:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('156', '天津十分彩', '016', '11:24:00', '11:32:00', '11:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('927', '江西时时彩', '016', '11:31:00', '11:40:00', '11:42:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('692', '重庆时时彩', '075', '18:20:00', '18:29:00', '18:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('931', '江西时时彩', '020', '12:12:00', '12:20:00', '12:22:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1039', '广东十一选五', '41', '15:40:00', '15:49:00', '15:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('51', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('1237', '重庆十分彩', '032', '12:53:00', '13:01:00', '13:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('716', '重庆时时彩', '099', '22:10:00', '22:14:00', '22:15:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1255', '重庆十分彩', '050', '15:53:00', '16:01:00', '16:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('599', '上海时时乐', '08', '13:28:00', '13:58:00', '14:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('955', '江西时时彩', '044', '16:15:00', '16:23:00', '16:25:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('454', '北京快乐8', '45', '12:38:00', '12:42:50', '12:43:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('200', '天津十分彩', '060', '18:44:00', '18:52:00', '18:54:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('456', '北京快乐8', '47', '12:48:00', '12:52:50', '12:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('348', '北京PK拾', '121', '19:02:00', '19:06:30', '19:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('689', '重庆时时彩', '072', '17:50:00', '17:59:00', '18:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1249', '重庆十分彩', '044', '14:53:00', '15:01:00', '15:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('132', '广东十分彩', '79', '22:00:00', '22:09:00', '22:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('670', '重庆时时彩', '053', '14:40:00', '14:49:00', '14:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('729', '重庆时时彩', '112', '23:15:00', '23:19:00', '23:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('560', '北京快乐8', '151', '21:28:00', '21:32:50', '21:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('664', '重庆时时彩', '047', '13:40:00', '13:49:00', '13:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('98', '广东十分彩', '45', '16:20:00', '16:29:00', '16:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('404', '北京PK拾', '177', '23:42:00', '23:46:30', '23:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('265', '北京PK拾', '38', '12:07:00', '12:11:30', '12:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1295', '重庆十分彩', '090', '22:33:00', '22:41:00', '22:43:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1044', '广东十一选五', '46', '16:30:00', '16:39:00', '16:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('3', '广西十分彩', '03', '09:25:00', '09:38:00', '09:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('252', '北京PK拾', '25', '11:02:00', '11:06:30', '11:07:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('932', '江西时时彩', '021', '12:22:00', '12:30:00', '12:32:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('145', '天津十分彩', '005', '09:34:00', '09:42:00', '09:44:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('7', '广西十分彩', '07', '10:25:00', '10:38:00', '10:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('732', '重庆时时彩', '115', '23:30:00', '23:34:00', '23:35:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('510', '北京快乐8', '101', '17:18:00', '17:22:50', '17:23:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('565', '北京快乐8', '156', '21:53:00', '21:57:50', '21:58:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('780', '极速时时彩', '040', '15:29:00', '15:37:00', '15:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('350', '北京PK拾', '123', '19:12:00', '19:16:30', '19:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('946', '江西时时彩', '035', '14:44:00', '14:52:00', '14:54:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('676', '重庆时时彩', '059', '15:40:00', '15:49:00', '15:50:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('40', '广西十分彩', '40', '18:40:00', '18:53:00', '18:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('179', '天津十分彩', '039', '15:14:00', '15:22:00', '15:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('636', '重庆时时彩', '019', '01:30:00', '01:34:00', '01:35:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('223', '天津十分彩', '083', '22:34:00', '22:42:00', '22:44:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('151', '天津十分彩', '011', '10:34:00', '10:42:00', '10:44:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('667', '重庆时时彩', '050', '14:10:00', '14:19:00', '14:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('59', '广东十分彩', '06', '09:50:00', '09:59:00', '10:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('964', '江西时时彩', '053', '17:47:00', '17:55:00', '17:57:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1011', '广东十一选五', '13', '11:00:00', '11:09:00', '11:10:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('790', '极速时时彩', '050', '17:09:00', '17:17:00', '17:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('148', '天津十分彩', '008', '10:04:00', '10:12:00', '10:14:00', 'OK', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('167', '天津十分彩', '027', '13:14:00', '13:22:00', '13:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('356', '北京PK拾', '129', '19:42:00', '19:46:30', '19:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('428', '北京快乐8', '19', '10:28:00', '10:32:50', '10:33:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('704', '重庆时时彩', '087', '20:20:00', '20:29:00', '20:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('617', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('800', '极速时时彩', '060', '18:49:00', '18:57:00', '18:59:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1496', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('394', '北京PK拾', '167', '22:52:00', '22:56:30', '22:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('48', '广西十分彩', '48', '20:40:00', '20:53:00', '20:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1263', '重庆十分彩', '058', '17:13:00', '17:21:00', '17:23:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('494', '北京快乐8', '85', '15:58:00', '16:02:50', '16:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1049', '广东十一选五', '51', '17:20:00', '17:29:00', '17:30:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('66', '广东十分彩', '13', '11:00:00', '11:09:00', '11:10:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('1048', '广东十一选五', '50', '17:10:00', '17:19:00', '17:20:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('973', '江西时时彩', '062', '19:18:00', '19:26:00', '19:28:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('424', '北京快乐8', '15', '10:08:00', '10:12:50', '10:13:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('535', '北京快乐8', '126', '19:23:00', '19:27:50', '19:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1057', '广东十一选五', '59', '18:40:00', '18:49:00', '18:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('986', '江西时时彩', '075', '21:30:00', '21:38:00', '21:40:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('496', '北京快乐8', '87', '16:08:00', '16:12:50', '16:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('792', '极速时时彩', '052', '17:29:00', '17:37:00', '17:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('796', '极速时时彩', '056', '18:09:00', '18:17:00', '18:19:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('245', '北京PK拾', '18', '10:27:00', '10:31:30', '10:32:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('825', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('374', '北京PK拾', '147', '21:12:00', '21:16:30', '21:17:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('189', '天津十分彩', '049', '16:54:00', '17:02:00', '17:04:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('751', '极速时时彩', '011', '10:39:00', '10:47:00', '10:49:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('563', '北京快乐8', '154', '21:43:00', '21:47:50', '21:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('513', '北京快乐8', '104', '17:33:00', '17:37:50', '17:38:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('983', '江西时时彩', '072', '21:00:00', '21:08:00', '21:10:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('476', '北京快乐8', '67', '14:28:00', '14:32:50', '14:33:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('823', '极速时时彩', '083', '22:39:00', '22:47:00', '22:49:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('978', '江西时时彩', '067', '20:09:00', '20:17:00', '20:19:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('928', '江西时时彩', '017', '11:42:00', '11:49:00', '11:52:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('660', '重庆时时彩', '043', '13:00:00', '13:09:00', '13:10:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('432', '北京快乐8', '23', '10:48:00', '10:52:50', '10:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('160', '天津十分彩', '020', '12:04:00', '12:12:00', '12:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1020', '广东十一选五', '22', '12:30:00', '12:39:00', '12:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('1000', '广东十一选五', '02', '09:10:00', '09:19:00', '09:20:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('637', '重庆时时彩', '020', '01:35:00', '01:39:00', '01:40:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('940', '江西时时彩', '029', '13:43:00', '13:51:00', '13:53:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('173', '天津十分彩', '033', '14:14:00', '14:22:00', '14:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('1244', '重庆十分彩', '039', '14:03:00', '14:11:00', '14:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1291', '重庆十分彩', '086', '21:53:00', '22:01:00', '22:03:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('720', '重庆时时彩', '103', '22:30:00', '22:34:00', '22:35:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('994', '江西时时彩', '083', '22:51:00', '22:59:00', '23:01:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('960', '江西时时彩', '049', '17:07:00', '17:15:00', '17:17:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('625', '重庆时时彩', '008', '00:35:00', '00:39:00', '00:40:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('470', '北京快乐8', '61', '13:58:00', '14:02:50', '14:03:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('628', '重庆时时彩', '011', '00:50:00', '00:54:00', '00:55:00', 'OK', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('613', '上海时时乐', '22', '20:28:00', '20:58:00', '21:00:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('33', '广西十分彩', '33', '16:55:00', '17:08:00', '17:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('41', '广西十分彩', '41', '18:55:00', '19:08:00', '19:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('1207', '重庆十分彩', '002', '00:03:00', '00:11:00', '00:13:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('583', '北京快乐8', '174', '23:23:00', '23:27:50', '23:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('473', '北京快乐8', '64', '14:13:00', '14:17:50', '14:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('918', '江西时时彩', '007', '10:00:00', '10:08:00', '10:10:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('495', '北京快乐8', '86', '16:03:00', '16:07:50', '16:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('29', '广西十分彩', '29', '15:55:00', '16:08:00', '16:10:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('559', '北京快乐8', '150', '21:23:00', '21:27:50', '21:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1063', '广东十一选五', '65', '19:40:00', '19:49:00', '19:50:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('56', '广东十分彩', '03', '09:20:00', '09:29:00', '09:30:00', 'OK', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('543', '北京快乐8', '134', '20:03:00', '20:07:50', '20:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('415', '北京快乐8', '6', '09:23:00', '09:27:50', '09:28:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('1302', '重庆十分彩', '097', '23:43:00', '23:51:00', '23:53:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('598', '上海时时乐', '07', '12:58:00', '13:28:00', '13:30:00', ' ', 'shssl');
INSERT INTO `lottery_schedule` VALUES ('698', '重庆时时彩', '081', '19:20:00', '19:29:00', '19:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('487', '北京快乐8', '78', '15:23:00', '15:27:50', '15:28:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('691', '重庆时时彩', '074', '18:10:00', '18:19:00', '18:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('43', '广西十分彩', '43', '19:25:00', '19:38:00', '19:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('935', '江西时时彩', '024', '12:52:00', '13:01:00', '13:03:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1215', '重庆十分彩', '010', '01:23:00', '01:31:00', '01:33:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('515', '北京快乐8', '106', '17:43:00', '17:47:50', '17:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('91', '广东十分彩', '38', '15:10:00', '15:19:00', '15:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('52', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('215', '天津十分彩', '075', '21:14:00', '21:22:00', '21:24:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('810', '极速时时彩', '070', '20:29:00', '20:37:00', '20:39:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('423', '北京快乐8', '14', '10:03:00', '10:07:50', '10:08:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('77', '广东十分彩', '24', '12:50:00', '12:59:00', '13:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('168', '天津十分彩', '028', '13:24:00', '13:32:00', '13:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('533', '北京快乐8', '124', '19:13:00', '19:17:50', '19:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('174', '天津十分彩', '034', '14:24:00', '14:32:00', '14:34:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('421', '北京快乐8', '12', '09:53:00', '09:57:50', '09:58:00', 'OK', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('479', '北京快乐8', '70', '14:43:00', '14:47:50', '14:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('226', '-------------', '-------------', null, null, null, ' ', null);
INSERT INTO `lottery_schedule` VALUES ('1006', '广东十一选五', '08', '10:10:00', '10:19:00', '10:20:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('748', '极速时时彩', '008', '10:09:00', '10:17:00', '10:19:00', 'OK', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1007', '广东十一选五', '09', '10:20:00', '10:29:00', '10:30:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('401', '北京PK拾', '174', '23:27:00', '23:31:30', '23:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('134', '广东十分彩', '81', '22:20:00', '22:29:00', '22:30:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('107', '广东十分彩', '54', '17:50:00', '17:59:00', '18:00:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('947', '江西时时彩', '036', '14:54:00', '15:02:00', '15:04:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1080', '广东十一选五', '82', '22:30:00', '22:39:00', '22:40:00', ' ', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('791', '极速时时彩', '051', '17:19:00', '17:27:00', '17:29:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('1294', '重庆十分彩', '089', '22:23:00', '22:31:00', '22:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('32', '广西十分彩', '32', '16:40:00', '16:53:00', '16:55:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('504', '北京快乐8', '95', '16:48:00', '16:52:50', '16:53:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('673', '重庆时时彩', '056', '15:10:00', '15:19:00', '15:20:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('19', '广西十分彩', '19', '13:25:00', '13:38:00', '13:40:00', ' ', 'gxkl10f');
INSERT INTO `lottery_schedule` VALUES ('79', '广东十分彩', '26', '13:10:00', '13:19:00', '13:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('281', '北京PK拾', '54', '13:27:00', '13:31:30', '13:32:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('753', '极速时时彩', '013', '10:59:00', '11:07:00', '11:09:00', ' ', 'tjssc');
INSERT INTO `lottery_schedule` VALUES ('472', '北京快乐8', '63', '14:08:00', '14:12:50', '14:13:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('124', '广东十分彩', '71', '20:40:00', '20:49:00', '20:50:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('190', '天津十分彩', '050', '17:04:00', '17:12:00', '17:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('253', '北京PK拾', '26', '11:07:00', '11:11:30', '11:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('250', '北京PK拾', '23', '10:52:00', '10:56:30', '10:57:00', 'OK', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('937', '江西时时彩', '026', '13:13:00', '13:21:00', '13:23:00', ' ', 'jxssc');
INSERT INTO `lottery_schedule` VALUES ('1221', '重庆十分彩', '016', '10:13:00', '10:21:00', '10:23:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('683', '重庆时时彩', '066', '16:50:00', '16:59:00', '17:00:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('1256', '重庆十分彩', '051', '16:03:00', '16:11:00', '16:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1220', '重庆十分彩', '015', '10:03:00', '10:11:00', '10:13:00', 'OK', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1226', '重庆十分彩', '021', '11:03:00', '11:11:00', '11:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1280', '重庆十分彩', '075', '20:03:00', '20:11:00', '20:13:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('1003', '广东十一选五', '05', '09:40:00', '09:49:00', '09:50:00', 'OK', 'gd11x5');
INSERT INTO `lottery_schedule` VALUES ('551', '北京快乐8', '142', '20:43:00', '20:47:50', '20:48:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('67', '广东十分彩', '14', '11:10:00', '11:19:00', '11:20:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('313', '北京PK拾', '86', '16:07:00', '16:11:30', '16:12:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('1270', '重庆十分彩', '065', '18:23:00', '18:31:00', '18:33:00', ' ', 'cqkl10f');
INSERT INTO `lottery_schedule` VALUES ('208', '天津十分彩', '068', '20:04:00', '20:12:00', '20:14:00', ' ', 'tjkl10f');
INSERT INTO `lottery_schedule` VALUES ('260', '北京PK拾', '33', '11:42:00', '11:46:30', '11:47:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('382', '北京PK拾', '155', '21:52:00', '21:56:30', '21:57:00', ' ', 'bjpk10');
INSERT INTO `lottery_schedule` VALUES ('117', '广东十分彩', '64', '19:30:00', '19:39:00', '19:40:00', ' ', 'gdkl10f');
INSERT INTO `lottery_schedule` VALUES ('497', '北京快乐8', '88', '16:13:00', '16:17:50', '16:18:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('731', '重庆时时彩', '114', '23:25:00', '23:29:00', '23:30:00', ' ', 'cqssc');
INSERT INTO `lottery_schedule` VALUES ('459', '北京快乐8', '50', '13:03:00', '13:07:50', '13:08:00', ' ', 'bjkl8');
INSERT INTO `lottery_schedule` VALUES ('54', '广东十分彩', '01', '09:00:00', '09:09:00', '09:10:00', 'OK', 'gdkl10f');

-- ----------------------------
-- Table structure for `lq_match`
-- ----------------------------
DROP TABLE IF EXISTS `lq_match`;
CREATE TABLE `lq_match` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Match_ID` varchar(50) NOT NULL,
  `Match_Date` varchar(20) DEFAULT NULL,
  `Match_Time` varchar(20) DEFAULT NULL,
  `Match_Name` varchar(50) NOT NULL,
  `Match_Master` varchar(50) NOT NULL,
  `Match_Guest` varchar(50) NOT NULL,
  `Match_IsLose` varchar(2) DEFAULT NULL,
  `Match_Type` int(1) unsigned DEFAULT NULL,
  `Match_ShowType` varchar(2) DEFAULT NULL,
  `Match_Ho` double DEFAULT NULL,
  `Match_Ao` double DEFAULT NULL,
  `Match_RGG` varchar(15) DEFAULT NULL,
  `Match_DxGG` varchar(15) DEFAULT NULL,
  `Match_Dxdpl` double DEFAULT NULL,
  `Match_Dxxpl` double DEFAULT NULL,
  `Match_Dsdpl` double DEFAULT NULL,
  `Match_Dsspl` double DEFAULT NULL,
  `Match_BzM` double DEFAULT NULL,
  `Match_BzG` double DEFAULT NULL,
  `Match_BzH` double DEFAULT NULL,
  `Match_Score` varchar(10) DEFAULT NULL,
  `Match_JS` int(1) unsigned DEFAULT '0',
  `Match_AddDate` datetime DEFAULT NULL,
  `Match_CoverDate` datetime DEFAULT NULL,
  `Match_Allowds` int(3) unsigned DEFAULT '0',
  `Match_Allowdj` int(3) unsigned DEFAULT '0',
  `Match_Allowg` int(3) unsigned DEFAULT '0',
  `Match_Allowrf` int(3) unsigned DEFAULT '0',
  `Match_Allowzc` int(3) unsigned DEFAULT '0',
  `Match_IsShowds` int(3) unsigned DEFAULT '1',
  `Match_IsShowdj` int(3) unsigned DEFAULT '1',
  `Match_IsShowg` int(3) unsigned DEFAULT '1',
  `Match_IsShowrf` int(3) unsigned DEFAULT '1',
  `Match_IsShowzc` int(3) unsigned DEFAULT '1',
  `Match_StopUpdateds` int(3) unsigned DEFAULT '0',
  `Match_StopUpdatedj` int(3) unsigned DEFAULT '0',
  `Match_StopUpdateg` int(3) unsigned DEFAULT '0',
  `Match_StopUpdaterf` int(3) unsigned DEFAULT '0',
  `Match_StopUpdatezc` int(3) unsigned DEFAULT '0',
  `Match_oneScore` varchar(10) DEFAULT NULL,
  `Match_twoScore` varchar(50) DEFAULT NULL,
  `Match_threeScore` varchar(50) DEFAULT NULL,
  `Match_fourScore` varchar(50) DEFAULT NULL,
  `Match_upScore` varchar(50) DEFAULT NULL,
  `Match_downScore` varchar(50) DEFAULT NULL,
  `Match_MasterID` varchar(15) DEFAULT NULL,
  `Match_GuestID` varchar(15) DEFAULT NULL,
  `Match_MatchTime` varchar(30) DEFAULT NULL,
  `Match_Allowb` int(3) unsigned DEFAULT '0',
  `Match_IsShowb` int(3) unsigned DEFAULT '1',
  `MB_Inball_1st` int(11) DEFAULT NULL,
  `MB_Inball_2st` int(11) DEFAULT NULL,
  `MB_Inball_3st` int(11) DEFAULT NULL,
  `MB_Inball_4st` int(11) DEFAULT NULL,
  `MB_Inball_Add` int(11) DEFAULT NULL,
  `TG_Inball_1st` int(11) DEFAULT NULL,
  `TG_Inball_2st` int(11) DEFAULT NULL,
  `TG_Inball_3st` int(11) DEFAULT NULL,
  `TG_Inball_4st` int(11) DEFAULT NULL,
  `TG_Inball_Add` int(11) DEFAULT NULL,
  `MB_Inball` varchar(5) DEFAULT '',
  `TG_Inball` varchar(5) DEFAULT '',
  `MB_Inball_HR` int(11) DEFAULT NULL,
  `MB_Inball_ER` int(11) DEFAULT NULL,
  `TG_Inball_HR` int(11) DEFAULT NULL,
  `TG_Inball_ER` int(11) DEFAULT NULL,
  `MB_Inball_OK` varchar(5) DEFAULT '',
  `TG_Inball_OK` varchar(5) DEFAULT '',
  `HasAddTime` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `ScoreCheck` int(11) DEFAULT '0',
  `Match_More` int(11) DEFAULT '0',
  `Match_NowScore` varchar(10) DEFAULT NULL,
  `Match_LstTime` datetime DEFAULT NULL,
  `iPage` int(11) DEFAULT NULL,
  `iSn` int(11) DEFAULT NULL,
  `remark` varchar(100) DEFAULT '',
  `score_time` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Match_ID` (`Match_ID`),
  KEY `Match_Date` (`Match_Date`),
  KEY `Match_Name` (`Match_Name`),
  KEY `Match_CoverDate` (`Match_CoverDate`),
  KEY `Match_Type` (`Match_Type`),
  KEY `Match_StopUpdateds` (`Match_StopUpdateds`),
  KEY `Match_StopUpdatezc` (`Match_StopUpdatezc`),
  KEY `Match_StopUpdateg` (`Match_StopUpdateg`),
  KEY `Match_JS` (`Match_JS`)
) ENGINE=MyISAM AUTO_INCREMENT=28036 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lq_match
-- ----------------------------

-- ----------------------------
-- Table structure for `manage_log`
-- ----------------------------
DROP TABLE IF EXISTS `manage_log`;
CREATE TABLE `manage_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manage_name` varchar(16) CHARACTER SET gbk NOT NULL DEFAULT '未知',
  `login_ip` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT '0.0.0.0' COMMENT '登陆IP',
  `login_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '登陆时间',
  `edlog` varchar(200) CHARACTER SET gbk NOT NULL COMMENT '操作内容',
  `session_str` varchar(50) CHARACTER SET gbk NOT NULL DEFAULT '未知' COMMENT '登陆时候产生的guid',
  `logout_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '退出时间',
  `edtime` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '操作时间',
  `run_str` varchar(50) DEFAULT NULL COMMENT '浏览器标识',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`manage_name`,`login_ip`,`edlog`,`session_str`) USING BTREE,
  FULLTEXT KEY `edlog` (`manage_name`,`login_ip`,`edlog`,`session_str`)
) ENGINE=MyISAM AUTO_INCREMENT=6069 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of manage_log
-- ----------------------------

-- ----------------------------
-- Table structure for `mggames`
-- ----------------------------
DROP TABLE IF EXISTS `mggames`;
CREATE TABLE `mggames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Category` text NOT NULL COMMENT '游戏大类',
  `Game_category` text NOT NULL COMMENT '游戏小类',
  `zh_name` text NOT NULL,
  `en_name` text NOT NULL,
  `flashid` text NOT NULL,
  `img_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=323 DEFAULT CHARSET=utf8 COMMENT='MG游戏ID图片以及中文名称';

-- ----------------------------
-- Records of mggames
-- ----------------------------

-- ----------------------------
-- Table structure for `money`
-- ----------------------------
DROP TABLE IF EXISTS `money`;
CREATE TABLE `money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `order_num` varchar(50) NOT NULL COMMENT '單號',
  `status` varchar(10) NOT NULL DEFAULT '未结算' COMMENT '状态，0:未结算，1:成功，2:失败',
  `about` varchar(255) NOT NULL COMMENT '备注',
  `update_time` datetime NOT NULL COMMENT '注单处理时间',
  `pay_card` varchar(50) NOT NULL COMMENT '支付卡',
  `pay_num` varchar(50) NOT NULL COMMENT '支付卡号',
  `pay_address` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT '在线支付' COMMENT '付支類型，在线支付，银行汇款，用户提款',
  `pay_name` varchar(20) NOT NULL,
  `sxf` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '續費手',
  `order_value` decimal(11,2) NOT NULL COMMENT '產生的金額',
  `assets` decimal(11,2) DEFAULT NULL,
  `balance` decimal(11,2) DEFAULT NULL,
  `manner` varchar(255) DEFAULT NULL COMMENT '汇款方式',
  `zsjr` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '赠送金额',
  `date` datetime DEFAULT NULL COMMENT '汇款时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_num` (`order_num`),
  KEY `uid` (`user_id`),
  KEY `m_order` (`order_num`)
) ENGINE=MyISAM AUTO_INCREMENT=9473 DEFAULT CHARSET=utf8 COMMENT='存款和提款记录';

-- ----------------------------
-- Records of money
-- ----------------------------

-- ----------------------------
-- Table structure for `money_log`
-- ----------------------------
DROP TABLE IF EXISTS `money_log`;
CREATE TABLE `money_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `order_num` varchar(50) NOT NULL COMMENT '單號',
  `about` varchar(255) NOT NULL COMMENT '該筆交易詳細說明',
  `update_time` datetime NOT NULL COMMENT '注单处理时间',
  `type` varchar(100) NOT NULL COMMENT '游戏下注，返利，充值，提现，无效退款，赢，赢一半，输一半',
  `order_value` decimal(11,2) NOT NULL COMMENT '產生的金額',
  `assets` decimal(11,2) NOT NULL COMMENT '前資產',
  `balance` decimal(11,2) NOT NULL COMMENT '后資產',
  PRIMARY KEY (`id`),
  KEY `uid` (`user_id`),
  KEY `m_order` (`order_num`)
) ENGINE=MyISAM AUTO_INCREMENT=898381 DEFAULT CHARSET=utf8 COMMENT='存款和提款记录';

-- ----------------------------
-- Records of money_log
-- ----------------------------

-- ----------------------------
-- Table structure for `odds_lottery`
-- ----------------------------
DROP TABLE IF EXISTS `odds_lottery`;
CREATE TABLE `odds_lottery` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `lottery_type` varchar(255) DEFAULT NULL,
  `sub_type` varchar(255) DEFAULT NULL,
  `ball_type` varchar(255) DEFAULT NULL,
  `h1` decimal(8,2) DEFAULT NULL,
  `h2` decimal(8,2) DEFAULT NULL,
  `h3` decimal(8,2) DEFAULT NULL,
  `h4` decimal(8,2) DEFAULT NULL,
  `h5` decimal(8,2) DEFAULT NULL,
  `h6` decimal(8,2) DEFAULT NULL,
  `h7` decimal(8,2) DEFAULT NULL,
  `h8` decimal(8,2) DEFAULT NULL,
  `h9` decimal(8,2) DEFAULT NULL,
  `h10` decimal(8,2) DEFAULT NULL,
  `h11` decimal(8,2) DEFAULT NULL,
  `h12` decimal(8,2) DEFAULT NULL,
  `h13` decimal(8,2) DEFAULT NULL,
  `h14` decimal(8,2) DEFAULT NULL,
  `h15` decimal(8,2) DEFAULT NULL,
  `h16` decimal(8,2) DEFAULT NULL,
  `h17` decimal(8,2) DEFAULT NULL,
  `h18` decimal(8,2) DEFAULT NULL,
  `h19` decimal(8,2) DEFAULT NULL,
  `h20` decimal(8,2) DEFAULT NULL,
  `h21` decimal(8,2) DEFAULT NULL,
  `h22` decimal(8,2) DEFAULT NULL,
  `h23` decimal(8,2) DEFAULT NULL,
  `h24` decimal(8,2) DEFAULT NULL,
  `h25` decimal(8,2) DEFAULT NULL,
  `h26` decimal(8,2) DEFAULT NULL,
  `h27` decimal(8,2) DEFAULT NULL,
  `h28` decimal(8,2) DEFAULT NULL,
  `h29` decimal(8,2) DEFAULT NULL,
  `h30` decimal(8,2) DEFAULT NULL,
  `h31` decimal(8,2) DEFAULT NULL,
  `h32` decimal(8,2) DEFAULT NULL,
  `h33` decimal(8,2) DEFAULT NULL,
  `h34` decimal(8,2) DEFAULT NULL,
  `h35` decimal(8,2) DEFAULT NULL,
  `h36` decimal(8,2) DEFAULT NULL,
  `sequence` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=426 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of odds_lottery
-- ----------------------------
INSERT INTO `odds_lottery` VALUES ('24', '广东十分彩', '主盘势', 'ball_5', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('36', '广东十分彩', '单面双码', 'ball_8', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('111', '北京PK拾', '定位', 'ball_6', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('412', '广西十分彩', '四季五行', 'ball_2', '55.00', '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', '5.00', '55.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('307', '重庆十分彩', '正码和特别号', 'ball_7', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '77.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '5.00', '3.00', '6.00', '4.00', '4.00', '5.00', '3.00', '6.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('114', '北京PK拾', '定位', 'ball_9', '9.00', '9.00', '77.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('105', '北京PK拾', '主盘势', 'ball_10', '1.00', '1.00', '1.00', '1.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('100', '北京PK拾', '主盘势', 'ball_5', '2.00', '2.00', '2.00', '2.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('351', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('96', '北京PK拾', '主盘势', 'ball_1', '4.00', '5.00', '3.00', '3.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('121', '北京快乐8', '选号', 'ball_1', '9.00', '8.00', '7.00', '5.00', '4.80', '4.60', '4.40', '3.20', '3.30', '2.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('312', '重庆十分彩', '方位中发白', 'ball_4', '6.00', '6.00', '6.00', '6.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('38', '广东十分彩', '四季五行', 'ball_2', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('406', '广西十分彩', '正码和特别号', 'ball_1', '3.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '3.00', '6.00', '6.00', '6.00', '6.00', '3.00', '3.00', '3.00', '3.00', '0');
INSERT INTO `odds_lottery` VALUES ('110', '北京PK拾', '定位', 'ball_5', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('97', '北京PK拾', '主盘势', 'ball_2', '3.00', '3.00', '3.00', '3.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('23', '广东十分彩', '主盘势', 'ball_4', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('155', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('108', '北京PK拾', '定位', 'ball_3', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('78', '天津十分彩', '四季五行', 'ball_4', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('37', '广东十分彩', '四季五行', 'ball_1', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('310', '重庆十分彩', '方位中发白', 'ball_2', '65.00', '6.00', '6.00', '6.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('309', '重庆十分彩', '方位中发白', 'ball_1', '6.00', '6.00', '6.00', '6.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('122', '北京快乐8', '其他', 'ball_1', '3.00', '5.00', '5.00', '55.00', '5.00', '3.00', '55.00', '5.00', '5.00', '5.00', '5.00', '3.00', '3.00', '3.00', '3.00', '33.00', '33.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('402', '广西十分彩', '主盘势', 'ball_2', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('150', '广东十一选五', '顺子杂六', 'ball_3', '9.00', '8.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('58', '天津十分彩', '主盘势', 'ball_1', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('302', '重庆十分彩', '正码和特别号', 'ball_2', '2.00', '5.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '22.00', '2.00', '2.00', '2.00', '2.00', '5.00', '2.00', '6.00', '6.00', '2.00', '2.00', '5.00', '5.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('143', '广东十一选五', '正码和特别号', 'ball_3', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('76', '天津十分彩', '四季五行', 'ball_2', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('115', '北京PK拾', '定位', 'ball_10', '5.00', '5.00', '7.00', '5.00', '7.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('109', '北京PK拾', '定位', 'ball_4', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '7.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('422', '广西十分彩', '总和龙虎和', 'ball_1', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('353', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('89', '天津十分彩', '方位中发白', 'ball_7', '4.00', '4.00', '4.00', '5.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('90', '天津十分彩', '方位中发白', 'ball_8', '4.00', '44.00', '4.00', '4.00', '4.00', '4.00', '44.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('416', '广西十分彩', '一中一', 'ball_1', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('410', '广西十分彩', '正码和特别号', 'ball_5', '6.00', '20.10', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '66.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '66.00', '3.76', '5.00', '5.00', '4.00', '4.00', '6.00', '6.00', '3.00', '3.00', '0');
INSERT INTO `odds_lottery` VALUES ('315', '重庆十分彩', '方位中发白', 'ball_7', '6.00', '6.00', '6.00', '6.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('45', '广东十分彩', '方位中发白', 'ball_1', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('83', '天津十分彩', '方位中发白', 'ball_1', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('308', '重庆十分彩', '正码和特别号', 'ball_8', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '88.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '1.00', '6.00', '1.00', '9.00', '3.00', '8.00', '45.00', '7.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('46', '广东十分彩', '方位中发白', 'ball_2', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('103', '北京PK拾', '主盘势', 'ball_8', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('73', '天津十分彩', '正码和特别号', 'ball_7', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('86', '天津十分彩', '方位中发白', 'ball_4', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('149', '广东十一选五', '顺子杂六', 'ball_2', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('316', '重庆十分彩', '方位中发白', 'ball_8', '6.00', '6.00', '6.00', '6.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('133', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('147', '广东十一选五', '总和龙虎和', 'ball_1', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('74', '天津十分彩', '正码和特别号', 'ball_8', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('354', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('55', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('84', '天津十分彩', '方位中发白', 'ball_2', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('95', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('306', '重庆十分彩', '正码和特别号', 'ball_6', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '4.00', '5.00', '5.00', '6.00', '55.00', '8.00', '6.00', '9.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('301', '重庆十分彩', '正码和特别号', 'ball_1', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '6.00', '6.00', '5.00', '5.00', '7.00', '7.00', '6.00', '6.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('69', '天津十分彩', '正码和特别号', 'ball_3', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('80', '天津十分彩', '四季五行', 'ball_6', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('409', '广西十分彩', '正码和特别号', 'ball_4', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '44.00', '44.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '44.00', '44.00', '4.00', '5.50', '5.50', '5.50', '5.50', '5.50', '3.00', '33.00', '3.00', '0');
INSERT INTO `odds_lottery` VALUES ('403', '广西十分彩', '主盘势', 'ball_3', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('64', '天津十分彩', '主盘势', 'ball_7', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('407', '广西十分彩', '正码和特别号', 'ball_2', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '22.00', '2.00', '2.00', '22.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '22.00', '22.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '9.00', '9.00', '9.00', '9.00', '3.00', '3.00', '3.00', '3.00', '0');
INSERT INTO `odds_lottery` VALUES ('63', '天津十分彩', '主盘势', 'ball_6', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('154', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('21', '广东十分彩', '主盘势', 'ball_2', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('68', '天津十分彩', '正码和特别号', 'ball_2', '8.00', '8.00', '8.00', '8.00', '88.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('408', '广西十分彩', '正码和特别号', 'ball_3', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '7.00', '7.00', '7.00', '7.00', '3.00', '33.00', '3.00', '3.00', '0');
INSERT INTO `odds_lottery` VALUES ('82', '天津十分彩', '四季五行', 'ball_8', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('101', '北京PK拾', '主盘势', 'ball_6', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('53', '广东十分彩', '总和龙虎', 'ball_1', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('62', '天津十分彩', '主盘势', 'ball_5', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('142', '广东十一选五', '正码和特别号', 'ball_2', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '3.00', '3.00', '3.00', '3.00', '2.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('317', '重庆十分彩', '总和龙虎', 'ball_1', '6.00', '6.00', '5.00', '5.00', '4.00', '4.00', '2.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('85', '天津十分彩', '方位中发白', 'ball_3', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('314', '重庆十分彩', '方位中发白', 'ball_6', '6.00', '6.00', '6.00', '6.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('102', '北京PK拾', '主盘势', 'ball_7', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('42', '广东十分彩', '四季五行', 'ball_6', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('119', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('87', '天津十分彩', '方位中发白', 'ball_5', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('94', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('39', '广东十分彩', '四季五行', 'ball_3', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('61', '天津十分彩', '主盘势', 'ball_4', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('26', '广东十分彩', '主盘势', 'ball_7', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('60', '天津十分彩', '主盘势', 'ball_3', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('44', '广东十分彩', '四季五行', 'ball_8', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('303', '重庆十分彩', '正码和特别号', 'ball_3', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '5.00', '3.00', '6.00', '3.00', '5.00', '4.00', '4.00', '5.00', '3.00', '6.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('17', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('72', '天津十分彩', '正码和特别号', 'ball_6', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('116', '北京PK拾', '冠亚军和', 'ball_1', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('311', '重庆十分彩', '方位中发白', 'ball_3', '6.00', '6.00', '6.00', '6.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('106', '北京PK拾', '定位', 'ball_1', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('57', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('27', '广东十分彩', '主盘势', 'ball_8', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('70', '天津十分彩', '正码和特别号', 'ball_4', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('99', '北京PK拾', '主盘势', 'ball_4', '4.00', '4.00', '4.00', '4.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('34', '广东十分彩', '单面双码', 'ball_6', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('20', '广东十分彩', '主盘势', 'ball_1', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('120', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('18', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('405', '广西十分彩', '主盘势', 'ball_5', '3.00', '3.00', '33.00', '33.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('25', '广东十分彩', '主盘势', 'ball_6', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('81', '天津十分彩', '四季五行', 'ball_7', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('93', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('88', '天津十分彩', '方位中发白', 'ball_6', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('131', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('104', '北京PK拾', '主盘势', 'ball_9', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('113', '北京PK拾', '定位', 'ball_8', '8.00', '8.00', '7.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('153', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('141', '广东十一选五', '正码和特别号', 'ball_1', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '5.00', '5.00', '6.00', '6.00', '7.00', '7.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('28', '广东十分彩', '主盘势', 'ball_9', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('118', '北京PK拾', '冠亚军和-快速', 'ball_1', '12.00', '12.00', '12.00', '1.00', '2.00', '12.00', '12.00', '12.00', '12.00', '12.00', '12.00', '12.00', '12.00', '21.00', '12.00', '12.00', '12.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('304', '重庆十分彩', '正码和特别号', 'ball_4', '4.00', '4.00', '4.00', '55.00', '4.00', '4.00', '4.00', '4.00', '44.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '7.00', '5.00', '8.00', '6.00', '9.00', '7.00', '5.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('71', '天津十分彩', '正码和特别号', 'ball_5', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('425', '广西十分彩', '顺子杂六', 'ball_3', '70.00', '4.40', '2.80', '4.40', '4.40', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('35', '广东十分彩', '单面双码', 'ball_7', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('92', '天津十分彩', '一中一', 'ball_1', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('50', '广东十分彩', '方位中发白', 'ball_6', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('413', '广西十分彩', '四季五行', 'ball_3', '55.00', '5.00', '5.00', '55.00', '5.00', '55.00', '5.00', '55.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('411', '广西十分彩', '四季五行', 'ball_1', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('112', '北京PK拾', '定位', 'ball_7', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('30', '广东十分彩', '单面双码', 'ball_2', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('305', '重庆十分彩', '正码和特别号', 'ball_5', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', '55.00', '1.00', '5.00', '2.00', '6.00', '3.00', '7.00', '4.00', '8.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('65', '天津十分彩', '主盘势', 'ball_8', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('75', '天津十分彩', '四季五行', 'ball_1', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('146', '广东十一选五', '一中一', 'ball_1', '3.00', '3.00', '33.00', '3.00', '33.00', '33.00', '33.00', '3.00', '33.00', '3.00', '333.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('49', '广东十分彩', '方位中发白', 'ball_5', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('414', '广西十分彩', '四季五行', 'ball_4', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', '55.00', '55.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('352', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('47', '广东十分彩', '方位中发白', 'ball_3', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('144', '广东十一选五', '正码和特别号', 'ball_4', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('31', '广东十分彩', '单面双码', 'ball_3', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('22', '广东十分彩', '主盘势', 'ball_3', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('51', '广东十分彩', '方位中发白', 'ball_7', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('132', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('98', '北京PK拾', '主盘势', 'ball_3', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('404', '广西十分彩', '主盘势', 'ball_4', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('145', '广东十一选五', '正码和特别号', 'ball_5', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '7.00', '7.10', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('350', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('40', '广东十分彩', '四季五行', 'ball_4', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('59', '天津十分彩', '主盘势', 'ball_2', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('148', '广东十一选五', '顺子杂六', 'ball_1', '8.00', '6.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('48', '广东十分彩', '方位中发白', 'ball_4', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('66', '天津十分彩', '主盘势', 'ball_9', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('424', '广西十分彩', '顺子杂六', 'ball_2', '70.00', '4.40', '2.80', '4.40', '4.40', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('33', '广东十分彩', '单面双码', 'ball_5', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('41', '广东十分彩', '四季五行', 'ball_5', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('29', '广东十分彩', '单面双码', 'ball_1', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '4.00', '4.00', '5.00', '5.00', '6.00', '6.00', '7.00', '7.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('56', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('415', '广西十分彩', '四季五行', 'ball_5', '55.00', '5.00', '55.00', '5.00', '55.00', '55.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('43', '广东十分彩', '四季五行', 'ball_7', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('91', '天津十分彩', '总和龙虎', 'ball_1', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('52', '广东十分彩', '方位中发白', 'ball_8', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('423', '广西十分彩', '顺子杂六', 'ball_1', '70.00', '4.40', '2.80', '4.40', '4.40', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('77', '天津十分彩', '四季五行', 'ball_3', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('401', '广西十分彩', '主盘势', 'ball_1', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('107', '北京PK拾', '定位', 'ball_2', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('32', '广东十分彩', '单面双码', 'ball_4', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('19', '----------------', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('79', '天津十分彩', '四季五行', 'ball_5', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('67', '天津十分彩', '正码和特别号', 'ball_1', '9.00', '9.00', '99.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('313', '重庆十分彩', '方位中发白', 'ball_5', '6.00', '6.00', '6.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('117', '北京PK拾', '选号', 'ball_1', '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery` VALUES ('54', '广东十分彩', '一中一', 'ball_1', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for `odds_lottery_normal`
-- ----------------------------
DROP TABLE IF EXISTS `odds_lottery_normal`;
CREATE TABLE `odds_lottery_normal` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `lottery_type` varchar(255) DEFAULT NULL,
  `sub_type` varchar(255) DEFAULT NULL,
  `ball_type` varchar(255) DEFAULT NULL,
  `h0` decimal(8,2) DEFAULT NULL,
  `h1` decimal(8,2) DEFAULT NULL,
  `h2` decimal(8,2) DEFAULT NULL,
  `h3` decimal(8,2) DEFAULT NULL,
  `h4` decimal(8,2) DEFAULT NULL,
  `h5` decimal(8,2) DEFAULT NULL,
  `h6` decimal(8,2) DEFAULT NULL,
  `h7` decimal(8,2) DEFAULT NULL,
  `h8` decimal(8,2) DEFAULT NULL,
  `h9` decimal(8,2) DEFAULT NULL,
  `h10` decimal(8,2) DEFAULT NULL,
  `h11` decimal(8,2) DEFAULT NULL,
  `h12` decimal(8,2) DEFAULT NULL,
  `h13` decimal(8,2) DEFAULT NULL,
  `h14` decimal(8,2) DEFAULT NULL,
  `h15` decimal(8,2) DEFAULT NULL,
  `h16` decimal(8,2) DEFAULT NULL,
  `h17` decimal(8,2) DEFAULT NULL,
  `h18` decimal(8,2) DEFAULT NULL,
  `h19` decimal(8,2) DEFAULT NULL,
  `h20` decimal(8,2) DEFAULT NULL,
  `h21` decimal(8,2) DEFAULT NULL,
  `h22` decimal(8,2) DEFAULT NULL,
  `h23` decimal(8,2) DEFAULT NULL,
  `h24` decimal(8,2) DEFAULT NULL,
  `h25` decimal(8,2) DEFAULT NULL,
  `h26` decimal(8,2) DEFAULT NULL,
  `h27` decimal(8,2) DEFAULT NULL,
  `h28` decimal(8,2) DEFAULT NULL,
  `h29` decimal(8,2) DEFAULT NULL,
  `h30` decimal(8,2) DEFAULT NULL,
  `h31` decimal(8,2) DEFAULT NULL,
  `h32` decimal(8,2) DEFAULT NULL,
  `h33` decimal(8,2) DEFAULT NULL,
  `h34` decimal(8,2) DEFAULT NULL,
  `h35` decimal(8,2) DEFAULT NULL,
  `h36` decimal(8,2) DEFAULT NULL,
  `h37` decimal(8,2) DEFAULT NULL,
  `h38` decimal(8,2) DEFAULT NULL,
  `h39` decimal(8,2) DEFAULT NULL,
  `h40` decimal(8,2) DEFAULT NULL,
  `h41` decimal(8,2) DEFAULT NULL,
  `h42` decimal(8,2) DEFAULT NULL,
  `h43` decimal(8,2) DEFAULT NULL,
  `h44` decimal(8,2) DEFAULT NULL,
  `h45` decimal(8,2) DEFAULT NULL,
  `h46` decimal(8,2) DEFAULT NULL,
  `h47` decimal(8,2) DEFAULT NULL,
  `h48` decimal(8,2) DEFAULT NULL,
  `h49` decimal(8,2) DEFAULT NULL,
  `h50` decimal(8,2) DEFAULT NULL,
  `h51` decimal(8,2) DEFAULT NULL,
  `h52` decimal(8,2) DEFAULT NULL,
  `h53` decimal(8,2) DEFAULT NULL,
  `h54` decimal(8,2) DEFAULT NULL,
  `sequence` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1223 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of odds_lottery_normal
-- ----------------------------
INSERT INTO `odds_lottery_normal` VALUES ('182', '排列三', '佰拾和数', null, '2.00', '43.50', '29.00', '21.70', '17.40', '14.50', '12.43', '10.88', '9.67', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.70', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('165', '3D彩', '拾个和尾数', null, '2.00', '9.00', '9.00', '9.00', '9.00', '2.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('399', '江西时时彩', '(中三)和数', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('412', '江西时时彩', '仟定位', null, '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('201', '上海时时乐', '二字', null, '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', '55.00', '55.00', '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', '55.00', '5.00', '55.00', '55.00', '5.00', '55.00', '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', '5.00', '0');
INSERT INTO `odds_lottery_normal` VALUES ('280', '重庆时时彩', '万个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('330', '极速时时彩', '仟佰和数', null, '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('335', '极速时时彩', '拾个和数', null, '2.00', '22.00', '2.00', '2.00', '22.00', '22.00', '2.00', '22.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '22.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('275', '重庆时时彩', '万佰定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('307', '极速时时彩', '(前三)一字组合', null, '3.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('277', '重庆时时彩', '万拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('233', '重庆时时彩', '万拾和尾数', null, '9.00', '7.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('262', '重庆时时彩', '(前三)跨度', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('351', '极速时时彩', '(中三)组选六', null, '7.70', '7.70', '7.70', '7.70', '7.70', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('340', '极速时时彩', '个定位', null, '1.50', '1.50', '1.50', '1.50', '1.50', '1.50', '1.50', '1.50', '1.50', '1.50', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('192', '排列三', '佰个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('270', '重庆时时彩', '(后三)组选六', null, '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('554', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('318', '极速时时彩', '仟拾和尾数', null, '9.00', '8.00', '9.00', '9.00', '9.00', '9.00', '8.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('241', '重庆时时彩', '(前三)和数', null, '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('312', '极速时时彩', '(后三)和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('279', '重庆时时彩', '万个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('441', '江西时时彩', '仟拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('406', '江西时时彩', '仟拾和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('248', '重庆时时彩', '仟佰和数', null, '87.00', '3.00', '29.00', '21.75', '17.40', '14.50', '3.00', '10.88', '967.00', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('207', '上海时时乐', '拾个定位', 'part2', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '87.00', '81.00', '87.00', '87.00', '87.00', '87.00', '81.00', '80.00', '87.00', '87.00', '81.00', '75.00', '81.00', '81.00', '81.00', '81.00', '80.00', '81.00', '81.00', '81.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('157', '3D彩', '两面', null, '3.00', '4.00', '5.00', '6.00', '4.00', '4.00', '5.00', '6.00', '78.00', '8.00', '4.00', '4.00', '6.00', '5.00', '4.00', '1.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '44.00', '4.00', '4.00', '4.00', '4.00', '44.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('347', '极速时时彩', '(前三)组选三', null, '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('155', '3D彩', '佰个和数', null, '2.00', '43.50', '29.00', '21.70', '17.40', '2.00', '12.43', '10.88', '9.67', '8.70', '2.00', '10.88', '12.43', '14.50', '17.40', '21.70', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('244', '重庆时时彩', '万仟和数', null, '3.00', '3.00', '29.00', '21.75', '17.40', '14.50', '12.43', '10.88', '9.67', '8.70', '9.67', '1088.00', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('175', '排列三', '佰拾定位', 'part1', '4.00', '82.00', '88.00', '88.00', '88.00', '4.00', '87.00', '81.00', '88.00', '88.00', '82.00', '82.00', '82.00', '82.00', '82.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('222', '上海时时乐', '跨度', null, '3.00', '3.00', '3.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('419', '江西时时彩', '(前三)跨度', null, '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('431', '江西时时彩', '万仟定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('323', '极速时时彩', '(前三)和数', null, '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('371', '极速时时彩', '佰个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('191', '排列三', '佰拾和尾数', null, '9.00', '6.00', '9.00', '9.00', '9.00', '9.00', '6.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('370', '极速时时彩', '佰拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('443', '江西时时彩', '仟个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('346', '极速时时彩', '(后三)跨度', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '55.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('214', '上海时时乐', '组选三', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('363', '极速时时彩', '仟佰定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('310', '极速时时彩', '(前三)和尾数', null, '6.00', '6.00', '66.00', '6.00', '66.00', '6.00', '66.00', '6.00', '66.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('164', '3D彩', '佰个和尾数', null, '2.00', '9.00', '9.00', '9.00', '9.00', '2.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('309', '极速时时彩', '(后三)一字组合', null, '4.00', '4.00', '44.00', '4.00', '4.00', '44.00', '4.00', '4.00', '4.00', '44.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('221', '上海时时乐', '3连', null, '8.00', '8.00', '8.00', '8.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('402', '江西时时彩', '万佰和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('273', '重庆时时彩', '万仟定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('193', '排列三', '拾个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('197', '上海时时乐', '一字', null, '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('171', '排列三', '佰定位', null, '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('362', '极速时时彩', '万个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('204', '上海时时乐', '佰个定位', 'part1', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '82.00', '82.00', '82.00', '82.00', '82.00', '82.00', '82.00', '75.00', '82.00', '82.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('256', '重庆时时彩', '佰定位', null, '4.30', '4.30', '4.30', '4.30', '4.30', '4.30', '4.30', '4.30', '4.30', '4.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('150', '3D彩', '拾个定位', 'part1', '4.00', '82.00', '88.00', '88.00', '88.00', '4.00', '87.00', '81.00', '88.00', '88.00', '82.00', '82.00', '82.00', '82.00', '82.00', '82.00', '81.00', '75.00', '82.00', '82.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('257', '重庆时时彩', '拾定位', null, '4.20', '4.20', '4.20', '4.20', '4.20', '4.20', '4.20', '4.20', '4.20', '4.20', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('143', '3D彩', '拾定位', null, '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('210', '上海时时乐', '佰个和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('392', '江西时时彩', '仟佰和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('344', '极速时时彩', '(前三)跨度', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('183', '排列三', '佰个和数', null, '2.00', '43.50', '29.00', '21.70', '17.40', '14.50', '12.43', '10.88', '9.67', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.70', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('242', '重庆时时彩', '(中三)和数', null, '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '19.30', '15.80', '13.90', '12.80', '12.30', '12.00', '12.00', '12.30', '12.80', '13.90', '15.80', '19.30', '24.30', '31.00', '39.00', '545.00', '85.00', '136.00', '240.00', '720.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('328', '极速时时彩', '万拾和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('400', '江西时时彩', '(后三)和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('212', '上海时时乐', '总和龙虎和', null, '2.00', '7.00', '7.00', '77.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('389', '江西时时彩', '万佰和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('420', '江西时时彩', '(中三)跨度', null, '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('422', '江西时时彩', '(前三)组选三', null, '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('349', '极速时时彩', '(后三)组选三', null, '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('353', '极速时时彩', '两面', 'part1', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '22.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('395', '江西时时彩', '佰拾和尾数', null, '8.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '8.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('358', '极速时时彩', '万佰定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('220', '上海时时乐', '拾个和尾数', null, '5.00', '55.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '55.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('418', '江西时时彩', '(后三)二字组合', null, '6.00', '6.00', '66.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '66.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '66.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '66.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '66.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '0');
INSERT INTO `odds_lottery_normal` VALUES ('416', '江西时时彩', '(前三)二字组合', null, '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '0');
INSERT INTO `odds_lottery_normal` VALUES ('274', '重庆时时彩', '万仟定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('410', '江西时时彩', '拾个和数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('386', '江西时时彩', '(中三)和尾数', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('211', '上海时时乐', '拾个和数', null, '3.00', '3.00', '3.00', '3.00', '333.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('315', '极速时时彩', '万拾和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '8.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('337', '极速时时彩', '仟定位', null, '1.20', '1.20', '1.20', '1.20', '1.20', '1.20', '1.20', '1.20', '1.20', '1.20', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('426', '江西时时彩', '(中三)组选六', null, '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('162', '3D彩', '佰拾个和尾数', null, '2.00', '9.00', '9.00', '9.00', '9.00', '2.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('295', '重庆时时彩', '豹子顺子(中三)', null, '4.40', '4.40', '4.40', '4.40', '4.40', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('388', '江西时时彩', '万仟和尾数', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('308', '极速时时彩', '(中三)一字组合', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('227', '重庆时时彩', '(后三)一字组合', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('342', '极速时时彩', '(中三)二字组合', null, '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '0');
INSERT INTO `odds_lottery_normal` VALUES ('228', '重庆时时彩', '(前三)和尾数', null, '3.00', '10.00', '10.00', '10.00', '10.00', '4.00', '10.00', '10.00', '10.00', '10.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('453', '江西时时彩', '豹子顺子(后三)', null, '2.10', '2.10', '2.10', '2.10', '2.10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('225', '重庆时时彩', '(前三)一字组合', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('178', '排列三', '佰个定位', 'part2', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '87.00', '81.00', '87.00', '87.00', '87.00', '87.00', '87.00', '80.00', '87.00', '88.00', '81.00', '75.00', '81.00', '81.00', '81.00', '81.00', '80.00', '81.00', '81.00', '81.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('331', '极速时时彩', '仟拾和数', null, '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('238', '重庆时时彩', '佰拾和尾数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('159', '3D彩', '组选三', null, '7.00', '5.00', '3.33', '2.50', '1.94', '1.56', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('442', '江西时时彩', '仟个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('284', '重庆时时彩', '仟拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('451', '江西时时彩', '豹子顺子(前三)', null, '2.00', '2.00', '2.00', '2.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('397', '江西时时彩', '拾个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('149', '3D彩', '佰个定位', 'part2', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '87.00', '81.00', '87.00', '87.00', '87.00', '87.00', '87.00', '80.00', '87.00', '87.00', '81.00', '75.00', '81.00', '81.00', '81.00', '81.00', '80.00', '81.00', '81.00', '81.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('263', '重庆时时彩', '(中三)跨度', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('316', '极速时时彩', '万个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('147', '3D彩', '佰拾定位', 'part2', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '87.00', '81.00', '87.00', '87.00', '87.00', '87.00', '87.00', '80.00', '87.00', '87.00', '81.00', '75.00', '81.00', '81.00', '81.00', '81.00', '80.00', '81.00', '81.00', '81.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('198', '上海时时乐', '佰定位', null, '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('354', '极速时时彩', '两面', 'part2', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('343', '极速时时彩', '(后三)二字组合', null, '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '0');
INSERT INTO `odds_lottery_normal` VALUES ('294', '重庆时时彩', '豹子顺子(前三)', null, '4.50', '4.50', '4.50', '4.50', '4.50', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('230', '重庆时时彩', '(后三)和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('247', '重庆时时彩', '万个和数', null, '87.00', '3.00', '29.00', '21.75', '17.40', '14.50', '3.00', '10.88', '96.70', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('378', '极速时时彩', '豹子顺子(后三)', null, '2.20', '2.20', '2.20', '2.20', '2.20', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('367', '极速时时彩', '仟个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('240', '重庆时时彩', '拾个和尾数', null, '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('205', '上海时时乐', '佰个定位', 'part2', '88.00', '1.00', '1.00', '1.00', '1.00', '88.00', '87.00', '81.00', '88.00', '88.00', '87.00', '81.00', '1.00', '87.00', '87.00', '87.00', '81.00', '80.00', '87.00', '87.00', '81.00', '75.00', '81.00', '81.00', '81.00', '81.00', '80.00', '81.00', '81.00', '81.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('365', '极速时时彩', '仟拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('306', '极速时时彩', '全五-多重彩派', null, '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('267', '重庆时时彩', '(后三)组选三', null, '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('249', '重庆时时彩', '仟拾和数', null, '87.00', '43.50', '3.00', '21.75', '17.40', '14.50', '12.43', '3.00', '96.70', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('187', '排列三', '组选三', null, '14.60', '4.00', '2.20', '5.31', '4.41', '3.32', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('251', '重庆时时彩', '佰拾和数', null, '87.00', '43.50', '3.00', '21.75', '17.40', '14.50', '12.43', '3.00', '9.67', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('366', '极速时时彩', '仟拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('246', '重庆时时彩', '万拾和数', null, '87.00', '3.00', '3.00', '21.75', '17.40', '14.50', '12.43', '10.88', '96.70', '87.00', '9.67', '10.88', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('206', '上海时时乐', '拾个定位', 'part1', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '82.00', '82.00', '82.00', '82.00', '82.00', '82.00', '82.00', '75.00', '82.00', '82.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '1.00', '1.00', '1.00', '1.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('439', '江西时时彩', '仟佰定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('409', '江西时时彩', '佰个和数', null, '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', '14.50', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('403', '江西时时彩', '万拾和数', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '44.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('345', '极速时时彩', '(中三)跨度', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('361', '极速时时彩', '万个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('172', '排列三', '拾定位', null, '5.00', '5.00', '5.00', '5.00', '5.00', '55.00', '5.00', '5.00', '55.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('234', '重庆时时彩', '万个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '8.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('380', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('381', '江西时时彩', '全五-多重彩派', null, '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', '2.05', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('293', '重庆时时彩', '总和龙虎和', null, '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('407', '江西时时彩', '仟个和数', null, '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('445', '江西时时彩', '佰拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('377', '极速时时彩', '豹子顺子(中三)', null, '3.30', '3.30', '3.30', '3.30', '3.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('434', '江西时时彩', '万拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('341', '极速时时彩', '(前三)二字组合', null, '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', '0');
INSERT INTO `odds_lottery_normal` VALUES ('396', '江西时时彩', '佰个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('154', '3D彩', '佰拾和数', null, '2.00', '43.50', '29.00', '21.70', '17.40', '2.00', '12.43', '10.88', '9.67', '8.70', '2.00', '10.88', '12.43', '14.50', '17.40', '21.70', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('408', '江西时时彩', '佰拾和数', null, '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('163', '3D彩', '佰拾和尾数', null, '2.00', '9.00', '9.00', '9.00', '9.00', '2.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('219', '上海时时乐', '佰个和尾数', null, '5.00', '5.00', '55.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('332', '极速时时彩', '仟个和数', null, '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('444', '江西时时彩', '佰拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('379', '极速时时彩', '牛牛', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('142', '3D彩', '佰定位', null, '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('224', '重庆时时彩', '全五-多重彩派', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('317', '极速时时彩', '仟佰和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('176', '排列三', '佰拾定位', 'part2', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '87.00', '81.00', '87.00', '87.00', '87.00', '87.00', '87.00', '80.00', '87.00', '87.00', '81.00', '75.00', '81.00', '81.00', '81.00', '81.00', '80.00', '81.00', '81.00', '81.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('276', '重庆时时彩', '万佰定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('320', '极速时时彩', '佰拾和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '8.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('338', '极速时时彩', '佰定位', null, '1.30', '1.30', '1.30', '1.30', '1.30', '1.30', '1.30', '1.30', '1.30', '1.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('433', '江西时时彩', '万佰定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('181', '排列三', '和数', null, '2.00', '240.00', '136.00', '82.00', '54.50', '2.00', '31.00', '24.30', '19.30', '15.80', '13.90', '12.80', '12.30', '12.00', '12.00', '12.30', '12.80', '13.90', '15.80', '19.30', '24.30', '31.00', '39.00', '54.50', '82.00', '136.00', '240.00', '720.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('314', '极速时时彩', '万佰和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('232', '重庆时时彩', '万佰和尾数', null, '9.00', '7.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('217', '上海时时乐', '佰拾个和尾数', null, '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('264', '重庆时时彩', '(后三)跨度', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('385', '江西时时彩', '(前三)和尾数', null, '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('329', '极速时时彩', '万个和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('430', '江西时时彩', '万仟定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('258', '重庆时时彩', '个定位', null, '4.10', '4.10', '4.10', '4.10', '4.10', '4.10', '4.10', '4.10', '4.10', '4.10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('324', '极速时时彩', '(中三)和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('177', '排列三', '佰个定位', 'part1', '4.00', '82.00', '88.00', '88.00', '88.00', '4.00', '87.00', '81.00', '88.00', '88.00', '82.00', '82.00', '82.00', '82.00', '82.00', '3.00', '4.00', '75.00', '3.00', '3.00', '33.00', '334.00', '44.00', '88.00', '44.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('326', '极速时时彩', '万仟和数', null, '3.00', '33.00', '3.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('184', '排列三', '拾个和数', null, '2.00', '43.50', '29.00', '21.70', '17.40', '14.50', '12.43', '10.88', '9.67', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.70', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('450', '江西时时彩', '总和龙虎和', null, '1.10', '1.10', '1.10', '1.10', '1.10', '1.10', '1.10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('161', '3D彩', '一字过关', null, '1.89', '1.89', '1.89', '1.89', '1.89', '1.89', '1.89', '1.89', '2.00', '1.89', '1.89', '1.89', '1.89', '1.89', '2.00', '1.89', '1.89', '1.89', '3.57', '6.75', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('229', '重庆时时彩', '(中三)和尾数', null, '6.00', '8.00', '8.00', '8.00', '8.00', '6.00', '8.00', '8.00', '8.00', '8.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('552', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('231', '重庆时时彩', '万仟和尾数', null, '6.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('360', '极速时时彩', '万拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('286', '重庆时时彩', '仟个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('285', '重庆时时彩', '仟个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('303', '重庆时时彩', '牛牛', null, '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', '2.20', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('393', '江西时时彩', '仟拾和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('271', '重庆时时彩', '两面', 'part1', '6.00', '6.00', '5.00', '5.00', '6.00', '6.00', '5.00', '5.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '1.95', '1.95', '12.00', '1.95', '1.95', '1.95', '1.95', '12.00', '195.00', '195.00', '195.00', '195.00', '12.00', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '12.00', '1.95', '1.95', '1.95', '1.95', null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('359', '极速时时彩', '万拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('311', '极速时时彩', '(中三)和尾数', null, '7.00', '7.00', '7.00', '77.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('387', '江西时时彩', '(后三)和尾数', null, '9.00', '9.00', '8.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('429', '江西时时彩', '两面', 'part2', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('239', '重庆时时彩', '佰个和尾数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('169', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('553', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('209', '上海时时乐', '佰拾和数', null, '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '333.00', '3.00', '3.00', '33.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('368', '极速时时彩', '仟个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('327', '极速时时彩', '万佰和数', null, '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('333', '极速时时彩', '佰拾和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('436', '江西时时彩', '万个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('438', '江西时时彩', '仟佰定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('268', '重庆时时彩', '(前三)组选六', null, '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('322', '极速时时彩', '拾个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('405', '江西时时彩', '仟佰和数', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('373', '极速时时彩', '拾个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('448', '江西时时彩', '拾个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('195', '排列三', '跨度', null, '65.00', '55.00', '33.00', '12.00', '2.00', '2.00', '12.00', '22.00', '44.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('435', '江西时时彩', '万拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('440', '江西时时彩', '仟拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('170', '排列三', '一字', null, '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('255', '重庆时时彩', '仟定位', null, '4.40', '4.40', '4.40', '4.40', '4.40', '4.40', '4.40', '4.40', '4.40', '4.40', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('292', '重庆时时彩', '拾个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('383', '江西时时彩', '(中三)一字组合', null, '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('398', '江西时时彩', '(前三)和数', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('259', '重庆时时彩', '(前三)二字组合', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '0');
INSERT INTO `odds_lottery_normal` VALUES ('391', '江西时时彩', '万个和尾数', null, '9.00', '8.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('427', '江西时时彩', '(后三)组选六', null, '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('153', '3D彩', '和数', null, '2.00', '240.00', '136.00', '82.00', '54.50', '2.00', '31.00', '24.30', '19.30', '15.80', '2.00', '12.80', '12.30', '12.00', '12.00', '12.30', '12.80', '13.90', '15.80', '19.30', '24.30', '31.00', '39.00', '54.50', '82.00', '136.00', '240.00', '720.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('202', '上海时时乐', '佰拾定位', 'part1', '2.00', '22.00', '2.00', '22.00', '22.00', '2.00', '22.00', '22.00', '2.00', '2.00', '22.00', '2.00', '22.00', '2.00', '22.00', '2.00', '22.00', '2.00', '22.00', '2.00', '22.00', '2.00', '22.00', '2.00', '2.00', '2.00', '222.00', '2.00', '2.00', '2.00', '2.00', '222.00', '2.00', '2.00', '22.00', '2.00', '22.00', '2.00', '22.00', '2.00', '2.00', '2.00', '22.00', '22.00', '2.00', '2.00', '22.00', '2.00', '22.00', '2.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('325', '极速时时彩', '(后三)和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('261', '重庆时时彩', '(后三)二字组合', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '0');
INSERT INTO `odds_lottery_normal` VALUES ('384', '江西时时彩', '(后三)一字组合', null, '3.37', '3.37', '3.37', '3.37', '3.37', '3.37', '3.37', '3.37', '3.37', '3.37', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('180', '排列三', '拾个定位', 'part2', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '87.00', '81.00', '87.00', '87.00', '87.00', '87.00', '87.00', '80.00', '87.00', '88.00', '81.00', '75.00', '81.00', '81.00', '81.00', '81.00', '80.00', '81.00', '81.00', '81.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '888.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('334', '极速时时彩', '佰个和数', null, '3.00', '33.00', '3.00', '3.00', '33.00', '33.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '33.00', '33.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('141', '3D彩', '一字', null, '4.00', '3.37', '3.37', '3.37', '3.37', '4.00', '4.00', '3.37', '3.37', '3.37', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('449', '江西时时彩', '拾个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('452', '江西时时彩', '豹子顺子(中三)', null, '2.20', '2.20', '2.20', '2.20', '2.20', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('289', '重庆时时彩', '佰个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('243', '重庆时时彩', '(后三)和数', null, '3.00', '4.00', '4.00', '3.00', '3.00', '39.00', '310.00', '24.30', '19.30', '3.00', '13.90', '12.80', '123.00', '120.00', '12.00', '12.30', '12.80', '13.90', '15.80', '19.30', '24.30', '31.00', '39.00', '54.50', '85.00', '136.00', '240.00', '720.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('369', '极速时时彩', '佰拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('304', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('266', '重庆时时彩', '(中三)组选三', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('425', '江西时时彩', '(前三)组选六', null, '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('336', '极速时时彩', '万定位', null, '1.10', '1.10', '1.10', '1.10', '1.10', '1.10', '1.10', '1.10', '1.10', '1.10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('282', '重庆时时彩', '仟佰定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('437', '江西时时彩', '万个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('376', '极速时时彩', '豹子顺子(前三)', null, '4.50', '4.50', '4.50', '4.50', '4.50', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('218', '上海时时乐', '佰拾和尾数', null, '4.00', '4.00', '44.00', '4.00', '4.00', '4.00', '4.00', '44.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('413', '江西时时彩', '佰定位', null, '3.40', '3.40', '3.40', '3.40', '3.40', '3.40', '3.40', '3.40', '3.40', '3.40', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('411', '江西时时彩', '万定位', null, '3.20', '3.20', '3.20', '3.20', '3.20', '3.20', '3.20', '3.20', '3.20', '3.20', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('291', '重庆时时彩', '拾个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('305', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('194', '排列三', '3连', null, '58.00', '65.00', '23.00', '12.00', '1.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('235', '重庆时时彩', '仟佰和尾数', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('364', '极速时时彩', '仟佰定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('146', '3D彩', '佰拾定位', 'part1', '4.00', '82.00', '88.00', '88.00', '88.00', '4.00', '87.00', '81.00', '88.00', '88.00', '82.00', '82.00', '82.00', '82.00', '82.00', '82.00', '81.00', '75.00', '82.00', '82.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('414', '江西时时彩', '拾定位', null, '3.10', '3.10', '3.10', '3.10', '3.10', '3.10', '3.10', '3.10', '3.10', '3.10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('188', '排列三', '组选六', null, '36.53', '4.00', '2.20', '4.14', '2.63', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('290', '重庆时时彩', '佰个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('296', '重庆时时彩', '豹子顺子(后三)', null, '4.30', '4.30', '4.30', '4.30', '4.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('216', '上海时时乐', '一字过关', null, '2.00', '22.00', '22.00', '2.00', '2.00', '22.00', '2.00', '2.00', '2.00', '2.00', '22.00', '2.00', '2.00', '22.00', '22.00', '2.00', '22.00', '22.00', '2.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('288', '重庆时时彩', '佰拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('357', '极速时时彩', '万佰定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('213', '上海时时乐', '两面', null, '5.00', '6.00', '4.00', '3.00', '33.00', '3.00', '6.00', '5.00', '4.00', '3.00', '3.00', '3.00', '1.00', '2.00', '3.00', '4.00', '3.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('158', '3D彩', '总和龙虎和', null, '2.00', '2.00', '3.00', '3.00', '4.00', '4.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('352', '极速时时彩', '(后三)组选六', null, '5.50', '5.50', '5.50', '5.50', '5.50', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('417', '江西时时彩', '(中三)二字组合', null, '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '7.00', '0');
INSERT INTO `odds_lottery_normal` VALUES ('278', '重庆时时彩', '万拾定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('144', '3D彩', '个定位', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('237', '重庆时时彩', '仟个和尾数', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('339', '极速时时彩', '拾定位', null, '1.40', '1.40', '1.40', '1.40', '1.40', '1.40', '1.40', '1.40', '1.40', '1.40', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('186', '排列三', '总和龙虎和', null, '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('372', '极速时时彩', '佰个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('236', '重庆时时彩', '仟拾和尾数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('321', '极速时时彩', '佰个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('199', '上海时时乐', '拾定位', null, '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('375', '极速时时彩', '总和龙虎和', null, '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('272', '重庆时时彩', '两面', 'part2', '1.95', '1.95', '12.00', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '12.00', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '12.00', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '3.00', '1.95', '1.95', '1.95', '1.95', '12.00', '1.95', '1.95', '1.95', '1.95', '12.00', '1.95', '1.95', '3.00', '1.95', '12.00', '1.95', '1.95', '1.95', '3.00', '12.00', '1.95', '1.95', '1.95', '1.95', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('447', '江西时时彩', '佰个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('555', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('254', '重庆时时彩', '万定位', null, '5.00', '4.50', '4.50', '4.50', '4.50', '4.50', '4.50', '4.50', '4.50', '4.50', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('446', '江西时时彩', '佰个定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('319', '极速时时彩', '仟个和尾数', null, '6.00', '66.00', '6.00', '66.00', '6.00', '6.00', '66.00', '66.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('355', '极速时时彩', '万仟定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('203', '上海时时乐', '佰拾定位', 'part2', '22.00', '2.00', '2.00', '2.00', '2.00', '2.00', '22.00', '2.00', '22.00', '2.00', '22.00', '2.00', '2.00', '2.00', '2.00', '2.00', '22.00', '2.00', '2.00', '22.00', '22.00', '2.00', '2.00', '22.00', '2.00', '2.00', '22.00', '22.00', '2.00', '22.00', '2.00', '2.00', '2.00', '22.00', '2.00', '2.00', '2.00', '2.00', '2.00', '22.00', '2.00', '2.00', '22.00', '2.00', '22.00', '2.00', '2.00', '22.00', '2.00', '2.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('390', '江西时时彩', '万拾和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('287', '重庆时时彩', '佰拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('185', '排列三', '两面', null, '3.00', '4.00', '5.00', '6.00', '3.00', '33.00', '7.00', '8.00', '5.00', '6.00', '33.00', '3.00', '4.00', '5.00', '1.00', '2.00', '33.00', '3.00', '33.00', '33.00', '3.00', '3.00', '33.00', '33.00', '33.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '33.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('283', '重庆时时彩', '仟拾定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('196', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('269', '重庆时时彩', '(中三)组选六', null, '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('156', '3D彩', '拾个和数', null, '2.00', '2.00', '29.00', '21.70', '17.40', '14.50', '12.43', '10.88', '9.67', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.70', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('200', '上海时时乐', '个定位', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('348', '极速时时彩', '(中三)组选三', null, '3.30', '3.30', '3.30', '3.30', '3.30', '3.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('404', '江西时时彩', '万个和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('265', '重庆时时彩', '(前三)组选三', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('252', '重庆时时彩', '佰个和数', null, '87.00', '43.50', '3.00', '21.75', '17.40', '14.50', '12.43', '3.00', '9.67', '8.70', '9.67', '10.88', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('145', '3D彩', '二字', null, '4.00', '15.20', '16.40', '16.40', '16.40', '4.00', '16.40', '15.00', '16.40', '16.40', '29.10', '31.50', '15.20', '15.20', '15.20', '15.20', '13.80', '15.20', '15.20', '31.50', '16.40', '16.40', '16.40', '16.40', '15.00', '16.40', '16.40', '31.50', '16.40', '16.40', '16.40', '15.00', '16.40', '16.40', '31.50', '16.40', '16.40', '15.00', '16.40', '16.40', '31.50', '16.40', '15.00', '16.40', '16.40', '31.50', '15.00', '16.40', '16.40', '28.70', '15.00', '15.00', '31.50', '16.40', '31.50', '0');
INSERT INTO `odds_lottery_normal` VALUES ('350', '极速时时彩', '(前三)组选六', null, '7.70', '7.70', '7.70', '7.70', '7.70', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('179', '排列三', '拾个定位', 'part1', '4.00', '82.00', '88.00', '88.00', '88.00', '4.00', '87.00', '81.00', '88.00', '88.00', '82.00', '82.00', '82.00', '82.00', '82.00', '82.00', '81.00', '75.00', '82.00', '82.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('223', '----------------', '----------------', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('151', '3D彩', '拾个定位', 'part2', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '87.00', '81.00', '87.00', '87.00', '87.00', '87.00', '87.00', '80.00', '87.00', '87.00', '81.00', '75.00', '81.00', '81.00', '81.00', '81.00', '80.00', '81.00', '81.00', '81.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('148', '3D彩', '佰个定位', 'part1', '4.00', '82.00', '88.00', '88.00', '88.00', '4.00', '87.00', '81.00', '88.00', '88.00', '82.00', '82.00', '82.00', '82.00', '82.00', '82.00', '81.00', '75.00', '82.00', '82.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', '88.00', '82.00', '88.00', '88.00', '88.00', '88.00', '87.00', '81.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('167', '3D彩', '3连', null, '58.00', '45.00', '13.00', '12.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('356', '极速时时彩', '万仟定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('428', '江西时时彩', '两面', 'part1', '4.00', '4.00', '4.00', '4.00', '2.00', '2.00', '4.00', '4.00', '4.00', '4.00', '2.00', '2.00', '4.00', '4.00', '4.00', '4.00', '2.00', '2.00', '4.00', '4.00', '4.00', '4.00', '2.00', '2.00', '4.00', '4.00', '4.00', '4.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('394', '江西时时彩', '仟个和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '8.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('424', '江西时时彩', '(后三)组选三', null, '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('245', '重庆时时彩', '万佰和数', null, '3.00', '3.00', '29.00', '21.75', '17.40', '14.50', '12.43', '10.88', '9.67', '8.70', '967.00', '10.88', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('374', '极速时时彩', '拾个定位', 'part2', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('189', '排列三', '一字过关', null, '1.89', '1.89', '4.00', '1.89', '2.00', '1.89', '1.89', '1.89', '4.00', '1.89', '2.00', '1.89', '1.89', '1.89', '2.00', '2.00', '2.00', '1.89', '3.00', '2.50', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('432', '江西时时彩', '万佰定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('160', '3D彩', '组选六', null, '24.40', '6.00', '4.88', '2.79', '1.74', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('173', '排列三', '个定位', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('415', '江西时时彩', '个定位', null, '2.90', '2.90', '2.90', '2.90', '2.90', '2.90', '2.90', '2.90', '2.90', '2.90', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('215', '上海时时乐', '组选六', null, '3.00', '33.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('423', '江西时时彩', '(中三)组选三', null, '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('168', '3D彩', '跨度', null, '65.00', '52.00', '31.00', '10.00', '5.00', '5.00', '5.00', '4.00', '52.00', '65.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('174', '排列三', '二字', null, '3.00', '3.00', '3.00', '3.00', '16.40', '3.00', '3.00', '33.00', '3.00', '3.00', '33.00', '33.00', '33.00', '3.00', '3.00', '3.00', '3.00', '15.20', '15.20', '15.20', '16.40', '16.40', '16.40', '16.40', '15.00', '16.40', '16.40', '31.50', '16.40', '16.40', '16.40', '15.00', '16.40', '16.40', '31.50', '16.40', '16.40', '15.00', '16.40', '16.40', '31.50', '16.40', '15.00', '16.40', '16.40', '31.50', '15.00', '16.40', '16.40', '28.70', '15.00', '15.00', '31.50', '16.40', '31.50', '0');
INSERT INTO `odds_lottery_normal` VALUES ('421', '江西时时彩', '(后三)跨度', null, '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', '13.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('226', '重庆时时彩', '(中三)一字组合', null, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('401', '江西时时彩', '万仟和数', null, '2.00', '2.00', '22.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', '2.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('281', '重庆时时彩', '仟佰定位', 'part1', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', '88.00', null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('190', '排列三', '佰拾个和尾数', null, '2.00', '7.00', '9.00', '9.00', '9.00', '2.00', '7.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('253', '重庆时时彩', '拾个和数', null, '87.00', '43.50', '3.00', '21.75', '17.40', '14.50', '12.43', '3.00', '9.67', '78.00', '9.67', '10.88', '12.43', '14.50', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('250', '重庆时时彩', '仟个和数', null, '87.00', '43.50', '3.00', '21.75', '17.40', '14.50', '12.43', '3.00', '9.67', '8.70', '9.67', '10.88', '12.43', '1.45', '17.40', '21.75', '29.00', '43.50', '87.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('551', '江西时时彩', '牛牛', null, '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('313', '极速时时彩', '万仟和尾数', null, '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', '9.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('208', '上海时时乐', '和数', null, '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '33.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `odds_lottery_normal` VALUES ('260', '重庆时时彩', '(中三)二字组合', null, '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '3.00', '0');
INSERT INTO `odds_lottery_normal` VALUES ('382', '江西时时彩', '(前三)一字组合', null, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for `order_lottery`
-- ----------------------------
DROP TABLE IF EXISTS `order_lottery`;
CREATE TABLE `order_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(100) NOT NULL COMMENT '單號',
  `user_id` int(11) NOT NULL COMMENT '會員ID',
  `Gtype` varchar(255) NOT NULL COMMENT '彩票 類型縮寫，如 D3,P3',
  `lottery_number` varchar(255) NOT NULL COMMENT '开奖期数',
  `rtype_str` varchar(255) NOT NULL COMMENT '彩票 类型，如 一字(组合)，一字(口XX)等',
  `rtype` varchar(255) NOT NULL COMMENT '彩票 类型缩写，如W1, D1M等',
  `bet_info` varchar(5000) NOT NULL COMMENT '下单详细情况',
  `bet_rate` varchar(100) DEFAULT NULL COMMENT '下注賠率',
  `bet_money` decimal(11,2) NOT NULL COMMENT '下注金額',
  `win` decimal(10,2) NOT NULL COMMENT '最高可赢金额',
  `bet_time` datetime NOT NULL COMMENT '下注時間',
  `status` varchar(20) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:已结算 2:重新结算 3:已作废',
  PRIMARY KEY (`id`),
  KEY `gtype` (`Gtype`),
  KEY `bet_time` (`bet_time`),
  KEY `user_id` (`user_id`),
  KEY `order_num` (`order_num`)
) ENGINE=MyISAM AUTO_INCREMENT=292046 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of order_lottery
-- ----------------------------

-- ----------------------------
-- Table structure for `order_lottery_sub`
-- ----------------------------
DROP TABLE IF EXISTS `order_lottery_sub`;
CREATE TABLE `order_lottery_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(100) NOT NULL COMMENT '單號',
  `order_sub_num` varchar(100) NOT NULL COMMENT '子订单号',
  `quick_type` varchar(100) DEFAULT NULL COMMENT '快速下注订单类型，如第一球，第二球',
  `number` varchar(2000) NOT NULL COMMENT '号码，如1,2,3,单,双,大,小',
  `bet_rate` varchar(100) NOT NULL COMMENT '下注賠率',
  `bet_money` decimal(11,2) NOT NULL COMMENT '下注金額',
  `win` decimal(10,2) NOT NULL COMMENT '可赢金额',
  `fs` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '反水金额',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '下单后账号还有多少钱',
  `status` varchar(10) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:已结算 2:重新结算 3:已作废',
  `is_win` varchar(20) DEFAULT NULL COMMENT '0:未中奖 1:已中奖 2:平局 3:赢一半',
  PRIMARY KEY (`id`),
  KEY `order_num` (`order_num`)
) ENGINE=MyISAM AUTO_INCREMENT=469402 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of order_lottery_sub
-- ----------------------------

-- ----------------------------
-- Table structure for `other_match`
-- ----------------------------
DROP TABLE IF EXISTS `other_match`;
CREATE TABLE `other_match` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Match_ID` varchar(50) NOT NULL,
  `Match_Date` varchar(20) DEFAULT NULL,
  `Match_Time` varchar(20) DEFAULT NULL,
  `Match_Name` varchar(50) DEFAULT NULL,
  `Match_Master` varchar(50) DEFAULT NULL,
  `Match_Guest` varchar(50) DEFAULT NULL,
  `Match_IsLose` varchar(4) DEFAULT NULL,
  `Match_State` varchar(7) DEFAULT NULL,
  `Match_Type` tinyint(3) unsigned DEFAULT NULL,
  `Match_Ho` double DEFAULT NULL,
  `Match_Ao` double DEFAULT NULL,
  `Match_RGG` varchar(15) DEFAULT NULL,
  `Match_BzM` double DEFAULT NULL,
  `Match_BzG` double DEFAULT NULL,
  `Match_BzH` double DEFAULT NULL,
  `Match_DxGG` varchar(15) DEFAULT NULL,
  `Match_DxDpl` double DEFAULT NULL,
  `Match_DxXpl` double DEFAULT NULL,
  `Match_DsDpl` double DEFAULT NULL,
  `Match_DsSpl` double DEFAULT NULL,
  `Match_OverScore` varchar(10) DEFAULT NULL,
  `Match_JS` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowds` tinyint(3) unsigned DEFAULT '0',
  `Match_AddDate` datetime DEFAULT NULL,
  `Match_CoverDate` datetime DEFAULT NULL,
  `Match_IsShowds` tinyint(3) unsigned DEFAULT '1',
  `Match_MasterID` varchar(15) DEFAULT NULL,
  `Match_GuestID` varchar(15) DEFAULT NULL,
  `Match_StopUpdateds` tinyint(3) unsigned DEFAULT '0',
  `Match_TypePlay` varchar(5) DEFAULT NULL,
  `Match_bd20` float DEFAULT NULL,
  `Match_bd21` float DEFAULT NULL,
  `Match_bd30` float DEFAULT NULL,
  `Match_bd31` float DEFAULT NULL,
  `Match_bd32` float DEFAULT NULL,
  `match_1score` varchar(15) DEFAULT NULL,
  `match_2score` varchar(15) DEFAULT NULL,
  `match_3score` varchar(15) DEFAULT NULL,
  `match_4score` varchar(15) DEFAULT NULL,
  `match_5score` varchar(15) DEFAULT NULL,
  `match_PScore` varchar(15) DEFAULT NULL,
  `Match_Scene` tinyint(3) unsigned DEFAULT '0',
  `Match_MatchTime` varchar(30) DEFAULT NULL,
  `MB_Inball` varchar(5) DEFAULT NULL,
  `TG_Inball` varchar(5) DEFAULT NULL,
  `MB_Inball_HR` varchar(5) DEFAULT NULL,
  `TG_Inball_HR` varchar(5) DEFAULT NULL,
  `scorecheck` smallint(11) DEFAULT NULL,
  `match_showtype` varchar(1) NOT NULL DEFAULT 'H',
  `Match_LstTime` datetime DEFAULT NULL,
  `iPage` int(11) DEFAULT NULL,
  `iSn` int(11) DEFAULT NULL,
  `score_time` datetime DEFAULT NULL,
  `remark` varchar(100) DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `Match_ID` (`Match_ID`),
  KEY `Match_Type` (`Match_Type`),
  KEY `Match_Date` (`Match_Date`),
  KEY `Match_CoverDate` (`Match_CoverDate`),
  KEY `Match_Bd21` (`Match_bd21`),
  KEY `Match_Name` (`Match_Name`),
  KEY `Match_StopUpdateds` (`Match_StopUpdateds`)
) ENGINE=MyISAM AUTO_INCREMENT=9043 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of other_match
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_error_log`
-- ----------------------------
DROP TABLE IF EXISTS `pay_error_log`;
CREATE TABLE `pay_error_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign_info` varchar(5000) NOT NULL COMMENT '签名信息',
  `update_time` datetime NOT NULL,
  `pay_type` varchar(100) NOT NULL COMMENT '支付类型，比如智付2.0 ， 环讯等',
  `error_type` varchar(100) NOT NULL DEFAULT '签名不一致',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2655 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_error_log
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_set`
-- ----------------------------
DROP TABLE IF EXISTS `pay_set`;
CREATE TABLE `pay_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_domain` varchar(100) DEFAULT NULL COMMENT '支付域名',
  `pay_id` varchar(50) DEFAULT NULL COMMENT '商家号',
  `pay_key` varchar(200) DEFAULT NULL COMMENT '密匙',
  `pay_type` int(11) DEFAULT NULL COMMENT '支付类型',
  `f_url` varchar(100) DEFAULT NULL COMMENT '支付成功后跳转地址',
  `money_limits` double DEFAULT '99999999' COMMENT '支付限额',
  `money_Already` double DEFAULT NULL COMMENT '已有金额',
  `order_id` int(11) DEFAULT NULL COMMENT '排序ID',
  `b_start` int(11) DEFAULT NULL COMMENT '是否启用',
  `money_Lowest` double DEFAULT '0' COMMENT '低最冲值',
  `pay_name` varchar(20) DEFAULT NULL,
  `pay_platform` varchar(20) DEFAULT NULL COMMENT '支付平台',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_set
-- ----------------------------

-- ----------------------------
-- Table structure for `session`
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` char(64) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of session
-- ----------------------------

-- ----------------------------
-- Table structure for `six_lottery_log`
-- ----------------------------
DROP TABLE IF EXISTS `six_lottery_log`;
CREATE TABLE `six_lottery_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub` int(11) NOT NULL COMMENT '外键',
  `log_type` varchar(100) NOT NULL COMMENT '记录类型',
  `log_info` varchar(200) NOT NULL COMMENT '记录信息',
  `create_time` datetime NOT NULL COMMENT '记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of six_lottery_log
-- ----------------------------

-- ----------------------------
-- Table structure for `six_lottery_odds`
-- ----------------------------
DROP TABLE IF EXISTS `six_lottery_odds`;
CREATE TABLE `six_lottery_odds` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `sub_type` varchar(255) DEFAULT NULL,
  `ball_type` varchar(255) DEFAULT NULL,
  `h1` decimal(8,2) DEFAULT NULL,
  `h2` decimal(8,2) DEFAULT NULL,
  `h3` decimal(8,2) DEFAULT NULL,
  `h4` decimal(8,2) DEFAULT NULL,
  `h5` decimal(8,2) DEFAULT NULL,
  `h6` decimal(8,2) DEFAULT NULL,
  `h7` decimal(8,2) DEFAULT NULL,
  `h8` decimal(8,2) DEFAULT NULL,
  `h9` decimal(8,2) DEFAULT NULL,
  `h10` decimal(8,2) DEFAULT NULL,
  `h11` decimal(8,2) DEFAULT NULL,
  `h12` decimal(8,2) DEFAULT NULL,
  `h13` decimal(8,2) DEFAULT NULL,
  `h14` decimal(8,2) DEFAULT NULL,
  `h15` decimal(8,2) DEFAULT NULL,
  `h16` decimal(8,2) DEFAULT NULL,
  `h17` decimal(8,2) DEFAULT NULL,
  `h18` decimal(8,2) DEFAULT NULL,
  `h19` decimal(8,2) DEFAULT NULL,
  `h20` decimal(8,2) DEFAULT NULL,
  `h21` decimal(8,2) DEFAULT NULL,
  `h22` decimal(8,2) DEFAULT NULL,
  `h23` decimal(8,2) DEFAULT NULL,
  `h24` decimal(8,2) DEFAULT NULL,
  `h25` decimal(8,2) DEFAULT NULL,
  `h26` decimal(8,2) DEFAULT NULL,
  `h27` decimal(8,2) DEFAULT NULL,
  `h28` decimal(8,2) DEFAULT NULL,
  `h29` decimal(8,2) DEFAULT NULL,
  `h30` decimal(8,2) DEFAULT NULL,
  `h31` decimal(8,2) DEFAULT NULL,
  `h32` decimal(8,2) DEFAULT NULL,
  `h33` decimal(8,2) DEFAULT NULL,
  `h34` decimal(8,2) DEFAULT NULL,
  `h35` decimal(8,2) DEFAULT NULL,
  `h36` decimal(8,2) DEFAULT NULL,
  `h37` decimal(8,2) DEFAULT NULL,
  `h38` decimal(8,2) DEFAULT NULL,
  `h39` decimal(8,2) DEFAULT NULL,
  `h40` decimal(8,2) DEFAULT NULL,
  `h41` decimal(8,2) DEFAULT NULL,
  `h42` decimal(8,2) DEFAULT NULL,
  `h43` decimal(8,2) DEFAULT NULL,
  `h44` decimal(8,2) DEFAULT NULL,
  `h45` decimal(8,2) DEFAULT NULL,
  `h46` decimal(8,2) DEFAULT NULL,
  `h47` decimal(8,2) DEFAULT NULL,
  `h48` decimal(8,2) DEFAULT NULL,
  `h49` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of six_lottery_odds
-- ----------------------------
INSERT INTO `six_lottery_odds` VALUES ('111', 'N1', null, '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95');
INSERT INTO `six_lottery_odds` VALUES ('201', 'SPA', null, '11.00', '11.30', '11.30', '113.00', '113.00', '113.00', '113.00', '113.00', '8.90', '11.30', '11.30', '11.30', '5.00', '5.00', '5.00', '20.00', '4.50', '12.00', '9.20', '9.20', '9.20', '9.20', '9.20', '9.20', '9.20', '9.20', '92.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('114', 'N4', null, '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95');
INSERT INTO `six_lottery_odds` VALUES ('233', 'LX5', null, '75.00', '75.00', '750.00', '750.00', '750.00', '75.00', '75.00', '75.00', '590.00', '50.00', '75.00', '75.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('121', 'N5', 'other', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '2.70', '2.85', '2.85', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('241', 'SP', 'fs', '10.00', '0.01', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('222', 'NAP1', null, '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '2.70', '2.75', '2.75', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('122', 'N6', 'other', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '2.70', '2.85', '2.85', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('221', 'HB', null, '6.00', '5.06', '651.00', '451.00', '5.61', '6.51', '5.61', '6.51', '5.61', '5.61', '5.06', '6.51', '15.00', '11.10', '8.90', '890.00', '11.10', '11.10', '11.10', '14.80', '8.90', '11.10', '14.80', '11.10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('115', 'N5', null, '40.00', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '415.00', '10.00', '41.50', '415.00', '41.50', '41.50', '41.50', '41.50', '415.00', '41.50', '415.00', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '415.00', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '415.00', '415.00', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '40.00');
INSERT INTO `six_lottery_odds` VALUES ('227', 'NAP6', null, '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '2.70', '2.75', '2.75', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('228', 'NX', null, '6.00', '0.10', '30.00', '40.00', '50.00', '60.00', '70.00', '80.00', '90.00', '100.00', '110.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('225', 'NAP4', null, '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '2.70', '2.75', '2.75', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('238', 'NI', null, '217.00', '263.00', '331.00', '400.00', '500.00', '585.00', '680.00', '851.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('103', 'NA', null, '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '415.00', '7.13', '7.13', '400.00', '7.00', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '415.00', '7.13', '7.13', '7.13', '7.13', '7.13', '7.13', '415.00', '7.13', '7.13', '7.13', '7.13', '7.13');
INSERT INTO `six_lottery_odds` VALUES ('230', 'LX2', null, '40.00', '35.00', '35.00', '35.00', '35.00', '35.00', '12.00', '35.00', '25.00', '35.00', '35.00', '35.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('240', 'SP', 'a_side', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80', '43.80');
INSERT INTO `six_lottery_odds` VALUES ('234', 'LF2', null, '31.00', '31.00', '31.00', '31.00', '31.00', '31.00', '31.00', '31.00', '31.00', '31.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('101', 'SP', null, '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '415.00', '47.50', '415.00', '47.50', '47.50', '47.50', '400.00', '47.50', '415.00', '47.50', '47.50', '47.50', '50.00', '47.50', '415.00', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '415.00', '47.50', '415.00', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50', '47.50');
INSERT INTO `six_lottery_odds` VALUES ('224', 'NAP3', null, '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '2.70', '2.75', '2.75', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('232', 'LX4', null, '30.00', '30.00', '30.00', '30.00', '40.00', '30.00', '30.00', '30.00', '25.00', '0.00', '0.00', '0.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('102', 'SP', 'other', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '30.00', '23.00', '285.00', '1.95', '1.95', '1.95', '1.95', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('119', 'N3', 'other', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '2.70', '2.85', '2.85', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('231', 'LX3', null, '200.00', '100.00', '100.00', '100.00', '100.00', '100.00', '100.00', '100.00', '89.00', '100.00', '100.00', '100.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('116', 'N6', null, '41.50', '41.50', '41.50', '41.50', '41.50', '40.00', '41.50', '41.50', '41.50', '41.50', '41.50', '40.00', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '40.00', '41.50', '41.50', '415.00', '41.50', '41.50', '41.50', '41.50', '41.50', '415.00', '41.50', '41.50', '41.50', '41.50', '41.50', '415.00', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50', '41.50');
INSERT INTO `six_lottery_odds` VALUES ('239', 'CH', null, '10000.00', '500.00', '500.00', '500.00', '500.00', '500.00', '500.00', '400.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('120', 'N4', 'other', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '2.70', '2.85', '2.85', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('104', 'NA', 'other', '1.95', '1.95', '1.95', '1.95', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('113', 'N3', null, '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95');
INSERT INTO `six_lottery_odds` VALUES ('202', 'C7', null, '2.00', '1.92', '2.00', '1.92', '1.92', '1.92', '192.00', '192.00', '1.62', '192.00', '1.92', '1.92', '3.00', '20.00', '275.00', '25.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('118', 'N2', 'other', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '2.70', '2.85', '2.85', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('112', 'N2', null, '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95');
INSERT INTO `six_lottery_odds` VALUES ('235', 'LF3', null, '32.00', '630.00', '6.30', '6.30', '6.30', '6.30', '630.00', '6.30', '630.00', '6.30', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('237', 'LF5', null, '34.00', '420.00', '420.00', '42.00', '42.00', '420.00', '420.00', '420.00', '42.00', '42.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('236', 'LF4', null, '33.00', '15.00', '15.00', '15.00', '15.00', '150.00', '150.00', '150.00', '150.00', '15.00', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('203', 'SPB', null, '2.00', '2.06', '206.00', '2.06', '206.00', '2.06', '2.06', '2.06', '1.72', '2.06', '2.06', '2.06', '2.00', '1.78', '178.00', '1.78', '1.78', '1.78', '1.78', '178.00', '2.00', '1.78', '20.00', '3.07', '1.96', '5.40', '198.00', '1.84', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('223', 'NAP2', null, '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '2.70', '2.75', '2.75', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('226', 'NAP5', null, '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '1.90', '2.70', '2.75', '2.75', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `six_lottery_odds` VALUES ('117', 'N1', 'other', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '1.95', '2.70', '2.85', '2.85', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `six_lottery_order`
-- ----------------------------
DROP TABLE IF EXISTS `six_lottery_order`;
CREATE TABLE `six_lottery_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(100) NOT NULL COMMENT '單號',
  `user_id` int(11) NOT NULL COMMENT '會員ID',
  `lottery_number` varchar(255) NOT NULL COMMENT '开奖期数',
  `rtype_str` varchar(255) NOT NULL COMMENT '彩票 类型，如 一字(组合)，一字(口XX)等',
  `rtype` varchar(255) NOT NULL COMMENT '彩票 类型缩写，如W1, D1M等',
  `bet_info` varchar(5000) NOT NULL COMMENT '下单详细情况',
  `bet_money_total` decimal(11,2) NOT NULL COMMENT '下注金額',
  `win_total` decimal(10,2) NOT NULL COMMENT '最高可赢金额',
  `bet_time` datetime NOT NULL COMMENT '下注時間',
  `status` varchar(20) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:已结算 2:重新结算 3:已作废',
  PRIMARY KEY (`id`),
  KEY `bet_time` (`bet_time`),
  KEY `user_id` (`user_id`),
  KEY `order_num` (`order_num`)
) ENGINE=MyISAM AUTO_INCREMENT=26955 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of six_lottery_order
-- ----------------------------

-- ----------------------------
-- Table structure for `six_lottery_order_sub`
-- ----------------------------
DROP TABLE IF EXISTS `six_lottery_order_sub`;
CREATE TABLE `six_lottery_order_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(100) NOT NULL COMMENT '單號',
  `order_sub_num` varchar(100) NOT NULL COMMENT '子订单号',
  `number` varchar(2000) NOT NULL COMMENT '号码，如1,2,3,单,双,大,小',
  `bet_rate` varchar(100) NOT NULL COMMENT '下注賠率',
  `bet_money` decimal(11,2) NOT NULL COMMENT '下注金額',
  `win` decimal(10,2) NOT NULL COMMENT '可赢金额',
  `fs` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '反水金额',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '下单后账号还有多少钱',
  `status` varchar(10) NOT NULL DEFAULT '0' COMMENT '0:未结算 1:已结算 2:重新结算 3:已作废',
  `is_win` varchar(20) DEFAULT NULL COMMENT '0:未中奖 1:已中奖 2:平局',
  PRIMARY KEY (`id`),
  KEY `order_num` (`order_num`)
) ENGINE=MyISAM AUTO_INCREMENT=92049 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of six_lottery_order_sub
-- ----------------------------

-- ----------------------------
-- Table structure for `six_lottery_schedule`
-- ----------------------------
DROP TABLE IF EXISTS `six_lottery_schedule`;
CREATE TABLE `six_lottery_schedule` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `qishu` varchar(255) DEFAULT NULL,
  `kaipan_time` datetime DEFAULT NULL,
  `fenpan_time` datetime DEFAULT NULL,
  `kaijiang_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `prev_text` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of six_lottery_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_announcement`
-- ----------------------------
DROP TABLE IF EXISTS `sys_announcement`;
CREATE TABLE `sys_announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(5000) NOT NULL COMMENT '公告内容',
  `type` varchar(255) DEFAULT NULL COMMENT '公告类型',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '公告创建时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `is_show` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `fid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_announcement
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_config`
-- ----------------------------
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE `sys_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_name` varchar(100) DEFAULT NULL COMMENT '网站名称',
  `reg_msg_title` varchar(255) DEFAULT NULL,
  `reg_msg_info` text,
  `reg_msg_from` varchar(255) DEFAULT NULL,
  `why` text,
  `conf_www` varchar(255) DEFAULT NULL,
  `web_image` varchar(100) DEFAULT NULL COMMENT '网站图片域名',
  `tk_ring` tinyint(1) DEFAULT '1' COMMENT '提款铃声',
  `hk_ring` tinyint(1) DEFAULT '1' COMMENT '汇款铃声',
  `dl_ring` tinyint(1) DEFAULT '1' COMMENT '理代铃声',
  `cg_ring` tinyint(1) DEFAULT '1' COMMENT '关串铃声',
  `er_ring` tinyint(1) DEFAULT '1' COMMENT '常异会员铃声 ',
  `ss_ring` tinyint(1) DEFAULT '1' COMMENT '员会申述铃声',
  `AGLiveUrl` varchar(255) DEFAULT NULL COMMENT 'AG网址',
  `gunqiu_time_min` varchar(10) DEFAULT NULL COMMENT '滚球时间下限',
  `gunqiu_time_max` varchar(10) DEFAULT NULL COMMENT '滚球时间上限',
  `close` int(1) DEFAULT NULL COMMENT '网站是否关闭',
  `end_close_time` varchar(100) DEFAULT NULL COMMENT '关闭截止时间',
  `service_url` varchar(200) DEFAULT NULL COMMENT '在线客服地址',
  `service_email` varchar(100) DEFAULT NULL COMMENT '客服email',
  `generalize_email` varchar(100) DEFAULT NULL COMMENT '推广email',
  `complain_email` varchar(100) DEFAULT NULL COMMENT '投诉email',
  `contact_tel` varchar(100) DEFAULT NULL COMMENT '客服联系电话',
  `check_url1` varchar(100) DEFAULT NULL COMMENT '线路检测1',
  `check_url2` varchar(100) DEFAULT NULL COMMENT '线路检测2',
  `check_url3` varchar(100) DEFAULT NULL COMMENT '线路检测3',
  `check_url4` varchar(100) DEFAULT NULL COMMENT '线路检测4',
  `check_url5` varchar(100) DEFAULT NULL COMMENT '线路检测5',
  `check_url6` varchar(100) DEFAULT NULL COMMENT '线路检测6',
  `check_url7` varchar(100) DEFAULT NULL COMMENT '线路检测7',
  `check_url8` varchar(100) DEFAULT NULL COMMENT '线路检测8',
  `ag_hall` decimal(9,2) DEFAULT '0.00' COMMENT 'AG 普通厅余额',
  `agin_hall` decimal(9,2) DEFAULT '0.00' COMMENT 'AG 国际厅余额',
  `min_qukuan_money` decimal(9,0) DEFAULT '100' COMMENT '最低取款金额',
  `min_change_money` decimal(9,0) DEFAULT '1' COMMENT '真人最低转账金额',
  `ag_bbin_hall` decimal(9,2) DEFAULT '0.00' COMMENT 'AG BBIN厅余额',
  `ds_hall` decimal(9,2) DEFAULT '0.00' COMMENT 'DS厅余额',
  `serverurl` varchar(100) NOT NULL DEFAULT 'http://118.142.69.136' COMMENT 'serverurl',
  `ag_og_hall` decimal(9,2) DEFAULT '0.00' COMMENT 'AG OG厅余额',
  `ag_mg_hall` decimal(9,2) DEFAULT '0.00' COMMENT 'AG MG厅余额',
  `bbin_hall` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT 'BBIN',
  `auto_zhenren` int(1) DEFAULT NULL,
  `sport_show_row` int(11) DEFAULT NULL,
  `lhc_show_row` int(11) DEFAULT NULL,
  `caipiao_show_row` int(11) DEFAULT NULL,
  `add_pass` text COMMENT '8#',
  `lhc_auto` tinyint(1) unsigned DEFAULT '1' COMMENT '六合彩自动刷新状态',
  `lhc_auto_time` int(4) unsigned DEFAULT '1000' COMMENT '六合彩自动刷新时间',
  `hk_sxf` varchar(50) DEFAULT '0' COMMENT '修改汇款默认手续费比例',
  `caipiao_auto` varchar(50) DEFAULT '1' COMMENT '彩票注单界面是否自动刷新',
  `caipiao_auto_time` varchar(50) DEFAULT '1000' COMMENT '彩票注单界面自动刷新时间',
  `sport_auto` varchar(50) DEFAULT '1' COMMENT '体育注单界面是否自动刷新',
  `sport_auto_time` varchar(50) DEFAULT '1000' COMMENT '体育注单界面自动刷新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_config
-- ----------------------------
INSERT INTO `sys_config` VALUES ('1', '新葡京娱乐城', '欢迎您光临新葡京娱乐城', '欢迎新葡京娱乐城:最高赔率，最快存取款，最刺激的手机美女荷官真人游戏投注，24小时客服人员为您服务，敬请牢记本站域名：www.lpj168.com 手机投注网址：www.lpj168.com', '新葡京娱乐城', null, 'www.lpj168.com', 'lpj168.com', '1', '1', '1', '1', '1', '1', null, '60', '90', '0', '2016-08-31 00:00:00', null, '99456789@qq.com', '99456789@qq.com', '99456789@qq.com', '', 'www.90181.com', 'www.9028.com', 'www.9038.com', 'www.9048.com', 'www.9058.com', 'www.9068.com', 'www.9078.com', 'www.9098.com', '29000.00', '38450.00', '1000', '10', '47550.00', '46850.00', 'http://118.142.69.136', '46648.00', '46250.00', '0.00', '0', '20', '20', '20', '8#', '1', '1000', '0', '1', '1000', '1', '1000');

-- ----------------------------
-- Table structure for `sys_huikuanbank_list`
-- ----------------------------
DROP TABLE IF EXISTS `sys_huikuanbank_list`;
CREATE TABLE `sys_huikuanbank_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) CHARACTER SET gbk NOT NULL COMMENT '银行名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_huikuanbank_list
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_huikuan_list`
-- ----------------------------
DROP TABLE IF EXISTS `sys_huikuan_list`;
CREATE TABLE `sys_huikuan_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) CHARACTER SET gbk NOT NULL COMMENT '银行类型',
  `bank_number` varchar(100) CHARACTER SET gbk NOT NULL COMMENT '银行账号',
  `bank_xm` varchar(100) CHARACTER SET gbk NOT NULL COMMENT '开户姓名',
  `bank_city` varchar(100) CHARACTER SET gbk NOT NULL COMMENT '开户银行',
  `bank_status` tinyint(3) DEFAULT '0' COMMENT '显示状态 0-禁用 1-启用',
  `bank_type` tinyint(3) NOT NULL COMMENT '类型 1-网银 2-微信 3-支付宝',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_huikuan_list
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_manage`
-- ----------------------------
DROP TABLE IF EXISTS `sys_manage`;
CREATE TABLE `sys_manage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manage_name` varchar(16) CHARACTER SET gbk NOT NULL,
  `manage_pass` varchar(32) CHARACTER SET gbk NOT NULL,
  `login_one` int(1) NOT NULL COMMENT '只允许一个地方登陆 1为一个地方登陆 0为没有',
  `bindcomputer` tinyint(1) NOT NULL DEFAULT '0' COMMENT '绑定计算机',
  `purview` varchar(250) CHARACTER SET gbk NOT NULL COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `sys_manage_lock`
-- ----------------------------
DROP TABLE IF EXISTS `sys_manage_lock`;
CREATE TABLE `sys_manage_lock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sys_cookie` varchar(200) NOT NULL DEFAULT '0',
  `b_lock` tinyint(4) NOT NULL DEFAULT '0' COMMENT '否是锁定',
  `run_str` varchar(50) DEFAULT NULL COMMENT '标识',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1030 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_manage_lock
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_manage_online`
-- ----------------------------
DROP TABLE IF EXISTS `sys_manage_online`;
CREATE TABLE `sys_manage_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manage_name` varchar(16) NOT NULL,
  `session_str` varchar(32) NOT NULL,
  `logintime` datetime NOT NULL COMMENT '登陆时间',
  `onlinetime` datetime NOT NULL COMMENT '在线时间',
  `loginip` varchar(16) NOT NULL COMMENT '登陆 IP',
  `loginbrowser` varchar(50) NOT NULL COMMENT '登陆浏览器',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1863 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_manage_online
-- ----------------------------

-- ----------------------------
-- Table structure for `tennis_match`
-- ----------------------------
DROP TABLE IF EXISTS `tennis_match`;
CREATE TABLE `tennis_match` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Match_ID` varchar(50) NOT NULL,
  `Match_Date` varchar(20) DEFAULT NULL,
  `Match_Time` varchar(20) DEFAULT NULL,
  `Match_Name` varchar(50) DEFAULT NULL,
  `Match_Master` varchar(50) DEFAULT NULL,
  `Match_Guest` varchar(50) DEFAULT NULL,
  `Match_IsLose` varchar(4) DEFAULT NULL,
  `Match_State` varchar(7) DEFAULT NULL,
  `Match_Type` tinyint(3) unsigned DEFAULT NULL,
  `Match_Ho` double DEFAULT NULL,
  `Match_Ao` double DEFAULT NULL,
  `Match_RGG` varchar(15) DEFAULT NULL,
  `Match_BzM` double DEFAULT NULL,
  `Match_BzG` double DEFAULT NULL,
  `Match_DxGG` varchar(15) DEFAULT NULL,
  `Match_DxDpl` double DEFAULT NULL,
  `Match_DxXpl` double DEFAULT NULL,
  `Match_DsDpl` double DEFAULT NULL,
  `Match_DsSpl` double DEFAULT NULL,
  `Match_OverScore` varchar(10) DEFAULT NULL,
  `Match_JS` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowds` tinyint(3) unsigned DEFAULT '0',
  `Match_AddDate` datetime DEFAULT NULL,
  `Match_CoverDate` datetime DEFAULT NULL,
  `Match_IsShowds` tinyint(3) unsigned DEFAULT '1',
  `Match_MasterID` varchar(15) DEFAULT NULL,
  `Match_GuestID` varchar(15) DEFAULT NULL,
  `Match_StopUpdateds` tinyint(3) unsigned DEFAULT '0',
  `Match_TypePlay` varchar(5) DEFAULT NULL,
  `Match_bd20` float DEFAULT NULL,
  `Match_bd21` float DEFAULT NULL,
  `Match_bd30` float DEFAULT NULL,
  `Match_bd31` float DEFAULT NULL,
  `Match_bd32` float DEFAULT NULL,
  `match_1score` varchar(15) DEFAULT NULL,
  `match_2score` varchar(15) DEFAULT NULL,
  `match_3score` varchar(15) DEFAULT NULL,
  `match_4score` varchar(15) DEFAULT NULL,
  `match_5score` varchar(15) DEFAULT NULL,
  `match_PScore` varchar(15) DEFAULT NULL,
  `Match_Scene` tinyint(3) unsigned DEFAULT '0',
  `Match_MatchTime` varchar(30) DEFAULT NULL,
  `MB_Inball` varchar(5) DEFAULT NULL,
  `TG_Inball` varchar(5) DEFAULT NULL,
  `MB_Inball_HR` varchar(5) DEFAULT NULL,
  `TG_Inball_HR` varchar(5) DEFAULT NULL,
  `scorecheck` smallint(11) DEFAULT NULL,
  `match_showtype` varchar(1) NOT NULL DEFAULT 'H',
  `remark` varchar(100) DEFAULT '',
  `score_time` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Match_ID` (`Match_ID`),
  KEY `Match_Type` (`Match_Type`),
  KEY `Match_Date` (`Match_Date`),
  KEY `Match_CoverDate` (`Match_CoverDate`),
  KEY `Match_Bd21` (`Match_bd21`),
  KEY `Match_Name` (`Match_Name`),
  KEY `Match_StopUpdateds` (`Match_StopUpdateds`)
) ENGINE=MyISAM AUTO_INCREMENT=12339 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tennis_match
-- ----------------------------

-- ----------------------------
-- Table structure for `trace_log`
-- ----------------------------
DROP TABLE IF EXISTS `trace_log`;
CREATE TABLE `trace_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1241850 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trace_log
-- ----------------------------

-- ----------------------------
-- Table structure for `trace_speed`
-- ----------------------------
DROP TABLE IF EXISTS `trace_speed`;
CREATE TABLE `trace_speed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) DEFAULT NULL,
  `second` varchar(255) DEFAULT NULL,
  `createTime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trace_speed
-- ----------------------------

-- ----------------------------
-- Table structure for `tyc_status`
-- ----------------------------
DROP TABLE IF EXISTS `tyc_status`;
CREATE TABLE `tyc_status` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL COMMENT '状态',
  `msg` text COMMENT '图片地址或者字符串',
  `code` varchar(255) DEFAULT NULL COMMENT '保存验证码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tyc_status
-- ----------------------------

-- ----------------------------
-- Table structure for `t_guanjun`
-- ----------------------------
DROP TABLE IF EXISTS `t_guanjun`;
CREATE TABLE `t_guanjun` (
  `x_id` int(11) NOT NULL AUTO_INCREMENT,
  `match_name` varchar(250) NOT NULL,
  `x_title` varchar(100) NOT NULL,
  `match_date` varchar(10) NOT NULL,
  `match_time` varchar(10) NOT NULL,
  `match_coverdate` datetime NOT NULL,
  `add_time` datetime NOT NULL,
  `x_result` varchar(1000) DEFAULT NULL,
  `match_id` varchar(10) NOT NULL DEFAULT '0',
  `match_type` int(1) unsigned NOT NULL DEFAULT '1',
  `game_type` varchar(10) DEFAULT NULL,
  `remark` varchar(100) DEFAULT '',
  `score_time` datetime DEFAULT NULL,
  PRIMARY KEY (`x_id`),
  KEY `match_id` (`match_id`),
  KEY `x_title` (`x_title`),
  KEY `match_type` (`match_type`),
  KEY `match_date` (`match_date`)
) ENGINE=MyISAM AUTO_INCREMENT=803 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_guanjun
-- ----------------------------

-- ----------------------------
-- Table structure for `t_guanjun_team`
-- ----------------------------
DROP TABLE IF EXISTS `t_guanjun_team`;
CREATE TABLE `t_guanjun_team` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `xid` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `point` float NOT NULL DEFAULT '0',
  `match_id` varchar(10) NOT NULL DEFAULT 'none',
  `match_type` int(1) unsigned NOT NULL DEFAULT '1',
  `match_id_g` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `xid` (`xid`),
  KEY `match_id` (`match_id`),
  KEY `match_type` (`match_type`)
) ENGINE=MyISAM AUTO_INCREMENT=20370640 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_guanjun_team
-- ----------------------------

-- ----------------------------
-- Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员组编号',
  `group_name` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT '普通会员' COMMENT '会员组名称',
  `total_bets` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '下注流水总额达到，自动换到这个组',
  `default_group` varchar(1) CHARACTER SET gbk NOT NULL DEFAULT '否' COMMENT '否是是默认组',
  `sports_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '体育下注大于',
  `sports_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000' COMMENT '体育下注返利',
  `cq_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '重庆时时彩',
  `cq_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `jx_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '江西时时彩',
  `jx_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `tj_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '极速时时彩',
  `tj_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `bjpk_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '京北PK10',
  `bjpk_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `bjkn_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '京北快乐8',
  `bjkn_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `gdsf_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '广东十分',
  `gdsf_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `tjsf_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '天津十分',
  `tjsf_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `gxsf_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '广西十分',
  `gxsf_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `cqsf_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '重庆十分',
  `cqsf_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `gd11_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '东广11选5',
  `gd11_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `lhc_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '合彩六',
  `lhc_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `d3_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '福彩3D',
  `d3_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `p3_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '列三排',
  `p3_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `t3_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '上海时时乐',
  `t3_bet_reb` decimal(4,3) NOT NULL DEFAULT '0.000',
  `sports_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '育体投注最低下限',
  `cq_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '重庆时时彩最低下注',
  `jx_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '江西时时彩最低下注',
  `tj_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '极速时时彩最低下注',
  `bjpk_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bjkn_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gdsf_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gxsf_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tjsf_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cqsf_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gd11_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `lhc_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `d3_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `p3_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `t3_lower_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sports_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '育体投最高上限',
  `cq_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '重庆时时彩最高上限',
  `jx_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '江西时时彩最高上限',
  `tj_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '极速时时彩最高上限',
  `bjpk_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bjkn_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gdsf_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gxsf_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tjsf_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cqsf_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gd11_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `lhc_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `d3_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `p3_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `t3_max_bet` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO `user_group` VALUES ('2', '553', '新会员组', '0.00', '是', '10.00', '0.010', '1.00', '0.001', '10.00', '0.010', '10.00', '0.001', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '10.00', '0.010', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '10.00', '1.00', '1.00', '1.00', '50001.00', '1000.00', '1000.00', '1000.00', '99999999.99', '99999999.99', '1000.00', '1000.00', '1000.00', '99999999.99', '99999999.99', '99999999.00', '99999999.99', '99999999.99', '99999999.99');
INSERT INTO `user_group` VALUES ('6', '972', '测试组会员', '10000000.00', '否', '20.00', '0.230', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.010', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '20.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '2000.00', '50000.00', '50000.00', '50000.00');
INSERT INTO `user_group` VALUES ('4', '804', '银冠VIP', '10000000.00', '否', '20.00', '0.008', '10.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '20.00', '0.008', '1.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '30.00', '50000.00', '10000.00', '10000.00', '10000.00', '10000.00', '10000.00', '10000.00', '10000.00', '10000.00', '10000.00', '10000.00', '99999999.99', '10000.00', '10000.00', '10000.00');
INSERT INTO `user_group` VALUES ('5', '866', '钻石VIP', '1000000.00', '否', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '0.008', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '10.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00');
INSERT INTO `user_group` VALUES ('3', '735', '投注体育、彩票没有返水', '1000000.00', '否', '1.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '20.00', '0.030', '1.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '20.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00', '50000.00');

-- ----------------------------
-- Table structure for `user_list`
-- ----------------------------
DROP TABLE IF EXISTS `user_list`;
CREATE TABLE `user_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户编号',
  `Oid` varchar(50) CHARACTER SET gbk NOT NULL DEFAULT 'logout',
  `user_name` varchar(16) CHARACTER SET gbk NOT NULL COMMENT '用户名',
  `user_pass` varchar(32) CHARACTER SET gbk NOT NULL COMMENT '用户密码',
  `user_pass_naked` varchar(32) DEFAULT NULL COMMENT '用户密码_明文',
  `qk_pass` varchar(32) CHARACTER SET gbk NOT NULL COMMENT '取款密码',
  `top_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级代理ID',
  `money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '员会当前帐户金额',
  `total_bets` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '注下流水',
  `ask` varchar(50) CHARACTER SET gbk NOT NULL COMMENT '安全问题',
  `answer` varchar(50) CHARACTER SET gbk NOT NULL COMMENT '安全回答',
  `loginip` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT '0.0.0.0' COMMENT '登陆IP',
  `OnlineTime` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '在線時間',
  `logintime` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '登陆时间',
  `loginaddress` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT '未知' COMMENT '登陆地址',
  `regtime` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '注册时间',
  `regip` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT '0.0.0.0' COMMENT '注册IP',
  `regaddress` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT '未知' COMMENT '注册地址',
  `logouttime` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '户用退出时间',
  `online` varchar(1) CHARACTER SET gbk NOT NULL DEFAULT '否' COMMENT '是否在线',
  `lognum` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `status` varchar(4) CHARACTER SET gbk NOT NULL DEFAULT '正常' COMMENT '会员状态,1正常，2停用，3异常',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员组ID',
  `sex` varchar(2) CHARACTER SET gbk NOT NULL DEFAULT '未知' COMMENT '性别',
  `birthday` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '生日',
  `tel` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT '空' COMMENT '电话',
  `email` varchar(50) CHARACTER SET gbk NOT NULL DEFAULT '空' COMMENT '会员邮箱',
  `qq` int(15) DEFAULT '0' COMMENT '会员QQ',
  `othercon` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT '空' COMMENT '其他联系信息',
  `country` varchar(50) CHARACTER SET gbk NOT NULL DEFAULT '空' COMMENT '国籍',
  `province` varchar(50) CHARACTER SET gbk NOT NULL DEFAULT '空' COMMENT '省份',
  `city` varchar(50) CHARACTER SET gbk NOT NULL DEFAULT '空' COMMENT '城市',
  `address` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT '空' COMMENT '详细地址',
  `pay_name` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT '未填写' COMMENT '会员银行卡用户名',
  `pay_address` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT '未填写' COMMENT '银行卡开户地址',
  `pay_num` varchar(50) CHARACTER SET gbk NOT NULL DEFAULT '未填写' COMMENT '银行卡帐号',
  `pay_bank` varchar(50) CHARACTER SET gbk NOT NULL DEFAULT '未填写' COMMENT '开户银行',
  `remark` text CHARACTER SET gbk NOT NULL COMMENT '备注信息',
  `loginurl` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT 'www' COMMENT '录登网址',
  `regurl` varchar(100) CHARACTER SET gbk NOT NULL DEFAULT 'www' COMMENT '注册网址',
  `is_allow_live` varchar(10) NOT NULL DEFAULT '2' COMMENT '1:允许，2不允许',
  `allow_total_money` int(10) NOT NULL DEFAULT '0' COMMENT '允许会员当期下注金额',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1253 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_list
-- ----------------------------

-- ----------------------------
-- Table structure for `user_log`
-- ----------------------------
DROP TABLE IF EXISTS `user_log`;
CREATE TABLE `user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(16) CHARACTER SET gbk NOT NULL DEFAULT '未知',
  `user_id` int(11) NOT NULL,
  `Oid` varchar(50) CHARACTER SET gbk NOT NULL,
  `login_ip` varchar(20) CHARACTER SET gbk NOT NULL DEFAULT '0.0.0.0' COMMENT '登陆IP',
  `edlog` varchar(200) CHARACTER SET gbk NOT NULL COMMENT '操作内容',
  `edtime` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '操作时间',
  `login_url` varchar(200) DEFAULT NULL COMMENT '登录网址',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`user_name`,`login_ip`,`edlog`) USING BTREE,
  KEY `user_id` (`user_id`),
  FULLTEXT KEY `edlog` (`user_name`,`login_ip`,`edlog`)
) ENGINE=MyISAM AUTO_INCREMENT=7874 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of user_log
-- ----------------------------

-- ----------------------------
-- Table structure for `user_msg`
-- ----------------------------
DROP TABLE IF EXISTS `user_msg`;
CREATE TABLE `user_msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_from` varchar(20) NOT NULL COMMENT '发消息者',
  `user_id` int(11) NOT NULL,
  `msg_title` varchar(50) NOT NULL COMMENT '消息标题',
  `msg_info` varchar(2000) DEFAULT NULL,
  `msg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `islook` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5745 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_msg
-- ----------------------------

-- ----------------------------
-- Table structure for `volleyball_match`
-- ----------------------------
DROP TABLE IF EXISTS `volleyball_match`;
CREATE TABLE `volleyball_match` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Match_ID` varchar(50) NOT NULL,
  `Match_Date` varchar(20) DEFAULT NULL,
  `Match_Time` varchar(20) DEFAULT NULL,
  `Match_Name` varchar(50) DEFAULT NULL,
  `Match_Master` varchar(50) DEFAULT NULL,
  `Match_Guest` varchar(50) DEFAULT NULL,
  `Match_IsLose` varchar(4) DEFAULT NULL,
  `Match_State` varchar(7) DEFAULT NULL,
  `Match_Type` tinyint(3) unsigned DEFAULT NULL,
  `Match_Ho` double DEFAULT NULL,
  `Match_Ao` double DEFAULT NULL,
  `Match_RGG` varchar(15) DEFAULT NULL,
  `Match_BzM` double DEFAULT NULL,
  `Match_BzG` double DEFAULT NULL,
  `Match_DxGG` varchar(15) DEFAULT NULL,
  `Match_DxDpl` double DEFAULT NULL,
  `Match_DxXpl` double DEFAULT NULL,
  `Match_DsDpl` double DEFAULT NULL,
  `Match_DsSpl` double DEFAULT NULL,
  `Match_OverScore` varchar(10) DEFAULT NULL,
  `Match_JS` tinyint(3) unsigned DEFAULT '0',
  `Match_Allowds` tinyint(3) unsigned DEFAULT '0',
  `Match_AddDate` datetime DEFAULT NULL,
  `Match_CoverDate` datetime DEFAULT NULL,
  `Match_IsShowds` tinyint(3) unsigned DEFAULT '1',
  `Match_MasterID` varchar(15) DEFAULT NULL,
  `Match_GuestID` varchar(15) DEFAULT NULL,
  `Match_StopUpdateds` tinyint(3) unsigned DEFAULT '0',
  `Match_TypePlay` varchar(5) DEFAULT NULL,
  `Match_bd20` float DEFAULT NULL,
  `Match_bd21` float DEFAULT NULL,
  `Match_bd30` float DEFAULT NULL,
  `Match_bd31` float DEFAULT NULL,
  `Match_bd32` float DEFAULT NULL,
  `Match_1Score` varchar(15) DEFAULT NULL,
  `Match_2Score` varchar(15) DEFAULT NULL,
  `Match_3Score` varchar(15) DEFAULT NULL,
  `Match_4Score` varchar(15) DEFAULT NULL,
  `Match_5Score` varchar(15) DEFAULT NULL,
  `Match_PScore` varchar(15) DEFAULT NULL,
  `Match_Scene` tinyint(3) unsigned DEFAULT '0',
  `Match_MatchTime` varchar(30) DEFAULT NULL,
  `MB_Inball` varchar(5) DEFAULT NULL,
  `TG_Inball` varchar(5) DEFAULT NULL,
  `MB_Inball_HR` varchar(5) DEFAULT NULL,
  `TG_Inball_HR` varchar(5) DEFAULT NULL,
  `scorecheck` smallint(6) DEFAULT NULL,
  `Match_ShowType` varchar(1) DEFAULT 'H',
  `score_time` datetime DEFAULT NULL,
  `remark` varchar(100) DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `Match_ID` (`Match_ID`),
  KEY `Match_Type` (`Match_Type`),
  KEY `Match_CoverDate` (`Match_CoverDate`),
  KEY `Match_Date` (`Match_Date`),
  KEY `Match_Name` (`Match_Name`),
  KEY `Match_StopUpdateds` (`Match_StopUpdateds`)
) ENGINE=MyISAM AUTO_INCREMENT=2449 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of volleyball_match
-- ----------------------------

-- ----------------------------
-- Table structure for `webinfo`
-- ----------------------------
DROP TABLE IF EXISTS `webinfo`;
CREATE TABLE `webinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of webinfo
-- ----------------------------
INSERT INTO `webinfo` VALUES ('14', 'temp14', 'temp14', 'temp14');
INSERT INTO `webinfo` VALUES ('1', 'jdtz', '焦点投注', '6月04日  03:00<p style=\"color: #ffff00;\">友誼賽</p>巴西  VS 英格蘭<br />0.90 一球 1.00');
INSERT INTO `webinfo` VALUES ('8', 'qkbz', '取款帮助', '<p>\r\n     </p>\r\n<p>\r\n    一、<strong>您可以通过以下方式取款：</strong></p>\r\n<ol>\r\n    <li align=\"left\">会员登入后点选“在线取款”。</li>\r\n    <li align=\"left\">输入选择“取款密码”，并确认提款人姓名与您银行账号持有人相符。</li>\r\n    <li align=\"left\">输入“取款额度”以及“有效的手机号码”，如有任何问题，方便客服人员在第一时间与您联系。</li>\r\n    <li align=\"left\">确认提款银行账号正确。</li>\r\n    <li align=\"left\">可以选择以下方式取款：<br>\r\n        绑定中国工商银行(优先)、中国农业银行、北京银行、交通银行、中国银行、中国建设银行、中国光大银行、兴业银行、中国民生银行总行、招商银行、中信银行、广东发展银行、中国邮政、深圳发展银行、上海浦东发展银行。<br>\r\n        24小时取款，5分钟内到帐，不限制取款金额，不限制取款次数（24小时内出款两次以上(包含第2次出款)，每次出款须承担50元手续费用），如有任何问题，请联系24小时在线客服，</li>\r\n</ol>\r\n<p align=\"left\">\r\n    二、<strong>【取款注意事项】</strong></p>\r\n<ol>\r\n    <li align=\"left\">最低取款为$100人民币，取款上限为$200000人民币。(在线支付每日最高取款总额上限为$300000人民币,公司入款每日最高取款总额上限为$1000000人民币)。</li>\r\n    <li align=\"left\">24小时内若出款两次以上(包含第2次出款)，除需审核外，每次出款须承担50元手续费用。</li>\r\n    <li align=\"left\">新世界国际娱乐城保留权利审核会员账户，若由最后一次入款起，有效下注金额需达到入款金额的100%，未达到而申请出款者，公司将收取入款金额的30%行政费用，以及$50出款手续费。</li>\r\n</ol>\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 598px;\" width=\"598\">\r\n    <tbody>\r\n        <tr>\r\n            <td style=\"width: 40px;\">\r\n                <p align=\"center\">\r\n                    存款</p>\r\n            </td>\r\n            <td style=\"width: 60px;\">\r\n                <p align=\"center\">\r\n                    存款金额</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"center\">\r\n                    存款后余额</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"center\">\r\n                    会员打码</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n                <p align=\"center\">\r\n                    第三次</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"center\">\r\n                    7,000</p>\r\n            </td>\r\n            <td style=\"width: 70px;\">\r\n                <p align=\"center\">\r\n                    20,000</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"left\">\r\n                    8,000---存款7000后~下注8000元 ,并且多了1000,有通过常态性稽核</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n                <p align=\"center\">\r\n                    第二次</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"center\">\r\n                    8,000</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"center\">\r\n                    12,000</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"left\">\r\n                    5,500---存款8000后~下注5500+1000元没通过常态性稽核,须扣行政费用2400及手续费50块。</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n                <p align=\"center\">\r\n                    第一次</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"center\">\r\n                    5,000</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"center\">\r\n                    5,000</p>\r\n            </td>\r\n            <td>\r\n                <p align=\"left\">\r\n                    5,500---存款5000后~下注5500+5500+1000元有通过常态性稽核</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan=\"4\">\r\n                <p align=\"left\">\r\n                    所以常态性稽核~会扣除第2次的存款金额8000*30%=2400,及50块手续费才可以出款。</p>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p align=\"left\">\r\n    **如有任何问题，请洽24小时在线客服！</p>\r\n<p align=\"left\">\r\n    **请注意**各游戏和局/未接受/取消注单，不纳入有效投注计算。运动博弈游戏项目，大赔率玩法计算有效投注金额，小赔率玩法计算输赢金额为有效投注。</p>\r\n<p align=\"left\">\r\n    **大赔率产品包括: 1X2、过关、波胆、总入球、半全场、双胜彩、冠军赛。</p>\r\n<p align=\"left\">\r\n    **新世界国际娱乐城相关优惠，请详见‘优惠活动’</p>');
INSERT INTO `webinfo` VALUES ('2', 'temp2', 'temp2', 'temp2');
INSERT INTO `webinfo` VALUES ('9', 'cjwt', '常见问题', '<div id=\"Union\">\r\n    <ul class=\"mtab-menual\" style=\"\">\r\n        <li id=\"#Union1\" class=\"mtab\">一般常见问题</li><li id=\"#Union2\">游戏及投注问题</li><li id=\"#Union3\">\r\n            技术常见问题</li></ul>\r\n    <div id=\"Union1\">\r\n        <p>\r\n            Q1: 如何加入新世界国际娱乐城？</p>\r\n        <p align=\"left\">\r\n            A1: 您可以直接点选立即加入，确实填写资料后，可立即登记成为新世界国际娱乐城会员。<br>\r\n            <br>\r\n            Q2: 我可以直接在网络上存款吗？<br>\r\n            A2: 可以，新世界国际娱乐城提供多种在线存款选择，详情请参照 存款须知。</p>\r\n        <p align=\"left\">\r\n            Q3: 我在那里可以找到游戏的规则？<br>\r\n            A3: 在未登入前，您可以在游戏的最外层看到\"游戏规则\"选项，清楚告诉您游戏的玩法、规则及派彩方式。在游戏窗口中，也有\"规则\"选项，让您在享受游戏乐趣的同时，可以弹跳窗口随时提醒您游戏规则。<br>\r\n            <br>\r\n            Q4: 你们的游戏会用多少副牌？</p>\r\n        <p align=\"left\">\r\n            A4: 在百家乐我们会用8副牌，其他游戏则会根据其性质有所调整。</p>\r\n        <p align=\"left\">\r\n            Q5: 您们何时会洗牌?<br>\r\n            A5: 所有纸牌游戏，当红的洗牌记号出现或游戏因线路问题中断时便会进行重新洗牌。</p>\r\n        <p align=\"left\">\r\n            Q6: 我的注码的限制是多少？<br>\r\n            A6: 从最低注单 20(视讯)~100(球类) 元人民币以上即可投注， 您的注码会根据您的存款有所不同，以及您挑选的游戏不同而有所区别。</p>\r\n        <p align=\"left\">\r\n            Q7: 如果忘记密码怎么办？<br>\r\n            A7: 你可点击首页忘记密码功能，填写你当初留下的邮箱，即可取回你当初设定的密码。当你无法收取邮件时，你也可以联系24小时在线客服人员咨询协助取回你的账号密码。</p>\r\n        <p>\r\n            Q8: 当你注册时出现，姓名已注册。<br>\r\n            A8: 你可透过24小时在线客服人员协助处理。</p>\r\n    </div>\r\n    <div id=\"Union2\" style=\"display: none;\">\r\n        <p>\r\n            Q1: 请问我在哪边可以找到游戏规则？</p>\r\n        <p align=\"left\">\r\n            A1: 在你为登入之前，你可以在各个游戏项目内，看见游戏规则的选项，清楚告知游的玩法、规则及派彩方式。 在游戏窗口中，也有\"规则\"选项，让您在享受游戏乐趣的同时，可以弹跳窗口随时提醒您游戏规则。</p>\r\n        <p align=\"left\">\r\n            Q2: 请问个个游戏的注额为多少？<br>\r\n            A2: 真人游戏-最低下注20RMB最高限额50000RMB<br>\r\n            体育博彩-最低下注10RMB最高限额30000RMB<br>\r\n            彩票游戏-最低下注5RMB最高限额依照游戏及玩法不同，最高可到50000RMB<br>\r\n            电子机率-最低下注0.2RMB最高限额依照游戏及玩法不同</p>\r\n        <p align=\"left\">\r\n            Q3: 你们的游戏会用多少副牌？<br>\r\n            A3:在百家乐我们会用8副牌，其他游戏则会根据其性质有所调整。</p>\r\n        <p align=\"left\">\r\n            Q4: 您们何时会洗牌?<br>\r\n            A4: 所有纸牌游戏，当红的洗牌记号出现或游戏因线路问题中断时便会进行重新洗牌。</p>\r\n    </div>\r\n    <div id=\"Union3\" style=\"display: none;\">\r\n        <p>\r\n            Q: 最低的硬件系统要求是什么?</p>\r\n        <ol>\r\n            <li align=\"left\">任何可以接上互联网的计算机。</li>\r\n            <li align=\"left\">SVGA显示适配器–最少要1204x768像素256色彩以上。</li>\r\n            <li align=\"left\">区域宽带。</li>\r\n            <li align=\"left\">Windows , Mac OS X , Linux操作系统。</li>\r\n            <li align=\"left\">Internet Explorer浏览器v6.0 或以上 (版本7.0 或以上更好)，Mozilla Firefox (浏览器v3.0\r\n                或以上)，Opera (浏览器v8.0 或以上)，Chrome(浏览器v6.0 或以上)，Safari (浏览器v4.0 或以上)</li>\r\n            <li align=\"left\">要浏览在线娱乐城，你可以在 Macromedia网站下载Macromedia Flash Player浏览器附加程序(8.0或以上版本)。 </li>\r\n        </ol>\r\n    </div>\r\n</div>');
INSERT INTO `webinfo` VALUES ('6', 'hzhb', '代理合作', '<div id=\"Union\">\r\n    <ul class=\"mtab-menual\" style=\"\">\r\n        <li id=\"#Union1\" class=\"mtab\">联盟方案</li><li id=\"#Union2\">联盟协议</li></ul>\r\n    <div id=\"Union1\">\r\n        <p>\r\n            新世界国际娱乐城，与AG(亚游集团)进行技术合作，拥有菲律宾合法注册之博彩公司。拥有多元化的产品，使用最公平、公正、公开的系统，在市场上的众多博彩网站中，我们自豪的提供会员最优惠的回\r\n            馈，给予合作伙伴最优势的营利回报! 无论您拥有的是网络资源，或是人脉资源，都欢迎您来加入新世界国际娱乐城合作伙伴的行列，无须负担任何费用，就可以开始无上限的收入。新世界国际娱乐城，绝\r\n            对是您最聪明的选择!</p>\r\n        <p>\r\n            ?注册申请<br>\r\n            请点击[代理注册]在线提出申请，填写正确的各项数据，邮箱，手机，名字必须写真实的，方便以后支付给您佣金，如果以后在支付佣金的时候发现数据错误，一律不给予支付佣金。<br>\r\n            请代理注册成功之后，编辑您以后要领取彩金的银行账号,银行用户名,代理账号,发送到邮箱,我们进行绑定,每个月系统就会自动把佣金转到您提供的银行账号上,请代理要 更改银行账号的,必须提前一个星期联系在线客服进行修改，否则本公司一律不负责。新世界国际娱乐城会评估审核联盟申请讯息，3日内由专员与您联系开通，并提供您的注册账号、密码及推广链接。</p>\r\n        <table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 593px;\" width=\"593\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">当月营利</span></p>\r\n                    </td>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">当月最低有效会员</span></p>\r\n                    </td>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">真人、运动、电子</span></p>\r\n                    </td>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">彩票（有效投注）</span></p>\r\n                    </td>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">体育投注</span></p>\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            1--50000</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            5或以上</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            30%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            0.1%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            10%</p>\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            50001~500000</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            10或以上</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            35%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            0.1%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            10%</p>\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            500001~800000</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            30或以上</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            40%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            0.1%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            10%</p>\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            800001~1000000</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            50或以上</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            45%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            0.1%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            10%</p>\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            1000001以上</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            100或以上</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            50%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            0.1%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            10%</p>\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n        <p>\r\n            <span style=\"color: #ff0000;\">投注额达到（1000元）视为有效会员！（每月10号为退佣到账处理时间）<br>\r\n                注：新世界国际娱乐城保留上述条例之最终更改权！<br>\r\n                请谨记任何使用不诚实方法以骗取佣金将会永久冻结账户，佣金一律不予发还！</span></p>\r\n        <p>\r\n            ? 回馈/佣金计算<br>\r\n            ●退水(前期累积+当期总退水) - 费用(前期累积+当期总费用),当相减下来有两个结果：<br>\r\n            正数 跟 负数<br>\r\n            ●正数时：相减下来的金额+派彩(前期累积+当期总派彩)*退佣比例= 可获得佣金<br>\r\n            【举例：A代理 退水金额1万?费用5000?有效派彩5万元?退佣比例25%】<br>\r\n            退水1万元 – 费用5000=尚有5000<br>\r\n            可获佣金= 5000+( 派彩金额 5万* 25% )=17,500<br>\r\n            ●负数时：(相减下来的金额+派彩(前期累积+当期总派彩))*退佣比例= 可获得佣金<br>\r\n            【举例：A代理 退水金额5000?费用1万?有效派彩5万元?退佣比例25%】<br>\r\n            退水5000元 – 费用1万=尚有-5000<br>\r\n            可获佣金= (-5000+ 派彩金额 5万)* 25% =11,250<br>\r\n            ●请注意：视讯、球类、机率等项目，以报表中【派彩】字段，扣除相应费用后，依照上表门坎 X 佣金百分比。<br>\r\n            ●彩票项目以报表中【实际投注】字段X 0.1% 佣金百分比后，扣除相应费用</p>\r\n        <p>\r\n            ●月联盟体系以：视讯、球类、机率、彩票等项目的【派彩/投注量】扣除相应费用后产生退佣总计，成以相应退佣百分比后。<br>\r\n            <span style=\"color: #ff0000;\">●相应费用包括：会员各项优惠、存/取款相应手续费(请留意：新世界国际娱乐城会员重复出款￥手续费/未达100%投注出款的手续费由会员吸收，不纳入计算)。</span><br>\r\n            ●【当月最低有效会员】定义为，在月结区间内进行过最少一次有效下注的会员，如联盟体系当月未达【当月最低有效会员】最低门坎5人，则该月无法领取佣金回馈。联盟体系当月营利达到标准，而【当月最低有效会员】人数未达相应最低门坎，则该月佣金比例依照【当月最低有效会员】人数所达门坎相应的百分比进行退佣。<br>\r\n            例：体系当月营利为￥200001，而当月有效会员人数为5人，联盟虽达到营利为￥200001，却未达到有效会员10人以上，故依照联盟有效会员人数5人的门坎的退佣比例核算。</p>\r\n        <table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 500px;\" width=\"500\">\r\n            <tbody>\r\n                <tr>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">视讯</span></p>\r\n                    </td>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">球类</span></p>\r\n                    </td>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">机率</span></p>\r\n                    </td>\r\n                    <td style=\"background-color: rgb(102, 51, 102);\">\r\n                        <p align=\"center\">\r\n                            <span style=\"color: #ffffff;\">彩票</span></p>\r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            30%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            30%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            30%</p>\r\n                    </td>\r\n                    <td>\r\n                        <p align=\"center\">\r\n                            0.1%</p>\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n        <p>\r\n            例：联盟体系当月最低有效会员达12人，当月派彩：视讯￥300000，球类￥-120000，机率￥20000，彩票有效投注￥800000。如联盟体系当月相应费用统计为￥14000，则佣金计算方式为：</p>\r\n        <p>\r\n            当月佣金计算：<br>\r\n            (总派彩金额￥200000，退佣百分比为30%)<br>\r\n            (￥800000 彩票投注 x 0.1% 返点百分比) - ￥14000 相应费用= -13200<br>\r\n            (-13200+￥200000派彩)*30%=￥56040佣金</p>\r\n        <p>\r\n            *佣金百分比，依未扣除相应费用前之\"各项派彩\"金额为准。<br>\r\n            <span style=\"color: #ff0000;\">*假若本月可获得佣金为负数，派彩及费用将会带到下个月继续累计至可获得佣金为正数并高于￥500即可领取。</span></p>\r\n        <p>\r\n            ? 回馈/佣金支付<br>\r\n            联盟佣金计算，结算区间为本月第一个礼拜一至下月第一个礼拜一前的周日，将会员盈利，以联盟方案分红公式计算，佣金由承办客服于每个月的<span style=\"color: #ff0000;\">第一个礼拜三开始</span>与代理确认金额后，在<span\r\n                style=\"color: #ff0000;\">5个工作天内</span>将佣金直接汇入代理联盟登记之银行账号。</p>\r\n    </div>\r\n    <div id=\"Union2\" style=\"display: none;\">\r\n        <p>\r\n             </p>\r\n        <p>\r\n            <strong>一、新世界国际娱乐城对代理联盟的权利与义务</strong></p>\r\n        <ol>\r\n            <li align=\"left\">新世界国际娱乐城的客服部会登记联盟的会员并会观察他们的投注状况。联盟及会员必须同意并遵守新世界国际娱乐城的会员条例，政策及操作程序。新世界国际娱乐城保留拒绝或冻结联盟/会员账户权利</li>\r\n            <li align=\"left\">代理联盟可随时登入接口观察旗下会员的下注状况及会员在网站的活动概况。 新世界国际娱乐城的客服部会根据代理联盟旗下的会员计算所得的佣金。</li>\r\n            <li align=\"left\">新世界国际娱乐城保留可以修改合约书上的任何条例，包括: 现有的佣金范围、佣金计划、付款程序、及参考计划条例的权力，新世界国际娱乐城会以电邮、网站公告等方法通知代理联盟。\r\n                代理联盟对于所做的修改有异议，代理联盟可选择终止合约，或洽客服人员反映意见。 如修改后代理联盟无任何异议，便视作默认合约修改，代理联盟必须遵守更改后的相关规定。</li>\r\n        </ol>\r\n        <p align=\"left\">\r\n            <strong>二、代理联盟对新世界国际娱乐城的权力及义务</strong></p>\r\n        <ol>\r\n            <li align=\"left\">代理联盟应尽其所能，广泛地宣传、销售及推广新世界国际娱乐城，使代理本身及新世界国际娱乐城的利润最大化。代理联盟可在不违反法律下，以正面形象宣传、销售及推广新世界国际娱乐城，并有责任义务告知旗下会员所有新世界国际娱乐城的相关优惠条件及产品。</li>\r\n            <li align=\"left\">代理联盟选择的新世界国际娱乐城推广手法若需付费，则代理应承担该费用。</li>\r\n            <li align=\"left\">任何新世界国际娱乐城相关信息包括: 标志、报表、游戏画面、图样、文案等，代理联盟不得私自复制、公开、分发有关材料，新世界国际娱乐城保留法律追诉权。\r\n                如代理在做业务推广有相关需要，请随时洽新世界国际娱乐城。</li>\r\n        </ol>\r\n        <p align=\"left\">\r\n            <strong>三、规则条款</strong></p>\r\n        <ol>\r\n            <li align=\"left\">各阶层代理联盟不可在未经新世界国际娱乐城许可情况下开设双/多个的代理账号，也不可从新世界国际娱乐城账户或相关人士赚取佣金。请谨记任何阶层代理不能用代理帐户下注，新世界国际娱乐城有权终止并封存账号及所有在游戏中赚取的佣金。</li>\r\n            <li align=\"left\">为确保所有新世界国际娱乐城会员账号隐私与权益，新世界国际娱乐城不会提供任何会员密码，或会员个人资料。各阶层代理联盟亦不得以任何方式取得会员数据，或任意登入下层会员账号，如发现代理联盟有侵害新世界国际娱乐城会员隐私行为，新世界国际娱乐城有权取消代理联盟红利，并取消代理联盟账号。</li>\r\n            <li align=\"left\">代理联盟旗下的会员不得开设多于一个的账户。新世界国际娱乐城有权要求会员提供有效的身份证明以验证会员的身份，并保留以IP判定是否重复会员的权利。如违反上述事项，新世界国际娱乐城有权终止玩家进行游戏并封存账号及所有于游戏中赚取的佣金</li>\r\n            <li align=\"left\">代理联盟不可为自己或其他联盟下的有效投注会员,只能是公司直属下的有效投注会员, 代理每月需有5个下线有效投注（有效投注为每周至少上线3次进行正常投注），如有违反联盟协议新世界国际娱乐城有权终止并封存账号及所有在游戏中赚取的佣金。</li>\r\n            <li align=\"left\">如代理联盟旗下的会员因为违反条例而被禁止享用新世界国际娱乐城的游戏，或新世界国际娱乐城退回存款给会员，新世界国际娱乐城将不会分配相应的佣金给代理联盟。如代理联盟旗下会员存款用的信用卡、银行资料须经审核，新世界国际娱乐城保留相关佣金直至审核完成。</li>\r\n            <li align=\"left\">合约内的条件会以新世界国际娱乐城通知接受代理联盟加入后开始执行。新世界国际娱乐城及代理联盟可随时终止此合约，在任何情况下，代理联盟如果想终止合约，都必须以书面/电邮方式提早于七日内通知新世界国际娱乐城。\r\n                代理联盟的表现会3个月审核一次，如代理联盟已不是现有的合作成员则本合约书可以在任何时间终止。如合作伙伴违反合约条例，新世界国际娱乐城有权立即终止合约。</li>\r\n            <li align=\"left\">在没有新世界国际娱乐城许可下，代理联盟不能透露及授权新世界国际娱乐城相关密数据，包括代理联盟所获得的回馈、佣金报表、计算等;代理联盟有义务在合约终止后仍执行机密文件及数据的保密。</li>\r\n            <li align=\"left\">在合约终止后，代理联盟及新世界国际娱乐城将不须要履行双方的权利及义务。终止合约并不会解除代理联盟于终止合约前应履行的义务。</li>\r\n        </ol>\r\n    </div>\r\n</div>');
INSERT INTO `webinfo` VALUES ('15', 'temp15', 'temp15', 'temp15');
INSERT INTO `webinfo` VALUES ('16', 'temp16', 'temp16', 'temp16');
INSERT INTO `webinfo` VALUES ('13', 'temp13', 'temp13', 'temp13');
INSERT INTO `webinfo` VALUES ('17', 'temp17', 'temp17', 'temp17');
INSERT INTO `webinfo` VALUES ('10', 'fzrbc', '负责任博彩', '<div><p>\r\n	<strong>负责任博彩</strong></p>\r\n<p align=\"left\">\r\n	<strong>一</strong><strong>. </strong><strong>未满博彩年龄</strong></p>\r\n<p align=\"left\">\r\n	　　新世界国际娱乐城积极推行负责任博彩，并极力拒绝未成年玩家使用我们的软件进行网上娱乐。同时，我们更透过专业人员及各种有效方法，以防止问题博彩的发生。 一旦发现使用该本网站的客户未满18岁，我们将会没收所有赢取的彩金并保留立即终止客户的投注户口操作的权利。</p>\r\n<p align=\"left\">\r\n	　　如您的计算机被未满18岁的人士使用， 我们建议您设定计算机数据保密以防止帐户号码/用户名称被盗用。父母或者监护人可以使用一系列的第三方软件来监控或者限制计算机的互联网使用：<br>\r\n	1. Net Nanny过滤软件防止儿童浏览不适宜的网站内容: www.netnanny.com<br>\r\n	2. CYBERsitter过滤软件允许父母增加自定义过滤网站: www.cybersitter.com</p>\r\n<p align=\"left\">\r\n	<br>\r\n	<strong>二</strong><strong>. </strong><strong>博彩责任</strong></p>\r\n<p align=\"left\">\r\n	　　本公司希望客户高兴与满意本公司提供的网上博彩服务。我们会为客户在博彩自律方面提供多方面的帮助。如您担心博彩会严重影响您或他人的生活，我们建议：</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	a) 在登录我们的系统时，不要让未成年人士在荧光幕显示范围内观看或停留。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	b) 如果用户需要离开系统的操作范围，请谨记使用密码锁住计算机。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	c) 各用户务必将新世界国际娱乐城帐户及密码放置在安全地方。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	d) 请于计算机使用年龄保护软件，以限制未成年用户到访特定网站及使用相关程序。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	e) 切勿与未成年人士分享信用卡或帐户等相关信息 。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	f) 当用户从他人计算机登入新世界国际娱乐城软件时，或从远程位置(无线网吧、机场、酒店或其他公共场所)进行登录及娱乐活动时，请留意是否已隔离任何未成年人士。</p>\r\n<p align=\"left\">\r\n	<strong>三</strong><strong>. </strong><strong>严重博彩引发的问题</strong></p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	1.     您会否因为博彩而不上班或不上学？</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	2.     您博彩是否为了逃避烦闷或不愉快的生活？</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	3.     当您博彩花光钱时，您是否感到失望甚至绝望，并且希望马上能再进行赌博？</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	4.     您会否博彩到最后一分钱彩罢休？</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	5.     您有否曾经用谎言掩饰您花在博彩上的时间和金钱？</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	6.     您博彩是不是因为争执，沮丧或失望？</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	7.     您有没有因为博彩而感到失落甚至轻生？</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	8.     您是否对您的家人，朋友或爱好失去了兴趣？</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	9.     您输了之后，是否马上想把输的钱赢回来？</p>\r\n<p align=\"left\" style=\"margin-left:18pt;\">\r\n	在这些问题中您回答的‘是’越多，您就越接近具备严重博彩问题。</p>\r\n<p align=\"left\">\r\n	<strong>四</strong><strong>. </strong><strong>以下提示也许能帮助您控制博彩问题：</strong></p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	10.   博彩只是一种娱乐，不应被视为赚钱的方法</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	11.   避免有把输的钱赢回来的想法</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	12.   只投注您付得起的金额</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	13.   时刻记着花在博彩上的时间和金钱</p>\r\n<p align=\"left\">\r\n	<strong>五</strong><strong>. </strong><strong>责任感和正直诚信</strong></p>\r\n<p align=\"left\">\r\n	　　新世界国际娱乐城，致力提高服务水平，并承诺向客户履行最大程度上的责任，包括诚信、透明度、合法性等各方面。如客户遇上任何有关负责任博彩的问题，可24小时向我们的客户服务部联络。我们承诺会于一年365日，不间断地为用户提供技术支持及相关问题解答服务。</p>\r\n<p align=\"left\">\r\n	条款与规则</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	14.   每个客户只能拥有一个账号，如发现客户拥有多个账号，本公司有权冻结客户的账号以及取消该账号内所有胜出的投注。本公司有权保留取消任何因素导致账号结余不正确的金额。此外如发现账号持有人与亲属共同使用多个不同账号，本公司有权限制客户每人各保留最多一个账号。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	15.   用户有义务保障本身的用户名称和密码的隐私安全，并且不应允许任何第三方以任何形式，通过该用户名称和密码使用本网站之所有游戏，否则，一切责任需由该使用者全部承担。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	16.   用户在进行游戏前应核实其所在地区进行在线游戏是否符合当地法律。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	17.   新世界国际娱乐城站时间均为美东时间。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	18.   本网站只向符合法定年龄的使用者提供服务，客户在进行投注时必须年满18岁。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	19.   本网站有权拒绝或不接受任何使用者以任何不正当方式登入或参与本网站所有游戏之权利。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	20.   因人为或系统发生不能预测因素所导致的失误，本公司管理层保留最终决定权。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	21.   因发生不可抗拒的灾害或人为入侵破坏行为，所造成的网站故障或数据损坏等情况，以本网站最终数据为最后的处理数据，所以各会员应尽量保留或打印数据，本网站才接受跟进投诉。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	22.   为避免任何争议，各用户在参与本网站所有游戏过程中或在结束游戏前，务必检查该会员帐户的资料，如发现任何异常情况，应立即与代理商联系查证，否则该用户将被视为同意并且接受。其帐户之一切数据或历史数据，以本公司数据库中的数据为准，用户不得异议。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	23.   并且无须事本公司保留所有规则的修改权，先公布。</p>\r\n<p align=\"left\" style=\"margin-left:30pt;\">\r\n	24.   不论在任何情况下，本公司都有最终决定权。</p>\r\n</div>');
INSERT INTO `webinfo` VALUES ('12', 'temp12', 'temp12', 'temp12');
INSERT INTO `webinfo` VALUES ('4', 'gywm', '关于我们', '<p>\r\n    新世界国际娱乐城与AG,BBIN,MG进行技术合作，共同打造高质量游戏平台，目前拥有菲律宾合法注册之博彩公司。我们一切博彩营业行为皆遵从菲律宾博彩条约。我们在越来越热络的网络博彩市场中，不断地求新求变，寻找最新的创意，秉持最好的服务。以带给客户高质量的服务、产品、娱乐，是我们的企业永恒宗旨。</p>\r\n<p>\r\n    <br>\r\n    我们的体育博彩拥有顶级的盘房操盘，投入大量的人力以及资源，提高完整赛事，丰富玩法给热爱体育的玩家。真人视讯游戏拥有经国际赌场专业训练的荷官，进行各种赌场游戏，所有赌局都依荷官动作，而不是默认的计算机机率结果，以高科技的网络直播技术，带给玩家身历赌场的刺激经验!\r\n    各式彩票游戏，是依官方赛果产生游戏结果，让玩家在活泼的投注界面，享受最公正的娱乐。而我们的电子游戏使用最公平的随机数生成机率，让玩家安心享受多元的娱乐性游戏。新世界国际娱乐城所有的游戏皆有共同的优点：无须下载、接口操作简易、功能齐全、画面精致、游戏秉持公平、公正、公开!<br>\r\n    <br>\r\n    在市场上众多的博彩网站中，玩家选择新世界国际娱乐城，除了多元化的产品，也是因为新世界国际娱乐城拥有良好的信誉，以及高质量的服务，我们的用心随处可见，绝无任何恶意软件，并获得GEOTRUST国际认证，确保网站公平公正性，所有会员数据均经过加密，保障玩家隐私。新世界国际娱乐城以服务会员不打烊的精神，24小时处理会员出入款相关事宜，令我们骄傲的客服团队，亲切又专业，解决玩家对于网站、游戏的种种疑难杂症，让每位玩家有宾至如归的感觉!\r\n    我们自豪的以业界最强的各种优惠方式回馈我们的会员，新世界国际娱乐城绝对是玩家最明智的选择!</p>');
INSERT INTO `webinfo` VALUES ('20', 'temp20', 'temp20', 'temp20');
INSERT INTO `webinfo` VALUES ('18', 'temp18', 'temp18', 'temp18');
INSERT INTO `webinfo` VALUES ('5', 'lxwm', '联系我们', '<div>\r\n    <p align=\"left\">\r\n        新世界国际娱乐城客服中心全年无休，提供1周7天、每天24小时的优质服务。</p>\r\n    <p align=\"left\">\r\n        如果您对本网站的使用有任何疑问，可以透过下列任一方式与客服人员联系，享受最实时的服务</p>\r\n    <p align=\"left\">\r\n        点击\"在线客服\"连结，即可进入在线客服系统与客服人员联系。</p>\r\n    <p align=\"left\">\r\n        您亦可使用Email与在线客服或QQ客服： 取得联系</p>\r\n    <p align=\"left\">\r\n        邮箱：</p>\r\n	<p align=\"left\">\r\n		客服热线电话：</p>\r\n\r\n    <p>\r\n        只要填妥下列窗体并点击送出数据，我们也能收到您宝贵的意见(务必填写真实的Email.QQ.联络电话，以便我们能及时与您取得联系！</p>\r\n</div>');
INSERT INTO `webinfo` VALUES ('11', 'temp5', 'temp5', 'temp5');
INSERT INTO `webinfo` VALUES ('3', 'temp3', 'temp3', 'temp3');
INSERT INTO `webinfo` VALUES ('7', 'ckbz', '存款帮助', '<div>\r\n    <p>\r\n         </p>\r\n    <p>\r\n        一、公司入款:（赠送存款金额1.2%手续费）强烈推荐使用</p>\r\n    <p>\r\n        <br>\r\n        1. 会员登入后点击 [在线存款]，选择 [公司入款]<br>\r\n        2. 请选择欲使用的银行卡。<br>\r\n        3. 选择银行后，网页会显示可存入的银行账号。可直接点击网页上银行标志，自动为您带到银行首页，<br>\r\n        登入您个入网银后，请将款项转入公司提供的入款账号。<br>\r\n        ※如您使用农业银行/工商银行， 请将公司入款订单号贴入您网银 [备注/附言] 字段<br>\r\n        ※建议选择与您转账的银行同一家，同银行间转账可以立即到帐，若跨行转账有可能较晚到帐。※<br>\r\n        <br>\r\n        可以自由选择:<br>\r\n        (1).网络银行: 登入自己的网络银行页面，从银行网页上转账到指定银行账户 中。<br>\r\n        (2).ATM自动柜员机 : 到实体自动柜员机以银行卡或是现金方式存入，没有开启网银功能与存现金的会员可用<br>\r\n        (3).银行柜台转账 : 到银行柜台完成转账手续<br>\r\n        <br>\r\n        ※公司入款注意事项※<br>\r\n        亲切提醒您，公司入款银行随时更变，请于每次入款前，确认您可以使用的入款账号。<br>\r\n        如入款账号已过期，新世界国际娱乐城恕不负责！万请见谅，感谢配合。<br>\r\n        <br>\r\n        4. 核对提交数据/提交申请<br>\r\n        汇款完成请填写并提交相关数据，并备份您的公司入款订单号。 系统在收到款项后会进行比对，如果存款金<br>\r\n        额、时间相符合，则会将款项加入您的游戏账号中。处理时间通常为5-30分钟。(跨行转账时间可能会超过30分)<br>\r\n        <br>\r\n        5. 若5钟内未到帐，请联系在线客服人员。<br>\r\n        客服人员会与您核对存款数据，必要时需要您提供截图、转账数据等相关证明。<br>\r\n        <br>\r\n        二、在线存款 :</p>\r\n    <p>\r\n        1. 会员登入后点击 [在线存款]，选择 [在线付款]<br>\r\n        2. 选择入款额度，并请确实填写 ”联络电话” ，如有任何问题，方便新世界国际娱乐城客服第一时间与您联系。<br>\r\n        3. 选择”支付银行”。<br>\r\n        支援借记卡：中国农业银行,中国工商银行,中国建设银行,招商银行,交通银行,上海浦东发展银行,中国光大银行,深圳平安银行。<br>\r\n        4. 确认送出后，将请您确认您的支付订单无误，并建议您记录您的支付订单号后，确认送出，并耐心等待加载网络银行页面，传输中已将您账户数据加密，请耐心等待。<br>\r\n        5. 进入网络银行页面，请确实填写您银行账号信息，支付成功，额度将在10分钟内系统处理完成，立即加入您的新世界国际娱乐城会员账户。<br>\r\n        <br>\r\n        存款需知:<br>\r\n        新世界国际娱乐城最低存款为$100人民币，最高存款无上限!<br>\r\n        未开通网银的会员，请亲洽您的银行柜台办理。<br>\r\n        如有任何问题，请洽24小时在线客服。</p>\r\n</div>');
INSERT INTO `webinfo` VALUES ('19', 'temp19', 'temp19', 'temp19');

-- ----------------------------
-- Table structure for `web_close`
-- ----------------------------
DROP TABLE IF EXISTS `web_close`;
CREATE TABLE `web_close` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `sign` varchar(8) DEFAULT NULL COMMENT '彩票标识',
  `close` tinyint(4) DEFAULT '1' COMMENT '是否关闭(0:开启,1:关闭)',
  `name` varchar(10) DEFAULT NULL COMMENT '彩票中文名',
  `end_close_time` datetime DEFAULT NULL COMMENT '开启时间',
  `des` text,
  `is_jiaodui` tinyint(2) unsigned DEFAULT '0' COMMENT '是否是期数校对数据',
  `qishu` int(10) DEFAULT NULL COMMENT '开奖期号',
  `kaijiang_time` datetime DEFAULT NULL COMMENT '开奖时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_close
-- ----------------------------
INSERT INTO `web_close` VALUES ('14', 'gd11', '0', '广东11选5', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('8', 'gxsf', '0', '广西十分彩', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('2', 'jx', '1', '江西时时彩', null, '关闭江西时时彩', '0', null, null);
INSERT INTO `web_close` VALUES ('9', 'pk10', '0', '北京PK拾', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('6', 'gdsf', '0', '广东快乐十分', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('16', 'fc_jiaod', '1', '福彩3D期数校对', null, null, '1', null, null);
INSERT INTO `web_close` VALUES ('13', 'kl8', '0', '北京快乐8', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('17', 'pl_jiaod', '1', '排列三期数校对', null, null, '1', null, null);
INSERT INTO `web_close` VALUES ('10', 'd3', '0', '福彩3D', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('12', 't3', '0', '上海时时乐', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('4', 'tj', '0', '极速时时彩', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('20', 'bjpk_jia', '1', '北京pk10期数校对', null, null, '1', null, null);
INSERT INTO `web_close` VALUES ('18', 'gxsf_jia', '1', '广西十分彩期数校对', null, null, '1', null, null);
INSERT INTO `web_close` VALUES ('5', 'cqsf', '0', '重庆快乐十分', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('11', 'p3', '0', '排列3', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('3', 'cq', '0', '重庆时时彩', null, null, '0', null, null);
INSERT INTO `web_close` VALUES ('7', 'tjsf', '0', '天津快乐十分', null, '', '0', null, null);
INSERT INTO `web_close` VALUES ('19', 'bjpn_jia', '1', '北京快乐8期数校对', null, null, '1', null, null);

-- ----------------------------
-- Event structure for `trace_log_event`
-- ----------------------------
DROP EVENT IF EXISTS `trace_log_event`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` EVENT `trace_log_event` ON SCHEDULE EVERY 1 DAY STARTS '2016-11-01 09:19:15' ON COMPLETION NOT PRESERVE ENABLE COMMENT '保留一周trace_log数据' DO delete from trace_log where datediff(CURDATE(), `log_time`) > 7
;;
DELIMITER ;
