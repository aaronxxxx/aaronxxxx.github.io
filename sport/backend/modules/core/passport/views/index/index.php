<script src="/public/common/js/echarts.min.js" type="text/javascript"></script>
<style>
    .rightsct{
        padding: 0;
        background-color:transparent;
        border: 0;
    }
    </style>
<div class="infobox-container">
    <div class="infobox infobox-green  ">
        <div class="infobox-icon">
            <i class="fa fa-comments-o"></i>
        </div>

        <div class="infobox-data">
            <!-- <span class="infobox-data-number" id="hyzs"></span> -->
            <button onclick="informationDialog('hyzs','会员总数量');">查询</button>
            <div class="infobox-content">会员总数量</div>
        </div>

    </div>
    <a href="#/member/index/different&diff_type=jrhy">
        <div class="infobox infobox-blue  ">
            <div class="infobox-icon">
                <i class="fa fa-users"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number" id="jrhy"></span>
                <div class="infobox-content">今日新增会员数量</div>
            </div>
        </div>
    </a>
    <div class="infobox infobox-pink  ">
        <div class="infobox-icon">
            <i class="fa fa-user-secret"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number" id="cjdl_count"></span>
            <div class="infobox-content">今日曾经在线会员数量</div>
        </div>

    </div>

    <div class="infobox infobox-red  ">
        <div class="infobox-icon">
            <i class="fa fa-file-zip-o"></i>
        </div>
        <div class="infobox-data">
            <!-- <span class="infobox-data-number" id="bet_count"></span> -->
            <button onclick="informationDialog('bet_count','今日注单总数');">查询</button>
            <div class="infobox-content">今日注单总数</div>
        </div>
    </div>
    <a href="#/finance/fund/tixian&status=全部提款&order=id&time=CN&time_start=<?= urlencode(date('Y-m-d 00:00:00'));?>&time_end=<?= urlencode(date('Y-m-d H:i:s'));?>&username=">
        <div class="infobox infobox-yellow">
            <div class="infobox-icon">
                <i class="fa fa-flask"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="tixian_today"></span>
                <div class="infobox-content">今日提现笔数</div>
            </div>
        </div>
    </a>
    <a href="#/finance/fund/money-save&status=全部存款&order=id&time=CN&time_start=<?= urlencode(date('Y-m-d 00:00:00'));?>&time_end=<?= urlencode(date('Y-m-d H:i:s'));?>&username=">
        <div class="infobox infobox-blue2  ">
            <div class="infobox-icon">
                <i class="fa fa-dollar"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="cunkuan_today"></span>
                <div class="infobox-content">今日存款笔数</div>
            </div>
        </div>
    </a>
    <a href="#/finance/default/huikuan&status=全部&start_time=<?= urlencode(date('Y-m-d 00:00:00'));?>&end_time=<?= urlencode(date('Y-m-d H:i:s'));?>&user_name=">
        <div class="infobox infobox-hui">
            <div class="infobox-icon">
                <i class="fa fa-print"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="huikuan_today"></span>
                <div class="infobox-content">今日第三方汇款笔数</div>
            </div>
        </div>
    </a>
    <a href="#/member/index/different&diff_type=ftms">
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="fa fa-users"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number" id="ftms"></span>
                <div class="infobox-content">今日首次提款会员数量</div>
            </div>
        </div>
    </a>
    <a href="#/member/index/different&diff_type=fcms">
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="fa fa-dollar"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number" id="fcms"></span>
                <div class="infobox-content">今日首次存款会员数量</div>
            </div>
        </div>
    </a>
    <a href="#/member/index/different&diff_type=tsmm">
        <div class="infobox infobox-blue2  ">
            <div class="infobox-icon">
                <i class="fa fa-dollar"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number" id="tsmm"></span>
                <div class="infobox-content">今日充值会员</div>
            </div>
        </div>
    </a>
    <a href="#/member/index/different&diff_type=ttmm">
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="fa fa-flask"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number" id="ttmm"></span>
                <div class="infobox-content">今日出款会员</div>
            </div>
        </div>
    </a>

    <a href="#/agent/index/list-type&remark=0">
        <div class="infobox infobox-huang">
            <div class="infobox-icon">
                <i class="fa fa-leaf"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="dlnum"></span>
                <div class="infobox-content">待审核代理信息</div>
            </div>
        </div>
    </a>
