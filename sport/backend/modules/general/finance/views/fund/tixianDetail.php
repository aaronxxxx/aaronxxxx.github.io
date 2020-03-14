<table width="100%" border="0" cellpadding="3" cellspacing="1">
            <tr>
                <td  nowrap><font class="pro_title">账单详细查看</font></td>
            </tr>
            <tr>
                <td  align="center" nowrap bgcolor="#FFFFFF">
                    <br>
                    <form action="" method="" name="form1" id="form1">
                        <input name="status_log" type="hidden" id="status_log" value="已支付">
                        <table  cellspacing="0" cellpadding="0" class="settable bordercolor" style="width: 661px;">
                            <tr>
                                <td  class="pdrgt15">用户名</td>
                                <td>
                                    <a href="#/member/user&user&uid=<?= $rows['user_id'] ?>"><?= $rows["user_name"] ?>
                                        <input name="uid" type="hidden" id="uid" value="<?= $rows['user_id'] ?>">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">订单号</td>
                                <td> 
                                    <?= $rows["order_num"] ?>
                                    <input name="m_order" type="hidden" id="m_order" value="<?= $rows["order_num"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">开户行</td>
                                <td><?= $rows["pay_card"] ?> <input style="margin-left:44px"; type="button" value="複製" onclick="copyToClipBoard('<?= $rows["pay_card"] ?>')"></button></td>
                            </tr>
                            <tr>
                                <td width="172"  class="pdrgt15">卡号</td>
                                <td width="473"><?= $rows["pay_num"] ?><input style="margin-left:44px"; type="button" value="複製" onclick="copyToClipBoard('<?= $rows["pay_num"] ?>')"></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">开户姓名</td>
                                <td><?= $rows["pay_name"] ?><input style="margin-left:44px"; type="button" value="複製" onclick="copyToClipBoard('<?= $rows["pay_name"] ?>')"></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">开户地址</td>
                                <td><?= $rows["pay_address"] ?><input style="margin-left:44px"; type="button" value="複製" onclick="copyToClipBoard('<?= $rows["pay_address"] ?>')"></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">备注</td>
                                <td><?= $rows["remark"] ?></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15"><?=$rows['type']?>前余额</td>
                                <td><span style="color:#999999;"><?= $rows["assets"] ?></span></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">金额</td>
                                <td><?= abs($rows["order_value"]) ?>
                                    <input name="title" type="hidden" id="title" value="您于：<?= $rows["update_time"] ?> 申请的提款：<?= abs($rows["order_value"]) ?> 失败了！">
                                    <input style="margin-left:44px"; type="button" value="複製" onclick="copyToClipBoard('<?= abs($rows["order_value"]) ?>')">
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15"><?=$rows['type']?>后余额</td>
                                <td><span style="color:#999999;"><?= $rows["balance"] ?></span></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">申请时间</td>
                                <td><?= $rows["update_time"] ?></td>
                            </tr>
                            <?php if($rows["status"]=='未结算' || $rows["status"]=='审核中'){ ?>
                            <tr>
                                <td  class="pdrgt15">操作</td>
                                <td>
                                    <input name="status" type="radio" id="status" onClick="chang()" value="1" checked><span style="color:#009900">已支付</span>
                                    &nbsp;
                                    <input type="radio" name="status" id="radio" onClick="chang()" value="0"><span style="color:#FF0000">未支付</span>
                                    &nbsp;
                                    <input type="radio" name="status" id="radio" onClick="chang()" value="3"><span style="color:#FF0000">审核中</span>
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15"><div id="d_txt">请填写本次提款的实际手续费</div></td>
                                <td><div id="d_text">
                                        <input name="sxf" type="text" id="sxf" size="20" maxlength="20" value="0">&nbsp;元
                                        &nbsp;&nbsp;&nbsp;&nbsp;理由：<input name="about" id="about" size="30" value="<?= $rows["about"] ?>">
                                    </div></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">提示</td>
                                <td>
                                    今日提款次数：<?= $rows['today_tk_cs'] ?>，总提款次数：<?= $rows['total_tk_cs'] ?>。
                                    <br/>最后一笔存款时间：<?= $rows["end_time"] ?>。最后一笔存款金额：<?= $rows["order_v"] ?>。最后一笔存款后的有效投注总额：<span style="color: red"><?= $rows['tz_money'] ?></span>。
                                    <br/>(该数据仅供参考，请核对会员数据再进行提款操作。)
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">操作</td>
                                <td>
                                    <?php if(in_array($rows["pay_name"],$hacker_list)){ ?>
                                    该用户在黑客、不诚信、恶意用户名单中，请谨慎提交该提款 
                                    <input type="button" onclick="tixian('<?=$rows['id']?>');" value="继续提交(后果自负)"/>
                                    <a href="#/member/hacker/index&id=1">查看非法用户</a>
                                    <?php }else{ ?>
                                    <input type="button" onclick="tixian('<?=$rows['id']?>');" value="提交"/>
                                    <a href="#/live/log/check&userid=<?= $rows['user_id'] ?>&username=<?= $rows["user_name"] ?>"><span style="color:#F37605;">核查会员</span></a>
                                    <a href="#/member/hacker/index&id=1">查看非法用户</a>
                                    <?php }?>

                                    <?php if($rows["status"]=='未结算' || $rows["status"]=='审核中'){ 
                                            if($rows['total_tk_cs']==0){ ?>
                                            <span style="color:#FF0000;margin-left: 100px;">首次提款，注意审核！！！</span>
                                        <?php } else if($rows['total_tk_cs']==1){?>
                                            <span style="color:#FF0000;margin-left: 100px;">二次提款，注意审核！！！</span>
                                        <?php } }?>

                                    <?php if( ($rows["status"]=='未结算' || $rows["status"]=='审核中') && $rows['total_tk_cs'] < 2){ ?>
                                        <input type="button" data-toggle="modal" data-target="#ThirdPayModal" value="代付出款">
                                    <?php } ?>
                                    
                                </td>
                            </tr>
                            <?php }else{?>
                            <tr>
                                <td  class="pdrgt15">状态</td>
                                <td>
                                    <?php if($rows["status"]=='成功'){?>
                                   <span style="color:#006600;">成功</span>
                                    <?php }else{?>
                                   <span style="color:#FF0000;">失败</span>
                                    <?php }?>
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">处理时间</td>
                                <td><?= $rows["update_time"] ?></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">手续费</td>
                                <td><?= $rows["sxf"] ?></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">原因</td>
                                <td><?= $rows["about"] ?></td>
                            </tr>
                            <?php }?>
                        </table>
                    </form>
                </td>
            </tr>
        </table>


