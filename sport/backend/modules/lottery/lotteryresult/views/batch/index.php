<?php
    use yii\widgets\LinkPager;
    require("public/lottery/Js_Class.php");
?>

<div class="tabft13 trinput zudan spanmg0">
    <p>
        <span>彩票类别：</span>
        <span><strong><?= $lottery_type ?></strong></span>
    </p>
    <p>
        <button type="button" class="btn btn-primary" onclick="javascript:location.href='#/lotteryresult/batch&type=<?= $lottery_type ?>&batch=10'">
            开奖10期
        </button>&nbsp;
        <button type="button" class="btn btn-primary" onclick="javascript:location.href='#/lotteryresult/batch&type=<?= $lottery_type ?>&batch=20'">
            开奖20期
        </button>&nbsp;
        <button type="button" class="btn btn-primary" onclick="javascript:location.href='#/lotteryresult/batch&type=<?= $lottery_type ?>&batch=30'">
            开奖30期
        </button>
    </p>
</div>
<form name="form1" id="form1" method="post" action="?r=lotteryresult/batch/create">
    <input type="hidden" name="lottery_type" value="<?= $lottery_type ?>">
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
        <tr class="namecolor">
            <td><strong>彩票期号</strong></td>
            <td><strong>开奖时间</strong></td>
            <?php
                foreach ($ballName as $key => $val) {
            ?>
                <td><strong><?= $val ?></strong></td>
            <?php
                }
            ?>
            <td><strong>操作</strong></td>
        </tr>
        <?php
            if (count($rows) > 0) {
                foreach ($rows as $key => $val) {
        ?>
                <tr class="zudan" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#fff'" style="background-color:rgb(255, 255, 255); line-height:20px;">
                    <td>
                        <?= $val['qishu']?>
                        <input type="hidden" name="batch[<?= $val['qishu'] ?>][qishu]" value="<?= $val['qishu'] ?>">
                    </td>
                    <td>
                        <?= $val['kaijiang_time']?>
                        <input type="hidden" name="batch[<?= $val['qishu'] ?>][kaijiang_time]" value="<?= $val['kaijiang_time'] ?>">
                    </td>
                    <?php
                        for ($j = 1; $j <= $awardBalls; $j++) {
                    ?>
                        <td>
                            <img src="<?= $ballStyle[0] . $val['ball_' . $j] ?>.png">
                            <input type="hidden" name="batch[<?= $val['qishu'] ?>][ball_<?= $j ?>]" value="<?= $val['ball_' . $j] ?>">
                        </td>
                    <?php
                        }
                    ?>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm delete_btn">
                            <i class="glyphicon glyphicon-trash icon-white"></i> 删除
                        </button>
                    </td>
                </tr>
        <?php
                }
            }
        ?>
    </table>
    <br>
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span>请输入修改密码 : <input type="password" name="superpassword"></span>
        </p>
        <p>
        <?php
            if (count($rows) > 0) {
        ?>
            <button type="submit" class="btn btn-primary">确认发布</button>
        <?php
            }
        ?>
        </p>
    </div>
</form>

<script>
$('.delete_btn').click(function () {
    $(this).parent().parent().remove();
});
</script>