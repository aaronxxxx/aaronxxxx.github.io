/* 
 * @Author: anchen
 * @Date:   2016-08-26 17:01:26
 * @Last Modified by:   anchen
 * @Last Modified time: 2016-09-05 11:06:37
 */

$(document).ready(function () {
    // 声明变量存储快速下注金额值
    $fastMoney = 0;
    // 声明变量存储自定义金额值
    $mineMoney = "";
    // 声明变量存储快速下注总金额值
    $fastMoneySum = "";
    // #table 的种类 
    $digit = $('#table1').data('digits');
     // 快速下注
    // 选定快速投注金额
    $(".fast-lhai ul li").click(function () {
        $(this).addClass("fast-sel").siblings().removeClass('fast-sel');
        $fastMoney = parseInt($(this).text());
        $mineMoney = parseInt($("#fast-input-lhai").val());
        if ($("#fast-input-lhai").val() == "") {
            $mineMoney = 0;
            $fastMoneySum = $fastMoney + $mineMoney;
            $fastMoneySum = parseInt($fastMoney + $mineMoney);
        };
        if ($(this).hasClass('fast-sel') == true) {
            $fastMoneySum = $fastMoney + $mineMoney;
            $fastMoneySum = parseInt($fastMoneySum)
        };
        // 叠加赋值
   
        switch( $digit)
        {
            case 2:
            $('#table1 .fast-sel').next().children('.GoldQQ').val($fastMoneySum);
            break;
            case 4:
            $('#table1 .fast-sel').next().next().next().children('.GoldQQ').val($fastMoneySum);
            break;
            default:
            $('#table1 .fast-sel').next().next().children('.GoldQQ').val($fastMoneySum);
        }
        // 特别号A/B
        $("#fast-input-lhai").val($fastMoneySum);
        $('#table2 .fast-sel').next().next().children('.GoldQQ').val($fastMoneySum);
        // 两面-tab切换模块
        if ($(".infos ul li span.fast-sel")) {
            $(".infos ul li span.fast-sel").next().next().children(".GoldQQ").val($fastMoneySum);
        }
        // 头尾数模块
        $('#table3 .fast-sel').next().next().children('.GoldQQ').val($fastMoneySum);
        $('#table4 .fast-sel').next().next().children('.GoldQQ').val($fastMoneySum);
        // 正碼1-6
       
        //正肖 一肖
    
    })
    // 选球事件
    // 特别号
    $("#table1").on("click", "td", function () {
        // if($(".fast-lhai ul li").hasClass('fast-sel') == false) {
        //     $(this).siblings().eq($(this).index()+1).children("input").val();
        // }
        // 判斷遊戲種類
        var digit = $(this).parents('#table1').data('digits');
        if(digit == 2){
            if($(this).index() == 1 || $(this).index() == 3){
                $(this).toggleClass("fast-sel");
                if ($(this).hasClass('fast-sel') == true) {
                    // 将选中金额赋值给input框
                    $(this).next().children(".GoldQQ").val($fastMoneySum);
                    // 判断只有自定义输入金额时
                    if ($(".fast-lhai ul li").hasClass('fast-sel') == false) {
                        $(this).next().children(".GoldQQ").val($mineMoney);
                    }
                } else {
                    $(this).next().children(".GoldQQ").val("");
                }
            }
        }
        else if (digit == 4) {
            if($(this).index() == 0){
                $(this).toggleClass("fast-sel");
                if ($(this).hasClass('fast-sel') == true) {
                    // 将选中金额赋值给input框
                    $(this).siblings().eq(2).children(".GoldQQ").val($fastMoneySum);
                    // 判断只有自定义输入金额时
                    if ($(".fast-lhai ul li").hasClass('fast-sel') == false) {
                    $(this).siblings().eq(2).children(".GoldQQ").val($mineMoney);
                    }
                } else {
                    $(this).siblings().eq(2).children(".GoldQQ").val("");
                }
            }
        } else {
            // 判断选球
            if ($(this).index() == 0 || $(this).index() == 3 || $(this).index() == 6) {
                $(this).toggleClass("fast-sel");
                if ($(this).hasClass('fast-sel') == true) {
                    // 将选中金额赋值给input框
                    $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($fastMoneySum);
                    // 判断只有自定义输入金额时
                    if ($(".fast-lhai ul li").hasClass('fast-sel') == false) {
                        $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($mineMoney);
                    }
                } else {
                    $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val("");
                }
            }
        }
    });
    $("#table2").on("click", "td", function () {
        // if($(".fast-lhai ul li").hasClass('fast-sel') == false) {
        //     $(this).siblings().eq($(this).index()+1).children("input").val("");
        // }
        // 判断选球
        if ($(this).index() == 0 || $(this).index() == 3 || $(this).index() == 6) {
            $(this).toggleClass("fast-sel");
            if ($(this).hasClass('fast-sel') == true) {
                // 将选中金额赋值给input框
                $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($fastMoneySum);
                // 判断只有自定义输入金额时
                if ($(".fast-lhai ul li").hasClass('fast-sel') == false) {
                    $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($mineMoney);
                }
            } else {
                $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val("");
            }
        }
    });

    //两面 的
    // $("#div-lm").on("click",".infos>ul>li>.title_td", function() {
    //     // 判断选球
    //     if($(this).index() == 0 || $(this).index() == 3||$(this).index()==6) {
    //         $(this).toggleClass("fast-sel");
    //         if ($(this).hasClass('fast-sel') == true) {
    //             // 将选中金额赋值给input框
    //             $(this).siblings().eq($(this).index()+1).children(".GoldQQ").val($fastMoneySum);
    //             // 判断只有自定义输入金额时
    //             if($(".fast-lhai ul li").hasClass('fast-sel') == false) {
    //                 $(this).siblings().eq($(this).index()+1).children(".GoldQQ").val($mineMoney);
    //             }
    //         } else {
    //             $(this).siblings().eq($(this).index()+1).children(".GoldQQ").val("");
    //         }
    //     }
    // });



    $("#div-lm .title_td").click(function () {
        if ($(this).index() == 0 || $(this).index() == 3 || $(this).index() == 6) {
            $(this).toggleClass("fast-sel");
            if ($(this).hasClass('fast-sel') == true) {
                // 将选中金额赋值给input框
                $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($fastMoneySum);
                // 判断只有自定义输入金额时
                if ($(".fast-lhai ul li").hasClass('fast-sel') == false) {
                    $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($mineMoney);
                }
            } else {
                $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val("");
            }
        }
    });
    // // 两面-tab切换模块 正碼特
    $("body").on('touchstart', '.infos ul li span', function () {
        if ($(this).index() == 0) {
            $(this).toggleClass('fast-sel');
        };
        if ($(this).hasClass('fast-sel') == true) {
            if (($(".fast-lhai ul li").hasClass('fast-sel') == true)) {
                $(this).next().next().children(".GoldQQ").val($fastMoneySum);
                $(this).siblings('.bian_td_inp').children(".GoldQQ").val($fastMoneySum);
            } else {
                $(this).next().next().children(".GoldQQ").val($mineMoney);
                $(this).siblings('.bian_td_inp').children(".GoldQQ").val($mineMoney);
            }
        } else {
            $(this).next().next().children(".GoldQQ").val("");
            $(this).siblings('.bian_td_inp').children(".GoldQQ").val('');
        }
    });

    // 头尾数模块
    $("#table3").on("click", "td", function () {
        // 判断选球
        if ($(this).index() == 0 || $(this).index() == 3 || $(this).index() == 6) {
            $(this).toggleClass('fast-sel');
            if ($(this).hasClass('fast-sel') == true) {
                // 将选中金额赋值给input框
                $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($fastMoneySum);
                // 判断只有自定义输入金额时
                if ($(".fast-lhai ul li").hasClass('fast-sel') == false) {
                    $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($mineMoney);
                }
            } else {
                $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val("");
            }
        }
    });
    $("#table4").on("click", "td", function () {
        // 判断选球
        if ($(this).index() == 0 || $(this).index() == 3 || $(this).index() == 6) {
            $(this).toggleClass("fast-sel");
            if ($(this).hasClass('fast-sel') == true) {
                // 将选中金额赋值给input框
                $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($fastMoneySum);
                // 判断只有自定义输入金额时
                if ($(".fast-lhai ul li").hasClass('fast-sel') == false) {
                    $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val($mineMoney);
                }
            } else {
                $(this).siblings().eq($(this).index() + 1).children(".GoldQQ").val("");
            }
        }
    });
    // 自定义金额事件
    $('#fast-input-lhai').bind('input propertychange', function () {
        $mineMoney = parseInt($("#fast-input-lhai").val());
        // 特别号
        $('#table1 .fast-sel').next().next().children(".GoldQQ").val($mineMoney);
        $('#table2 .fast-sel').next().next().children(".GoldQQ").val($mineMoney);
        // 两面-tab切换模块
        $(".infos ul li span.fast-sel").next().next().children(".GoldQQ").val($mineMoney);
        // 头尾数模块
        $('#table3 .fast-sel').next().next().children(".GoldQQ").val($mineMoney);
        $('#table4 .fast-sel').next().next().children(".GoldQQ").val($mineMoney);
        if ($(this).val() == "") {
            $mineMoney = "";
            // 特别号
            $('#table1 .fast-sel').next().next().children(".GoldQQ").val("");
            $('#table2 .fast-sel').next().next().children(".GoldQQ").val("");
            // 两面-tab切换模块
            $(".infos ul li span.fast-sel").next().next().children(".GoldQQ").val("");
            // 头尾数模块
            $('#table3 .fast-sel').next().next().children(".GoldQQ").val("");
            $('#table4 .fast-sel').next().next().children(".GoldQQ").val("");
        };
    });
    // 自定义金额输入框失焦事件
    $('#fast-input-lhai').focus(function () {
        $(".fast-lhai ul li").removeClass('fast-sel');
    })
    // 点击取消按钮事件
    $("#res1").click(function () {
        $('#fast-input-lhai').val('')
        $(".fast-lhai ul li").removeClass('fast-sel');
        // 特别号
        //$('form#newForm .tableCell').children('.fast-sel').removeClass('fast-sel');
        $("#table1 .fast-sel").removeClass('fast-sel');
        $("#table2 .fast-sel").removeClass('fast-sel');
        $('#table1 .fast-sel').next().next().children(".GoldQQ").val("");
        $('#table2 .fast-sel').next().next().children(".GoldQQ").val("");
        // 两面-tab切换模块
        $(".infos ul li span.fast-sel").removeClass('fast-sel');
        $(".infos ul li span.fast-sel").next().next().children(".GoldQQ").val("");
        // 头尾数模块
        $("#table3 td").removeClass('fast-sel');
        $("#table4 td").removeClass('fast-sel');
        $('#table3 .fast-sel').next().next().children(".GoldQQ").val("");
        $('#table4 .fast-sel').next().next().children(".GoldQQ").val("");
        // nas
        $('#nas_tabinner0 .bet-item').removeClass('fast-sel');
        $('#nas_tabinner0  .fast-sel').find('.bian_td_inp').children(".GoldQQ").val("");
        // 共同模块
        $fastMoney = 0;
        $mineMoney = "";
        $fastMoneySum = "";
    })
});