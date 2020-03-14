<link href="/public/common/css/skin_1.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript" language="javascript" src="/public/live/js/live_transform.js"></script> 

<table align="center"  width="100%" >
    <tr>
        <td class="pd10"><font class="pro_title">真人账户余额手工结算</font></td>
    </tr>
    <tr>
        <td  align="center" nowrap >
            <form name="form1"  method="post" action="<?= $_SERVER['PHP_SELF'] ?>?action=save">
                <table id="editProduct" width="100%"  cellspacing="0" cellpadding="0" class="font13 settable w450">
                    <tr>
                        <td width="16%"  align="right">用户名：</td>
                        <td width="84%" align="left"><font color="Red"><?php echo $rsuser["user_name"] ?></font>
                            <input  type="hidden" name="uid" id='uid' value="<?php echo $rsuser["user_id"] ?>"/>
                    </tr>
                    <tr>
                        <td  align="right">转账模式：</td>
                        <td align="left">
                            <table>
                                <tr>
                                    <td>
                                        <select name="transform" id="transform">
                                            <option value="in" checked="checked">转入厅</option>
                                            <option value="out" >厅转出</option>
                                        </select>
                                    </td>
                                    <td>
                                        &nbsp;&nbsp;选择厅：
                                        <select id="platform" name="platform">
                                            <option value="AG" <?php echo $hall == 'AG' ? 'selected' : ''; ?>>AG极速厅</option>
                                            <option value="AGIN" <?php echo $hall == 'AGIN' ? 'selected' : ''; ?>>AG国际厅</option>
                                            <option value="AG_BBIN" <?php echo $hall == 'AG_BBIN' ? 'selected' : ''; ?>>AG_BBIN厅</option>
                                            <option value="AG_OG" <?php echo $hall == 'AG_OG' ? 'selected' : ''; ?>>AG_OG厅</option>
                                            <option value="AG_MG" <?php echo $hall == 'AG_MG' ? 'selected' : ''; ?>>AG_MG厅</option>
                                            <option value="DS" <?php echo $hall == 'DS' ? 'selected' : ''; ?>>DS厅</option>
                                            <option value="OG" <?php echo $hall == 'OG' ? 'selected' : ''; ?>>OG厅</option>
                                            <option value="KG" <?php echo $hall == 'KG' ? 'selected' : ''; ?>>KG厅</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                    </tr>
                    <tr>
                        <td align="right">金额：</td>
                        <td align="left"><input type="text" name="amount" id="amount"/>   
                            <span class="STYLE3">*</span><span class="STYLE5">必须为整数</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">&nbsp;注意该操作不会给会员系统账户进行加款或者扣款</td>
                    </tr>
                    <tr>
                        <td align="center">&nbsp;</td>
                        <td align="left"><input type="button" onclick="confirmChangeMoney()" value="确认转账" /></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>