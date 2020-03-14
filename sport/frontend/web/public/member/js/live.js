/**
 * 提交真人登?表?
 * @param {int} live_id 真人操作??
 * @param {int} uid     用?id
 * @returns {Boolean}   true: 通? false: 未通?
 */
function submitLive(live_id, uid) {
    if (isNaN(Number(live_id)) || isNaN(Number(uid))) {
        alert('???型??');
        return false;
    } else if (uid === '' || uid <= 0) {
        alert('?先登?！');
        return false;
    }
    
    window.open("/?r=live/login/index&type=" + live_id, "_blank");
    return true;
}