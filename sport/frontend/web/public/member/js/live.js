/**
 * ����u�H�n?��?
 * @param {int} live_id �u�H�ާ@??
 * @param {int} uid     ��?id
 * @returns {Boolean}   true: �q? false: ���q?
 */
function submitLive(live_id, uid) {
    if (isNaN(Number(live_id)) || isNaN(Number(uid))) {
        alert('???��??');
        return false;
    } else if (uid === '' || uid <= 0) {
        alert('?���n?�I');
        return false;
    }
    
    window.open("/?r=live/login/index&type=" + live_id, "_blank");
    return true;
}