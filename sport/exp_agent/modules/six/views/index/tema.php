<div id="pageMain">
 
                <form name="gridSearchForm" id="gridSearchForm" method="get" action="#/six/index/tema">
                    <div class="pro_title pd10"> <span title="六合彩特码报表" class="pro_title">六合彩特码报表</span></div>
                    <div class="trinput font14 ">
                        <p>
                            六合彩期数：
                            <select name="qishu" id="qishu">
                                <?php
                                    foreach ($qishus as $key=>$val){?>
                                        <option value="<?=$val['qishu']?>" <?= $val['qishu']==$qishu ? "selected='selected'":'';?>><?=$val['qishu'];?></option>
                                <?php }?>
                            </select>
                            排序方式：
                            <select name="order" id="order">
                                <option value="number" <?= 'number'==$order ? "selected='selected'":'';?>>号码</option>
                                <option value="bet_money" <?= 'bet_money'==$order ? "selected='selected'":'';?>>投注额</option>
                            </select>
                            <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
                        </p>
                    </div>
           
                </form>
                <table width="100%" border="0" cellpadding="5" cellspacing="1"  class="font14 skintable line35 mgt10">
                    <tbody><tr>
                        <td  align="center" style="width: 15%;"><strong>游戏名称</strong></td>
                        <td align="center" style="width: 16%;"><strong>特码号码</strong></td>
                        <td align="center" style="width: 23%;"><strong>特码A面总金额</strong></td>
                        <td align="center" style="width: 23%;"><strong>特码B面总金额</strong></td>
                        <td align="center" style="width: 23%;"><strong>所有特码总金额</strong></td>
                    </tr>
                    <?php
                    $countSpa = $countSpb= 0;
                    foreach ($data as $key=>$val){?>
                        <tr align="center" onmouseover="this.style.backgroundColor='#EBEBEB'" onmouseout="this.style.backgroundColor='#ffffff'" style="background-color:#FFFFFF; line-height:20px;">
                            <td  align="center" valign="middle">六合彩</td>
                            <td align="center" valign="middle"><?=$val['number'];?></td>
                            <td align="center" valign="middle"><?=isset($val['bet_info']) ? $val['bet_info']:0;?></td>
                            <td align="center" valign="middle"><?=isset($val['SPbside']) ? $val['SPbside']:0;?></td>
                            <td align="center" valign="middle"><?=(isset($val['bet_info']) ? $val['bet_info']:0)+(isset($val['SPbside']) ? $val['SPbside']:0);?></td>
                        </tr>
                    <?php
                        $countSpa += isset($val['bet_info']) ? $val['bet_info']:0;
                        $countSpb += isset($val['SPbside']) ? $val['SPbside']:0;
                    } ?>
                    <tr align="center" onmouseover="this.style.backgroundColor='#EBEBEB'" onmouseout="this.style.backgroundColor='#ffffff'" style="background-color:#FFFFFF; line-height:20px;">
                        <td  align="center" valign="middle">六合彩</td>
                        <td align="center" valign="middle">总计</td>
                        <td align="center" valign="middle"><?=$countSpa;?></td>
                        <td align="center" valign="middle"><?=$countSpb;?></td>
                        <td align="center" valign="middle"><?=$countSpb+$countSpa;?></td>
                    </tr>
                    </tbody>
                </table>
        
</div>