<?php
/**
 * Created by PhpStorm.
 * User: Herbin
 * Date: 2019/5/29
 * Time: 15:50
 */
//通过代码实现自定义菜单的创建
//appid
$appid = "wxbcfa6f6a2b9e8c58";
//appsecret
$appsecret = "937c1f53d627c689b6f14223c1d02b1e";
//获取token
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$output = https_request($url);
$jsoninfo = json_decode($output, true);
$access_token = $jsoninfo["access_token"];
//自定义json格式菜单内容
$jsonmenu = '{
    "button": [
        {
            "name": "自助报道",
            "sub_button": [
                {
                    "type": "view",
                    "name": "在线缴费",
                    "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkTuitionOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
                },
                {
                    "type": "view",
                    "name": "办理一卡通",
                    "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkStucardOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
                },
                {
                    "type": "view",
                    "name": "申请宿舍",
                    "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkSturoomOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
                },
                {
                    "type": "view",
                    "name": "选购军训服",
                    "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkJunfuOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
                },
                {
                    "type": "view",
                    "name": "打印报道单",
                    "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkStuallOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
                }
            ]
        },
        {
            "name": "迎新服务",
            "sub_button": [
                {
                    "type": "click",
                    "name": "报道流程",
                    "key": "process"
                },
                {
                    "type": "click",
                    "name": "交通指引",
                    "key": "traffic"
                },
                {
                    "type": "view",
                    "name": "志愿者服务",
                    "url": "http://m.hao123.com/a/tianqi"
                },
                {
                    "type": "click",
                    "name": "系部咨询位置",
                    "key": "consulting location"
                }
            ]
        }
    ]
}';
//创建菜单实现
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);
//自定义CURL会话创建菜单
function https_request($url, $data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if(!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
?>