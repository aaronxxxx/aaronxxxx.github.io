<html>

<head>
    <title>在线存款</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<script language="javascript" type="text/javascript">
    function showFrame() {
        document.getElementById('aaa').style.display = 'block';
    }
</script>

<body>
    <div id="MACenterContent">
        <div class="MNav">
            <a href="/?r=member/live/index" class="mbtn">额度转换</a>
            <span class="mbtn active">线上存款</span>
            <a href="/?r=member/remittance/index" class="mbtn">银行汇款</a>
            <a href="/?r=member/remittance/index2" class="mbtn">其他支付</a>
            <a href="/?r=member/withdraw/index" class="mbtn">线上取款</a>
        </div>
        <div id="MMainData" class="pay_cont">
            <div class="title_box">
                <h1>请选择存款方式</h1>
                <p>通过第三方支付平台进行存款</p>
            </div>
            <div class="cont_box">
                <ul class="pay_btn_box">
                    <?php
                    foreach ($urlarr as $k => $val) { ?>
                        <li>
                            <a href="<?= $val['payurl'] ?>" class="d-btn <?php echo $color[$k]; ?>"><span class="icon"> </span><?= $val['pay_name'] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div id="aaa" style=" display: none;">
            <iframe id="chongzhiFrame" name="chongzhiFrame" frameborder="0" scrolling="no" width="100%" allowtransparency="true" height="350"></iframe>
        </div>
    </div>
</body>
<script>
    $('#MACenter').attr('data-current', 'online_in');
</script>

</html>