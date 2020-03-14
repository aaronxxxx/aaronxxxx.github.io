<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
?>
<div id="pageMain">
   
                    <div class="pro_title ">清除数据</div>
                     <div class="trinput  mgauto middle font14">
                    <form id="dataForm" onSubmit="return check();"> 
                        <p>
                            <span class="pd10">
                                &nbsp;&nbsp;
                                日期：<input name="s_time" type="text" id="s_time" value="<?=$startTime?>" class="date_day" />
                                ~
                                <input name="e_time" type="text" id="e_time" value="<?=$endTime?>" class="date_day"/>
                                <input type="button" value="保留指定时间内数据" onClick="setDate('manual')"/>
                                &nbsp;&nbsp;
                                <input type="button" value="保留一周内数据" onClick="setDate('lastSeven')"/>
                                <input type="button" value="保留二周内数据" onClick="setDate('lastSeven2')"/>
                                <input type="button" value="保留一个月内数据" onClick="setDate('lastThirty')"/>
                                <input type="button" value="保留二个月内数据" onClick="setDate('lastThirty2')"/>
                                <input type="button" value="保留半年内数据" onClick="setDate('lastHalfYear')"/>
                                <input type="button" value="保留一年内数据" onClick="setDate('lastYear')"/>

                              </span>
                        </p>
                        <p style="display: none;">
                            <span>
                                &nbsp;&nbsp;
                                日期：<input name="s_time2" type="text" id="s_time2" value="" size="10" maxlength="10" readonly="readonly" />
                                ~
                                <input name="e_time2" type="text" id="s_time2" value="" size="10" maxlength="10" readonly="readonly" />

                                用户名：<input name="user_group" value="" style="width: 150px;" type="text">

                                <input type="button" value="删除六合彩数据" onClick="setDate('today')"/>
                                <input type="button" value="删除彩票数据" onClick="setDate('today')"/>
                                <input type="button" value="删除真人数据" onClick="setDate('today')"/>
                                <input type="button" value="删除转账数据" onClick="setDate('today')"/>
                                <input type="button" value="删除综合数据" onClick="setDate('today')"/>
                           </span>
                        </p>
                        
                    </form>
                     </div>
             
</div>
<script language="javascript">
    function setDate(dateType){
        var dateNow= new Date();
        var dateStart;
        var dateEnd;
        if(dateType=="today"){
            dateStart = dateNow.Format("yyyy-MM-dd");
            dateEnd = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="yesterday"){
            dateNow.addDays(-1);
            dateStart = dateNow.Format("yyyy-MM-dd");
            dateEnd = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="lastSeven"){//最近7天
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-6);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="lastSeven2"){//最近14天
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-13);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="lastThirty"){//最近30天
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-29);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="lastThirty2"){//最近两个月
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-59);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="lastHalfYear"){//最近半年
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-180);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="lastYear"){//最近一年
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-364);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="thisWeek"){//本周
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-dateNow.getDay());
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="lastWeek"){//上周
            dateNow.addDays(-dateNow.getDay()-1);
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-6);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="thisMonth"){//本月
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-dateNow.getDate()+1);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="lastMonth"){//上月
            dateNow.addDays(-dateNow.getDate());
            dateEnd = dateNow.Format("yyyy-MM-dd");
            dateNow.addDays(-dateNow.getDate()+1);
            dateStart = dateNow.Format("yyyy-MM-dd");
        }else if(dateType=="manual"){//手动
            $("#dataForm").submit();
            return;
        }
        $("#s_time").val(dateStart);
        $("#e_time").val(dateEnd);
        $("#dataForm").submit();
    }

    function check(){
        if(!$("#s_time").val() || !$("#e_time").val() ){
            $.dialog.notify("请输入开始/结束日期。");
            return false;
        }
        var dateNow= new Date();
        var today = dateNow.Format("yyyy-MM-dd");
        if($("#e_time").val() != today){
            $.dialog.notify("结束日子不能改变。");
            return false;
        }

        $.dialog.confirm("该操作保留时间内数据，时间以外的数据将会被删除，删除的数据不可恢复，确认删除点击确定。(此操作可能需要较长时间，请耐心等待结果。", function (data) {
            if(data){
                $.dialog.alert('数据正在清理中...');
                $.ajax({
                    type: "POST",
                    url: "?r=dataset/clean/start",
                    data: {
                        startTime: $("#s_time").val(),
                        endTime: $("#e_time").val()
                    }
                }).done(function(data) {
                    data = $.parseJSON(data);
                    $.dialog.notify(data.msg);
                }).fail(function(error){
                    console.log(error.responseText);
                });
            }
        });

        return false;
    }

    function onChangeMonth(value){
        if(value==""){
            return;
        }
        var dateNow= new Date();
        var dateStart;
        var dateEnd;

        dateNow.addDays(-dateNow.getDate()+1);
        dateNow.addMonths(-dateNow.getMonth()+parseInt(value)-1);
        dateStart = dateNow.Format("yyyy-MM-dd");
        dateNow.addMonths(1);
        dateNow.addDays(-1);
        dateEnd = dateNow.Format("yyyy-MM-dd");

        $("#s_time").val(dateStart);
        $("#e_time").val(dateEnd);
        $("#form1").submit();
    }

    Date.prototype.Format = function (fmt) { //author: meizz
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    };
    Date.prototype.addDays = function(d)
    {
        this.setDate(this.getDate() + d);
    };

    Date.prototype.addWeeks = function(w)
    {
        this.addDays(w * 7);
    };

    Date.prototype.addMonths= function(m)
    {
        var d = this.getDate();
        this.setMonth(this.getMonth() + m);

        if (this.getDate() < d)
            this.setDate(0);
    };

    Date.prototype.addYears = function(y)
    {
        var m = this.getMonth();
        this.setFullYear(this.getFullYear() + y);

        if (m < this.getMonth())
        {
            this.setDate(0);
        }
    };
    //测试 var now = new Date(); now.addDays(1);//加减日期操作 alert(now.Format("yyyy-MM-dd"));

    Date.prototype.dateDiff = function(interval,endTime)
    {
        switch (interval)
        {
            case "s":   //計算秒差
                return parseInt((endTime-this)/1000);
            case "n":   //計算分差
                return parseInt((endTime-this)/60000);
            case "h":   //計算時差
                return parseInt((endTime-this)/3600000);
            case "d":   //計算日差
                return parseInt((endTime-this)/86400000);
            case "w":   //計算週差
                return parseInt((endTime-this)/(86400000*7));
            case "m":   //計算月差
                return (endTime.getMonth()+1)+((endTime.getFullYear()-this.getFullYear())*12)-(this.getMonth()+1);
            case "y":   //計算年差
                return endTime.getFullYear()-this.getFullYear();
            default:    //輸入有誤
                return undefined;
        }
    }
    //测试 var starTime = new Date("2007/05/12 07:30:00");     var endTime = new Date("2008/06/12 08:32:02");     document.writeln("秒差: "+starTime .dateDiff("s",endTime )+"<br>");     document.writeln("分差: "+starTime .dateDiff("n",endTime )+"<br>");     document.writeln("時差: "+starTime .dateDiff("h",endTime )+"<br>");     document.writeln("日差: "+starTime .dateDiff("d",endTime )+"<br>");     document.writeln("週差: "+starTime .dateDiff("w",endTime )+"<br>");     document.writeln("月差: "+starTime .dateDiff("m",endTime )+"<br>");     document.writeln("年差: "+starTime .dateDiff("y",endTime )+"<br>");
</script>