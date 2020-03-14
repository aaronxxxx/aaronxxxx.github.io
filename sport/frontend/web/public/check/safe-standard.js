var ps2yZEsid = "HcaN9vR57Ten";
// safe-standard@gecko.js

var ps2yZEiso;
try {
    ps2yZEiso = (opener != null) && (typeof (opener.name) != "unknown") && (opener.ps2yZEwid != null);
} catch (e) {
    ps2yZEiso = false;
}
if (ps2yZEiso) {
    window.ps2yZEwid = opener.ps2yZEwid + 1;
    ps2yZEsid = ps2yZEsid + "_" + window.ps2yZEwid;
} else {
    window.ps2yZEwid = 1;
}
function ps2yZEn() {
    return (new Date()).getTime();
}
var ps2yZEs = ps2yZEn();
function ps2yZEst(f, t) {
    if ((ps2yZEn() - ps2yZEs) < 7200000) {
        return setTimeout(f, t * 1000);
    } else {
        return null;
    }
}
var ps2yZEol = true;
function ps2yZEow() {
    if (ps2yZEol || (1 == 1)) {
        var pswo = "menubar=0,location=0,scrollbars=auto,resizable=1,status=0,width=650,height=680";
        var pswn = "pscw_" + ps2yZEn();
        var url = "http://messenger.providesupport.com/messenger/0zla4bmcu2dp508fr2quh4wvue.html?ps_l=" + escape(document.location) + "";
        window.open(url, pswn, pswo);
    } else if (1 == 2) {
        document.location = "http://";
    }
}
var ps2yZEil;
var ps2yZEit;
function ps2yZEpi() {
    var il;
    if (3 == 2) {
        il = window.pageXOffset + 50;
    } else if (3 == 3) {
        il = (window.innerWidth * 50 / 100) + window.pageXOffset;
    } else {
        il = 50;
    }
    il -= (271 / 2);
    var it;
    if (3 == 2) {
        it = window.pageYOffset + 50;
    } else if (3 == 3) {
        it = (window.innerHeight * 50 / 100) + window.pageYOffset;
    } else {
        it = 50;
    }
    it -= (191 / 2);
    if ((il != ps2yZEil) || (it != ps2yZEit)) {
        ps2yZEil = il;
        ps2yZEit = it;
        var d = document.getElementById('ci2yZE');
        if (d != null) {
            d.style.left = Math.round(ps2yZEil) + "px";
            d.style.top = Math.round(ps2yZEit) + "px";
        }
    }
    setTimeout("ps2yZEpi()", 100);
}
var ps2yZElc = 0;
function ps2yZEsi(t) {
    window.onscroll = ps2yZEpi;
    window.onresize = ps2yZEpi;
    ps2yZEpi();
    ps2yZElc = 0;
    var url = "http://messenger.providesupport.com/" + ((t == 2) ? "auto" : "chat") + "-invitation/0zla4bmcu2dp508fr2quh4wvue.html?ps_t=" + ps2yZEn() + "";
    var d = document.getElementById('ci2yZE');
    if (d != null) {
        d.innerHTML = '<iframe allowtransparency="true" style="background:transparent;width:271;height:191" src="' + url +
                '" onload="ps2yZEld()" frameborder="no" width="271" height="191" scrolling="no"></iframe>';
    }
}
function ps2yZEld() {
    if (ps2yZElc == 1) {
        var d = document.getElementById('ci2yZE');
        if (d != null) {
            d.innerHTML = "";
        }
    }
    ps2yZElc++;
}
if (false) {
    ps2yZEsi(1);
}
var ps2yZEd = document.getElementById('sc2yZE');
if (ps2yZEd != null) {
    if (ps2yZEol || (1 == 1) || (1 == 2)) {
        var ctt = "";
        if (ctt != "") {
            tt = ' alt="' + ctt + '" title="' + ctt + '"';
        } else {
            tt = '';
        }
        if (false) {
            var p1 = '<table style="display:inline;border:0px;border-collapse:collapse;border-spacing:0;"><tr><td style="padding:0px;text-align:center;border:0px;vertical-align:middle"><a href="#" onclick="ps2yZEow(); return false;"><img name="ps2yZEimage" src="http://image.providesupport.com/image/0zla4bmcu2dp508fr2quh4wvue/online-843875383.gif" width="140" height="60" style="border:0;display:block;margin:auto"';
            var p2 = '<td style="padding:0px;text-align:center;border:0px;vertical-align:middle"><a href="http://www.providesupport.com/pb/0zla4bmcu2dp508fr2quh4wvue" target="_blank"><img src="http://image.providesupport.com/';
            var p3 = 'style="border:0;display:block;margin:auto"></a></td></tr></table>';
            if ((140 >= 140) || (140 >= 60)) {
                ps2yZEd.innerHTML = p1 + tt + '></a></td></tr><tr>' + p2 + 'lcbpsh.gif" width="140" height="17"' + p3;
            } else {
                ps2yZEd.innerHTML = p1 + tt + '></a></td>' + p2 + 'lcbpsv.gif" width="17" height="140"' + p3;
            }
        } else {
            ps2yZEd.innerHTML = '<a href="#" onclick="ps2yZEow(); return false;"><img name="ps2yZEimage" src="http://image.providesupport.com/image/0zla4bmcu2dp508fr2quh4wvue/online-843875383.gif" width="140" height="60" border="0"' + tt + '></a>';
        }
    } else {
        ps2yZEd.innerHTML = '';
    }
}
var ps2yZEop = false;
function ps2yZEco() {
    var w1 = ps2yZEci.width - 1;
    ps2yZEol = (w1 & 1) != 0;
    ps2yZEsb(ps2yZEol ? "http://image.providesupport.com/image/0zla4bmcu2dp508fr2quh4wvue/online-843875383.gif" : "http://image.providesupport.com/image/0zla4bmcu2dp508fr2quh4wvue/offline-1929700055.gif");
    ps2yZEscf((w1 & 2) != 0);
    var h = ps2yZEci.height;

    if (h == 1) {
        ps2yZEop = false;

        // manual invitation
    } else if ((h == 2) && (!ps2yZEop)) {
        ps2yZEop = true;
        ps2yZEsi(1);
        //alert("Chat invitation in standard code");

        // auto-invitation
    } else if ((h == 3) && (!ps2yZEop)) {
        ps2yZEop = true;
        ps2yZEsi(2);
        //alert("Auto invitation in standard code");
    }
}
var ps2yZEci = new Image();
ps2yZEci.onload = ps2yZEco;
var ps2yZEpm = false;
var ps2yZEcp = ps2yZEpm ? 30 : 60;
var ps2yZEct = null;
function ps2yZEscf(p) {
    if (ps2yZEpm != p) {
        ps2yZEpm = p;
        ps2yZEcp = ps2yZEpm ? 30 : 60;
        if (ps2yZEct != null) {
            clearTimeout(ps2yZEct);
            ps2yZEct = null;
        }
        ps2yZEct = ps2yZEst("ps2yZErc()", ps2yZEcp);
    }
}
function ps2yZErc() {
    ps2yZEct = ps2yZEst("ps2yZErc()", ps2yZEcp);
    try {
        ps2yZEci.src = "http://image.providesupport.com/cmd/0zla4bmcu2dp508fr2quh4wvue?" + "ps_t=" + ps2yZEn() + "&ps_l=" + escape(document.location) + "&ps_r=" + escape(document.referrer) + "&ps_s=" + ps2yZEsid + "" + "";
    } catch (e) {
    }
}
ps2yZErc();
var ps2yZEcb = "http://image.providesupport.com/image/0zla4bmcu2dp508fr2quh4wvue/online-843875383.gif";
function ps2yZEsb(b) {
    if (ps2yZEcb != b) {
        var i = document.images['ps2yZEimage'];
        if (i != null) {
            i.src = b;
        }
        ps2yZEcb = b;
    }
}

