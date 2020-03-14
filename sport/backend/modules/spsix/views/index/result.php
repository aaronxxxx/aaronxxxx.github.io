<?php use yii\widgets\LinkPager;?>

            <form name="form1" method="post" action="?r=spsix/index/update-result" id="form1">
                <div class="font12 trinput resulttable zudan">

                    <p>
                        <span>彩票类别：</span>
                        <span><strong>极速六合彩</strong></span>
                        <button type="button" onclick="javascript:location.href='#/lotteryresult/batch&type=极速六合彩'">批量开奖</button>
                    </p>
                    <p>
                        <span>开奖期号：</span>
                        <span><input  onchange="if(/\D/.test(this.value)){alert('期号只能输入数字');this.value='';}" name="qishu" type="text" id="qishu" value="<?php echo isset($saveData['qishu']) && $saveData['qishu'] ? $saveData['qishu']:'';?>" size="20" maxlength="16"></span>
                    </p>
                    <p>
                        <span>开奖时间：</span>
                        <span><input class="laydate-icon" name="datetime" type="text" id="datetime" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})" value="<?php echo isset($saveData['datetime']) && $saveData['datetime'] ? $saveData['datetime']:'';?>" size="20" maxlength="19"> 注意：时间格式务必填写正确，如2014-10-10 10:10:10</span>
                    </p>
                    <p >
                        <span>开奖号码：</span>
                        <span>
                            <select name="ball_1" id="ball_1" style="width: 72px;">
                                <?php for($i=0;$i<50;$i++){
                                    if($i==0){?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_1']) && !$saveData['ball_1'] ? 'selected':'';?>>正码一</option>
                                    <?php }else{?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_1']) && $saveData['ball_1']==$i ? 'selected':'';?>><?=$i;?></option>
                                <?php }
                                }?>
                            </select>
                            <select name="ball_2" id="ball_2" style="width: 72px;">
                                <?php for($i=0;$i<50;$i++){
                                    if($i==0){?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_2']) && !$saveData['ball_2'] ? 'selected':'';?>>正码二</option>
                                    <?php }else{?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_2']) && $saveData['ball_2']==$i ? 'selected':'';?>><?=$i;?></option>
                                    <?php }
                                }?>
                            </select>
                            <select name="ball_3" id="ball_3" style="width: 72px;">
                                <?php for($i=0;$i<50;$i++){
                                    if($i==0){?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_3']) && !$saveData['ball_3'] ? 'selected':'';?>>正码三</option>
                                    <?php }else{?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_3']) && $saveData['ball_3']==$i ? 'selected':'';?>><?=$i;?></option>
                                    <?php }
                                }?>
                            </select>
                            <select name="ball_4" id="ball_4" style="width: 74px;">
                                <?php for($i=0;$i<50;$i++){
                                    if($i==0){?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_4']) && !$saveData['ball_4'] ? 'selected':'';?>>正码四</option>
                                    <?php }else{?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_4']) && $saveData['ball_4']==$i ? 'selected':'';?>><?=$i;?></option>
                                    <?php }
                                }?>
                            </select>
                            <select name="ball_5" id="ball_5" style="width: 74px;">
                                <?php for($i=0;$i<50;$i++){
                                    if($i==0){?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_5']) && !$saveData['ball_5'] ? 'selected':'';?>>正码五</option>
                                    <?php }else{?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_5']) && $saveData['ball_5']==$i ? 'selected':'';?>><?=$i;?></option>
                                    <?php }
                                }?>
                            </select>
                            <select name="ball_6" id="ball_6" style="width: 74px;">
                                <?php for($i=0;$i<50;$i++){
                                    if($i==0){?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_6']) && !$saveData['ball_6'] ? 'selected':'';?>>正码六</option>
                                    <?php }else{?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_6']) && $saveData['ball_6']==$i ? 'selected':'';?>><?=$i;?></option>
                                    <?php }
                                }?>
                            </select>
                            <select name="ball_7" id="ball_7" style="width: 73px;">
                                <?php for($i=0;$i<50;$i++){
                                    if($i==0){?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_7']) && !$saveData['ball_7'] ? 'selected':'';?>>特别号</option>
                                    <?php }else{?>
                                        <option value="<?=$i;?>" <?php echo isset($saveData['ball_7']) && $saveData['ball_7']==$i ? 'selected':'';?>><?=$i;?></option>
                                    <?php }
                                }?>
                            </select>
                        </span>
                    </p>
                    <p>
                        <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                    </p>
                    <p>

                        <input type="hidden" name="update" value="<?=$update?>">
                        <span>
                            <input type="button" class="form_ajax_submit_btn mgl61" data-targetid="form1" data-redirect="/#/spsix/index/result&t=<?=time();?>" name="submit" value="确认发布">
                        </span>
                    </p>
                </div>
            </form>

            <form name="form2" method="get" id="gridSearchForm" action="#/spsix/index/result">
                <div class="font12 mgb10">

                    <p class="trinput ">

                           开奖期号：
                            <input name="qishu_query" type="text" id="qishu_query" value="<?=$qishu_query ?$qishu_query:'';?>" size="20" maxlength="11">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" id="gridSearchBtn" class="submit80" name="submit" value="搜索">

                </p>
                </div>
            </form>
            <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35" >
                <tbody>
                <tr class="namecolor">
                    <td align="center"><strong>彩票类别</strong></td>
                    <td align="center"><strong>彩票期号</strong></td>
                    <td align="center"><strong>开奖时间</strong></td>
                    <td align="center"><strong>正码一</strong></td>
                    <td align="center"><strong>正码二</strong></td>
                    <td align="center"><strong>正码三</strong></td>
                    <td align="center"><strong>正码四</strong></td>
                    <td height="25" align="center"><strong>正码五</strong></td>
                    <td align="center"><strong>正码六</strong></td>
                    <td align="center"><strong>特别号</strong></td>
                    <td align="center">结算</td>
                    <td align="center"><strong>重算</strong></td>
                    <td align="center"><strong>操作</strong></td>
                </tr>
                <?php
                    if($list){
                        foreach ($list as $key=>$val){?>
                            <tr align="center" onmouseover="this.style.backgroundColor='#EBEBEB'" onmouseout="this.style.backgroundColor='#ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                                <td height="25" align="center" valign="middle">极速六合彩</td>
                                <td align="center" valign="middle"><?=$val['qishu'];?></td>
                                <td align="center" valign="middle"><?=$val['datetime']?></td>
                                <td align="center" valign="middle"><img src="/public/common/images/Lottery/lhc/<?=$val['ball_1']?>.png"></td>
                                <td align="center" valign="middle"><img src="/public/common/images/Lottery/lhc/<?=$val['ball_2']?>.png"></td>
                                <td align="center" valign="middle"><img src="/public/common/images/Lottery/lhc/<?=$val['ball_3']?>.png"></td>
                                <td align="center" valign="middle"><img src="/public/common/images/Lottery/lhc/<?=$val['ball_4']?>.png"></td>
                                <td align="center" valign="middle"><img src="/public/common/images/Lottery/lhc/<?=$val['ball_5']?>.png"></td>
                                <td align="center" valign="middle"><img src="/public/common/images/Lottery/lhc/<?=$val['ball_6']?>.png"></td>
                                <td align="center" valign="middle"><img src="/public/common/images/Lottery/lhc/<?=$val['ball_7']?>.png"></td>
                                <td><button class="settle" id="js_button1" status="<?=$val['state']==0 ? 0:1;?>" qishu="<?=$val['qishu']?>"title="重新结算" ><font color="#FF0000"><?= $val['state']==0 ? '未结算':"已结算";?> </font></button></td>
                                <?php if($val['state']==2){?>
                                    <td><font color="#FF0000" style="font-size:18px" status="<?=$val['state'];?>">√</font></td>
                                <?php }else{?>
                                    <td><font color="#0000FF" style="font-size:20px" status="<?=$val['state'];?>">×</font></td>
                                <?php } ?>
                                <td>
                                    <a href="#/spsix/index/result-edit&qishu=<?=$val['qishu']?>">编辑</a>
                                    <a onclick="queryResult_lhc(<?=$val['id']?>)" title="查看修改记录"><font>查看记录</font></a>
                                    <a onclick="deleteResult_lhc(<?=$val['id']?>)" title="删除"><font>删除</font></a>
                                    <input type="hidden" id="prev_text106" value="">
                                </td>
                            </tr>
                    <?php }
                    }?>
                </tbody>
            </table>

            <?= LinkPager::widget(['pagination' => $pages]); ?>

