			<input type="hidden" id="gold_gmin" value="<?=$lowestMoney;?>" />   <!-- 最低額度 -->
            <input type="hidden" id="gold_gmax" value="<?=$maxMoney;?>" />  <!-- 最高額度 -->
    <ul class="label pl-4 pr-4 pt-4 pb-2">
        <li class="d-flex justify-content-between align-items-center pb-3">
            <h2 id="gameName"></h2>
            <div class="number">第<span id="gNumber"></span>期</div>
        </li>
        <li class="d-flex justify-content-between align-items-center pb-3">
            <input class="lotteryResultBtn" type="button" value="开奖记录"  onclick="javascript:location.href='/?r=six/disp/result'">
            <div id="sp_autoinfo" class="autoinfo d-flex justify-content-between"></div>
        </li>
    </ul>
    <div class="content">
        <section class="tabArea pl-4 pr-4">
            <div class="tabLabel d-flex justify-content-between align-items-end">
                <p >第<span id="open_qihao"></span>期</p>
                <p class="cqc_time"><span id="cqc_text">距离封盘:</span><span id="FCDH"></span></p>
            </div>
        </section>
  