$(function () {
    //关闭左边客服
    $("#closefloatDownLoad2").click(function () {
        $("#floatService2").hide();
    });

    //关闭右边客服
    $("#closefloatDownLoad1").click(function () {
        $("#floatService1").hide();
    });

    //读取文字闪烁 data-color
    $('.js-article-color').each(function () {
        var color_arr = $(this).data('color');

        if ("undefined" === typeof color_arr) return;

        color_arr = color_arr.split('|');

        // 確認顏色數量  2=>閃爍   1=>單一色  0=>跳過
        if (color_arr.length === 2) {
            new toggleColor(this, [color_arr[0], color_arr[1]], 500);
        } else if (color_arr.length === 1 && color_arr[0] !== '') {
            $(this).css('color', color_arr[0]);
        }
    });
});
/**
 * 最新公告信息
 * @returns {undefined}
 */
function HotNewsHistory() {
    var features = 'height=500,width=500,top=0, left=0,scrollbars=yes,resizable=yes';
    window.open('/?r=member/announcement/notice', 'HotNewsHistory', features);
}
/**
 * 文字闪烁
 * @param id   jquery selecor
 * @param arr  ['#FFFFFF','#FF0000']
 * @param s    milliseconds
 */
function toggleColor(id, arr, s) {
    var self = this;
    self._i = 0;
    self._timer = null;

    self.run = function () {
        if (arr[self._i]) {
            $(id).css('color', arr[self._i]);
        }
        self._i === 0 ? self._i++ : self._i = 0;
        self._timer = setTimeout(function () {
            self.run(id, arr, s);
        }, s);
    };
    self.run();
}

/**
 * 打开在线客服窗口
 * @returns {}
 */
function openOnlineServiceWindow() {
    var url = 'http://www.baidu.com/';
    openWindow(url, '在线客服', 626, 528);
}

/**
 * 打开用户中心窗口
 * @param {string} url      url
 * @param {string} title    窗口名称
 * @returns {}
 */
function openUCWindow(url, title) {
    openWindow(url, title, 1020, 570);
}

/**
 * 打开窗口
 * @param {string} url      url
 * @param {string} title    窗口名称
 * @param {int} width       窗口宽度
 * @param {int} height      窗口高度
 * @returns {}
 */
function openWindow(url, title, width, height) {
    var iTop = (window.screen.availHeight - 30 - height) / 2;                   // 获得窗口的垂直位置 
    var iLeft = (window.screen.availWidth - 10 - width) / 2;                    // 获得窗口的水平位置 
    window.open(url, title, 'height=' + height + ',,innerHeight=' + height + 
            ',width=' + width + ',innerWidth=' + width + ',top=' + iTop + 
            ',left=' + iLeft + 
            ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no').focus();
    // window.open("AddScfj.aspx", "newWindows", 'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no'); 
}

function BBOnlineService() {
    var url = 'http://chat6.livechatvalue.com/chat/chatClient/chatbox.jsp?companyID=513240&configID=45123&jid=6222556093';  //转向网页的地址; 
    var name = '窗口';                            //网页名称，可为空; 
    var iWidth = 626;                          //弹出窗口的宽度; 
    var iHeight = 528;                         //弹出窗口的高度; 
    //获得窗口的垂直位置 
    var iTop = (window.screen.availHeight - 30 - iHeight) / 2;
    //获得窗口的水平位置 
    var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
    window.open(url, name, 'height=' + iHeight + ',,innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no');
    // window.open("AddScfj.aspx", "newWindows", 'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no'); 
}
