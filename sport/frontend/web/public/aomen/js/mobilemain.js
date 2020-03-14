/// <reference path="../lottery/marksix/member/order.html" />
/// <reference path="../lottery/marksix/member/order.html" />
/// <reference path="jquery.countdown.min.js" />
/// <reference path="artDialog.js" />
/// <reference path="../lottery/marksix/banbo/banbo.html" />
//快捷
var ball_No = ["NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_8","NO_9","NO_10","NO_11","NO_12","NO_13","NO_14","NO_15","NO_16","NO_17","NO_18","NO_19","NO_20","NO_21","NO_22","NO_23","NO_24","NO_25","NO_26","NO_27","NO_28","NO_29","NO_30","NO_31","NO_32","NO_33","NO_34","NO_35","NO_36","NO_37","NO_38","NO_39","NO_40","NO_41","NO_42","NO_43","NO_44","NO_45","NO_46","NO_47","NO_48","NO_49"];
var ball_NO_CN  = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49"];


//正码
var zm_NO = ["NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_8","NO_9","NO_10","NO_11","NO_12","NO_13","NO_14","NO_15","NO_16","NO_17","NO_18","NO_19","NO_20","NO_21","NO_22","NO_23","NO_24","NO_25","NO_26","NO_27","NO_28","NO_29","NO_30","NO_31","NO_32","NO_33","NO_34","NO_35","NO_36","NO_37","NO_38","NO_39","NO_40","NO_41","NO_42","NO_43","NO_44","NO_45","NO_46","NO_47","NO_48","NO_49","ODD","EVEN","BIG","SMALL"];
var zm_NO_CN  = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","总单","总双","总大","总小"];
//生肖
var shaw_Order = ["SHU","NIU","HU","TU","LONG","SHE","MA","YANG","HOU","JI","GOU","ZHU"];
var shaw_CN = ["鼠","牛","虎","兔","龙","蛇","马","羊","猴","鸡","狗","猪"];
//尾数
var tail_Number = ["NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_8","NO_9"];
var tail_Number_CN = ["0尾","1尾","2尾","3尾","4尾","5尾","6尾","7尾","8尾","9尾"];
var tail_Number_NU = ["5","6","7","8","9","10","11","12","13","14"];
var tail_Number_INT = {NO_0:[10,20,30,40],NO_1:[01,11,21,31,41],NO_2:[02,12,22,32,42],NO_3:[03,13,23,33,43],NO_4:[04,14,24,34,44],NO_5:[05,15,25,35,45],NO_6:[06,16,26,36,46],NO_7:[07,17,27,37,47],NO_8:[08,18,28,38,48],NO_9:[09,19,29,39,49]};
//特码
var tema_NO = ["NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_8","NO_9","NO_10","NO_11","NO_12","NO_13","NO_14","NO_15","NO_16","NO_17","NO_18","NO_19","NO_20","NO_21","NO_22","NO_23","NO_24","NO_25","NO_26","NO_27","NO_28","NO_29","NO_30","NO_31","NO_32","NO_33","NO_34","NO_35","NO_36","NO_37","NO_38","NO_39","NO_40","NO_41","NO_42","NO_43","NO_44","NO_45","NO_46","NO_47","NO_48","NO_49","ODD","EVEN","BIG","SMALL","SUM_ODD","SUM_EVEN","TAIL_BIG","TAIL_SMALL","RED","GREEN","BLUE"];
var tema_NO_CN = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","单","双","大","小","合单","合双","尾大","尾小","红波","蓝波","绿波"];
//特码头尾
var tmtw_NO = ["NO_0","NO_1","NO_2","NO_3","NO_4","NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_8","NO_9"];
var tmtw_NO_CN = ["头0","头1","头2","头3","头4","0尾","1尾","2尾","3尾","4尾","5尾","6尾","7尾","8尾","9尾"];
var tmtou_NO = ["NO_0","NO_1","NO_2","NO_3","NO_4"];
var tmwei_NO = ["NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_8","NO_9"];
//五行半波
var wh_NO = ["JIN","MU","SHUI","HUO","TU"];
var wh_NO_CN = ["金","木","水","火","土"];
var bb_NO = ["RED_ODD","RED_EVEN","RED_BIG","RED_SMALL","BLUE_ODD","BLUE_EVEN","BLUE_BIG","BLUE_SMALL","GREEN_ODD","GREEN_EVEN","GREEN_BIG","GREEN_SMALL"];
var bb_NO_CN= ["红单","红双","红大","红小","蓝单","蓝双","蓝大","蓝小","绿单","绿双","绿大","绿小"];
//过关
var gg_NO = ["Z_ODD_1","Z_ODD_2","Z_ODD_3","Z_ODD_4","Z_ODD_5","Z_ODD_6","Z_EVEN_1","Z_EVEN_2","Z_EVEN_3","Z_EVEN_4","Z_EVEN_5","Z_EVEN_6","Z_BIG_1","Z_BIG_2","Z_BIG_3","Z_BIG_4","Z_BIG_5","Z_BIG_6","Z_SMALL_1","Z_SMALL_2","Z_SMALL_3","Z_SMALL_4","Z_SMALL_5","Z_SMALL_6","Z_RED_1","Z_RED_2","Z_RED_3","Z_RED_4","Z_RED_5","Z_RED_6","Z_BLUE_1","Z_BLUE_2","Z_BLUE_3","Z_BLUE_4","Z_BLUE_5","Z_BLUE_6","Z_GREEN_1","Z_GREEN_2","Z_GREEN_3","Z_GREEN_4","Z_GREEN_5","Z_GREEN_6"];
var gg_NO_CN = ["正码一单","正码二单","正码三单","正码四单","正码五单","正码六单","正码一双","正码二双","正码三双","正码四双","正码五双","正码六双","正码一大","正码二大","正码三大","正码四大","正码五大","正码六大","正码一小","正码二小","正码三小","正码四小","正码五小","正码六小","正码一红波","正码二红波","正码三红波","正码四红波","正码五红波","正码六红波","正码一蓝波","正码二蓝波","正码三蓝波","正码四蓝波","正码五蓝波","正码六蓝波","正码一绿波","正码二绿波","正码三绿波","正码四绿波","正码五绿波","正码六绿波"];
//七码
var qm_NO = ["NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7","NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7"];
var qm_NO_CN = ["单0","单1","单2","单3","单4","单5","单6","单7","双0","双1","双2","双3","双4","双5","双6","双7","大0","大1","大2","大3","大4","大5","大6","大7","小0","小1","小2","小3","小4","小5","小6","小7"];
var qm_NO_EN = ["NO_0","NO_1","NO_2","NO_3","NO_4","NO_5","NO_6","NO_7"];
//半波号
var redWave = ['1','2','7','8','12','13','18','19','23','24','29','30','34','35','40','45','46'];
var blueWave = ['3','4','9','10','14','15','20','25','26','31','36','37','41','42','47','48'];
var greenWave = ['5','6','11','16','17','21','22','27','28','32','33','38','39','43','44','49'];

