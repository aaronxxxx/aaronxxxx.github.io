<link href="/public/aomen/css/ftbk.css?1576663200" rel="stylesheet" />
<link href="/public/aomen/css/swiper4.min.css" rel="stylesheet" />
<main class="ftbk">
    <div class="ftbk_banner">
        <img src="/public/aomen/images/index/banner-event.jpg" alt="">
    </div>
    <ul class="ftbk_nav d-flex justify-content-around align-items-center">
        <li class="btn_next d-flex justify-content-center align-items-center">
            <span>单笔投注</span>
        </li>
        <li class="btn_prev d-flex justify-content-center align-items-center">
            <span>混合投注</span>
        </li>
    </ul>
    <div class="ftbk_container swiper-container">
        <div class="swiper-wrapper">
            <div id="pkSwiper" class="swiper-slide"></div>
            <div id="multiSwiper" class="swiper-slide"></div>
        </div>
    </div>
</main>
<!-- 項目格式 -->
<input type="hidden" name="qishu" id="qishu" value="<?= $qishu ?>">
<div id="mobileCopyUse" style="display : none !important;">
    <div class="ftbk_Pkcard">
        <!-- Pk -->
        <div class="ftbk_header d-flex justify-content-between align-items-center flex-wrap">
            <h3 data-id="vs"></h3>
            <span data-id="no"></span>
            <div data-id="rangfen"></div>
        </div>
        <ul class="ftbk_card_body">
            <li class="avatar">
                <img src="/themes/saiban/assets/images/sport/dog01.png" alt="" data-id="avatar1">
                <img src="/themes/saiban/assets/images/sport/arrow.png" alt="" data-id="arrow">
                <img src="/themes/saiban/assets/images/sport/cat01.png" alt="" data-id="avatar2">
            </li>
            <li class="name">
                <span data-id="name1"></span>
                <div></div>
                <span data-id="name2"></span>
            </li>
            <li class="odds">
                <span data-id="odds1"></span>
                <div>赔率</div>
                <span data-id="odds2"></span>
            </li>
            <li class="bet_btn">
                <button href="javascript:;" data-id="bet" data-button="left">下单</button>
                <div></div>
                <button href="javascript:;" data-id="bet" data-button="right">下单</button>
            </li>
            <li class="item">
                <div class="d-flex align-items-center" data-icon="pk1">
                    <a class="btn" href="javascript:;" onclick=""><img src="/public/aomen/images/index/anal04.png" alt=""></a>
                    <a class="btn" href="javascript:;" onclick=""><img src="/public/aomen/images/index/anal05.png" alt=""></a>
                    <a class="btn" href="javascript:;" onclick=""><img src="/public/aomen/images/index/anal06.png" alt=""></a>
                </div>
                <div></div>
                <div class="d-flex align-items-center" data-icon="pk2">
                    <a class="btn" href="javascript:;" onclick=""><img src="/public/aomen/images/index/anal04.png" alt=""></a>
                    <a class="btn" href="javascript:;" onclick=""><img src="/public/aomen/images/index/anal05.png" alt=""></a>
                    <a class="btn" href="javascript:;" onclick=""><img src="/public/aomen/images/index/anal06.png" alt=""></a>
                </div>
            </li>
        </ul>
    </div>
    <!-- Multi -->
    <div class="ftbk_Multicard">
        <div class="ftbk_header d-flex justify-content-between align-items-center flex-wrap">
            <h3 data-id="title"></h3>
            <span data-id="no"></span>
        </div>
        <div class="ftbk_card_body">
            <div class="row">
                <ul class="figure-group">
                    <li><span data-id="item"></span></li>
                    <li><span>赔率</span></li>
                    <li><span data-id="item-peilu"></span></li>
                    <li><button href="javascript:;" data-id="bet" data-button="multi">下单</button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mb_betting_list">
        <header class="mb_header">
            <nav class="d-flex justify-content-between align-items-stretch">
                <div class="logo d-flex justify-content-start align-items-center">
                    <div class="backBtn d-flex flex-flow-column justify-content-center align-items-center h-100" onclick="window.history.back()">
                        <img src="/public/aomen/images/log/header-back.png" alt="上一页" srcset="">
                        <span>回上页</span>
                    </div>
                    <a href="/?r=mobile/disp/ftbk-history" class="listBtn d-flex flex-flow-column justify-content-center align-items-center" style="color:#c29c51;margin-left:10px;">
                        <img src="/public/aomen/images/index/record.png">
                        <span>投注记录</span>
                    </a>
                </div>
                <ul class="d-flex flex-flow-column  justify-content-center align-items-stretch usernameinfo" id="user">
                    <li class="d-flex justify-content-start align-items-center logined">
                        <div class="userNavicon"><img src="/public/aomen/images/index/header-man.png" alt=""></div>
                        <p id="betName"></p>
                    </li>
                    <li class="d-flex justify-content-start align-items-center logined">
                        <div class="userNavicon"><img src="/public/aomen/images/index/header-money.png" alt=""></div>
                        <p id="betMoney"></p>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="mb_bet">
            <div class="bet_header d-flex flex-flow-column justify-content-center align-items-center">
                <h3>下单投注</h3>
                <h4 class="rangfen"></h4>
            </div>
            <ul class="bet_list d-flex flex-flow-column justify-content-between align-items-start">
                <li class="d-flex justify-content-center align-items-center">
                    <span>赛事编号</span>
                    <span data-id="no"></span>
                </li>
                <li class="d-flex justify-content-center align-items-center">
                    <span>类型</span>
                    <span data-id="type"></span>
                </li>
                <li class="d-flex justify-content-center align-items-center">
                    <span>项目</span>
                    <span class="rangfen"></span>
                </li>
                <li class="d-flex justify-content-center align-items-center">
                    <span>赛事</span>
                    <span data-id="vs"></span>
                </li>
                <li class="d-flex justify-content-center align-items-center">
                    <span>赔率</span>
                    <span data-id="odds"></span>
                </li>
            </ul>
            <div class="bet_text d-flex flex-flow-column justify-content-center align-items-center">
                <label>投注金额：</label>
                <input type="tel" class="bet_text_input" name="" placeholder="输入金额" data-id="money" onkeyup="this.value = this.value.replace(/[^0-9\.-]/g, '');">
                <label data-id="total">获利预估：</label>
                <textarea type="text" data-id="remarks" class="bet_text_input" name="" placeholder="添加备注..."></textarea>
            </div>
            <div class="btn_group d-flex justify-content-center align-items-center">
                <button type="button" class="btn cancel" onclick="layer.closeAll()">取消</button>
                <button type="button" class="btn confirm_btn bet" data-button="submit" data-button-id="">投注</button>
            </div>
        </div>
        <footer class="d-flex justify-content-between align-items-center">
            <section class="footerItem">
                <a href="/?r=mobile/disp/index">
                    <div class="icon"><img src="/public/aomen/images/index/footer-home.png" alt=""></div>
                    <p>首页</p>
                </a>
            </section>
            <section class="footerItem">
                <a href="/?r=mobile/financial/index">
                    <div class="icon"><img src="/public/aomen/images/index/footer-money.png" alt=""></div>
                    <p>财务中心</p>
                </a>
            </section>
            <section class="footerItem">
                <a href="/?r=mobile/user/user-hall">
                    <div class="icon"><img src="/public/aomen/images/index/footer-member.png" alt=""></div>
                    <p>会员中心</p>
                </a>
            </section>
            <section class="footerItem">
                <a href="/?r=mobile/disp/ftbk">
                    <div class="icon"> <img src="/public/aomen/images/index/footer-betting.svg" alt=""></div>
                    <p>前往投注</p>
                </a>
            </section>
        </footer>
    </div>
</div>
<script src="/public/aomen/js/swiper4.min.js"></script>
<script src="/public/aomen/js/ftbk-dist.js?1575266797"></script>