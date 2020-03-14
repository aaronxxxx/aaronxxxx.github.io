<?php
//var_dump($agents_list);exit;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>代理結算信息展示</title>
    </head>
    <body>
        <script>
            function myfun() {
                $.get(
                        "/?r=agent/index/agents-jiesuan-ajax",
                        {id: $("input[name=id]").val(), s_time: $("#s_time").val(), e_time: $("#s_time").val(), code: 1},
                        function (result) {
                            console.log(result);
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
                                if (winMoneyTotal > 0) {
                                    if (Number(winMoneyTotal) < Number($("input[name=total_1_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_1_scale]").val();
                                        ratio = $("input[name=total_1_scale]").val();
                                    } else if (Number(winMoneyTotal) < Number($("input[name=total_2_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_2_scale]").val();
                                        ratio = $("input[name=total_2_scale]").val();
                                    } else if (Number(winMoneyTotal) < Number($("input[name=total_3_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_3_scale]").val();
                                        ratio = $("input[name=total_3_scale]").val();
                                    } else if (Number(winMoneyTotal) < Number($("input[name=total_4_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_4_scale]").val();
                                        ratio = $("input[name=total_4_scale]").val();
                                    } else if (Number(winMoneyTotal) < Number($("input[name=total_5_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_5_scale]").val();
                                        ratio = $("input[name=total_5_scale]").val();
                                    }
                                }
                                else if(winMoneyTotal < 0){
                                    if (Math.abs(Number(winMoneyTotal)) < Number($("input[name=total_1_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_1_scale]").val();
                                        ratio = $("input[name=total_1_scale]").val();
                                    } else if (Math.abs(Number(winMoneyTotal)) < Number($("input[name=total_2_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_2_scale]").val();
                                        ratio = $("input[name=total_2_scale]").val();
                                    } else if (Math.abs(Number(winMoneyTotal)) < Number($("input[name=total_3_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_3_scale]").val();
                                        ratio = $("input[name=total_3_scale]").val();
                                    } else if (Math.abs(Number(winMoneyTotal)) < Number($("input[name=total_4_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_4_scale]").val();
                                        ratio = $("input[name=total_4_scale]").val();
                                    } else if (Math.abs(Number(winMoneyTotal)) < Number($("input[name=total_5_2]").val())) {
                                        money = winMoneyTotal * $("input[name=total_5_scale]").val();
                                        ratio = $("input[name=total_5_scale]").val();
                                    }
                                }
                            } else if ($("#agents_type").val() == "流水分成") {
                                if (betMoneyTotal > 0) {
                                    if (Number(betMoneyTotal) < Number($("input[name=total_1_2]").val())) {
                                        money = betMoneyTotal * $("input[name=total_1_scale]").val();
                                        ratio = $("input[name=total_1_scale]").val();
                                    } else if (Number(betMoneyTotal) < Number($("input[name=total_2_2]").val())) {
                                        money = betMoneyTotal * $("input[name=total_2_scale]").val();
                                        ratio = $("input[name=total_2_scale]").val();
                                    } else if (Number(betMoneyTotal) < Number($("input[name=total_3_2]").val())) {
                                        money = betMoneyTotal * $("input[name=total_3_scale]").val();
                                        ratio = $("input[name=total_3_scale]").val();
                                    } else if (Number(betMoneyTotal) < Number($("input[name=total_4_2]").val())) {
                                        money = betMoneyTotal * $("input[name=total_4_scale]").val();
                                        ratio = $("input[name=total_4_scale]").val();
                                    } else if (Number(betMoneyTotal) < Number($("input[name=total_5_2]").val())) {
                                        money = betMoneyTotal * $("input[name=total_5_scale]").val();
                                        ratio = $("input[name=total_5_scale]").val();
                                    }
                                }
                            }
                            $("#money").val(money / 100);
                            $("input[name=ratio]").val(ratio);
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
                    alert("請選擇開始日期");
                    return false;
                }
                if (!$("input[name='e_time']").val() || $("input[name='e_time']").val() == "") {
                    alert("請選擇結束日期");
                    return false;
                }
                return true;
            }
            //window.onload = myfun;//不要括號
        </script>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
            <tbody>
                <tr>
                    <td height="24" nowrap="" ><font>&nbsp;<span class="STYLE2">代理管理：代理結算信息</span></font></td>
                </tr>
                <tr>
                    <td height="24" align="center" nowrap="" bgcolor="#FFFFFF"><br>
                        <form class="trinput font14 " action="/?r=agent/sum-index/agents-jiesuan-do" method="get" name="form1" id="jisuanForm">
                            <div class="trinput font15 addgents ">
                                <div class="item">
                                    <span class="name">用戶名</span>
                                    <input name="agents_name" disabled="disabled" id="agents_name" value="<?= $agents_list['agents_name'] ?>">
                                </div>
                                <div class="item">
                                    <span class="name">代理類型</span>
                                    <input name="agents_type" disabled="disabled" id="agents_type" value="<?= $agents_list['agents_type'] ?>">
                                </div>
                                <div class="item">
                                    <span class="name">業績等級1</span>
                                    <input type="text" name="total_1_1" id='total_1_1' value="<?= $agents_list['total_1_1'] ?>" size="10"disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_1_2" id='total_1_2' value="<?= $agents_list['total_1_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">業績等級1結算比例(百分比):</span><input type="text" name="total_1_scale" id='total_1_scale' disabled="disabled" value="<?= $agents_list['total_1_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">業績等級2</span>
                                    <input type="text" name="total_2_1" id='total_2_1' value="<?= $agents_list['total_2_1'] ?>" size="10" disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_2_2" id='total_2_2' value="<?= $agents_list['total_2_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">  業績等級2結算比例(百分比):</span><input type="text" name="total_2_scale" id='total_2_scale' disabled="disabled" value="<?= $agents_list['total_2_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">業績等級3</span>
                                    <input type="text" name="total_3_1"id='total_3_1' value="<?= $agents_list['total_3_1'] ?>" size="10" disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_3_2"id='total_3_2' value="<?= $agents_list['total_3_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">業績等級3結算比例(百分比):</span><input type="text" name="total_3_scale"id='total_3_scale' disabled="disabled" value="<?= $agents_list['total_3_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">業績等級4</span>
                                    <input type="text" name="total_4_1" id='total_4_1' value="<?= $agents_list['total_4_1'] ?>" size="10" disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_4_2"id='total_4_2' value="<?= $agents_list['total_4_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">業績等級4結算比例(百分比):</span><input type="text" name="total_4_scale"id='total_4_scale' disabled="disabled" value="<?= $agents_list['total_4_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">業績等級5</span>
                                    <input type="text" name="total_5_1"id="total_5_1" value="<?= $agents_list['total_5_1'] ?>" size="10" disabled="disabled">
                                    <span class="ji">~</span><input type="text" name="total_5_2"id='total_5_2' value="<?= $agents_list['total_5_2'] ?>" size="10" disabled="disabled">
                                    <span class="gs">業績等級5結算比例(百分比):</span><input type="text" name="total_5_scale"id='total_5_scale' disabled="disabled" value="<?= $agents_list['total_5_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">結算日期</span>
                                    <input class="laydate-icon" name="s_time" id="s_time" value="<?=$s_time?>" onchange="onChangeStime();set_e_time();" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd'})" style="width: 96px;">
                                    <input type="hidden" class="laydate-icon" name="e_time" id="e_time" value="<?=$s_time?>">
                                    <input type="button" value="今日" onclick="setSdate('<?php echo date('Y-m-d');?>')">
                                    <input type="button" value="昨日" onclick="setSdate('<?php echo date('Y-m-d',strtotime('-1 day')); ?>')">
                                    <input type="button" value="前日" onclick="setSdate('<?php echo date('Y-m-d',strtotime('-2 day')); ?>')">
                                </div>
                                <div class="item">
                                    <span class="name">所選時間流水</span>
                                    <input type="text" name="ledger" id="ledger" value="0" readonly="">
                                </div>
                                <div class="item">
                                    <span class="name">所選時間贏利</span>
                                    <input type="text" name="profig" id="profig" value="0" readonly="">
                                </div>
                                <div class="item">
                                    <span class="name">結算金額</span>
                                    <input type="text" name="money" id="money" value="0">
                                    <span class="ji">系統自動計算的結算金額，也可手動編輯結算金額。</span>
                                </div>
                                <div class="item  agenbtnct">
                                    <div class="ct">
                                        <input name="id" type="hidden" value="<?= $agents_list['id'] ?>">
                                        <input name="ratio" type="hidden" >
                                        <input type="button" class="form_ajax_submit_btn" data-targetid="jisuanForm" value="確認提交"> 　
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
            data:form.serialize()+'&e_time='+$('#s_time').val(),
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