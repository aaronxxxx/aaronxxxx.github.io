<?php
use yii\helpers\Html;
use app\modules\lottery\modules\lzkl8\util\BallUtil;

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
            <td align="center" style="width: 26px;"><strong>一</strong></td>
            <td align="center" style="width: 26px;"><strong>二</strong></td>
            <td align="center" style="width: 26px;"><strong>三</strong></td>
            <td align="center" style="width: 26px;"><strong>四</strong></td>
            <td align="center" style="width: 26px;"><strong>五</strong></td>
            <td align="center" style="width: 26px;"><strong>六</strong></td>
            <td align="center" style="width: 26px;"><strong>七</strong></td>
            <td align="center" style="width: 26px;"><strong>八</strong></td>
            <td align="center" style="width: 26px;"><strong>九</strong></td>
            <td align="center" style="width: 26px;"><strong>十</strong></td>
            <td align="center" style="width: 26px;"><strong>十一</strong></td>
            <td align="center" style="width: 26px;"><strong>十二</strong></td>
            <td align="center" style="width: 26px;"><strong>十三</strong></td>
            <td align="center" style="width: 26px;"><strong>十四</strong></td>
            <td align="center" style="width: 26px;"><strong>十五</strong></td>
            <td align="center" style="width: 26px;"><strong>十六</strong></td>
            <td align="center" style="width: 26px;"><strong>十七</strong></td>
            <td align="center" style="width: 26px;"><strong>十八</strong></td>
            <td align="center" style="width: 26px;"><strong>十九</strong></td>
            <td align="center" style="width: 26px;"><strong>二十</strong></td>
            <td align="center"><strong>大小</strong></td>
            <td align="center"><strong>单双</strong></td>
            <td align="center"><strong>奇偶</strong></td>
            <td align="center"><strong>上下</strong></td>
            <td align="center"><strong>总和</strong></td>
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
            $hm[]		= $rows['ball_1'];
            $hm[]		= $rows['ball_2'];
            $hm[]		= $rows['ball_3'];
            $hm[]		= $rows['ball_4'];
            $hm[]		= $rows['ball_5'];
            $hm[]		= $rows['ball_6'];
            $hm[]		= $rows['ball_7'];
            $hm[]		= $rows['ball_8'];
            $hm[]		= $rows['ball_9'];
            $hm[]		= $rows['ball_10'];
            $hm[]		= $rows['ball_11'];
            $hm[]		= $rows['ball_12'];
            $hm[]		= $rows['ball_13'];
            $hm[]		= $rows['ball_14'];
            $hm[]		= $rows['ball_15'];
            $hm[]		= $rows['ball_16'];
            $hm[]		= $rows['ball_17'];
            $hm[]		= $rows['ball_18'];
            $hm[]		= $rows['ball_19'];
            $hm[]		= $rows['ball_20'];
            ?>
            <tr   class="R_tr kl8" align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
                <td height="25" align="center" valign="middle">北京快乐8</td>
                <td align="center" valign="middle"><?=$rows['qishu']?></td>
                <td align="center" valign="middle"><?=$rows['datetime']?></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_1']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_2']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_3']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_4']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_5']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_6']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_7']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_8']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_9']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_10']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_11']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_12']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_13']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_14']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_15']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_16']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_17']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_18']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_19']?>"></span></td>
                <td align="center" valign="middle"><span id="result<?=$rows['ball_1']?>" class="number num<?=$rows['ball_20']?>"></span></td>
                <td><?=($ballutil->Kl8_convert($ballutil->Kl8_Auto($hm,2))=="总和大"?"<span style=\"color: red;\">".$ballutil->Kl8_convert($ballutil->Kl8_Auto($hm,2))."</span>":$ballutil->Kl8_convert($ballutil->Kl8_Auto($hm,2)))?></td>
                <td><?=($ballutil->Kl8_convert($ballutil->Kl8_Auto($hm,3))=="总和双"?"<span style=\"color: red;\">".$ballutil->Kl8_convert($ballutil->Kl8_Auto($hm,3))."</span>":$ballutil->Kl8_convert($ballutil->Kl8_Auto($hm,3)))?></td>
                <td><?=$ballutil->Kl8_convert($ballutil->Kl8_Auto($hm,5))?></td>
                <td><?=$ballutil->Kl8_convert($ballutil->Kl8_Auto($hm,4))?></td>
                <td><?=$ballutil->Kl8_Auto($hm,1)?></td>
            </tr>
        <?php
        }
        if($hasRow=="false"){
            ?>
            <tr   class="R_tr" align="center" >
                <td height="25" colspan="28" align="center" valign="middle">暂时没有开奖结果</td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>