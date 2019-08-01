<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>新增留言</h1>
<form action='<?php echo U("add");?>' method="POST">
        <h2>留言标题：<input type="text" name="title"></h2>
        <h2>留言内容：<input type="text" name="content"></h2>
        <h2>留言作者：<input type="text" name="auther"></h2>
        <h2>验证码：<input type="text" name="code"></h2>
        <img src="<?php echo U('index/verify');?>" onclick='this.src = this.src+"?"+Math.random();' />
        <input type="submit" name="add" value="提交修改">
</form>
</body>
</html>