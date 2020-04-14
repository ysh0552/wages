$(function() {

    var paramsStorage = localStorage.getItem('params');
    if (paramsStorage != null) {
        var paramsStorage = JSON.parse(paramsStorage);
        $('#card').val(paramsStorage.card);
        $('#mobile').val(paramsStorage.mobile);
    }
});


//修改手机号
$('#modifyPhoneBtn').click(function() {
    var card = $('#card').val();
    var oldmobile = $('#oldmobile').val();
    var mobile = $('#mobile').val();
    var code = $('#code').val();

    if (!checkIdentity(card)) {
        alert('请输入正确身份证号码！');
        return false;
    }
    if (oldmobile.length != 11) {
        alert('请输入正确的手机号码！');
        return false;
    }
    if (mobile.length != 11) {
        alert('请输入正确的新手机号码！');
        return false;
    }
    if (oldmobile == mobile) {
        alert('请输入新的手机号码！');
        return false;
    }
    if (code == '') {
        alert('请输入验证码！');
        return false;
    }


    //验证码是否正确
    var params = {
        card: card,
        mobile: mobile,
        code: code
    }
    $.post(HttpUrl + '/login/isSendSMS', params, function(data) {
        console.log(data);
        if (data.CustomStatus == 10) {
            var paramss = {
                act: 'submit',
                card: card,
                mobile: oldmobile,
                newmobile: mobile
            }
            $('#modifyPhoneBtn').attr('disabled', true);
            $('#modifyPhoneBtn').html('修改中..');
            $.post(HttpUrl + '/main/modifyPhone', paramss, function(datas) {
                console.log(datas);
                $('#modifyPhoneBtn').attr('disabled', false);
                $('#modifyPhoneBtn').html(' 修 改 ');
                if (datas.CustomStatus == 10) {
                    alert('修改成功，请重新登录');
                    window.location.href = HttpUrl + "/login/sessionOuts";
                } else {
                    alert(datas.CustomMessage);
                }
            }, 'json');
        } else {
            alert(data.CustomMessage);
            return false;
        }
    }, 'json');

});

//登录
$('#loginBtn').click(function() {
    var card = $('#card').val();
    var mobile = $('#mobile').val();
    var code = $('#code').val();

    if (!checkIdentity(card)) {
        alert('请输入正确身份证号码！');
        return false;
    }
    if (mobile.length != 11) {
        alert('请输入正确的手机号码！');
        return false;
    }
    if (code == '') {
        alert('请输入验证码！');
        return false;
    }
    //验证码是否正确
    var params = {
        card: card,
        mobile: mobile,
        code: code
    }
    localStorage.setItem('params', JSON.stringify(params));
    $('#loginBtn').attr('disabled', true);
    $('#loginBtn').html('登录中..');
    $.post(HttpUrl + '/login/isSendSMS', params, function(data) {

        console.log(data);

        if (data.CustomStatus == 10) {
            var paramss = {
                card: card,
                mobile: mobile
            }
            $('#loginBtn').attr('disabled', true);
            $('#loginBtn').html('登录中...');
            $.post(HttpUrl + '/login/loginUp', paramss, function(datas) {
                console.log('datas', datas);
                $('#loginBtn').attr('disabled', false);
                $('#loginBtn').html(' 登 录 ');
                if (datas == 1) {
                    window.location.href = HttpUrl + "/main";
                } else {
                    alert(datas + 'login');
                }
            });
        } else {
            $('#loginBtn').attr('disabled', false);
            $('#loginBtn').html(' 登 录 ');
            alert(data.CustomMessage);
            return false;
        }
    }, 'json');



});


//提交注册
$('#registeredBtn').click(function() {
    var username = $('#username').val();
    var jobnumber = $('#jobnumber').val();
    var card = $('#card').val();
    var mobile = $('#mobile').val();
    var code = $('#code').val();

    if (username == '') {
        alert('请输入姓名！');
        return false;
    }
    if (jobnumber == '') {
        alert('请输入工号！');
        return false;
    }
    if (!checkIdentity(card)) {
        alert('请输入正确身份证号码！');
        return false;
    }
    if (mobile.length != 11) {
        alert('请输入正确的手机号码！');
        return false;
    }
    if (code == '') {
        alert('请输入验证码！');
        return false;
    }


    //验证码是否正确
    var params = {
        card: card,
        mobile: mobile,
        code: code
    }
    $.post(HttpUrl + '/login/isSendSMS', params, function(data) {
        console.log(data);
        if (data.CustomStatus == 10) {
            var paramss = {
                username: username,
                jobnumber: jobnumber,
                card: card,
                mobile: mobile
            }
            $('#registeredBtn').attr('disabled', true);
            $('#registeredBtn').html('提交中..');
            $.post(HttpUrl + '/registered/userRegister', paramss, function(datas) {
                console.log(datas);
                $('#registeredBtn').attr('disabled', false);
                $('#registeredBtn').html(' 注 册 ');
                if (datas.CustomStatus == 10) {
                    alert('注册成功');
                    window.location.href = HttpUrl + "/login";
                } else {
                    alert(datas.CustomMessage);
                }
            }, 'json');

        } else {
            isCode = false;
            alert(data.CustomMessage);
        }
    }, 'json');




});

//获取验证码
$('#getcode').click(function(event) {
    var mobile = $('#mobile').val();

    if (mobile.length != 11) {
        alert('请输入正确的手机号码！');
        return false;
    }
    var params = {
        mobile: mobile
    }
    $('#getcode').html('发送中');
    $.post(HttpUrl + '/login/sendSMS', params, function(data) {

        console.log(data);

        if (data.CustomStatus != 10) {
            $('#getcode').attr('disabled', false);
            $('#getcode').html('重新验证码');
            alert(data.CustomMessage);
            return false;
        }
    }, 'json');

    $('#getcode').attr('disabled', true);
    var num = 60;
    var gettime = setInterval(function() {
        if (num <= 1) {
            clearInterval(gettime);
            $('#getcode').attr('disabled', false);
            $('#getcode').html('重新验证码');
        } else {
            num -= 1;
            $('#getcode').html(num + '秒');
        }
    }, 1000);
});




function checkIdentity(identity) {
    var reg = /^[1-9]{1}[0-9]{14}$|^[1-9]{1}[0-9]{16}([0-9]|[xX])$/;
    if (reg.test(identity)) {
        return true;
    } else {
        return false;
    }
}