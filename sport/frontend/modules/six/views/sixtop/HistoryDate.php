<link rel="stylesheet" href="public/aomenPC/css/admin_style_1.css" type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="/public/jquery/jquery-1.7.2.min.js" ></script>
<script language="javascript">
    function go(value) {
        if (value != "")
            location.href = value;
        else
            return false;
    }
    function check() {
        if ($("#tf_id").val().length > 5) {
            $("#status").val("0,1");
        }
        return true;
    }

    function serach01(){
        form1=document.getElementById("SearchForm");
        form1.submit();
    }

    function submitfc(){

        form1=document.getElementById("SearchForm");
        var oderid=document.getElementById("tf_id").value;
        alert(oderid);
        $.ajax({
            url : form1.action,
            type : "POST",
            data : oderid,
            timeout : 10000,
            error : function () {

                alert("查询失败");
            },
            success: function(response){
                alert("成功");
                if(document.newForm){
                    document.SearchForm.reset();
                }


            }
        });
    }


</script>

<div id="pageMain"  class="round-table" style="height: 471px;margin: 0px auto;overflow-x: hidden;">

    <table width="100%" height="100%" style="width: 832px;" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <td valign="top" style="vertical-align: top;">
                <form name="SearchForm" id="SearchForm"  action="/?r=six/sixtop/historydate" method="get">
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">

                        <input type="hidden" name="gamedate" value="<?=$day?>" />
                        <tr><td align="center" bgcolor="#FFFFFF">
                                &nbsp;&nbsp;
                        </tr>

                    </table>
                </form>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <tr style="background-color:#3C4D82; color:#FFF">
                        <td align="center"><strong>订单号</strong></td>
                        <td align="center"><strong>彩票期号</strong></td>
                        <td align="center"><strong>投注玩法</strong></td>
                        <td align="center"><strong>投注内容</strong></td>
                        <td align="center"><strong>投注金额</strong></td>
                        <td align="center"><strong>反水</strong></td>
                        <td align="center"><strong>赔率</strong></td>
                        <td height="25" align="center"><strong>输赢结果</strong></td>
                        <td align="center"><strong>投注时间</strong></td>
                        <td height="25" align="center"><strong>状态</strong></td>
                    </tr>
                    <?php foreach ($rows as $key => $value) { ?>
                       <tr align="center" onMouseOver="this.style.backgroundColor = #EBEBEB" onMouseOut="this.style.backgroundColor = #ffffff"
                              style="background-color:#FFFFFF; line-height:20px;">
                        <td height="25" align="center" valign="middle"><?=$value['order_sub_num']?></td>
                        <td align="center" valign="middle"><?=$value['qishu']?></td>
                        <td align="center" valign="middle"><?=$value['rtype_str']?></td>
                        <td align="center" valign="middle" style="max-width: 100px;"><?=$value['number']?></td>
                        <td align="center" valign="middle"><?=$value['bet_money_one']?></td>
                        <td align="center" valign="middle"><?=$value['fs']?></td>
                        <td align="center" valign="middle"><?=$value['bet_rate']?></td>
                        <td align="center" valign="middle"><?=$value['money_result']?></td>
                        <td><?=$value['bet_time']?></td>
                        <td>
                           <?php if ($value['status'] == 0) {?>
                            <font color="#0000FF">未结算</font>
                           <?php }?>
                            <?php if ($value['status'] == 1) { ?>
                            <font color="#FF0000">已结算</font>
                            <?php }?>
                            <?php if ($value['status'] == 2) {?>
                            <font color="#FF0000">已结算</font>
                            <?php }?>
                            <?php if ($value['status'] == 3) {?>
                            <font color="#FFcccc">作废</font>
                            <?php }?>
                            </td></tr>
                    <?php }?>
                   <tr style="background-color:#FFFFFF;">
                        <td colspan="12" align="center" valign="middle">
                            当前页总投注金额:<?=$t_allmoney?>元 &nbsp;&nbsp;
                            当前页赢取金额:
                             <?=$t_sy?>元</td>
                        </tr>
                    <tr style="background-color:#FFFFFF;display: none;">
                        <td colspan="12" align="center" valign="middle">fenye</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</div>