<script>
    $(function () {
//订单结算
        $(".settle").click(function (e) {
            var formData = $("#gridSearchForm").serialize();
            e.preventDefault();
            var qishu = $(this).attr('qishu');
            var status = $(this).attr('status');
            $(".settle").attr("disabled","true");
            $.ajax({
                type: "get",
                url: "/?r=spsix/index/do-state",
                data: {qi:qishu,jsType:status},
                error:function () {
                    layer.alert('出错了，请稍后再试');
                    $(".settle").removeAttr("disabled");
                },
                success: function(data){
                    layer.alert(data);
                    $(".settle").removeAttr("disabled");
                    window.location.href = '/#/spsix/index/result&t='+formData+"&t="+new Date().getTime();;
                }
            })
        })
    })
    //查看修改记录
    function queryResult_lhc(id) {
        $.ajax({
            type: "POST",
            url: "/?r=spsix/index/result-log",
            data: {id:id},
            error:function () {
                layer.alert('出错了，请稍后再试');
            },
            success: function(data){
                layer.alert(data);
                window.location.href = '/#/spsix/index/result'+"&t="+new Date().getTime();;
            }
        })
    }
    /**
     * 删除开奖记录
     * @param id
     */
    function deleteResult_lhc(id) {
        layer.confirm('确定要删除吗?',function () {
            var fsrate = prompt("请输入修改密码:", "");
            $.ajax({
                type:'post',
                url:'/?r=spsix/index/result-delete',
                data:{id:id,
                    'superpassword':fsrate,
                },
                dataType:'json',
                success:function (data) {
                    layer.alert(data.msg);
                    window.location.href = '/#/spsix/index/result'+"&t="+new Date().getTime();;
                },
                error:function (e) {
                    layer.alert('删除失败了');
                }
            });
        });
    }
</script>