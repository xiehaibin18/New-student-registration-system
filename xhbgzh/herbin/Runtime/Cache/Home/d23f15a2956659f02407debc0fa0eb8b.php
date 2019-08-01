<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
</head>
<body>

<p>不错哦，成功了，红红火火恍恍惚惚！</p>
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