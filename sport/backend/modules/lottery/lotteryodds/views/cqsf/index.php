<link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="JavaScript" src="public/lottery/js/odds.js"></script>
<script>
    $().ready(function(){
        $lottery_type = '重庆十分彩';
        $sub_type = '正码和特别号';
        $url = '/?r=lotteryodds/cqsf/updanma';
        danma();
    })
    function danma(){
        $('#table').load('/?r=lotteryodds/cqsf/danma',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        })
    }
    function fangwei(){
        $('#table').load('/?r=lotteryodds/cqsf/fangwei',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        })
    }
    function zonghe(){
        $('#table').load('/?r=lotteryodds/cqsf/zonghe',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        })
    }
    $(function(){
        $('#wager_groups > a').click(function(){
            $(this).addClass('NowPlay').siblings('a').removeClass('NowPlay');
            })
        $('.tab_type > ul >li').click(function (){
            $(this).addClass('onTagClick').siblings('li').removeClass('onTagClick').addClass('unTagClick');
        })
        $('#danmashuangmian').click(function(){
            $('.tab_type').hide();
            $sub_type = '正码和特别号';
            $url = '/?r=lotteryodds/cqsf/updanma';
            danma();
        })
        $('#fangwei').click(function(){
            $('.tab_type').hide();
            $sub_type = '方位中发白';
            $url = '/?r=lotteryodds/cqsf/upfangwei';
            fangwei();
        })
        $('#zonghe').click(function(){
            $('.tab_type').hide();
            $sub_type = '总和龙虎';
            $url = '/?r=lotteryodds/cqsf/upzonghe';
            zonghe();
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
                    window.location.href="#/lotteryodds/cqsf/index&"+(new Date().valueOf())+"";
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
            <h2><b></b><span>重庆十分彩-赔率设置</span></h2>
                <div id="content_inner">
                    <div style="display: block;" id="c_rtype" class="GameName"></div>
                     <div id="wager_groups" style="display:block;" class="">
                         <a  title="单码双面" id="danmashuangmian">单码双面</a>
                         <a id="fangwei" title="方位/中发白">方位/中发白</a>
                         <a id="zonghe" title="总和/龙虎">总和/龙虎</a>
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
