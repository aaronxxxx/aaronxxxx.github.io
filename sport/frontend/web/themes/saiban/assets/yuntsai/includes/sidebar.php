<div class="sidebar-wrapper sidebar-close">
    <div class="card">
        <div class="card-time">
            <div class="time-btn d-flex justify-content-center align-items-center">
                <div class="time-top act" data-id="open">开奖时间</div>
                <div class="time-top" data-id="feng">距离封盘</div>
            </div>
            <div class="time-tab">
                <div id="open" class="time-bottom">
                    <span data-id="open-date">2020-12-25</span>
                    <hr>
                    <span data-id="open-time">15:00:00</span>
                </div>
                <div id="feng" class="time-bottom" style="display:none">
                    <span data-id="feng-date">2020-12-24</span>
                    <hr>
                    <span data-id="feng-time">23:59:59</span>
                </div>
            </div>
        </div>
        <div class="card-top">
            <a href="javascript:;" onclick="openWindow('/?r=passport/site/event-history','',982,695)" class="btn history-btn button">
                <img src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/icon005.png" alt="">下单紀錄
            </a>
        </div>
        <div class="card-bottom">
            <div class="btn-group">
                <button type="button" class="btn scrollToID button" data-target="pk-mode">
                    <i class="icon">
                        <img draggable="false" src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/icon004.png" alt="">
                    </i>
                    <span>单笔</span>
                </button>
                <button type="button" class="btn scrollToID button" data-target="multi-mode">
                    <i class="icon">
                        <img draggable="false" src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/icon004.png" alt="">
                    </i>
                    <span>混合</span>
                </button>
            </div>
        </div>
    </div>
</div>