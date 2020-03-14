<?php ?>
<div id="pageMain">
    <form id="liveHistoryForm" action="/#/report/live-history/index" >
        <div class="trinput font14 ">
            日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?=$s_time?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
            ~
            <input class="laydate-icon" name="e_time" id="e_time" value="<?=$e_time?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
            &nbsp;&nbsp;
            <input type="button" value="今日" onclick="setDate('today')"/>
            <input type="button" value="昨日" onclick="setDate('yesterday')"/>
            <input type="button" value="本周" onclick="setDate('thisWeek')"/>
            <input type="button" value="上周" onclick="setDate('lastWeek')"/>
            <input type="button" value="本月" onclick="setDate('thisMonth')"/>
            <input type="button" value="上月" onclick="setDate('lastMonth')"/>
            <input type="button" value="最近7天" onclick="setDate('lastSeven')"/>
            <input type="button" value="最近30天" onclick="setDate('lastThirty')"/>

            <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
                <option value="" selected>选择月份</option>
                <option value="1"  >1月</option>
                <option value="2"  >2月</option>
                <option value="3"  >3月</option>
                <option value="4"  >4月</option>
                <option value="5"  >5月</option>
                <option value="6"  >6月</option>
                <option value="7"  >7月</option>
                <option value="8"  >8月</option>
                <option value="9"  >9月</option>
                <option value="10" >10月</option>
                <option value="11" >11月</option>
                <option value="12" >12月</option>
            </select>
        </div>
        <div class="trinput font14 mgt10">
