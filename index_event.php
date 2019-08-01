<?php
/**
 * Created by PhpStorm.
 * User: Herbin
 * Date: 2019/5/29
 * Time: 16:19
 */
//在消息接口中处理event事件,其中的click代表菜单点击,通过响应菜单结构中的key值回应消息，view事件无须响应，将直接跳转过去。
define("TOKEN", "xhbgzh");
$wechatObj = new wechatCallbackapiTest();
if(!isset($_GET['echostr'])){
    $wechatObj->responseMsg();
}else{
    $wechatObj->valid();
}//介入校验
class wechatCallbackapiTest
{
    public function valid()
    {
        $echostr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echostr;
            exit;
        }
    }

    //签名校验实现
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);

        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
    //业务实现
    public function responseMsg(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if(!empty($postStr)){
            // $this ->logger("R".$postStr);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            switch($RX_TYPE){
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
            }
            // $this -> logger("T".$resultStr)
            echo $result;
        }else{
            echo "";
            exit;
        }
    }
    private function receiveText($object){
        $keyword = trim($object -> Content);
        $category = substr($keyword, 0, 6);
        $entity = trim(substr($keyword, 6, strlen($keyword)));
        switch ($category) {
            case '附近':
                include("location.php");
                $location = getLocation($object -> FromUserName);
                if (is_array($location)) {
                    include("mapbaidu.php");
                    $content = catchEntitiesFromLocation($entity, $location["locationX"], $location["locationY"], "5000");
                }else{
                    $content = $location;
                }
                break;
            
            default:
                $content = '试试发送你的地址后输入“附近+XX”实现查找附近地点功能哦';
                break;
        }
        if (is_array($content)) {
            $result = $this -> transmitNews($object, $content);
        }else{
            $result = $this -> transmitText($object, $content);
        }
        return $result;
    }
    //处理接收事件
    private function receiveEvent($object){
        $content = "";
        switch($object->Event){
            //关注事件
            case "subscribe":
                $content="Hey,new guy!欢迎来到华软，快开始你的大学生活吧~
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkLoginOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>点击这里登陆</a>
			根据你的录取通知书绑定你的个人信息吧
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkGetinfoOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>点击这里绑定个人信息</a>
			发送你的地址可以实现查找附近地点功能哦";
            //取消关注事件
            case "unsubscribe":
                break;
            case "SCAN":
                $content = "扫描二维码场景".$object->EventKey;
            break;
                //click事件
			case "CLICK":
			switch($object->EventKey){
                    //EventKey值
				case "process":
				$content = "建议报道流程
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkLoginOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>1.点击这里登陆</a>
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkGetinfoOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>2.点击这里绑定个人信息</a>
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkTuitionOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>3.点击这里在线缴费</a>
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkStucardOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>4.点击这里办理一卡通</a>
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkSturoomOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>5.点击这里申请宿舍</a>
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkJunfuOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>6.点击这里选购军服</a>
			<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/ChkStuallOpenid&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect'>7.点击这里打印报告单</a>";
				break;
                    //EventKey值
				case "traffic":
				$content[] = array("Title"=>"交通指引",
					"Description"=>"",
					"PicUrl"=>"http://2.xhbgzh.applinzi.com/xhbgzh_img/8f91814b0eadc3475bffbe5c0f02418.jpg",
					"Url"=>"https://mp.weixin.qq.com/s/F6nAZ_xvenZ_X2S-o7FVHg");
				break;
				case 'consulting location':
					$content = "a86FE7PdG4vQKIG-UUtAQjp8Tr8QToACsd4ftRTEmJfTVfDKYxR-zWyZYhKfoAi6";
					$result = $this->transmitImage($object, $content);
					return $result;
					break;
                    //其他没有处理的click菜单的默认回复
				default:
				$content[] = array("Title"=>"error",
					"Description"=>"error",
					"PicUrl"=>"http://discuz.comli.com/weixin/wechat/icon/cartoon.jpg",
					"Url"=>"http://2.xhbgzh.applinzi.com/error.php");
			}
			break;
            default:
                break;
        }
		if(is_array($content)){
			$result = $this->transmitNews($object, $content);
		}else{
        	$result = $this->transmitText($object, $content);
		}
        return $result;
    }
    //接受位置消息
    private function receiveLocation($object){
        include("location.php");
        $content = setLocation($object -> FromUserName, (string)$object -> Location_X, (string)$object -> Location_Y);
        $result = $this -> transmitText($object, $content);
        return $result;
    }
    //文本消息回复
    private function transmitText($object, $content){
        $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                    </xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
    //图文消息回复
    private function transmitNews($object, $arr_item){
        if(!is_array($arr_item))
            return;
        $itemTpl = "<item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                    </item>";
        $ite_str = "";
         foreach($arr_item as $item)
            $item_str = sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        $newTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[news]]></MsgType>
                        <Content><![CDATA[]]></Content>
                        <ArticleCount>%s</ArticleCount>
                        <Articles>$item_str</Articles>
                    </xml>";
        $result = sprintf($newTpl, $object->FromUserName, $object->ToUserName, time(), 1);
        return $result;
    }
    //图消息回复
    private function transmitImage($object, $content){
        $imgTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Image><MediaId><![CDATA[%s]]></MediaId></Image>
					</xml>";
        $result = sprintf($imgTpl, $object->FromUserName, $object->ToUserName, "1561396006", "image",$content);
        return $result;
    }
    
    //debug函数
}
?>