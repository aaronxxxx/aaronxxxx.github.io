<?php use yii\widgets\LinkPager;?>
<div id="pageMain">

            <form name="form1" method="post" action="?r=six/index/update-qishu" id="form1">
                <div class="font13 trinput resulttable w736">
                    <p>
                        <span>彩票类别：</span>
                         <span><strong>六合彩</strong></span>
                    </p>
                    <p>
                        <span>开奖期号：</span>
                         <span>
                            <input name="qishu" type="text" id="qishu" <?= $saveData['qishu']? 'readonly':'';?> value="<?php echo $saveData['qishu']? $saveData['qishu']:'';?>" size="20" maxlength="16">
                        </span>
                    </p>
                    <p>
                        <span>开盘时间：</span>
                        <span><input class="laydate-icon" name="kaipan_time" type="text" id="kaipan_time"  value="<?=$saveData['kaipan_time'];?>" size="20" maxlength="19" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})"></span>
                        <span>封盘时间：</span>
                        <span><input class="laydate-icon" name="fenpan_time" type="text" id="fenpan_time" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})" value="<?=$saveData['fenpan_time'];?>" size="20" maxlength="19"></span>
                        <span>开奖时间：</span>
                        <span><input class="laydate-icon" name="kaijiang_time" type="text" id="kaijiang_time" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})" value="<?=$saveData['kaijiang_time'];?>" size="20" maxlength="19"></span>
                        <input type="hidden" name="update" value="<?=$update?>">
                        <input type="hidden" name="id" value="<?=$id;?>">
                    </p>
                    <p>
                        <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                    </p>
                    <p>
                            <span>
                            <input type="button" class="form_ajax_submit_btn mgl61" data-targetid="form1" data-redirect="#/six/index/qishu&t=<?=time();?>" name="submit" value="确认发布" />
                            </span>  </p>
                  
                </div>
            </form>

            <form name="form2" method="get" id="gridSearchForm" action="#/six/index/qishu">
                <div class="font12 mgb10">
                    <div class="trinput">
                        <p>
                            开奖期号：
                            <input name="qishu_query" type="text" id="qishu_query" value="<?=$qishu_query ? $qishu_query:'';?>" size="20" maxlength="11">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" id="gridSearchBtn" name="submit" class="submit80" value="搜索" />
                            &nbsp;&nbsp;&nbsp; <span style="font-size: 14px;color: red;">（排序按照编辑时间，不是按照期数或者开盘时间等！）</span>
                        </p>
                   
                    </div>
                </div>
            </form>
            <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
                <tbody>
                <tr class="namecolor">
                    <td align="center"><strong>彩票类别</strong></td>
                    <td align="center"><strong>彩票期号</strong></td>
                    <td align="center"><strong>开盘时间</strong></td>
                    <td align="center"><strong>封盘时间</strong></td>
                    <td align="center"><strong>开奖时间</strong></td>
                    <td align="center" height="25"><strong>操作</strong></td>
                </tr>
                <?php
                    if($list){
                        foreach ($list as $key=>$val){?>
                            <tr align="center" onmouseover="this.style.backgroundColor='#EBEBEB'" onmouseout="this.style.backgroundColor='#ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                                <td height="25" align="center" valign="middle">六合彩</td>
                                <td align="center" valign="middle"><?=$val['qishu']?></td>
                                <td align="center" valign="middle"><?=$val['kaipan_time']?></td>
                                <td align="center" valign="middle"><?=$val['fenpan_time']?></td>
                                <td align="center" valign="middle"><?=$val['kaijiang_time']?></td>
                                <td>
                                    <a href="#/six/index/qishu&qishu=<?=$val['qishu']?>">编辑</a>
                                    <a onclick="queryResult_lhc(<?=$val['id'];?>)" title="查看修改记录"><font>查看记录</font></a>
                                    <a onclick="deleteResult_lhc(<?=$val['id'];?>)" title="删除"><font>删除</font></a>
                                    <input type="hidden" id="prev_text6137" value="sdds">
                                </td>
                            </tr>
                    <?php }
                    }?>
                </tbody>
            </table>
            <?= LinkPager::widget(['pagination' => $pages]); ?>
      
</div>
<script>
    $(function () {
        //修改，添加期数
        /*$("#form1").submit(function (e) {
            e.preventDefault();
            var qishu = $("#qishu").val();
            var kaipan_time = $("#kaipan_time").val();
            var fenpan_time = $("#fenpan_time").val();
            var kaijiang_time = $("#kaijiang_time").val();
            if(qishu=='' || qishu =='undefined' || isNaN(qishu)){
                layer.alert('期数不能为空，且只能为数字!');
                return false;
            }
            if(kaipan_time=='' || kaipan_time =='undefined'){
                layer.alert('开盘时间不能为空!');
                return false;
            }
            if(fenpan_time=='' || fenpan_time =='undefined'){
                layer.alert('封盘时间不能为空!');
                return false;
            }
            if(kaijiang_time=='' || kaijiang_time =='undefined'){
                layer.alert('开奖时间不能为空!');
                return false;
            }

            $.ajax({
                type: "POST",
                url: "/?r=six/index/qishu",
                data: $(this).serialize(),
                error:function () {
                    layer.alert('出错了，请稍后再试');
                },
                success: function(data){
                    console.log(data);return false;
                    layer.alert(data,function (index) {
                        console.log(data)
                        if(data=='修改成功' || data=='添加成功'){
                            location.href = '#/six/index/qishu';
                        }
                        layer.closeAll();
                    });
                }
            })
        })*/
    })
    //查看修改记录
    function queryResult_lhc(id) {
        $.ajax({
            type: "POST",
            url: "/?r=six/index/qishu-log",
            data: {id:id},
            error:function () {
                layer.alert('出错了，请稍后再试');
            },
            success: function(data){
                layer.alert(data);
            }
        })
    }
    /**
     * 删除六合彩期数
     * @param id
     */
    function deleteResult_lhc(id) {
        layer.confirm('确定要删除吗?',function () {
            var fsrate = prompt("请输入修改密码:", "");
                $.ajax({
                    type:'post',
                    url:'/?r=six/index/qishu-delete',
                    data:{id:id,
                        'superpassword':fsrate,},
                    dataType:'json',
                    success:function (data) {
                        layer.alert(data.msg)
                        location.reload();
                    },
                    error:function (e) {
                        layer.alert('出错');
                    }
                });
            });

    }
</script>

