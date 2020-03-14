<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <title>彩票游戏</title>
    <link href="/public/aomen/css/style.css" rel="stylesheet" />
</head>
<body>
<section class="back f15em"><a href="/?r=spsix/disp/index" class="go-back">&lt;</a> 极速六合彩
    <span style="float: right"><a href="/?r=mobile/lottery/lottery">下注状况</a>&nbsp;&nbsp;&nbsp;余额:<span id="user_money"><?=$userMoney;?></span></span>
</section>
    <div class="pdcenter">
        <section class="name">正码特</section>
        <section class="g-info spg-info">
        <?php if(!empty($lastOne)){?>
            <p>当前期数：第<?=trim($lastOne['qishu'])?>期</p>
            <p>封盘时间：<?=$lastOne['kaijiang_time']?></p>
            <p>剩余时间：<span id="down" class="f00" style="color:red; font-weight:bold;"><?=$commonFc->tms(strtotime($lastOne['fenpan_time'])-time())?></span></p>
        <?php }else{?>
            <p>当前期数：</p>
            <p>封盘时间：</p>
            <p>剩余时间：</p>
			<div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 极速六合彩目前休盘，请等待下一期开盘。</div>
        <?php }?>
        </section>
         <section class="pk-list">
        </section>
    </div>
    <footer>Copyright © 澳門銀河賭場 Reserved </footer>
    <script src="/public/aomen/js/jquery-1.8.3.min.js"></script>
    <script src="/public/layer/layer.js"></script>
    <script type="text/javascript">
    </script>
</body>
</html>