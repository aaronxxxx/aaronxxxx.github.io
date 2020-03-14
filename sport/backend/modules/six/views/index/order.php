<script src="/public/six/js/jquery.cookie.js" type="text/javascript"></script>
<?php use yii\widgets\LinkPager;?>
                <div class="pro_title ">六合彩注单查询(按注单)</div>
                <form name="form1" method="get" id="gridSearchForm" action="#/six/index/order" id="form1">
                   
                            <div class="trinput inputct pd10">
                                <div class="mgauto middle">
                                    <select id="status" name="status">
                                        <?php
                                        foreach ($status as $key=>$val){ ?>
                                                <option value="<?=$key;?>" <?php if($statu==$key) echo 'selected';?>><?=$val;?></option>
                                        <?php } ?>
                                    </select>
                                    日期：<input id="start_time" name="start_time" type="text" value="<?=$startTime;?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                                    ~
                                    <input id="end_time" name="end_time" type="text" value="<?=$endTime;?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                                    期数：<input id="qishu" type="text" size="15" value="<?=$qishu;?>" name="qishu">
                                    订单号：<input name="order_sub_num" type="text" id="order_sub_num" value="<?=$orderSubNum;?>" />
                                    会员：<input id="user_name" type="text" size="15" value="<?=$user;?>" name="user_name">
                                    <select name="excludegroup" id="excludegroup">
                                        <option value="0" style="color:#FF9900;" <?= $excludegroup == '0' ? 'selected' : '' ?>>全部会员组</option>
                                        <option value="1" style="color:#FF0000;" <?= $excludegroup == '1' ? 'selected' : '' ?>>排除测试会员组</option>
                                    </select>
                                    &nbsp;
                                    <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
                                    <select id="img_show">
                                        <option value="none" selected>隐藏图片</option>
                                        <option value="block">显示图片</option>
                                    </select>

                            </div>
                            </div>
                      
                </form>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
                    <tbody><tr class="dailitr">
                        <td align="center"><strong>子订单号</strong></td>
                        <td align="center"><strong>彩票类别</strong></td>
                        <td align="center"><strong>彩票期号</strong></td>
                        <td align="center"><strong>投注玩法</strong></td>
                        <td align="center"><strong>投注内容</strong></td>
                        <td align="center"><strong>投注金额</strong></td>
                        <td align="center"><strong>反水</strong></td>
                        <td align="center"><strong>赔率</strong></td>
                        <td align="center"><strong>可赢金额</strong></td>
                        <td align="center"><strong>输赢结果</strong></td>
                        <td align="center"><strong>投注时间</strong></td>
                        <td align="center"><strong>投注账号</strong></td>
                        <td align="center" style="width: 64px;"><strong>状态</strong></td>
                        <td align="center"><strong>操作</strong></td>
                        <td height="25" align="center"><strong>查看记录</strong></td>
                    </tr>
                    <?php
                    $betMoney = $winMoney = 0;
                    if($list){
                        foreach ($list as $key=>$val){
                            if(strpos($val['bet_rate'],",") !== false) {
                                $temp_rate = 1;
                                $bet_rate_array = explode(",", $val['bet_rate']);
                                foreach ($bet_rate_array as $key2 => $value2) {
                                    $temp_rate = $temp_rate * $value2;
                                }
                                $val['bet_rate'] = round($temp_rate, 2);
                            }
                    {?>
                <?php if(($val['status'] == 1 || $val['status'] == 2) && $val['is_win'] > 0){?>
                    <tr align="center" style="background:#f75050">
                <?php }else {?>
                    <tr align="center">
                <?php }?>
                        <td height="25" align="center" valign="middle"><?=$val['order_sub_num'];?></td>
                        <td align="center" valign="middle">六合彩</td>
                        <td align="center" valign="middle"><?=$val['qishu'];?></td>
                        <td align="center" valign="middle"><?php echo $val['rtype_str_sub']?$val['rtype_str_sub']:$val['rtype_str']?></td>
                        <td align="center" valign="middle" style="max-width: 115px;word-wrap: break-word;"><?=$val['number'];?></td>
                        <td align="center" valign="middle"><?=$val['bet_money'];$betMoney+=$val['bet_money'];?></td>
                        <td align="center" valign="middle"><?=$val['fs'];?></td>
                        <td align="center" valign="middle"><?=$val['bet_rate'];?></td>
                        <td align="center" valign="middle"><?=$val['win_sub'];?></td>
                        <td align="center" valign="middle" style="color:<?= $val['is_win']==1? "red":'';?>">
                            <?php
                            if($val['status']!=0 && $val['status']!=3){
                                if($val['is_win']==1){
                                    echo $val['win_sub']+$val['sub_fs']-$val['bet_money'];
                                    $winMoney +=($val['win_sub']-$val['bet_money']+$val['sub_fs']);
                                }else{
                                    echo ($val['is_win_total']-$val['bet_money']);$winMoney +=($val['is_win_total']-$val['bet_money']);
                                }
                            }else if($val['status']==0){
                                echo 0;$winMoney +=0;
                            }else{
                                echo 0;$winMoney +=0;
                            };?>
                        </td>
                        <td ><?=$val['bet_time'];?></td>
                        <?php if(($val['status'] == 1 || $val['status'] == 2) && $val['is_win'] > 0){?>
                            <td><font color="#086913"><?=$val['user_name'];?></td>
                        <?php }else{?>
                            <td><?=$val['user_name'];?></td>
                        <?php }?>     
                        <td >
                            <?php if ($val['status'] == 1){?>
                                <font color="#086913" data="<?=$val['status'];?>"><?=$status[$val['status']];?></font>--<br>
                            <?php }else{?>
                                <font color="#0000FF" data="<?=$val['status'];?>"><?=$status[$val['status']];?></font>--<br>
                            <?php }?>    
                            <?php if($val['status']!=3){?>
                                <a onclick="orderCancel(<?=$val['id']?>,'<?=$val['order_sub_num']?>')" title="作废该单"><font color="#ffcccc">作废</font></a>
                            <?php }?>
                        </td>
                        <td align="center" valign="middle">
                            <a style="color: #F37605;" onclick="subUpdate(<?=$val['id']?>,'<?=$val['order_sub_num']?>')" title="修改投注内容"><font>修改投注内容</font></a>
                        </td>
                        <td align="center" valign="middle">
                            <a style="color: #F37605;" onclick="queryInfo_lhc(<?=$val['id']?>)" title="查看修改记录"><font>查看记录</font></a>
                        </td>
                    </tr>              
                    <tr>
                        <td colspan="15" style="padding: 0px;">
                            <img class="img-img" src="<?=Yii::$app->params['resouceDomain']?>/order/<?=substr($val['order_sub_num'],0,8)?>/<?=$val['order_sub_num']?>.jpg" style="display: none">
                    </tr>
                    <?php       }}}?>
                    <tr class="ctinfo">
                        <td valign="middle" align="center" colspan="15">当前页总投注金额:<?=$betMoney;?>元    当前页赢取金额:<?=$winMoney;?>元</td>
                    </tr>
                    </tbody>
                </table>
                <?= LinkPager::widget(['pagination' => $pages]);?>
       
