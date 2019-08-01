<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>修改数据</h1>
<form action="/lab08/index.php/Home/Index/update" method="POST">
    <?php if(is_array($dataupdate)): $i = 0; $__LIST__ = $dataupdate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h2>留言标题：<input type="text" name="title" value="<?php echo ($vo["title"]); ?>"></h2>
    <h2>留言内容：<input type="text" name="content" value="<?php echo ($vo["content"]); ?>"></h2>
    <h2>留言作者：<input type="text" name="auther" value="<?php echo ($vo["auther"]); ?>"></h2><?php endforeach; endif; else: echo "" ;endif; ?>
    <input type="submit" name="update" value="提交修改">
</form>
</body>
</html>