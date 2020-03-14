
<script>
    window.onload = function () {
        var nx_array = {};
        var ary = {};
        var _type = "text";

        var json = {
            hall: 0,
            menu: '',
            inner: '',
            title: '',
            ad: '',
            ball: '',
            grp: '',
            rule: '',
            tips: '',
            zodiac:<?=json_encode($zodiacArr)?>,
            _number: _type
        };

        var _lt = self.ShowTable.instance(json);
        //  _lt.init({$rType},{$showTableN});//初始化设定 包括 设定请求ajax 地址 
        _lt.init("NA", "{$showTableN}"); //初始化设定 包括 设定请求ajax 地址
        _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
        _lt.setBetMode(1);//开启下注模式    1为可下注模式
        _lt.run();

    }
</script>
<main class="sixMain">
    <input id="lotteryName" type="hidden" value="極速六合彩 正码">
    <?php include 'header.php';?>
    <?php include 'fast_bet_lhai.php';?>
        <section class="g-nr" id="Game">
            <form name="newForm" id="newForm" action="/?r=spsix/index/six-order" method="post">
                <div  class="p-info p-info2">
                    <div class="round-table">
                        <table id="table1" class="tema_a sp-tema_a text-center"></table>
                    </div>
                    <div class="round-table" class="infos">
                        <table id="table2" class="tema_a sp-tema_a text-center"></table>
                    </div>
                    <div class="round-table">
                        <table id="table3" class="tema_a sp-tema_a text-center"></table>
                    </div>
                    <div class="round-table">
                        <table id="table4" class="tema_a sp-tema_a text-center"></table>
                    </div>
                </div>
                <div class="orderbtn">
                    <p class="p-btn btns pt-5 pb-5">
                    <input class="yes submit mr-2" type="button" name="btnBet" value="确定"/>
                        <input id="res1" class="no cancel" type="reset" value="取消"/>
                        <input type="hidden" name="period" id="period" value="<?= isset($lastOne['qishu']) ? $lastOne['qishu'] : 0; ?>"/>
                    </p>
                </div>
                <input type="hidden" name="gid" id="gid" />
                <input type="hidden" name="Line" id="Line" value="" />
            </form>
        </section>
    </div>
</div>
</main>
