//同步各厅余额 1: AG 2: AGIN 3: AG BBIN 4: DS 5: OG 6: AG MG 7: OG 8:KG
function loadLiveUserBalance(num, name, nNode, mNode) {
    $.ajax({
        type: 'POST',
        url: '/?r=live/order/balance',
        data: {num: num, name: name},
        dataType: "json",
        success: function(data) {
            if(data.status) {
                var name = (data.data.name == '' || data.data.name == null) ? '额度转换后自动开通' : data.data.name;
                var balance =  data.data.balance;
                balance = isNaN(balance)? balance : Number(balance).toFixed(2);
                if (nNode === null || mNode === null) {
                    return false;
                }
                console.log(data);
                nNode.html(name);
                mNode.html(balance);
            } else {
                console.log(data);
                mNode.html(data.msg);
            }
        }
    });
}