var poultry = ["MA","YANG","NIU","JI","GOU","ZHU"];
var wild_beast = ["SHU","HU","TU","LONG","SHE","HOU"];
var ground_lx = ["LONG","MA","HOU","NIU","TU","ZHU"];
var day_lx = ["SHU","HU","GOU","SHE","YANG","JI"];
var one_tailed = ["NO_1","NO_3","NO_5","NO_7","NO_9"];
var two_tailed = ["NO_0","NO_2","NO_4","NO_6","NO_8"];
var big_tail = ["NO_5","NO_6","NO_7","NO_8","NO_9"];
var small_tail = ["NO_0","NO_1","NO_2","NO_3","NO_4"];
//to
var zerofirst = [ '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
var onefirst = [ '10', '11', '12', '13', '14', '15', '16', '17', '18', '19' ];
var twofirst = [ '20', '21', '22', '23', '24', '25', '26', '27', '28', '29' ];
var threefirst = [ '30', '31', '32',  '33', '34', '35', '36', '37', '38', '39' ];
var fourfirst = [ '40', '41', '42', '43', '44', '45', '46', '47', '48', '49' ];
//wei
var zeroTail = ['10', '20', '30', '40'];
var oneTail = ['1', '11', '21', '31', '41'];
var twoTail = ['2', '12', '22', '32', '42'];
var threeTail = ['3', '13', '23', '33', '43'];
var fourTail = ['4', '14', '24', '34', '44'];
var fiveTail = ['5', '15', '25', '35', '45'];
var sixTail = ['6', '16', '26', '36', '46'];
var sevenTail = ['7', '17', '27', '37', '47'];
var eightTail = ['8', '18', '28', '38', '48'];
var nineTail = ['9', '19', '29', '39', '49'];
//input选择
var great = ['25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48'];
var single = ['1','3','5','7','9','11','13','15','17','19','21','23','25','27','29','31','33','35','37','39','41','43','45','47'];
var closeSingle = ['1','3','5','7','9','10','12','14','16','18','21','23','25','27','29','30','32','34','36','38','41','43','45','47'];
var small  = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
var double = ['2','4','6','8','10','12','14','16','18','20','22','24','26','28','30','32','34','36','38','40','42','44','46','48'];
var closeDouble = ['2','4','6','8','11','13','15','17','19','20','22','24','26','28','31','33','35','37','39','40','42','44','46','48'];

var lastSmall = ["01","02","03","04","10","11","12","13","14","20","21","22","23","24","30","31","32","33","34","40","41","42","43","44"];
var lastBig  = ["05","06","07","08","09","15","16","17","18","19","25","26","27","28","29","35","36","37","38","39","45","46","47","48","49"];


//游戏玩法
var betOn_NO_CN = {TEMA_A:'特码A',TEMA_B:'特码B',ZHENGMA_A:'正码A',ZHENGMA_B:'正码B',ZHENGTE_1:'正1特',ZHENGTE_2:'正2特',ZHENGTE_3:'正3特',ZHENGTE_4:'正4特',ZHENGTE_5:'正5特',ZHENGTE_6:'正6特',
		           SERIAL_2_2:'二全中',SERIAL_2_TE_TE:'二中特',SERIAL_2_TE:'二中特',SERIAL_TE:'特串',SERIAL_3_3:'三全中',SERIAL_3_2_3:'三中二',SERIAL_3_2:'三中二',GUOGUAN:'过关',SHENXIAO_TE:'特肖',TEMA_TOU:'特码头',TEMA_WEI:'特码尾',TEMA_TOUWEI:'特码头尾',
		           WUXING:'五行',BANBO:'半波',QIMA_ODD:'七码单',QIMA_EVEN:'七码双',QIMA_BIG:'七码大',QIMA_SMALL:'七码小',QIMA:'七码',SHENXIAO6_2:'二肖',SHENXIAO6_3:'三肖',SHENXIAO6_4:'四肖',SHENXIAO6_5:'五肖',SHENXIAO6_6:'六肖',
		           SHENXIAO_1_Y:'一肖中',SHENXIAO_1_N:'一肖不中',WEISHU_Y:'尾数中',WEISHU_N:'尾数不中',SHENXIAOLIAN_Y_2:'二肖连中',SHENXIAOLIAN_Y_3:'三肖连中',SHENXIAOLIAN_Y_4:'四肖连中',SHENXIAOLIAN_Y_5:'五肖连中',
		           SHENXIAOLIAN_N_2:'二肖连不中',SHENXIAOLIAN_N_3:'三肖连不中',SHENXIAOLIAN_N_4:'四肖连不中',SHENXIAOLIAN_N_5:'五肖连不中',WEISHULIAN_Y_2:'二尾连中',WEISHULIAN_Y_3:'三尾连中',WEISHULIAN_Y_4:'四尾连中',
		           WEISHULIAN_N_2:'二尾连不中',WEISHULIAN_N_3:'三尾连不中',WEISHULIAN_N_4:'四尾连不中',BUZHONG_5:'五不中',BUZHONG_6:'六不中',BUZHONG_7:'七不中',BUZHONG_8:'八不中',BUZHONG_9:'九不中',BUZHONG_10:'十不中',
		           ZHONG1_5:'五中一',ZHONG1_6:'六中一',ZHONG1_7:'七中一',ZHONG1_8:'八中一',ZHONG1_9:'九中一',ZHONG1_10:'十中一',TEPING_1:'一粒任中',TEPING_2:'二粒任中',TEPING_3:'三粒任中',TEPING_4:'四粒任中',TEPING_5:'五粒任中'};

//游戏类型
var betType_NO_CN = {NO_1:'1',NO_2:'2',NO_3:'3',NO_4:'4',NO_5:'5',NO_6:'6',NO_7:'7',NO_8:'8',NO_9:'9',NO_10:'10',NO_11:'11',NO_12:'12',NO_13:'13',NO_14:'14',NO_15:'15',NO_16:'16',NO_17:'17',NO_18:'18',NO_19:'19',NO_20:'20',
				NO_21:'21',NO_22:'22',NO_23:'23',NO_24:'24',NO_25:'25',NO_26:'26',NO_27:'27',NO_28:'28',NO_29:'29',NO_30:'30',NO_31:'31',NO_32:'32',NO_33:'33',NO_34:'34',NO_35:'35',NO_36:'36',NO_37:'37',NO_38:'38',NO_39:'39',
				NO_40:'40',NO_41:'41',NO_42:'42',NO_43:'43',NO_44:'44',NO_45:'45',NO_46:'46',NO_47:'47',NO_48:'48',NO_49:'49',ODD:'单',EVEN:'双',BIG:'大',SMALL:'小',HE:'和',SUM_ODD:'合单',SUM_EVEN:'合双',TAIL_BIG:'尾大',TAIL_SMALL:'尾小',
				RED:'红波',GREEN:'绿波',BLUE:'蓝波',Z_ODD_1:'正码一单',Z_ODD_2:'正码二单',Z_ODD_3:'正码三单',Z_ODD_4:'正码四单',Z_ODD_5:'正码五单',Z_ODD_6:'正码六单',Z_EVEN_1:'正码一双',Z_EVEN_2:'正码二双',Z_EVEN_3:'正码三双',Z_EVEN_4:'正码四双',
				Z_EVEN_5:'正码五双',Z_EVEN_6:'正码六双',Z_BIG_1:'正码一大',Z_BIG_2:'正码二大',Z_BIG_3:'正码三大',Z_BIG_4:'正码四大',Z_BIG_5:'正码五大',Z_BIG_6:'正码六大',Z_SMALL_1:'正码一小',Z_SMALL_2:'正码二小',Z_SMALL_3:'正码三小',Z_SMALL_4:'正码四小',
				Z_SMALL_5:'正码五小',Z_SMALL_6:'正码六小',Z_RED_1:'正码一红波',Z_RED_2:'正码二红波',Z_RED_3:'正码三红波',Z_RED_4:'正码四红波',Z_RED_5:'正码五红波',Z_RED_6:'正码六红波',Z_BLUE_1:'正码一蓝波',Z_BLUE_2:'正码二蓝波',Z_BLUE_3:'正码三蓝波',Z_BLUE_4:'正码四蓝波',
				Z_BLUE_5:'正码五蓝波',Z_BLUE_6:'正码六蓝波',Z_GREEN_1:'正码一绿波',Z_GREEN_2:'正码二绿波',Z_GREEN_3:'正码三绿波',Z_GREEN_4:'正码四绿波',Z_GREEN_5:'正码五绿波',Z_GREEN_6:'正码六绿波',SHU:'鼠',NIU:'牛',HU:'虎',TU:'兔',LONG:'龙',SHE:'蛇',MA:'马',YANG:'羊',HOU:'猴',
				JI:'鸡',GOU:'狗',ZHU:'猪',RED_ODD:'红单',RED_EVEN:'红双',RED_BIG:'红大',RED_SMALL:'红小',BLUE_ODD:'蓝单',BLUE_EVEN:'蓝双',BLUE_BIG:'蓝大',BLUE_SMALL:'蓝小',GREEN_ODD:'绿单',GREEN_EVEN:'绿双',GREEN_BIG:'绿大',GREEN_SMALL:'绿小'};
//正码类型
var betType_ZM_CN = {NO_1:'1',NO_2:'2',NO_3:'3',NO_4:'4',NO_5:'5',NO_6:'6',NO_7:'7',NO_8:'8',NO_9:'9',NO_10:'10',NO_11:'11',NO_12:'12',NO_13:'13',NO_14:'14',NO_15:'15',NO_16:'16',NO_17:'17',NO_18:'18',NO_19:'19',NO_20:'20',
		NO_21:'21',NO_22:'22',NO_23:'23',NO_24:'24',NO_25:'25',NO_26:'26',NO_27:'27',NO_28:'28',NO_29:'29',NO_30:'30',NO_31:'31',NO_32:'32',NO_33:'33',NO_34:'34',NO_35:'35',NO_36:'36',NO_37:'37',NO_38:'38',NO_39:'39',
		NO_40:'40',NO_41:'41',NO_42:'42',NO_43:'43',NO_44:'44',NO_45:'45',NO_46:'46',NO_47:'47',NO_48:'48',NO_49:'49',ODD:'总单',EVEN:'总双',BIG:'大',SMALL:'总小'};
//头尾类型
var betType_TMTOU_CN = {NO_0:'0头',NO_1:'1头',NO_2:'2头',NO_3:'3头',NO_4:'4头'};
var betType_TMWEI_CN = {NO_0:'0尾',NO_1:'1尾',NO_2:'2尾',NO_3:'3尾',NO_4:'4尾',NO_5:'5尾',NO_6:'6尾',NO_7:'7尾',NO_8:'8尾',NO_9:'9尾'};
//五行类型
var betType_WH_CN = {JIN:'金',MU:'木',SHUI:'水',HUO:'火',TU:'土'};
//七码类型
var betType_QM1_CN = {NO_0:'单0',NO_1:'单1',NO_2:'单2',NO_3:'单3',NO_4:'单4',NO_5:'单5',NO_6:'单6',NO_7:'单7'};
var betType_QM2_CN = {NO_0:'双0',NO_1:'双1',NO_2:'双2',NO_3:'双3',NO_4:'双4',NO_5:'双5',NO_6:'双6',NO_7:'双7'};
var betType_QM3_CN = {NO_0:'大0',NO_1:'大1',NO_2:'大2',NO_3:'大3',NO_4:'大4',NO_5:'大5',NO_6:'大6',NO_7:'大7'};
var betType_QM4_CN = {NO_0:'小0',NO_1:'小1',NO_2:'小2',NO_3:'小3',NO_4:'小4',NO_5:'小5',NO_6:'小6',NO_7:'小7'};
//会员资料
var memberType_CN = {BANBO:'半波',BUZHONG:'不中',GUOGUAN:'过关',LIANGMIAN:'两面',QIMA:'七码',SEBO:'色波',SERIAL:'连码',SHENXIAO6:'六肖',SHENXIAOLIAN:'生肖连',SHENXIAO_1:'一肖',SHENXIAO_TE:'特肖',TEMA_A:'特码A',TEMA_B:'特码B',TEMA_TOU_WEI:'特码头尾',TEPING:'特平中',WEISHU:'尾数',WEISHULIAN:'尾数连',WUXING:'五行',
					ZHENGMA_A:'正码A',ZHENGMA_B:'正码B',ZHENGTE:'正特码',ZHONG1:'多选中一'};
var memberType_Val = ['TEMA_A','TEMA_B','ZHENGMA_A','ZHENGMA_B','ZHENGTE','SERIAL','GUOGUAN','SHENXIAO_TE','TEMA_TOU_WEI','WUXING','BANBO','QIMA','SHENXIAO6','SHENXIAO_1','WEISHU','SHENXIAOLIAN','WEISHULIAN','BUZHONG','ZHONG1','TEPING','LIANGMIAN','SEBO'];
//下注明细
var detail_Status = {10:'注单处理中',15:'已结算',20:'未结算',30:'已撤回'}
var GuidepageType = ["tmdivs","zmdivs","zmtdivs","lmdivs","ggdivs","txdivs","tmtwdivs","whbbdivs","whbbdtwoivs","qmdivs", "lxdivs","yxwsdivs","sxldivs","wsldivs","bzdivs","dxzydivs","tpzdivs","jsbbdivs","xzmxdivs","kjjgdivs","xxjsbbdivs","hyzldivs","gzsmdivs","sczddivs"];
//var UserpageType = ["jsbbdivs","xzmxdivs","kjjgdivs","xxjsbbdivs","sczddivs"];

var heartbeatVal = ""//游戏类型
var betlistval = [];//存储注单
var shaw_INT = {};//动态生肖
//var shaw_INT = {GOU:[10,22,34,46],HOU:[12,24,36,48],HU:[6,18,30,42],JI:[11,23,35,47],LONG:[4,16,28,40],MA:[2,14,26,38],NIU:[7,19,31,43],SHE:[3,15,27,39],SHU:[8,20,32,44],TU:[5,17,29,41],YANG:[1,13,25,37,49],ZHU:[9,21,33,45]};
var userDataval = {};//用户信息
var lotteryresultsValue = [];//开奖结果
var detailValues = {};//下注明细
var maxText = "";
var g_countdown;//倒计时
var BalancetDataValue = "";
var kuaijiedivid = "#specialCode";
//结算报表
var BalancesheetValue = [];
var getDetailslssue;//获取结算报表期号
var gameinformationStatus ="";//游戏状态
var gameinformationDate = {};
var gameinformationGameNo = "";//期号
var getDateTimeval;//定时请求
var Enternum = 0;//回车数
var FPTS = "";
$(document).ready(function(){
	$("#Guidepage p").click(function(){
		var guidePageid = $(this).attr("id");
		WhosMain("Gamepage");
		getguidePage(guidePageid);
	});
	$("#Userpage p").click(function(){
		var guidePageid = $(this).attr("id");
		WhosMain("Gamepage");
		getguidePage(guidePageid);
	});
	
	$("select[id = 'ChoosePage']").change(function(){
		var guidePageid = $(this).val();
		getguidePage(guidePageid);
	});
	$("span[id = 'ReturnMain']").click(function(){
		heartbeatVal = "";
		WhosMain("Guidepage");
	});
	$("span[id = 'UserMain']").click(function(){
		WhosMain("Userpage");
	});
	
	$("span[id = 'UserReturnMain']").click(function(){
		WhosMain("Gamepage");
		ReturnPageMain(heartbeatVal);
	});
	
	$("span[id = 'dropOut']").click(function(){
		//location.hash = $("input[id ='mainPath']").val();
		var  url  = $("input[id ='mainPath']").val();
		if(url == "" || url == null || url == undefined){
			mainshortPrompt("确定退出游戏？",null);
		}else{
			top.location  = url;
		}
	});
	//返回结算报表
	$("span[id ='detailsMain']").click(function(){
		getguidePage("jsbbMob");
	});
function WhosMain(PageId){
	var pageList = ["Guidepage","Userpage","Gamepage"];
	for(var i = 0;i<pageList.length;i++){
		document.getElementById(pageList[i]).style.display = 'none';
	}
	document.getElementById(PageId).style.display = 'block';
};
//游戏页面却换
function getguidePage(guidePage){
	$("#totop").click();
	for(var i = 0;i<GuidepageType.length;i++){
		document.getElementById(GuidepageType[i]).style.display = 'none';
	}
	switch(guidePage){
	case "tmMob" :
		kuaijiedivid = "#specialCode";
		document.getElementById('tmdivs').style.display = 'block';
		var ChooseType = $("select[id = 'tmChooseType']").val();
		heartbeatVal = ChooseType;
		getMustdata(ChooseType);
		break;
	case "zmMob" :
		kuaijiedivid = "#areCode";
		document.getElementById('zmdivs').style.display = 'block';
		var ChooseType = $("select[id = 'zmChooseType']").val();
		heartbeatVal = ChooseType;
		getMustdata(ChooseType);
		break;
	case "zmtMob" :
		kuaijiedivid = "#zhengteDatele";
		document.getElementById('zmtdivs').style.display = 'block';
		var ChooseType = $("select[id = 'ztmChooseType']").val();
		heartbeatVal = ChooseType;
		getMustdata(ChooseType);
		break;
	case "lmMob" :
		kuaijiedivid = "";
		document.getElementById('lmdivs').style.display = 'block';
		var ChooseType = $("select[id = 'lmChooseType']").val();
		getMustdata(ChooseType);
		heartbeatVal = ChooseType;
		break;
	case "ggMob" :
		kuaijiedivid = "";
		document.getElementById('ggdivs').style.display = 'block';
		heartbeatVal = "GUOGUAN";
		getMustdata("GUOGUAN");
		break;
	case "txMob" :
		kuaijiedivid = "";
		document.getElementById('txdivs').style.display = 'block';
		heartbeatVal = "SHENXIAO_TE";
		getMustdata("SHENXIAO_TE");
		break;
	case "tmtwMob" :
		kuaijiedivid = "";
		document.getElementById('tmtwdivs').style.display = 'block';
		heartbeatVal = "TEMA_TOUWEI";
		getTEMATOUWEI_dds();
		break;
	case "whMob" :
		kuaijiedivid = "";
		document.getElementById('whbbdivs').style.display = 'block';
		heartbeatVal = "WUXING";
		getWUXINGBANBO_dds("WUXING");
		break;
	case "bbMob" :
		kuaijiedivid = "";
		document.getElementById('whbbdtwoivs').style.display = 'block';
		heartbeatVal = "BANBO";
		getWUXINGBANBO_dds("BANBO");
		break;
	case "qmMob" :
		kuaijiedivid = "";
		document.getElementById('qmdivs').style.display = 'block';
		heartbeatVal = "QIMA";
		getQIMA_dds();
		break;
	case "lxMob" :
		kuaijiedivid = "";
		document.getElementById('lxdivs').style.display = 'block';
		var ChooseType = $("select[id = 'lxChooseType']").val();
		getMustdata(ChooseType);
		heartbeatVal = ChooseType;
		break;
	case "yxwsMob" :
		kuaijiedivid = "";
		document.getElementById('yxwsdivs').style.display = 'block';
		var ChooseType = $("select[id = 'yxwsChooseType']").val();
		getMustdata(ChooseType);
		heartbeatVal = ChooseType;
		break;
	case "sxlMob" :
		kuaijiedivid = "";
		document.getElementById('sxldivs').style.display = 'block';
		var ChooseType = $("select[id = 'sxlChooseType']").val();
		getMustdata(ChooseType);
		heartbeatVal = ChooseType;
		break;
	case "wslMob" :
		kuaijiedivid = "";
		document.getElementById('wsldivs').style.display = 'block';
		var ChooseType = $("select[id = 'wslChooseType']").val();
		getMustdata(ChooseType);
		heartbeatVal = ChooseType;
		break;
	case "bzMob" :
		kuaijiedivid = "";
		document.getElementById('bzdivs').style.display = 'block';
		var ChooseType = $("select[id = 'bzChooseType']").val();
		getMustdata(ChooseType);
		heartbeatVal = ChooseType;
		break;
	case "dxzyMob" :
		kuaijiedivid = "";
		document.getElementById('dxzydivs').style.display = 'block';
		var ChooseType = $("select[id = 'dxzyChooseType']").val();
		getMustdata(ChooseType);
		heartbeatVal = ChooseType;
		break;
	case "tpzMob" :
		kuaijiedivid = "";
		document.getElementById('tpzdivs').style.display = 'block';
		var ChooseType = $("select[id = 'tpzChooseType']").val();
		getMustdata(ChooseType);
		heartbeatVal = ChooseType;
		break;
	case "jsbbMob" :
		//结算报表
		document.getElementById('jsbbdivs').style.display = 'block';
		getBalancesheet();
		break;
	case "xzmxMob" :
		//下注明细
		document.getElementById('xzmxdivs').style.display = 'block';
		getBetDetails(gameinformationGameNo,"","xzmx","");
		break;
	case "kjjgMob" :
		//开奖结果
		document.getElementById('kjjgdivs').style.display = 'block';
		getLotteryresults();
		break;
	case "gzsmMob" :
		//规则说明
		document.getElementById('gzsmdivs').style.display = 'block';
		break;
	case "hyzlMob" :
		//会员资料
		document.getElementById('hyzldivs').style.display = 'block';
		member_Profile();
		break;
	case "sczdMob" :
		//会员资料
		document.getElementById('sczddivs').style.display = 'block';
		break;
	}
	getGameinformation(kuaijiedivid);
	wholeRefresh(heartbeatVal);
}

/**
 * 特码
 */
//点击效果
$("#specialCode li").on("click",function(){
$(this).toggleClass("on");
  }); 

//选中游戏盘口
$("select[id = 'tmChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
	tmRemoveEffect();
});

//点击下注
$("input[id = 'tmlottoBet']").on("click",function(){
	 //var liId = [];
	 //var oddsVal = [];
	 //var secondaryoddsVal = [];
	 //var liIdCN = [];
	 //var playType = $("select[id = 'tmChooseType']").val();
	 //    $("#specialCode li").each(function(){
	 //   	 if($(this).hasClass("on")){
	 //   		 liId.push($(this).attr("id"));
	 //   		 oddsVal.push($("#specialCode p[id = '"+$(this).attr("id")+"']").text());
	 //   		 liIdCN.push(betType_NO_CN[$(this).attr("id")]);
	 //   		 secondaryoddsVal.push(0);
	 //   	 }
	 //    });
	 //    betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
    //    tmRemoveEffect();
    window.location.href = "../member/order.html";


});
//去页面效果
function tmRemoveEffect(){
	$("#specialCode li").removeClass("on");
}
/**
 * 正码
 */

$("#areCode li").on("click",function(){
	$(this).toggleClass("on");
});

//选中游戏盘口
$("select[id = 'zmChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
});
//点击下注
$("input[id = 'zmlottoBet']").on("click",function(){
	 var liId = [];
	 var oddsVal = [];
	 var secondaryoddsVal = [];
	 var liIdCN = [];
	 var playType = $("select[id = 'zmChooseType']").val();
		 $("#areCode li").each(function(){
			 if($(this).hasClass("on")){
				 liId.push($(this).attr("id"));
				 oddsVal.push($("#areCode p[id = '"+$(this).attr("id")+"']").text());
				 liIdCN.push(betType_NO_CN[$(this).attr("id")]);
				 secondaryoddsVal.push(0);
			 }
		 });
		 betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
		 zmRemoveEffect();
});
//去页面效果
function zmRemoveEffect(){
	$("#areCode li").removeClass("on");
}
/**
 * 正特码
 */

$("#zhengteDatele li").on("click",function(){
	$(this).toggleClass("on");
});

//选中游戏盘口
$("select[id = 'ztmChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
	ztmRemoveEffect();
});
//点击下注
$("input[id = 'ztmlottoBet']").on("click",function(){
	 var liId = [];
	 var oddsVal = [];
	 var secondaryoddsVal = [];
	 var liIdCN = [];
	 var playType = $("select[id = 'ztmChooseType']").val();
		 $("#zhengteDatele li").each(function(){
			 if($(this).hasClass("on")){
				 liId.push($(this).attr("id"));
				 oddsVal.push($("#zhengteDatele p[id = '"+$(this).attr("id")+"']").text());
				 liIdCN.push(betType_NO_CN[$(this).attr("id")]);
				 secondaryoddsVal.push(0);
			 }
		 });
		 betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
		 ztmRemoveEffect();
});
//去页面效果
function ztmRemoveEffect(){
	$("#zhengteDatele li").removeClass("on");
}
/**
 * 连码
 */
//复式
$("#duplex_tractorsForm li").on("click",function(){
	var ballfixid = $("#lmPlay li[class='nav-li dc l-bg daohuangli']").attr("id");
	var playType = $("select[id = 'lmChooseType']").val();
	heartbeatVal = playType;
	if(ballfixid == "duplex"){
		xuanzhiNum("duplex_tractorsForm",10,$(this));
	}else if(ballfixid == "tractors"){
		if(playType == "SERIAL_2_2" ||playType == "SERIAL_2_TE" ||playType == "SERIAL_TE"){
			var checkesan = 1;
		}else if(playType == "SERIAL_3_3" ||playType == "SERIAL_3_2_3"||playType == "SERIAL_3_2"){
			var checkesan = 2;
		}
		tractorsNum("duplex_tractorsForm",checkesan,$(this)); //拖头效果
	}

});

//生肖对碰游戏效果 
$("#zodiacForm ul:eq(0) li").each(function(i){
	$(this).click(function(){
	if($($("#zodiacForm ul:eq(1) li")[i]).hasClass("on")){
		$($("#zodiacForm ul:eq(0) li")[i]).removeAttr("on");
		alert("不能选择相同的生肖,请重新选择！");
	}else{

		$("#sxdpul1 li").each(function(){
			if($("#sxdpul1 li").hasClass("on")){
				$("#sxdpul1 li").removeClass("on");
			}
		});
		$(this).attr("class","on");
	}
	});
});

$("#zodiacForm ul:eq(1) li").each(function(i){
	$(this).click(function(){
		
	if($($("#zodiacForm ul:eq(0) li")[i]).hasClass("on")){
			$($("#zodiacForm ul:eq(1) li")[i]).removeAttr("on");
			alert("不能选择相同的生肖,请重新选择！");
	}else{
		$("#sxdpul2 li").each(function(){
			if($("#sxdpul2 li").hasClass("on")){
				$("#sxdpul2 li").removeClass("on");
			}
		});
			$(this).attr("class","on");
		}
	 	});
});

