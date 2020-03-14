<div class="container pk-mode" data-type="pk-mode">
    <div class="main-title col-12">
        <h2 class="heading2">单笔投注</h2>
    </div>
    <div class="lists col-12">
        <ul id="pkGroup" class="lists-group col-12 list-unstyled p-0">
        </ul>
    </div>
</div>
<div class="container multi-mode" data-type="multi-mode">
    <div class="main-title col-12">
        <h2 class="heading2">混合投注</h2>
    </div>
    <div class="lists col-12">
        <ul id="multiGroup" class="lists-group col-12 list-unstyled p-0">
        </ul>
    </div>
</div>
<!-- 項目格式 -->
<div id="thisIsCopyUse" style="display : none !important;">
    <!-- Pk -->
    <li class="media col-12 pkClone">
        <div class="media-header">
            <div class="title col-12 d-flex align-items-center justify-content-between px-0">
                <div>
                    <h3 data-id="vs" class="heading3"></h3>
                    <h4 data-id="project" class="media-rangfen"></h4>
                </div>
                <p class="pkid">编号:<span></span></p>
            </div>
        </div>
        <div class="media-body col-12">
            <div class="d-flex">
                <div class="figure-group col d-flex">
                    <figure class="figure d-flex flex-column">
                        <div class="pic imgLiquidFill" data-imgLiquid-horizontalAlign="50%" data-imgLiquid-verticalAlign="50%">
                            <img data-id="pk_img1" draggable="false" src="" alt="">
                        </div>
                        <figcaption class="pk_name1"></figcaption>
                    </figure>
                    <div class="card col d-flex flex-column">
                        <div class="card-header col-auto d-flex justify-content-between">
                            <h4 class="heading4 pk_name1"></h4>
                            <div data-id="pk_peilu1" class="odds"></div>
                        </div>
                        <div class="card-body">
                            <p data-id="pk_jieshao1"></p>
                        </div>
                        <div class="card-footer col-auto">
                            <div class="tools col-12">
                                <div class="col" data-icon="pk1">
                                    <a class="btn disble_a" href="javascript:;" onclick=""><img draggable="false" src="/themes/saiban/assets/images/sport/icon006.png" alt=""></a>
                                    <a class="btn disble_a" href="javascript:;" onclick=""><img draggable="false" src="/themes/saiban/assets/images/sport/icon007.png" alt=""></a>
                                    <a class="btn disble_a" href="javascript:;" onclick=""><img draggable="false" src="/themes/saiban/assets/images/sport/icon008.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn order-btn button bet_left" data-button="layer"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center justify-content-center">
                    <div class="comity-body">
                        <div class="rangfen-img">
                            <div class="d-flex justify-content-between"><img src="/themes/saiban/assets/images/sport/arrow.png" alt="" /></div>
                        </div>
                        <div class="rangfen-num d-flex align-items-center justify-content-center">
                            <span>让</span><span class="red"><strong data-id="rangfen"></strong></span><span>票</span>
                        </div>
                    </div>
                </div>
                <div class="figure-group col d-flex">
                    <figure class="figure d-flex flex-column">
                        <div class="pic imgLiquidFill" data-imgLiquid-horizontalAlign="50%" data-imgLiquid-verticalAlign="50%">
                            <img data-id="pk_img2" draggable="false" src="" alt="">
                        </div>
                        <figcaption class="pk_name2"></figcaption>
                    </figure>
                    <div class="card col d-flex flex-column">
                        <div class="card-header col-auto d-flex justify-content-between">
                            <h4 class="heading4 pk_name2"></h4>
                            <div data-id="pk_peilu2" class="odds"></div>
                        </div>
                        <div class="card-body">
                            <p data-id="pk_jieshao2"></p>
                        </div>
                        <div class="card-footer col-auto">
                            <div class="tools col-12">
                                <div class="col" data-icon="pk2">
                                    <a class="btn disble_a" href="javascript:;" onclick=""><img draggable="false" src="/themes/saiban/assets/images/sport/icon006.png" alt=""></a>
                                    <a class="btn disble_a" href="javascript:;" onclick=""><img draggable="false" src="/themes/saiban/assets/images/sport/icon007.png" alt=""></a>
                                    <a class="btn disble_a" href="javascript:;" onclick=""><img draggable="false" src="/themes/saiban/assets/images/sport/icon008.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn order-btn button bet_right" data-button="layer"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <!-- Multi -->
    <li class="media col-12 multiClone">
        <div class="media-header color-dark" style="background-image:url(/themes/saiban/assets/images/sport/tittle_bg.png)">
            <div class="title col-12 px-0">
                <h3 data-id="title" class="heading3"></h3>
                <p class="pkid">编号:<span></span></p>
            </div>
        </div>
        <div class="media-body col-12">
            <div class="row">
                <div class="figure-group col-12">
                    <div class="d-flex align-items-center">
                        <div class="col-6">
                            <p data-id="item"></p>
                        </div>
                        <div class="col-3">
                            <p>
                                <label>赔率:</label>
                                <span class="red odds" data-id="item-peilu"></span>
                            </p>
                        </div>
                        <div class="col-3 p-0">
                            <button type="button" class="btn order-btn button multi_btn" data-button="layer"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <!-- 投注彈窗 -->
    <div class="betting_list">
        <div class="betting_list_head">
            <h2>投注清单</h2>
        </div>
        <div class="betting_list_container">
            <div class="betting_list_content">
                <div class="betting_list_single">
                    <ul class="betting_ul">
                        <li class="betting_list_single_project">
                            <div class="betting_list_banner">
                                <div class="detail">
                                    <div class="banner">
                                        <div class="people-container">
                                            <div class="left_people people">
                                                <div class="pic" data-id="img1"></div>
                                                <p data-id="name1"></p>
                                            </div>
                                            <div class="right_people people">
                                                <div class="pic" data-id="img2"></div>
                                                <p data-id="name2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="betting_list_body">
                                <div class="betting_list_data">
                                    <ul>
                                        <li><label>赛事:</label><span data-id="vs"></span></li>
                                        <li><label>让票:</label><span data-id="rangfen"></span></li>
                                        <li><label>编号:</label><span data-id="pkid"></span></li>
                                        <li><label>項目:</label><span data-id="choice"></span></li>
                                        <li><label>赔率:</label><span data-id="odds" class="red"></span></li>
                                    </ul>
                                </div>
                                <div class="betting_list_money">
                                    <ul class="list_money_box">
                                        <li class="list_money_input">
                                            <input type="tel" name="betting_dollars" placeholder="输入金额" onkeyup="this.value = this.value.replace(/[^0-9\.-]/g, '');"><span class="currency">(USD)</span>
                                        </li>
                                        <li class="list_money_display">
                                            <label>获益预估:</label><span><span class="betting_money" class="red">0.0</span><span class="currency">(USD)</span></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="betting_list_text">
                                <textarea type="text" placeholder="备注" class="betting_list_textarea"></textarea>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="betting_list_footer">
                <div class="list_btnbox">
                    <button type="button" class="cancel_btn" data-button="layer-close">取消</button>
                    <button type="button" class="confirm_btn" data-button="submit" data-button-id="">确认投注</button>
                </div>
            </div>
        </div>
    </div>
</div>