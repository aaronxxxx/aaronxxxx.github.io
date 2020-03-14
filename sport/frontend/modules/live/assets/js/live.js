/**
 * 提交真人登录表单
 * @param {int} live_id 真人操作编号
 * @param {int} uid     用户id
 * @returns {Boolean}   true: 通过 false: 未通过
 */
function submitLive(live_id, uid) {
    if (isNaN(Number(live_id)) || isNaN(Number(uid))) {
        alert('参数类型错误');
        return false;
    } else if (uid === '' || uid <= 0) {
        alert('请先登录！');
        return false;
    }
    
    window.open("/?r=live/login/index&type=" + live_id, "_blank");
    return true;
}