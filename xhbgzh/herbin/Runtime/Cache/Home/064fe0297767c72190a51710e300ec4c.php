<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/lab08/Public/Css/Login.css">
    <title>登录</title>
</head>
<body>

<form id="login" action='<?php echo U("DataShow");?>' method="post">
    <div>
        <h1>登录留言管理系统</h1>
    </div>
    <form method="post" action="chklogin.php">
        <fieldset id="inputs">
            <input name="username" type="text" placeholder="用户名" autofocus required>
            <input name="password" type="password" placeholder="密码"  required>
            <input name="check" type="text" placeholder="验证码" maxlength="4"  required>
        </fieldset>
        <fieldset id="actions">

            <input type="submit" id="submit" name="log" value="登录">
            <a href="" name="wjmm">忘记密码?</a><a href='<?php echo U("reg");?>' name="reg">注册新用户</a>
            <img src="<?php echo U('index/verify');?>" onclick='this.src = this.src+"?"+Math.random();' />
    </form>
    </fieldset>
</form>
</body>
</html>