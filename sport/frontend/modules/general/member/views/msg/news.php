<div id="MACenter-content">
    <div id="MACenterContent">
        <div id="MMainData" class="new_pagebox">
            <div class="tittlebox">
                <a href="/?r=member/msg/index"></a>
                <h2><?= $msg['msg_title'] ?></h2>
            </div>
            <div class="senderbox">
                <p class="sender">
                    信息来自：<span><?= $msg['msg_from'] ?></span>
                </p>
                <p class="new_time">
                    <?= $msg['msg_time'] ?>
                </p>
            </div>
            <p class="new_content">
                <?= $msg['msg_info'] ?>
            </p>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'mynews');
</script>