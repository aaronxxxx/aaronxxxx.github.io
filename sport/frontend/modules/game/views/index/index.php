<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\modules\game\assets\AppAsset;
$imgUrl = $assetUrl . '/img';
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div id="mainBody_bg">
            <div class="mainBody">
                <div id="page-container">
                    <div id="ele-game-wrap">
                        <div id="ele-game-space" class="ele-game-wrap clearfix ">
                            <!-- ||: game area -->
                            <div class="ele-game-layout " id="game_5006" data-name="Starburst" data-id="game_5006">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="Starburst">
                                        Starburst
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_50061">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5006.png" 
                                         style="display: block; top: 0px; bottom: auto;">
                                </a>
                                <div class="ele-game-status status-New"></div>
                            </div>
                            <div class="ele-game-layout " id="game_5028" data-name="中秋月光派对" data-id="game_5028" style="opacity: 1;">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="中秋月光派对">
                                        中秋月光派对
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5028">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5028.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                                <div class="ele-game-status status-NewBonus"></div>
                            </div>
                            <div class="ele-game-layout " id="game_5007" data-name="激爆水果盘" data-id="game_5007">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="激爆水果盘">
                                        激爆水果盘
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5007">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5007.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                            </div>
                            <div class="ele-game-layout " id="game_5005" data-name="惑星战记" data-id="game_5005">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="惑星战记">
                                        惑星战记
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5005">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5005.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                                <div class="ele-game-status status-Recommend"></div>
                            </div>
                            <div class="ele-game-layout " id="game_5406" data-name="神舟27" data-id="game_5406">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="神舟27">
                                        神舟27
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5406">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5406.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                            </div>
                            <div class="ele-game-layout " id="game_5837" data-name="喜福猴年" data-id="game_5837">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="喜福猴年">
                                        喜福猴年
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5837">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5837.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                            </div>
                            <div class="ele-game-layout " id="game_5601" data-name="秘境冒险" data-id="game_5601">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="秘境冒险">
                                        秘境冒险
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5601">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5601.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                            </div>
                            <div class="ele-game-layout " id="game_5707" data-name="金钱豹" data-id="game_5707">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="金钱豹">
                                        金钱豹
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5707">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5707.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                                <div class="ele-game-status status-Recommend"></div>
                            </div>
                            <div class="ele-game-layout " id="game_5106" data-name="三国" data-id="game_5106">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="三国">
                                        三国
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5106">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5106.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                                <div class="ele-game-status status-Recommend"></div>
                            </div>
                            <div class="ele-game-layout " id="game_5706" data-name="浓情巧克力" data-id="game_5706">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="浓情巧克力">
                                        浓情巧克力
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5706">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5706.png" style="top: 0px; bottom: auto; display: block;">
                                </a>
                                <div class="ele-game-status status-Recommend"></div>
                            </div>
                            <div class="ele-game-layout " id="game_5705" data-name="聚宝盆" data-id="game_5705">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="聚宝盆">
                                        聚宝盆
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5705">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5705.png" style="display: block; top: 0px; bottom: auto;">
                                </a>
                                <div class="ele-game-status status-Recommend"></div>
                            </div>
                            <div class="ele-game-layout " id="game_5407" data-name="大红帽与小野狼" data-id="game_5407">
                                <div class="ele-game-name clearfix">
                                    <span class="ele-hall-icon "></span>
                                    <h3 title="大红帽与小野狼">
                                        大红帽与小野狼
                                    </h3>
                                </div>
                                <a class="ele-game-img" href="javascript:void(0);" 
                                   onclick="return submitGame(1002, <?= $uid ?>, '', '');" data-gametype="game_5407">
                                    <img class="lazyload" src="<?= $imgUrl ?>/Game_5407.png" style="display: block;">
                                </a>
                                <div class="ele-game-status status-Recommend"></div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>