function setDate(dateType) {
    var dateNow = new Date();
    var dateStart;
    var dateEnd;
    if (dateType === "today") {
        dateStart = dateNow.Format("yyyy-MM-dd");
        dateEnd = dateNow.Format("yyyy-MM-dd");
    } else if (dateType === "yesterday") {
        dateNow.addDays(-1);
        dateStart = dateNow.Format("yyyy-MM-dd");
        dateEnd = dateNow.Format("yyyy-MM-dd");
    } else if (dateType === "lastSeven") {//最近7天
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-6);
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType === "lastThirty") {//最近30天
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-29);
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType === "thisWeek") {//本周
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-dateNow.getDay());
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType === "lastWeek") {//上周
        dateNow.addDays(-dateNow.getDay() - 1);
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-6);
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType === "thisMonth") {//本月
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-dateNow.getDate() + 1);
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType === "lastMonth") {//上月
        dateNow.addDays(-dateNow.getDate());
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-dateNow.getDate() + 1);
        dateStart = dateNow.Format("yyyy-MM-dd");
    }
    
    $("#s_time").val(dateStart);
    $("#e_time").val(dateEnd);
    $("#form1").submit();
}

function check() {
    if (!$("#s_time").val() || !$("#e_time").val()) {
        alert("请输入开始/结束日期。");
    }
    
    return true;
}

function onChangeMonth(value) {
    if (value === "") {
        return;
    }
    
    var dateNow = new Date();
    var dateStart;
    var dateEnd;

    dateNow.addDays(-dateNow.getDate() + 1);
    dateNow.addMonths(-dateNow.getMonth() + parseInt(value) - 1);
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
    
    if (/(y+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length === 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        }
    }
    
    return fmt;
};
Date.prototype.addDays = function (d) {
    this.setDate(this.getDate() + d);
};

Date.prototype.addWeeks = function (w) {
    this.addDays(w * 7);
};

Date.prototype.addMonths = function (m) {
    var d = this.getDate();
    this.setMonth(this.getMonth() + m);

    if (this.getDate() < d) {
        this.setDate(0);
    }
};

Date.prototype.addYears = function (y) {
    var m = this.getMonth();
    this.setFullYear(this.getFullYear() + y);

    if (m < this.getMonth()) {
        this.setDate(0);
    }
};
//测试 var now = new Date(); now.addDays(1);//加减日期操作 alert(now.Format("yyyy-MM-dd"));

Date.prototype.dateDiff = function (interval, endTime) {
    switch (interval) {
        case "s":   //計算秒差
            return parseInt((endTime - this) / 1000);
        case "n":   //計算分差
            return parseInt((endTime - this) / 60000);
        case "h":   //計算時差
            return parseInt((endTime - this) / 3600000);
        case "d":   //計算日差
            return parseInt((endTime - this) / 86400000);
        case "w":   //計算週差
            return parseInt((endTime - this) / (86400000 * 7));
        case "m":   //計算月差
            return (endTime.getMonth() + 1) + ((endTime.getFullYear() - this.getFullYear()) * 12) - (this.getMonth() + 1);
        case "y":   //計算年差
            return endTime.getFullYear() - this.getFullYear();
        default:    //輸入有誤
            return undefined;
    }
};

function updateOrder() {
    if(!confirm("确定要更新注单吗？")) {
            return false;
    }
    
    $.post("/y27/casino/recovercj.php", {}, function () {
        //;
    }, "html");
	
    alert("正在更新中...");
}
function lottery_updateOrder() {
    if(!confirm("确定要更新注单吗？")) {
            return false;
    }
    
    $.post("/public/lottery/recovercj.php", {}, function () {
        //;
    }, "html");
	
    alert("正在更新中...");
}