
	<main class="sixMain">
		<input id="lotteryName" type="hidden" value="六合彩 正码特">
		<?php include 'header.php';?>
		<?php include 'fast_bet_lhai.php';?>
		<section class="g-nr" id="Game">
			<form name="newForm" id="newForm" action="/?r=six/index/six-order" method="post">
				<div class="qiu_one mt-2 mb-1" id="div-lm">
					<div class="qiu qiu_six">
						<ul class="d-flex justify-content-between">
							<li class="text-center act" data-tabinner="#nas_tabinner0" data-gid="N1">正码一</li>
							<li class="text-center" data-tabinner="#nas_tabinner1" data-gid="N2">正码二</li>
							<li class="text-center" data-tabinner="#nas_tabinner2" data-gid="N3">正码三</li>
							<li class="text-center" data-tabinner="#nas_tabinner3" data-gid="N4">正码四</li>
							<li class="text-center" data-tabinner="#nas_tabinner4" data-gid="N5">正码五</li>
							<li class="text-center" data-tabinner="#nas_tabinner5" data-gid="N6">正码六</li>
						</ul>
					</div>
				</div>
				<div class="nas_tabinnerArea">
					<?php foreach($arr as $k=>$v){?>
					<div id="nas_tabinner<?= $k?>" class="tabinner nas_tabinner pb-4" style="display:none;">
						<div class="p-info infos d-flex" <?php if($k==0) echo'';?>>
							<ul class="w-50">
							<p class="tit d-flex"><span>号码</span><span>赔率</span><span>金额</span></p>
							<?php for($i=1;$i<26;$i++){?>
								<li class="bet-item bian_li">
									<span <?php if($commonFc->sebo($i)==1){echo "class='bColorR'";} else if($commonFc->sebo($i)==2){echo "class='bColorB'";}else{echo "class='bColorG'";}?> style="width:27%;"><?=str_pad($i,2,'0',STR_PAD_LEFT);?></span>
									<span class="colorRed" style="width:27%;"><?=$v['h'.$i]?></span>
									<span  class="bian_td_inp">
										<?php $nx='N'.($k+1).str_pad($i,2,'0',STR_PAD_LEFT);?>
										<input class="odds" type="hidden" name="odds[<?=$nx?>]" value="<?=$v['h'.$i]?>"/>
										<input class="GoldQQ" title="<?='N'.($k+1)?>" name="gold[<?=$nx?>]" maxlength="4" type="text" value="">
									</span>
								</li>
							<?php }?>
							</ul>
							<ul class="w-50">
							<p class="tit d-flex"><span>号码</span><span>赔率</span><span>金额</span></p>
							<?php for($i=26;$i<50;$i++){?>
								<li class="bet-item">
									<span <?php if($commonFc->sebo($i)==1){echo "class='bColorR'";} else if($commonFc->sebo($i)==2){echo "class='bColorB'";}else{echo "class='bColorG'";}?> style="width:27%;"><?=str_pad($i,2,'0',STR_PAD_LEFT);?></span>
									<span class="colorRed" style="width:27%;"><?=$v['h'.$i]?></span>
									<span class="bian_td_inp" >
										<?php $nx='N'.($k+1).str_pad($i,2,'0',STR_PAD_LEFT);?>
										<input class="odds" type="hidden" name="odds[<?=$nx?>]" value="<?=$v['h'.$i]?>"/>
										<input class="GoldQQ " title="<?='N'.($k+1)?>" name="gold[<?=$nx?>]" maxlength="4" type="text" value="">
									</span>
								</li>
							<?php }?>
							</ul>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="orderbtn">
					<!-- <label>下注金额：<span id="cash" style="color:red; font-weight:bold;">0.00</span></label> -->
					<p class="p-btn  btns pt-5 pb-5">
						<input type="hidden" name="gid" id="gid" value="N1"/>
						<input type="hidden" name="userId" id="userId" value="<?=$userId;?>"/>
						<input type="hidden" name="period" id="period" value="<?=isset($lastOne['qishu'])?$lastOne['qishu']:0; ?>"/>
						<input type="button" class="yes submit mr-2" onClick="sendd()" id="send" value="确定" <?php if(!$lastOne) echo ' disabled';?>/>
						<input type="reset" class="no cancel" id="res1" value="取消" name="res" <?php if(!$lastOne) echo ' disabled';?>/>
					</p>
				</div>
			</form>
		</section>
	</div>
</div>
</main>
<script type="text/javascript">
	$c=0;
	$timehandle='';
	$time=0;
	$(document).ready(function(){
		$('#nas_tabinner0').show();
		$('.qiu li').click(function () {
			var tabinner = $(this).data('tabinner'),
				gid = $(this).data('gid');
				console.log(gid);
			$('#gid').val(gid);
			$(this).addClass('act').siblings().removeClass('act');
			$('.nas_tabinnerArea').find('.nas_tabinner').hide();
			$(tabinner).show();
		});
		fdch();
		<?php if($lastOne){ ?>
		$tis=new Array();
		$time=<?=strtotime($lastOne['fenpan_time'])-time();?>;
		$timehandle=window.setInterval('disp()',1000);
		<?php }?>
		document.oncontextmenu=function(){return false;}
	});
	function _count() {
    $c = 0;
    $('input[class="GoldQQ"]').each(function (index, element) {
        if ($(this).val() != '') {
            $c += parseFloat($(this).val());
        }
    });
    $('#cash').html($c.toFixed(2));
    return $c.toFixed(2);
}
function fdch(){
	$.ajax({
        url: "/?r=six/index/ajax&rtype=home",
        dataType: 'JSON',
        success: function (res) {
            if (res['isCloseAdmin'] === "true" || res['isCloseNoGame'] === "true") {
				//開盤倒數
				$('.nas_tabinnerArea').html('<div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 六合彩目前休盘，请等待下一期开盘。</div>');
                var open_sec = parseInt(res['next']);
                if (open_sec <= 100) {
                    for (let i = open_sec; i >= 0; i--) {
                        var temp = i;
                        setTimeout(function () {
							$('#cqc_text').html('');
							$("#FCDH").html((open_sec - i) + '秒后,将自动开盘');
							
                            if ((open_sec - i) == 0) {
                                location.reload();
                            }
                        }, 1000 * (i + 1));
                    }
                } else {
                    t = '下次开盘时间为隔日北京时间10:00:00';
                    $("#FCDH").html(t);
                }

                window.setTimeout('location.reload();', open_sec * 1000);
            }
        }
    });
}

function check() {
    $c = parseFloat(_count());
    if ($("#userId").val() == null || $("#userId").val() == 'undefined' || $("#userId").val() == '') {
        layer.confirm('还未登录,是否现在登录？', {
                btn: ['确定', '取消']
            },
            function () {
                var $url = window.location.href;
                var $index = $url.indexOf('/?r=');
                if (parseInt($index) >= 0) {
                    $url = $url.substr($index);
                    $url = $url.replace('/?r=', '[]');
                }
                top.location = '/?r=mobile/disp/login&url=' + $url;
            },
            function (index) {
                layer.close(index);
            });
        //layer.alert("请先登录");
        return false;
    }
    if (!isNaN($c) && $c > 0) {
        return true;
    }
    if (isNaN($c)) {
        layer.msg('金额输入不正确！', {
            icon: 2
        });
    } else {
        layer.msg('请至少下注一个号码！', {
            icon: 2
        });
    }
    return false;
}

function disp() {
    if ($time > 0) {
        $time--;
        if ($time == 0) {
            location.reload();
        }
		var $his = tms($time).substring(3,8);
        $('#FCDH').html($his);
        _count();
    } else {
        $('#send').attr('disabled', true);
        window.clearInterval($timehandle);
    }
}

function sendd() {
    if (check()) {
        var $cash = Number(_count());
        var $min = Number($("#min").val());
        var $max = Number($("#max").val());
        if ($("#userId").val() == null || $("#userId").val() == 'undefined' || $("#userId").val() == '') {
            layer.confirm('还未登录,是否现在登录？', {
                    btn: ['确定', '取消']
                },
                function () {
                    var $url = window.location.href;
                    var $index = $url.indexOf('/?r=');
                    if (parseInt($index) >= 0) {
                        $url = $url.substr($index);
                        $url = $url.replace('/?r=', '[]');
                    }
                    top.location = '/?r=mobile/disp/login&url=' + $url;
                },
                function (index) {
                    layer.close(index);
                });
            //layer.alert("请先登录");
            return false;
        }
        if (($cash < $min) || ($cash > $max)) {
            layer.alert('下注金额不能低于' + $min + '元,且不能高于' + $max + "元");
            return false;
        }
        layer.confirm('将下注' + $cash + '元，是否提交？', {
            btn: ['确定', '取消'] //按钮
        }, function ($index) {
            if ($time <= 0) {
                $('#send').attr('disabled', true);
                $('#res1').attr('disabled', true);
                layer.msg('已经封盘无法下注！', {
                    icon: 2
                });
            } else {
                ajax();
            }
        }, function () {
            layer.closeAll();
        });
    }
}

function tms($num) {
    $tis[0] = parseInt($num / 3600);
    $tis[1] = parseInt($num / 60) % 60;
    $tis[2] = $num - $tis[0] * 3600 - $tis[1] * 60;
    for ($i in $tis) {
        if ($tis[$i] < 10) {
            $tis[$i] = '0' + $tis[$i];
        }
    }
    return $tis.join(':');
}

function ajax() {
    layer.closeAll();
    $.ajax({
        'url': '/?r=six/index/six-order',
        type: 'POST',
        dataType: 'json',
        data: $('#newForm').serializeArray(),
        async: 'false',
        success: function (e) {
            if (e.msg == '') {
                e = '下注' + $('#cash').html() + '元成功！';
                $('#cash').html('0.00');
                $('input[name=res]').click();
                layer.msg(e.msg, {
                    icon: 1
                });
            } else {
                if (e.msg == '未登录，请先登录') {
                    layer.confirm('还未登录,是否现在登录？', {
                            btn: ['确定', '取消']
                        },
                        function () {
                            var $url = window.location.href;
                            var $index = $url.indexOf('/?r=');
                            if (parseInt($index) >= 0) {
                                $url = $url.substr($index);
                                $url = $url.replace('/?r=', '[]');
                            }
                            top.location = '/?r=mobile/disp/login&url=' + $url;
                        },
                        function (index) {
                            layer.close(index);
                        });
                } else {
                    layer.alert(e.msg, function () {
                        window.location.reload();
                    });
                }
            }
        }
    });
}
</script>

