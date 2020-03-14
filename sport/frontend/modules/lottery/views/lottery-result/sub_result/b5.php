<?php
use yii\helpers\Html;
use app\modules\lottery\modules\lzcqssc\util\BallUtil;

$imgUrl = 'public/luzhu/images';
?>
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
<div id="search_content">
<div class="round-table">
    <form name="Frm_search_drawno"  id="Frm_search_drawno" method="get" onSubmit="return queryLottery();" method="get" action="index.php">
        <input name="qishu_query" type="hidden" value="<?=Html::encode($qishu_query);?>"/>
        <input name="s_time" type="hidden" value="<?=Html::encode($query_time);?>"/>
        <input name="r" type="hidden" value="lottery/lottery-result/index" />
        <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" >
            <tr style="background-color:#FFFFFF;">
                <td align="left">
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
                    &nbsp;&nbsp;开奖期号：
                    <input name="qishu_query" type="text" id="qishu_query" value="<?=Html::encode($qishu_query);?>" size="20" maxlength="11"/>
                    &nbsp;&nbsp;日期：
                    <select name="s_time" id="s_time">
                        <option value="<?=date("Y-m-d")?>"    <?=Html::encode($s_time)==date("Y-m-d") ? 'selected' : ''?>><?=date('Y-m-d')?></option>
                        <option value="<?=date('Y-m-d',strtotime('-1 day'))?>"    <?=Html::encode($s_time)==date('Y-m-d',strtotime('-1 day')) ? 'selected' : ''?>><?=date('Y-m-d',strtotime('-1 day'))?></option>
                        <option value="<?=date('Y-m-d',strtotime('-2 day'))?>"    <?=Html::encode($s_time)==date('Y-m-d',strtotime('-2 day')) ? 'selected' : ''?>><?=date('Y-m-d',strtotime('-2 day'))?></option>
                        <option value="<?=date('Y-m-d',strtotime('-3 day'))?>"    <?=Html::encode($s_time)==date('Y-m-d',strtotime('-3 day')) ? 'selected' : ''?>><?=date('Y-m-d',strtotime('-3 day'))?></option>
                        <option value="<?=date('Y-m-d',strtotime('-4 day'))?>"    <?=Html::encode($s_time)==date('Y-m-d',strtotime('-4 day')) ? 'selected' : ''?>><?=date('Y-m-d',strtotime('-4 day'))?></option>
                        <option value="<?=date('Y-m-d',strtotime('-5 day'))?>"    <?=Html::encode($s_time)==date('Y-m-d',strtotime('-5 day')) ? 'selected' : ''?>><?=date('Y-m-d',strtotime('-5 day'))?></option>
                        <option value="<?=date('Y-m-d',strtotime('-6 day'))?>"    <?=Html::encode($s_time)==date('Y-m-d',strtotime('-6 day')) ? 'selected' : ''?>><?=date('Y-m-d',strtotime('-6 day'))?></option>
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="submit" type="submit" class="submit80" value="搜索"/>
                </td>
            </tr>
        </table>
    </form>
</div>
</div>
<div class="round-table">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:2px;" bgcolor="#798EB9">
        <tr  class="title_tr" style="background-color:#3C4D82; color:#FFF">
            <td align="center"><strong>彩票类别</strong></td>
            <td align="center"><strong>彩票期号</strong></td>
            <td align="center"><strong>开奖时间</strong></td>
            <td align="center"><strong>第一球</strong></td>
            <td align="center"><strong>第二球</strong></td>
            <td align="center"><strong>第三球</strong></td>
            <td align="center"><strong>第四球</strong></td>
            <td height="25" align="center"><strong>第五球</strong></td>
            <td align="center"><strong>总和</strong></td>
            <td align="center"><strong>龙虎</strong></td>
            <td height="25" align="center"><strong>前三/中三/后三</strong></td>
            <td height="25" align="center"><strong>牛牛</strong></td>
        </tr>
        <?php
        $ballutil=new BallUtil();
        $hasRow = "false";
        foreach($rslist as $key=>$rows){
            $hasRow = "true";
            $color = "#FFFFFF";
            $over	 = "#EBEBEB";
            $out	 = "#ffffff";
            $hm 		= array();
            $hm[]		= $ballutil->BuLing($rows['ball_1']);
            $hm[]		= $ballutil->BuLing($rows['ball_2']);
            $hm[]		= $ballutil->BuLing($rows['ball_3']);
            $hm[]		= $ballutil->BuLing($rows['ball_4']);
            $hm[]		= $ballutil->BuLing($rows['ball_5']);

            $niuniu = $ballutil->b5_niuniu($rows['ball_1'],$rows['ball_2'],$rows['ball_3'],$rows['ball_4'],$rows['ball_5']);
            ?>
            <tr   class="R_tr" align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
                <td height="25" align="center" valign="middle"><?=$lottery_name?></td>
                <td align="center" valign="middle"><?=$rows['qishu']?></td>
                <td align="center" valign="middle"><?=$rows['datetime']?></td>
                <td align="center" valign="middle"><img src="<?=$imgUrl?>/Ball_2/<?=$rows['ball_1']?>.png"></td>
                <td align="center" valign="middle"><img src="<?=$imgUrl?>/Ball_2/<?=$rows['ball_2']?>.png"></td>
                <td align="center" valign="middle"><img src="<?=$imgUrl?>/Ball_2/<?=$rows['ball_3']?>.png"></td>
                <td align="center" valign="middle"><img src="<?=$imgUrl?>/Ball_2/<?=$rows['ball_4']?>.png"></td>
                <td align="center" valign="middle"><img src="<?=$imgUrl?>/Ball_2/<?=$rows['ball_5']?>.png"></td>
                <td><?=$ballutil->Ssc_Auto($hm,1)?> / <?=($ballutil->Ssc_Auto($hm,2)=="总和大"?"<span style=\"color: red;\">".$ballutil->Ssc_Auto($hm,2)."</span>":$ballutil->Ssc_Auto($hm,2))?> / <?=($ballutil->Ssc_Auto($hm,3)=="总和双"?"<span style=\"color: red;\">".$ballutil->Ssc_Auto($hm,3)."</span>":$ballutil->Ssc_Auto($hm,3))?></td>
                <td><?=($ballutil->Ssc_Auto($hm,4)=="龙"?"<span style=\"color: red;\">".$ballutil->Ssc_Auto($hm,4)."</span>":$ballutil->Ssc_Auto($hm,4))?></td>
                <td><?=$ballutil->Ssc_Auto($hm,5)?> / <?=$ballutil->Ssc_Auto($hm,6)?> / <?=$ballutil->Ssc_Auto($hm,7)?></td>
                <td><?=$niuniu?> / <?=($ballutil->b5_niuds($niuniu)=="牛双"?"<span style=\"color: red;\">".$ballutil->b5_niuds($niuniu)."</span>":$ballutil->b5_niuds($niuniu))?> / <?=($ballutil->b5_niudx($niuniu)=="牛大"?"<span style=\"color: red;\">".$ballutil->b5_niudx($niuniu)."</span>":$ballutil->b5_niudx($niuniu))?></td>
            </tr>
        <?php
        }
        if($hasRow=="false"){
            ?>
            <tr   class="R_tr" align="center" >
                <td height="25" colspan="11" align="center" valign="middle">暂时没有开奖结果</td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>