<?php use yii\widgets\LinkPager;?>
 <form id="gridSearchForm" name="form1" method="GET" action="#/finance/default/huikuan">
     
     <div class="pro_title">汇款管理：查看所有的用户汇款信息</div>

                <div class=" pd10  mgauto middle" >
            
                <div class="trinput ">
                    <span>
                        <select name="status" id="status">
                            <?php
                                foreach ($statusArray1 as $key=>$val){?>
                                    <option value="<?=$key;?>" <?= $key==$status ? "selected":'';?>><?=$val;?></option>
                            <?php  } ?>
                        </select>
                    </span>
                                       <span>

                        <select name="order" id="order">
                            <?php
                            foreach ($orderArray as $key=>$val){?>
                                <option value="<?=$key;?>" <?= $key==$order ? "selected":'';?>><?=$val;?></option>
                            <?php  } ?>
                        </select>
                   </span>
                       <span>日期：
                        <input name="start_time" type="text" id="start_time" value="<?=$startime;?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd 00:00:00'})"  size="20" maxlength="10" readonly="readonly">
                        ~
                        <input name="end_time" type="text" id="end_time" value="<?=$endtime;?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd 23:59:59'})"  size="20" maxlength="10" readonly="readonly">
                        &nbsp;&nbsp;会员名称：
                        <input name="user_name" type="text" id="user_name" value="<?=$user;?>" size="15" maxlength="20">          &nbsp;&nbsp;
                         <input id="gridSearchBtn" type="button" name="Submit" value="查找">
                   </span>
               
                </div>
                </div>
    </form>

<table width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tbody>
    <tr>
        <td height="24" nowrap="" >
            <table width="100%" border="1"  cellspacing="0" cellpadding="0" class="font12 skintable line35" id="editProduct" width="100%">
                <tbody>
                <tr align="center">
                    <td width="5%" height="24"><strong>编号</strong></td>
                    <td width="8%" height="24"><strong>会员名</strong></td>
                    <td width="20%"><strong>订单号/提交时间</strong></td>
                    <td width="8%"><strong>充值金额</strong></td>
                    <td width="8%"><strong>赠送金额</strong></td>
                    <td width="8%"><strong>查看财务</strong></td>
                    <td width="10%"><strong>汇款银行</strong></td>
                    <td width="25%"><strong>汇款方式/汇款信息</strong></td>
                    <td width="8%"><strong>操作</strong></td>
                </tr>
                <?php
                $all = $success = $zsje = $fail = $shenhe = 0;
                if($data){
                    foreach ($data as $key=>$val){
                        $all += $val['order_value'];
                        $zsje += $val['zsjr'];
                        $string = $str=substr($val["order_num"],15);//去除前面?>
                        <tr align="center" onmouseover="this.style.backgroundColor = '#EBEBEB'" onmouseout="this.style.backgroundColor = '#ffffff'" style="background-color: rgb(255, 255, 255);">
                            <td height="35" align="center"><?=$val['id'];?></td>
                            <td height="35" align="center"><?=$string;?></td>
                            <td><a href="#/finance/default/huikuan-detail&id=<?=$val['id'];?>&update=1" style="color:#FF9900;"><?=$val['order_num'];?></a><br><?=$val['update_time'];?></td>
                            <td><span style="color:#999999;"><?=$val['assets'];?></span><br><?=$val['order_value'];?><br><span style="color:#999999;"><?=$val['balance'];?></span></td>
                            <td><?=$val['zsjr'];?></td>
                            <td><a href="#/finance/fund/look-money&username=<?=$val['user_name']?>&status=所有状态&time_start=<?= urlencode($startime)?>&end_time=<?=  urlencode($endtime)?>" style="color:#FF9900;">查看财务</a></td>
                            <td><a href="#/<?=$url;?>&bank=<?=$val['pay_card'];?>" style="color:#FF9900;"><?=$val['pay_card'];?></a></td>
                            <td><?=$val['manner'];?></td>
                            <td>
                                <?php if($val['status']=='失败'){ $fail+=$val['order_value'];?>
                                <span><?=$statusArray[$val['status']];?></span>
                                    <br>
                                    <a href="#/finance/default/huikuan-detail&id=<?=$val['id'];?>&update=1" style="color:#FF9900;">重新结算</a>
                                <?php }else if($val['status']=='审核中' || $val['status']=='未结算'){ $shenhe+=$val['order_value'];?>
                                    <span><a href="#/finance/default/huikuan-detail&id=<?=$val['id'];?>&update=1" style="color:#FF9900;"><?=$statusArray[$val['status']];?></a></span>
                                <?php }else{ $success+=$val['order_value'];?>
                                    <span><a href="#/finance/default/huikuan-detail&id=<?=$val['id'];?>&update=1" style="color:#006600;">汇款成功</a></span>
                                <?php }?>
                            </td>
                        </tr>
                <?php  }?>
                    <tr>
                        <td colspan="9" align="center">
                            <div class="cksum">总金额：<span style="color:#0000FF"><?=$all;?></span>，成功：<span style="color:#006600"><?=$success;?></span>，赠送金额：<span style="color:#FF00FF"><?=$zsje;?></span>，失败：<span style="color:#FF0000"><?=$fail;?></span>，审核：<span style="color:#FF9900"><?=$shenhe;?></span></div>
                        </td>
                    </tr>
               <?php  }?>
                </tr>
                </tbody>
            </table>
            <?= LinkPager::widget(['pagination' => $pages]); ?>
        </td>
    </tr>
    </tbody>
</table>