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
    <title><?=$lotteryname?></title>
    <link href="/public/aomen/lottery/css/swiper.min.css" rel="stylesheet" />
    <link href="/public/aomen/lottery/css/style.css" rel="stylesheet" />
    <script src="/public/aomen/lottery/js/jquery-1.11.1.min.js"></script>
    <script>
        $(document).ready(function(){
            getLoginedInfo();
            setInterval(getLoginedInfo,5000);
        });
        /**
         * 获取用户信息
         * getLoginedInfo()
         * @returns {undefined}
         */
        function getLoginedInfo() {
            $.post("/?r=mobile/index/json",{},
                    function(res){
                        if(res.name !== ''){
                            $("#user_money").html(res.money);
                        }
                    },"json");
        }
    </script>
</head>

<body>
    <!--<section class="back f20em"><a href="javascript:history.back(-1)" class="go-back">&lt;</a> 彩票游戏 
        <span style="float: right">余额:<span id="user_money">0.00</span></span>
    </section>-->
    <div class="pdcenter">
        <section class="name"><?=$lotteryname?></section>
        <section class="g-info">
            <p style="color:red;text-align:center;" id="gbkjjgbak"> <?=$lotteryname.'系统维护,暂时关闭!'?></p>
        </section>
    </div>
    <footer>Copyright © 澳門銀河賭場 Reserved </footer>
</body>
</html>