<?php if(!empty($pay_log)){ ?>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" style="margin-top: 50px;">
            <tr>
                <td align="center"  nowrap><font class="pro_title">代付資訊</font></td>
            </tr>
            <tr>
                <td  align="center" nowrap bgcolor="#FFFFFF">

<table border="1"  cellspacing="0" cellpadding="0" class="font12 skintable" style="width:661px" >
                    <tr class="t-title dailitr" align="center">
                        <td width="5%" ><strong>處理時間</strong></td>
                        <td width="8%" ><strong>狀態</strong></td>
                    </tr>
                    <?php foreach($pay_log as $patRow){  
                        ?>
                            <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'">
                                <td height="20" align="center"  ><?= $patRow["update_time"] ?></td>
                                <td height="20" align="center"  ><?= $patRow["error_msg"] ?></td>
                            </tr>
                    <?php }?>
                </table>
                </td>
            </tr>
        </table>
                <?php } ?>

<?php if( ($rows["status"]=='未结算' || $rows["status"]=='审核中') && $rows['total_tk_cs'] < 2){ ?>
<!-- Modal -->
<div class="modal fade" id="ThirdPayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="display:flex;">
        <h5 class="modal-title" id="exampleModalLabel" style="flex:auto;">代付出款</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tpForm">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">输入付款金额:</label>
                <input type="text" class="form-control" name="amount" id="recipient-name" placeholder="重新验证请款用，请输入正确金额">
                <input type="hidden" id="tp_id" name="id" value="<?=$rows['id']?>">
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">请选择代付方资讯:</label>
                <select class="form-control" id="message-text" name="type">
                <option value=''>请选择</option>
                <?php foreach($pay_data as $payRow){
                ?>
                <option value='<?php echo $payRow['pay_type']; ?>'><?php echo $payRow['platform_name'];?></option>

                <?php } ?>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onclick="thirdPaySend();">送出</button>
      </div>
    </div>
  </div>
</div>

<!-- loading -->
<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="display:flex;">
        <h5 class="modal-title" id="exampleModalLabel" style="flex:auto;">test</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 test2
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onclick="thirdPaySend();">送出</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<script type="text/javascript" language="javascript" src="public/common/js/jquery.blockUI.js"></script>

<script language="javascript">

function thirdPaySend(){
    $('#ThirdPayModal').modal('hide');
    $.blockUI({message:'<h1>请稍候...</h1>如等待过久，请重新刷新后再试'});
    //第三方代付

    $.ajax({
        type: "POST",
        url: '/?r=thirdpay/do-pay/pay',
        data: $('#tpForm').serialize(),
        dataType: "json",

        error:function () {
            $.unblockUI();
            layer.alert('出错了，请稍后再试');

        },
        success: function(data){
            $.unblockUI();
            if(data.code == 1) {
                layer.alert(data.msg, { 
                    yes: function(index, layero){
                        location.reload();
                    },
                    cancel: function(index, layero){
                        location.reload();
                        return false;
                    }
                });
            } else {
                layer.alert(data.msg);
            }

        }
    });
}



function copyToClipBoard(msg){
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(msg).select();
    document.execCommand("copy");
    $temp.remove();
    $.dialog.notify("已複製至您的剪貼簿。");
}

function chang() {
    var type = $("input[name='status']:checked").val();
    if (type == 1) {
        var status_log = '已支付';
        $("#d_txt").html('请填写本次汇款的实际手续费');
        $("#d_text").html("<input name=\"sxf\" type=\"text\" value=\"0\" id=\"sxf\" size=\"20\" maxlength=\"20\">&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;理由：<input name=\"about\" id=\"about\" size=\"30\"  value=\"<?= $rows["about"] ?>\">");
    } else if (type == 0) {
        var status_log = '未支付';
        $("#d_txt").html('请填写未支付原因');
        $("#d_text").html("<textarea name=\"about\" id=\"about\" cols=\"45\" rows=\"5\"><?= $rows["about"] ?></textarea>");
    } else {
        var status_log = '审核中';
        $("#d_txt").html('&nbsp;');
        $("#d_text").html('&nbsp;');
    }
    $("#status_log").val(status_log);
}

function tixian(id) {
    var type = $("input[name='status']:checked").val();
    if (type == 1) {
        if ($("#sxf").val().length < 1) {
            layer.alert('请您填写本次汇款的实际手续费');
            $("#sxf").focus();
            return false;
        } else {
            var sxf = $("#sxf").val() * 1;
            if (sxf < 0) {
                alert('请输入正确的手续费');
                $("#sxf").select();
                return false;
            }
        }
    } else if(type==2) {
        if ($("#about").val().length < 4) {
            alert('请填写未支付原因');
            $("#about").focus();
            return false;
        }
    }
    $.ajax({
    type: "POST",
    url: '/?r=finance/fund/do-tixian&m_id='+id,
    data: $('#form1').serialize(),
    error:function () {
        layer.alert('出错了，请稍后再试');
        window.location.href="#/finance/fund/tixian&status=未结算";
    },
    success: function(data){
        layer.alert(data);
            window.location.href="#/finance/fund/tixian&status=未结算";
        
    }
})
}
</script>