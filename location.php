<?php

/**
 * @Author: Herbin
 * @Date:   2019-06-19 15:52:46
 * @Last Modified by:   Herbin
 * @Last Modified time: 2019-06-21 21:54:48
 */
//缓存用户地理位置
function setLocation($openid, $locationX, $locationY){
	$mmc = memcache_init();
	if ($mmc == true) {
		$location = array("locationX" => $locationX, "locationY" => $locationY);
		memcache_set($mmc, $openid, json_encode($location), 60);
		return "您的位置已缓存，接下来尝试一下发送“附近酒店”或“附近银行”等吧。";
	}else{
		return "缓存失败，请检查服务器。";
	}
}
//通过缓存获取用户地理位置信息。
function getLocation($openid){
	$mmc = memcache_init();
	if ($mmc == true) {
		$location = memcache_get($mmc, $openid);
		if (!empty($location)) {
			return json_decode($location, true);
		}else{
			return "请发送您的地理位置。";
		}
	}else{
		return "获取缓存失败，请检查服务器。";
	}
}