//尾数对碰页面效果
$("#mantissaForm ul:eq(0) li").each(function(i){
	$(this).click(function(){
	if($($("#mantissaForm ul:eq(1) li")[i]).hasClass("on")){
		$($("#mantissaForm ul:eq(0) li")[i]).removeAttr("on");
		alert("不能选择相同的尾数,请重新选择！");
	}else{

		$("#weishu1 li").each(function(){
			if($("#weishu1 li").hasClass("on")){
				$("#weishu1 li").removeClass("on");
			}
		});
		$(this).attr("class","on");
	}
	});
});

$("#mantissaForm ul:eq(1) li").each(function(i){
	$(this).click(function(){
	if($($("#mantissaForm ul:eq(0) li")[i]).hasClass("on")){
			$($("#mantissaForm ul:eq(1) li")[i]).removeAttr("on");
			alert("不能选择相同的尾数,请重新选择！");
	}else{
		$("#weishu2 li").each(function(){
			if($("#weishu2 li").hasClass("on")){
				$("#weishu2 li").removeClass("on");
			}
		});
			$(this).attr("class","on");
		}
	 	});
});

//生尾对碰页面效果
$("#shengwei1 li").on("click",function(){
	$("#shengwei1 li").each(function(){
		if($("#shengwei1 li").hasClass("on")){
			$("#shengwei1 li").removeClass("on");
		}
	});
	$(this).attr("class","on");
});
$("#shengwei2 li").on("click",function(){
	$("#shengwei2 li").each(function(){
		if($("#shengwei2 li").hasClass("on")){
			$("#shengwei2 li").removeClass("on");
		}
	});
	$(this).attr("class","on");
});


//任意对碰页面效果
$("#arbitrarily_A td").on("click",function(){
	$(this).toggleClass("td1");
	var lilength = $("#arbitrarily_A td[class = 'td1']").size();
	if(lilength > 10){
		$(this).removeClass("td1");
		alert("选择不能多于10个！");
	}
});
$("#arbitrarily_B td").on("click",function(){
	$(this).toggleClass("td1");
	var lilength = $("#arbitrarily_B td[class = 'td1']").size();
	if(lilength > 10){
		$(this).removeClass("td1");
		alert("选择不能多于10个！");
	}
});

function xuanzhiNum(divId,Num,thisli){
	$(thisli).toggleClass("on");
	var lilength = $("#"+divId+" li[class = 'on']").size();
	if(lilength > Num){
		$(thisli).removeClass("on");
		alert("选择不能多于"+Num+"个！");
	}
}
function tractorsNum(divId,Num,thisli){
	var lilength = $("#"+divId+" li[class = 'on2']").size();
	if($(thisli).hasClass("on2")){

	}else{
		if(lilength < Num){
			$(thisli).toggleClass("on2");
		}else{
			$(thisli).toggleClass("on");
		}
	}

}
$("#lmPlay li").on("click",function(){
	$("#lmPlay li").removeClass("daohuangli");
	$(this).attr("class","nav-li dc l-bg daohuangli");
	if($("#lmPlay li").hasClass("daohuangli")){
		var ballfixid = $(this).attr("id"); 
	}
	lmRemoveEffect();
	lmyouxi(ballfixid);
});
//连码游戏却换
function lmyouxi(ballfix_id){
	var xuanlianma = ["duplex_tractorsForm","zodiacForm","mantissaForm","health_tailForm","arbitrarilyForm"];
	for(var i = 0 ;i < xuanlianma.length;i++){
			$("div[id = '"+xuanlianma[i]+"']").hide();
	}
			 if(ballfix_id == "duplex"){
				 $("div[id = 'duplex_tractorsForm']").show();
			 }else if(ballfix_id == "tractors"){
				 $("div[id = 'duplex_tractorsForm']").show();
			 }else if(ballfix_id == "zodiac"){
				 $("div[id = 'zodiacForm']").show();
			 }else if(ballfix_id == "mantissa"){
				 $("div[id = 'mantissaForm']").show();
			 }else if(ballfix_id == "health_tail"){
				 $("div[id = 'health_tailForm']").show();
			 }else if(ballfix_id == "arbitrarily"){
				 $("div[id = 'arbitrarilyForm']").show(); 
	  }
			 lmRemoveEffect();
}
//选中游戏盘口
$("select[id = 'lmChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
	lmyouxi("duplex")
	lmRemoveEffect();
	$("#lmPlay li").removeClass("daohuangli");
	$("#lmPlay li[id = 'duplex']").attr("class","nav-li dc l-bg daohuangli");
	if(tmType == "SERIAL_2_2"||tmType == "SERIAL_3_3"||tmType == "SERIAL_TE"){
		$("p[ id = 'fuhao']").hide();
	}else if(tmType == "SERIAL_2_TE"||tmType == "SERIAL_3_2"){
		$("p[ id = 'fuhao']").show();
	}
	 if(tmType == "SERIAL_2_2" ||tmType == "SERIAL_2_TE"||tmType == "SERIAL_TE"){ 
		 $("li[id = 'duplex']").show();
		 $("li[id = 'tractors']").show();
		 $("li[id = 'zodiac']").show();
		 $("li[id = 'mantissa']").show();
		 $("li[id = 'health_tail']").show();
		 $("li[id = 'arbitrarily']").show();
	 }else if(tmType == "SERIAL_3_3" ||tmType == "SERIAL_3_2_3"||tmType == "SERIAL_3_2"){  
		 $("li[id = 'zodiac']").hide();
		 $("li[id = 'mantissa']").hide();
		 $("li[id = 'health_tail']").hide();
		 $("li[id = 'arbitrarily']").hide(); 
	 }
});
//点击下注
$("input[id = 'lmlottoBet']").on("click",function(){
	var playType = $("select[id = 'lmChooseType']").val();
	var betsType = $("#lmPlay li[class = 'nav-li dc l-bg daohuangli']").attr("id");
	var lmdivid = "duplex_tractorsForm";
	var mainOdds = [];
	var tpzballlist = [];
	var tpzballcnlist = [];
	var secondaryOdds = [];
	var toulminputs = [];
	var fscheckeid = [];
	$("#duplex_tractorsForm li").each(function(){
		if($(this).hasClass("on")){
			toulminputs.push($(this).attr("name"));
		}
		if($(this).hasClass("on2")){
			fscheckeid.push($(this).attr("name"));
		}
	})
//连码复式
	var isBall_Shaw_Tail = "Ball"; 
	if(playType == "SERIAL_2_2"||playType == "SERIAL_TE"||playType == "SERIAL_2_TE"){
		var shunum = 2;
		if(betsType == "duplex"){//复式
			var docum = $("#duplex_tractorsForm li");
			Fushi(docum,shunum,isBall_Shaw_Tail,lmdivid,playType);//生成注单 
		}else if(betsType == "tractors"){//拖头
			toulminputs = toulminputs.sort(sortNumber);//从小排序 
			for(var s = 0;s<toulminputs.length;s++){
				if(fscheckeid != toulminputs[s]){
					var toulmno  = [fscheckeid[0],toulminputs[s]];
					toulmno = toulmno.sort(sortNumber);//从小排序 
					mainOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[0]);//赔率
					tpzballlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[1]);//类型
					tpzballcnlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[2]);//中文类型
					if(isNaN(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[3])){
						secondaryOdds.push(0);
					}else{
						secondaryOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[3]);
					}
				} 
			}
			betswhso(tpzballcnlist,mainOdds,playType,secondaryOdds,tpzballlist);
		}else if(betsType == "zodiac"){//生肖对碰
			var sxdpval1 = shaw_INT[$("#sxdpul1 li[class = 'on']").attr("id")];
			var sxdpval2 = shaw_INT[$($("#sxdpul2 li[class = 'on']")).attr("id")];
			sxdpval1 = sxdpval1.sort(sortNumber);//从小排序
			sxdpval2 = sxdpval2.sort(sortNumber);//从小排序  
			Duipen(shunum,isBall_Shaw_Tail,lmdivid,sxdpval1,sxdpval2,playType);
		}else if(betsType == "mantissa"){//尾数对碰
			var sxdpval1 = tail_Number_INT[$("#weishu1 li[class = 'on']").attr("id")];
			var sxdpval2 = tail_Number_INT[$($("#weishu2 li[class = 'on']")).attr("id")];
			sxdpval1 = sxdpval1.sort(sortNumber);//从小排序
			sxdpval2 = sxdpval2.sort(sortNumber);//从小排序  
			Duipen(shunum,isBall_Shaw_Tail,lmdivid,sxdpval1,sxdpval2,playType);
		}else if(betsType == "health_tail"){//生尾对碰
			var sxdpval1 = shaw_INT[$("#shengwei1 li[class = 'on']").attr("id")];
			var sxdpval2 = tail_Number_INT[$($("#shengwei2 li[class = 'on']")).attr("id")];
			sxdpval1 = sxdpval1.sort(sortNumber);//从小排序
			sxdpval2 = sxdpval2.sort(sortNumber);//从小排序  
			Duipen(shunum,isBall_Shaw_Tail,lmdivid,sxdpval1,sxdpval2,playType);
		}else if(betsType == "arbitrarily"){//任意对碰
			var sxdpval1 = [];
			var sxdpval2 = [];
			var sxdpvals = [];
			var sxdpval = [];
			
			var mainOdds = [];
			var mainOdds_arrCN = [];
			var secondaryOdds = [];
			var secondaryOdds_arrCN = [];
			var tpzballlist = [];
			var tpzballcnlist = [];
		    var shunum = 2;
		    var isBall_Shaw_Tail = "Ball";
		    var lmdivid = "duplex_tractorsForm"; 
		    var rydpValue_arr = [];
		    var rydpValue_arrCN = [];
			$("#arbitrarily_A td[class = 'td1']").each(function(){
				sxdpval1.push($(this).attr("name"));
			});
			$("#arbitrarily_B td[class = 'td1']").each(function(){
				sxdpval2.push($(this).attr("name"));
			});
			sxdpval1 = sxdpval1.sort(sortNumber);//从小排序
			sxdpval2 = sxdpval2.sort(sortNumber);//从小排序  
		    	if(sxdpval1.length > 0 && sxdpval2.length > 0){
		    for(var w = 0;w<sxdpval1.length;w++){
		    	for(var t = 0;t<sxdpval2.length;t++){
		    		if(sxdpval1[w] != sxdpval2[t]){
		    		sxdpval = [sxdpval1[w],sxdpval2[t]]; 
		    		sxdpval = sxdpval.sort(sortNumber);//从小排序  
		    		}
		    		if(sxdpval.length != 0){
					mainOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[0]);//赔率
					tpzballlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[1]);//类型
					tpzballcnlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[2]);//中文类型
					if(isNaN(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[3])){
						secondaryOdds.push(0);
					}else{
						secondaryOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[3]);
					}
		    		}
				} 
			}
		    
		    for (var i = 0; i < tpzballcnlist.length; i++) {
		        if (rydpValue_arrCN.toString().indexOf(tpzballcnlist[i]) < 0) {
		        	rydpValue_arrCN.push(tpzballcnlist[i]);
		        	secondaryOdds_arrCN.push(secondaryOdds[i]);//副赔率
		        	mainOdds_arrCN.push(mainOdds[i]);//
		        }
		    }
		    for (var i = 0; i < tpzballlist.length; i++) {
		        if (rydpValue_arr.toString().indexOf(tpzballlist[i]) < 0) {
		        	rydpValue_arr.push(tpzballlist[i]);
		        }
		    }
		    	if(tpzballcnlist.length != 0){
		    		//生成前台注单
		    		betswhso(rydpValue_arrCN,mainOdds_arrCN,playType,secondaryOdds_arrCN,rydpValue_arr);
		    	}else {
		    		shortPrompt("请选择正确的下注方式！",null);
		    	}
		    		
		    	}else {
		    		shortPrompt("请选择下注类型！",null);
		    	}
		}
	}else if(playType == "SERIAL_3_3"||playType == "SERIAL_3_2_3"||playType == "SERIAL_3_2"){
		var shunum = 3;
		if(betsType == "duplex"){
			var docum = $("#duplex_tractorsForm li");
			Fushi(docum,shunum,isBall_Shaw_Tail,lmdivid,playType);//生成注单 
		}else if(betsType == "tractors"){//拖头
			toulminputs = toulminputs.sort(sortNumber);//从小排序 
			for(var s = 0;s<toulminputs.length;s++){
				if(fscheckeid != toulminputs[s]){
					var toulmno  = [fscheckeid[0],fscheckeid[1],toulminputs[s]];
					toulmno = toulmno.sort(sortNumber);//从小排序 
					mainOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[0]);//赔率
					tpzballlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[1]);//类型
					tpzballcnlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[2]);//中文类型
					if(isNaN(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[3])){
						secondaryOdds.push(0);
					}else{
						secondaryOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,lmdivid)[3]);
					}
				} 
			}
			betswhso(tpzballcnlist,mainOdds,playType,secondaryOdds,tpzballlist);
		}
	}
});

//对碰
function Duipen(shunum,isBall_Shaw_Tail,lmdivid,sxdpval1,sxdpval2,playType){
	var mainOdds = [];
	var secondaryOdds = [];
	var tpzballlist = [];
	var tpzballcnlist = [];
	var sxdpval = [];
	var rydpValue_arrCN = [];
	var secondaryOdds_arrCN = [];
	var mainOdds_arrCN = [];
	var rydpValue_arr = [];
	for(var w = 0;w<sxdpval1.length;w++){
		for(var t = 0;t<sxdpval2.length;t++){
			if(sxdpval1[w] != sxdpval2[t]){
				sxdpval = [sxdpval1[w],sxdpval2[t]];
				sxdpval = sxdpval.sort(sortNumber);//从小排序  
			}
			mainOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[0]);
			tpzballlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[1]);
			tpzballcnlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[2]);
			if(isNaN(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[3])){
				secondaryOdds.push(0);
			}else{
				secondaryOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,sxdpval,lmdivid)[3]);
			}
		} 
	}
    for (var i = 0; i < tpzballcnlist.length; i++) {
        if (rydpValue_arrCN.toString().indexOf(tpzballcnlist[i]) < 0) {
        	rydpValue_arrCN.push(tpzballcnlist[i]);
        	secondaryOdds_arrCN.push(secondaryOdds[i]);//副赔率
        	mainOdds_arrCN.push(mainOdds[i]);//
        }
    }
    for (var i = 0; i < tpzballlist.length; i++) {
        if (rydpValue_arr.toString().indexOf(tpzballlist[i]) < 0) {
        	rydpValue_arr.push(tpzballlist[i]);
        }
    }
	//生成前台注单
	betswhso(rydpValue_arrCN,mainOdds_arrCN,playType,secondaryOdds_arrCN,rydpValue_arr);
}
/**
 * 
 * 拖头生成注单
 */
function totalGenerate(TailingNumber,tractorsNumber,shunum,isBall_Shaw_Tail,play_div,play_type){
		var tpzballlist = [];
		var mainOdds = [];
		var secondaryOdds = [];
		var tpzmoynelist = [];
		var tpzballcnlist = [];
		for(var s = 0;s<TailingNumber.length;s++){
			var toulmno = [];
			for(var x = 0; x<tractorsNumber.length;x++){
				if(tractorsNumber[x] != TailingNumber[s]){					
					toulmno.push(tractorsNumber[x]);							 
				}
			}
				toulmno.push(TailingNumber[s]);
				toulmno = toulmno.sort(sortNumber);//从小排序    
				if(toulmno.length > tractorsNumber.length){
				mainOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,play_div)[0]);//赔率
				tpzballlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,play_div)[1]);//类型
				tpzballcnlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,toulmno,play_div)[2]);//中文类型
				secondaryOdds.push(0);
			}
		}
		//生成前台注单
		betswhso(tpzballcnlist,mainOdds,play_type,secondaryOdds,tpzballlist);
	}

//去页面效果
function lmRemoveEffect(){
	$("#duplex_tractorsForm li").removeClass("on");
	$("#duplex_tractorsForm li").removeClass("on2");
	$("#zodiacForm li").removeClass("on");
	$("#mantissaForm li").removeClass("on");
	$("#health_tailForm li").removeClass("on");
	$("#arbitrarilyForm td").removeClass("td1");
	
}
/**
 * 过关
 */

