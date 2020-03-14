<style>
.content_frame{
    position: relative;
    height: 0;
    padding-bottom: 90vh;
}
#frame{
    position: absolute;
    width: 98%;
    height: 100%;
    padding: 0 1%;
}
</style>
<main>
    <input id="lotteryName" type="hidden" name="" value="极速赛车">
    <input id="lotteryResult" type="hidden" value="result_page">
    <div class="content_frame">
        <iframe id="frame" src="/public/lottery_result/ssrc/index.html" width="100%" height="100%" frameborder="0" scrolling="yes"></iframe>
    </div>
</main>
<script type="text/javascript" src="/public/aomen/lottery/js/ssrc.js"></script>

