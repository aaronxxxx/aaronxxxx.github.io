<table width="100%" border="0" cellpadding="3" cellspacing="1">
            <tr>
                <td  nowrap><font class="pro_title">賬單詳細查看</font></td>
            </tr>
            <tr>
                <td  align="center" nowrap bgcolor="#FFFFFF">
                    <br>
                    <form action="" method="" name="form1" id="form1">
                        <input name="status_log" type="hidden" id="status_log" value="已支付">
                        <table  cellspacing="0" cellpadding="0" class="settable bordercolor" style="width: 661px;">
                            <tr>
                                <td  class="pdrgt15">用戶名</td>
                                <td>
                                    <a href="?r=member/user&user&uid=<?= $rows['user_id'] ?>"><?= $rows["user_name"] ?>
                                        <input name="uid" type="hidden" id="uid" value="<?= $rows['user_id'] ?>">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">訂單號</td>
                                <td> 
                                    <?= $rows["order_num"] ?>
                                    <input name="m_order" type="hidden" id="m_order" value="<?= $rows["order_num"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">開戶行</td>
                                <td><?= $rows["pay_card"] ?></td>
                            </tr>
                            <tr>
                                <td width="172"  class="pdrgt15">卡號</td>
                                <td width="473"><?= $rows["pay_num"] ?></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">開戶姓名</td>
                                <td><?= $rows["pay_name"] ?></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">開戶地址</td>
                                <td><?= $rows["pay_address"] ?></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">備註</td>
                                <td><?= $rows["remark"] ?></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15"><?=$rows['type']?>前餘額</td>
                                <td><span style="color:#999999;"><?= $rows["assets"] ?></span></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">金額</td>
                                <td><?= abs($rows["order_value"]) ?>
                                    <input name="title" type="hidden" id="title" value="您於：<?= $rows["update_time"] ?> 申請的提款：<?= abs($rows["order_value"]) ?> 失敗了！"></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15"><?=$rows['type']?>後餘額</td>
                                <td><span style="color:#999999;"><?= $rows["balance"] ?></span></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">申請時間</td>
                                <td><?= $rows["update_time"] ?></td>
                            </tr>
                            <?php if($rows["status"]=='未結算' || $rows["status"]=='審核中'){ ?>
                            <tr>
                                <td  class="pdrgt15">操作</td>
                                <td>
                                    <input name="status" type="radio" id="status" onClick="chang()" value="1" checked><span style="color:#009900">已支付</span>
                                    &nbsp;
                                    <input type="radio" name="status" id="radio" onClick="chang()" value="0"><span style="color:#FF0000">未支付</span>
                                    &nbsp;
                                    <input type="radio" name="status" id="radio" onClick="chang()" value="3"><span style="color:#FF0000">審核中</span>
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15"><div id="d_txt">請填寫本次提款的實際手續費</div></td>
                                <td><div id="d_text">
                                        <input name="sxf" type="text" id="sxf" size="20" maxlength="20" value="0">&nbsp;元
                                        &nbsp;&nbsp;&nbsp;&nbsp;理由：<input name="about" id="about" size="30" value="<?= $rows["about"] ?>">
                                    </div></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">提示</td>
                                <td>
                                    今日提款次數：<?= $rows['today_tk_cs'] ?>，總提款次數：<?= $rows['total_tk_cs'] ?>。
                                    <br/>最後一筆存款時間：<?= $rows["end_time"] ?>。最後一筆存款金額：<?= $rows["order_v"] ?>。最後一筆存款後的有效投注總額：<span style="color: red"><?= $rows['tz_money'] ?></span>。
                                    <br/>(該數據僅供參考，請核對會員數據再進行提款操作。)
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">操作</td>
                                <td>
                                    <?php if(in_array($rows["pay_name"],$hacker_list)){ ?>
                                    該用戶在黑客、不誠信、惡意用戶名單中，請謹慎提交該提款 
                                    <input type="button" onclick="tixian('<?=$rows['id']?>');" value="繼續提交(後果自負)"/>
                                    <a href="?r=member/hacker/index&id=1">查看非法用戶</a>
                                    <?php }else{ ?>
                                    <input type="button" onclick="tixian('<?=$rows['id']?>');" value="提交"/>
                                    <a href="?r=live/log/check&userid=<?= $rows['user_id'] ?>&username=<?= $rows["user_name"] ?>"><span style="color:#F37605;">核查會員</span></a>
                                    <a href="?r=member/hacker/index&id=1">查看非法用戶</a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php }else{?>
                            <tr>
                                <td  class="pdrgt15">狀態</td>
                                <td>
                                    <?php if($rows["status"]=='成功'){?>
                                   <span style="color:#006600;">成功</span>
                                    <?php }else{?>
                                   <span style="color:#FF0000;">失敗</span>
                                    <?php }?>
                                </td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">處理時間</td>
                                <td><?= $rows["update_time"] ?></td>
                            </tr>
                            <tr>
                                <td  class="pdrgt15">手續費</td>
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
<script language="javascript">
            function chang() {
                var type = $("input[name='status']:checked").val();
                if (type == 1) {
                    var status_log = '已支付';
                    $("#d_txt").html('請填寫本次匯款的實際手續費');
                    $("#d_text").html("<input name=\"sxf\" type=\"text\" value=\"0\" id=\"sxf\" size=\"20\" maxlength=\"20\">&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;理由：<input name=\"about\" id=\"about\" size=\"30\"  value=\"<?= $rows["about"] ?>\">");
                } else if (type == 0) {
                    var status_log = '未支付';
                    $("#d_txt").html('請填寫未支付原因');
                    $("#d_text").html("<textarea name=\"about\" id=\"about\" cols=\"45\" rows=\"5\"><?= $rows["about"] ?></textarea>");
                } else {
                    var status_log = '審核中';
                    $("#d_txt").html('&nbsp;');
                    $("#d_text").html('&nbsp;');
                }
                $("#status_log").val(status_log);
            }

            function tixian(id) {
                var type = $("input[name='status']:checked").val();
                if (type == 1) {
                    if ($("#sxf").val().length < 1) {
                        layer.alert('請您填寫本次匯款的實際手續費');
                        $("#sxf").focus();
                        return false;
                    } else {
                        var sxf = $("#sxf").val() * 1;
                        if (sxf < 0) {
                            alert('請輸入正確的手續費');
                            $("#sxf").select();
                            return false;
                        }
                    }
                } else if(type==2) {
                    if ($("#about").val().length < 4) {
                        alert('請填寫未支付原因');
                        $("#about").focus();
                        return false;
                    }
                }
                $.ajax({
                type: "POST",
                url: '/?r=finance/fund/do-tixian&m_id='+id,
                data: $('#form1').serialize(),
                error:function () {
                    layer.alert('出錯了，請稍後再試');
                   window.location.href="?r=finance/fund/tixian&status=未結算";
                },
                success: function(data){
                    layer.alert(data);
                        window.location.href="?r=finance/fund/tixian&status=未結算";
                 
                }
            })
            }
        </script>