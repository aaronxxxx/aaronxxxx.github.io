window.onload = function () {
    var clipboard = new Clipboard('.copy_btn');
    clipboard.on('success', function (e) {
        var dialog1 = $(document).dialog({
            type: 'confirm',
            closeBtnShow: true,
            overlayClose: true,
            content: 'QQ号复制成功，立刻为你打开QQ',
            onClickConfirmBtn: function () {
                window.location.href = 'qq://';
            }
        });

        setTimeout(function () {
            window.location.href = 'qq://';
        }, 3000);

        e.clearSelection();
    });

    clipboard.on('error', function (e) {
        setTimeout(function () {
            window.location.href = 'qq://';
        }, 3000);
        var dialog1 = $(document).dialog({
            type: 'confirm',
            closeBtnShow: true,
            overlayClose: true,
            content: '请长按复制'
        });
    });

    pushHistory();
    window.addEventListener("popstate", function (e) {
        pushHistory();

        var dialog1 = $(document).dialog({
            type: 'confirm',
            closeBtnShow: true,
            overlayClose: true,
            content: '<div><p>恭喜获得客服指导一次，点击添加客服微信</p><p style="font-size:22px;text-align: center;color: red; ">立刻添加微信</p></div>',
            onClickConfirmBtn: function () {
                window.location.href = 'qq://';
                // layer.closeAll();
            }
        });

    }, false);

    function pushHistory() {
        var state = {
            title: "title",
            url: "#"
        };
        window.history.pushState(state, "title", "#");
    }
}