<link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="JavaScript" src="public/lottery/js/odds.js"></script>
<script>
    $().ready(function(){
        $lottery_type = '腾讯分分彩';
        $sub_type = '两面';
        $url = '/?r=lotteryodds/ts5/up-liangmian';
        liangmian();
    })
    function liangmian(){
        $('#table').load('/?r=lotteryodds/ts5/liangmian',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function yizidingwei(){
        $('#table').load('/?r=lotteryodds/ts5/yizidingwei',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function longhuhe(){
        $('#table').load('/?r=lotteryodds/ts5/longhuhe',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function baozishunzi(){
        $('#table').load('/?r=lotteryodds/ts5/baozishunzi',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function niuniu(){
        $('#table').load('/?r=lotteryodds/ts5/niuniu',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
            checkNumber();
        });
    }
    function rate(){
        $('#table').load('/?r=lotteryodds/ts5/rate',{'lottery_type':$lottery_type,'sub_type':$sub_type},function () {
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
        $('#longhu,#zonghe_longhuhe').click(function(){
            $('.longhu').show().siblings('.tab_type').hide();
            $sub_type = '总和龙虎和';
            $url = '/?r=lotteryodds/ts5/up-longhuhe';
            longhuhe();
        })
        $('#niuniu,#niu_niu').click(function(){
            $('.niuniu').show().siblings('.tab_type').hide();
            $sub_type = '牛牛';
            $url = '/?r=lotteryodds/ts5/up-niuniu';
            niuniu();
        })
        $('#baozi_qiansan,#baozi').click(function(){
            $('.baozishunzi').show().siblings('.tab_type').hide();
            $sub_type = '豹子顺子(前三)';
            $url = '/?r=lotteryodds/ts5/up-baozishunzi';
            baozishunzi();
        })
        $('#baozi_zhongsan').click(function(){
            $('.baozishunzi').show().siblings('.tab_type').hide();
            $sub_type = '豹子顺子(中三)';
            $url = '/?r=lotteryodds/ts5/up-baozishunzi';
            baozishunzi();
        })
        $('#baozi_housan').click(function(){
            $('.baozishunzi').show().siblings('.tab_type').hide();
            $sub_type = '豹子顺子(后三)';
            $url = '/?r=lotteryodds/ts5/up-baozishunzi';
            baozishunzi();
        })
        $('#yizidingwei_wan,#yizidingwei').click(function(){
            $('.yizi_dingwei').show().siblings('.tab_type').hide();
            $sub_type = '万定位';
            $url = '/?r=lotteryodds/ts5/up-yizidingwei';
            yizidingwei();
        })
        $('#yizidingwei_qian').click(function(){
            $('.yizi_dingwei').show().siblings('.tab_type').hide();
            $sub_type = '仟定位';
            $url = '/?r=lotteryodds/ts5/up-yizidingwei';
            yizidingwei();
        })
        $('#yizidingwei_bai').click(function(){
            $('.yizi_dingwei').show().siblings('.tab_type').hide();
            $sub_type = '佰定位';
            $url = '/?r=lotteryodds/ts5/up-yizidingwei';
            yizidingwei();
        })
        $('#yizidingwei_shi').click(function(){
            $('.yizi_dingwei').show().siblings('.tab_type').hide();
            $sub_type = '拾定位';
            $url = '/?r=lotteryodds/ts5/up-yizidingwei';
            yizidingwei();
        })
        $('#yizidingwei_ge').click(function(){
            $('.yizi_dingwei').show().siblings('.tab_type').hide();
            $sub_type = '个定位';
            $url = '/?r=lotteryodds/ts5/up-yizidingwei';
            yizidingwei();
        })
        $('#liangmian').click(function(){
            $('.tab_type').hide();
            $sub_type = '两面';
            $url = '/?r=lotteryodds/ts5/up-liangmian';
            liangmian();
        })
        $('#RATE').click(function(){
            $('.tab_type').hide();
            $sub_type = 'rate';
            $url = '/?r=lotteryodds/ts5/up-rate';
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
                    window.location.href="#/lotteryodds/ts5/index&"+(new Date().valueOf())+"";
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
        <h2><b></b><span class=" white">腾讯分分彩-赔率设置</span></h2>
            <div id="content_inner">
                <div style="display: block;" id="c_rtype" class="GameName"></div>
                 <div id="wager_groups" style="display:block;" class="">
                    <a class="NowPlay" title="两面" id="liangmian">两面</a>
                     <a id="yizidingwei" title="一字定位">一字定位</a>
                    <a id="longhu" title="总和龙虎和">总和龙虎和</a>
                    <a id="baozi" title="豹子顺子">豹子顺子</a>
                    <a id="niuniu" title="牛牛">牛牛</a>
                </div>
            </div>
            <!--rtype选择-->
            <div id="arrowLeft"></div>
              <div id="select_tab">
                  <div class="tab_type yizi_dingwei" style="display: none;">
                      <ul>
                          <li class="onTagClick" id="yizidingwei_wan"><span class="517"><b>万</b></span></li>
                          <li class="unTagClick" id="yizidingwei_qian"><span class="518"><b>仟</b></span></li>
                          <li class="unTagClick" id="yizidingwei_bai"><span class="519"><b>佰</b></span></li>
                          <li class="unTagClick" id="yizidingwei_shi"><span class="520"><b>拾</b></span></li>
                          <li class="unTagClick" id="yizidingwei_ge"><span class="521"><b>个</b></span></li><li id="space"></li></ul>
                  </div>
                  <div class="tab_type longhu" style="display: none;">
                      <ul>
                          <li class="unTagClick onTagClick" id="zonghe_longhuhe"><span class="501"><b>总和龙虎和</b></span></li>
                      </ul>
                  </div>
                  <div class="tab_type baozishunzi" style="display: none;">
                      <ul>
                          <li class="unTagClick onTagClick" id="baozi_qiansan"><span class="501"><b>前三</b></span></li>
                          <li class="unTagClick" id="baozi_zhongsan"><span class="502"><b>中三</b></span></li>
                          <li class="unTagClick" id="baozi_housan"><span class="503"><b>后三</b></span></li>
                      </ul>
                  </div>
                  <div class="tab_type niuniu" style="display: none;">
                      <ul>
                          <li class="unTagClick onTagClick" id="niu_niu"><span class="501"><b>牛牛</b></span></li>
                      </ul>
                  </div>
              </div>
          <div id="Game">
            <form action="" id="form1" name="form1" method="post">
                <div class="round-table" id="table">

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