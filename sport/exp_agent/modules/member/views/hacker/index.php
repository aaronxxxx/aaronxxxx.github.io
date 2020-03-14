<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
use app\common\helpers\IpUtils;
use yii\grid\GridView;
use yii\helpers\Html;

?>
<form id="gridSearchForm" name="form1" method="post" action="?r=member/hacker/index" class="trinput inputct font14 mgb10">
    請輸入用戶名：
    <label>
        <input name="user_name" type="text" id="user_name" size="20" maxlength="20" value="<?=$userName ?>"/>
    </label>
    <label>
        <input id="gridSearchBtn" type="button" value="查詢" />
    </label>
    <label>
    	<input type="button" value="新增加黑名單" url="?r=member/hacker/create" onclick="window.location.href='?r=member/hacker/create'"/>
    </label>
</form>

<div  class="mgb10">注意：該列表用戶全部為'黑名單'用戶（改單、不誠信投注、軟件投注、黑客等不法用戶），如果發現自己網站有這樣的用戶，請謹慎操作提款操作。如果發現新的非法用戶，請聯繫技術更新名單。</div>

<table width="100%" border="1" cellpadding="0" cellspacing="1" class="font13 skintable line35">
    <tr>
        <td width="20%"><strong>序號</strong></td>
        <td width="40%"><strong>用戶名</strong></td>
        <td width="40%"><strong>備註</strong></td>
    </tr>
    <?php
        if(empty($userName)) {
            foreach ($list as $row) {
    ?>
                <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'">
                    <td align="center" height="25"><?=$row['id'] ?></td>
                    <td align="center" ><?=$row['name'] ?></td>
                    <td align="center" ><?=$row['desc'] ?></td>
                </tr>
    <?php
            }
        } else {
            foreach ($list as $row) {
                if(strstr($row['name'], $userName)) {
    ?>
                    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'">
                        <td align="center" height="25"><?=$row['id'] ?></td>
                        <td align="center" ><?=$row['name'] ?></td>
                        <td align="center" ><?=$row['desc'] ?></td>
                    </tr>
    <?php
                }
            }
        }
    ?>
</table>