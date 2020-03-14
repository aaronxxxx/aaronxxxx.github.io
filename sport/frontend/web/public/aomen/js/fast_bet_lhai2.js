/* 
* @Author: anchen
* @Date:   2016-08-26 17:01:26
* @Last Modified by:   mq
* @Last Modified time: 2016-08-30 17:36:42
*/

$(document).ready(function(){
    // 声明变量存储快速下注金额值
    $fastMoney = 0;
    // 声明变量存储自定义金额值
    $mineMoney="";
    // 声明变量存储快速下注总金额值
    $fastMoneySum = "";
    // 快速下注
        // 选定快速投注金额
        $(".fast-lhai ul li").click(function() {
            $(this).addClass("fast-sel").siblings().removeClass('fast-sel');
            $fastMoney = parseInt($(this).text());
            $mineMoney= parseInt($("#fast-input-lhai").val());
            if ($("#fast-input-lhai").val() == "") {
                $mineMoney= 0;
                $fastMoneySum = $fastMoney+$mineMoney;
                $fastMoneySum = parseInt($fastMoneySum);
            };
            if ($(this).hasClass('fast-sel') == true) {
                $fastMoneySum = $fastMoney+$mineMoney;
                $fastMoneySum = parseInt($fastMoneySum)
            };
            // 叠加赋值
                // 特别号A/B
            $("#fast-input-lhai").val($fastMoneySum);
            $('#table1 .fast-sel').next().children('.GoldQQ').val($fastMoneySum);
            
        })
        // 选球事件
            // 特别号
        $("#table1").on("click","td", function() {
            // if($(".fast-lhai ul li").hasClass('fast-sel') == false) {
            //     $(this).siblings().eq($(this).index()+1).children("input").val();
            // }
            // 判断选球
            if($(this).index() == 1 || $(this).index() == 3) {
                $(this).toggleClass("fast-sel");
                if ($(this).hasClass('fast-sel') == true) {
                    // 将选中金额赋值给input框
                    $(this).siblings().eq($(this).index()).children(".GoldQQ").val($fastMoneySum);
                    // 判断只有自定义输入金额时
                    if($(".fast-lhai ul li").hasClass('fast-sel') == false) {
                        $(this).siblings().eq($(this).index()).children(".GoldQQ").val($mineMoney);
                    }                    
                } else {
                    $(this).siblings().eq($(this).index()).children(".GoldQQ").val("");
                }
            }
        });      
        // 自定义金额事件
        $('#fast-input-lhai').bind('input propertychange', function () {
            $mineMoney= parseInt($("#fast-input-lhai").val());
            // 特别号
            $('#table1 .fast-sel').next().children('.GoldQQ').val($mineMoney);
            if ($(this).val() == "") {
                $mineMoney = "";
                // 特别号
                $('#table1 .fast-sel').next().children('.GoldQQ').val("");
            };
        });
        // 自定义金额输入框失焦事件
        $('#fast-input-lhai').focus(function() {
            $(".fast-lhai ul li").removeClass('fast-sel');
        })
        // 点击取消按钮事件
        $("#res1").click(function() {
            $('#fast-input-lhai').val("");
            $(".fast-lhai ul li").removeClass('fast-sel');
            // 特别号
             $("#table1 td").removeClass('fast-sel');
            $("#table2 td").removeClass('fast-sel');
            $('#table1 .fast-sel').next().children(".GoldQQ").val("");
            $('#table2 .fast-sel').next().children(".GoldQQ").val("");
            // 共同模块
            $fastMoney = 0;
            $mineMoney="";
            $fastMoneySum = "";
        })
});