$(document).ready(function () {
    //日期选择器
    //设定中文语系
    $.datepicker.regional['zh-TW'] = {
        dayNames: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
        dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"],
        monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
        monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
        prevText: "上月",
        nextText: "次月",
        weekHeader: "周"
    };
    //将预设语系设定为中文
    $.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
    //套用到表单
    $("#date").datepicker({
        dateFormat: '日期：yy/mm/dd',
        onSelect: function (date) {
            var date = date.replace('日期：', '');
            window.location.href = '/?r=mobile/disp/ftbk-history&date=' + date;
        }
    });
    //日期加一
    $('.right').on('click', function () {
        if ($('.date').val() == "日期：" || $('.date').val() == "") {
            alert('尚未选择指定日期')
            return false
        } else {
            var date = new Date($('.date').val().replace('日期：', ''));
            date.setDate(date.getDate() + 1);

            var month = date.getMonth() + 1;
            var day = date.getDate();
            var dateNew = date.getFullYear() + '/' + (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day;

            window.location.href = '/?r=mobile/disp/ftbk-history&date=' + dateNew;
        }
    });
    //日期减一
    $('.left').on('click', function () {
        if ($('.date').val() == "日期：" || $('.date').val() == "") {
            alert('尚未选择指定日期')
            return false
        } else {
            var date = new Date($('.date').val().replace('日期：', ''));
            date.setDate(date.getDate() - 1);

            var month = date.getMonth() + 1;
            var day = date.getDate();
            var dateNew = date.getFullYear() + '/' + (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day;

            window.location.href = '/?r=mobile/disp/ftbk-history&date=' + dateNew;
        }
    });
    // 按钮开关效果
    $('.list_content').on('click', '.list_card', function () {
        var thisBody = $(this).siblings('.inner_card'),
            thisArrow = $(this).find('.arrow');
        if (thisBody.css('display') == 'block') {
            $('.arrow').css('transform', 'rotate(0deg)');
            $('.inner_card').slideUp();
        } else {
            $('.inner_card').slideUp();
            $('.arrow').css('transform', 'rotate(0deg)');
            thisArrow.css('transform', 'rotate(180deg)');
            thisBody.slideDown();
        }
    });
    // 多页面切换
    $('.select_btn').on('click', function () {
        var button = $(this).attr('data-button');
        $('.list_table').hide();
        $('.list_body').find('#list_table' + button).show();
        $('.select_btn').removeClass('active');
        $(this).addClass('active');
    });
})