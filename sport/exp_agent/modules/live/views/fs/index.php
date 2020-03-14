<?php

use yii\widgets\LinkPager;
?>

<script type="text/javascript" language="javascript" src="/public/live/js/live_order.js"></script> 
<div id="pageMain">

    <form name="gridSearchForm" id="gridSearchForm" method="get" action="#/live/fs/index" onSubmit="return check();">
        <div class="font13 trinput" >
            <div class="pro_title pd10">反水列表</div>


            <input type="hidden" name="r" value="live/fs/index"/>
            <p>

                美东时间： <input class="laydate-icon" name="s_time" id="s_time" value="<?php echo $start_order_time; ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                ~
                <input class="laydate-icon" name="e_time" id="e_time" value="<?php echo $end_order_time; ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                <input type="button" value="今日" onclick="setDate('today')"/>
                <input type="button" value="昨日" onclick="setDate('yesterday')"/>
                <input type="button" value="本周" onclick="setDate('thisWeek')"/>
                <input type="button" value="上周" onclick="setDate('lastWeek')"/>
                <input type="button" value="本月" onclick="setDate('thisMonth')"/>
                <input type="button" value="上月" onclick="setDate('lastMonth')"/>
                <input type="button" value="最近7天" onclick="setDate('lastSeven')"/>
                <input type="button" value="最近30天" onclick="setDate('lastThirty')"/>
                <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
                    <option value="">选择月份</option>
                    <option value="1">1月</option>
                    <option value="2">2月</option>
                    <option value="3">3月</option>
                    <option value="4">4月</option>
                    <option value="5">5月</option>
                    <option value="6">6月</option>
                    <option value="7">7月</option>
                    <option value="8">8月</option>
                    <option value="9">9月</option>
                    <option value="10">10月</option>
                    <option value="11">11月</option>
                    <option value="12">12月</option>
                </select>
            </p>
            <p>
                平台类型：
                <select name="game_type" id="live_type" onChange="onurlchange()" >
                    <option value="AG"  <?php echo $game_type == 'AG' ? 'selected' : ''; ?>>AG</option>
                    <option value="AGIN"  <?php echo $game_type == 'AGIN' ? 'selected' : ''; ?>>AGIN</option>
                    <option value="AG_BBIN"  <?php echo $game_type == 'AG_BBIN' ? 'selected' : ''; ?>>AG_BBIN</option>
                    <option value="DS"  <?php echo $game_type == 'DS' ? 'selected' : ''; ?>>DS</option>
                    <option value="AG_MG"  <?php echo $game_type == 'AG_MG' ? 'selected' : ''; ?>>AG_MG</option>
                    <option value="AG_OG"  <?php echo $game_type == 'AG_OG' ? 'selected' : ''; ?>>AG_OG</option>
                    <option value="OG"  <?php echo $game_type == 'OG' ? 'selected' : ''; ?>>OG</option>
                    <option value="KG"  <?php echo $game_type == 'KG' ? 'selected' : ''; ?>>KG</option>
                </select>
                 &nbsp;&nbsp;反水状态：
                <select name="fs_type" id="fs_type">
                    <option value="0"  <?php echo $fs_type == '0' ? 'selected' : '' ?>>未反水注单</option>
                    <option value="1"  <?php echo $fs_type == '1' ? 'selected' : '' ?>>已反水注单</option>
                </select>
                &nbsp;&nbsp;
                用户名：<input name="user_str" value="<?php echo $user_str; ?>" style="width: 160px;" type="text"> (多个用户用 , 隔开)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="Submit" value="搜索" id="submitbtn"/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/#/live/fs/record">(温馨提示：查看已反水列表 )</a>

            </p>

        </div>
    </form>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35 mgt10" >
        <tr class="t-title dailitr">
            <td style="width: 8%" align="center" height="25"><strong>用户名</strong></td>
            <td style="width: 10%" align="center"><strong>真人会员账号</strong></td>
            <td style="width: 10%" align="center"><strong>平台类型</strong></td>
            <td style="width: 6%" align="center"><strong>下注笔数</strong></td>
            <td style="width: 8%" align="center"><strong>下注额度</strong></td>
            <td style="width: 8%" align="center"><strong>派彩额度</strong></td>
            <td style="width: 10%" align="center"><strong>有效下注额度</strong></td>
            <td style="width: 10%" align="center"><strong>所选时间内需反水金额</strong></td>
            <td style="width: 10%" align="center"><strong>所选时间内已反的金额</strong></td>
            <td style="width: 10%" align="center">
                <strong>
                    反水比例&nbsp;
                    <input id="setAllFsRate" type="button" onclick="setAllFsRate();" value="设置所有玩家"/>
                </strong></td>
            <td style="width: 10%" align="center">
                <strong>
                    操作&nbsp;
                    <input id="setAllFs" name="fs_button" type="button" onclick="setAllFs();" value="反水本页玩家"/>
                </strong>
            </td>
        </tr>
        <?php
        $all_user_name = "";
        foreach ($rs as $key => $row) {
            $all_user_name = $all_user_name . $row['live_username'] . ",";
            ?>

            <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'" style="background-color:#FFFFFF; line-height:20px;">
                <td  align="center" valign="middle">
    <?php echo $row["user_name"]; ?>
                </td>
                <td align="center" valign="middle"><?php echo $row['live_username'] ?></td>
                <td align="center" valign="middle"><?php echo $game_type; ?></td>
                <td align="center" valign="middle"><?php echo $row['count'] ?></td>
                <td align="center" valign="middle"><?php echo $row['bet_money'] ?></td>
                <td align="center" valign="middle"><?php echo $row['live_win'] ?></td>
                <td align="center" valign="middle"><?php echo $row['valid_bet_amount'] ?></td>
                <td align="center" valign="middle"><?php echo $row['fs_total_money']; ?></td>
                <td align="center" valign="middle"><?php echo $row['fs_already_money']; ?></td>
                <td align="center" valign="middle">
                    <span id="fs_<?php echo $row['user_id']; ?>"><?php echo $row['fs_rate']; ?></span>%&nbsp;&nbsp;
                    <input id="setFs<?php echo $row['user_id']; ?>" type="button" name="setFs" onclick="setFs(<?php echo $row['user_id']; ?>);" value="设置"/>
                </td>
                <td align="center" valign="middle">
                    <input id="fs_button_<?php echo $row['user_id']; ?>" type="button" name="fs_button" onclick="fs_one('<?php echo $row['live_username']; ?>');" value="反水单个玩家"/>
                </td>
            </tr>
            <?php
        }
        ?>
        <input id="all_user_name" type="hidden" value="<?php echo substr($all_user_name, 0, -1); ?>"/>
        <tr >
            <td colspan="11" align="center" valign="middle">
                <?php
                echo LinkPager::widget(['pagination' => $pagination,]);
                ?>
            </td>
        </tr>
    </table>


