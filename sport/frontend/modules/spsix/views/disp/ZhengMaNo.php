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
        _lt.init("NO", "{$showTableN}"); //初始化设定 包括 设定请求ajax 地址
        _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
        _lt.setBetMode(1);//开启下注模式    1为可下注模式
        _lt.run();
    }
</script>
<main class="sixMain">
<input id="lotteryName" type="hidden" value="極速六合彩 正码1-6">
    <?php include 'header.php';?>
    <?php include 'fast_bet_lhai.php';?>
        <section class="pk-list" id="Game">
            <form name="newForm" id="newForm" action="/?r=spsix/index/six-order" method="post">
                <!-- 前八球-->
                <div class="qiu_one" >
                    <!-- <div id="tab" class="qiu qiu_six">
                        <ul class="d-flex">
                            <li data-rtypeN="N1" class="act" class="onTagClick"><b>正码特1</b></li>
                            <li data-rtypeN="N2" class="unTagClick"><b>正码特2</b></li>
                            <li data-rtypeN="N3" class="unTagClick"><b>正码特3</b></li>
                            <li data-rtypeN="N4" class="unTagClick"><b>正码特4</b></li>
                            <li data-rtypeN="N5" class="unTagClick"><b>正码特5</b></li>
                            <li data-rtypeN="N6" class="unTagClick"><b>正码特6</b></li>
                            <li id="space" style="width:15px;"></li>
                        </ul>
                    </div> -->
                    <div class="round-table">
                        <table id="table1" class="tema_a sp-tema_a pr-4 pl-4 pb-4 text-center" style="width:100%;"  data-digits="2"></table>
                    </div>
                    <div class="round-table" class="infos">
                        <table id="table2" class="tema_a sp-tema_a"></table>
                    </div>
                    <div class="round-table">
                        <table id="table3" class="tema_a sp-tema_a"></table>
                    </div>
                    <div class="round-table">
                        <table id="table4" class="tema_a sp-tema_a"></table>
                    </div>
                </div>
                <div class="orderbtn">
                    <p class="p-btn btns pt-5 pb-5">
                        <input class="yes submit mr-2" type="button" name="btnBet" value="确定"/>
                        <input id="res1" class="no cancel" type="reset" value="取消"/>
                    </p>
                </div>
                <input type="hidden" name="gid" id="gid" />
                <input type="hidden" name="Line" id="Line" value="" />
            </form>
        </section>
    </div>
</div>
</main>
<!-- <script src="/public/aomen/js/swiper.jquery.min.js"></script> -->
<script type="text/javascript">
    $(function () {
        $('.qiu li').click(function () {
            $(this).addClass('act').siblings().removeClass('act');
        })
    })
</script>
