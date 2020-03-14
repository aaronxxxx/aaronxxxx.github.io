<link rel="stylesheet" href="/public/aomenPC/css/admin_style_1.css" type="text/css" media="all" />
<script language="javascript" src="/public/aomenPC/js/jquery-1.7.2.min.js"></script>
<script language="javascript">
        function queryLottery(){
//            var timeParam = $("#s_time").val();
//            if(!timeParam){
//            alert("请选择日期。");
//            return false;
//            }
        return true;
        }
</script>
<div id="search_content">
    <div class="round-table">
        <form name="Frm_search_drawno"  id="Frm_search_drawno" method="get" onSubmit="return queryLottery();" method="get" action="/?r=spsix/sixtop/kaijiang&qishu_query=<?=$qishu_query?>">
           <input name="qishu_query" type="hidden" value="<?=$qishu_query?>"/>
            <input name="s_time" type="hidden" value="<?=$query_time?>"/>
            <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" >
                <tr style="background-color:#FFFFFF;">
                    <td align="left">
                         &nbsp;&nbsp;开奖期号：
                      <input name="qishu_query" type="text" id="qishu_query" value="<?=$qishu_query?>" size="20" maxlength="11"/>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <input name="submit" type="submit" class="submit80" value="搜索"/>
                    </td>
                </tr>
             </table>
         </form>
    </div>
</div>
<div class="round-table">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:2px;" bgcolor="#798EB9">
        <tr  class="title_tr" style="background-color:#3C4D82; color:#FFF">
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
            <td align="center"><strong>生肖</strong></td>

        <?php foreach($arr as $key => $rows) {
                $hasRow = 'true';
                $color = '#FFFFFF';
                $over = '#EBEBEB';
                $out = '#ffffff';
        ?>
        <tr   class="R_tr" align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
            <td height="25" align="center" valign="middle">极速六合彩</td>
            <td align="center" valign="middle"><?=$rows['qishu']?>
            </td>
            <td align="center" valign="middle"><?=$rows['datetime']?>
             </td>
            <td align="center" valign="middle"><img src="/public/aomenPC/img/<?=$rows['ball_1']?>.png"></td>
            <td align="center" valign="middle"><img src="/public/aomenPC/img/<?=$rows['ball_2']?>.png"></td>
            <td align="center" valign="middle"><img src="/public/aomenPC/img/<?=$rows['ball_3']?>.png"></td>
            <td align="center" valign="middle"><img src="/public/aomenPC/img/<?=$rows['ball_4']?>.png"></td>
            <td align="center" valign="middle"><img src="/public/aomenPC/img/<?=$rows['ball_5']?>.png"></td>
            <td align="center" valign="middle"><img src="/public/aomenPC/img/<?=$rows['ball_6']?>.png"></td>
            <td align="center" valign="middle"><img src="/public/aomenPC/img/<?=$rows['ball_7']?>.png"></td>
            <td align="center" valign="middle" style="font-size: 14px;">
                <?=$rows['Animal']?>
             </td>
        </tr>
        <?php } ?>
       <?php if ($hasRow == 'false') {?>
        <tr   class="R_tr" align="center" >
            <td height="25" colspan="10" align="center" valign="middle">暂时没有开奖结果</td>
        </tr>
        <?php }?>
     </table>
</div>
