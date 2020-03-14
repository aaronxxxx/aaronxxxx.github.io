<link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="JavaScript" src="public/lottery/js/odds.js"></script>
<script>
    $().ready(function(){
        $lottery_type = '老PK拾';
        $sub_type = '主盘势';
        $url = '/?r=lotteryodds/orpk/up-zhupanshi';
        zhupanshi();
    })
    function zhupanshi(){
        $('#table').load('/?r=lotteryodds/orpk/zhupanshi',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        })
    }
    function dingwei(){
        $('#table').load('/?r=lotteryodds/orpk/dingwei',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        })
    }
    function kuaisu(){
        $('#table').load('/?r=lotteryodds/orpk/kuaisu',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        })
    }
    function rate(){
        $('#table').load('/?r=lotteryodds/orpk/rate',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
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
        $('#zhupanshi').click(function(){
            $('.tab_type').hide();
            $sub_type = '主盘势';
            $url = '/?r=lotteryodds/orpk/up-zhupanshi';
            zhupanshi();
        })
        $('#dingwei').click(function(){
            $('.tab_type').hide();
            $sub_type = '定位';
            $url = '/?r=lotteryodds/orpk/up-dingwei';
            dingwei();
        })
        $('#guanya_ks').click(function(){
            $('.tab_type').hide();
            $sub_type = '冠亚军和-快速';
            $url = '/?r=lotteryodds/orpk/up-kuaisu';
            kuaisu();
        })
        $('#RATE').click(function(){
            $('.tab_type').hide();
            $sub_type = 'RATE';
            $url = '/?r=lotteryodds/orpk/up-rate';
            rate();
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
                    window.location.href="#/lotteryodds/orpk/index&"+(new Date().valueOf())+"";
                }
            });
            return false;
        })
    })
</script>
<div id="box_body" class="bg2yellow">
<div id="box_range">
    <div id="main">
      <div class="main-inner">
        <div id="content">
        <h2><b></b><span class=" white2">老PK拾-赔率设置</span></h2>
            <div id="content_inner">
                <div style="display: block;" id="c_rtype" class="GameName"></div>
                 <div id="wager_groups" style="display:block;" class="">
                     <a class="NowPlay" id="zhupanshi" title="主盘势">主盘势</a>
                     <a id="dingwei" title="定位">定位</a>
                     <!--<a id="guanya" title="冠亚军和">冠亚军和</a>-->
                     <a id="guanya_ks" title="冠亚军和-快速">冠亚军和-快速</a>                     
                   <!--  <a id="xuanhao" title="选号">选号</a>-->
                     <a id="RATE" title="开奖控制">开奖控制</a>
                </div>
            </div>
          <div id="Game">
            <form action="" id="form1" name="form1" method="post">
                <div class="round-table" id="table" style="border:0;">

                </div>
                <p>
                    <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                </p>
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
</div>