<link href="/public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="/public/common/css/skin_1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript" src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="/public/live/js/live_money.js"></script>

<div id="pageMain">

    <form name="form1" id="form1" method="get">
        <div class="trinput" style="margin: 10px;">
            用户名：<input name="name" id="username" value="<?=$live_name ?>" style="width: 160px;" type="text" onfocus="this.value = ''">
            &nbsp;&nbsp;
            <input type="button" name="submitbtn" value="查询"  id="submitbtn"/>
        </div>
    </form>

    <table width="100%"  align="center" cellpadding="5" cellspacing="1" class="font12 skintable line35 mgt10">
        <tr>
            <td align="center"   >平台类型</td>
            <td align="center"   >平台账号</td>
            <td align="center" >当前金额</td>
        </tr>
        <!-- <tr>
            <td align="center"   >AG</td>
            <td align="center"    id="name_ag"></td>
            <td align="center"  id="credit_ag"></td>
        </tr>
        <tr>
            <td align="center"   >AGIN</td>
            <td align="center"    id="name_agin"></td>
            <td align="center"  id="credit_agin"></td>
        </tr>
        <tr>
            <td align="center"   >AG_BBIN</td>
            <td align="center"    id="name_ag_bbin"></td>
            <td align="center"  id="credit_ag_bbin"></td>
        </tr>
        <tr>
            <td align="center"   >DS</td>
            <td align="center"    id="name_ds"></td>
            <td align="center"  id="credit_ds"></td>
        </tr> -->
        <!-- <tr>
            <td align="center"   >AG_OG</td>
            <td align="center"    id="name_ag_og"></td>
            <td align="center"  id="credit_ag_og"></td>
        </tr> -->
        <!-- <tr>
            <td align="center"   >AG_MG</td>
            <td align="center"    id="name_mg"></td>
            <td align="center"  id="credit_mg"></td>
        </tr>
        <tr>
            <td align="center"   >OG</td>
            <td align="center"    id="name_og"></td>
            <td align="center"  id="credit_og"></td>
        </tr>
        <tr>
            <td align="center"   >KG</td>
            <td align="center"    id="name_kg"></td>
            <td align="center"  id="credit_kg"></td>
        </tr>
        <tr>
            <td align="center"   >VR</td>
            <td align="center"    id="name_vr"></td>
            <td align="center"  id="credit_vr"></td>
        </tr>
        <tr>
            <td align="center">PT</td>
            <td align="center" id="name_pt"></td>
            <td align="center" id="credit_pt"></td>
        </tr> -->
        <tr>
            <td align="center">AI</td>
            <td align="center" id="name_ai"></td>
            <td align="center" id="credit_ai"></td>
        </tr>
    </table>
    <script type="text/javascript">
        function loadUserBalance(username) {
            // setTimeout(loadLiveUserBalance(1, username, $('#name_ag'), $('#credit_ag')), 500);
            // setTimeout(loadLiveUserBalance(2, username, $('#name_agin'), $('#credit_agin')), 500);
            // setTimeout(loadLiveUserBalance(3, username, $('#name_ag_bbin'), $('#credit_ag_bbin')), 500);
            // setTimeout(loadLiveUserBalance(4, username, $('#name_ds'), $('#credit_ds')), 500);
            // setTimeout(loadLiveUserBalance(5, username, $('#name_ag_og'), $('#credit_ag_og')), 500);
            // setTimeout(loadLiveUserBalance(6, username, $('#name_mg'), $('#credit_mg')), 500);
            // setTimeout(loadLiveUserBalance(7, username, $('#name_og'), $('#credit_og')), 500);
            // setTimeout(loadLiveUserBalance(8, username, $('#name_kg'), $('#credit_kg')), 500);
            // setTimeout(loadLiveUserBalance(9, username, $('#name_pt'), $('#credit_pt')), 500);
            // setTimeout(loadLiveUserBalance(10, username, $('#name_vr'), $('#credit_vr')), 500);
            setTimeout(loadLiveUserBalance(11, username, $('#name_ai'), $('#credit_ai')), 500);
        }
        $(function () {
            $('#submitbtn').bind('click', function (e) {
                if($('#username').val() == "" || $('#username').val() == null) {
                    return;
                }
                loadUserBalance($('#username').val());
            });
            loadUserBalance($('#username').val());
        });
    </script>

