
<main>
    <input type="hidden" name="" id="inputNavTitle" value="登录">
    <div class="logo">
        <img src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/logo.png" alt="" srcset=""> 
        <!-- logo size = 1000px * 461 px -->
    </div>
    <div class="inputArea">
        <ul>
            <li class="inputItem">
               <label for="">账号</label>
               <input type="text" placeholder="请输入账号" id="name" tabindex="1" maxlength="12" value="<?=(isset($name))?$name:'';?>">
            </li>
            <li class="inputItem">
                <label for="">密码</label>
                <input type="password" placeholder="请输入密码" id="pwd" tabindex="2" maxlength="12">
                <input type="hidden" id='url' name="gourl" value="<?=(isset($gourl))?$gourl:'';?>"/>
                <input type="hidden" id='talk_user' name="talk_user" value="<?=(isset($talk_user))?$talk_user:'';?>"/>
            </li>
            <!-- 验证码 -->
            <!-- <li>
                <input type="text" class="ibg100" placeholder="请输入验证码" id="yzm" maxlength="4" tabindex="3" >
                <img id="rmNum" src="/?r=mobile/index/captcha" title="点选此处产生新验证码" onclick="next_checkNum_img()" >
            </li> -->
        </ul>
    </div>
    <div class="btnArea">
        <ul>
            <li class="btnItem forgetPwd">
                <a  onclick="alert('请与客服联系')">忘记密码?</a>
            </li>
            <li class="btnItem login">
                <input type="submit" value="立即登录" id="btnlogin">
            </li>
            <li class="btnItem reg">
                <input type="button" value="马上注册" onclick="javascript:location.href='/?r=mobile/disp/register'">
            </li>
        </ul>
    </div>
</main>