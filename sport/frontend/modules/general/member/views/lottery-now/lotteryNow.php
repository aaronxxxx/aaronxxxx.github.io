<div id="MACenterContent">
    <div id="MNav">
        <span class="mbtn">当期下注</span>
        <div class="navSeparate"></div>
    </div>
    <div id="MNavLv2">
        <span class="MGameType" onclick="chgType('liveHistory');">视讯直播</span>｜
        <span class="MGameType" onclick="chgType('skLottery');">彩票</span>｜
        <span class="MGameType" onclick="chgType('moneylog');">盈利统计</span>｜
        <span class="MGameType" onclick="chgType('cqRecord');">存取款记录</span>｜
    </div>
    <div id="MMainData">


        <!-- 彩票歷史交易 -->
        <div class="MPanel" style="display: block;">
            <table class="MMain rwd-table" border="1">
                <tr>
                    <th style="width: 20%">游戏名称</th>

                    <th style="width: 30%">未结算金额</th>

                </tr>
                <tr align="right" class="MColor1">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-lhc&type=LT">六合彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["lhc"]); ?></td>
                </tr>
                <tr align="right" class="MColor1">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lotterysp-lhc&type=LT">极速六合彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["splhc"]); ?></td>
                </tr>
                <tr align="right" class=" MColor2">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=D3">3D彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["d3"]); ?></td>
                </tr>
                <tr align="right" class="MColor1">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=P3">排列三</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["p3"]); ?></td>
                </tr>
                <tr align="right" class=" MColor2">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=T3">上海时时乐</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["t3"]); ?></td>
                </tr>
                <tr align="right" class="MColor1">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=CQ">重庆时时彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["cq"]); ?></td>
                </tr>
                <tr align="right" class="MColor1">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=TJ">天津时时彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["tj"]); ?></td>
                </tr>
                <tr align="right" class=" MColor2">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=GXSF">广西十分彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["gxsf"]); ?></td>
                </tr>
                <tr align="right" class="MColor1">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=GDSF">广东十分彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["gdsf"]); ?></td>
                </tr>
                <tr align="right" class=" MColor2">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=TJSF">天津十分彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["tjsf"]); ?></td>
                </tr>
                <tr align="right" class=" MColor2">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=CQSF">重庆十分彩</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["cqsf"]); ?></td>
                </tr>
                <tr align="right" class="MColor1">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=BJKN">北京快乐8</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["bjkn"]); ?></td>
                </tr>
                <tr align="right" class=" MColor2">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=GD11">广东十一选五</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["gd11"]); ?></td>
                </tr>
                <tr align="right" class="MColor1">
                    <td data-th="游戏名称" style="text-align: center;"><a class="pagelink" href="/?r=member/lottery-now/lottery-one&type=BJPK">北京PK拾</a></td>
                    <td data-th="未结算金额" style="text-align: center;"><?php echo ($arr2["bjpk"]); ?></td>
                </tr>
                <tr>
                    <td data-th="总计" style="text-align: center;">总计</td>
                    <td data-th="未结算金额" style="text-align: center;" align="right"><?php echo ($arr2["sum"]); ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>