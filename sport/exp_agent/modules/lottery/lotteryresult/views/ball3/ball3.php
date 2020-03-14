<?php
use yii\widgets\LinkPager;
require("public/lottery/Js_Class.php");
?>
<script language="javascript" src="/public/lottery/js/result_ball5.js"></script>
<form name="form1" method="post" id="form1" action="?r=lotteryresult/ball3/operation&id=<?=$id?>&action=<?=$id>0 ? 'edit' : 'add'?>&type=<?=$lottery_type?>&s_time=<?=$query_time?>&qishu_query=<?=$qishu_query?>">
<div class=" trinput resulttable zudan tabft13 spanmg0">

<p>
    <span>彩票类别：</span>
    <span><strong><?=$_GET['type']?></strong></span>
</p>
<p>
    <span>开奖期号：</span>
    <span><input name="qishu" type="text" onchange="if(/\D/.test(this.value)){layer.alert('期号只能输入数字');this.value='';return false;}" id="qishu" value="<?php if(isset($lists) && count($lists) > 0){echo $lists['0']['qishu'];}?>" size="20" maxlength="16"/></span>
</p>
<p>
    <span>开奖时间：</span>
   <span><input name="datetime" type="text" id="datetime"  class="date_day_time" value="<?php if(isset($lists) && count($lists) > 0){echo $lists['0']['datetime'];}?>" size="20" maxlength="19"/> 注意：时间格式务必填写正确，如2014-10-10 10:10:10</span>
</p>
<p>
    <span>开奖号码：</span>
   <span><select name="ball_1" id="ball_1">
            <option value="0" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 0){echo 'selected';};}?>>0</option>
            <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 1){echo 'selected';};}?>>1</option>
            <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 2){echo 'selected';};}?>>2</option>
            <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 3){echo 'selected';};}?>>3</option>
            <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 4){echo 'selected';};}?>>4</option>
            <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 5){echo 'selected';};}?>>5</option>
            <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 6){echo 'selected';};}?>>6</option>
            <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 7){echo 'selected';};}?>>7</option>
            <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 8){echo 'selected';};}?>>8</option>
            <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == 9){echo 'selected';};}?>>9</option>
            <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] == ''){echo 'selected';};}?>>第一球</option>
        </select>
        <select name="ball_2" id="ball_2">
            <option value="0" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 0){echo 'selected';};}?>>0</option>
            <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 1){echo 'selected';};}?>>1</option>
            <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 2){echo 'selected';};}?>>2</option>
            <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 3){echo 'selected';};}?>>3</option>
            <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 4){echo 'selected';};}?>>4</option>
            <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 5){echo 'selected';};}?>>5</option>
            <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 6){echo 'selected';};}?>>6</option>
            <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 7){echo 'selected';};}?>>7</option>
            <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 8){echo 'selected';};}?>>8</option>
            <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == 9){echo 'selected';};}?>>9</option>
            <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2'] == ''){echo 'selected';};}?>>第二球</option>
        </select>
        <select name="ball_3" id="ball_3">
            <option value="0" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 0){echo 'selected';};}?>>0</option>
            <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 1){echo 'selected';};}?>>1</option>
            <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 2){echo 'selected';};}?>>2</option>
            <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 3){echo 'selected';};}?>>3</option>
            <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 4){echo 'selected';};}?>>4</option>
            <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 5){echo 'selected';};}?>>5</option>
            <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 6){echo 'selected';};}?>>6</option>
            <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 7){echo 'selected';};}?>>7</option>
            <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 8){echo 'selected';};}?>>8</option>
            <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == 9){echo 'selected';};}?>>9</option>
            <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3'] == ''){echo 'selected';};}?>>第三球</option>
        </select>
    </span>
</p>
<p>
  
    <input type="hidden"  name="sub" value="确认发布">
   <span><input type="button" class="form_ajax_submit_btn mgl61" data-targetid="form1" data-redirect="#/lotteryresult/ball3/list&status=0&type=<?=$_GET['type']?>&<?=time()?>"  name="submit" value="确认发布"></span>
</p>
</div>
</form>

<form name="form2" id="gridSearchForm" method="get" action="#/lotteryresult/ball3/list">
    <input name="type" type="hidden" value="<?= $_GET['type']?>" />
    <input name="p" type="hidden" value="1" />
  <div class="tabft13 trinput resulttable zudan pd10">
        <div align="left">
          开奖期号：
            <input name="qishu_query" type="text" id="qishu_query" value="<?php if(isset($_GET['qishu_query'])){echo $_GET['qishu_query'];} ?>" size="20" maxlength="11"/>
            &nbsp;&nbsp;日期：
            <input name="s_time" type="text" id="s_time" value="<?php if(isset($_GET['s_time'])){echo $_GET['s_time'];}  ?>"  class="date_day"  size="10" maxlength="10" placeholder="日期不为空" readonly="readonly" />
            <input name="submit" type="button" id="gridSearchBtn" class="submit80" value="搜索"/>
          </div>
    </div>
