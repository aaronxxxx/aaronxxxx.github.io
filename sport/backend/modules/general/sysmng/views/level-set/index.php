
 <link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="content">
            <div id="content-inner">
                <h2>
                    <b></b>
                    <span class=" white">會員等級設置</span>
                </h2>
                <div id="content_inner">
                    <div>

                    </div>
                </div>
                <div id="game">
                    <div class="showT">
                        <form action="/?r=sysmng/level-set" metdod="post" id="form1">
                            <div class="round-table">
                                <table class="GameTable">
                                    <tbody>
                                    <tr  class="t-title dailitr" align="center">

                                        <td style =“width：13％”align =“center”> <strong>等级名</strong> </td>
                                        <td style =“width：13％”align =“center”> <strong>每日投注量</strong> </td>
                                        <td style =“width：13％”align =“center”> <strong>每日充值量</strong> </td>
                                        <td style =“width：13％”align =“center”> <strong>每期最高投注额度</strong> </td>
                                        <td style =“width：12％”align =“center”> <strong>每日提领次数</strong> </td>
                                        <td style =“width：12％”align =“center”> <strong>超出次数手续费</strong> </td>

                                    </tr>
                                    <?php   foreach ($group as $key=>$val){  ?>
                                    <tr>
                                    <input type="hidden" value="<?=$val['level_id'];?>" name="level_id[]" ></td>
                                        <td><input type="text" value="<?=$val['level_name'];?>" name="level_name[]" ></td>
                                        <td class="choose">
                                            <input type="text" value="<?=$val['day_bet'];?>" name="day_bet[]" ></td>
                                        <td class="choose">
                                            <input type="text" value="<?=$val['day_recharge'];?>" name="day_recharge[]" class="w70"></td>
                                        <td class="choose">
                                            <input type="text" value="<?=$val['qishu_max_bet'];?>" name="qishu_max_bet[]"></td>
                                        <td class="choose">
                                            <input type="text" value="<?=$val['day_withdraw'];?>" name="day_withdraw[]">
                                        </td>
                                        <td class="choose">
                                            <input type="text" value="<?=$val['over_fee'];?>" name="over_fee[]">
                                        </td>
                                    </tr>
                                   
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div id="SendB5">
                                <button id="btn-save-odds" class="order" type="">保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        //赔率修改
        $(".order").bind("click",function(event){
            event.preventDefault();  //阻止默认行为 ( 表单提交 )或者return false;
            var action = $("#form1").attr('action');
            $.ajax({
                type: "POST",
                url: action,
                data: $("#form1").serialize(),
                error:function () {
                    alert('出错了，请稍后再试');
                },
                success: function(data){
                    alert(data,function(index) {
                        window.location.reload();
                    })
                }
            })
        })
    })
</script>