</div>
<script>
    function setFs(id) {
        var fsrate = prompt("如果填写2，那玩家有效金额100元，反水2元。", "");
        if (fsrate !== null) {
            $.post("/?r=live/fs/set-fs", {id: id, fsrate: fsrate}, function (data) {
                if (data === fsrate) {
                    alert('设置成功');
                    url = window.location.href + "&" + Date.parse(new Date());
                    window.location.href = url;
                    // document.location.reload();
                } else {
                    alert(data);
                }
            });
        }
    }

    function setAllFsRate() {
        var fsrate = prompt("如果填写2，那玩家有效金额100元，反水2元。", "");
        if (fsrate !== null) {
            $.post("/?r=live/fs/set-fs-by-gametype", {fsrate: fsrate, gametype: "<?php echo $game_type; ?>"}, function (data) {

                if (data === fsrate) {
                    alert('设置成功');
                    url = window.location.href + "&" + Date.parse(new Date());
                    window.location.href = url;
                    // document.location.reload();
                } else {
                    alert(data);
                }
            });
        }
    }

    function fs_one(liveuser) {
        var s_time = $("#s_time").val();
        var e_time = $("#e_time").val();
        $("input[name=fs_button]").attr("disabled", "disabled"); //按钮失效
        $.post("/?r=live/fs/set-one-fs", {liveuser: liveuser, s_time: s_time, e_time: e_time, game_type: "<?php echo $game_type; ?>"}, function (data) {
            $("input[name=fs_button]").attr("disabled", false); //按钮失效
            if (data === "1") {
                console.log(data);
                alert("反水成功");
                url = window.location.href + "&" + Date.parse(new Date());
                window.location.href = url;
                // document.location.reload();
            } else if (data === "2") {
                alert("客户所投注有效订单已经全部反水。可通知客户投注后继续反水");
            }
        });
    }

    function setAllFs() {
        var s_time = $("#s_time").val();
        var e_time = $("#e_time").val();
        var liveuser = $("#all_user_name").val();
        $("input[name=fs_button]").attr("disabled", "disabled"); //按钮失效

        $.post("/?r=live/fs/set-all-fs", {liveuser: liveuser, s_time: s_time, e_time: e_time, game_type: "<?php echo $game_type; ?>"}, function (data) {
            $("input[name=fs_button]").attr("disabled", false); //按钮失效
            if (data === "1") {
                console.log(data);
                alert("反水成功");
                url = window.location.href + "&" + Date.parse(new Date());
                window.location.href = url;
                // document.location.reload();
            } else if (data === "2") {
                alert("客户所投注有效订单已经全部反水。可通知客户投注后继续反水");
            }
        }
        );
    }
</script>

<script>
    function onurlchange() {
        location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
    }
    $(function () {
        $('#submitbtn').bind('click', function (e) {
            location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
        });
    });
</script>