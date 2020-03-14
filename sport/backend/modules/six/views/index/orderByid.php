<?php use yii\widgets\LinkPager;?>


                
                <div class="pro_title pd10">六合彩注单</div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
                    <tbody><tr class="dailitr">
                        <td align="center"><strong>子订单号</strong></td>
                        <td align="center"><strong>彩票类别</strong></td>
                        <td align="center"><strong>彩票期号</strong></td>
                        <td align="center"><strong>投注玩法</strong></td>
                        <td align="center"><strong>投注内容</strong></td>
                        <td align="center"><strong>投注金额</strong></td>
                        <td align="center"><strong>反水</strong></td>
                        <td align="center"><strong>赔率</strong></td>
                        <td align="center"><strong>可赢金额</strong></td>
                        <td align="center"><strong>输赢结果</strong></td>
                        <td align="center"><strong>投注时间</strong></td>
                        <td align="center"><strong>投注账号</strong></td>
                        <td align="center"><strong>状态</strong></td>
                    </tr>
                    <?php
                    $betMoney = $winMoney = 0;
                    if($list){
                        foreach ($list as $key=>$val){?>
                            <tr align="center">
                                <td height="25" align="center" valign="middle"><?=$val['order_sub_num'];?></td>
                                <td align="center" valign="middle">六合彩</td>
                                <td align="center" valign="middle"><?=$val['qishu'];?></td>
                                <td align="center" valign="middle"><?=$val['rtype_str']?></td>
                                <td align="center" valign="middle" style="max-width:115px"><?=$val['number'];?></td>
                                <td align="center" valign="middle"><?=$val['bet_money'];$betMoney+=$val['bet_money'];?></td>
                                <td align="center" valign="middle"><?=$val['fs'];?></td>
                                <td align="center" valign="middle"><?=$val['bet_rate'];?></td>
                                <td align="center" valign="middle"><?=$val['win_sub'];?></td>
                                <td align="center" valign="middle" style="color:<?= $val['is_win']==1? "red":'';?>">
                                    <?php if($val['status']==1 || $val['status']==2){
                                        if($val['is_win']==1){
                                            echo '-'.$val['is_win_total'];$winMoney -=$val['is_win_total'];
                                        }else{
                                            echo $val['bet_money'];$winMoney +=$val['is_win_total'];
                                        }
                                    }else{
                                        echo 0;
                                    }?></td>
                                <td ><?=$val['bet_time'];?></td>
                                <td><?=$val['user_name'];?></td>
                                <td >
                                    <font color="#0000FF" data="<?=$val['status'];?>"><?=$status[$val['status']];?></font>
                                </td>
                            </tr>
                    <?php  }
                    }?>
                    <tr class="ctinfo">
                        <td valign="middle" align="center" colspan="15">当前页总投注金额:<?=$betMoney;?>元    当前页赢取金额:<?=$winMoney;?>元</td>
                    </tr>
                    </tbody>
                </table>
                <?= LinkPager::widget(['pagination' => $pages]);?>
         