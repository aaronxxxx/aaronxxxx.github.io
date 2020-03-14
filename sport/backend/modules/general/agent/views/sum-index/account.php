<?php
use yii\widgets\LinkPager;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>總代理結算</title>
    </head>
    <body>
  
        
        <div class="pro_title pd10">
                   總代理管理：查詢結算明細
              </div>
        <form  name="form2" method="post" action="" style="margin:0 0 0 0;">
     
                            <table width="100%"  class="font13n dailis skintable">       
                                <tbody>
                                    <tr  class="t-title dailitr" align="center">
                                        <td width="12%" height="20"><strong>總代理名稱</strong></td>
                                        <td width="10%"><strong>流水總額</strong></td>
                                        <td width="10%"><strong>盈利總額</strong></td>
                                        <td width="10%"><strong>分成比例%</strong></td>
                                        <td width="10%"><strong>盈利結算</strong></td>
                                        <td width="10%"><strong>退水結算</strong></td>
                                        <td width="10%"><strong>總結金額</strong></td>
                                        <td width="10%"><strong>結算日期</strong></td>
                                        <td width="15%"><strong>操作時間</strong></td>
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
                                        <td><?php echo $value['profig'] * ((100-($value['ratio']))/100)?></td>
                                        <td><?php echo $value['ledger'] * ($value['refund_scale']/100) * ($value['ratio']/100)?></td>
                                        <td><?php echo $value['money']?></td>
                                        <td><?php echo $value['s_time']?></td>
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