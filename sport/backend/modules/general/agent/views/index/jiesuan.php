<?php
//var_dump($agents_list);exit;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>代理结算信息展示</title>
    </head>
    <body>
        <script>
            function myfun() {
                $.get(
                        "/?r=agent/index/agents-jiesuan-ajax",
                        {
                            id: $("input[name=id]").val(),
                            s_time: $("#s_time").val(),
                            e_time: $("#s_time").val(),
                            refunded: $("input[name=refunded_scale]").val(),
                            agent_level: $("input[name=agent_level]").val(),
                            code: 1
                        },

                        function (result) {
                            result = JSON.parse(result);

                            if (result['msg']) {
                                alert(result['msg']);

                                return false;
                            }

                            var tempArray = result.split(",");
                            var betMoneyTotal = tempArray[0];
                            var winMoneyTotal = tempArray[1];
                            var money = 0;
                            var ratio = 0;
                            $('s_time').val();
                            $('e_time').val();
                            $("#ledger").val(betMoneyTotal);
                            $("#profig").val(winMoneyTotal);
                            if ($("#agents_type").val() == "贏利分成") {

                                if (Math.abs(Number(winMoneyTotal)) < Number($("input[name=total_1_2]").val())) {
                                    ratio = $("input[name=total_1_scale]").val();
                                } else if (Math.abs(Number(winMoneyTotal)) < Number($("input[name=total_2_2]").val())) {
                                    ratio = $("input[name=total_2_scale]").val();
                                } else if (Math.abs(Number(winMoneyTotal)) < Number($("input[name=total_3_2]").val())) {
                                    ratio = $("input[name=total_3_scale]").val();
                                } else if (Math.abs(Number(winMoneyTotal)) > Number($("input[name=total_4_1]").val())) {
                                    ratio = $("input[name=total_4_scale]").val();
                                }

                                //退水 = 總投注金額 * 退水(12%) * 公司贏利分成(100-ratio)%
                                return_water = betMoneyTotal * ($("input[name=refunded_scale]").val() / 100) * ((100 - ratio) / 100);
                                //公司淨利 = 未分成盈利*公司分成(100-ratio)% - 總投注金額*退水(12%)*公司負擔退水(100-ratio)%
                                company_profit = winMoneyTotal * (1 - (ratio / 100)) - betMoneyTotal * ($("input[name=refunded_scale]").val() / 100) * (1 - (ratio / 100));
                                //盈利退回 = 未分成盈利*公負擔的盈利(100-ratio)% *-1
                                //要負的 ?????
                                profig_return = winMoneyTotal * ((100 - ratio) / 100);
                                //結算金額 = 退水金額 + 盈利退回
                                money = return_water + profig_return;
                            } else if ($("#agents_type").val() == "流水分成") {

                                //結算金額 = 總投注金額 * 退水(12%)
                                money = betMoneyTotal * ($("input[name=refunded_scale]").val() / 100);
                                //退水金額 = 總投注金額 * 退水(12%)
                                return_water = betMoneyTotal * ($("input[name=refunded_scale]").val() / 100);
                                //公司淨利 = 未分成盈利 - 退水金額
                                company_profit = winMoneyTotal - return_water;
                                //營利退回 = 0
                                profig_return = 0;
                            }
                            $("#money").val(money.toFixed(2));
                            $("#return_water").val(return_water.toFixed(2));
                            $("#company_profit").val(company_profit.toFixed(2));
                            $("#ratio").val(ratio);
                            $("#profig_return").val(profig_return.toFixed(2));
                            $('.form_ajax_submit_btn').attr("disabled", false);
                            $('#loading').hide();
                        }
                );
            }
            function set_e_time(){
                $('#e_time').val($('#s_time').val());
            }

            function setSdate(d){
                $('#s_time').val(d);
                set_e_time();
                onChangeStime();

            }
            function onChangeStime() {
                myfun();
            }
            function onChangeEtime() {
                myfun();
            }
            function submitCheck() {
                if (!$("input[name='s_time']").val() || $("input[name='s_time']").val() == "") {
                    alert("请选择开始日期");
                return false;
                }
                if (!$("input[name='e_time']").val() || $("input[name='e_time']").val() == "") {
                    alert("请选择结束日期");
                    return false;
                }
                return true;
            }
