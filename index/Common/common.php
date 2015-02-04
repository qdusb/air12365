<?php
/*
author reevesc cui
*/


function sendMessageAdapter($phone,$content){
	return "ok";
}

function getMemberNo($type)
{
	if($type==0){
		return getVipNo();
	}else{
		return getCompanyNo();
	}
}
function getCompanyNo(){

	$num=(string)rand(0,999);
	$len=strlen($num);
	for($i=0;$i<3-$len;$i++){
		$num="0".$num;
	}
	$user_no="xc999".$num."888";
	$retval=M("member")->where("user_no='{$user_no}'")->find();
	while(!empty($retval)){
		$user_no=getCompanyNo();
		$retval=M("member")->where("user_no='{$user_no}'")->find();
	}
	return $user_no;
}

function getDiamondNo(){
	$num=(string)rand(1,999);
	while($num=="888")$num=(string)rand(1,999);
	$len=strlen($num);
	for($i=0;$i<6-$len;$i++){
		$num="0".$num;
	}
	$user_no="xc999".$num;
	$retval=M("member")->where("user_no='{$user_no}'")->find();
	while(!empty($retval)){
		$user_no=getDiamondNo();
		$retval=M("member")->where("user_no='{$user_no}'")->find();
	}
	return $user_no;
}
function getVipNo(){
	$num=(string)mt_rand(1000,999999);
	while($num=="888")$num=(string)mt_rand(1,999999);
	$len=strlen($num);
	for($i=0;$i<6-$len;$i++){
		$num="0".$num;
	}
	$user_no="xc999".$num;
	$retval=M("member")->where("user_no='{$user_no}'")->find();
	while(!empty($retval)){
		$user_no=getVipNo();
	}
	return $user_no;
}
function getLinkURL($class_id)
{
	$url="";
	return $url;
}
/*分页*/
function page($page_id,$page_num,$url,$params)
{
	$home_params=array_merge(array("page_id"=>1),$params);
	$home=U($url,$home_params);
	$prev_id=max(1,$page_id-1);
	$next_id=min($page_id+1,$page_num);

	$prev_params=array_merge(array("page_id"=>$prev_id),$params);
	$prev=U($url,$prev_params);

	$next_params=array_merge(array("page_id"=>$next_id),$params);
	$next=U($url,$next_params);

	$end_params=array_merge(array("page_id"=>$page_num),$params);
	$end=U($url,$home_params);

	$page=array();
	for($i=1;$i<=$page_num;$i++)
	{
		$spage_params=array_merge(array("page_id"=>$i),$params);
		$spage=array(
			"url"=>U($url,$spage_params),
			"label"=>$i
			);
		array_push($page,$spage);
	}

	$pages=array(
		"home"=>$home,
		"end"=>$end,
		"prev"=>$prev,
		"next"=>$next,
		"page_num"=>$page_num,
		"page_id"=>$page_id,
		"page"=>$page
		);
	return $pages;
}
function setClassConfig(&$s,$class_id){

}
function alert($msg,$isBack=true){
	if($isBack==true){
		echo "<script>alert('$msg');history.back(); </script>";
		exit;
	}else{
		echo "<script>alert('$msg');</script>";
	}
}
/*网站基本参数配置*/
function setBaseWebConfig()
{
	$configs=array();
	$db=M("config_base");
	$config=$db->where("id=1")->find();
	C("CONFIG_NAME",$config["name"]);
	C("CONFIG_TITLE",$config["title"]);
	C("CONFIG_ICP",$config["icp"]);
	C("CONFIG_KEYWORD",$config["keyword"]);
	C("CONFIG_DESCRIPTION",$config["description"]);
	C("CONFIG_ADDRESS",$config["address"]);
	C("CONFIG_CONTACT",$config["contact"]);
	C("CONFIG_JAVASCRIPT",$config["javascript"]);

	$ad="";
	$db=M("adver");
	$rst=$db->where("state=1")->select();
	foreach($rst as $row)
	{
		$ad_id=$row['id'];
		$title=$row['title'];
		$mode=$row['mode'];
		$ad_url=$row['url'];
		$ad_width=$row['width'];
		$ad_height=$row['height'];
		$ad_time=$row['time'];
		$ad_pic=C("UPLOAD_PATH").$row['pic'];
		$top=140;
		$left=0;
		$ad.="<script>AdPrepare(".$ad_id.",'".$title."','".$ad_url."','".$mode."','".$ad_pic."',".$ad_width.",".$ad_height.",$top,$left,'true');</script>";
	}
	C("CONFIG_AD",$ad);
}