<script>
    $(function(){
        setTimeout('reload_view()',<?= $reload*1000;?>)
    })

    function reload_view() {
        window.location.reload();
    }

    function queryInfo_lhc(sub_id) {
        $.ajax({
            type: "POST",
            url: "/?r=six/index/order-log",
            data: {sub_id:sub_id},
            error:function () {
                layer.alert('出错了，请稍后再试');
            },
            success: function(data){
                layer.alert(data,{offset:['40%' , '50%']})
            }
        });
    }

    function subUpdate(sub_id,sub_order_id) {
        var formData = $("#gridSearchForm").serialize();
        $.ajax({//查询注单内容
            type: "POST",
            url: "/?r=six/index/order-sub-update",
            data: {sub_id:sub_id},
            error:function () {
                layer.alert('出错了，请稍后再试');
            },
            success: function(data){
                layer.alert(data,{offset:['40%' , '50%']},function(e){
                    if(data.length>20){
                        var number = $("#number").val();
                        layer.confirm('确定要修改订单吗?', {btn: ['确定', '取消'],offset:['40%' , '50%']},
                            function () {
                                if(!number){
                                    layer.alert('请填写修改内容!',{offset:['40%' , '50%']});
                                    return false;
                                }
                                $.ajax({//提交内容修改
                                    type: "POST",
                                    url: "/?r=six/index/order-sub-update-do",
                                    data: {sub_id:sub_id,number:number,update:1,sub_order_id:sub_order_id},
                                    error:function () {
                                        layer.alert('出错了，请稍后再试',{offset:['40%' , '50%']});
                                    },
                                    success: function(data){
                                        layer.alert(data,{offset:['40%' , '50%']},function () {
                                            layer.closeAll();
                                            window.location.href = '/#/six/index/order&'+formData+"&t="+new Date().getTime();
                                        });
                                    }
                                })
                            }, function (index) {
                                layer.close(index);
                            }
                        );
                    }else{
                        layer.close(e);
                    }
                })
            }
        });
    }

    function orderCancel(sub_id,sub_order_id) {
        var formData = $('#gridSearchForm').serialize();
        $.ajax({
            type: "POST",
            url: "/?r=six/index/order-cancel",
            data: {sub_id:sub_id},
            error:function () {
              layer.alert('出错了，请稍后再试',{offset:['40%' , '50%']});
            },
            success: function(data){
                layer.alert(data,{offset:['40%' , '50%']},function(){
                    if(data.length<=20){
                        layer.alert(data);
                    }else{
                        var reson = $("#reson").val();
                        layer.confirm('确定要作废该订单吗?', {btn: ['确定', '取消'],offset:['40%' , '50%']},
                            function () {
                                if(!reson){
                                    layer.alert('请填写作废原因!',{offset:['40%' , '50%']});
                                    return false;
                                }
                              $.ajax({
                                  type: "POST",
                                  url: "/?r=six/index/do-order-cancel",
                                  data: {sub_id:sub_id,reson:reson,update:1,'sub_order_id':sub_order_id},
                                  error:function () {
                                      layer.alert('出错了，请稍后再试',{offset:['40%' , '50%']});
                                  },
                                  success: function(data){
                                      layer.alert(data,{offset:['40%' , '50%']},function () {
//                                          window.location.reload();
                                          layer.closeAll();
                                          window.location.href="#/six/index/order&"+formData+"&t="+new Date().getTime();
                                      });
                                  }
                              })
                            }, function (index) {
                                layer.close(index);
                            });
                    }
                })
            }
        });
    }
    //读取cookie中的是否显示图片状态值
    if($.cookie('img_show')=='block'){
        $("#img_show").find("option[value='block']").attr("selected",true);
        $('.img-img').css('display','block');
    }
    //图片显示与隐藏切换 并把设置值保存到cookie中
    $(document).on('change','#img_show',function(){
        var status = $('#img_show option:selected') .val();//选中的值
        $('.img-img').css('display',status);
        $.cookie('img_show',status);
    })
</script>
