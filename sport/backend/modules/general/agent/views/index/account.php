<?php
use yii\widgets\LinkPager;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>代理结算</title>
    </head>
    <body>
  
        
        <div class="pro_title pd10">
                   代理管理：查看结算明细
              </div>
        <form  name="form2" method="post" action="" style="margin:0 0 0 0;">
     
                            <table width="100%"  class="font13n dailis skintable">       <tbody><tr  class="t-title dailitr" align="center">
                                        <td width="15%" height="20"><strong>代理名</strong></td>
                                        <td width="12%"><strong>流水总额</strong></td>
                                        <td width="12%"><strong>盈利总额</strong></td>
                                        <td width="12%"><strong>分成比例%</strong></td>
                                        <td width="12%"><strong>算结金额</strong></td>
                                        <td width="11%"><strong>结算开始日期</strong></td>
                                        <td width="11%"><strong>结算结束日期</strong></td>
                                        <td width="15%"><strong>操作时间</strong></td>
                                    </tr>
                                    <?php
                                    if($account_list){
                                        foreach ($account_list as $key => $value) {
                                    ?>
                                    <tr align="center" onmouseover="this.style.backgroundColor =' #EBEBEB'" onmouseout="this.style.backgroundColor =' #ffffff'" style="background-color: rgb(255, 255, 255);">
                                        <td style="height: 35px;"><?php echo $value['agents_name']?></td>
                                        <td><?php echo $value['ledger']?></td>
                                        <td><?php echo $value['profig']?></td>
                                        <td><?php echo $value['ratio']?></td>
                                        <td><?php echo $value['money']?></td>
                                        <td><?php echo $value['s_time']?></td>
                                        <td><?php echo $value['e_time']?></td>
                                        <td><?php echo $value['do_time']?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    
                                    ?>
                                    <tr>
                                        <td colspan="8">  <?php 
                            if($account_list){
                                echo LinkPager::widget(['pagination' => $pages]); 
                            }
                            ?></td>
                                    </tr>
                                </tbody>
                            </table>
                          
                     
        </form>
    </body>
</html>