/*
一级和二级所有栏目
主要是用于下拉的导航
*/
function getAllCategorys(){
	$categorys=array();
	$db=M("info_class");
	$navs=$db->where("id like '___'")->order("sortnum asc")->limit($limit)->select();
	foreach($navs as $key=>$nav){
		$category=array();
		$nav['pic']=C("UPLOAD_PATH").$nav['pic'];
		$category["baseNav"]=$nav;
		$base_id=$nav["id"];
		$navs[$key]['url']=getLinkURL($subNav['id']);

		$subNavs=$db->where("id like '{$base_id}___'")->order("sortnum asc")->limit($limit)->select();
		foreach($subNavs as $keys=>$subNav)
		{
			$subNavs[$keys]["url"]=getLinkURL($subNav['id']);
		}
		$category["subNav"]=$subNavs;
		$categorys[$key]=$category;
	}
	return $categorys;
}
/*
获取一级栏目
主要是用于非下拉的导航
*/
function getBaseClass($limit=8)
{
	$db=M("info_class");
	$navs=$db->where("id like '___'")->order("sortnum asc")->limit($limit)->select();
   // array_unshift($navs,array("name"=>"首页","url"=>U("Index/index")));
    foreach($navs as $key=>$nav){
    	if(empty($nav['url'])){
    		$navs[$key]['class']="n".($key+1);
    		$navs[$key]['url']=getLinkURL($nav['id']);
    	}
   }
   return $navs;
}

/*
配置网站class_id配置
比如base_id,second_id...
*/
function getClassValue($class_id)
{
	if(!empty($class_id))
	{
		$db=M("info_class");
		$row=$db->where("id={$class_id}")->select();
		if(count($row)>=1)
		{
			$row=$row[0];
			$info_state	=$row['info_state'];
			$has_sub	=$row['has_sub'];
			while($has_sub==1)
			{
				$row=$db->where("id like '{$class_id}___'")->order("sortnum asc")->select();
				if(count($row)>=1)
				{
					$row=$row[0];
					$class_id	=$row['id'];
					$info_state	=$row['info_state'];
					$has_sub	=$row['has_sub'];
				}
				else
				{
					$has_sub	=0;
				}
			}
		}
		$base_id=substr($class_id,0,3);
		$second_id=strlen($class_id)<6?"":substr($class_id,0,6);
		$third_id=strlen($class_id)<9?"":substr($class_id,0,9);
		$forth_id=strlen($class_id)<12?"":substr($class_id,0,12);

     	$arr=array(
     		"base_id"		=>$base_id,
     		"second_id"		=>$second_id,
     		"third_id"		=>$third_id,
     		"forth_id"		=>$forth_id,
     		"class_id"		=>$class_id,
     		"base_name"		=>$db->where("id=$base_id")->getfield("name"),
     		"second_name"	=>$db->where("id=$second_id")->getfield("name"),
     		"third_name"	=>$db->where("id=$third_id")->getfield("name"),
     		"forth_name"	=>$db->where("id=$forth_id")->getfield("name"),
     		"class_name"	=>$db->where("id=$class_id")->getfield("name"),
     		"info_state"	=>$info_state,
     		"base_pic"		=>C("UPLOAD_PATH").$db->where("id=$base_id")->getfield("pic"),
     		);
		return $arr;
	}
}
/*
获取所有二级栏目以及三级栏目
*/
function getSecondClasses($base_id){
	$db=M("info_class");
	$navs=array();
	$sec_navs=$db->where("id like '{$base_id}___'")->order("sortnum asc")->select();
	foreach($sec_navs as $nav){
		$sNav=array();
		$nav["url"]=getLinkURL($nav['id']);
		$sNav['second']=$nav;
		$sid=$nav["id"];
		$sNav['third']=$db->where("id like '{$sid}___'")->order("sortnum asc")->select();
		array_push($navs,$sNav);
	}
	return $navs;
}

//截取utf8字符串
function utf8substr($str, $len, $from = 0)
{
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', '$1',$str);
}
/*
截取中文字符串
*/
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
    if(function_exists("mb_substr")){
            if ($suffix && strlen($str)>$length)
                return mb_substr($str, $start, $length, $charset)."...";
        else
                 return mb_substr($str, $start, $length, $charset);
    }
    elseif(function_exists('iconv_substr')) {
            if ($suffix && strlen($str)>$length)
                return iconv_substr($str,$start,$length,$charset)."...";
        else
                return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}

//加载视频f4-player
function loadVideoSWF($width,$height,$video_src,$video_img,$auto=0)
{
	$str="<div id='player'>
		<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='$width' height='$height' id='f4Player' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'>
			<param value='public/images/player.swf' name='movie' />
			<param value='high' name='quality' />
			<param value='true' name='allowFullScreen' />
			<param value='skin=public/images/mySkin.swf&thumbnail=$video_img&video=$video_src&autoplay=$auto' name='FlashVars' />
			<embed width='$width' height='$height' type='application/x-shockwave-flash' allowfullscreen='true' flashvars='skin=public/images/mySkin.swf&thumbnail=$video_img&video=$video_src' src='public/images/player.swf' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer'></embed>
		</object>
	</div>";
	echo $str;
}
?>