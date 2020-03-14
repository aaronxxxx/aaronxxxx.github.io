<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-title" content="">
    <title>下单记录</title>
    <link rel="stylesheet" href="/public/aomen/css/astyle.css?1576663200">
    <link rel="stylesheet" href="/public/aomen/css/mb_list.css?1576663200">
    <link rel="stylesheet" href="/public/aomen/css/jquery-ui.min.css">
</head>

<body>
    <div id="mb_list" class="mb_list">
        <div class="bg"></div>
        <div class="list_header d-flex justify-content-start align-items-center">
            <img src="/public/aomen/images/index/list_left.png" alt="上一页" srcset="" onclick="location.href='/?r=mobile/disp/ftbk';">
            <h3>下单记录</h3>
            <div></div>
        </div>
        <div class="list_body">
            <div class="select_time d-flex justify-content-center align-items-center">
                <input id="date" class="date" type="text" value="<?= $date ?>" readonly placeholder="选择日期">
                <div class="left date_btn"></div>
                <div class="right date_btn"></div>
            </div>
            <div id="list_table1" class="list_table">
            <?php
                foreach ($list as $key => $val) {
            ?>
                <div class="list_content">
                    <ul class="list_card">
                        <li class="d-flex justify-content-between align-items-center">
                            <span data-id="no"><?= $val['order_num'] ?></span>
                            <span class="rangfen"><?= $val['title'] ?></span>
                        <?php
                            if ($val['status'] == 0) {
                        ?>
                            <span class="result-wait" data-id="result">尚未開奖</span>
                        <?php
                            } elseif ($val['status'] == 1 && $val['is_win'] == 1) {
                        ?>
                            <span class="result-yes" data-id="result">中奖</span>
                        <?php
                            } elseif ($val['status'] == 1 && $val['is_win'] == 0) {
                        ?>
                            <span class="result-no" data-id="result">已开奖</span>
                        <?php
                            }
                        ?>
                            <img class="arrow" src="/public/aomen/images/index/22etg.png" alt="">
                        </li>
                        <li class="d-flex justify-content-start align-items-center">
                            <span>投注项目：</span>
                            <span data-id="vs"><?= $val['game_item_id'] ?></span>
                        </li>
                        <li class="d-flex justify-content-start align-items-center">
                            <span>投注金額：</span>
                            <span data-id="money"><?= $val['bet_money'] ?></span>
                        </li>
                    </ul>
                    <ul class="inner_card d-none">
                        <?php
                            if ($val['game_type'] == 1) {
                        ?>
                        <li class="d-flex justify-content-start align-items-center">
                            <span>让票：</span>
                            <span class="rangfen"><?= $val['rangfen'] ?></span>
                        </li>
                        <?php
                            }
                        ?>
                        <li class="d-flex justify-content-start align-items-center">
                            <span>赔率：</span>
                            <span data-id="odds"><?= $val['bet_rate'] ?></span>
                        </li>
                        <li class="d-flex justify-content-start align-items-center">
                            <span>编号：</span>
                            <span data-id="no"><?= $val['qishu'] ?></span>
                        </li>
                        <li class="d-flex justify-content-start align-items-center">
                            <span>下单时间：</span>
                            <span data-id="time"><?= $val['bet_time'] ?></span>
                        </li>
                        <li class="d-flex justify-content-start align-items-center">
                            <span>开奖结果：</span>
                            <span data-id="result"><?= $val['win_total'] > 0 ? $val['win_total'] : 0; ?></span>
                        </li>
                        <li class="d-flex justify-content-start align-items-center">
                            <textarea type="text" data-id="" class="bet_text_input" name="" placeholder="无备注" readonly><?= $val['message'] ?></textarea>
                        </li>
                    </ul>
                </div>
            <?php
                }
            ?>
            </div>
        </div>

        <?php
            use yii\widgets\LinkPager;

            echo LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount' => 3,
                'options' => ['class' => 'list_footer d-flex justify-content-center align-items-center'],
                'pageCssClass' => 'select_btn each_page',
                'prevPageLabel' => '<img src="/public/aomen/images/index/icon-prev.png" alt="">',
                'prevPageCssClass' => 'select_btn prev_page',
                'nextPageLabel' => '<img src="/public/aomen/images/index/icon-next.png" alt="">',
                'nextPageCssClass' => 'select_btn next_page',
                'firstPageLabel' => '<img src="/public/aomen/images/index/icon-first.png" alt="">',
                'firstPageCssClass' => 'select_btn first_page',
                'lastPageLabel' => '<img src="/public/aomen/images/index/icon-last.png" alt="">',
                'lastPageCssClass' => 'select_btn last_page'
            ])
        ?>

    </div>
</body>
<script src="/public/aomen/js/jquery-1.8.3.min.js"></script>
<script src="/public/buyugame/js/jquery-ui.js"></script>
<script src="/public/aomen/js/mb_list-dist.js"></script>

</html>