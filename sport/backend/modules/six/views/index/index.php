<?php use yii\widgets\LinkPager;?>

<div class="pro_title ">
         六合彩注单查询(按用户)
</div>
            <form action="#/six/index/index" id="gridSearchForm" method="post" name="form1">       
                <div class="trinput inputct pd10">
                       <div class="mgauto middle">
                        <select id="status" name="status">
                            <?php
                            foreach ($status as $key=>$val){?>
                                    <option value="<?=$key;?>" <?php if($statu==$key) echo 'selected';?>><?=$val;?></option>
                            <?php } ?>
                        </select>
                        会员：<input id="user_name" type="text" size="15" value="<?=$user;?>" name="user_name">
                        日期：<input id="start_time" name="start_time" type="text" value="<?=$startTime;?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                        ~
                        <input id="end_time" name="end_time" type="text" value="<?=$endTime;?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                        期数：
                        <input id="qishu" type="text" size="15" value="<?=$qishu;?>" name="qishu">
                        <select name="excludegroup" id="excludegroup">
                            <option value="0" style="color:#FF9900;" <?= $excludegroup == '0' ? 'selected' : '' ?>>全部会员组</option>
                            <option value="1" style="color:#FF0000;" <?= $excludegroup == '1' ? 'selected' : '' ?>>排除测试会员组</option>
                         </select>
                         <input id="sort_data" name="sort" type="hidden" size="15" value="<?=$sort?>" >
                        <input type="button" id="gridSearchBtn" name="Submit" value="搜索" />
                       </div>
                </div>
            </form>
            <table class="font12 skintable line35" width="100%" cellspacing="1" cellpadding="5" >
                <tbody>
                <tr class="dailitr">
                    <td  align="center" >
                        <strong>游戏名称</strong>
                    </td>
                    <td align="center" >
                        <strong>用户名(真实名字)</strong>
                    </td>
                    <td align="center" >
                        <strong>下注笔数</strong>
                    </td>
                    <td align="center" >
                        <strong>下注金额</strong>
                    </td>
                    <td align="center">
                        <strong>下注结果</strong>
                    </td>
                    <td align="center" >
                    <?php if(empty($sort)){ ?>
                        <strong title="点击排序" onclick="setSort('win_total;desc')">赢取金额</strong>
                        <i class="fa fa-arrows-v"></i>
                    <?php } else if ($sort == 'win_total;desc') { ?>
                        <strong title="点击排序" onclick="setSort('win_total;asc')">赢取金额</strong>
                        <i class="fa fa-arrow-up"></i>
                    <?php } else if ($sort == 'win_total;asc') { ?>
                        <strong title="点击排序" onclick="setSort('')">赢取金额</strong>
                        <i class="fa fa-arrow-down"></i>
                    <?php } ?>
                    </td>
                </tr>
                <?php
                $winMoney = $betMoney = 0;
                if($list){
                    foreach ($list as $key=>$val){?>
                        <tr align="center" style="background-color: rgb(255, 255, 255); line-height: 20px;" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBEBEB'">
                            <td valign="middle" height="40" align="center">六合彩</td>
                            <td valign="middle" align="center">
                                <a href="#/six/index/order&user_name=<?=$val['user_name']?>&start_time=<?=urlencode($startTime);?>&end_time=<?=urlencode($endTime);?>&qishu=<?=$qishu;?>&status=<?=$statu;?>" style="color: #F37605;" title="<?=$val['user_name']?>"><?=$val['user_name']?></a>(<?=$val['pay_name']?>)
                            </td>
                            <td valign="middle" align="center"><?=$val['bet_count']?></td>
                            <td valign="middle" align="center"><?=$val['bet_money_total']; $betMoney+=$val['bet_money_total'];?></td>
                            <td valign="middle" align="center"><?=$val['win_total'];?></td>
                            <td valign="middle" align="center" style="color:<?= $val['bet_money_total']-$val['win_total']>0? "red":'';?>"><?=$val['win_total']-$val['bet_money_total'];$winMoney+=$val['bet_money_total']-$val['win_total']-$val['draw_money'];?></td>
                        </tr>
                <?php }
                }?>
                <tr>
                    <td valign="middle" align="center" colspan="6">当前页总投注金额:<?=$betMoney;?>元   当前页赢取金额:<?=$winMoney;?>元</td>
                </tr>
                
                <tr>
                    <td colspan="6" class="border0"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
                </tr>
                <script>
                    function setSort(sortdata) {

                        $("#sort_data").val(sortdata);

                        location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
                    }
                </script>
                </tbody>
            </table>
            
