       
       <script type="text/javascript" language="javascript" src="/public/live/js/live_money.js"></script>
       
        <div id="pageMain">
         
                        <form name="form1" id="form1" method="get" action="index.php" >
                        <div class="font14 trinput">

                            <div class="pro_title pd10">
                                    <input type="hidden" name="r" value="live/order/money" />
                                    查询真人实时余额
                            </div>          
                                <p>
                                    <span>
                                        用户名：<input name="name" value="<?php echo $live_name ?>" style="width: 160px;" type="text" onfocus="this.value=''"> 
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="submit" name="Submit" value="查询" /> 
                                    </span>
                                </p>
                        </div>
                        </form>
                
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" >
                            <tr>
                                <td align="center" width="60"  >平台类型</td>
                                <td align="center" width="110"  >平台账号</td>
                                <td align="center" >当前金额</td>
                            </tr>

                            <?php
                            if (!empty($live_pwd_arr)) {
                            ?>
                            <tr>
                                <td align="center" width="60"  >AG</td>
                                <td align="center" width="110"   id="name_ag"></td>
                                <td align="center"  id="credit_ag"></td>
                            </tr>
                            <tr>
                                <td align="center" width="60"  >AGIN</td>
                                <td align="center" width="110"   id="name_agin"></td>
                                <td align="center"  id="credit_agin"></td>
                            </tr>
                            <tr>
                                <td align="center" width="60"  >BBIN</td>
                                <td align="center" width="110"   id="name_ag_bbin"></td>
                                <td align="center"  id="credit_ag_bbin"></td>
                            </tr>
                            <tr>
                                <td align="center" width="60"  >DS</td>
                                <td align="center" width="110"   id="name_ds"></td>
                                <td align="center"  id="credit_ds"></td>
                            </tr>
                            <tr>
                                <td align="center" width="60"  >OG</td>
                                <td align="center" width="110"   id="name_og"></td>
                                <td align="center"  id="credit_og"></td>
                            </tr>
                            <tr>
                                <td align="center" width="60"  >MG</td>
                                <td align="center" width="110"   id="name_mg"></td>
                                <td align="center"  id="credit_mg"></td>
                            </tr>
<script type="text/javascript">
    function loadUserBalance() {
        if ($('#name_ag') === null || $('#name_agin') === null || 
                $('#name_ag_bbin') === null || $('#name_ds') === null || 
                $('#name_og') === null || $('#name_mg') === null) {
            return false;
        }


        setTimeout("loadLiveUserBalance(1,'<?php echo $live_name;?>','<?php echo $live_pwd_arr['ag_user_pwd']; ?>',$('#name_ag'),$('#credit_ag'))",500);
        setTimeout("loadLiveUserBalance(2,'<?php echo $live_name;?>','<?php echo $live_pwd_arr['agin_user_pwd']; ?>',$('#name_agin'),$('#credit_agin'))",500);
        setTimeout("loadLiveUserBalance(3,'<?php echo $live_name;?>','<?php echo $live_pwd_arr['ag_bbin_user_pwd']; ?>',$('#name_ag_bbin'),$('#credit_ag_bbin'))",500);
        setTimeout("loadLiveUserBalance(4,'<?php echo $live_name;?>','<?php echo $live_pwd_arr['ag_og_user_pwd']; ?>',$('#name_ds'),$('#credit_ds'))",500);
        setTimeout("loadLiveUserBalance(5,'<?php echo $live_name;?>','<?php echo $live_pwd_arr['ag_mg_user_pwd']; ?>',$('#name_og'),$('#credit_og'))",500);
        setTimeout("loadLiveUserBalance(6,'<?php echo $live_name;?>','<?php echo $live_pwd_arr['ds_user_pwd']; ?>',$('#name_mg'),$('#credit_mg'))",500);
    }

    loadUserBalance();
</script>
                            <?php
                            }
                            ?>
                        </table>
               
        </div>