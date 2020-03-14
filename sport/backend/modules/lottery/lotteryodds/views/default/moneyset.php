
 <link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="content">
            <div id="content-inner">
                <h2>
                    <b></b>
                    <span class=" white">彩票金额设置</span>
                </h2>
                <div id="content_inner">
                    <div>
                        <div id="wager_groups" class="CQ" style="width:100%;">
                            <?php
                                if($userGroup){
                                    foreach ($userGroup as $key=>$val){?>
                                        <a class="<?=$val['group_id']==$groupId ? "NowPlay":"";?>" group="<?=$val['group_id']?>" href="#/lotteryodds/default/money-set&group_id=<?=$val['group_id'];?>" class="" title="<?=$val['group_name'];?>"><?=$val['group_name'];?></a>
                            <?php  }
                                }?>
                        </div>
                    </div>
                </div>
                <div id="game">
                    <div class="showT">
                        <form action="/?r=lotteryodds/default/money-set" metdod="post" id="form1">
                            <div class="round-table">
                                <table class="GameTable">
                                    <tbody>
                                    <?php /*
                                    <tr>
                                        <td>重庆时时彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['cq_lower_bet'];?>" name="bet[cq_lower_bet]" ></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['cq_max_bet'];?>" name="bet[cq_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['cq_bet'];?>" name="bet[cq_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['cq_bet_reb'];?>" name="bet[cq_bet_reb]">
                                        </td>
                                    </tr>
                                    */ ?>
                                    <tr>
                                        <td>极速时时彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['tj_lower_bet'];?>" name="bet[tj_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['tj_max_bet'];?>" name="bet[tj_max_bet]" class="w70">  </td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['tj_bet'];?>" name="bet[tj_bet]">  </td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['tj_bet_reb'];?>" name="bet[tj_bet_reb]">  </td>
                                    </tr>
                                    <?php /*
                                    <tr>
                                        <td>广东十分彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['gdsf_lower_bet'];?>" name="bet[gdsf_lower_bet]">  </td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['gdsf_max_bet'];?>" name="bet[gdsf_max_bet]" class="w70">  </td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['gdsf_bet'];?>" name="bet[gdsf_bet]">  </td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['gdsf_bet_reb'];?>" name="bet[gdsf_bet_reb]"> </td>
                                    </tr>
                                    <tr>
                                        <td>广西十分彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['gxsf_lower_bet'];?>" name="bet[gxsf_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['gxsf_max_bet'];?>" name="bet[gxsf_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['gxsf_bet'];?>" name="bet[gxsf_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['gxsf_bet_reb'];?>" name="bet[gxsf_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>天津十分彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['tjsf_lower_bet'];?>" name="bet[tjsf_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['tjsf_max_bet'];?>" name="bet[tjsf_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['tjsf_bet'];?>" name="bet[tjsf_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['tjsf_bet_reb'];?>" name="bet[tjsf_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>重庆十分彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['cqsf_lower_bet'];?>" name="bet[cqsf_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['cqsf_max_bet'];?>" name="bet[cqsf_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['cqsf_bet'];?>" name="bet[cqsf_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['cqsf_bet_reb'];?>" name="bet[cqsf_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>北京PK拾</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['bjpk_lower_bet'];?>" name="bet[bjpk_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['bjpk_max_bet'];?>" name="bet[bjpk_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['bjpk_bet'];?>" name="bet[bjpk_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['bjpk_bet_reb'];?>" name="bet[bjpk_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>北京快乐8</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['bjkn_lower_bet'];?>" name="bet[bjkn_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['bjkn_max_bet'];?>" name="bet[bjkn_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['bjkn_bet'];?>" name="bet[bjkn_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['bjkn_bet_reb'];?>" name="bet[bjkn_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>广东11选5</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['gd11_lower_bet'];?>" name="bet[gd11_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['gd11_max_bet'];?>" name="bet[gd11_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['gd11_bet'];?>" name="bet[gd11_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['gd11_bet_reb'];?>" name="bet[gd11_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>上海时时乐</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['t3_lower_bet'];?>" name="bet[t3_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['t3_max_bet'];?>" name="bet[t3_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['t3_bet'];?>" name="bet[t3_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['t3_bet_reb'];?>" name="bet[t3_bet_reb]"></td>
                                    </tr>
                                    */ ?>
                                    <tr>
                                        <td>极速赛车</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['ssrc_lower_bet'];?>" name="bet[ssrc_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['ssrc_max_bet'];?>" name="bet[ssrc_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['ssrc_bet'];?>" name="bet[ssrc_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['ssrc_bet_reb'];?>" name="bet[ssrc_bet_reb]"></td>
                                    </tr>
                                    <?php /*
                                    <tr>
                                        <td>幸运飞艇</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['mlaft_lower_bet'];?>" name="bet[mlaft_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['mlaft_max_bet'];?>" name="bet[mlaft_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['mlaft_bet'];?>" name="bet[mlaft_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['mlaft_bet_reb'];?>" name="bet[mlaft_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>腾讯分分彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['ts_lower_bet'];?>" name="bet[ts_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['ts_max_bet'];?>" name="bet[ts_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['ts_bet'];?>" name="bet[ts_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['ts_bet_reb'];?>" name="bet[ts_bet_reb]"></td>
                                    </tr>
                                    */ ?>
                                    <tr>
                                        <td>老PK拾</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['orpk_lower_bet'];?>" name="bet[orpk_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['orpk_max_bet'];?>" name="bet[orpk_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['orpk_bet'];?>" name="bet[orpk_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['orpk_bet_reb'];?>" name="bet[orpk_bet_reb]"></td>
                                    </tr>
                                    <?php /*
                                    <tr>
                                        <td>3D彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['d3_lower_bet'];?>" name="bet[d3_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['d3_max_bet'];?>" name="bet[d3_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['d3_bet'];?>" name="bet[d3_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['d3_bet_reb'];?>" name="bet[d3_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>排列三</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['p3_lower_bet'];?>" name="bet[p3_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['p3_max_bet'];?>" name="bet[p3_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['p3_bet'];?>" name="bet[p3_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['p3_bet_reb'];?>" name="bet[p3_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>六合彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['lhc_lower_bet'];?>" name="bet[lhc_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['lhc_max_bet'];?>" name="bet[lhc_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['lhc_bet'];?>" name="bet[lhc_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['lhc_bet_reb'];?>" name="bet[lhc_bet_reb]"></td>
                                    </tr>
                                    */ ?>
                                    <tr>
                                        <td>极速六合彩</td>
                                        <td class="choose">
                                            <span class="choose-name">投注最小金额</span>
                                            <input type="text" value="<?=$group['splhc_lower_bet'];?>" name="bet[splhc_lower_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">投注最大金额</span>
                                            <input type="text" value="<?=$group['splhc_max_bet'];?>" name="bet[splhc_max_bet]" class="w70"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水最小金额</span>
                                            <input type="text" value="<?=$group['splhc_bet'];?>" name="bet[splhc_bet]"></td>
                                        <td class="choose">
                                            <span class="choose-name">反水比例</span>
                                            <input type="text" value="<?=$group['splhc_bet_reb'];?>" name="bet[splhc_bet_reb]"></td>
                                    </tr>
                                    <tr>
                                        <td>设定会员打码量</td>
                                        <td class="choose">
                                            <input maxlength="3" type="text" value="<?=$group['drawing_odds'];?>" name="bet[drawing_odds]"><span class="pd11">默认为1就是一倍打码量</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="SendB5">
                                <input type="hidden" name="group_id" value="<?=$groupId;?>">
                                <button id="btn-save-odds" class="order" type="">保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        //赔率修改
        $(".order").bind("click",function(event){
            event.preventDefault();  //阻止默认行为 ( 表单提交 )或者return false;
            var action = $("#form1").attr('action');
            $.ajax({
                type: "POST",
                url: action,
                data: $("#form1").serialize(),
                error:function () {
                    alert('出错了，请稍后再试');
                },
                success: function(data){
                    alert(data,function(index) {
                        window.location.reload();
                    })
                }
            })
        })
    })
</script>