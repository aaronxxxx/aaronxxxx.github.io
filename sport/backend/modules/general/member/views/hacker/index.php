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
<form id="gridSearchForm" name="form1" method="post" action="#/member/hacker/index" class="trinput inputct font14 mgb10">
    请输入用户名：
    <label>
        <input name="user_name" type="text" id="user_name" size="20" maxlength="20" value="<?=$userName ?>"/>
    </label>
    <label>
        <input id="gridSearchBtn" type="button" value="查询" />
    </label>
    <label>
    	<input type="button" value="新增加黑名单" url="#/member/hacker/create" onclick="window.location.href='/#/member/hacker/create'"/>
    </label>
</form>

<div  class="mgb10">注意：该列表用户全部为'黑名单'用户（改单、不诚信投注、软件投注、黑客等不法用户），如果发现自己网站有这样的用户，请谨慎操作提款操作。如果发现新的非法用户，请联系技术更新名单。</div>

<table width="100%" border="1" cellpadding="0" cellspacing="1" class="font13 skintable line35">
    <tr>
        <td width="20%"><strong>序号</strong></td>
        <td width="40%"><strong>用户名</strong></td>
        <td width="40%"><strong>备注</strong></td>
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