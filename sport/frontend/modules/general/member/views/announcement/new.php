<?php

use yii\widgets\LinkPager;
?>
<div id="MACenter-content">
    <div id="MACenterContent">
        <div id="MMainData" class="msg_index_box news_order">
            <?php
            if (empty($msg[0]['content'])) {
                ?>
                <div id="general-msg">
                    <div class="haveRead MColor1">
                        <span style="text-align:center;display:block">暂时没有消息</span>
                    </div>
                </div>
                <?php
                } else {
                    foreach ($msg as $key => $value) {
                        ?>
                    <div class="MColor1">
                        <p><?= $value['create_date'] ?></p>
                        <hr style="border:0;background-color:#BFBFBF;height:1px;">
                        <span class="MContent"><?= $value['content'] ?></span>
                    </div>
            <?php
                }
            }
            ?>
            <?php
            if (!empty($msg[0]['content'])) {
                LinkPager::widget(['pagination' => $pages]);
            }
            ?>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'myannouncement');
</script>