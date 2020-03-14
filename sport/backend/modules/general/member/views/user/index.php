<HTML>

<HEAD>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
    <TITLE>用户详细信息展示</TITLE>
    <script>
        function getMoneyAdmin(userName, password) {
            $("input[name=getMoney]").attr("disabled", "disabled"); //按钮失效
            $.post("getUpdateMoney.php", {
                username: userName,
                password: password
            }, function(data) {
                $("input[name=getMoney]").attr("disabled", false); //按钮失效
                if (parseInt(data) > -1) {
                    $("#ag_credit").text(data);
                } else {
                    alert(data);
                }
            });
        }
    </script>
</HEAD>

<body>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
            <td height="24">
                <font>&nbsp;<span class="pro_title">用户管理：查看用户详细信息</span></font>
            </td>
        </tr>
        <tr>
            <td height="24" align="center" nowrap bgcolor="#FFFFFF">
                <br>
                <form action="user_update.php" method="post" name="form1" id="form1">
                    <table width="90%" align="center" cellspacing="0" cellpadding="0" class="settable">
                        <tr>
                            <td class="pdrgt15">用户名</td>
                            <td><?= $userAG["user_name"] ?>
                                <input name="hf_username" type="hidden" id="hf_username" value="<?= $userAG["user_name"] ?>"></td>
                        </tr>
                        <tr>
                            <td width="172" class="pdrgt15">账户余额</td>
                            <td width="473"><?= $userAG["money"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">性别</td>
                            <td><?= $userAG["sex"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">注册所在地</td>
                            <td><?= $userAG["regaddress"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">生日</td>
                            <td><input name="birthday" value="<?= $userAG["birthday"] ?>"></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">密码问答</td>
                            <td>
                                <select name="ask" id="ask">
                                    <option value="">---请选择密码问题---</option>
                                    <option value="您的车牌号码是多少？" <?php if ($userAG["ask"] == "您的车牌号码是多少？") echo "selected"; ?>>您的车牌号码是多少？</option>
                                    <option value="您初中同桌的名字？" <?php if ($userAG["ask"] == "您初中同桌的名字？") echo "selected"; ?>>您初中同桌的名字？</option>
                                    <option value="您就读的第一所学校的名称？" <?php if ($userAG["ask"] == "您就读的第一所学校的名称？") echo "selected"; ?>>您就读的第一所学校的名称？</option>
                                    <option value="您第一次亲吻的对象是谁？" <?php if ($userAG["ask"] == "您第一次亲吻的对象是谁？") echo "selected"; ?>>您第一次亲吻的对象是谁？</option>
                                    <option value="少年时代心目中的英雄是谁？" <?php if ($userAG["ask"] == "少年时代心目中的英雄是谁？") echo "selected"; ?>>少年时代心目中的英雄是谁？</option>
                                    <option value="您最喜欢的休闲运动是什么？" <?php if ($userAG["ask"] == "您最喜欢的休闲运动是什么？") echo "selected"; ?>>您最喜欢的休闲运动是什么？</option>
                                    <option value="您最喜欢哪支运动队？" <?php if ($userAG["ask"] == "您最喜欢哪支运动队？") echo "selected"; ?>>您最喜欢哪支运动队？</option>
                                    <option value="您最喜欢的运动员是谁？" <?php if ($userAG["ask"] == "您最喜欢的运动员是谁？") echo "selected"; ?>>您最喜欢的运动员是谁？</option>

                                    <option value="您的第一辆车是什么牌子？" <?php if ($userAG["ask"] == "您的第一辆车是什么牌子？") echo "selected"; ?>>您的第一辆车是什么牌子？</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">密码答案</td>
                            <td><input type="text" name="answer" id="answer" value="<?= $userAG["answer"] ?>"></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">手机</td>
                            <td><input type="text" name="mobile" value="<?= $userAG["tel"] ?>"></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">email</td>
                            <td><input type="text" name="email" value="<?= $userAG["email"] ?>"></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">QQ</td>
                            <td><input type="text" name="QQ" value="<?= $userAG["qq"] ?>"></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">真实姓名</td>
                            <td><input type="text" name="pay_name" value="<?= $userAG["pay_name"] ?>" readonly="readonly"></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">开户行</td>
                            <td><input type="text" name="pay_card" value="<?= $userAG["pay_bank"] ?>"></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">卡号</td>
                            <td><input type="text" name="pay_num" value="<?= $userAG["pay_num"] ?>"><input name="hf_pay_num" type="hidden" id="hf_pay_num" value="<?= $userAG["pay_num"] ?>"></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">开户地址</td>
                            <td>
                                <input type="text" name="pay_address" value="<?= $userAG["pay_address"] ?>">
                                <input type="hidden" name="uid" id="uid" value="<?= $userAG["user_id"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">所属会员组</td>
                            <td>
                                <label>
                                    <select name="gid" id="gid">
                                    <?php
                                        foreach ($usergroup as $key => $value) {
                                    ?>
                                        <option value="<?= $value['group_id'] ?>" <?= $value['group_id'] == $userAG["group_id"] ? 'selected' : '' ?>><?= $value['group_name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">出入金方式</td>
                            <td>
                                <label>
                                    <select name="trade_type" id="trade_type">
                                        <option></option>
                                        <option value="1" <?= $userAG["trade_type"] == 1 ? 'selected' : '' ?>>USDT</option>
                                        <option value="2" <?= $userAG["trade_type"] == 2 ? 'selected' : '' ?>>ETH_USDT</option>
                                        <option value="3" <?= $userAG["trade_type"] == 3 ? 'selected' : '' ?>>其他</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <!--20190108
                        <tr>
                            <td class="pdrgt15">所属会员等级</td>
                            <td><label>
                                <select name="lid" id="lid">
                                <?php
                                    foreach ($userLevel as $key => $value) {
                                ?>
                                    <option value="<?= $value['level_id'] ?>" <?= $value['level_id'] == $userAG["level_id"] ? 'selected' : '' ?>><?= $value['level_name'] ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </label></td>
                        </tr>
                        -->
                        <tr>
                            <td class="pdrgt15">注册时间</td>
                            <td><?= $userAG["regtime"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">注册IP</td>
                            <td><?= $userAG["regip"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">最后登录时间</td>
                            <td><?= $userAG["logintime"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">最后登录IP</td>
                            <td><?= $userAG["loginip"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">最后在线时间</td>
                            <td><?= $userAG["logouttime"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">总登录次数</td>
                            <td><?= $userAG["lognum"] ?></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">备注：</td>
                            <td><textarea name="why" cols="80" rows="5" id="why"><?= $userAG["remark"] ?></textarea></td>
                        </tr>
                        <tr>
                            <td class="pdrgt15">更多信息</td>
                            <td>
                                <!-- <a href="/#/sport/order/single-order&type=单式&status=all&username=<?= $userAG["user_name"] ?>">查看单式信息</a>，
                                <a href="/#/sport/order/cg&status=all&username=<?= $userAG["user_name"] ?>">查看串关信息</a>，
                                <A href="/#/message/user/index&username=<?= $userAG["user_name"] ?>">发布短消息</A>， -->
                                <A href="/#/finance/fund/look-money&status=所有状态&username=<?= $userAG["user_name"] ?>">查看财务</A>，
                                <!-- <A href="#/live/log/check&username=<?= $userAG["user_name"] ?>">核查会员</A>， -->
                                <A href="/#/member/historybank/list&username=<?= $userAG["user_name"] ?>">历史银行记录</A>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="button" value="确认提交" onClick="javascript:saveinfo()"> 　
                                <input type="button" value="返回列表" onClick="javascript:history.go(-1)">
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
</body>

</html>

<script>
    function saveinfo() {
        $.ajax({
            url: "/?r=member/user/saveinfo",
            type: 'POST',
            data: $('#form1').serialize(),
            error: function($e) {
                alert('服务器未响应！');
            },
            success: function($html) {
                alert("信息更新成功~~~！");
            }
        });
    }
</script>