<link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css">
<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="content">
        <form method="post" action="/?r=event/result/modify-result">
            <input type="hidden" name="official_id" value="<?= $data['id']?>">
            <h2>
                <b></b>
                <span style="color: white">赛事 - <?= $data['title'] ?> 开奖设置</span>
            </h2>
            <div id="content_inner">
                <div>
                    <div id="wager_groups" class="CQ">
                    </div>
                </div>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="N1"><b>两方比赛队伍得分</b></span></li>
                </ul>
            </div>
            <div id="game">

                    <div class="round-table">
                        <table class="GameTable">
                            <tr class="title_line">
                                <td style="width:30px"><label>图片</label></td>
                                <td style="width:30px"><label>姓名</label></td>
                                <td style="width:30px"><label>得分</label></td>
                            </tr>
                        <?php
                            foreach ($player as $key => $val) {
                        ?>
                                <tr class="title_line" id="here<?= $val['id'] ?>">
                                    <td>
                                        <img src="timthumb.php?src=<?= $val['img_url'] ?>&w=150&h=150&zc=1">
                                    </td>
                                    <td>
                                        <?= $val['title'] ?>
                                    </td>
                                    <td class="odds">
                                        <input type="number" name="<?= $val['id'] ?>-player_score" id="<?= $val['id'] ?>-player_score" value="" onchange="if(/\D/.test(this.value)){alert('得分只能输入数字');this.value='';}" required>
                                    </td>


                                </tr>
                        <?php
                            }
                        ?>
                        </table>
                    </div>

            </div>
        <?php
            foreach ($multiple as $key => $val) {
        ?>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="N1"><b>赛事 - <?= $data['title'] ?> : 多項目 - <?= $val['title'] ?></b></span></li>
                </ul>
            </div>
            <div id="game">

                    <div class="round-table">
                        <table class="GameTable">
                            <tr class="title_line">
                                <td style="width:30px"><label>項目</label></td>
                                <td style="width:30px"><label>中獎</label></td>
                            </tr>

                                <?php
                                    foreach ($multiple[$key]['items'] as $key2 => $val2) {
                                ?>
                                <tr class="title_line">
                                    <td>
                                        <?= $val2['title'] ?>
                                    </td>
                                    <td>
                                        <input type="radio" name='<?= $val['id'] ?>-multiple' value="<?= $val2['id'] ?>" required>
                                    </td>

                                </tr>
                                <?php
                                    }
                                ?>
                        </table>
                    </div>
                </div>
            <?php
            }
            ?>

                <div id="SendB5">
                    <button type="submit" class="order">送出</button>
                    <button type="button" class="order" onclick="javascript:location.href='#/event/result'">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>
