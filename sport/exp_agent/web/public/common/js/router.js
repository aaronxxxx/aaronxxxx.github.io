/**
 * Created by alfred on 2016/6/17.
 */
$(function () {
    var router = Router({});
    router.configure({
        before:function () {},
        on: function () {},
        notfound: function () {
            if(window.location.hash==""){
                location.reload();
            }
            layer.load(1);
            $(".rights .rightsct").load("?r=" + window.location.hash.slice(2), function () {
                layer.closeAll('loading');
                window.App.bindEvent();
            });
            var moduleName = decodeURIComponent(window.location.hash.slice(2));
            if(moduleName.indexOf("/") != -1) {
                moduleName = moduleName.substring(0, moduleName.indexOf("/"));
            }
            $('.menu > li').each(function (i, ele) {
                var sel = null;
                $(ele).find('ul a').each(function (i2, ele2) {
                    var href = $(ele2).attr('href');
                    if(href.indexOf("#/"+moduleName) != -1) {
                        sel = $(ele2);
                        return false;
                    }
                });
                if(sel != null){
                    var ultag = sel.parent('li').parent('ul');
                    if(!ultag.hasClass('menu-active')) {
                        ultag.addClass('menu-active');
                        ultag.prev('a').find('i').last().addClass('drop-iconchk');
                    }
                }else{
                    $(ele).find('ul').removeClass('menu-active');
                    $(ele).find('a > i').last().removeClass('drop-iconchk');
                }
            });
        }
    });
    router.init();
});