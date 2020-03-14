/**
 * Created by Administrator on 2016/7/23.
 */
$(function () {
    $("#tab span").click(
        function () {
            $("#tab li").each(function () {
                $(this).removeClass('onTagClick').removeClass('unTagClick').addClass('unTagClick');
            })
            $(this).parent().addClass('onTagClick');
            var type = $(this).attr('class');
            $(".showT").each(
                function () {
                    $(this).hide();
                    if($(this).attr('id')==type){
                        $(this).show();
                    }
                }
            )
        }
    )
    //赔率修改
    $(".order").bind("click",function(event){
        event.preventDefault();  //阻止默认行为 ( 表单提交 )或者return false;
        var action = $(this).parents('form').attr('action');
        var type = $(this).attr('type');
        var _action = $(this).attr('data-herf');
        var odds = true;
        $(".odds").each(function () {
            if($(this).children().val()=='' || $(this).children().val()=='undefined' || $(this).children().val()==null){
                odds = false
            }
        })
        if(!odds){
            layer.alert('赔率不能为空');
            return false;
        }
        $.ajax({
            type: "POST",
            url: action,
            data: $(this).parents('form').serialize(),
            error:function () {
                layer.alert('出错了，请稍后再试');
            },
            success: function(data){
                layer.alert(data,function(index) {
                    layer.closeAll();
                    window.location.href = _action+'&t='+new Date().getTime();;
                })
            }
        })
    })

    //限制只能输入数字
    $(".odds").children().change(function () {
        if(isNaN($(this).val())){
            alert('只能输入数字');this.value='';
        }
    })
})