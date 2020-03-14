<?php 
use yii\helpers\Html;
use app\modules\lottery\modules\lzcqssc\util\BallUtil;
?>
<main>
    <input id="lotteryName" type="hidden" name="" value="<?=$lottery_name?>">
    <ul class="label pl-4 pr-4 pt-4 pb-2">
        <li class="d-flex justify-content-between align-items-center pb-3">
            <div class="number">第<span id="numbers"></span>期</div>
            <div class="periods"><span id="openPeriods"></span><span id="leftPeriods"></span></div>
        </li>
        <li class="pb-3">
            <div id="autoinfo" class="autoinfo d-flex">
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
    <div class="iframe-wrapper" style="pointer-events: none; opacity: 0; top: -300px;">
        <div class="iframe-wrapper-header">
            <div class="heading2">幸运飞艇 开奖视频</div>
            <div class="btn">
                <button id="close_kj_video" class="btn-no_style">关闭</button>
            </div>
        </div>
        <!-- <iframe src="/public/lottery_result/mlaft/kj_video.html"></iframe> -->
        <iframe src="/public/video/<?=$type_lottery?>/index.html"></iframe>
    </div>
    <style>
        input[value="腾讯分分彩"] ~ .label .lottery-result .resuleVideo {
            visibility: hidden;
            pointer-events: none;
        }
    </style>
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
                    'top': 94
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
            <ul id="tab" class="tab d-flex flex-wrap justify-content-center">
                <li class="item mb-2 mr-2 act"><a id='number' onclick="result_type_select(this);"><div class="itemInner">号码</div></a></li>
                <li class="item mb-2 mr-2"><a id="so1" onclick="result_type_select(this);"><div class="itemInner">前三</div> </a></li>
                <li class="item mb-2 mr-2"><a id="so2" onclick="result_type_select(this);"><div class="itemInner">牛牛</div> </a></li>
                <li class="item mb-2"><a id="sum" onclick="result_type_select(this);"><div class="itemInner">总和</div> </a></li>
            </ul>
        </section>
        <table  id="result_table" class="MMain text-center mt-5 mb-4">
            <thead>
                <tr>
                    <th id='th_time'>时间</th>
                    <th id='th_quishu'>期数</th>
                    <th id='th_number'>号码</th>
                    <!-- <th id='th_bs'>大小</th>
                    <th id='th_ud'>上下</th> -->
                    <th id='th_so1'>前三</th>
                    <th id='th_so2'>牛牛</th>
                    <th id='th_sum'>总和</th>
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
                        $niuniu = $ballutil->b5_niuniu($rows['ball_1'],$rows['ball_2'],$rows['ball_3'],$rows['ball_4'],$rows['ball_5']);
                    ?>
            <tbody>
                <tr>
                    <td name="time">
                        <?=date('H:i',strtotime($rows['datetime']))?>
                    </td>
                    <td name="quishu">
                        <?=substr($rows['qishu'], -50)?><?php //-50 = 从后往前取50個字?>
                    </td>
                    <td class="d-flex justify-content-center sub_number" name='sub_number'>
                        <span class="ballResult ball_b"><?=$rows['ball_1']?></span>
                        <span class="ballResult ball_b"><?=$rows['ball_2']?></span>
                        <span class="ballResult ball_b"><?=$rows['ball_3']?></span>
                        <span class="ballResult ball_b"><?=$rows['ball_4']?></span>
                        <span class="ballResult ball_b"><?=$rows['ball_5']?></span>
                    </td>
                    <!-- <td class="sub_number" name='sub_bs'>
                    </td>
                    <td class="sub_number" name='sub_ud'>
                    </td> -->
                    <td class="sub_number" name='sub_so1'>
                        <?=$ballutil->Ssc_Auto($hm,5)?> / <?=$ballutil->Ssc_Auto($hm,6)?> / <?=$ballutil->Ssc_Auto($hm,7)?>
                    </td>
                    <td class="sub_number" name='sub_so2'>
                        <?=$niuniu?> / <?=($ballutil->b5_niuds($niuniu)=="牛双"?"<span style=\"color: red;\">".$ballutil->b5_niuds($niuniu)."</span>":$ballutil->b5_niuds($niuniu))?> / <?=($ballutil->b5_niudx($niuniu)=="牛大"?"<span style=\"color: red;\">".$ballutil->b5_niudx($niuniu)."</span>":$ballutil->b5_niudx($niuniu))?>
                    </td>
                    <td class="sub_number" name='sub_sum'>
                        <?=$ballutil->Ssc_Auto($hm,1)?> / <?=($ballutil->Ssc_Auto($hm,2)=="总和大"?"<span style=\"color: red;\">".$ballutil->Ssc_Auto($hm,2)."</span>":$ballutil->Ssc_Auto($hm,2))?> / <?=($ballutil->Ssc_Auto($hm,3)=="总和双"?"<span style=\"color: red;\">".$ballutil->Ssc_Auto($hm,3)."</span>":$ballutil->Ssc_Auto($hm,3))?> / <?=($ballutil->Ssc_Auto($hm,4)=="龙"?"<span style=\"color: red;\">".$ballutil->Ssc_Auto($hm,4)."</span>":$ballutil->Ssc_Auto($hm,4))?>
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
<script type="text/javascript" src="/public/aomen/lottery/js/<?=$type_lottery?>.js"></script>