用户名：<input name="user_group" value="<?= $user_group ?>"  type="text"> (多个用户用 , 隔开)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            忽略用户名：<input name="user_ignore_group" value="<?= $user_ignore_group ?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" onclick="submitForm()" value="搜索">
        </div>
    </form>
                <table width="100%" border="1" cellpadding="5" cellspacing="1" class="font14 skintable line35 mgt10">
                    <tr >
                        <td align="center" height="25"><strong>游戏名称</strong></td>
                        <td align="center"><strong>成功转入笔数</strong></td>
                        <td align="center"><strong>成功转入总金额</strong></td>
                        <td align="center"><strong>成功转出笔数</strong></td>
                        <td align="center"><strong>成功转出总金额</strong></td>
                        <td align="center"><strong>成功总笔数</strong></td>
                        <td align="center"><strong>盈利金额(转入-转出)</strong></td>
                    </tr>
                    <?php /*
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="AG" style="color: #F37605;"  href="/#/live/log/index&status=1&game_type=<?= urlencode('AG') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">AG</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result["bet_count"] + $zc_result["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result["bet_money"] - $zc_result["bet_money"]) ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="AGIN" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('AGIN') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">AGIN</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_agin["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_agin["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_agin["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_agin["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_agin["bet_count"] + $zc_result_agin["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_agin["bet_money"] - $zc_result_agin["bet_money"]) ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="BBIN" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('AG_BBIN') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">BBIN</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_bbin["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_bbin["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_bbin["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_bbin["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_bbin["bet_count"] + $zc_result_bbin["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_bbin["bet_money"] - $zc_result_bbin["bet_money"]) ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="DS" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('DS') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">DS</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_ds["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_ds["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_ds["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_ds["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_ds["bet_count"] + $zc_result_ds["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_ds["bet_money"] - $zc_result_ds["bet_money"]) ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="MG" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('AG_MG') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">MG</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_mg["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_mg["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_mg["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_mg["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_mg["bet_count"] + $zc_result_mg["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_mg["bet_money"] - $zc_result_mg["bet_money"]) ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="OG" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('OG') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">OG</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_og["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_og["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_og["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_og["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_og["bet_count"] + $zc_result_og["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_og["bet_money"] - $zc_result_og["bet_money"]) ?></td>
                    </tr>

                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="AG_OG" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('AG_OG') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">AG_OG</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_ag_og["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_ag_og["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_ag_og["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_ag_og["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_ag_og["bet_count"] + $zc_result_ag_og["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_ag_og["bet_money"] - $zc_result_ag_og["bet_money"]) ?></td>
                    </tr>

                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="KG" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('KG') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">KG</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_kg["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_kg["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_kg["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_kg["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_kg["bet_count"] + $zc_result_kg["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_kg["bet_money"] - $zc_result_kg["bet_money"]) ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="VR" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('VR') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">VR</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_vr["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_vr["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_vr["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_vr["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_vr["bet_count"] + $zc_result_vr["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_vr["bet_money"] - $zc_result_vr["bet_money"]) ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">
                            <a title="PT" style="color: #F37605;"  href="#/live/log/index&status=1&game_type=<?= urlencode('PT') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">PT</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_pt["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_pt["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_pt["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_pt["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_pt["bet_count"] + $zc_result_pt["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_pt["bet_money"] - $zc_result_pt["bet_money"]) ?></td>
                    </tr>
                    */ ?>
                    <tr align="center">
                        <td height="25" align="center" valign="middle">
                            <a title="AI" style="color: #F37605;" href="#/live/log/index&status=1&game_type=<?= urlencode('AI') ?>&s_time=<?= urlencode($s_time) ?>&e_time=<?= urlencode($e_time) ?>&user_str=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">AI</a>
                        </td>
                        <td align="center" valign="middle"><?= $zr_result_ai["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result_ai["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_ai["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result_ai["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_ai["bet_count"] + $zc_result_ai["bet_count"]) ?></td>
                        <td align="center" valign="middle"><?= ($zr_result_ai["bet_money"] - $zc_result_ai["bet_money"]) ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle">总计</td>
                        <td align="center" valign="middle"><?= $zr_result["bet_count"] + $zr_result_agin["bet_count"] + $zr_result_bbin["bet_count"] + $zr_result_ds["bet_count"] + $zr_result_mg["bet_count"] + $zr_result_og["bet_count"] + $zr_result_ag_og["bet_count"] + $zr_result_kg["bet_count"] + $zr_result_vr["bet_count"] + $zr_result_pt["bet_count"] + $zr_result_ai["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zr_result["bet_money"] + $zr_result_agin["bet_money"] + $zr_result_bbin["bet_money"] + $zr_result_ds["bet_money"] + $zr_result_mg["bet_money"] + $zr_result_og["bet_money"] + $zr_result_ag_og["bet_money"] + $zr_result_kg["bet_money"] + $zr_result_vr["bet_money"] + $zr_result_pt["bet_money"] + $zr_result_ai["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result["bet_count"] + $zc_result_agin["bet_count"] + $zc_result_bbin["bet_count"] + $zc_result_ds["bet_count"] + $zc_result_mg["bet_count"] + $zc_result_og["bet_count"] + $zc_result_ag_og["bet_count"] + $zc_result_kg["bet_count"] + $zc_result_vr["bet_count"] + $zc_result_pt["bet_count"] + $zc_result_ai["bet_count"] ?></td>
                        <td align="center" valign="middle"><?= $zc_result["bet_money"] + $zc_result_agin["bet_money"] + $zc_result_bbin["bet_money"] + $zc_result_ds["bet_money"] + $zc_result_mg["bet_money"] + $zc_result_og["bet_money"] + $zc_result_ag_og["bet_money"] + $zc_result_kg["bet_money"] + $zc_result_vr["bet_money"] + $zc_result_pt["bet_money"] + $zc_result_ai["bet_money"] ?></td>
                        <td align="center" valign="middle"><?= $total_bet_count ?></td>
                        <td align="center" valign="middle"><?= $total_bet_money ?></td>
                    </tr>
                    <tr align="center"  >
                        <td height="25" align="center" valign="middle" colspan="7">盈利金额=成功转入总金额-成功转出总金额。如果是正数，说明赢钱，如果是负数，则为输钱。</td>
                    </tr>
                </table>

</div>
<script language="javascript">

    function setDate(dateType) {
        var dateNow = new Date();
        var dateStart;
        var dateEnd;
        if (dateType == "today") {
            dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
            dateEnd = dateNow.Format("yyyy-MM-dd hh:mm:ss");
        } else if (dateType == "yesterday") {
            dateNow.addDays(-1);
            dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
            dateEnd = dateNow.Format("yyyy-MM-dd 23:59:59");
        } else if (dateType == "lastSeven") {//最近7天
            dateEnd = dateNow.Format("yyyy-MM-dd hh:mm:ss");
            dateNow.addDays(-6);
            dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
        } else if (dateType == "lastThirty") {//最近30天
            dateEnd = dateNow.Format("yyyy-MM-dd hh:mm:ss");
            dateNow.addDays(-29);
            dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
        } else if (dateType == "thisWeek") {//本周
            dateEnd = dateNow.Format("yyyy-MM-dd hh:mm:ss");
            dateNow.addDays(-dateNow.getDay());
            dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
        } else if (dateType == "lastWeek") {//上周
            dateNow.addDays(-dateNow.getDay() - 1);
            dateEnd = dateNow.Format("yyyy-MM-dd 23:59:59");
            dateNow.addDays(-6);
            dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
        } else if (dateType == "thisMonth") {//本月
            dateEnd = dateNow.Format("yyyy-MM-dd hh:mm:ss");
            dateNow.addDays(-dateNow.getDate() + 1);
            dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
        } else if (dateType == "lastMonth") {//上月
            dateNow.addDays(-dateNow.getDate());
            dateEnd = dateNow.Format("yyyy-MM-dd 23:59:59");
            dateNow.addDays(-dateNow.getDate() + 1);
            dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
        }
        $("#s_time").val(dateStart);
        $("#e_time").val(dateEnd);
        submitForm();
    }

    function submitForm() {
        if (!$("#s_time").val() || !$("#e_time").val()) {
            alert("请输入开始/结束日期。");
            return;
        }
        location.href = $('#liveHistoryForm').attr('action') + "&" + $('#liveHistoryForm').serialize();
    }

    function onChangeMonth(value) {
        if (value == "") {
            return;
        }
        var dateNow = new Date();
        var dateStart;
        var dateEnd;

        dateNow.addDays(-dateNow.getDate() + 1);
        dateNow.addMonths(-dateNow.getMonth() + parseInt(value) - 1);
        dateStart = dateNow.Format("yyyy-MM-dd 00:00:00");
        dateNow.addMonths(1);
        dateNow.addDays(-1);
        dateEnd = dateNow.Format("yyyy-MM-dd 23:59:59");

        $("#s_time").val(dateStart);
        $("#e_time").val(dateEnd);
        submitForm();
    }

    Date.prototype.Format = function (fmt) { //author: meizz
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt))
            fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt))
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    };
    Date.prototype.addDays = function (d)
    {
        this.setDate(this.getDate() + d);
    };

    Date.prototype.addWeeks = function (w)
    {
        this.addDays(w * 7);
    };

    Date.prototype.addMonths = function (m)
    {
        var d = this.getDate();
        this.setMonth(this.getMonth() + m);

        if (this.getDate() < d)
            this.setDate(0);
    };

    Date.prototype.addYears = function (y)
    {
        var m = this.getMonth();
        this.setFullYear(this.getFullYear() + y);

        if (m < this.getMonth())
        {
            this.setDate(0);
        }
    };
    //测试 var now = new Date(); now.addDays(1);//加减日期操作 alert(now.Format("yyyy-MM-dd"));

    Date.prototype.dateDiff = function (interval, endTime)
    {
        switch (interval)
        {
            case "s":   //計算秒差
                return parseInt((endTime - this) / 1000);
            case "n":   //計算分差
                return parseInt((endTime - this) / 60000);
            case "h":   //計算時差
                return parseInt((endTime - this) / 3600000);
            case "d":   //計算日差
                return parseInt((endTime - this) / 86400000);
            case "w":   //計算週差
                return parseInt((endTime - this) / (86400000 * 7));
            case "m":   //計算月差
                return (endTime.getMonth() + 1) + ((endTime.getFullYear() - this.getFullYear()) * 12) - (this.getMonth() + 1);
            case "y":   //計算年差
                return endTime.getFullYear() - this.getFullYear();
            default:    //輸入有誤
                return undefined;
        }
    }
    //测试 var starTime = new Date("2007/05/12 07:30:00");     var endTime = new Date("2008/06/12 08:32:02");     document.writeln("秒差: "+starTime .dateDiff("s",endTime )+"<br>");     document.writeln("分差: "+starTime .dateDiff("n",endTime )+"<br>");     document.writeln("時差: "+starTime .dateDiff("h",endTime )+"<br>");     document.writeln("日差: "+starTime .dateDiff("d",endTime )+"<br>");     document.writeln("週差: "+starTime .dateDiff("w",endTime )+"<br>");     document.writeln("月差: "+starTime .dateDiff("m",endTime )+"<br>");     document.writeln("年差: "+starTime .dateDiff("y",endTime )+"<br>");

</script>