</form>
<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
    <tr class="namecolor">
        <td align="center"><strong>彩票类别</strong></td>
        <td align="center"><strong>彩票期号</strong></td>
        <td align="center"><strong>开奖时间</strong></td>
        <td align="center"><strong>第一球</strong></td>
        <td align="center"><strong>第二球</strong></td>
        <td align="center"><strong>第三球</strong></td>
        <td align="center"><strong>总和</strong></td>
        <td align="center"><strong>龙虎</strong></td>
        <td align="center"><strong>三连</strong></td>
        <td align="center"><strong>跨度</strong></td>
        <td align="center"  height="25">结算</td>
        <td align="center"><strong>重算</strong></td>
        <td align="center"><strong>操作</strong></td>
    </tr>
        <?php
        if(isset($rows) && count($rows) > 0){
            foreach($rows as $key =>$val){
                $hm 		= array();
                $hm[]		= BuLing($val['ball_1']);
                $hm[]		= BuLing($val['ball_2']);
                $hm[]		= BuLing($val['ball_3']);
        ?>
        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#fff'" style="background-color:rgb(255, 255, 255); line-height:20px;">
            <td height="25" align="center" valign="middle"><?=$_GET['type']?></td>
            <td align="center" valign="middle"><?= $val['qishu']?></td>
            <td align="center" valign="middle"><?= $val['datetime']?></td>
            <td align="center" valign="middle"><img src="/public/lottery/images/ball_5/<?=$val['ball_1']?>.png"></td>
            <td align="center" valign="middle"><img src="/public/lottery/images/ball_5/<?=$val['ball_2']?>.png"></td>
            <td align="center" valign="middle"><img src="/public/lottery/images/ball_5/<?=$val['ball_3']?>.png"></td>
            <td><?=f3D_Auto($hm,1)?> / <?=f3D_Auto($hm,2)?> / <?=f3D_Auto($hm,3)?></td>
            <td><?=f3D_Auto($hm,4)?></td>
            <td><?=f3D_Auto($hm,5)?></td>
            <td><?=f3D_Auto($hm,6)?></td>
            <td class="js_type" qihao="<?= $val['qishu']?>"><?php
                    if($val['state']==0){
                        echo '<a href="#" title="点击结算"><font color="#0000FF">未结算</font></a>';
                    }else{
                        echo '<a href="#" title="重新结算"><font color="#FF0000">已结算</font></a>';
                    }
                ?></td>
            <td><?php
                if($val['state']==2){
                    echo '<font color="#FF0000" style="font-size:18px">√</font>';
                }else{
                    echo '<font color="#0000FF" style="font-size:20px">×</font>';
                }
                ?></td>
            <td>
                <a href="#/lotteryresult/ball3/edit&id=<?=$val['id']?>&type=<?=$lottery_type?>&qishu=<?=$val['qishu']?>" >编辑</a>

                <a onclick='queryResult("<?=$val['id']?>")' title="查看修改记录"><font>查看记录</font></a>
                <input type="hidden" id="<?='prev_text'.$val['id']?>" value="<?=$val['prev_text']?>" />
            </td>
        </tr>
    <?php
            }
        }
        ?>
</table>
    <script>
        $(function(){
            var oneClick = true;
            $('.js_type').click(function(){
                if(oneClick){
                    oneClick = false;
                }else{
                    return false;
                }
                $lottery = '<?=$_GET['type']?>';
                var jstype = $(this).find('font').html();
                var qihao = $(this).attr('qihao');
                if(jstype == '未结算'){
                    $jstype="0";
                }else{
                    $jstype="1";
                }
                $qihao = qihao;
                if($lottery == '上海时时乐'){
                    $gtype = 't3';
                }else if($lottery == '排列三'){
                    $gtype = 'p3';
                }else{
                    $gtype = 'd3';
                }
                $jsway = '0';
                $.ajax({
                    'url':'/?r=lotteryresult/index/jiesuan',
                    async:true,
                    type:'POST',
                    data:{'qihao':$qihao,'jstype':$jstype,'gtype':$gtype,'jsway':$jsway},
                    success: function(data){
                        if(data=='0'){
                            alert('结算成功');
                            window.location.href='#/lotteryresult/ball3/list&status=0&type='+$lottery+'&n_time=<?=time();?>';
                        }else if(data == '-1'){
                            layer.alert('结算接口连接异常！');
                        }else if(data == '1'){
                            alert('重算成功');
                            window.location.href='#/lotteryresult/ball3/list&status=0&type='+$lottery+'&n_time=<?=time();?>';
                        }else if(data == '2'){
                            alert('部分结算成功');
                            window.location.href='#/lotteryresult/ball3/list&status=0&type='+$lottery+'&n_time=<?=time();?>';
                        }else if(data == '3'){
                            alert('部分重算成功');
                            window.location.href='#/lotteryresult/ball3/list&status=0&type='+$lottery+'&n_time=<?=time();?>';
                        }
                        else if(data == '4'){
                            alert('结算失败');
                            return false;
                        }else if(data == '5'){
                            alert('重算失败');
                            return false;
                        }else if(data == '6'){
                            alert('无效的参数');
                            return false;
                        }
                        else if(data == '7'){
                            alert('期数修改失败');
                            return false;
                        }
                        else if(data == '8'){
                            alert('注单不存在');
                            window.location.href='#/lotteryresult/ball3/list&status=0&type='+$lottery+'&n_time=<?=time();?>';
                        }else if(data == '9'){
                            alert('正在结算');
                            return false;
                        }
                        oneClick = true;
                    }
                });
                return false;
            })
        })
    </script>
<?= LinkPager::widget(['pagination' => $pages]); ?>