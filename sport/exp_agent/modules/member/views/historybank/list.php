<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */

?>
<form id="gridSearchForm" role="form" method="get" action="?r=member/historybank/list" class="form form-inline trinput inputct font14 mgb10">
    <div class="form-group">
        <label for="usernames">請輸入會員名稱：</label>
        <input style="width: 500px;" type="text" class="form-control" id="usernames" name="usernames" placeholder="多個會員用 , 隔開" value="<?=$usernames?>">
    </div>
    <input type="button" id="gridSearchBtn" value="查找">
    <a href="?r=member/historybank/index" >添加銀行歷史信息</a>
</form>
<table width="100%"  cellspacing="0" cellpadding="0"  id=editProduct  class="font12 skintable line35">
    <tr class="t-title dailitr">
        <td width="10%"><strong>開戶人</strong></td>
        <td width="12%"><strong>開戶行</strong></td>
        <td width="16%"><strong>銀行卡號</strong></td>
        <td width="26%"><strong>開戶地址</strong></td>
        <td width="13%"><strong>添加日期</strong></td>
        <td width="13%"><strong>會員名稱</strong></td>
        <td width="10%"><strong>操作</strong></td>
    </tr>
    <?php
        foreach ($list as $row) {
    ?>
        <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
            <td height="30" align="center"><?=$row['pay_name']?></td>
            <td align="center"><?=$row['pay_card']?></td>
            <td align="center"><?=$row['pay_num']?></td>
            <td align="center"><?=$row['pay_address']?></td>
            <td align="center"><?=$row['addtime']?></td>
            <td align="center"><a href="?r=member/user&uid=<?=$row['uid']?>"><?=$row['username']?></a></td>
            <td align="center"><a style="color: #F37605;" href="?r=member/historybank/index&id=<?=$row['id']?>&username=<?=$row['username']?>">編輯</a></td>
        </tr>
    <?php
        }
    ?>
</table>