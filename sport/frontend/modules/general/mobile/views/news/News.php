<main class="bgwhite">
    <input type="hidden" name="" id="inputNavTitle" value="信息管理">
    <div class="msgInfo">
        <div class="personal">
            <div class="msgArea d-flex justify-content-between border_gray">
                <p>&bull;&nbsp;个人信息</p><p>未读信息(<span id="msg_num">0</span>)</p>
            </div>
            <div class="msgArea border">
                <?php if (empty($msg2)) { ?>  
                    <div id="inbox_null" class="msg_null pt-4 pb-4">您暂时没有消息</div>
                <?php } else { ?>
                    <?php foreach ($msg2 as $key => $value) { ?>
                    <div id="datali_84326" class="msgItem">
                        <a href="/?r=mobile/news/one-new&mid=<?= $value['msg_id'] ?>&code=2">
                            <div class="msg_title">
                                <span id="subject">
                                    <p class="msg_text"  title="详细内容" ><?= $value['msg_title'] ?></p>
                                </span>
                            </div>
                            <span id="islook" class="msg_st"><?= $value['islook'] ?></span>
                        </a>
                        <!-- <div class="msg_cnt">
                            <div class="msg_date" id="date_s" style="width: 240px"><?= $value['msg_time'] ?></div>
                        </div> -->
                    </div> 
                <?php }  } ?>  
            </div>
        </div>
        <div class="inside">
            <div class="msgArea border_gray">
                <p>&bull;&nbsp;站内信息</p>
            </div>
            <div class="msgArea border">
            <?php if(empty($msg)){?>
                <div id="inbox_null" class="msg_null pt-4 pb-4">您暂时没有消息</div>
            <?php }else{ foreach ($msg as $key => $value) { ?>
                <div class="msg_row" id="datali_84326">
                    <a  href="/?r=mobile/news/one-new&mid=<?= $value['id'] ?>&code=1">
                        <div class="msg_title" style=" width:35%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                            <span id="subject">
                                <p title="详细内容" ><?= $value['content'] ?></p>
                            </span>
                        </div>
                        <div class="msg_cnt">
                            <div class="msg_date" id="date_s" style="width: 230px"><?= $value['create_date'] ?></div>
                        </div>
                    </a>
                </div>                 
            <?php } } ?> 
            </div>
        </div>
    </div>
</main>