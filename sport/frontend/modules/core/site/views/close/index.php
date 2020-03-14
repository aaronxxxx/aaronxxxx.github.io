<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>网站维护</title>
        <style>
            body{ font-family: "Microsoft YaHei";
                  background: #F9FAFD;
            }
            .maintain{
                position: absolute;
                margin: -151px 0px 0px -386px;
                top: 50%;
                left: 50%;
                height: 282px;
                width: 773px;
                background-color: #fff;
                border-radius: 8px;
                padding-top: 20px;        border: 2px solid #EFEFEF;
            }
            .maintain-top{
                font-size: 20px;
                height: 26px;
                padding: 6px 15px 0 0;
            }
            .maintain-top .notice{
                font-weight: bold;
                text-shadow:1px 1px 1px #DDDDDD;

                line-height: 26px;
                float: right;
                *display: inline;
                *zoom: 1;
                margin: 0 5px;
            }

            .maintain-logo{
                position:absolute;
                top:85px;
                left:40px;
            }
            .maintain-content{
                width:550px;

                float:right;
                _display: inline;
                margin-right: 12px;
            }
            .maintain-content p{

                text-align: left;
                text-shadow: 1px 1px 1px #FFFFFF;
            }
            .maintain-content .text-body{
                color:#900;
                margin-top:40px;
                _margin-top:30px;
                font-size: 20px;
                font-weight: bolder;
            }
            .maintain-content .text-notice{
                font-size: 12px;
                font-weight: bolder;
                color: #999;
                margin-top:10px;
                _margin-top:0px;
            }
            .maintain-content .text-date{
                margin:20px 0 20px 0;
                line-height: 20px;
                font-size: 14px;
                font-family: "Comic Sans MS","Microsoft YaHei", "cursive";
                font-weight: bold;
                color: #666;
            }
            .maintain-content .text-date span{
                font-size: 16px;
                color: #C00;
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

            }
            .maintain-content .text-info span{
                font-size: 14px;
                color: #333;
                margin:0 15px 5px 0;
            }
            .maintain-content .text-upup{
                font-size: 12px;

                color: #666;
            }
            .jp .maintain-top .notice{
                margin-left: 640px;
                font-size: 16px;
            }
            .maintain-content .service{
                cursor:pointer;
                border-bottom:1px solid #666;
            }
        </style>
    </head>
    <body>
        <div class="maintain">
            <div class="maintain-top"><span class="notice">网站系统公告</span></div>
            <div class="maintain-logo">
                <img src="../../closeimg/closeimg.png">
            </div>
            <div class="maintain-content">
                <p class="text-body">
                    网站系统维护中，如有不便之处，敬请见谅！
                </p>
                <p class="text-notice">
                    Access to the site is not available due to scheduled maintenance,<br>
                    we apologize for any inconvenience caused.
                </p>
                <p class="text-date">--   预计于 <span>北京时间 <?= $endCloseTime ?></span> 完成！   --</p>
            </div>
        </div>
    </body>
</html>