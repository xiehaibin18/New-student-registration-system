<?php

/**
 * @Author: Herbin
 * @Date:   2019-06-19 16:05:21
 * @Last Modified by:   Herbin
 * @Last Modified time: 2019-06-22 18:35:51
 */
define("DEBUG_MODE", false);
function catchEntitiesFromLocation($entity, $x, $y, $radius){
	$url = "http://api.map.baidu.com/place/v2/search?ak=1A1GKEaWvKkZYDKwFI1nRaNnWhHSwtlg&output=json&query=".$entity."&page_size=5&page_num=0&scope=2&location=".$x.",".$y."&radius=".$radius."&filter=sort_name:distance";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);
	$data = json_decode($output, true);
	if ($data['status']!=0) {
		return $data['message'];
	}
	$results = $data['results'];
	if (count($results) == 0) {
		return "附近没有找到".$entity;
	}
	$shopArray = array();
	$shopArray[] = array('Title' => "附近的".$entity, "Description" => "", "PicUrl" => "", "Url" => "");
	for ($i=0; $i < 1; $i++) {
		$shopArray[] = array("Title" => "【".$results[$i]['name']."】<".$results[$i]['detail_info']['distance']."米>\n".$results[$i]['address'].(isset($results[$i]['telephone'])?"\n".$results[$i]['telephone']:""),
							 "Description" => "",
							 "PicUrl" => "",
							 "Url" => (isset($results[$i]['detail_info']['detail_url'])?($results[$i]['detail_info']['detail_url']):""));
	} 
	return $shopArray;

}