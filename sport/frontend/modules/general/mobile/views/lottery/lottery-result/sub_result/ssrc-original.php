<?php 
use yii\helpers\Html;
use app\modules\lottery\modules\lzpk10\util\BallUtil;
?>
<main>
    <input id="lotteryName" type="hidden" name="" value="极速赛车">
    <input id="lotteryResult" type="hidden" value="result_page">
    <ul class="label pl-4 pr-4 pt-4 pb-2">
        <li class="d-flex justify-content-between align-items-center pb-3">
            <div class="number">第<span id="numbers"></span>期</div>
            <div class="periods"><span id="openPeriods"></span><span id="leftPeriods"></span></div>
        </li>
        <li class="pb-3">
            <div id="autoinfo" class="autoinfo d-flex mb-2">
                <ul id="autoinfo_result" class="d-flex flex-wrap"></ul>
            </div>
            <div class="lottery-result d-flex justify-content-between mt-1">
                <!-- <a href="" class="resuleVideo">
                    <div class="icon"><img src="/public/aomen/images/member/icon-video.png" alt=""></div>
                    <p>视频</p>
                </a> -->
                <div class="resuleVideo">
                    <div class="icon"><img src="/public/aomen/images/member/icon-video.png" alt=""></div>
                    <p>视频</p>
                </div>
                <div class="resultTime">距下期开奖仅有:&nbsp;<span id="resultOpenTime"></span></div>
            </div>
        </li>
    </ul>
    <!-- 開獎影片 -->
    <div class="iframe-wrapper" style="pointer-events: auto; opacity: 0; top: -300px;">
        <div class="iframe-wrapper-header">
            <div class="heading2">极速赛车 开奖视频</div>
            <div class="btn">
                <button id="close_kj_video" class="btn-no_style">关闭</button>
            </div>
        </div>
        <!-- <iframe src="/public/lottery_result/ssrc/kj_video.html"></iframe> -->
        <iframe src="/public/video/ssrc/index.html"></iframe>
    </div>
    <script>
        $(function () {
            // 視頻標題
            var lotteryName = $('#lotteryName').val(); 
            $('.iframe-wrapper-header .heading2').html(lotteryName + ' 开奖视频');

            // 收合視頻
            $('.resuleVideo').click(function(e) {
                $('.iframe-wrapper').css({
                    'pointer-events': 'auto',
                    'opacity': 1,
                    'top': 92
                })
            })
            $("#close_kj_video").on("click", function () {
                $('.iframe-wrapper').css({
                    'pointer-events': 'none',
                    'opacity': 0,
                    'top': -300
                })
            });
        })
    </script>
    <!-- 開獎影片 End -->
    <div class="content pb-2">
        <section class="tabArea pt-4 pl-4 pr-4 pb-2">
            <ul id="tab" class="tab d-flex flex-wrap justify-content-between">
                <li class="item mb-2 act"><a id='number' onclick="result_type_select(this);"><div class="itemInner">号码</div></a></li>
                <li class="item mb-2"><a id="bs" onclick="result_type_select(this);"><div class="itemInner"> 大小</div></a></li>
                <li class="item mb-2"><a id="so1" onclick="result_type_select(this);"><div class="itemInner">单双</div> </a></li>
                <li class="item mb-2"><a id="sum" onclick="result_type_select(this);"><div class="itemInner">总和</div> </a></li>
                <li class="item mb-2"><a id="so2" onclick="result_type_select(this);"><div class="itemInner">龙虎</div> </a></li>
            </ul>
        </section>
        <table  id="result_table" class="MMain text-center mt-5 mb-4">
            <thead>
                <tr>
                    <th id='th_time' width="13%">时间</th>
                    <th id='th_quishu' width="14%">期数</th>
                    <th id='th_number'>号码</th>
                    <th id='th_bs'>大小</th>
                    <th id='th_so1'>单双</th>
                    <th id='th_sum'>总和</th>
                    <th id='th_so2'>龙虎</th>
                </tr>
            </thead>
                <?php
                 $ballutil=new BallUtil();
                 $hasRow = "false";
                 foreach($rslist as $key=>$rows){
                     $hasRow = "true";
                     $color = "#FFFFFF";
                     $over	 = "#EBEBEB";
                     $out	 = "#ffffff";
                     $hm 		= array();
                     $hm[]		= $ballutil->BuLing($rows['ball_1']);
                     $hm[]		= $ballutil->BuLing($rows['ball_2']);
                     $hm[]		= $ballutil->BuLing($rows['ball_3']);
                     $hm[]		= $ballutil->BuLing($rows['ball_4']);
                     $hm[]		= $ballutil->BuLing($rows['ball_5']);
                     $hm[]		= $ballutil->BuLing($rows['ball_6']);
                     $hm[]		= $ballutil->BuLing($rows['ball_7']);
                     $hm[]		= $ballutil->BuLing($rows['ball_8']);
                     $hm[]		= $ballutil->BuLing($rows['ball_9']);
                     $hm[]		= $ballutil->BuLing($rows['ball_10']);
                    ?>
            <tbody>
                <tr>
                    <td name="time">
                        <?=date('H:i',strtotime($rows['datetime']))?>
                    </td>
                    <td name="quishu">
                        <?=substr($rows['qishu'], -50)?><?php //-50 = 从后往前取50個字?>
                    </td>
                    <!-- 号码 -->
                    <td class="d-flex flex-wrap sub_number" name='sub_number'>
                        <span class="ballResult ball_num"><?=$rows['ball_1']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_2']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_3']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_4']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_5']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_6']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_7']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_8']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_9']?></span>
                        <span class="ballResult ball_num"><?=$rows['ball_10']?></span>
                    </td>
                    <!-- 大小 -->
                    <td class="d-flex flex-wrap sub_number" name='sub_bs'>
                        <span class="ballResult ball_<?=$rows['ball_1']> 5?'b':'s' ?>"><?=$rows['ball_1']> 5?'大':'小' ?></span>
                        <span class="ballResult ball_<?=$rows['ball_2']> 5?'b':'s'?>"><?=$rows['ball_2']> 5?'大':'小'?></span>
                        <span class="ballResult ball_<?=$rows['ball_3']> 5?'b':'s'?>"><?=$rows['ball_3']> 5?'大':'小'?></span>
                        <span class="ballResult ball_<?=$rows['ball_4']> 5?'b':'s'?>"><?=$rows['ball_4']> 5?'大':'小'?></span>
                        <span class="ballResult ball_<?=$rows['ball_5']> 5?'b':'s'?>"><?=$rows['ball_5']> 5?'大':'小'?></span>
                        <span class="ballResult ball_<?=$rows['ball_6']> 5?'b':'s'?>"><?=$rows['ball_6']> 5?'大':'小'?></span>
                        <span class="ballResult ball_<?=$rows['ball_7']> 5?'b':'s'?>"><?=$rows['ball_7']> 5?'大':'小'?></span>
                        <span class="ballResult ball_<?=$rows['ball_8']> 5?'b':'s'?>"><?=$rows['ball_8']> 5?'大':'小'?></span>
                        <span class="ballResult ball_<?=$rows['ball_9']> 5?'b':'s'?>"><?=$rows['ball_9']> 5?'大':'小'?></span>
                        <span class="ballResult ball_<?=$rows['ball_10']> 5?'b':'s'?>"><?=$rows['ball_10']> 5?'大':'小'?></span>
                    </td>
                    <!-- 单双数 -->
                    <td class="d-flex flex-wrap sub_number" name='sub_so1'>
                        <span class="ballResult ball_<?=$rows['ball_1']%2 === 0 ?'e':'o' ?>"><?=$rows['ball_1']%2 === 0 ?'双':'单' ?></span>
                        <span class="ballResult ball_<?=$rows['ball_2']%2 === 0 ?'e':'o'?>"><?=$rows['ball_2']%2 === 0 ?'双':'单'?></span>
                        <span class="ballResult ball_<?=$rows['ball_3']%2 === 0 ?'e':'o'?>"><?=$rows['ball_3']%2 === 0 ?'双':'单'?></span>
                        <span class="ballResult ball_<?=$rows['ball_4']%2 === 0 ?'e':'o'?>"><?=$rows['ball_4']%2 === 0 ?'双':'单'?></span>
                        <span class="ballResult ball_<?=$rows['ball_5']%2 === 0 ?'e':'o'?>"><?=$rows['ball_5']%2 === 0 ?'双':'单'?></span>
                        <span class="ballResult ball_<?=$rows['ball_6']%2 === 0 ?'e':'o'?>"><?=$rows['ball_6']%2 === 0 ?'双':'单'?></span>
                        <span class="ballResult ball_<?=$rows['ball_7']%2 === 0 ?'e':'o'?>"><?=$rows['ball_7']%2 === 0 ?'双':'单'?></span>
                        <span class="ballResult ball_<?=$rows['ball_8']%2 === 0 ?'e':'o'?>"><?=$rows['ball_8']%2 === 0 ?'双':'单'?></span>
                        <span class="ballResult ball_<?=$rows['ball_9']%2 === 0 ?'e':'o'?>"><?=$rows['ball_9']%2 === 0 ?'双':'单'?></span>
                        <span class="ballResult ball_<?=$rows['ball_10']%2 === 0 ?'e':'o'?>"><?=$rows['ball_10']%2 === 0 ?'双':'单'?></span>
                    </td>
                    <!-- 总和 -->
                    <td class="sub_number" name='sub_sum'>
                        <?php if($ballutil->Pk10_Auto_quick($hm,1)==11){ ?>   
                            <?=$ballutil->Pk10_Auto_quick($hm,1)?> / <span>和</span> / <span>和</span> 
                            <?php }else{?>
                        <?= $ballutil->Pk10_Auto_quick($hm,1)?> / <?=($ballutil->Pk10_Auto_quick($hm,2)=="大"?"<span style=\"color: red;\">".$ballutil->Pk10_Auto_quick($hm,2)."</span>":$ballutil->Pk10_Auto_quick($hm,2))?> / <?=($ballutil->Pk10_Auto_quick($hm,3)=="双"?"<span style=\"color: red;\">".$ballutil->Pk10_Auto_quick($hm,3)."</span>":$ballutil->Pk10_Auto_quick($hm,3))?>
                        <?php }?>
                    </td>
                    <!-- 龙虎 -->
                    <td class="sub_number" name='sub_so2'>
                        <?=($ballutil->Pk10_Auto_quick($hm,4)=="龙"?"<span style=\"color: red;\">".$ballutil->Pk10_Auto_quick($hm,4)."</span>":$ballutil->Pk10_Auto_quick($hm,4))?> / <?=($ballutil->Pk10_Auto_quick($hm,5)=="龙"?"<span style=\"color: red;\">".$ballutil->Pk10_Auto_quick($hm,5)."</span>":$ballutil->Pk10_Auto_quick($hm,5))?> / <?=($ballutil->Pk10_Auto_quick($hm,6)=="龙"?"<span style=\"color: red;\">".$ballutil->Pk10_Auto_quick($hm,6)."</span>":$ballutil->Pk10_Auto_quick($hm,6))?> / <?=($ballutil->Pk10_Auto_quick($hm,7)=="龙"?"<span style=\"color: red;\">".$ballutil->Pk10_Auto_quick($hm,7)."</span>":$ballutil->Pk10_Auto_quick($hm,7))?> / <?=($ballutil->Pk10_Auto_quick($hm,8)=="龙"?"<span style=\"color: red;\">".$ballutil->Pk10_Auto_quick($hm,8)."</span>":$ballutil->Pk10_Auto_quick($hm,8))?> 
                    </td>
                  
                </tr>
            </tbody>
                <?php }?>
        </table>
        <?php if($hasRow=="false"){ ?>
        <span  class="drawnull"> <label>暂时没有开奖结果</label></span> 
        <?php }?>
    </div>
</main>
<script type="text/javascript" src="/public/aomen/lottery/js/ssrc.js"></script>

