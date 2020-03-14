<link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="JavaScript" src="public/lottery/js/odds.js"></script>
<script>
    $().ready(function(){
        $lottery_type = '3D彩';
        $sub_type = '两面';
        $url = '/?r=lotteryodds/fc3d/up-liangmian';
        liangmian();
    })
    function liangmian(){
        $('#table').load('/?r=lotteryodds/fc3d/liangmian',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function yizi_bai(){
        $('#table').load('/?r=lotteryodds/fc3d/yizi-bai',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function yizi_shi(){
        $('#table').load('/?r=lotteryodds/fc3d/yizi-shi',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function yizi_ge(){
        $('#table').load('/?r=lotteryodds/fc3d/yizi-ge',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function kuadu(){
        $('#table').load('/?r=lotteryodds/fc3d/kuadu',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function longhuhe(){
        $('#table').load('/?r=lotteryodds/fc3d/longhuhe',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function baozi(){
        $('#table').load('/?r=lotteryodds/fc3d/baozi',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    $(function(){
        $('#wager_groups > a').click(function(){
            $(this).addClass('NowPlay').siblings('a').removeClass('NowPlay');
            })
        $('.tab_type > ul >li').click(function (){
            $(this).addClass('onTagClick').siblings('li').removeClass('onTagClick').addClass('unTagClick');
        })
        $('#liangmian').click(function(){
            $('.tab_type').hide();
            $sub_type = '两面';
            $url = '/?r=lotteryodds/fc3d/up-liangmian';
            liangmian();
        })
        $('#yizi_bai,#yizi').click(function(){
            $('.yizi').show().siblings('.tab_type').hide();
            $sub_type = '佰定位';
            $url = '/?r=lotteryodds/fc3d/up-yizi';
            yizi_bai();
        })
        $('#yizi_shi').click(function(){
            $sub_type = '拾定位';
            $url = '/?r=lotteryodds/fc3d/up-yizi';
            yizi_shi();
        })
        $('#yizi_ge').click(function(){
            $sub_type = '个定位';
            $url = '/?r=lotteryodds/fc3d/up-yizi';
            yizi_ge();
        })
        $('#kuadu').click(function(){
            $('.tab_type').hide();
            $sub_type = '跨度';
            $url = '/?r=lotteryodds/fc3d/up-yizi';
            kuadu();
        })
        $('#longhu').click(function(){
            $('.tab_type').hide();
            $sub_type = '总和龙虎和';
            $url = '/?r=lotteryodds/fc3d/up-longhuhe';
            longhuhe();
        })
        $('#sanlian').click(function(){
            $('.tab_type').hide();
            $sub_type = '3连';
            $url = '/?r=lotteryodds/fc3d/up-baozi';
            baozi();
        })
        $('#save_odds').click(function(){
            var params = $('#form1').serialize()+'&lottery_type='+$lottery_type+'&sub_type='+$sub_type;
            $.ajax({
                'url':$url,
                async:true,
                type:'POST',
                data:params,
                success: function(data){
                    layer.alert(data);
                    window.location.href="#/lotteryodds/fc3d/index&"+(new Date().valueOf())+"";
                }
            });
            return false;
        })
    })
</script>
<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="main">
            <div id="content">
            <h2><b></b><span class=" white">3D彩-赔率设置</span></h2>
                <div id="content_inner">
                    <div style="display: block;" id="c_rtype" class="GameName"></div>
                     <div id="wager_groups" style="display:block;" class="">
                        <a class="NowPlay" title="两面" id="liangmian">两面</a>
                        <a id="yizi" title="一字">一字</a>
                        <a id="kuadu" title="跨度">跨度</a>
                        <a id="longhu" title="总和龙虎和">总和龙虎和</a>
                        <a id="sanlian" title="3连">3连</a>
                    </div>
                </div>
                <!--rtype选择-->
                <div id="arrowLeft"></div>
                  <div id="select_tab">
                      <div class="tab_type yizi" style="display: none;">
                          <ul>
                              <li class="unTagClick onTagClick" id="yizi_bai"><span class="502"><b>口XX</b></span></li>
                              <li class="unTagClick" id="yizi_shi"><span class="503"><b>X口X</b></span></li>
                              <li class="unTagClick" id="yizi_ge"><span class="605"><b>XX口</b></span></li><li id="space"></li>
                          </ul>
                      </div>
                  </div>
              <div id="Game">
                <form action="" id="form1" name="form1" method="post">
                    <div class="round-table" id="table">

                    </div>
                    <div id="SendB5">
                        <button id="save_odds" class="order">保存</button>
                    </div>
                </form>
              </div>
                <input type="hidden" id="lottery_type" name="sRtype" value=""/>
                <input type="hidden" id="sub_type" name="sGtype" value=""/>
              </div>

        </div>
    </div>
</div>