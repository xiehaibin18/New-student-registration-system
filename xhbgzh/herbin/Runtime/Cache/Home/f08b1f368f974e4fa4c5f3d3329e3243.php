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
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<fieldset>
    <form action="/lab08/index.php/Home/Index/DataShow" method="POST">
    <span>排序</span>
        <select name="order">
            <option value="id">请选择关键字</option>
            <option value="id">id</option>
            <option value="title">title</option>
            <option value="content">content</option>
            <option value="auther">auther</option>
            <option value="time">time</option>
        </select>
        <input type="submit" name="ordersubmit" value="排序">
        <button><a href="/lab08/index.php/Home/Index/DataAdd">新增留言</a></button>
    </form>
</fieldset>
<fieldset>
    <form action="/lab08/index.php/Home/Index/DataShow" method="POST">
        <span>查询</span>
        <select name="found">
            <option value="">请选择关键字</option>
            <option value="id">id</option>
            <option value="title">title</option>
            <option value="content">content</option>
            <option value="auther">auther</option>
            <option value="time">time</option>
        </select>
        <input type="text" name="foundtext">
        <input type="submit" name="foundsubmit" value="查询">
    </form>
</fieldset>
<table border="1">
    <tr>
        <td>留言id</td>
        <td>留言标题</td>
        <td>留言内容</td>
        <td>留言作者</td>
        <td>留言时间</td>
        <td>删除</td>
        <td>修改</td>
    </tr>
    <?php if(is_array($datashow)): $i = 0; $__LIST__ = $datashow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["id"]); ?></td>
            <td><?php echo ($vo["title"]); ?></td>
            <td><?php echo ($vo["content"]); ?></td>
            <td><?php echo ($vo["auther"]); ?></td>
            <td><?php echo ($vo["time"]); ?></td>
            <td><a href="/lab08/index.php/Home/Index/del?id=<?php echo ($vo["id"]); ?>">删除</a></td>
            <td><a href="/lab08/index.php/Home/Index/DataUpdate?id=<?php echo ($vo["id"]); ?>">修改</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<p>
    <?php echo ($page); ?>
</p>
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