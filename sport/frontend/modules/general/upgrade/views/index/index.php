<?php

?>
<div class="pro_title font14">应用升级</div>
<table width="100%"  cellpadding="5" cellspacing="1" class="font12 skintable line35">
    <tr>
        <td><strong>当前版本号</strong></td>
        <td><strong>最新版本号</strong></td>
        <td width="250px"><strong>操作</strong></td>
    </tr>
    <tr>
        <td><?=$version?></td>
        <td><?=$updateVersion?></td>
        <td>
            <div id="progressBar" class="progress" style="margin: 0 10px 0 10px;">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    升级中
                </div>
            </div>
            <button id="upgradeBtn" class="btn btn-xs btn-primary" <?php if(!$update) {echo 'disabled';} ?>> 升 级 </button>
        </td>
    </tr>
</table>
<script>
    $(function () {
        $('#progressBar').hide();
       $('#upgradeBtn').click(function () {
           $.dialog.confirm('是否确定升级到最新版本？', function (data) {
               if(data) {
                   $('#upgradeBtn').hide();
                   $('#progressBar').show();
                   $.ajax({
                        url:'?r=upgrade/index/update',
                       dataType:'json',
                       success:function (data) {
                            $.dialog.notify(data.msg, function () {
                                location.href = '/#/upgrade/index/index&t=' + new Date().getTime();
                            })
                       },
                       error:function () {
                           $.dialog.notify('请求失败');
                       }
                   });
               }
           })
       });
    });
</script>