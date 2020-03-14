<?php use yii\widgets\LinkPager;?>
 <form name="gridSearchForm" id="gridSearchForm" method="get" action="#/finance/default/finance-log">

     <div class="pd10 font14 trinput">
         <p>
                    <span>
                        日期：<input name="s_time" type="text" id="s_time" value="<?=$startTime;?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd'})" size="18" maxlength="10" readonly="readonly">
                        ~
                        <input name="e_time" type="text" id="e_time" value="<?=$endTime;?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd'})" size="18" maxlength="10" readonly="readonly">
                        &nbsp;&nbsp;
                        <input type="button" value="今日" onclick="setDate('today')">
                            <input type="button" value="昨日" onclick="setDate('yesterday')">
                            <input type="button" value="本周" onclick="setDate('thisWeek')">
                            <input type="button" value="上周" onclick="setDate('lastWeek')">
                            <input type="button" value="本月" onclick="setDate('thisMonth')">
                            <input type="button" value="上月" onclick="setDate('lastMonth')">
                            <input type="button" value="最近7天" onclick="setDate('lastSeven')">
                            <input type="button" value="最近30天" onclick="setDate('lastThirty')">
                        <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
                            <option value="" selected="">選擇月份</option>
                            <?php
                                foreach ($monthArray as $key=>$val){?>
                                    <option value="<?=$key+1?>"><?=$val;?></option>
                            <?php }?>
                        </select>
                    </span>
                </p>
                <p>
                    <div>
               
                        會員名：<input name="userIn" value="<?=$userIn;?>" style="width: 200px;" type="text"> (多個用戶用 , 隔開)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        忽略會員名：<input name="userNin" value="<?=$userNin;?>" type="text" style="width: 200px;"> (多個用戶用 , 隔開)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="gtype" type="hidden" id="gtype" value="">
                         <input id="gridSearchBtn" type="button" name="Submit" value="搜索">
                    
                         <div style="color: red;font-size: 14px;" class="pdt10">活動金額：在加款扣款界面，如果理由包含'用於活動'這四個字，那此次金額就屬於活動金額，不算在盈利範圍內。</div>
                    </div>
                
              
     </div>
  
          
            <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 font12 skintable" >
                <tbody><tr  class="dailitr">
                    <td style="width: 15%" align="center" height="25"><strong>會員名</strong></td>
                    <td style="width: 15%" align="center"><strong>匯款金額</strong></td>
                    <td style="width: 14%" align="center"><strong>存款金額(排除活動金額)</strong></td>
                    <td style="width: 14%" align="center"><strong>取款金額(排除活動金額)</strong></td>
                    <td style="width: 14%" align="center"><strong>合計盈利(排除活動金額)</strong></td>
                    <td style="width: 14%" align="center"><strong>後台加錢(用於活動)</strong></td>
                    <td style="width: 14%" align="center"><strong>後台扣錢(用於活動)</strong></td>
                </tr>
                <?php
                    if($data){
                        foreach ($data as $key=>$val){ ?>
                            <tr align="center" onmouseover="this.style.backgroundColor='#EBEBEB'" onmouseout="this.style.backgroundColor='#ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                                <td height="40" align="center" valign="middle"><?=$val['user_name'];?></td>
                                <td align="center" valign="middle"><?=$val['huikuan'];?></td>
                                <td align="center" valign="middle"><?=$val['ck'];?></td>
                                <td align="center" valign="middle"><?=$val['qk'];?></td>
                                <td align="center" valign="middle"><?=$val['huikuan']+$val['ck']-$val['qk'];?></td>
                                <td align="center" valign="middle"><?=$val['ckHd'];?></td>
                                <td align="center" valign="middle"><?=$val['qkHd'];?></td>
                            </tr>
                    <?php }
                    }else{ ?>
                        <tr align="center"style="line-height: 20px; background-color: rgb(255, 255, 255);">
                            <td height="40" align="center" valign="middle" colspan="7">沒有數據</td>
                        </tr>
                <?php }?>
                </tbody>
            </table>
            <?= LinkPager::widget(['pagination' => $pages]); ?>
     
  </form>