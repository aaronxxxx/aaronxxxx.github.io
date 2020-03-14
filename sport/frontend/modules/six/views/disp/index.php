<script>
window.onload = function() {
    var nx_array = {};
    var ary = {};
    var _type = "text";
    var json = {
        hall : 0,
        menu : '',
        inner : '',
        title : '',
        ad : '',
        ball : '',
        grp : '',
        rule : '',
        tips : '',
        zodiac :<?=json_encode($zodiacArr)?>,
        _number : _type
    };
    var _lt = self.ShowTable.instance(json);
    //  _lt.init({$rType},{$showTableN});//初始化设定 包括 设定请求ajax 地址 
    _lt.init("home"); //初始化设定 包括 设定请求ajax 地址
    _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
    _lt.setBetMode(1);//开启下注模式    1为可下注模式
    _lt.run();
}
</script>

<main class="mt-4 sixMain">
    <input id="lotteryName" type="hidden" name="" value="六合彩">
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
        <div class="tabinnerArea">
            <ul class="sixIndexTab">
                <li><a href="/?r=six/disp/te-ma-a">特别号A面</a></li>
                <li><a href="/?r=six/disp/te-ma-b">特别号B面</a></li>
                <li><a href="/?r=six/disp/liang-mian">两面</a></li>
                <li><a href="/?r=six/disp/zheng-ma">正码</a></li>
                <li><a href="/?r=six/disp/nas">正码特</a></li>
                <li><a href="/?r=six/disp/zheng-ma-no">正码1-6</a></li>
                <li><a href="/?r=six/disp/zheng-ma-g-g">正码过关</a></li>
                <li><a href="/?r=six/disp/lian-ma">连码</a></li>
                <li><a href="/?r=six/disp/lian-xiao">连肖</a></li>
                <li><a href="/?r=six/disp/lian-wei">连尾</a></li>
                <!-- <li><a href="/?r=six/disp/not-in">自选不中</a></li> -->
                <li><a href="/?r=six/disp/te-ma-s-x">特码生肖</a></li>
                <li><a href="/?r=six/disp/zheng-xiao">正肖</a></li>
                <li><a href="/?r=six/disp/yi-xiao">一肖</a></li>
                <li><a href="/?r=six/disp/he-xiao">合肖</a></li>
                <li><a href="/?r=six/disp/zong-xiao">总肖</a></li>
                <li><a href="/?r=six/disp/se-bo">色波</a></li>
                <!-- <li><a href="/?r=six/disp/ban-bo">半波</a></li>
                <li><a href="/?r=six/disp/ban-ban-bo">半半波</a></li>
                <li><a href="/?r=six/disp/qi-se-bo">七色波</a></li> -->
                <li><a href="/?r=six/disp/tou-wei-shu">头尾数</a></li>
                <li><a href="/?r=six/disp/zheng-te-wei-shu">平特尾数</a></li>
            </ul>
        </div>
    </div>
</main>