$("#ggul1 li").on("click",function(){
	$("#ggul1 li").each(function(){
		if($("#ggul1 li").hasClass("on")){
			$("#ggul1 li").removeClass("on");
		}
	});
		$(this).attr("class","on");
});
$("#ggul2 li").on("click",function(){
	$("#ggul2 li").each(function(){
		if($("#ggul2 li").hasClass("on")){
			$("#ggul2 li").removeClass("on");
		}
	});
	$(this).attr("class","on");
});
$("#ggul3 li").on("click",function(){
	$("#ggul3 li").each(function(){
		if($("#ggul3 li").hasClass("on")){
			$("#ggul3 li").removeClass("on");
		}
	});
	$(this).attr("class","on");
});
$("#ggul4 li").on("click",function(){
	$("#ggul4 li").each(function(){
		if($("#ggul4 li").hasClass("on")){
			$("#ggul4 li").removeClass("on");
		}
	});
	$(this).attr("class","on");
});
$("#ggul5 li").on("click",function(){
	$("#ggul5 li").each(function(){
		if($("#ggul5 li").hasClass("on")){
			$("#ggul5 li").removeClass("on");
		}
	});
	$(this).attr("class","on");
});
$("#ggul6 li").on("click",function(){
	$("#ggul6 li").each(function(){
		if($("#ggul6 li").hasClass("on")){
			$("#ggul6 li").removeClass("on");
		}
	});
	$(this).attr("class","on");
});
$("#ggul7 li").on("click",function(){
	$("#ggul7 li").each(function(){
		if($("#ggul7 li").hasClass("on")){
			$("#ggul7 li").removeClass("on");
		}
	});
	$(this).attr("class","on");
});
//点击下注
$("input[id = 'gglottoBet']").on("click",function(){
	 var tpzballcnlist = [];
	 var mainOdds = [];
	 var secondaryOdds = [];
	 var tpzballlist = [];
	 var guoguanval = [];
	 var playType = "GUOGUAN";
	 var isBall_Shaw_Tail = "Guo"; 
	 var lmdivid = "clearance"; 
	 var shunum = $("#clearance li[class = 'on']").size();
	 if(shunum > 1){
		 $("#clearance li").each(function(){
			 if($(this).hasClass("on")){
				 guoguanval.push($(this).attr("name"));
			 }
		 });
	    	guoguanval=guoguanval.sort(sortNumber)
	    	mainOdds.push(fthtzhudan(shunum,isBall_Shaw_Tail,guoguanval,lmdivid)[0]);
	    	tpzballlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,guoguanval,lmdivid)[1]);
	    	tpzballcnlist.push(fthtzhudan(shunum,isBall_Shaw_Tail,guoguanval,lmdivid)[2]);
	    	secondaryOdds.push(0);
	    	betswhso(tpzballcnlist,mainOdds,playType,secondaryOdds,tpzballlist);
	 }else{
		alert("请任选2-6个号码为一投注组合！");
	 }
		
		 ggRemoveEffect();
		 	    
});
//去页面效果
function ggRemoveEffect(){
	$("#clearance li").removeClass("on");
}
/**
 * 特肖
 */
$("#texiaoTable li").on("click",function(){
	$(this).toggleClass("on");
});
//选中游戏盘口
$("select[id = 'txChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
});
//点击下注
$("input[id = 'txlottoBet']").on("click",function(){
	 var liId = [];
	 var oddsVal = [];
	 var secondaryoddsVal = [];
	 var liIdCN = [];
	 var playType = "SHENXIAO_TE";
		 $("#texiaoTable li").each(function(){
			 if($(this).hasClass("on")){
				 liId.push($(this).attr("id"));
				 oddsVal.push($("#texiaoTable li[id = '"+$(this).attr("id")+"'] p").text());
				 liIdCN.push(betType_NO_CN[$(this).attr("id")]);
				 secondaryoddsVal.push(0);
			 }
		 });
		 betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
		 txRemoveEffect();
});
//去页面效果
function txRemoveEffect(){
	$("#texiaoTable li").removeClass("on");
}
/**
 * 特码头尾
 */
$("#specialTouwei li").on("click",function(){
	$(this).toggleClass("on");
});
//选中游戏盘口
$("select[id = 'tmtwChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
});
//点击下注
$("input[id = 'tmtwlottoBet']").on("click",function(){
	 //var liId = [];
	 //var oddsVal = [];
	 //var secondaryoddsVal = [];
	 //var liIdCN = [];
	 //var playType = "TEMA_TOUWEI";
	 //    $("#specialTouwei li").each(function(){
	 //   	 if($(this).hasClass("on")){
	 //   		 liId.push($(this).attr("name"));
	 //   		 oddsVal.push($("#specialTouwei p[name = '"+$(this).attr("name")+"']").text());
	 //   		 liIdCN.push(tmtw_NO_CN[$(this).attr("name")]);
	 //   		 secondaryoddsVal.push(0);
	 //   	 }
	 //    });
	 //    betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
    //    tmtwRemoveEffect();
    window.location.href = "../member/order.html";
});
//去页面效果
function tmtwRemoveEffect(){
	$("#specialTouwei li").removeClass("on");
}
/**
 * 五行
 */
$("#fiveTable li").on("click",function(){
	$(this).toggleClass("on");
});
//点击下注
$("input[id = 'whlottoBet']").on("click",function(){
	 var liId = [];
	 var oddsVal = [];
	 var secondaryoddsVal = [];
	 var liIdCN = [];
	 var playType = "WUXING";
		 $("#fiveTable li").each(function(){
			 if($(this).hasClass("on")){
				 if($(this).hasClass("on")){
					 liId.push($(this).attr("id"));
					 oddsVal.push($("#fiveTable li[id = '"+$(this).attr("id")+"'] p").text());
					 liIdCN.push(wh_NO_CN[$(this).attr("name")]);
					 secondaryoddsVal.push(0);
				 }
			 }
		 });
		 betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
		 whRemoveEffect();
});
//去页面效果
function whRemoveEffect(){
	$("#fiveTable li").removeClass("on");
}
/**
 * 半波
 */
$("#halfWave li").on("click",function(){
	$(this).toggleClass("on");
});
//点击下注
$("input[id = 'bblottoBet']").on("click",function(){
	 var liId = [];
	 var oddsVal = [];
	 var secondaryoddsVal = [];
	 var liIdCN = [];
	 var playType = "BANBO";
		 $("#halfWave li").each(function(){
			 if($(this).hasClass("on")){
				 liId.push($(this).attr("id"));
				 oddsVal.push($("#halfWave li[id = '"+$(this).attr("id")+"'] p").text());
				 liIdCN.push(betType_NO_CN[$(this).attr("id")]);
				 secondaryoddsVal.push(0);
			 }
		 });
		 betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
		 bbRemoveEffect();
});
//去页面效果
function bbRemoveEffect(){
	$("#halfWave li").removeClass("on");
}
/**
 * 七码
 */
$("#sevenYards li").on("click",function(){
	$(this).toggleClass("on");
});
//点击下注
$("input[id = 'qmlottoBet']").on("click",function(){
	 var liId = [];
	 var oddsVal = [];
	 var secondaryoddsVal = [];
	 var liIdCN = [];
	 var playType = "QIMA";
		 $("#sevenYards li").each(function(){
			 if($(this).hasClass("on")){
				 if($(this).hasClass("on")){
					 liId.push($(this).attr("name"));
					 oddsVal.push($("#sevenYards p[name = '"+$(this).attr("name")+"']").text());
					 liIdCN.push(qm_NO_CN[$(this).attr("name")]);
					 secondaryoddsVal.push(0);
				 }
			 }
		 });
		 betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
		 qmRemoveEffect();
});
//去页面效果
function qmRemoveEffect(){
	$("#sevenYards li").removeClass("on");
}
/**
 * 六肖
 */
$("#sixShaw li").on("click",function(){
	var shengxiaoId = $("select[id = 'lxChooseType']").val();  
	 if(shengxiaoId == "SHENXIAO6_2"){
		 xuanzhiNum("sixShaw",2,$(this));
	 }else if(shengxiaoId == "SHENXIAO6_3"){
		 xuanzhiNum("sixShaw",3,$(this));
	 } else if(shengxiaoId == "SHENXIAO6_4"){
		 xuanzhiNum("sixShaw",4,$(this));
	 }   else if(shengxiaoId == "SHENXIAO6_5"){
		 xuanzhiNum("sixShaw",5,$(this));
	 }else if(shengxiaoId == "SHENXIAO6_6"){ 
		 xuanzhiNum("sixShaw",6,$(this));
	 } 
});
//选中游戏盘口
$("select[id = 'lxChooseType']").change(function(){
	var tmType = $(this).val();
	getMustdata(tmType);
	heartbeatVal = tmType;
	if(tmType == "SHENXIAO6_2"){
		$("nav[id = 'lxPlay']").hide();
	}else if(tmType == "SHENXIAO6_3"){
		$("nav[id = 'lxPlay']").hide();
	}else if(tmType == "SHENXIAO6_4"){
		$("nav[id = 'lxPlay']").hide();
	}else if(tmType == "SHENXIAO6_5"){
		$("nav[id = 'lxPlay']").hide();
	}else if(tmType == "SHENXIAO6_6"){
		$("nav[id = 'lxPlay']").show();
	}
	lxRemoveEffect();
});
$("#lxPlay li").on("click",function(){
	$("#lxPlay li").removeClass("daohuangli");
	$("#sixShaw li").removeClass("on");
	$(this).attr("class","nav-li dc l-bg daohuangli");
	var lxliId = $(this).attr("id");
	 if(lxliId == "tx"){
		 for(var i = 0;i<ground_lx.length;i++){
			 $("#sixShaw li[id='" + ground_lx[i] + "']").attr("class","on");   
		 }
	 }else if(lxliId == "dx"){ 
		 for(var i = 0;i<day_lx.length;i++){   
			 $("#sixShaw li[id='" + day_lx[i] + "']").attr("class","on");  
		 }
	 }else if(lxliId == "jq"){ 
		 for(var i = 0;i<poultry.length;i++){    
			 $("#sixShaw li[id='" + poultry[i] + "']").attr("class","on");
		 }
	 }else if(lxliId = "ys"){ 
		 for(var i = 0;i<wild_beast.length;i++){  
			 $("#sixShaw li[id='" + wild_beast[i] + "']").attr("class","on");
		 } 
	 }
});

//点击下注
$("input[id = 'lxlottoBet']").on("click",function(){
	 var playType = $("select[id = 'lxChooseType']").val();
	 var lxdivid = "sixShaw";
	 var isBall_Shaw_Tail = "Shaw";
	 var docum = $("#sixShaw li");
		if(playType == "SHENXIAO6_2"){
			var shunum = 2;
		}else if(playType == "SHENXIAO6_3"){
			var shunum = 3;
		}else if(playType == "SHENXIAO6_4"){
			var shunum = 4;
		}else if(playType == "SHENXIAO6_5"){
			var shunum = 5;
		}else if(playType == "SHENXIAO6_6"){
			var shunum = 6;
		}
		Fushi(docum,shunum,isBall_Shaw_Tail,lxdivid,playType);//生成注单 
});
//去页面效果
function lxRemoveEffect(){
	$("#sixShaw li").removeClass("on");
}
/**
 * 一肖尾数
 */
$("#aShaw li").on("click",function(){
	$(this).toggleClass("on");
});
$("#MantissaTadle li").on("click",function(){
	$(this).toggleClass("on");
});
//去页面效果
function yxwsRemoveEffect(){
	$("#MantissaTadle li").removeClass("on");
	$("#aShaw li").removeClass("on");
}

//选中游戏盘口
$("select[id = 'yxwsChooseType']").change(function(){
	var tmType = $(this).val();
	getMustdata(tmType);
	heartbeatVal = tmType;
	if(tmType == "SHENXIAO_1_Y" || tmType == "SHENXIAO_1_N"){
		document.getElementById("MantissaTadle").style.display = 'none';
		document.getElementById('aShaw').style.display = 'block';
		$("ul[id = 'yixiaoPlay']").show();
		$("ul[id = 'weishuPlay']").hide();
	}else if(tmType == "WEISHU_Y" || tmType == "WEISHU_N"){
		document.getElementById("aShaw").style.display = 'none';
		document.getElementById('MantissaTadle').style.display = 'block';
		$("ul[id = 'yixiaoPlay']").hide();
		$("ul[id = 'weishuPlay']").show();
	}
	 yxwsRemoveEffect();
});
$("#yixiaoPlay li").on("click",function(){
	var yixiaoliId = $(this).attr("id");
	$("#yixiaoPlay li").removeClass("daohuangli");
	$("#aShaw li").removeClass("on");
	$(this).attr("class","nav-li dc l-bg daohuangli");
	if(yixiaoliId == "jqin"){ 
		for(var i = 0;i<poultry.length;i++){    
			$("#aShaw li[id=" + poultry[i] + "]").attr("class","on");
		}
	}else if(yixiaoliId == "yshou"){ 
		for(var i = 0;i<wild_beast.length;i++){  
			$("#aShaw li[id=" + wild_beast[i] + "]").attr("class","on");
		} 
		} 
});
$("#weishuPlay li").on("click",function(){
	var yixiaoliId = $(this).attr("id");
	$("#weishuPlay li").removeClass("daohuangli");
	$("#MantissaTadle li").removeClass("on");
	$(this).attr("class","nav-li dc l-bg daohuangli");
	if(yixiaoliId == "wdan"){ 
		for(var i = 0;i<one_tailed.length;i++){    
			$("#MantissaTadle li[id=" + one_tailed[i] + "]").attr("class","on");
		}
	}else if(yixiaoliId == "wshuang"){ 
		for(var i = 0;i<two_tailed.length;i++){  
			$("#MantissaTadle li[id=" + two_tailed[i] + "]").attr("class","on");
		} 
	}else if(yixiaoliId == "wda"){
		for(var i = 0;i<big_tail.length;i++){  
			$("#MantissaTadle li[id=" + big_tail[i] + "]").attr("class","on");
		} 
	}else if(yixiaoliId == "wxiao"){
		for(var i = 0;i<small_tail.length;i++){  
			$("#MantissaTadle li[id=" + small_tail[i] + "]").attr("class","on");
		} 
	}  
});
//点击下注
$("input[id = 'yxwslottoBet']").on("click",function(){
	 var liId = [];
	 var oddsVal = [];
	 var secondaryoddsVal = [];
	 var liIdCN = [];
	 var playType = $("select[id = 'yxwsChooseType']").val();
	 if(playType == "SHENXIAO_1_Y" || playType == "SHENXIAO_1_N"){
		 $("#aShaw li").each(function(){
			 if($(this).hasClass("on")){
				 liId.push($(this).attr("id"));
				 oddsVal.push($("#aShaw li[id = '"+$(this).attr("id")+"'] p").text());
				 liIdCN.push(betType_NO_CN[$(this).attr("id")]);
				 secondaryoddsVal.push(0);
			 }
		 });
	 }else if(playType == "WEISHU_Y" || playType == "WEISHU_N"){
		 $("#MantissaTadle li").each(function(){
			 if($(this).hasClass("on")){
				 liId.push($(this).attr("id"));
				 oddsVal.push($("#MantissaTadle li[id = '"+$(this).attr("id")+"'] p").text());
				 liIdCN.push(tail_Number_CN[$(this).attr("name")]);
				 secondaryoddsVal.push(0);
			 }
		 });
	 }
		 betswhso(liIdCN,oddsVal,playType,secondaryoddsVal,liId);
		 yxwsRemoveEffect();
});
/**
 * 生肖连
 */
