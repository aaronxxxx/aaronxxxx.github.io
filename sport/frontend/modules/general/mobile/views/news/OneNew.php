<main class="bgwhite">
    <input type="hidden" name="" id="inputNavTitle" value="信息管理">
    <div class="msgInfo">
        <div class="inside">
            <div class="msgArea border_gray">
                <p ><?= $msg['msg_title']?></p>
            </div>
            <div class="msgArea border">
                <div class="msg_date2 mt-5 mb-3">
                    <b class="msg_text">发送人：  </b><span data="date"><?= $msg['msg_from']?></span>
                </div>
                <div class="msg_date2 mb-5">
                <b class="msg_text">时间：  </b><span data="date"><?= $msg['msg_time']?></span>
                </div>
                <div class="msg_cnt2 mb-4" data="content"><?= $msg['msg_info']?></div> <!-- 内文-->
                <a href="/?r=mobile/news/del&mid=<?= $msg['msg_id'] ?>">
                <div class="msg_dlt" type_id="inbox"></div></a>
                <input type="hidden" data="id" value="84326">
            </div>
        </div>
    </div>
</main>