<?php
use yii\widgets\LinkPager;
require("public/lottery/Js_Class.php");
?>
<script language="javascript" src="/public/lottery/js/result_bjkl8.js"></script>
    <form name="form1" id="form1" method="post" action="?r=lotteryresult/bjkl8/operation&id=<?=$id?>&action=<?=$id>0 ? 'edit' : 'add'?>&s_time=<?=$query_time?>&qishu_query=<?=$qishu_query?>">
        <div class=" trinput  zudan tabft13 spanmg0">
            <p>
                <span>彩票类别：</span>
                <span><strong>北京快乐8</strong></span>
            </p>
            <p>
                <span>开奖期号：</span>
                <span><input name="qishu" type="text" onchange="if(/\D/.test(this.value)){layer.alert('期号只能输入数字');this.value='';return false;}" id="qishu" value="<?php if(isset($lists) && count($lists) > 0){echo $lists['0']['qishu'];}?>" size="20" maxlength="16"/></span>
            </p>
            <p>
                <span>开奖时间：</span>
               <span><input name="datetime" class="date_day_time" type="text" id="datetime" value="<?php if(isset($lists) && count($lists) > 0){echo $lists['0']['datetime'];}?>" size="20" maxlength="19"/> 注意：时间格式务必填写正确，如2014-10-10 10:10:10</span>
            </p>
            <p>
                <span>开奖号码：</span>
               <span><select name="ball_1" id="ball_1">
                       <?php
                       for($i=1;$i<81;$i++){
                           if(isset($lists) && $lists['0']['ball_1'] == $i){
                               echo "<option value=".$i." selected>".$i."</option>";
                           }else{
                               echo "<option value=".$i.">".$i."</option>";
                           }
                       }
                       ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==''  ){echo 'selected';};}?>>第一球</option>
                    </select>
                    <select name="ball_2" id="ball_2">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_2'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']=='' ){echo 'selected';};}?>>第二球</option>
                    </select>
                    <select name="ball_3" id="ball_3">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_3'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']=='' ){echo 'selected';};}?>>第三球</option>
                    </select>
                    <select name="ball_4" id="ball_4">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_4'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']=='' ){echo 'selected';};}?>>第四球</option>
                    </select>
                    <select name="ball_5" id="ball_5">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_5'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']=='' ){echo 'selected';};}?>>第五球</option>
                    </select>
                    <select name="ball_6" id="ball_6">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_6'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']=='' ){echo 'selected';};}?>>第六球</option>
                    </select>
                    <select name="ball_7" id="ball_7">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_7'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']=='' ){echo 'selected';};}?>>第七球</option>
                    </select>
                    <select name="ball_8" id="ball_8">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_8'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']=='' ){echo 'selected';};}?>>第八球</option>
                    </select>
                    <select name="ball_9" id="ball_9">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_9'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']=='' ){echo 'selected';};}?>>第九球</option>
                    </select>
                    <select name="ball_10" id="ball_10">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_10'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']=='' ){echo 'selected';};}?>>第十球</option>
                    </select>
                    <select name="ball_11" id="ball_11">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_11'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_11']=='' ){echo 'selected';};}?>>第十一球</option>
                    </select>
                    <select name="ball_12" id="ball_12">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_12'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_12']=='' ){echo 'selected';};}?>>第十二球</option>
                    </select>
                    <select name="ball_13" id="ball_13">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_13'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_13']=='' ){echo 'selected';};}?>>第十三球</option>
                    </select>
                    <select name="ball_14" id="ball_14">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_14'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_14']=='' ){echo 'selected';};}?>>第十四球</option>
                    </select>
                    <select name="ball_15" id="ball_15">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_15'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_15']=='' ){echo 'selected';};}?>>第十五球</option>
                    </select>
                    <select name="ball_16" id="ball_16">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_16'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_16']=='' ){echo 'selected';};}?>>第十六球</option>
                    </select>
                    <select name="ball_17" id="ball_17">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_17'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_17']=='' ){echo 'selected';};}?>>第十七球</option>
                    </select>
                    <select name="ball_18" id="ball_18">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_18'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_18']=='' ){echo 'selected';};}?>>第十八球</option>
                    </select>
                    <select name="ball_19" id="ball_19">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_19'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_19']=='' ){echo 'selected';};}?>>第十九球</option>
                    </select>
                    <select name="ball_20" id="ball_20">
                        <?php
                        for($i=1;$i<81;$i++){
                            if(isset($lists) && $lists['0']['ball_20'] == $i){
                                echo "<option value=".$i." selected>".$i."</option>";
                            }else{
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_20']=='' ){echo 'selected';};}?>>第二十球</option>
                    </select>
                </span>
            </p>
            <p>
                <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
            </p>
            <p>

                <input type="hidden"  name="sub" value="确认发布">
               <span><input type="button" class="form_ajax_submit_btn mgl61" data-targetid="form1" data-redirect="#/lotteryresult/bjkl8/list&status=0&type=type=北京快乐8&<?=time()?>" name="submit" value="确认发布"></span>
            </p>
        </div>
    </form>
    <form name="form2" onSubmit="return queryLottery();" method="get" id="gridSearchForm" action="#/lotteryresult/bjkl8/list">
            <input name="p" type="hidden" value="1" />
           <div class="tabft13 trinput  zudan pd10">
                <div align="left">
                  开奖期号：
                    <input name="qishu_query" type="text" id="qishu_query" value="<?php if(isset($_GET['qishu_query'])){echo $_GET['qishu_query'];} ?>" size="20" maxlength="11"/>
                    日期：
                    <input name="s_time" type="text" id="s_time" value="<?php if(isset($_GET['s_time'])){echo $_GET['s_time'];}  ?>"  class="date_day" size="10" maxlength="10" placeholder="日期不为空" readonly="readonly" />
                    <input name="n_time" type="hidden" value="<?= date('y-m-d h:i:s',time());  ?>"  />
                    <input name="submit" type="button" id="gridSearchBtn" class="submit80" value="搜索"/>
                </div>
            </div>

    </form>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
        <tr class="namecolor">
            <td align="center"><strong>彩票类别</strong></td>
            <td align="center"><strong>彩票期号</strong></td>
            <td align="center"><strong>开奖时间</strong></td>
            <td align="center"><strong>一</strong></td>
            <td align="center"><strong>二</strong></td>
            <td align="center"><strong>三</strong></td>
            <td align="center"><strong>四</strong></td>
            <td align="center"><strong>五</strong></td>
            <td align="center"><strong>六</strong></td>
            <td align="center"><strong>七</strong></td>
            <td align="center"><strong>八</strong></td>
            <td align="center"><strong>九</strong></td>
            <td align="center"><strong>十</strong></td>
            <td align="center"><strong>十一</strong></td>
            <td align="center"><strong>十二</strong></td>
            <td align="center"><strong>十三</strong></td>
            <td align="center"><strong>十四</strong></td>
            <td align="center"><strong>十五</strong></td>
            <td align="center"><strong>十六</strong></td>
            <td align="center"><strong>十七</strong></td>
            <td align="center"><strong>十八</strong></td>
            <td align="center"><strong>十九</strong></td>
            <td align="center"><strong>二十</strong></td>
            <td align="center"><strong>大小</strong></td>
            <td align="center"><strong>单双</strong></td>
            <td align="center"><strong>奇偶</strong></td>
            <td align="center"><strong>上下</strong></td>
            <td align="center"><strong>总和</strong></td>
            <td align="center">结算</td>
            <td align="center"><strong>重算</strong></td>
            <td align="center"><strong>操作</strong></td>
        </tr>
        <?php
        if(isset($rows) && count($rows) > 0){
            foreach($rows as $key =>$val){
                $hm 		= array();
                $hm[]		= $val['ball_1'];
                $hm[]		= $val['ball_2'];
                $hm[]		= $val['ball_3'];
                $hm[]		= $val['ball_4'];
                $hm[]		= $val['ball_5'];
                $hm[]		= $val['ball_6'];
                $hm[]		= $val['ball_7'];
                $hm[]		= $val['ball_8'];
                $hm[]		= $val['ball_9'];
                $hm[]		= $val['ball_10'];
                $hm[]		= $val['ball_11'];
                $hm[]		= $val['ball_12'];
                $hm[]		= $val['ball_13'];
                $hm[]		= $val['ball_14'];
                $hm[]		= $val['ball_15'];
                $hm[]		= $val['ball_16'];
                $hm[]		= $val['ball_17'];
                $hm[]		= $val['ball_18'];
                $hm[]		= $val['ball_19'];
                $hm[]		= $val['ball_20'];
                ?>
                <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#fff'" style="background-color:rgb(255, 255, 255); line-height:20px;">
                    <td height="25" align="center" valign="middle">北京快乐8</td>
                    <td align="center" valign="middle"><?=$val['qishu']?></td>
                    <td align="center" valign="middle"><?=$val['datetime']?></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_1']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_2']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_3']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_4']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_5']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_6']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_7']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_8']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_9']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_10']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_11']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_12']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_13']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_14']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_15']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_16']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_17']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_18']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_19']?>.png"></td>
                    <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjkl8/<?=$val['ball_20']?>.png"></td>
                    <td><?=Kl8_convert(Kl8_Auto($hm,2))?></td>
                    <td><?=Kl8_convert(Kl8_Auto($hm,3))?></td>
                    <td><?=Kl8_convert(Kl8_Auto($hm,5))?></td>
                    <td><?=Kl8_convert(Kl8_Auto($hm,4))?></td>
                    <td><?=Kl8_Auto($hm,1)?></td>
                    <td class="js_type" qihao="<?= $val['qishu']?>"><?php
                        if($val['state']==0){
                            echo '<a href="#" title="点击结算"><font color="#0000FF">未结算</font></a>';
                        }else{
                            echo '<a href="#" title="重新结算"><font color="#FF0000">已结算</font></a>';
                        }
                        ?>
                    </td>
                    <td><?php
                        if($val['state']==2){
                            echo '<font color="#FF0000" style="font-size:18px">√</font>';
                        }else{
                            echo '<font color="#0000FF" style="font-size:20px">×</font>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="#/lotteryresult/bjkl8/edit&id=<?=$val['id']?>&qishu=<?= $val['qishu']?>" >编辑</a>
                        <a onclick='queryResult("<?=$val['id']?>")' title="查看修改记录"><font>查看记录</font></a>
                        <input type="hidden" id="<?='prev_text'.$val['id']?>" value="<?=$val['prev_text']?>" />
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
     <?= LinkPager::widget(['pagination' => $pages]); ?>
<script>
    $(function(){
        $('.js_type').click(function(){
            var jstype = $(this).find('font').html();
            var qihao = $(this).attr('qihao');
            if(jstype == '未结算'){
                $jstype="0";
            }else{
                $jstype="1";
            }
            $qihao = qihao;
            $gtype = 'bjkn';
            $jsway = '0';
            $.ajax({
                'url':'/?r=lotteryresult/index/jiesuan',
                async:true,
                type:'POST',
                data:{'qihao':$qihao,'jstype':$jstype,'gtype':$gtype,'jsway':$jsway},
                success: function(data){
                    if(data=='0'){
                        alert('结算成功');
                        window.location.href='#/lotteryresult/bjkl8/list&status=0&type=北京快乐8&n_time=<?=time();?>';
                    }else if(data == '-1'){
                        layer.alert('结算接口连接异常！');
                    }else if(data == '1'){
                        alert('重算成功');
                        window.location.href='#/lotteryresult/bjkl8/list&status=0&type=北京快乐8&n_time=<?=time();?>';
                    }else if(data == '2'){
                        alert('部分结算成功');
                        window.location.href='#/lotteryresult/bjkl8/list&status=0&type=北京快乐8&n_time=<?=time();?>';
                    }else if(data == '3'){
                        alert('部分重算成功');
                        window.location.href='#/lotteryresult/bjkl8/list&status=0&type=北京快乐8&n_time=<?=time();?>';
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
                        window.location.href='#/lotteryresult/index/bjkl8&status=0&type=北京快乐8&n_time=<?=time();?>';
                    }
                }
            });
            return false;
        })
    })
</script>