//window.onload = myfun;//不要括号
</script>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
            <tbody>
                <tr>
                    <td height="24" nowrap="" ><font>&nbsp;<span class="STYLE2">代理管理：代理结算信息</span></font></td>
                </tr>
                <tr>
                    <td height="24" align="center" nowrap="" bgcolor="#FFFFFF"><br>
                        <form class="trinput font14 " action="/?r=agent/index/agents-jiesuan-do" method="get" name="form1" id="jisuanForm">
                            <div class="trinput font15 addgents ">
                                <div class="item">
                                    <span class="name">用户名</span>
                                    <input name="agents_name" disabled="disabled" id="agents_name" value="<?= $agents_list['agents_name'] ?>">
                                </div>
                                <div class="item">
                                    <span class="name">代理类型</span>
                                    <input name="agents_type" disabled="disabled" id="agents_type" value="<?= $agents_list['agents_type'] ?>">
                                </div>
                                <div class="item">
                                    <span class="name">代理等级1</span>
                                    <input type="text" name="total_1_1" id='total_1_1' value="<?= $agents_list['total_1_1'] ?>" size="10"disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_1_2" id='total_1_2' value="<?= $agents_list['total_1_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">代理等级1结算比例(百分比):</span><input type="text" name="total_1_scale" id='total_1_scale' disabled="disabled" value="<?= $agents_list['total_1_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">代理等级2</span>
                                    <input type="text" name="total_2_1" id='total_2_1' value="<?= $agents_list['total_2_1'] ?>" size="10" disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_2_2" id='total_2_2' value="<?= $agents_list['total_2_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">  代理等级2结算比例(百分比):</span><input type="text" name="total_2_scale" id='total_2_scale' disabled="disabled" value="<?= $agents_list['total_2_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">代理等级3</span>
                                    <input type="text" name="total_3_1"id='total_3_1' value="<?= $agents_list['total_3_1'] ?>" size="10" disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_3_2"id='total_3_2' value="<?= $agents_list['total_3_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">代理等级3结算比例(百分比):</span><input type="text" name="total_3_scale"id='total_3_scale' disabled="disabled" value="<?= $agents_list['total_3_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">代理等级4</span>
                                    <input type="text" name="total_4_1" id='total_4_1' value="<?= $agents_list['total_4_1'] ?>" size="10" disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_4_2"id='total_4_2' value="<?= $agents_list['total_4_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">代理等级4结算比例(百分比):</span><input type="text" name="total_4_scale"id='total_4_scale' disabled="disabled" value="<?= $agents_list['total_4_scale'] ?>" size="10">
                                </div>
<!--                                <div class="item">-->
<!--                                    <span class="name">代理等级5</span>-->
<!--                                    <input type="text" name="total_5_1"id="total_5_1" value="--><?//= $agents_list['total_5_1'] ?><!--" size="10" disabled="disabled">-->
<!--                                    <span class="ji">~</span><input type="text" name="total_5_2"id='total_5_2' value="--><?//= $agents_list['total_5_2'] ?><!--" size="10" disabled="disabled">-->
<!--                                    <span class="gs">代理等级5结算比例(百分比):</span><input type="text" name="total_5_scale"id='total_5_scale' disabled="disabled" value="--><?//= $agents_list['total_5_scale'] ?><!--" size="10">-->
<!--                                </div>-->
                                <div class ="item">
                                    <span class="name">退水比例(百分比)</span>
                                    <input type="text" name="refunded_scale" id="refunded_scale" value="<?= $agents_list['refunded_scale'] ?>" size="10">
                                </div>
<!--                                <div class="item">-->
<!--                                    <span class="name"><span class="ji">结算开始</span><span class="ji">~</span><span class="ji" style="margin-right: 0px;">结束时间</span></span>-->
<!--                                    <input class="laydate-icon" name="s_time" id="s_time" value="--><?//=$s_time?><!--" onchange="onChangeStime()" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd'})" style="width: 96px;"> -->
<!--                                   <span class="ji">~</span>-->
<!--                                    <input class="laydate-icon" name="e_time" id="e_time" value="--><?//=$e_time?><!--" onchange="onChangeEtime()" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd'})" style="width: 96px;">-->
<!--                                </div>-->
                                <div class="item">
                                    <span class="name">總流水金額</span>
                                    <input type="text" name="ledger" id="ledger" value="0" readonly="">
                                </div>
                                <div class ="item">
                                    <span class="name">退水金額(流水x退x分成)</span>
                                    <input type="text" name="return_water" id="return_water" value="0" size="10" readonly="">
                                </div>
                                <div class="item">
                                    <span class="name">盈利結算</span>
                                    <input type="text" name="profig" id="profig" value="0" readonly="">
                                    <!-- 隱藏欄位 結算類型與公司淨利 -->
                                    <input type="hidden" name="agents_type" id="agents_type" value="<?= $agents_list['agents_type'] ?>">
                                    <input type="hidden" name="company_profit" id="company_profit" value="">
                                    <!-- 隱藏欄位 -->
                                </div>
                                <div class="item">
                                    <span class="name">盈利退回</span>
                                    <input type="text" name="profig_return" id="profig_return" value="0" readonly="">
                                </div>
                                <div class="item">
                                    <span class="name">結算金額</span>
                                    <input type="text" name="money" id="money" value="0">
                                    <span class="ji">系統自動計算的結算金額，可手動編輯結算金額。</span>
                                </div>
                                <div class="item">
                                    <span>起始為00:00 ~ 次日23:59:59(統計金額與結算)</span>
                                </div>
                                <span class="name">結算日期</span>
                                <input class="laydate-icon" name="s_time" id="s_time" value="<?=$s_time?>" onchange="onChangeStime();set_e_time();" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd'});onChangeStime();set_e_time();" style="width: 96px;">
                                <input type="hidden" class="laydate-icon" name="e_time" id="e_time" value="<?=$s_time?>">
                                <input type="button" value="今日" onclick="setSdate('<?php echo date('Y-m-d');?>')">
                                <input type="button" value="昨日" onclick="setSdate('<?php echo date('Y-m-d',strtotime('-1 day')); ?>')">
                                <input type="button" value="前日" onclick="setSdate('<?php echo date('Y-m-d',strtotime('-2 day')); ?>')">
                                <div class="item  agenbtnct">
                                    <div class="ct">
                                        <input name="id"  type="hidden" value="<?= $agents_list['id'] ?>">
                                        <input name="ratio"  id="ratio"  type="hidden" >
                                        <input type="hidden" name="agent_level" value="<?= $agents_list['agent_level'] ?>">
                                        <input type="button" class="form_ajax_submit_btn" data-targetid="jisuanForm" value="确认提交"> 　
                                        <input type="button" value="取 消" onclick="javascript: history.go(-1)">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
<script>
	$(function () {
		myfun();
	});
    function test(){
        var form = $("#jisuanForm");
//        alert(form.attr('action'));
//        alert(form.serialize());
        $.ajax({
            type:'GET',
            url:form.attr('action'),
            data:form.serialize(),
            success:function(data){
                    alert(data);
            }
        });
//        $.get(form.attr('action'), form.serialize(), function (data) {
//            alert(data);
//                    data = $.parseJSON(data);
//                    $.dialog.notify(data.status);
//         });
    }
</script>