</div>
<div class="infogreen" style="display: none">
    <!--<p class="one"> <span><label>自动真人转账的状态是：</label><em><?/*=$autoZhenren == 1 ? '开启' : '关闭'*/?> </em> <a href="?r=sysmng/config"> 点击设置自动真人转账</a> </span> </p>-->
    <p>
        <span><label>AG极速厅余额：</label><em id="ag_hall">元</em> </span>
        <span><label>DS厅余额：</label><em id="ds_hall">元</em> </span>
    </p>
    <p>
        <span><label>AG_BBIN厅余额：</label><em id="ag_bbin_hall">元</em> </span>
        <span><label>KG厅余额：</label><em id="kg_hall">元</em> </span>
        <!-- <span><label>AG_OG厅余额：</label><em id="ag_og_hall">元</em> </span> </p> -->
    <p>
        <span><label>AG国际厅余额：</label><em id="agin_hall">元</em> </span>
        <span><label>OG厅余额：</label><em id="og_hall">元</em> </span>
    </p>
    <p>
        <span><label>AG_MG厅余额：</label><em id="ag_mg_hall">元</em> </span>
		<span><label>VR厅余额：</label><em id="vr_hall">元</em> </span>
    </p>
    <p>
        <span><label>PT厅余额：</label><em id="pt_hall">元</em> </span>
		<span><label></label><em id="null"></em> </span>
    </p>
    <p>
        <span><label>会员账号总存盘：</label><button onclick="showMoneyDialog('会员账号总存盘','会员账号总存盘')">查询</button>元</em> </span>
		<span><label>真人账号总存盘：</label><button onclick="showMoneyDialog('真人账号总存盘','真人账号总存盘')">查询</button>元</em> </span>
    </p>
</div>

