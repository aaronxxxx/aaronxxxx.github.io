 
<div id="pageMain">
    <div class="pro_title">时时彩设置</div>
    <form name="form1" method="get" action="?r=lotteryodds/default/upclose" id="form1">
        <table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="settable mgt10 font14">
            <?php if($Lottery_set){
                foreach ($Lottery_set as $key=>$val){?>
                    <tr bgcolor="#FFFFFF">
                        <td height="22" align="left">
                            <input class="closed" type="checkbox" class="input1" value="1" <?=$val['close']==1 ? 'checked' : ''?> name="<?=$val['id'];?>[close]" id="close_cq" />关闭<?=$val['name'];?>
                        </td>
                        <td height="22" align="left">
                            关闭原因:
                            <input type="text" class="input1" value="<?=$val['des'];?>" size="100" name="<?=$val['id'];?>[des]" id="des_<?=$val['sign'];?>" />
                        </td>
                    </tr>
            <?php }
            }?>
            <tr bgcolor="#FFFFFF">
                <td height="22" align="left"></td>
                <td height="22" align="left"></td>
            </tr>
            <?php if($qishuJiaodui){
                foreach ($qishuJiaodui as $key=>$val){?>
                    <tr bgcolor="#FFFFFF">
                        <td height="22" align="left"><?=$val['name'];?>:</td>
                        <td height="22" align="left">
                            开奖时间:
                                <input type="text" class="input1 kaijiang_time" value="<?=isset($val['kaijiang_time'])?date('Y-m-d',strtotime($val['kaijiang_time'])):'';?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd'})" size="10" maxlength="10" name="<?=$val['id'];?>[kaijiang_time]"  readonly="readonly">
                            开奖期号:<input type="text" class="input1 qishu" value="<?=$val['qishu'];?>" size="10" name="<?=$val['id'];?>[qishu]">
                            <?php
                                switch($val['sign'])
                                {
                                    case 'fc_jiaod':
                                        echo '(例如:2017-01-01开的期数是2017001)';
                                        break;
                                    case 'pl_jiaod':
                                        echo '(例如:2017-01-01开的期数是2017001)';
                                        break;
                                    case 'gxsf_jia':
                                        echo '(例如:2017-01-01开的期数是201700101)';
                                        break;
                                    case 'bjpn_jia':
                                        echo '(例如:2017-01-01开的期数是800590)';
                                        break;
                                    case 'bjpk_jia':
                                        echo '(例如:2017-01-01开的期数是595162)';
                                        break;
                                }
                            ?>
                        </td>
                    </tr>
                <?php }} ?>
            <tr>
                <input type="hidden" name="save" value="ok"/>
                <td height="28" colspan="10" align="center" bgcolor="#FFFFFF"><input type="button" class="form_ajax_submit_btn" data-targetid="form1"  name="submit" value="确认修改"></td>
            </tr>
        </table>
    </form>
</div>
<script>
    $(function () {

    })
</script>