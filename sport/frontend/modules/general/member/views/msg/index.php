<?php

use yii\widgets\LinkPager;
?>
<div id="MACenter-content">
    <div id="MACenterContent">
        <div id="MMainData" class="msg_index_box">
            <div style="color:#fff;text-align:center;padding-bottom:10px">
                提示：所有信息都变成'已读'状态时，网站的提示声音会自动消失。
            </div>
            <?php
            if (empty($msg)) {
                ?>
                <div id="general-msg">
                    <div class="haveRead MColor1">
                        <span style="text-align:center;display:block">暂时没有消息</span>
                    </div>
                </div>
            <?php
            } else {
                ?>
                <div id="general-msg" class="news_order_reverse">
                    <?php
                        foreach ($msg as $key => $value) {
                            ?>
                        <div id="list" class="haveRead MColor1">
                            <div class="flex_space_center">
                                <a class="msg_tittle" href="/?r=member/msg/news&mid=<?= $value['msg_id'] ?>" title="详细内容"><?= $value['msg_title'] ?></a>
                                <span><?= $value['msg_time'] ?></span>
                            </div>
                            <hr style="border:0;background-color:#BFBFBF;height:1px;">
                            <div class="flex_space_center">
                                <span id="islook" class="msg_look <?php if ($value['islook'] == '未读') {
                                                                                echo 'msg_nolook';
                                                                            } ?>"><?= $value['islook'] ?></span>
                                <a class="msg_delete" href="/?r=member/msg/del&mid=<?= $value['msg_id'] ?>">删除</a>
                            </div>
                        </div>
                    <?php
                        }
                        ?>
                </div>

            <?php
            }
            ?>
            <?= LinkPager::widget(['pagination' => $pages]); ?>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'mynews');
</script>