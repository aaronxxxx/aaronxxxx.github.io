<?php
use yii\widgets\LinkPager;
require("public/lottery/Js_Class.php");
?>
    <script language="javascript" src="/public/lottery/js/result_orpk.js"></script>
        <form name="form1" id="form1" method="post" action="?r=lotteryresult/orpk/operation&id=<?=$id?>&action=<?=$id>0 ? 'edit' : 'add'?>&s_time=<?=$query_time?>&qishu_query=<?=$qishu_query?>">
            <div class=" trinput resulttable w836 tabft13 spanmg0">
            <p>
                <span>彩票类别：</span>
                <span><strong>老PK拾</strong></span>
                <button type="button" onclick="javascript:location.href='#/lotteryresult/batch&type=老PK拾'">批量开奖</button>
            </p>
            <p>
                <span>开奖期号：</span>
                <span><input name="qishu" type="text" id="qishu" onchange="if(/\D/.test(this.value)){layer.alert('期号只能输入数字');this.value='';return false;}" value="<?php if(isset($lists) && count($lists) > 0){echo $lists['0']['qishu'];}?>" size="20" maxlength="16"/></span>
            </p>
            <p>
                <span>开奖时间：</span>
               <span><input name="datetime" class="date_day_time" type="text" id="datetime" value="<?php if(isset($lists) && count($lists) > 0){echo $lists['0']['datetime'];}?>" size="20" maxlength="19"/> 注意：时间格式务必填写正确，如2014-10-10 10:10:10</span>
            </p>
            <p>
                <span>开奖号码：</span>
               <span><select name="ball_1" id="ball_1">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] ==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_1'] =='' ){echo 'selected';};}?>>冠军</option>
                    </select>
                    <select name="ball_2" id="ball_2">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_2']=='' ){echo 'selected';};}?>>亚军</option>
                    </select>
                    <select name="ball_3" id="ball_3">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_3']=='' ){echo 'selected';};}?>>第三名</option>
                    </select>
                    <select name="ball_4" id="ball_4">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_4']=='' ){echo 'selected';};}?>>第四名</option>
                    </select>
                    <select name="ball_5" id="ball_5">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_5']=='' ){echo 'selected';};}?>>第五名</option>
                    </select>
                    <select name="ball_6" id="ball_6">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_6']=='' ){echo 'selected';};}?>>第六名</option>
                    </select>
                    <select name="ball_7" id="ball_7">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_7']=='' ){echo 'selected';};}?>>第七名</option>
                    </select>
                    <select name="ball_8" id="ball_8">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_8']=='' ){echo 'selected';};}?>>第八名</option>
                    </select>
                    <select name="ball_9" id="ball_9">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_9']=='' ){echo 'selected';};}?>>第九名</option>
                    </select>
                    <select name="ball_10" id="ball_10">
                        <option value="1" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==1 ){echo 'selected';};}?>>1</option>
                        <option value="2" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==2 ){echo 'selected';};}?>>2</option>
                        <option value="3" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==3 ){echo 'selected';};}?>>3</option>
                        <option value="4" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==4 ){echo 'selected';};}?>>4</option>
                        <option value="5" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==5 ){echo 'selected';};}?>>5</option>
                        <option value="6" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==6 ){echo 'selected';};}?>>6</option>
                        <option value="7" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==7 ){echo 'selected';};}?>>7</option>
                        <option value="8" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==8 ){echo 'selected';};}?>>8</option>
                        <option value="9" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==9 ){echo 'selected';};}?>>9</option>
                        <option value="10" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']==10 ){echo 'selected';};}?>>10</option>
                        <option value="" <?php if(isset($lists) && count($lists) > 0){if($lists['0']['ball_10']=='' ){echo 'selected';};}?>>第十名</option>
                    </select></span>
            </p>
            <p>
                <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
            </p>
            <p>
               <span><input type="button" class="form_ajax_submit_btn mgl61" data-targetid="form1" data-redirect="#/lotteryresult/orpk/list&status=0&type=type=老PK拾&<?=time()?>" name="submit" value="确认发布"></span>
            </p>
        </div>
        </form>
        <form name="form2" id="gridSearchForm" method="get" action="#/lotteryresult/orpk/list">
            <input name="p" type="hidden" value="1" />
            <div class="tabft13 trinput resulttable zudan pd10">
                <div align="left">
                  开奖期号：
                    <input name="qishu_query" type="text" id="qishu_query" value="<?php if(isset($_GET['qishu_query'])){echo $_GET['qishu_query'];} ?>" size="20" maxlength="15"/>
                    &nbsp;&nbsp;日期：
                    <input name="s_time" type="text" id="s_time" value="<?php if(isset($_GET['s_time'])){echo $_GET['s_time'];}  ?>" class="date_day" size="10" maxlength="10" placeholder="日期不为空" readonly="readonly" />
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
                <td align="center"><strong>冠军</strong></td>
                <td align="center"><strong>亚军</strong></td>
                <td align="center"><strong>第三名</strong></td>
                <td align="center"><strong>第四名</strong></td>
                <td height="25" align="center"><strong>第五名</strong></td>
                <td align="center"><strong>第六名</strong></td>
                <td align="center"><strong>第七名</strong></td>
                <td align="center"><strong>第八名</strong></td>
                <td align="center"><strong>第九名</strong></td>
                <td align="center"><strong>第十名</strong></td>
                <td align="center">结算</td>
                <td align="center"><strong>重算</strong></td>
                <td align="center"><strong>操作</strong></td>
            </tr>
            <?php
            if(isset($rows) && count($rows) > 0){
                foreach($rows as $key =>$val){
                    ?>
                    <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#fff'" style="background-color:rgb(255, 255, 255); line-height:20px;">
                        <td height="25" align="center" valign="middle">老PK拾</td>
                        <td align="center" valign="middle"><?=$val['qishu']?></td>
                        <td align="center" valign="middle"><?=$val['datetime']?></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_1']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_2']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_3']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_4']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_5']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_6']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_7']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_8']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_9']?>.png"></td>
                        <td align="center" valign="middle"><img src="/public/lottery/images/ball_bjpk10/<?=$val['ball_10']?>.png"></td>
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
                            <a href="#/lotteryresult/orpk/edit&id=<?=$val['id']?>&qishu=<?= $val['qishu']?>" >编辑</a>
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
                $gtype = 'orpk';
                $jsway = '0';
                $.ajax({
                    'url':'/?r=lotteryresult/index/jiesuan',
                    async:true,
                    type:'POST',
                    data:{'qihao':$qihao,'jstype':$jstype,'gtype':$gtype,'jsway':$jsway},
                    success: function(data){
                        if(data=='0'){
                            alert('结算成功');
                            window.location.href='#/lotteryresult/orpk/list&status=0&type=老PK拾&n_time=<?=time();?>';
                        }else if(data == '-1'){
                            layer.alert('结算接口连接异常！');
                        }else if(data == '1'){
                            alert('重算成功');
                            window.location.href='#/lotteryresult/orpk/list&status=0&type=老PK拾&n_time=<?=time();?>';
                        }else if(data == '2'){
                            alert('部分结算成功');
                            window.location.href='#/lotteryresult/orpk/list&status=0&type=老PK拾&n_time=<?=time();?>';
                        }else if(data == '3'){
                            alert('部分重算成功');
                            window.location.href='#/lotteryresult/orpk/list&status=0&type=老PK拾&n_time=<?=time();?>';
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
                            window.location.href='#/lotteryresult/index/orpk&status=0&type=老PK拾&n_time=<?=time();?>';
                        }
                    }
                });
                return false;
            })
        })
    </script>