/**
 * 提交电子游艺登录表单
 * @param {int} live_id     真人操作编号
 * @param {int} uid         用户id
 * @param {int} game_id     电子游艺id
 * @param {int} flash_id    游戏id
 * @returns {Boolean}       true: 通过 false: 未通过
 */
function submitGame(live_id, uid, game_id, flash_id) {
    if (isNaN(Number(live_id)) || isNaN(Number(uid))) {
        alert('参数类型错误');
        return false;
    } else if (uid === '' || uid <= 0) {
        alert('请先登录！');
        return false;
    }
    
    var param = "type="  + live_id;
    param += game_id === '' ? '' : ("&game_id=" + game_id);
    param += flash_id === '' ? '' : ("&flash_id=" + flash_id);
//  $(this).attr('data-gametype');
//	alert($(this).attr('data-gametype'));
//	return ;
    window.open("/?r=game/login/index&" + param, "_blank");
    return true;
}