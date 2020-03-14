<div>
    <div class="Mar"><marquee scrollamount="2" scrolldelay="20"><?=$newestAnnouncement?></marquee></div>
    <p></p>
    <div class="round-table">
        <table id="table5">
            <tr class="title_tr">
                <td colspan="2">历史讯息</td>
            </tr>
            <tr class="test" style="text-align: center; background-color: #ccc">
                <td width="160px">日期</td>
                <td>讯息</td>
            </tr>
            <?php foreach ($announcementArray as $announcement){?>
            <tr>
                <td style="text-align: left;"><?=$announcement['create_date']?></td>
                <td style="text-align: left;"><?=$announcement['content']?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>