<?php
namespace Home\Model;
use Think\Model;
class MessageModel extends Model{
    protected $_validate = array(
        array('content', 'require', '留言内容必须有！'), //默认情况下用正则进行验证
    );
}