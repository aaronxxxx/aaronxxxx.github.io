<table width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tr>
        <td  class="pd10"><font >&nbsp;<span class="pro_title">系统设置</span></font></td>
    </tr>
    <tr>
        <td  align="center" >
            <table width="100%">
                <!-- <tr>
                    <td style="width: 120px;">&nbsp;
                        <a  href="#/lotteryodds/default/index"    style="    font-size: 14px; color: #F37605">彩票程序设置</a>
                    </td>
                    <td style="width: 120px;">
                        <a  href="#/lotteryodds/default/money-set"style="    font-size: 14px; color: #F37605">会员组金额设置</a>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr> -->
            </table>
        </td>
    </tr>
</table>

<form action="?r=sysmng/config/save" method="post" name="editForm1" id="editForm1" >
<table  class="mgt10 settable w1070" border="0" cellpadding="3" cellspacing="1" >
    <tbody>
    <tr>
        <td ><font >&nbsp;<span class="pro_title">系统设置：设置网站信息</span></font></td>
    </tr>
        <tr>
            <td  >
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" id=editProduct >
                    <tr>
                        <td width="160" class="pdrgt5">&nbsp;</td>
                        <td width="816">
                        <input name="close" type="checkbox" id="close" style='HEIGHT: 13px;width: 13px;' value="1"  <?php echo $sysconfig["close"]==1 ? 'checked' : ''?> >
                            网站关闭&nbsp;（出现攻击时请先关闭再排查）</td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  关闭网站截止时间：</td>
                        <td><input name="end_close_time" type="text" class="textfield" id="end_close_time" value="<?php echo $sysconfig["end_close_time"]?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5">网站名称：</td>
                        <td><input name="web_name" type="text" class="textfield" id="web_name"  value="<?php echo $sysconfig["web_name"]?>" size="40" >&nbsp;*</td>
                    </tr>
                    <tr>
                        <td class="pdrgt5">网站域名：</td>
                        <td><input name="conf_www" type="text" class="textfield" id="conf_www"  value="<?php echo $sysconfig["conf_www"]?>" size="40" >&nbsp;*&nbsp;不要加http://  </td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  图片域名：</td>
                        <td><input name="web_image" type="text" class="textfield" id="web_image" value="<?php echo $sysconfig["web_image"]?>" size="40"><span style="color: red;">请输入图片域名，如www.baidu.com。请不要在前面加 http:// 以及不要在后面加 /</span></td>
                    </tr>
                    <!-- <tr>
                        <td class="pdrgt5" >  APP二维码：</td>
                        <td><input name="app_qrcode" type="text" class="textfield" id="app_qrcode" value="<?php echo $sysconfig["app_qrcode"]?>" size="40"><span style="color: red;">请输入图片完整连结，如http://www.baidu.com/img/bd_logo1.png。以.png或.jpg格式为结尾。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  AG娱乐城余额：</td>
                        <td><input name="ag_hall" type="text" class="textfield" id="ag_hall" value="<?php echo $sysconfig['ag_hall']?>" size="40"><span style="color: red;">如果小于此金额，则会铃声提示用户 </span></td>
                    </tr> -->
                    <tr>
                        <td class="pdrgt5" >  用户最低汇款金额：</td>
                        <td><input name="min_huikuan_money" type="text" class="textfield" id="min_huikuan_money" value="<?php echo $sysconfig['min_huikuan_money']?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  用户最低取款金额：</td>
                        <td><input name="min_qukuan_money" type="text" class="textfield" id="min_qukuan_money" value="<?php echo $sysconfig['min_qukuan_money']?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5">转入AI最大限额：</td>
                        <td><input name="ai_max_change" type="text" class="textfield" id="ai_max_change" value="<?php echo $sysconfig['ai_max_change']?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  真人最低转换金额：</td>
                        <td><input name="min_change_money" type="text" class="textfield" id="min_change_money" value="<?php echo $sysconfig['min_change_money']?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  修改汇款默认手续费比例：</td>
                        <td><input name="hk_sxf" type="text" class="textfield" id="hk_sxf" value="<?php echo $sysconfig['hk_sxf']>0?$sysconfig['hk_sxf']:0.00?>" size="3"> 说明：如果用户充值100，比例为0.02。用户得到手续费2=100*0.02</td>
                    </tr>
                    <!-- <tr>
                        <td class="pdrgt5" >彩票注单界面属性：</td>
                        <td>
                           <input name="caipiao_auto" type="checkbox" id="caipiao_auto" style='HEIGHT: 13px;width: 13px;' value="1"  <?php echo $sysconfig['caipiao_auto']==1 ? 'checked' : ''?>>
                            （是否自动刷新界面）
                            <input name="caipiao_auto_time" type="text" class="textfield" id="caipiao_auto_time" value="<?php echo intval($sysconfig['caipiao_auto_time'])>0?$sysconfig['caipiao_auto_time']:30?>" size="4">
                            （每次刷新间隔时间，单位秒）
                            <input name="caipiao_show_row" type="text" class="textfield" id="caipiao_show_row" value="<?php echo intval($sysconfig['caipiao_show_row'])>0?$sysconfig['caipiao_show_row']:20?>" size="4">
                            (每页显示几条记录)
                        </td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >六合注单界面属性：</td>
                        <td>
                            <input name="lhc_auto" type="checkbox" id="lhc_auto" style='HEIGHT: 13px;width: 13px;' value="1"  <?php echo $sysconfig['lhc_auto']==1 ? 'checked' : ''?>>
                            （是否自动刷新界面）
                            <input name="lhc_auto_time" type="text" class="textfield" id="lhc_auto_time" value="<?php echo intval($sysconfig['lhc_auto_time'])>0?$sysconfig['lhc_auto_time']:30?>" size="4">
                            （每次刷新间隔时间，单位秒）
                            <input name="lhc_show_row" type="text" class="textfield" id="lhc_show_row" value="<?php echo intval($sysconfig['lhc_show_row'])>0?$sysconfig['lhc_show_row']:20?>" size="4">
                            (每页显示几条记录)
                        </td>
                    </tr> -->
                    <tr>
                        <td class="pdrgt5" >  财务管理界面属性： </td>
                        <td><input name="money_show_row" type="text" class="textfield" id="money_show_row" value="<?php echo $sysconfig["money_show_row"]?>" size="4">(每页显示几条记录)</td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  注册界面属性： </td>
                        <td>
                            <input name="register_phone" type="checkbox" id="register_phone" style='HEIGHT: 13px;width: 13px;' value="1"  <?php echo $sysconfig['register_phone']==1 ? 'checked' : ''?>>手机号码（出现选择框，必填）
                            <input name="register_qq" type="checkbox" id="register_qq" style='HEIGHT: 13px;width: 13px;' value="1"  <?php echo $sysconfig['register_qq']==1 ? 'checked' : ''?>>QQ号码（出现选择框，非必填）
                            <input name="register_email" type="checkbox" id="register_email" style='HEIGHT: 13px;width: 13px;' value="1"  <?php echo $sysconfig['register_email']==1 ? 'checked' : ''?>>微信号（出现选择框，必填）
                            <input name="register_name" type="checkbox" id="register_name" style='HEIGHT: 13px;width: 13px;' value="1"  <?php echo $sysconfig['register_name']==1 ? 'checked' : ''?>>真实姓名唯一
                        </td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  客服qq：</td>
                        <td><input name="service_qq" type="text" class="textfield" id="service_qq" value="<?php echo $sysconfig["service_qq"]?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  客服email：</td>
                        <td><input name="service_email" type="text" class="textfield" id="service_email" value="<?php echo $sysconfig["service_email"]?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  推广email：</td>
                        <td><input name="generalize_email" type="text" class="textfield" id="generalize_email" value="<?php echo $sysconfig["generalize_email"]?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  投诉email：</td>
                        <td><input name="complain_email" type="text" class="textfield" id="complain_email" value="<?php echo $sysconfig["complain_email"]?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  客服联系电话：</td>
                        <td><input name="contact_tel" type="text" class="textfield" id="contact_tel" value="<?php echo $sysconfig["contact_tel"]?>" size="40"></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  在线客服地址：</td>
                        <td><input name="service_url" type="text" class="textfield" id="service_url" value="<?php echo $sysconfig["service_url"]?>" size="40"><span style="color: red;">请输入在线客服网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  线路检测网址1：</td>
                        <td><input name="check_url1" type="text" class="textfield" id="check_url1" value="<?php echo $sysconfig["check_url1"]?>" size="40"><span style="color: red;">请输入线路检测网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  线路检测网址2：</td>
                        <td><input name="check_url2" type="text" class="textfield" id="check_url2" value="<?php echo $sysconfig["check_url2"]?>" size="40"><span style="color: red;">请输入线路检测网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  线路检测网址3：</td>
                        <td><input name="check_url3" type="text" class="textfield" id="check_url3" value="<?php echo $sysconfig["check_url3"]?>" size="40"><span style="color: red;">请输入线路检测网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  线路检测网址4：</td>
                        <td><input name="check_url4" type="text" class="textfield" id="check_url4" value="<?php echo $sysconfig["check_url4"]?>" size="40"><span style="color: red;">请输入线路检测网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  线路检测网址5：</td>
                        <td><input name="check_url5" type="text" class="textfield" id="check_url5" value="<?php echo $sysconfig["check_url5"]?>" size="40"><span style="color: red;">请输入线路检测网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  线路检测网址6：</td>
                        <td><input name="check_url6" type="text" class="textfield" id="check_url6" value="<?php echo $sysconfig["check_url6"]?>" size="40"><span style="color: red;">请输入线路检测网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  线路检测网址7：</td>
                        <td><input name="check_url7" type="text" class="textfield" id="check_url7" value="<?php echo $sysconfig["check_url7"]?>" size="40"><span style="color: red;">请输入线路检测网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5" >  线路检测网址8：</td>
                        <td><input name="check_url8" type="text" class="textfield" id="check_url8" value="<?php echo $sysconfig["check_url8"]?>" size="40"><span style="color: red;">请输入线路检测网址，如http://www.baidu.com。</span></td>
                    </tr>
                    <!-- <tr>
                        <td class="pdrgt5" > 臨時開獎介面開關：</td>
                        <td>
                        <select name="sport_show_row">
                            <option value=0 <?php echo $sysconfig['sport_show_row']!=-1 ? 'selected' : ''?>>開啟新介面</option>
                            <option value=-1 <?php echo $sysconfig['sport_show_row']==-1 ? 'selected' : ''?>>開啟舊介面</option>
                        </select>
                        </td>
                    </tr> -->
                    <tr>
                        <td class="pdrgt5">入金匯率：</td>
                        <td> 1 : <input name="in_rate" type="text" class="textfield" id="in_rate" value="<?php echo $sysconfig["in_rate"]?>" size="40"><span style="color: red;">USDT : RMB</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5">出金匯率：</td>
                        <td> 1 : <input name="out_rate" type="text" class="textfield" id="out_rate" value="<?php echo $sysconfig["out_rate"]?>" size="40"><span style="color: red;">USDT : RMB</span></td>
                    </tr>
                    <tr>
                        <td class="pdrgt5">&nbsp;</td>
                        <td valign="bottom"><input name="submitSaveEdit" type="button" class="button form_ajax_submit_btn" data-targetid="editForm1"  id="submitSaveEdit" value="保存" style="width: 60;" ></td>
                    </tr>
                    <tr>
                        <td height="20" align="right">&nbsp;</td>
                        <td valign="bottom">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</form>