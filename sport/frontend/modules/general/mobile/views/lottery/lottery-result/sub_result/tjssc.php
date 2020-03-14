<?php 
use yii\helpers\Html;
use app\modules\lottery\modules\lzpk10\util\BallUtil;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <title>开奖结果</title>
    <link href="/public/aomen/css/style.css" rel="stylesheet" />
    <link href="/public/aomen/css/result.css" rel="stylesheet" />
    <script src="/public/jquery/jquery-1.8.3.min.js"></script>
    <script language="javascript">
    function queryLottery(){
        var timeParam = $("#s_time").val();
        if(!timeParam){
            alert("请选择日期。");
            return false;
        }
        return true;
    }
	</script>
</head>
<style>
html,body{height: 100vh;overflow:hidden;}
.runner{float: right; width: 30%;}
.dragonTiger{width: 50%;}
.lottery_serch{padding:0;}
.content_frame{position: relative;height: 0;padding-bottom: 90vh;}
#frame{position: absolute;width: 98%; height: 100%; padding: 0 1%;}
.content_title{width:100%;text-align: center; z-index: 2;font-size: 16px; }

</style>
<body>
    <section class="back f20em"><a href="javascript:history.back(-1)" class="go-back">&lt;</a>开奖结果</section>
    <div class="pdcenter pdbottom10">
        <form name="Frm_search_drawno"  id="Frm_search_drawno" method="get" onSubmit="return queryLottery();" method="get" action="index.php">
            <input name="qishu_query" type="hidden" value="<?=Html::encode($qishu_query);?>"/>
            <input name="s_time" type="hidden" value="<?=Html::encode($query_time);?>"/>
            <input name="r" type="hidden" value="mobile/lottery/lottery-result/index" />
            <div class="lottery_serch">
                <!-- 隱藏option、开奖期号 -->
                <div class="qihao" style="display:none;">
                        <select name="gtype" id="gtype">
                            <option value="D3"    <?=Html::encode($lotterytype)=='D3' ? 'selected' : ''?>>3D彩</option>
                            <option value="P3"    <?=Html::encode($lotterytype)=='P3' ? 'selected' : ''?>>排列三</option>
                            <option value="T3"    <?=Html::encode($lotterytype)=='T3' ? 'selected' : ''?>>上海时时乐</option>
                            <option value="CQ"    <?=Html::encode($lotterytype)=='CQ' ? 'selected' : ''?>>重庆时时彩</option>
                            <option value="TJ"    <?=Html::encode($lotterytype)=='TJ' ? 'selected' : ''?>>极速时时彩</option>
                            <option value="GDSF"  <?=Html::encode($lotterytype)=='GDSF' ? 'selected' : ''?>>广东十分彩</option>
                            <option value="GXSF"  <?=Html::encode($lotterytype)=='GXSF' ? 'selected' : ''?>>广西十分彩</option>
                            <option value="TJSF"  <?=Html::encode($lotterytype)=='TJSF' ? 'selected' : ''?>>天津十分彩</option>
                            <option value="CQSF"  <?=Html::encode($lotterytype)=='CQSF' ? 'selected' : ''?>>重庆十分彩</option>
                            <option value="BJKN"  <?=Html::encode($lotterytype)=='BJKN' ? 'selected' : ''?>>北京快乐8</option>
                            <option value="BJPK"  <?=Html::encode($lotterytype)=='BJPK' ? 'selected' : ''?>>北京PK拾</option>
                            <option value="ORPK"  <?=Html::encode($lotterytype)=='ORPK' ? 'selected' : ''?>>老PK拾</option>
                            <option value="GD11"  <?=Html::encode($lotterytype)=='GD11' ? 'selected' : ''?>>广东11选5</option>
                            <option value="SSRC"  <?=Html::encode($lotterytype)=='SSRC' ? 'selected' : ''?>>极速赛车</option>
                            <option value="MLAFT"  <?=Html::encode($lotterytype)=='MLAFT' ? 'selected' : ''?>>幸运飞艇</option>  
                            <option value="TS"  <?=Html::encode($lotterytype)=='TS' ? 'selected' : ''?>>腾讯分分彩</option>
                        </select>
                    <label>
                        开奖期号：
                        <input name="qishu_query" type="text" id="qishu_query" value="<?=Html::encode($qishu_query);?>" size="20" maxlength="11"/>
                </div>
        </form>
    </div>
    <div class="content_frame">
        <iframe id="frame" src="/public/lottery_result/tjssc/index.html" width="100%" height="100%" frameborder="0" scrolling="yes"></iframe>
    </div>
</body>
</html>
