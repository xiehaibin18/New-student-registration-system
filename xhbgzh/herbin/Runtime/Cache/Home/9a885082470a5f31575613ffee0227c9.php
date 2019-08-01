<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<fieldset>
<h1 style="margin: 0 auto;">留言表---查询、修改、增加———<a href="/lab08/index.php/Home/Index/Logout">注销</a></h1>
</fieldset>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>你失败了，哈哈哈哈哈哈哈哈哈哈</p>
<p>1640128229谢海滨</p>
<p>页面提示信息:<?php echo ($message); ?></p>
<p>页面错误提示信息:<?php echo ($error); ?></p>
<p>跳转等待时间 单位为秒:<?php echo ($waitSecond); ?></p>
<p>跳转页面地址:<?php echo ($jumpUrl); ?></p>


<p class="detail"></p>
<p class="jump">
    页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>

</body>
</html>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<fieldset>
    <h1 style="margin-bottom:0;">欢迎使用，一起来留言吧</h1>
</fieldset>
</body>
</html>