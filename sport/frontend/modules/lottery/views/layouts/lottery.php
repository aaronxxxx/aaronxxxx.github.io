<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\widgets\Alert;
use app\modules\lottery\models\ar\WebClose;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/public/luzhu/css/new_blue.css" rel="stylesheet" />
    <script src="/public/luzhu/js/jquery-1.8.3.min.js"></script>
    <script src="/public/luzhu/js/lottery.js"></script>
    <script src="/public/luzhu/layer/layer.js"></script>
    <script src="/public/luzhu/js/server.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="skin_brown">
    <!--头部begin-->
    <div class="hd">
        <div id="topblock">
            <div id="menutop">
                <div class="main-nav" id="main-nav">
                    <!--20190108
                     <span><a href="javascript: openUCWindow('/?r=member/lottery-now/lottery', '当期下注');">当期下注</a></span>| -->
                    <!-- <span><a href="javascript: openUCWindow('/?r=member/lottery/lottery', '交易记录');">下注明细</a></span> -->
                    <span><a href="javascript: openUCWindow('/?r=lottery/lottery-result/index&gtype=<?php echo $this->params['type'] ?>', '历史开奖');">历史开奖</a></span>
                    <span><a href="javascript: openUCWindow('/?r=lottery/rule/index&gtype=<?php echo $this->params['type'] ?>', '规则');">规则</a></span>
                    <!-- <span id="videoBtn"><a href="#" onclick="clickVideo()">开奖视频</a></span> -->
                </div>
            </div>
            <div class="ssc-nav">
                <ul class="clear" id="select_sys">
                    <li <?php if ($this->params['type'] == 'CQ') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('cq') == 1) { ?>style="display: none" <?php } ?> data-video="1"><a class="ssc-nav-info" href="/?r=lottery/lzcqssc/index">
                            <h3>重庆时时彩</h3>
                            <div></div>
                            <p class="white" id="cqssc">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'BJPK') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('pk10') == 1) { ?>style="display: none" <?php } ?> data-video="1"><a class="ssc-nav-info" href="/?r=lottery/lzpk10/index">
                            <h3>北京PK拾</h3>
                            <div></div>
                            <p class="white" id="bjpk10">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'ORPK') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('orpk') == 1) { ?>style="display: none" <?php } ?> data-video="1"><a class="ssc-nav-info" href="/?r=lottery/lzorpk/index">
                            <h3>老PK拾</h3>
                            <div></div>
                            <p class="white" id="orpk">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'TS') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('ts') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzts5/index">
                            <h3>腾讯分分彩</h3>
                            <div></div>
                            <p class="white" id="ts5">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'TJ') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('tj') == 1) { ?>style="display: none" <?php } ?> data-video="1"><a class="ssc-nav-info" href="/?r=lottery/lztjssc/index">
                            <h3>极速时时彩</h3>
                            <div></div>
                            <p class="white" id="tjssc">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'SSRC') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('ssrc') == 1) { ?>style="display: none" <?php } ?> data-video="1"><a class="ssc-nav-info" href="/?r=lottery/lzssrc/index">
                            <h3>极速赛车</h3>
                            <div></div>
                            <p class="white" id="ssrc">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'MLAFT') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('mlaft') == 1) { ?>style="display: none" <?php } ?> data-video="1"><a class="ssc-nav-info" href="/?r=lottery/lzmlaft/index">
                            <h3>幸运飞艇</h3>
                            <div></div>
                            <p class="white" id="mlaft">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'GXSF') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('gxsf') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzgxsf/index">
                            <h3>广西十分彩</h3>
                            <div></div>
                            <p class="white" id="gxsfc">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'CQSF') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('cqsf') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzcqsf/index">
                            <h3>重庆快乐十分</h3>
                            <div></div>
                            <p class="white" id="cqsfc">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'GDSF') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('gdsf') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzgdsf/index">
                            <h3>广东快乐十分</h3>
                            <div></div>
                            <p class="white" id="gdsfc">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'TJSF') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('tjsf') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lztjsf/index">
                            <h3>天津快乐十分</h3>
                            <div></div>
                            <p class="white" id="tjsfc">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'D3') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('d3') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzfc3d/index">
                            <h3>福彩3D</h3>
                            <div></div>
                            <p class="white" id="fc3d">开盘中</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'P3') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('p3') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzpl3/index">
                            <h3>排列3</h3>
                            <div></div>
                            <p class="white" id="pl3">开盘中</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'T3') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('t3') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzshssl/index">
                            <h3>上海时时乐</h3>
                            <div></div>
                            <p class="white" id="shssl">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'BJKN') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('kl8') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzkl8/index">
                            <h3>北京快乐8</h3>
                            <div></div>
                            <p class="white" id="bjkl8">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                    <li <?php if ($this->params['type'] == 'GD11') {
                            echo 'class="c"';
                        } ?><?php if (WebClose::getLotteryTypeClose('gd11') == 1) { ?>style="display: none" <?php } ?>><a class="ssc-nav-info" href="/?r=lottery/lzgd11/index">
                            <h3>广东11选5</h3>
                            <div></div>
                            <p class="white" id="gd11x5">00:00</p>
                        </a>
                        <div class="mark"></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--头部end-->
    <?php if ($this->params['close'] == 1) { ?>
        <p style="background: #f1f1f1;color:red;text-align:center;line-height:13;font-size:30px;"><?= $this->params['name'] . '维护中……' ?></p>
        <?php exit;
    } ?>
    <?php $this->beginBody() ?>

    <?= $content ?>
    <script type="text/javascript">
        $(function() {
            loadinfo();
            videoType();
        })
    </script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>