<div class="crackermap clear">
    <h2><i class="fa fa-pie-chart"></i>饼干图</h2>
    <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
    <div id="jiaoyi_record" class="bing" ></div>
    <a href="#/member/index&user_group=0&cpage=1&type=user_name&key=&online=1&status=&havepay=&overage=">
        <div id="onlineuser" class="bing" ></div>
    </a>
    <script>
        function showMoneyDialog(title_content,name) {
            var user_money_all = '';
            var live_money_all = '';
            $.ajax({
                url:'/?r=passport/index/userbalance',
                dataType:'json',
                success:function (data) {
                    console.log(data.data.user_money_all);
                    if(data.status) {
                        user_money_all = data.data.user_money_all;
                        live_money_all = data.data.live_money_all;
                        if(name == '会员账号总存盘')
                        {
                            var msg = name + ':' + user_money_all;
                        }
                        else if(name == '真人账号总存盘')
                        {
                            var msg = name + ':' + live_money_all;
                        }
                        layer.open({
                            title: title_content,
                            area: ['150px', '150px'],
                            content: msg
                        });
                    }else {
                        $.dialog.notify(data.msg);
                    }
                }
            });

        }

        function informationDialog(type,title_content) {

            $.ajax({
                url:'/?r=passport/index/info',
                type:'POST',
            	data:{type:type},
                dataType:'json',
                success:function (data) {
                    console.log(data);
                    if(data.status) {

                        if(type=='bet_count'){
                            option = {
                            title: {
                                text: '注单交易记录',
                                x: 'center'
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            series: [{
                                name: '注单交易记录',
                                type: 'pie',
                                radius: '70%', //大小
                                //左右 上下
                                center: ['53%', '55%'],
                                color: [],
                                data: [],
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                }
                            }
                            ]
                        };
                        var sum = 0;
                             if(data.data.betData.length > 0) {
                            for(var i=0;i<data.data.betData.length;i++) {
                                option.series[0].color.push(data.data.betData[i]['color']);
                                option.series[0].data.push({value:data.data.betData[i]['value'],name:data.data.betData[i]['title']});
                                sum = sum+parseInt(data.data.betData[i]['value']);
                            }
                        } else {
                            option.series[0].data.push({value:0,name:"交易记录"});
                        }
                        console.log(sum);
                        option.title.text = '('+sum+')注单交易记录';
                        myChart.setOption(option);

                        }


                         var msg = title_content + ':' + data.data.result;

                        layer.open({
                            title: title_content,
                            area: ['150px', '150px'],
                            content: msg
                        });
                    }else {
                        $.dialog.notify(data.msg);
                    }
                }
        });
    }
    </script>
    <script type="text/javascript">
        $(function () {
            $.ajax({
                url:'/?r=passport/index/hallbalance',
                dataType:'json',
                success:function (data) {
                    if(data.status) {
                        $('#ag_hall').text(data.data.ag_hall + '元');
                        $('#agin_hall').text(data.data.agin_hall + '元');
                        $('#ag_bbin_hall').text(data.data.ag_bbin_hall + '元');
                        // $('#ag_og_hall').text(data.data.ag_og_hall + '元');
                        $('#ag_mg_hall').text(data.data.ag_mg_hall + '元');
                        $('#ds_hall').text(data.data.ds_hall + '元');
                        $('#og_hall').text(data.data.og_hall + '元');
                        $('#kg_hall').text(data.data.kg_hall + '元');
						$('#vr_hall').text(data.data.vr_hall + '元');
                        $('#pt_hall').text(data.data.pt_hall + '元');
                        $('#user_live_money').text(data.data.user_live_all + '元');
                        $('#user_money_all').text(data.data.user_money_all + '元');
                    }else {
                        $.dialog.notify(data.msg);
                    }
                }
            });
            $.ajax({
                url:'/?r=passport/index/getdata',
                dataType:'json',
                success:function (data) {
                    if(data.status) {
                        // $('#hyzs').text(data.data.hyzs);
                        $('#ftms').text(data.data.ftms);
                        $('#tsmm').text(data.data.tsmm);
                        $('#ttmm').text(data.data.ttmm);
                        $('#fcms').text(data.data.fcms);
                        $('#jrhy').text(data.data.jrhy);
                        $('#cjdl_count').text(data.data.cjdl_count);
                        // $('#bet_count').text(data.data.bet_count);
                        $('#tixian_today').text(data.data.tixian_today);
                        $('#cunkuan_today').text(data.data.cunkuan_today);
                        $('#huikuan_today').text(data.data.huikuan_today);
                        $('#dlnum').text(data.data.dlnum);
                        var option = {
                            title: {
                                text: data.data.onlineUser + '个会员在线',
                                x: 'center'
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            series: [
                                {name: '',
                                    type: 'pie',
                                    radius: '70%',
                                    //左右 上下
                                    center: ['50%', '55%'],
                                    color: ['#68BC31', '#2091CF'],
                                    data: [
                                        {value: data.data.pcUser, name: 'PC在线人数'},
                                        {value: data.data.mobileUser, name: '手机在线人数'}
                                    ],
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    }
                                }
                            ],
                        };
                        // 使用刚指定的配置项和数据显示图表。
                        userChart.setOption(option);
                        option = {
                            title: {
                                text: '注单交易记录',
                                x: 'center'
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            series: [{
                                name: '注单交易记录',
                                type: 'pie',
                                radius: '70%', //大小
                                //左右 上下
                                center: ['53%', '55%'],
                                color: [],
                                data: [],
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                }
                            }
                            ]
                        };
                        var sum = 0;
                        if(data.data.betData.length > 0) {
                            for(var i=0;i<data.data.betData.length;i++) {
                                option.series[0].color.push(data.data.betData[i]['color']);
                                option.series[0].data.push({value:data.data.betData[i]['value'],name:data.data.betData[i]['title']});
                                sum = sum+parseInt(data.data.betData[i]['value']);
                            }
                        } else {
                            option.series[0].data.push({value:0,name:"交易记录"});
                        }
                        console.log(sum);
                        // option.title.text = '('+sum+')注单交易记录';
                        option.title.text = '注单交易记录\n\n(请先查询今日注单总数)';
                        myChart.setOption(option);
                    }else {
                        $.dialog.notify(data.msg);
                    }
                }
            })
        });
        //初始化echarts实例
        var myChart = echarts.init(document.getElementById('jiaoyi_record'));
        var userChart = echarts.init(document.getElementById('onlineuser'));
    </script>
</div>
