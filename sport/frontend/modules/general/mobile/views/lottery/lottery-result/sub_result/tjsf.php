<?php 
use yii\helpers\Html;
use app\modules\lottery\modules\lzgdsf\util\BallUtil;
?>
<main>
    <input id="lotteryName" type="hidden" name="" value="天津十分彩">
    <ul class="label pl-4 pr-4 pt-4 pb-2">
        <li class="d-flex justify-content-between align-items-center pb-3">
            <div class="number">第<span id="numbers"></span>期</div>
            <div class="periods"><span id="openPeriods"></span><span id="leftPeriods"></span></div>
        </li>
        <li class="pb-3">
            <div id="autoinfo" class="autoinfo d-flex"></div>
            <div class="lottery-result d-flex justify-content-between mt-1">
                <a href="" class="resuleVideo" style="visibility: hidden;">
                    <div class="icon"><img src="/public/aomen/images/member/icon-video.png" alt=""></div>
                    <p>视频</p>
                </a>
                <div class="resultTime">距下期开奖仅有:&nbsp;<span id="resultOpenTime"></span></div>
            </div>
        </li>
    </ul>
    <div class="content pb-2 ">
        <section class="tabArea pt-4 pl-4 pr-4 pb-2">
            <ul id="tab" class="tab d-flex flex-wrap justify-content-center">
                <li class="item mb-2 mr-2 act"><a id='number' onclick="result_type_select(this);"><div class="itemInner">号码</div></a></li>
                <li class="item mb-2"><a id="sum" onclick="result_type_select(this);"><div class="itemInner">总和</div> </a></li>
            </ul>
        </section>
        <table  id="result_table" class="MMain text-center mt-5 mb-4">
            <thead>
                <tr>
                    <th id='th_time' width="13%">时间</th>
                    <th id='th_quishu' width="14%">期数</th>
                    <th id='th_number'>号码</th>
                    <!-- <th id='th_bs'>大小</th>
                    <th id='th_so1'>单双</th>
                    <th id='th_so2'>奇偶</th>
                    <th id='th_ud'>上下</th> -->
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
                  $hm[]		= $ballutil->BuLing($rows['ball_6']);
                  $hm[]		= $ballutil->BuLing($rows['ball_7']);
                  $hm[]		= $ballutil->BuLing($rows['ball_8']);
                    ?>
            <tbody>
                <tr>
                    <td name="time">
                        <?=date('H:i',strtotime($rows['datetime']))?>
                    </td>
                    <td name="quishu">
                        <?=substr($rows['qishu'], -50)?><?php //-50 = 从后往前取50個字?>
                    </td>
                    <td class="d-flex flex-wrap sub_number" name='sub_number'>
                        <span class="ballc_<?=$rows['ball_1']?>"><?=$rows['ball_1']?></span>
                        <span class="ballc_<?=$rows['ball_2']?>"><?=$rows['ball_2']?></span>
                        <span class="ballc_<?=$rows['ball_3']?>"><?=$rows['ball_3']?></span>
                        <span class="ballc_<?=$rows['ball_4']?>"><?=$rows['ball_4']?></span>
                        <span class="ballc_<?=$rows['ball_5']?>"><?=$rows['ball_5']?></span>
                        <span class="ballc_<?=$rows['ball_6']?>"><?=$rows['ball_6']?></span>
                        <span class="ballc_<?=$rows['ball_7']?>"><?=$rows['ball_7']?></span>
                        <span class="ballc_<?=$rows['ball_8']?>"><?=$rows['ball_8']?></span>
                    </td>
             
                    <td class="sub_number" name='sub_sum'>
                    <?=$ballutil->G10_Auto($hm,1)?> / <?=($ballutil->G10_Auto($hm,2)=="总和大"?"<span style=\"color: red;\">".$ballutil->G10_Auto($hm,2)."</span>":$ballutil->G10_Auto($hm,2))?> / <?=($ballutil->G10_Auto($hm,3)=="总和双"?"<span style=\"color: red;\">".$ballutil->G10_Auto($hm,3)."</span>":$ballutil->G10_Auto($hm,3))?> / <?=($ballutil->G10_Auto($hm,4)=="总和尾大"?"<span style=\"color: red;\">".$ballutil->G10_Auto($hm,4)."</span>":$ballutil->G10_Auto($hm,4))?> / 			 <?=($ballutil->G10_Auto($hm,5)=="龙"?"<span style=\"color: red;\">".$ballutil->G10_Auto($hm,5)."</span>":$ballutil->G10_Auto($hm,5))?>
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
<script type="text/javascript" src="/public/aomen/lottery/js/tjsf.js"></script>