$("#evenZodiac li").on("click",function(){
	var ballfixid = $("#sxlPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var playType = $("select[id = 'sxlChooseType']").val();
	var checkesan;
	if(ballfixid == "duplex"){
		xuanzhiNum("evenZodiac",9,$(this));
	}else if(ballfixid == "tractors"){
		 if(playType == "SHENXIAOLIAN_Y_2"||playType == "SHENXIAOLIAN_N_2"){  
			   checkesan = 1;
		 }else if(playType == "SHENXIAOLIAN_Y_3"||playType == "SHENXIAOLIAN_N_3"){
			   checkesan = 2;
		 }else if(playType == "SHENXIAOLIAN_Y_4"||playType == "SHENXIAOLIAN_N_4"){
			   checkesan = 3;
		 }else if(playType == "SHENXIAOLIAN_Y_5"||playType == "SHENXIAOLIAN_N_5"){
			  checkesan = 4;
		 } 
		tractorsNum("evenZodiac",checkesan,$(this)); //拖头效果
	}
});
//选中游戏盘口
$("select[id = 'sxlChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
	sxlRemoveEffect();
});
$("#sxlPlay li").on("click",function(){
	$("#sxlPlay li").removeClass("daohuangli");
	sxlRemoveEffect();
	$(this).attr("class","nav-li dc l-bg daohuangli");
});
//点击下注
$("input[id = 'sxllottoBet']").on("click",function(){
	var playType = $("select[id = 'sxlChooseType']").val();
	var ballfixid = $("#sxlPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var shunum;
	var isBall_Shaw_Tail = "Shaw";
	var docum = $("#evenZodiac li");
	var lmdivid = "evenZodiac";
	if(ballfixid == "duplex"){
		 if(playType == "SHENXIAOLIAN_Y_2"||playType == "SHENXIAOLIAN_N_2"){  
			 shunum = 2;
		 }else if(playType == "SHENXIAOLIAN_Y_3"||playType == "SHENXIAOLIAN_N_3"){
			 shunum = 3;
		 }else if(playType == "SHENXIAOLIAN_Y_4"||playType == "SHENXIAOLIAN_N_4"){
			 shunum = 4;
		 }else if(playType == "SHENXIAOLIAN_Y_5"||playType == "SHENXIAOLIAN_N_5"){
			 shunum = 5;
		 } 
		 Fushi(docum,shunum,isBall_Shaw_Tail,lmdivid,playType);//生成注单 
	}else if(ballfixid == "tractors"){
		var TailingNumber = [];
		var tractorsNumber = [];
		$("#evenZodiac li").each(function(){
			if($(this).hasClass("on2")){
				tractorsNumber.push($(this).attr("name"));
			}
			if($(this).hasClass("on")){
				TailingNumber.push($(this).attr("name"));
			}
		});
		TailingNumber = TailingNumber.sort(sortNumber);//从小排序   
		tractorsNumber = tractorsNumber.sort(sortNumber);//从小排序   
		 if(playType == "SHENXIAOLIAN_Y_2"||playType == "SHENXIAOLIAN_N_2"){  
			 shunum = 2;
		 }else if(playType == "SHENXIAOLIAN_Y_3"||playType == "SHENXIAOLIAN_N_3"){
			 shunum = 3;
		 }else if(playType == "SHENXIAOLIAN_Y_4"||playType == "SHENXIAOLIAN_N_4"){
			 shunum = 4;
		 }else if(playType == "SHENXIAOLIAN_Y_5"||playType == "SHENXIAOLIAN_N_5"){
			 shunum = 5;
		 } 
		 totalGenerate(TailingNumber,tractorsNumber,shunum,isBall_Shaw_Tail,lmdivid,playType);
	}
});
//去页面效果
function sxlRemoveEffect(){
	$("#evenZodiac li").removeClass("on");
	$("#evenZodiac li").removeClass("on2");
}
/**
 * 尾数连
 */
$("#evenMantissa li").on("click",function(){
	var ballfixid = $("#wslPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var playType = $("select[id = 'wslChooseType']").val();
	var checkesan;
	if(ballfixid == "duplex"){
		xuanzhiNum("evenMantissa",9,$(this));
	}else if(ballfixid == "tractors"){
		 if(playType == "WEISHULIAN_Y_2"||playType == "WEISHULIAN_N_2"){  
			   checkesan = 1;
		 }else if(playType == "WEISHULIAN_Y_3"||playType == "WEISHULIAN_N_3"){
			   checkesan = 2;
		 }else if(playType == "WEISHULIAN_Y_4"||playType == "WEISHULIAN_N_4"){
			   checkesan = 3;
		 } 
		tractorsNum("evenMantissa",checkesan,$(this)); //拖头效果
	}
});
//选中游戏盘口
$("select[id = 'wslChooseType']").change(function(){
	var tmType = $(this).val();
	wslRemoveEffect();
	heartbeatVal = tmType;
	getMustdata(tmType);
	
});
$("#wslPlay li").on("click",function(){
	$("#wslPlay li").removeClass("daohuangli");
	wslRemoveEffect();
	$(this).attr("class","nav-li dc l-bg daohuangli");
});
//点击下注
$("input[id = 'wsllottoBet']").on("click",function(){
	//var sxdpval2 = tail_Number_INT[$($("#shengwei2 li[class = 'on']")).attr("id")];
	var playType = $("select[id = 'wslChooseType']").val();
	var ballfixid = $("#wslPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var shunum;
	var isBall_Shaw_Tail = "Tail";
	var docum = $("#evenMantissa li");
	var lmdivid = "evenMantissa";
	if(ballfixid == "duplex"){
		 if(playType == "WEISHULIAN_Y_2"||playType == "WEISHULIAN_N_2"){  
			 shunum = 2;
		 }else if(playType == "WEISHULIAN_Y_3"||playType == "WEISHULIAN_N_3"){
			 shunum = 3;
		 }else if(playType == "WEISHULIAN_Y_4"||playType == "WEISHULIAN_N_4"){
			 shunum = 4;
		 } 
		 Fushi(docum,shunum,isBall_Shaw_Tail,lmdivid,playType);//生成注单 
	}else if(ballfixid == "tractors"){
		var TailingNumber = [];
		var tractorsNumber = [];
		$("#evenMantissa li").each(function(){
			if($(this).hasClass("on2")){
				tractorsNumber.push($(this).attr("name"));
			}
			if($(this).hasClass("on")){
				TailingNumber.push($(this).attr("name"));
			}
		});
		TailingNumber = TailingNumber.sort(sortNumber);//从小排序   
		tractorsNumber = tractorsNumber.sort(sortNumber);//从小排序   
		 if(playType == "SHENXIAOLIAN_Y_2"||playType == "SHENXIAOLIAN_N_2"){  
			 shunum = 2;
		 }else if(playType == "SHENXIAOLIAN_Y_3"||playType == "SHENXIAOLIAN_N_3"){
			 shunum = 3;
		 }else if(playType == "SHENXIAOLIAN_Y_4"||playType == "SHENXIAOLIAN_N_4"){
			 shunum = 4;
		 }
		 totalGenerate(TailingNumber,tractorsNumber,shunum,isBall_Shaw_Tail,lmdivid,playType);
	}
});
//去页面效果
function wslRemoveEffect(){
	$("#evenMantissa li").removeClass("on");
	$("#evenMantissa li").removeClass("on2");
}
/**
 * 不中
 */
$("#notIn li").on("click",function(){
	var ballfixid = $("#bzPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var playType = $("select[id = 'bzChooseType']").val();
	var checkesan;
	var shuNum;
	if(ballfixid == "duplex"){
		if(playType == "BUZHONG_5"){
			shuNum = 8;
		}else if(playType == "BUZHONG_6"){
			shuNum = 9;
		}else if(playType == "BUZHONG_7"){
			shuNum = 10;
		}else if(playType == "BUZHONG_8"){
			shuNum = 10;
		}else if(playType == "BUZHONG_9"){
			shuNum = 11;
		}else if(playType == "BUZHONG_10"){
			shuNum = 12;
		}
		xuanzhiNum("notIn",shuNum,$(this));
	}else if(ballfixid == "tractors"){
		if(playType == "BUZHONG_5"){
			checkesan = 4;
		}else if(playType == "BUZHONG_6"){
			checkesan = 5;
		}else if(playType == "BUZHONG_7"){
			checkesan = 6;
		}else if(playType == "BUZHONG_8"){
			checkesan = 7;
		}else if(playType == "BUZHONG_9"){
			checkesan = 8;
		}else if(playType == "BUZHONG_10"){
			checkesan = 9;
		}
		tractorsNum("notIn",checkesan,$(this)); //拖头效果
	}
});
//选中游戏盘口
$("select[id = 'bzChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
	bzRemoveEffect();
});
$("#bzPlay li").on("click",function(){
	$("#bzPlay li").removeClass("daohuangli");
	bzRemoveEffect();
	$(this).attr("class","nav-li dc l-bg daohuangli");
});
//点击下注
$("input[id = 'bzlottoBet']").on("click",function(){
	var playType = $("select[id = 'bzChooseType']").val();
	var ballfixid = $("#bzPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var shunum;
	var isBall_Shaw_Tail = "Ball";
	var docum = $("#notIn li");
	var lmdivid = "notIn";
	if(ballfixid == "duplex"){
		if(playType == "BUZHONG_5"){
			shunum = 5;
		}else if(playType == "BUZHONG_6"){
			shunum = 6;
		}else if(playType == "BUZHONG_7"){
			shunum = 7;
		}else if(playType == "BUZHONG_8"){
			shunum = 8;
		}else if(playType == "BUZHONG_9"){
			shunum = 9;
		}else if(playType == "BUZHONG_10"){
			shunum = 10;
		}
		 Fushi(docum,shunum,isBall_Shaw_Tail,lmdivid,playType);//生成注单 
	}else if(ballfixid == "tractors"){
		var TailingNumber = [];
		var tractorsNumber = [];
		$("#notIn li").each(function(){
			if($(this).hasClass("on2")){
				tractorsNumber.push($(this).attr("name"));
			}
			if($(this).hasClass("on")){
				TailingNumber.push($(this).attr("name"));
			}
		});
		TailingNumber = TailingNumber.sort(sortNumber);//从小排序   
		tractorsNumber = tractorsNumber.sort(sortNumber);//从小排序   
		 if(playType == "SHENXIAOLIAN_Y_2"||playType == "SHENXIAOLIAN_N_2"){  
			 shunum = 1;
		 }else if(playType == "SHENXIAOLIAN_Y_3"||playType == "SHENXIAOLIAN_N_3"){
			 shunum = 2;
		 }else if(playType == "SHENXIAOLIAN_Y_4"||playType == "SHENXIAOLIAN_N_4"){
			 shunum = 3;
		 }
		 totalGenerate(TailingNumber,tractorsNumber,shunum,isBall_Shaw_Tail,lmdivid,playType);
	}
});
//去页面效果
function bzRemoveEffect(){
	$("#notIn li").removeClass("on");
	$("#notIn li").removeClass("on2");
}
/**
 * 多选中一
 */
$("#selectInOne li").on("click",function(){
	var ballfixid = $("#dxzyPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var playType = $("select[id = 'dxzyChooseType']").val();
	var checkesan;
	var shuNum;
	if(ballfixid == "duplex"){
		if(playType == "ZHONG1_5"){
			shuNum = 8;
		}else if(playType == "ZHONG1_6"){
			shuNum = 9;
		}else if(playType == "ZHONG1_7"){
			shuNum = 10;
		}else if(playType == "ZHONG1_8"){
			shuNum = 10;
		}else if(playType == "ZHONG1_9"){
			shuNum = 11;
		}else if(playType == "ZHONG1_10"){
			shuNum = 12;
		}
		xuanzhiNum("selectInOne",shuNum,$(this));
	}else if(ballfixid == "tractors"){
		if(playType == "ZHONG1_5"){
			checkesan = 4;
		}else if(playType == "ZHONG1_6"){
			checkesan = 5;
		}else if(playType == "ZHONG1_7"){
			checkesan = 6;
		}else if(playType == "ZHONG1_8"){
			checkesan = 7;
		}else if(playType == "ZHONG1_9"){
			checkesan = 8;
		}else if(playType == "ZHONG1_10"){
			checkesan = 9;
		}
		tractorsNum("selectInOne",checkesan,$(this)); //拖头效果
	}
});
//选中游戏盘口
$("select[id = 'dxzyChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
	dxzyRemoveEffect();
});
$("#dxzyPlay li").on("click",function(){
	$("#dxzyPlay li").removeClass("daohuangli");
	dxzyRemoveEffect();
	$(this).attr("class","nav-li dc l-bg daohuangli");
});
//点击下注
$("input[id = 'dxzylottoBet']").on("click",function(){
	var playType = $("select[id = 'dxzyChooseType']").val();
	var ballfixid = $("#dxzyPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var shunum;
	var isBall_Shaw_Tail = "Ball";
	var docum = $("#selectInOne li");
	var lmdivid = "selectInOne";
	if(ballfixid == "duplex"){
		if(playType == "ZHONG1_5"){
			shunum = 5;
		}else if(playType == "ZHONG1_6"){
			shunum = 6;
		}else if(playType == "ZHONG1_7"){
			shunum = 7;
		}else if(playType == "ZHONG1_8"){
			shunum = 8;
		}else if(playType == "ZHONG1_9"){
			shunum = 9;
		}else if(playType == "ZHONG1_10"){
			shunum = 10;
		}
		 Fushi(docum,shunum,isBall_Shaw_Tail,lmdivid,playType);//生成注单 
	}else if(ballfixid == "tractors"){
		var TailingNumber = [];
		var tractorsNumber = [];
		$("#selectInOne li").each(function(){
			if($(this).hasClass("on2")){
				tractorsNumber.push($(this).attr("name"));
			}
			if($(this).hasClass("on")){
				TailingNumber.push($(this).attr("name"));
			}
		});
		TailingNumber = TailingNumber.sort(sortNumber);//从小排序   
		tractorsNumber = tractorsNumber.sort(sortNumber);//从小排序   
		 if(playType == "SHENXIAOLIAN_Y_2"||playType == "SHENXIAOLIAN_N_2"){  
			 shunum = 2;
		 }else if(playType == "SHENXIAOLIAN_Y_3"||playType == "SHENXIAOLIAN_N_3"){
			 shunum = 3;
		 }else if(playType == "SHENXIAOLIAN_Y_4"||playType == "SHENXIAOLIAN_N_4"){
			 shunum = 4;
		 }
		 totalGenerate(TailingNumber,tractorsNumber,shunum,isBall_Shaw_Tail,lmdivid,playType);
	}
});
//去页面效果
function dxzyRemoveEffect(){
	$("#selectInOne li").removeClass("on");
	$("#selectInOne li").removeClass("on2");
}
/**
 * 特平中
 */
$("#turpinIn li").on("click",function(){
	var ballfixid = $("#tpzPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var playType = $("select[id = 'tpzChooseType']").val();
	var checkesan;
	var shuNum;
	if(ballfixid == "duplex"){
		if(playType == "TEPING_1"){
			shuNum = 10;
		}else if(playType == "TEPING_2"){
			shuNum = 10;
		}else if(playType == "TEPING_3"){
			shuNum = 9;
		}else if(playType == "TEPING_4"){
			shuNum = 8;
		}else if(playType == "TEPING_5"){
			shuNum = 8;
		}
		xuanzhiNum("turpinIn",shuNum,$(this));
	}else if(ballfixid == "tractors"){
		 if(playType == "TEPING_2"){
			checkesan = 1;
		}else if(playType == "TEPING_3"){
			checkesan = 2;
		}else if(playType == "TEPING_4"){
			checkesan = 3;
		}else if(playType == "TEPING_5"){
			checkesan = 4;
		}
		tractorsNum("turpinIn",checkesan,$(this)); //拖头效果
	}
});
//选中游戏盘口
$("select[id = 'tpzChooseType']").change(function(){
	var tmType = $(this).val();
	heartbeatVal = tmType;
	getMustdata(tmType);
	tpzRemoveEffect();
	if(tmType == "TEPING_1"){
		$("nav[id = 'tpzPlay']").hide();
	}else{
		$("#tpzPlay li").removeClass("daohuangli");
		$("#tpzPlay li[id = 'duplex']").attr("class","nav-li dc l-bg daohuangli");
		$("nav[id = 'tpzPlay']").show();
	}
});
$("#tpzPlay li").on("click",function(){
	$("#tpzPlay li").removeClass("daohuangli");
	tpzRemoveEffect();
	$(this).attr("class","nav-li dc l-bg daohuangli");
});
//点击下注
$("input[id = 'tpzlottoBet']").on("click",function(){
	var playType = $("select[id = 'tpzChooseType']").val();
	var ballfixid = $("#tpzPlay li[class= 'nav-li dc l-bg daohuangli']").attr("id");
	var shunum;
	var isBall_Shaw_Tail = "Ball";
	var docum = $("#turpinIn li");
	var lmdivid = "turpinIn";
	if(ballfixid == "duplex"){
		if(playType == "TEPING_1"){
			shunum = 1;
		}else if(playType == "TEPING_2"){
			shunum = 2;
		}else if(playType == "TEPING_3"){
			shunum = 3;
		}else if(playType == "TEPING_4"){
			shunum = 4;
		}else if(playType == "TEPING_5"){
			shunum = 5;
		}
		 Fushi(docum,shunum,isBall_Shaw_Tail,lmdivid,playType);//生成注单 
	}else if(ballfixid == "tractors"){
			var TailingNumber = [];
			var tractorsNumber = [];
			docum.each(function(){
				if($(this).hasClass("on2")){
					tractorsNumber.push($(this).attr("name"));
				}
				if($(this).hasClass("on")){
					TailingNumber.push($(this).attr("name"));
				}
			});
			TailingNumber = TailingNumber.sort(sortNumber);//从小排序   
			tractorsNumber = tractorsNumber.sort(sortNumber);//从小排序   
			var valss;
			 if(playType == "TEPING_2"){
				 valss = 2;
			}else if(playType == "TEPING_3"){
				valss = 3;
			}else if(playType == "TEPING_4"){
				valss = 4;
			}else if(playType == "TEPING_5"){
				valss = 5;
			}
			 totalGenerate(TailingNumber,tractorsNumber,valss,isBall_Shaw_Tail,lmdivid,playType);
	}
});
//去页面效果
function tpzRemoveEffect(){
	$("#turpinIn li").removeClass("on");
	$("#turpinIn li").removeClass("on2");
}

//组合
function fthtzhudan(number,bettingType,noteSingle,bettingDiv){
	var singleNum = {};
	var singleCn = {};
	var getOdds  = [];
	var getOddsTwo = [];
	var AgoOdds = [];
	var getSingle = [];
	var getSingleCN = [];
	var returnSingle = [];
	if(bettingType == "Ball"){
		if(bettingDiv == "duplex_tractorsForm"){
			for(var i = 0; i<noteSingle.length; i++){
					if(heartbeatVal == "SERIAL_3_2"){
						getOdds.push($("#"+bettingDiv+" li[id='"+ball_No[(noteSingle[i])-1]+"'] p[name = '"+ball_No[(noteSingle[i])-1]+"']").text());
						getOddsTwo.push($("#"+bettingDiv+" li[id='"+ball_No[(noteSingle[i])-1]+"'] p[id = '"+ball_No[(noteSingle[i])-1]+"']").text());
					}else{
						getOdds.push($("#"+bettingDiv+" li[id='"+ball_No[(noteSingle[i])-1]+"'] p[id = '"+ball_No[(noteSingle[i])-1]+"']").text());
						getOddsTwo.push($("#"+bettingDiv+" li[id='"+ball_No[(noteSingle[i])-1]+"'] p[name = '"+ball_No[(noteSingle[i])-1]+"']").text());
					}
					
					getSingle.push(ball_No[parseInt(noteSingle[i])-1]);
					getSingleCN.push(ball_NO_CN[(noteSingle[i])-1]);
			}
			var dmin = getOdds[0];
			for(i = 0;i<getOdds.length;i++){
				if(i < getOdds.length - 1){
					dmin = Math.min(dmin,parseFloat(getOdds[i+1]));
					AgoOdds = dmin;
				}
			}
			var dminTwo = getOddsTwo[0];
			for(i = 0;i<getOddsTwo.length;i++){
				if(i < getOddsTwo.length - 1){
					dminTwo = Math.min(dminTwo,parseFloat(getOddsTwo[i+1]));
					AgoOddsTwo = dminTwo;
				}
			}
			returnSingle = [AgoOdds,getSingle.join(","),getSingleCN,AgoOddsTwo];
			return returnSingle;
		}else{
			singleNum = ball_No;
			singleCn = ball_NO_CN;
		}
	}else if(bettingType == "Shaw"){
		singleNum  = shaw_Order;
		singleCn = shaw_CN;
	}else if(bettingType == "Tail"){
		singleNum  = tail_Number;
		singleCn = tail_Number_CN;
	}else if(bettingType == "Guo"){
		singleNum  = gg_NO;
		singleCn = gg_NO_CN;
	}
	for(var i = 0; i<noteSingle.length; i++){
		getOdds.push($("#"+bettingDiv+" li[id='"+singleNum[(noteSingle[i])-1]+"'] p").text());
		getSingle.push(singleNum[parseInt(noteSingle[i])-1]);
		getSingleCN.push(singleCn[(noteSingle[i])-1]);
	}
	var dmin = getOdds[0];
	if(bettingType == "Guo"){
		for(i = 0;i<getOdds.length;i++){
			if(i < getOdds.length - 1){
				dmin = dmin*parseFloat(getOdds[i+1]);
				AgoOdds = dmin;
			}
		}
	}else if(number == 1){
			AgoOdds = getOdds;
	}else{
		for(i = 0;i<getOdds.length;i++){
			if(i < getOdds.length - 1){
				dmin = Math.min(dmin,parseFloat(getOdds[i+1]));
				AgoOdds = dmin;
			}
		}
	}
	returnSingle = [AgoOdds,getSingle.join(","),getSingleCN];
	return returnSingle;
}
/*
 * 复选框复式生成注单
 */
function Trun(n) {
	f = 1;
	for (i = 1; i <= n; i++)
		f *= i;
	return f;
}
//获取最小数
function sortNumber(a,b) 
{ 
	return a - b 
} 
//复式生成注单	  
function Fushi(chkno,tshu,isBall_Shaw,tpzdivid,balltypeid){
	var s;
	var pb;
	var ssum = 0; 
	var pvx;
	var exc = 0;
	var jub;
	var mp;
	var ballss = [];
	var balllist = [];
	var betmoyne = 2;
	var pelis = [];
	var tpzballlist = [];
	var mainOdds = [];
	var secondaryOdds = [];
	var tpzmoynelist = [];
	var tpzballcnlist = [];
	var cball = new Array();
	var init = new Array();
	
	for (var i = 1; i <= tshu; i++) {
		init[i] = i;
	}

	$("#"+tpzdivid+" li").each(function(){
		if($(this).hasClass("on")){
			ssum += 1;
			cball.push($(this).attr("name"));
		}
	});
	if (tshu > ssum) {
		alert("所选球数至少"+tshu+"个！",20);
		return false;
	} 
	s = Math.round(Trun(ssum) / Trun(ssum - tshu) / Trun(tshu));
	
	if (s > 500000) {
		alert("组合超过50万注，暂不提供输出，抱歉！",2);
		return false;
	}
	cball=cball.sort(sortNumber);//从小排序
	for (var i = 0; i <= s-1; i++) { 
		if(tshu == 1){
			var ballss=[cball[init[1]-1]];
		}else if(tshu == 2){
			var ballss=[cball[init[1]-1],cball[init[2]-1]];
		}else if(tshu == 3){
			var ballss=[cball[init[1]-1],cball[init[2]-1],cball[init[3]-1]];  
		}else if(tshu == 4){
			var ballss=[cball[init[1]-1],cball[init[2]-1],cball[init[3]-1],cball[init[4]-1]];  
		}else if(tshu == 5){ 
			var ballss=[cball[init[1]-1],cball[init[2]-1],cball[init[3]-1],cball[init[4]-1],cball[init[5]-1]];  
		}else if(tshu == 6){
			var ballss=[cball[init[1]-1],cball[init[2]-1],cball[init[3]-1],cball[init[4]-1],cball[init[5]-1],cball[init[6]-1]];  
		}else if(tshu == 7){
			var ballss=[cball[init[1]-1],cball[init[2]-1],cball[init[3]-1],cball[init[4]-1],cball[init[5]-1],cball[init[6]-1],cball[init[7]-1]];  
		}else if(tshu == 8){
			var ballss=[cball[init[1]-1],cball[init[2]-1],cball[init[3]-1],cball[init[4]-1],cball[init[5]-1],cball[init[6]-1],cball[init[7]-1],cball[init[8]-1]];  
		}else if(tshu == 9){
			var ballss=[cball[init[1]-1],cball[init[2]-1],cball[init[3]-1],cball[init[4]-1],cball[init[5]-1],cball[init[6]-1],cball[init[7]-1],cball[init[8]-1],cball[init[9]-1]];  
		}else if(tshu == 10){
			var ballss=[cball[init[1]-1],cball[init[2]-1],cball[init[3]-1],cball[init[4]-1],cball[init[5]-1],cball[init[6]-1],cball[init[7]-1],cball[init[8]-1],cball[init[9]-1],cball[init[10]-1]];  					 
		}
		mainOdds.push(fthtzhudan(tshu,isBall_Shaw,ballss,tpzdivid)[0]);//主赔率
		tpzballlist.push(fthtzhudan(tshu,isBall_Shaw,ballss,tpzdivid)[1]);//类型
		tpzballcnlist.push(fthtzhudan(tshu,isBall_Shaw,ballss,tpzdivid)[2]);//中文类型
		secondaryOdds.push(fthtzhudan(tshu,isBall_Shaw,ballss,tpzdivid)[3]);//副赔率
		exc = parseInt(tshu);
		jub = true;
		
		while ((exc > 0) & (jub == true)) {
			mp = ssum - tshu + exc;
			if (init[exc] < mp) {
				pvx = init[exc];
				for (var gox = exc; gox <= tshu; gox++) {
					init[gox] = pvx + 1;
					pvx += 1;
				}
				jub = false;
			}
			exc -= 1;
			
		}
	}
	betswhso(tpzballcnlist,mainOdds,balltypeid,secondaryOdds,tpzballlist);
}
//生成前台注单方法
function betswhso(kjymtds,kjymoddss,tmab,secondaryodds,liId){
	var betslength = kjymtds.length;
	if(FPTS == "NO"){
		shortPrompt("已经封盘！",null);
	}else if(betslength < 1){
		shortPrompt("请选择下注类型！",null);
	}else{
	 var divHtml = "<tr><th style = 'background:#9CF;width:100%' colspan= '2'>适应赔率<input id = 'oddsAdapt' type='checkbox' checked>注单：<span id = 'betlen'>"+kjymtds.length+"</span>条,投注总金额:<span id = 'moneyfill'></span></th></tr>" +
	 		"<tr><td id = 'TypegameTD' style = 'width: 50%;'>当前期数：<span >"+gameinformationGameNo+"</span><a id = '"+tmab+"'></a></td><td style = 'width: 50%;'><span style = 'float: right;'><input style  = 'width:75px;height: 26px;' id = 'Moneykj' type='text'><button id = 'fillinMoney' name = 'betMoney"+i+"' class = 'btnfill btnmgr-l-r' type='button'>速填</button></span></td></tr>";   
	 if(secondaryodds != undefined){
		for(var i =0;i<betslength;i++){
			if(isNaN(secondaryodds[i])|| secondaryodds[i] <= 0){
				divHtml += "<tr name = '"+i+"' id = '"+liId[i]+"'><td style = 'width: 50%;' >"+betOn_NO_CN[tmab]+"："+kjymtds[i]+"<span>@</span><span id = '"+liId[i]+"' style = 'color:red;'>"+kjymoddss[i]+"</span></td><td style = 'width: 50%;'>" +
						"<span style = 'float: right;'>" +
						"<input id = '"+liId[i]+"' style  = 'width:75px;height: 26px;' name = 'betMoney"+i+"' type='number'>" +
						"<button id = 'deleteMoney' name = '"+i+"' class = 'btncancel btnmgr-l-r' type='button' >删除</button>" +
						"</span></td></tr>";  
			}else {
				divHtml += "<tr name = '"+i+"' id = '"+liId[i]+"'><td style = 'width: 50%;'>"+betOn_NO_CN[tmab]+"："+kjymtds[i]+"<span>@</span><span id = '"+liId[i]+"' style = 'color:red;'>"+kjymoddss[i]+"</span>/<span name = '"+liId[i]+"' style = 'color:red;'>"+secondaryodds[i]+"</span></td><td style = 'width: 50%;'>" +
				"<span style = 'float: right;'>" +
				"<input id = '"+liId[i]+"' style  = 'width:75px;height: 26px;' name = 'betMoney"+i+"' type='number'>" +
				"<button id = 'deleteMoney' name = '"+i+"' class = 'btncancel btnmgr-l-r' type='button' >删除</button>" +
				"</span></td></tr>";  
			}
		} 
	}else {
		for(var i =0;i<kjymtds.length;i++){
		     divHtml += "<tr name = '"+i+"' id = '"+liId[i]+"'><td style = 'width: 50%;'>"+betOn_NO_CN[tmab]+"："+kjymtds[i]+"<span>@</span><span id = '"+liId[i]+"' style = 'color:red;'>"+kjymoddss[i]+"</span></td><td style = 'width: 50%;'>" +
				"<span style = 'float: right;'>" +
				"<input id = '"+liId[i]+"' style  = 'width:75px;height: 26px;' name = 'betMoney"+i+"' type='number'>" +
				"<input id = 'deleteMoney' name = '"+i+"' class = 'btncancel btnmgr-l-r' type='button' >删除</button>" +
				"</span></td></tr>";  
		}
	}
	 $("tbody[id = 'Bet_value']").html(divHtml);
	 for(var i = 0;i<GuidepageType.length;i++){
		 document.getElementById(GuidepageType[i]).style.display = 'none';
	 }
	 getguidePage("sczdMob");
		//注单提交删除
		$("button[id = 'deleteMoney']").on("click",function(){
			var betlen = $("#Bet_value tr").size();
			$("span[id = 'betlen']").text(parseInt((betlen -3)));
			var daletename = $(this).attr("name");
			$("tr[name = '"+daletename+"']").remove();
			$("input[type = 'number']").trigger("keyup");
		});
		//点击填写
		$("button[id = 'fillinMoney']").on("click",function(){
			var fillinmoney = $("input[id = 'Moneykj']").val();
			$("#Bet_value  input[type = 'number']").attr("value",fillinmoney);
			$("input[type = 'number']").trigger("keyup");//将事件绑定到keyup事件上
		});

		//文本框只能输入数字
		$("input").keyup(function(){
			var sss = $(this).val();
			var fillmoney = 0;
			$(this).attr("value",sss.replace(/\D/g,'')); 
			if(sss == 0){
				$(this).attr("value",sss.replace(0,''));
			}
			$("input[type = 'number']").each(function(){
				if(isNaN(parseInt($(this).val()))){
					fillmoney = (fillmoney+0);
				}else{
					fillmoney = (fillmoney+parseInt($(this).val()));
				}
				
			});
				$("span[id = 'moneyfill']").text(fillmoney);
		});
	}
}
//返回
$("span[id = 'ReturnPageMain']").click(function(){
	var tmab = $("td[id = 'TypegameTD'] a").attr("id");
	ReturnPageMain(tmab);
});
//取消
$("#betsAll li[id = 'Cancelbets']").click(function(){
	var tmab = $("td[id = 'TypegameTD'] a").attr("id");
	ReturnPageMain(tmab);
	wholeRefresh(tmab);
});
//确定
$("#betsAll li[id = 'OKbets']").on("click",function(){
	var trId = [];
	var trMoney = [];
	var trOdds = [];
	var trsecondaryodds = [];
	var moneyVal = 1;
	$("#Bet_value tr").each(function(){
		if($(this).attr("id") != undefined){
			trId.push($(this).attr("id"));
			if($("input[id = '"+$(this).attr("id")+"']").val()>0){
				trMoney.push($("input[id = '"+$(this).attr("id")+"']").val());
			}else {
				 moneyVal = 0;
			}
			trOdds.push($("span[id = '"+$(this).attr("id")+"']").text());
			if($("span[name = '"+$(this).attr("id")+"']").text() != ""){
				trsecondaryodds.push($("span[name = '"+$(this).attr("id")+"']").text());
			}else{
				trsecondaryodds.push(0);
			}
		}
	});
	if(moneyVal == 1){
		var tmab = $("td[id = 'TypegameTD'] a").attr("id");
		if(tmab == "TEMA_B"){
			var typeB = ["ODD","EVEN","BIG","SMALL","SUM_ODD","SUM_EVEN","TAIL_BIG","TAIL_SMALL","RED","GREEN","BLUE"];
			var tamaType = ["TEMA_A","TEMA_B"];
			betBackstageTwo(trId,trMoney,trOdds,tmab,trsecondaryodds,typeB,tamaType);
		}else if(tmab == "ZHENGMA_B"){
			 var typeB = ["ODD","EVEN","BIG","SMALL"];
			 var tamaType = ["ZHENGMA_A","ZHENGMA_B"];
			 betBackstageTwo(trId,trMoney,trOdds,tmab,trsecondaryodds,typeB,tamaType);
		}else if(tmab == "SERIAL_2_2"||tmab == "SERIAL_2_TE"||tmab == "SERIAL_TE"||tmab == "SERIAL_3_2"||tmab == "SERIAL_3_3"){
			betBackstage(trId,trMoney,trOdds,tmab,trsecondaryodds);
		}else if(tmab == "TEMA_TOUWEI"){
			 var typeB = ["0","1","2","3","4"];
			 var tamaType = ["TEMA_TOU","TEMA_WEI"];
			 betBackstageTwo(trId,trMoney,trOdds,tmab,trsecondaryodds,typeB,tamaType);
		}else if(tmab == "QIMA"){
			betBackstageQIMA(trId,trMoney,trOdds);
		}else{
			betBackstage(trId,trMoney,trOdds,tmab,trsecondaryodds);
		}
		var betmoynelist = eval(trMoney.join("+"));//累加金额
		//是否默认适应赔率
			if($("input[id = 'oddsAdapt']").attr("checked")=='checked'){
				var oddsAdapt = true;
			}else{
				var oddsAdapt = false;
			}
			if(compareBetData(betlistval,tmab,betmoynelist)){
				submitData(betlistval,oddsAdapt);
				wholeRefresh(tmab);
			}else{
				wholeRefresh(tmab);//取消效果
			}
	}else {
		shortPrompt("请填写下注金额！",null);
	}

});
//生成七码bets
function betBackstageQIMA(trId,trMoney,trOdds){
	var betPo = {};betPo2 = {};betPo3 = {};betPo4 = {};     
		var betlist1 = []; betlist2 = [];betlist3 = [];betlist4 = [];  
		trId=trId.sort(sortNumber);//从小排序  
		for(var s = 0;s<trId.length;s++){ 
		if(parseInt(trId[s]) <= 8){
		var betSub1 = {};
		betPo["betOn"] ="QIMA_ODD";  
		betSub1["betType"] = qm_NO[trId[s]];
		betSub1["betMoney"] = trMoney[s];
		betSub1["mainOdds"] =  trOdds[s];
		betSub1["secondaryOdds"] = 0;
		betlist1.push(betSub1);
		betPo["bets"] = betlist1; 
		}else if(parseInt(trId[s])>8 && parseInt(trId[s]) <= 16){
			betSub2 = {};
			betPo2["betOn"] ="QIMA_EVEN";  
			betSub2["betType"] = qm_NO[trId[s]];
			betSub2["betMoney"] = trMoney[s];
			betSub2["mainOdds"] =  trOdds[s];
			betSub2["secondaryOdds"] = 0;
			betlist2.push(betSub2);
			betPo2["bets"] = betlist2; 
		}else if(parseInt(trId[s]) > 16 && parseInt(trId[s]) <= 24){
			betSub3={};
			betPo3["betOn"] ="QIMA_BIG";  
			betSub3["betType"] = qm_NO[trId[s]];
			betSub3["betMoney"] = trMoney[s];
			betSub3["mainOdds"] =  trOdds[s];
			betSub3["secondaryOdds"] = 0;
			betlist3.push(betSub3);
			betPo3["bets"] = betlist3; 
		}else if(parseInt(trId[s]) > 24 && parseInt(trId[s]) <= 32){
			betSub4 = {}; 
			betPo4["betOn"] ="QIMA_SMALL";  
			betSub4["betType"] = qm_NO[trId[s]];
			betSub4["betMoney"] = trMoney[s];
			betSub4["mainOdds"] =  trOdds[s];
			betSub4["secondaryOdds"] = 0;
			betlist4.push(betSub4);
			betPo4["bets"] = betlist4; 
		}
		}
		betlistval = [];
		if(!jQuery.isEmptyObject(betPo)){
   		betlistval.push(betPo)
   	}
   	if(!jQuery.isEmptyObject(betPo2)){
   		betlistval.push(betPo2)
   	}
   	if(!jQuery.isEmptyObject(betPo3)){
   		betlistval.push(betPo3)
   	}
   	if(!jQuery.isEmptyObject(betPo4)){
   		betlistval.push(betPo4)
   	}
}
//要生成两个bets
function betBackstageTwo(trId,trMoney,trOdds,tmab,trsecondaryodds,noType,typeAB){
	  var betPo = {}; //注单对象
	  var betPo2 = {}; 
	  var betlist1 = []; 
	  var betlist2 = []; 
	  for(var s = 0;s<trId.length;s++){
		  for(var i = 0;i<noType.length;i++){
			 if(trId[s] == noType[i] ){ 
			  var betSub1 = {}; 
			  betPo2["betOn"] =typeAB[0];  
			  if(tmab == "TEMA_TOUWEI"){
				  betSub1["betType"] = tmtw_NO[trId[s]];
			  }else{
				  betSub1["betType"] = trId[s];
			  }
			  betSub1["betMoney"] = trMoney[s];
			  betSub1["mainOdds"] =  trOdds[s];
			  betSub1["secondaryOdds"] = trsecondaryodds[s];
			  betlist1.push(betSub1);
			  betPo2["bets"] = betlist1; 
		   	}
		  }
		  
	   }

	  if(tmab == "TEMA_TOUWEI"){
		  for(var x = 0; x < trId.length; x++){
			  for(var z = 0;z<tail_Number_NU.length;z++){
				  if(trId[x] == tail_Number_NU[z] ){ 
					  var betSub2 = {};
					  betPo["betOn"] =typeAB[1];
					  betSub2["betType"] = tmtw_NO[trId[x]];
					  betSub2["betMoney"] = trMoney[x];
					  betSub2["mainOdds"] =  trOdds[x];
					  betSub2["secondaryOdds"] = trsecondaryodds[x];
					  betlist2.push(betSub2);
					  betPo["bets"] = betlist2;
				  }
			  }
		  }
	  }else{
		  for(var x = 0; x < trId.length; x++){
			  for(var z = 0;z<ball_No.length;z++){
				  if(trId[x] == ball_No[z] ){ 
					  var betSub2 = {};
					  betPo["betOn"] =typeAB[1];
					  betSub2["betType"] = trId[x];
					  betSub2["betMoney"] = trMoney[x];
					  betSub2["mainOdds"] =  trOdds[x];
					  betSub2["secondaryOdds"] = trsecondaryodds[x];
					  betlist2.push(betSub2);
					  betPo["bets"] = betlist2;
				  }
			  }
		  }
	  }
	   	betlistval = [];
	   	if(!jQuery.isEmptyObject(betPo)){
	   		betlistval.push(betPo);
	   	}
	   	if(!jQuery.isEmptyObject(betPo2)){
	   		betlistval.push(betPo2);
	   	}
}

//生成后台注单方法
function betBackstage(kjymtds,kjyminputs,kjymoddss,tmab,secondaryodds){
	var betPo = {}; //注单对象  
	var betlist = [];
	  for(var i = 0;i<kjymtds.length;i++){
		  	var betSub ={};
		  	    if(isNaN(parseFloat(secondaryodds)) || parseFloat(secondaryodds[i]) <= 0){
		  	    	betPo["betOn"] = tmab;  
					betSub["betType"] = kjymtds[i];
					betSub["betMoney"] = kjyminputs[i];
					betSub["mainOdds"] =  parseFloat(kjymoddss[i]);
					betSub["secondaryOdds"] = parseFloat(0);
					betlist.push(betSub);
					betPo["bets"] = betlist;
		  	    }else{
		  	    	betPo["betOn"] = tmab;  
					betSub["betType"] = kjymtds[i];
					betSub["betMoney"] = kjyminputs[i];
					betSub["mainOdds"] =  parseFloat(kjymoddss[i]);
					betSub["secondaryOdds"] = parseFloat(secondaryodds[i]);
					betlist.push(betSub);
					betPo["bets"] = betlist;
		  	    }
	  }
	  betlistval = [];
	  betlistval[0] = betPo; 
}


//返回游戏页面
function ReturnPageMain(gamePageIds){
	var guidePageval = "";
	if(gamePageIds == "TEMA_A"||gamePageIds == "TEMA_B"){
		guidePageval = "tmMob"
	}else if(gamePageIds == "ZHENGMA_A"||gamePageIds == "ZHENGMA_B"){
		guidePageval = "zmMob"
	}else if(gamePageIds == "ZHENGTE_1"||gamePageIds == "ZHENGTE_2"||gamePageIds == "ZHENGTE_3"||gamePageIds == "ZHENGTE_4"||gamePageIds == "ZHENGTE_5"||gamePageIds == "ZHENGTE_6"){
		guidePageval = "zmtMob"
	}else if(gamePageIds == "SERIAL_2_2"||gamePageIds == "SERIAL_2_TE"||gamePageIds == "SERIAL_TE"||gamePageIds == "SERIAL_3_2_3"||gamePageIds == "SERIAL_3_2"||gamePageIds == "SERIAL_3_3"){
		guidePageval = "lmMob"
	}else if(gamePageIds == "GUOGUAN"){
		guidePageval = "ggMob"
	}else if(gamePageIds == "SHENXIAO_TE"){
		guidePageval = "txMob"
	}else if(gamePageIds == "TEMA_TOUWEI"){
		guidePageval = "tmtwMob"
	}else if(gamePageIds == "WUXING"){
		guidePageval = "whMob"
	}else if(gamePageIds == "BANBO"){
		guidePageval = "bbMob"
	}else if(gamePageIds == "QIMA"){
		guidePageval = "qmMob"
	}else if(gamePageIds == "SHENXIAO_1_Y"||gamePageIds == "SHENXIAO_1_N"){
		guidePageval = "yxwsMob"
	}else if(gamePageIds == "WEISHU_Y"||gamePageIds == "WEISHU_N"){
		guidePageval = "yxwsMob"
	}else if(gamePageIds == "SHENXIAO6_2"||gamePageIds == "SHENXIAO6_3"||gamePageIds == "SHENXIAO6_4"||gamePageIds == "SHENXIAO6_5"||gamePageIds == "SHENXIAO6_6"){
		guidePageval = "lxMob"
	}else if(gamePageIds == "SHENXIAOLIAN_Y_2"||gamePageIds == "SHENXIAOLIAN_Y_3"||gamePageIds == "SHENXIAOLIAN_Y_4"||gamePageIds == "SHENXIAOLIAN_Y_5"||gamePageIds == "SHENXIAOLIAN_N_2"||gamePageIds == "SHENXIAOLIAN_N_3"||gamePageIds == "SHENXIAOLIAN_N_4"||gamePageIds == "SHENXIAOLIAN_N_5"){
		guidePageval = "sxlMob"
	}else if(gamePageIds == "WEISHULIAN_Y_2"||gamePageIds == "WEISHULIAN_Y_3"||gamePageIds == "WEISHULIAN_Y_4"||gamePageIds == "WEISHULIAN_N_2"||gamePageIds == "WEISHULIAN_N_3"||gamePageIds == "WEISHULIAN_N_4"){
		guidePageval = "wslMob"
	}else if(gamePageIds == "BUZHONG_5"||gamePageIds == "BUZHONG_6"||gamePageIds == "BUZHONG_7"||gamePageIds == "BUZHONG_8"||gamePageIds == "BUZHONG_9"||gamePageIds == "BUZHONG_10"){
		guidePageval = "bzMob"
	}else if(gamePageIds == "ZHONG1_5"||gamePageIds == "ZHONG1_6"||gamePageIds == "ZHONG1_7"||gamePageIds == "ZHONG1_8"||gamePageIds == "ZHONG1_9"||gamePageIds == "ZHONG1_10"){
		guidePageval = "dxzyMob"
	}else if(gamePageIds == "TEPING_1"||gamePageIds == "TEPING_2"||gamePageIds == "TEPING_3"||gamePageIds == "TEPING_4"||gamePageIds == "TEPING_5"){
		guidePageval = "tpzMob"
	}else{
		$("span[id = 'ReturnMain']").click();//返回main页面
	}
	getguidePage(guidePageval);
}

/**
*添加效果
*/

//刷新整个游戏的页面清除页面效果
function wholeRefresh(gamePageIds){
	if(gamePageIds == "TEMA_A"||gamePageIds == "TEMA_B"){
		tmRemoveEffect()
	}else if(gamePageIds == "ZHENGMA_A"||gamePageIds == "ZHENGMA_B"){
		zmRemoveEffect()
	}else if(gamePageIds == "ZHENGTE_1"||gamePageIds == "ZHENGTE_2"||gamePageIds == "ZHENGTE_3"||gamePageIds == "ZHENGTE_4"||gamePageIds == "ZHENGTE_5"||gamePageIds == "ZHENGTE_6"){
		ztmRemoveEffect()
	}else if(gamePageIds == "SERIAL_2_2"||gamePageIds == "SERIAL_2_TE"||gamePageIds == "SERIAL_TE"||gamePageIds == "SERIAL_3_2_3"||gamePageIds == "SERIAL_3_2"||gamePageIds == "SERIAL_3_3"){
		lmRemoveEffect()
	}else if(gamePageIds == "GUOGUAN"){
		ggRemoveEffect()
	}else if(gamePageIds == "SHENXIAO_TE"){
		txRemoveEffect()
	}else if(gamePageIds == "TEMA_TOUWEI"){
		tmtwRemoveEffect()
	}else if(gamePageIds == "WUXING"){
		whRemoveEffect()
	}else if(gamePageIds == "BANBO"){
		bbRemoveEffect()
	}else if(gamePageIds == "QIMA"){
		qmRemoveEffect()
	}else if(gamePageIds == "SHENXIAO_1_Y"||gamePageIds == "SHENXIAO_1_N"){
		yxwsRemoveEffect()
	}else if(gamePageIds == "WEISHU_Y"||gamePageIds == "WEISHU_N"){
		yxwsRemoveEffect()
	}else if(gamePageIds == "SHENXIAO6_2"||gamePageIds == "SHENXIAO6_3"||gamePageIds == "SHENXIAO6_4"||gamePageIds == "SHENXIAO6_5"||gamePageIds == "SHENXIAO6_6"){
		lxRemoveEffect()
	}else if(gamePageIds == "SHENXIAOLIAN_Y_2"||gamePageIds == "SHENXIAOLIAN_Y_3"||gamePageIds == "SHENXIAOLIAN_Y_4"||gamePageIds == "SHENXIAOLIAN_Y_5"||gamePageIds == "SHENXIAOLIAN_N_2"||gamePageIds == "SHENXIAOLIAN_N_3"||gamePageIds == "SHENXIAOLIAN_N_4"||gamePageIds == "SHENXIAOLIAN_N_5"){
		sxlRemoveEffect()
	}else if(gamePageIds == "WEISHULIAN_Y_2"||gamePageIds == "WEISHULIAN_Y_3"||gamePageIds == "WEISHULIAN_Y_4"||gamePageIds == "WEISHULIAN_N_2"||gamePageIds == "WEISHULIAN_N_3"||gamePageIds == "WEISHULIAN_N_4"){
		wslRemoveEffect()
	}else if(gamePageIds == "BUZHONG_5"||gamePageIds == "BUZHONG_6"||gamePageIds == "BUZHONG_7"||gamePageIds == "BUZHONG_8"||gamePageIds == "BUZHONG_9"||gamePageIds == "BUZHONG_10"){
		 bzRemoveEffect()
	}else if(gamePageIds == "ZHONG1_5"||gamePageIds == "ZHONG1_6"||gamePageIds == "ZHONG1_7"||gamePageIds == "ZHONG1_8"||gamePageIds == "ZHONG1_9"||gamePageIds == "ZHONG1_10"){
		dxzyRemoveEffect()
	}else if(gamePageIds == "TEPING_1"||gamePageIds == "TEPING_2"||gamePageIds == "TEPING_3"||gamePageIds == "TEPING_4"||gamePageIds == "TEPING_5"){
		tpzRemoveEffect()
	}
	  //kjquxiao();
} 
});


//请求数据
function getMustdata(gamePageIds){
	if(gamePageIds == "TEMA_A"||gamePageIds == "TEMA_B"){
		getWholeOdds("tmdivs",gamePageIds);
	}else if(gamePageIds == "ZHENGMA_A"||gamePageIds == "ZHENGMA_B"){
		getWholeOdds("zmdivs",gamePageIds);
	}else if(gamePageIds == "ZHENGTE_1"||gamePageIds == "ZHENGTE_2"||gamePageIds == "ZHENGTE_3"||gamePageIds == "ZHENGTE_4"||gamePageIds == "ZHENGTE_5"||gamePageIds == "ZHENGTE_6"){
		getWholeOdds("zmtdivs",gamePageIds);
	}else if(gamePageIds == "SERIAL_2_2"||gamePageIds == "SERIAL_2_TE"||gamePageIds == "SERIAL_TE"||gamePageIds == "SERIAL_3_2_3"||gamePageIds == "SERIAL_3_2"||gamePageIds == "SERIAL_3_3"){
		getLIANMA_Odds("duplex_tractorsForm",gamePageIds);
	}else if(gamePageIds == "GUOGUAN"){
		getWholeOdds("clearance",gamePageIds);
	}else if(gamePageIds == "SHENXIAO_TE"){
		getWholeOdds("texiaoTable",gamePageIds);
	}else if(gamePageIds == "TEMA_TOUWEI"){
		getTEMATOUWEI_dds();
	}else if(gamePageIds == "WUXING"){
		getWUXINGBANBO_dds();
	}else if(gamePageIds == "BANBO"){
		getWUXINGBANBO_dds();
	}else if(gamePageIds == "QIMA"){
		getQIMA_dds();
	}else if(gamePageIds == "SHENXIAO_1_Y"||gamePageIds == "SHENXIAO_1_N"){
		getWholeOdds("aShaw",gamePageIds);
	}else if(gamePageIds == "WEISHU_Y"||gamePageIds == "WEISHU_N"){
		getWholeOdds("MantissaTadle",gamePageIds);
	}else if(gamePageIds == "SHENXIAO6_2"||gamePageIds == "SHENXIAO6_3"||gamePageIds == "SHENXIAO6_4"||gamePageIds == "SHENXIAO6_5"||gamePageIds == "SHENXIAO6_6"){
		getWholeOdds("sixShaw",gamePageIds);
	}else if(gamePageIds == "SHENXIAOLIAN_Y_2"||gamePageIds == "SHENXIAOLIAN_Y_3"||gamePageIds == "SHENXIAOLIAN_Y_4"||gamePageIds == "SHENXIAOLIAN_Y_5"||gamePageIds == "SHENXIAOLIAN_N_2"||gamePageIds == "SHENXIAOLIAN_N_3"||gamePageIds == "SHENXIAOLIAN_N_4"||gamePageIds == "SHENXIAOLIAN_N_5"){
		getWholeOdds("evenZodiac",gamePageIds);
	}else if(gamePageIds == "WEISHULIAN_Y_2"||gamePageIds == "WEISHULIAN_Y_3"||gamePageIds == "WEISHULIAN_Y_4"||gamePageIds == "WEISHULIAN_N_2"||gamePageIds == "WEISHULIAN_N_3"||gamePageIds == "WEISHULIAN_N_4"){
		getWholeOdds("evenMantissa",gamePageIds);
	}else if(gamePageIds == "BUZHONG_5"||gamePageIds == "BUZHONG_6"||gamePageIds == "BUZHONG_7"||gamePageIds == "BUZHONG_8"||gamePageIds == "BUZHONG_9"||gamePageIds == "BUZHONG_10"){
		getWholeOdds("notIn",gamePageIds);
	}else if(gamePageIds == "ZHONG1_5"||gamePageIds == "ZHONG1_6"||gamePageIds == "ZHONG1_7"||gamePageIds == "ZHONG1_8"||gamePageIds == "ZHONG1_9"||gamePageIds == "ZHONG1_10"){
		getWholeOdds("selectInOne",gamePageIds);
	}else if(gamePageIds == "TEPING_1"||gamePageIds == "TEPING_2"||gamePageIds == "TEPING_3"||gamePageIds == "TEPING_4"||gamePageIds == "TEPING_5"){
		getWholeOdds("turpinIn",gamePageIds);
	}
}

////获取两位小数点
//function Digit(digit, length) { 
//    length = length ? parseInt(length) : 0;  
//    if (length <= 0) return Math.floor(digit);  
//    digit = Math.floor(digit * Math.pow(10, length)) / Math.pow(10, length);  
//    return digit;
//}; 
function Digit(digit, length) {
	if(digit != null){
		var Val = digit.toString();
		var Numlen = Val.split(".")[1];
		if(Numlen != undefined){
			if(length != 0 && Numlen.length > length){
				var aa = Val.split(".")[0];
				var bb =  Numlen.substr(0,length);
				digit = aa+"."+bb;
			}
		}
	}
    return digit;
};


//前台注单验证比较
function compareBetData(betData,betOn,betMoyne){
	var userminBet;
	var usermaxBet;
	var userMaxterm;
	if(betOn == "TEMA_A"){
		userminBet = userDataval['minBetMap']['TEMA_A'];
		usermaxBet = userDataval['maxBetMap']['TEMA_A'];
		userMaxterm = userDataval['maxMatchMap']['TEMA_A'];
	}else if(betOn == "TEMA_B"){
		userminBet = userDataval['minBetMap']['TEMA_B'];
		usermaxBet = userDataval['maxBetMap']['TEMA_B'];
		userMaxterm = userDataval['maxMatchMap']['TEMA_B'];
	}else if(betOn == "ZHENGMA_A"){
		userminBet = userDataval['minBetMap']['ZHENGMA_A'];
		usermaxBet = userDataval['maxBetMap']['ZHENGMA_A'];
		userMaxterm = userDataval['maxMatchMap']['ZHENGMA_A'];
	}else if(betOn == "ZHENGMA_B"){
		userminBet = userDataval['minBetMap']['ZHENGMA_B'];
		usermaxBet = userDataval['maxBetMap']['ZHENGMA_B'];
		userMaxterm = userDataval['maxMatchMap']['ZHENGMA_B'];
	}else if(betOn == "ZHENGTE_1"||betOn == "ZHENGTE_2"||betOn == "ZHENGTE_3"||betOn == "ZHENGTE_4"||betOn == "ZHENGTE_5"||betOn == "ZHENGTE_6"){
		userminBet = userDataval['minBetMap']['ZHENGTE'];
		usermaxBet = userDataval['maxBetMap']['ZHENGTE'];
		userMaxterm = userDataval['maxMatchMap']['ZHENGTE'];
	}else if(betOn == "SERIAL_3_3"||betOn == "SERIAL_3_2"||betOn == "SERIAL_3_2_3"||betOn == "SERIAL_2_2"||betOn == "SERIAL_2_TE"||betOn == "SERIAL_2_TE_TE"||betOn == "SERIAL_TE"){
		userminBet = userDataval['minBetMap']['SERIAL'];
		usermaxBet = userDataval['maxBetMap']['SERIAL'];
		userMaxterm = userDataval['maxMatchMap']['SERIAL'];
	}else if(betOn == "GUOGUAN"){
		userminBet = userDataval['minBetMap']['GUOGUAN'];
		usermaxBet = userDataval['maxBetMap']['GUOGUAN'];
		userMaxterm = userDataval['maxMatchMap']['GUOGUAN'];
	}else if(betOn == "SHENXIAO_TE"){
		userminBet = userDataval['minBetMap']['SHENXIAO_TE'];
		usermaxBet = userDataval['maxBetMap']['SHENXIAO_TE'];
		userMaxterm = userDataval['maxMatchMap']['SHENXIAO_TE'];
	}else if(betOn == "TEMA_TOU"||betOn == "TEMA_WEI"||betOn == "TEMATOUWEI"){
		userminBet = userDataval['minBetMap']['TEMA_TOU_WEI'];
		usermaxBet = userDataval['maxBetMap']['TEMA_TOU_WEI'];
		userMaxterm = userDataval['maxMatchMap']['TEMA_TOU_WEI'];
	}else if(betOn == "WUXING"){
		userminBet = userDataval['minBetMap']['WUXING'];
		usermaxBet = userDataval['maxBetMap']['WUXING'];
		userMaxterm = userDataval['maxMatchMap']['WUXING'];
	}else if(betOn == "BANBO"){
		userminBet = userDataval['minBetMap']['BANBO'];
		usermaxBet = userDataval['maxBetMap']['BANBO'];
		userMaxterm = userDataval['maxMatchMap']['BANBO'];
	}else if(betOn == "QIMA_ODD"||betOn == "QIMA_EVEN"||betOn == "QIMA_BIG"||betOn == "QIMA_SMALL"||betOn == "QIMA"){
		userminBet = userDataval['minBetMap']['QIMA'];
		usermaxBet = userDataval['maxBetMap']['QIMA'];
		userMaxterm = userDataval['maxMatchMap']['QIMA'];
	}else if(betOn == "SHENXIAO6_2"||betOn == "SHENXIAO6_3"||betOn == "SHENXIAO6_4"||betOn == "SHENXIAO6_4"||betOn == "SHENXIAO6_5"||betOn == "SHENXIAO6_6"){
		userminBet = userDataval['minBetMap']['SHENXIAO6'];
		usermaxBet = userDataval['maxBetMap']['SHENXIAO6'];
		userMaxterm = userDataval['maxMatchMap']['SHENXIAO6'];
	}else if(betOn == "SHENXIAO_1_Y"||betOn == "SHENXIAO_1_N"){
		userminBet = userDataval['minBetMap']['SHENXIAO_1'];
		usermaxBet = userDataval['maxBetMap']['SHENXIAO_1'];
		userMaxterm = userDataval['maxMatchMap']['SHENXIAO_1'];
	}else if(betOn == "WEISHU_Y"||betOn == "WEISHU_N"){
		userminBet = userDataval['minBetMap']['WEISHU'];
		usermaxBet = userDataval['maxBetMap']['WEISHU'];
		userMaxterm = userDataval['maxMatchMap']['WEISHU'];
	}else if(betOn == "SHENXIAOLIAN_Y_2"||betOn == "SHENXIAOLIAN_Y_3"||betOn == "SHENXIAOLIAN_Y_4"||betOn == "SHENXIAOLIAN_Y_5"||betOn == "SHENXIAOLIAN_N_2"||betOn == "SHENXIAOLIAN_N_3"||betOn == "SHENXIAOLIAN_N_4"||betOn == "SHENXIAOLIAN_N_5"){
		userminBet = userDataval['minBetMap']['SHENXIAOLIAN'];
		usermaxBet = userDataval['maxBetMap']['SHENXIAOLIAN'];
		userMaxterm = userDataval['maxMatchMap']['SHENXIAOLIAN'];
	}else if(betOn == "WEISHULIAN_Y_2"||betOn == "WEISHULIAN_Y_3"||betOn == "WEISHULIAN_Y_4"||betOn == "WEISHULIAN_N_2"||betOn == "WEISHULIAN_N_3"||betOn == "WEISHULIAN_N_4"){
		userminBet = userDataval['minBetMap']['WEISHULIAN'];
		usermaxBet = userDataval['maxBetMap']['WEISHULIAN'];
		userMaxterm = userDataval['maxMatchMap']['WEISHULIAN'];
	}else if(betOn == "BUZHONG_5"||betOn == "BUZHONG_6"||betOn == "BUZHONG_7"||betOn == "BUZHONG_8"||betOn == "BUZHONG_9"||betOn == "BUZHONG_10"){
		userminBet = userDataval['minBetMap']['BUZHONG'];
		usermaxBet = userDataval['maxBetMap']['BUZHONG'];
		userMaxterm = userDataval['maxMatchMap']['BUZHONG'];
	}else if(betOn == "ZHONG1_5"||betOn == "ZHONG1_6"||betOn == "ZHONG1_7"||betOn == "ZHONG1_8"||betOn == "ZHONG1_9"||betOn == "ZHONG1_10"){
		userminBet = userDataval['minBetMap']['ZHONG1'];
		usermaxBet = userDataval['maxBetMap']['ZHONG1'];
		userMaxterm = userDataval['maxMatchMap']['ZHONG1'];
	}else if(betOn == "TEPING_1"||betOn == "TEPING_2"||betOn == "TEPING_3"||betOn == "TEPING_4"||betOn == "TEPING_5"){
		userminBet = userDataval['minBetMap']['TEPING'];
		usermaxBet = userDataval['maxBetMap']['TEPING'];
		userMaxterm = userDataval['maxMatchMap']['TEPING'];
	}
	
	
	var betOnCN = "";
	var betOnEN = [];
	var betBetsEN = [];
	var betTypeCNArr = [];
	for(var b = 0;b<betData.length;b++){
		betOnEN.push(betData[b]['betOn']);
		betBetsEN.push(betData[b]['bets']);
	}
		for(var d = 0;d<betOnEN.length;d++){
			for(var s = 0;s<betBetsEN[d].length;s++){
				var betTypeArr = betBetsEN[d][s]['betType'].split(",");
				if(betBetsEN[d][s]['betType'] == "ODD"||betBetsEN[d][s]['betType'] == "EVEN"||betBetsEN[d][s]['betType'] == "BIG"||betBetsEN[d][s]['betType'] == "SMALL"||betBetsEN[d][s]['betType'] == "SUM_ODD"||betBetsEN[d][s]['betType'] == "SUM_EVEN"||betBetsEN[d][s]['betType'] == "TAIL_BIG"||betBetsEN[d][s]['betType'] == "TAIL_SMALL"){
					userminBet = userDataval['minBetMap']['LIANGMIAN'];
					usermaxBet = userDataval['maxBetMap']['LIANGMIAN'];
					userMaxterm = userDataval['maxMatchMap']['LIANGMIAN'];
				}else if(betBetsEN[d][s]['betType'] == "RED"||betBetsEN[d][s]['betType'] == "BLUE"||betBetsEN[d][s]['betType'] == "GREEN"){
					userminBet = userDataval['minBetMap']['SEBO'];
					usermaxBet = userDataval['maxBetMap']['SEBO'];
					userMaxterm = userDataval['maxMatchMap']['SEBO'];
				}
				
				 if(betMoyne > BalancetDataValue){
					 shortPromptrun("下注失败，用户余额不足！",null);
					// Enternum = 0;
					 return false;
				 }
				if(betBetsEN[d][s]['betMoney'] < userminBet){
					for(var j = 0;j<betTypeArr.length;j++){
						if(betOnEN[d] == "QIMA_ODD"){
							betTypeCNArr.push(betType_QM1_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "QIMA_EVEN"){
							betTypeCNArr.push(betType_QM2_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "QIMA_BIG"){
							betTypeCNArr.push(betType_QM3_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "QIMA_SMALL"){
							betTypeCNArr.push(betType_QM4_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "ZHENGMA_A"||betOnEN[d] == "ZHENGMA_B"){
							betTypeCNArr.push(betType_ZM_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "TEMA_TOU"){
							betTypeCNArr.push(betType_TMTOU_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "TEMA_WEI"||betOnEN[d] == "WEISHU_Y"||betOnEN[d] == "WEISHU_N"||betOnEN[d] == "WEISHULIAN_Y_2"||betOnEN[d] == "WEISHULIAN_Y_3"
								||betOnEN[d] == "WEISHULIAN_Y_4"||betOnEN[d] == "WEISHULIAN_N_2"||betOnEN[d] == "WEISHULIAN_N_3"||betOnEN[d] == "WEISHULIAN_N_4"){
							betTypeCNArr.push(betType_TMWEI_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "WUXING"){
							betTypeCNArr.push(betType_WH_CN[(betTypeArr[j])]);
						}else{
							betTypeCNArr.push(betType_NO_CN[(betTypeArr[j])]);
						}
						}
					betOnCN = betOn_NO_CN[betOn];
					shortPromptrun("下注失败，注单     "+betOnCN+":"+betTypeCNArr+"    "+betMoyne+"小于单号最低下注金额!",null);
					//Enternum = 0;
					return false;
				
				}
				if(betBetsEN[d][s]['betMoney'] > usermaxBet){
					for(var j = 0;j<betTypeArr.length;j++){
						if(betOnEN[d] == "QIMA_ODD"){
							betTypeCNArr.push(betType_QM1_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "QIMA_EVEN"){
							betTypeCNArr.push(betType_QM2_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "QIMA_BIG"){
							betTypeCNArr.push(betType_QM3_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "QIMA_SMALL"){
							betTypeCNArr.push(betType_QM4_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "ZHENGMA_A"||betOnEN[d] == "ZHENGMA_B"){
							betTypeCNArr.push(betType_ZM_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "TEMA_TOU"){
							betTypeCNArr.push(betType_TMTOU_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "TEMA_WEI"||betOnEN[d] == "WEISHU_Y"||betOnEN[d] == "WEISHU_N"||betOnEN[d] == "WEISHULIAN_Y_2"||betOnEN[d] == "WEISHULIAN_Y_3"
								||betOnEN[d] == "WEISHULIAN_Y_4"||betOnEN[d] == "WEISHULIAN_N_2"||betOnEN[d] == "WEISHULIAN_N_3"||betOnEN[d] == "WEISHULIAN_N_4"){
							betTypeCNArr.push(betType_TMWEI_CN[(betTypeArr[j])]);
						}else if(betOnEN[d] == "WUXING"){
							betTypeCNArr.push(betType_WH_CN[(betTypeArr[j])]);
						}else{
							betTypeCNArr.push(betType_NO_CN[(betTypeArr[j])]);
						}
						}
					betOnCN = betOn_NO_CN[betOn];
					shortPromptrun("下注失败，注单     "+betOnCN+":"+betTypeCNArr+"     "+betMoyne+"大于单号最高下注金额!",null);
					//Enternum = 0;
					return false;
			}
//			if(betMoyne > userMaxterm){
//				shortPrompt("下注失败，下注金额大于单项最高！",1);
//				return false;
//			}
		}
	}
		return true;
}

	

//提示框效果
function shortPrompt(contentTtxt,timeval){
	art.dialog({
		title:'提示：',
		fixed: true,
		lock: true,
		background: '#000000', // 背景色
		opacity: 0.7,	// 透明度
		content:"<div style = 'padding: 0px 30px;font-weight: bold;font-size: 15px;text-align: center;line-height:40px;'>"+contentTtxt+"</div>",
		time:timeval
	});
}

function shortPromptrun(contentTtxt,timeval){
	art.dialog({
		title:'提示：',
		fixed: true,
		lock: true,
		background: '#000000', // 背景色
		opacity: 0.7,	// 透明度
		content:"<div style = 'padding: 0px 30px;font-weight: bold;font-size: 15px;text-align: center;line-height:40px;'>"+contentTtxt+"</div>",
		time:timeval
	});
	$("span[id = 'UserReturnMain']").click();
}

//赔率变动是否适应
function shwoZhudan(contentTtxt){
	art.dialog({
		title:'提示：',
		fixed: true,
		lock: true,
		background: '#000000', // 背景色
		opacity: 0.7,	// 透明度
		content:"<div style = 'padding: 0px 30px;font-weight: bold;font-size: 15px;text-align: center;line-height:40px;'>"+contentTtxt+"</div>",
		ok:function(){
			submitData(betlistval,true);
			return true; 
		},
		cancel: function(){
	    }
	});
}

//返回首页面提示框效果
function mainshortPrompt(contentTtxt,timeval){
	art.dialog({
		id: 'testID2',
		title:'提示：',
		fixed: true,
		lock: true,
		background: '#000000', // 背景色
		opacity: 0.7,	// 透明度
		content:"<div style = 'padding: 0px 30px;font-weight: bold;font-size: 15px;text-align: center;line-height:40px;'>"+contentTtxt+"</div>",
//		time:timeval,
		ok:function(){
			var  url  = $("input[id ='mainPath']").val();
				if(url == "" || url == null){
					var u = navigator.userAgent, app = navigator.appVersion;
					var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
					var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
					if(isAndroid){
						window.history.go(-1);
					}if(isiOS){
						window.close();
					}else{
						window.close();
					}
				}else{
					top.location  = url;
				}
		}
	});
}

