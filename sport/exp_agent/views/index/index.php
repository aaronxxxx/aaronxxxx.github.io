<script src="/public/common/js/echarts.min.js" type="text/javascript"></script>
<div class="infobox-container">
    <div class="infobox infobox-green  ">
        <div class="infobox-icon">
            <i class="fa fa-comments-o"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">74</span>
            <div class="infobox-content">会员总数量</div>
        </div>

    </div>

    <div class="infobox infobox-blue  ">
        <div class="infobox-icon">
            <i class="fa fa-users"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">6</span>
            <div class="infobox-content">今日新增会员数量</div>
        </div>


    </div>

    <div class="infobox infobox-pink  ">
        <div class="infobox-icon">
            <i class="fa fa-user-secret"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">8</span>
            <div class="infobox-content">今日曾经在线会员数量</div>
        </div>

    </div>

    <div class="infobox infobox-red  ">
        <div class="infobox-icon">
            <i class="fa fa-file-zip-o"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">4125</span>
            <div class="infobox-content">注单总数量</div>
        </div>
    </div>

    <div class="infobox infobox-yellow">
        <div class="infobox-icon">
            <i class="fa fa-flask"></i>
        </div>
        <div class="infobox-data">
            <span class="infobox-data-number">8</span>
            <div class="infobox-content">今日提现笔数</div>
        </div>


    </div>

    <div class="infobox infobox-blue2  ">
        <div class="infobox-icon">
            <i class="fa fa-dollar"></i>
        </div>
        <div class="infobox-data">
            <span class="infobox-data-number">0</span>
            <div class="infobox-content">今日存款笔数</div>
        </div>
    </div>
    <div class="infobox infobox-hui">
        <div class="infobox-icon">
            <i class="fa fa-print"></i>
        </div>
        <div class="infobox-data">
            <span class="infobox-data-number">0</span>
            <div class="infobox-content">今日汇款笔数</div>
        </div>
    </div>
    <div class="infobox infobox-huang">
        <div class="infobox-icon">
            <i class="fa fa-leaf"></i>
        </div>
        <div class="infobox-data">
            <span class="infobox-data-number">3</span>
            <div class="infobox-content">待审核代理信息</div>
        </div>
    </div>

</div>
<div class="infogreen">
    <p class="one"> <span><label>自动真人转账的状态是：</label><em>开启 </em> <a href="webconfig/index.php"> 点击设置自动真人转账</a> </span> </p>
    <p> <span><label>AG极速厅余额：</label><em>元</em> </span> 
        <span><label>AG国际厅余额：</label><em>元</em> </span> </p>
    <p> <span><label>BBIN厅余额：</label><em>元</em> </span> 
        <span><label>OG厅余额：</label><em>元</em> </span> </p>
    <span><label>MG厅余额：</label><em>元</em> </span> 
    <span><label>DS厅余额：</label><em>元</em> </span> 
</div>


<div class="crackermap clear">
    <h2><i class="fa fa-pie-chart"></i>饼干图</h2>
    <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
    <div id="jiaoyi_record" class="bing" ></div>
    <div id="onlineuser" class="bing" ></div>
    <script type="text/javascript">

        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('jiaoyi_record'));
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '一条交易记录',
//                        subtext: '纯属虚构',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
//                    legend: {
//                        orient: 'vertical',
//                        left: 'right',
//                        data: ['直接访问', '邮件营销', '联盟广告', '视频广告', '搜索引擎']
//                    },
            series: [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '70%', //大小
                    //左右 上下
                    center: ['50%', '55%'],
                    color: ['#68BC31', '#2091CF', '#AF4E96', '#DA5430', '#FEE074'],
                    data: [
                        {value: 548, name: '直接访问'},
                        {value: 310, name: '邮件营销'},
                        {value: 234, name: '联盟广告'},
                        {value: 135, name: '视频广告'},
                        {value: 110, name: '搜索引擎'}
                    ],
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

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);


        var userChart = echarts.init(document.getElementById('onlineuser'));
        var useroption = {
            title: {
                text: '3个会员在线',
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
                    color: ['#68BC31', '#2091CF', '#AF4E96', '#DA5430', '#FEE074'],
                    data: [
                        {value: 100, name: '在线人数'}

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
        userChart.setOption(useroption);
    </script>
</div>
