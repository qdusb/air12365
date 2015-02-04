<?php
function sendMessage($db,$id_array,$sms_id){

	$retval="";
	$content=$db->getTableFieldValue("sms","content","where id={$sms_id}");
	foreach($id_array as $id){
		$phone=$db->getTableFieldValue("member","phone","where id={$id}");
		if($phone){
			$retval=sendMessageAdapter($phone,$content);
			$db->insert_data("sms_log",array("sms_id"=>$sms_id,"member_id"=>$id));
		}
	}
	return $retval;
}
function sendMessageAdapter($phone,$content){
	return "ok";
}

function getCompanyAirRecordData($db,$admin_id,$admin_grade){
    $air_records=array();
    if($admin_grade==7) {
        $sql="select * from air_record where type=1 and admin_id={$admin_id} order by sortnum asc";
    }else{
        $sql="select * from air_record where type=1  order by sortnum asc";
    }
    $rst = $db->query($sql);
    while($row = $db->fetch_array($rst)){
        $ret=$db->getTableFieldValue("member","user_no","where id={$row['user_id']}");
        $row['user_no']=$ret['user_no'];
        $air_records[]=$row;
    }
    $table_trs=array("用户编号","登机人","起飞时间","到达时间","行程","票面价格","预存款","创建时间");
    $data="<table border='1' bordercolor='#999999' width='100%' bordercolor='#000000'>";
    $data.="<tr class='listHeaderTr'>";
    foreach($table_trs as $td){
        $data.=("<td>".$td."</td>");
    }
    $data.="</tr>";
    foreach($air_records as $key=>$row){
        $bg=$key%2==0?"#FFFF00":"#FFFFFF";
        $data.=("<tr bgcolor={$bg}><td>".$row['user_no']."</td><td>".$row['passenger']."</td><td>".$row["fly_date"]."</td><td>".$row["arrive_date"]."</td><td>".$row['trip']."</td><td>".$row["ticket_price"]."</td><td>".$row["deposit"]."</td><td>".$row["create_time"]."</td></tr>");
    }
    $data.="</table>";
    return $data;
}
function getAirRecordData($db,$admin_id,$admin_grade){
    $air_records=array();
    if($admin_grade==7) {
        $sql="select * from air_record where type=0 and admin_id={$admin_id} order by sortnum asc";
    }else{
        $sql="select * from air_record where type=0  order by sortnum asc";
    }
    $rst = $db->query($sql);
    while($row = $db->fetch_array($rst)){
        $ret=$db->getTableFieldValue("member","user_no","where id={$row['user_id']}");
        $row['user_no']=$ret['user_no'];
        $air_records[]=$row;
    }
    $table_trs=array("用户编号","登机人","起飞时间","到达时间","行程","票面价格","预存款","创建时间");
    $data="<table border='1' bordercolor='#999999' width='100%' bordercolor='#000000'>";
    $data.="<tr class='listHeaderTr'>";
    foreach($table_trs as $td){
        $data.=("<td>".$td."</td>");
    }
    $data.="</tr>";
    foreach($air_records as $key=>$row){
        $bg=$key%2==0?"#FFFF00":"#FFFFFF";
        $data.=("<tr bgcolor={$bg}><td>".$row['user_no']."</td><td>".$row['passenger']."</td><td>".$row["fly_date"]."</td><td>".$row["arrive_date"]."</td><td>".$row['trip']."</td><td>".$row["ticket_price"]."</td><td>".$row["deposit"]."</td><td>".$row["create_time"]."</td></tr>");
    }
    $data.="</table>";
    return $data;
}
function getPersonalMemberData($db,$admin_id,$admin_grade){
	$docu_types=array("身份证","军官证","护照","港澳通行证","入台证");
	$levels=array("VIP会员","钻石会员");
	$personal_datas=array();
	if($admin_grade==7){
		$sql = "select * from member where user_type=0 and admin_id={$admin_id} order by sortnum asc";
	}else{
		$sql = "select * from member where user_type=0 order by sortnum asc";
	}
	$rst = $db->query($sql);
	while($row = $db->fetch_array($rst)){
		$personal_datas[]=$row;
	}

	$data="<table border='1' bordercolor='#999999' width='100%' bordercolor='#000000'>";
	$data.=("<tr class='listHeaderTr'><td width='10%'>用户名</td><td width='15%'>会员级别</td><td width='10%'>会员编号</td><td width='10%'>会员姓名</td>".
		"<td width='10%'>证件类型</td><td width='10%'>证件编号</td><td width='10%'>手机号</td><td width='15%'>工作单位</td><td>创建时间</td></tr>");
	foreach($personal_datas as $key=>$row){
		$vip=$levels[$row['level']];
		$docu=$docu_types[intval($row["docu_type"])];
		$bg=$key%2==0?"#FFFF00":"#FFFFFF";
		$data.=("<tr bgcolor={$bg}><td>".$row['user']."</td><td>".$vip."</td><td>".$row["user_no"]."</td><td>".$row["name"]."</td><td>".$docu."</td><td>".$row["docu_no"]."</td><td>".$row["phone"]."</td><td>".$row["company"]."</td><td>".$row["create_time"]."</td></tr>");
	}
	$data.="</table>";
	return $data;
}
function getCompanyMemberData($db,$admin_id,$admin_grade){
	$personal_datas=array();
	if($admin_grade==7){
		$sql = "select * from member where user_type=1 and admin_id={$admin_id} order by sortnum asc";
	}else{
		$sql = "select * from member where user_type=1 order by sortnum asc";
	}
	$rst = $db->query($sql);
	while($row = $db->fetch_array($rst)){
		$personal_datas[]=$row;
	}

	$data="<table border='1' bordercolor='#999999' width='100%' bordercolor='#000000'>";
	$data.=("<tr class='listHeaderTr'><td width='10%'>用户名</td><td width='15%'>会员级别</td><td width='10%'>会员编号</td><td width='10%'>会员姓名</td>".
		"<td width='10%'>证件类型</td><td width='10%'>证件编号</td><td width='10%'>手机号</td><td width='15%'>工作单位</td><td>创建时间</td></tr>");
	foreach($personal_datas as $key=>$row){
		$vip=$levels[$row['level']];
		$docu=$docu_types[intval($row["docu_type"])];
		$bg=$key%2==0?"#FFFF00":"#FFFFFF";
		$data.=("<tr bgcolor={$bg}><td>".$row['user']."</td><td>".$vip."</td><td>".$row["user_no"]."</td><td>".$row["name"]."</td><td>".$docu."</td><td>".$row["docu_no"]."</td><td>".$row["phone"]."</td><td>".$row["company"]."</td><td>".$row["create_time"]."</td></tr>");
	}
	$data.="</table>";
	return $data;
}
function getCompanyNo($db){
	$num=(string)rand(0,999);
	$len=strlen($num);
	for($i=0;$i<3-$len;$i++){
		$num="0".$num;
	}
	$user_no="xc999".$num."888";
	$cnt=$db->getCount("member","user_no='{$user_no}'");
	while($cnt>0){
		$user_no=getCompanyNo();
		$cnt=$db->getCount("member","user_no='{$user_no}'");
	}
	return $user_no;
}
function getDiamondNo($db){
	$num=(string)rand(1,999);
	while($num=="888")$num=(string)rand(1,999);
	$len=strlen($num);
	for($i=0;$i<6-$len;$i++){
		$num="0".$num;
	}
	$user_no="xc999".$num;
	$cnt=$db->getCount("member","user_no='{$user_no}'");
	while($cnt>0){
		$user_no=getDiamondNo();
		$cnt=$db->getCount("member","user_no='{$user_no}'");
	}
	return $user_no;
}

function getVipNo($db){
	$num=(string)mt_rand(1000,999999);
	
	while($num=="888")$num=(string)mt_rand(1,999999);
	$len=strlen($num);
	for($i=0;$i<6-$len;$i++){
		$num="0".$num;
	}
	$user_no="xc999".$num;
	
	$cnt=$db->getCount("member","user_no='{$user_no}'");
	while($cnt>0){
		$user_no=getVipNo();
		$cnt=$db->getCount("member","user_no='{$user_no}'");
	}
	return $user_no;
}

/*
 *	得到当前的时间，精确到百万分之一秒
*/
function getMicroTime()
{
	list($a, $b) = explode(" ", microtime());

	return (double)$b + (double)$a;
}

/*
 *	得到指定文件的扩展名
*/
function getFileExt($filename = "")
{
	$dot = strrpos($filename, ".");
	return substr($filename, $dot + 1);
}

/*
 *	利用UNIX时间戳返回一个唯一的文件名，不含后缀
*/
function getTmpName()
{
	list($a, $b) = explode(" ", microtime());
	return (string)$b . (string)substr($a, 2);
}


/*
 *	根据大图片，自动生成压缩小图片
*/
function makeSmallImage($image, $small_image, $small_width = 100, $small_height = 100)
{
	if (!function_exists(imageCreateFromGif))
	{
		copy($image, $small_image);
		return;
	}

	$size   = getImageSize($image);
	$width  = $size[0];
	$height = $size[1];
	$type   = $size[2];

	$width_ratio  = 1;
	$height_ratio = 1;

	if ($width > $small_width)
	{
		$width_ratio = $small_width / $width;
	}

	if ($height > $small_height)
	{
		$height_ratio = $small_height / $height;
	}


	//如果原图片的大小 小于 指定的小图片，直接拷贝并返回
	if ($width_ratio >= 1 && $height_ratio >= 1)
	{
		copy($image, $small_image);
		return;
	}

	$ratio = ($width_ratio < $height_ratio) ? $width_ratio : $height_ratio;

	$new_width  = $ratio * $width;
	$new_height = $ratio * $height;

	switch($type)
	{
		case 1: //gif -> jpg
			$im    = imageCreateFromGif($image);
			$newim = imageCreateTrueColor($new_width, $new_height);
			imageCopyResampled($newim, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imageJpeg($newim, $small_image);
			imageDestroy($newim);
			imageDestroy($im);
			break;
		case 2: //jpg -> jpg
			$im    = imageCreateFromJpeg($image);
			$newim = imageCreateTrueColor($new_width, $new_height);
			imageCopyResampled($newim, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imageJpeg($newim, $small_image);
			imageDestroy($newim);
			imageDestroy($im);
			break;
		case 3: //png -> png
			$im    = imageCreateFromPng($image);
			$newim = imageCreateTrueColor($new_width, $new_height);
			imageCopyResampled($newim, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagePng($newim, $small_image);
			imageDestroy($newim);
			imageDestroy($im);
			break;
		default:
			copy($image, $small_image);
			break;
	}

	return;
}


/*
 *	根据给定的数值，返回格式化的字符串，专门针对磁盘空间大小。
*/
function formatSizeStr($size, $fix = 2)
{
	if ($size < 1024) return round($size, $fix) . " Byte";
	if ($size < 1024 * 1024) return round($size / 1024, $fix) . " KB";
	if ($size < 1024 * 1024 * 1024) return round($size / 1024 / 1024, $fix) . " MB";

}


/*
 *	目录拷贝（包括子目录及其中的所有文件）
 *	$dir_s原目录，$dir_d目标目录
*/
function copyTree($dir_s, $dir_d)
{
	if (!is_dir($dir_s)) return false;

	if (!is_dir($dir_d))
	{
		if (!mkdir($dir_d, 0777))
		{
			return false;
		}
	}


	if ($dir_s[strlen($dir_s) - 1] != DIRECTORY_SEPARATOR) $dir_s .= DIRECTORY_SEPARATOR;
	if ($dir_d[strlen($dir_d) - 1] != DIRECTORY_SEPARATOR) $dir_d .= DIRECTORY_SEPARATOR;

	$handle = opendir($dir_s);

	while (($filename = readdir($handle)) !== false )
	{
		if ($filename != "." && $filename != "..")
		{
			if (is_dir($dir_s . $filename) && !is_link($dir_s . $filename))
			{
				copyTree($dir_s . $filename, $dir_d . $filename);
			}
			else
			{
				copy($dir_s . $filename, $dir_d . $filename);
			}
		}
	}

	closedir($handle);


	return true;
}



/*
 *	统计目录的占用空间，包括下级子目录
 *	$dir目录
*/
function getTreeSize($dir)
{
	if (!is_dir($dir)) return false;

	if ($dir[strlen($dir) - 1] != DIRECTORY_SEPARATOR) $dir .= DIRECTORY_SEPARATOR;

	$size = 0;

	$handle = opendir($dir);

	while (($filename = readdir($handle)) !== false )
	{
		if ($filename != "." && $filename != "..")
		{
			if (is_dir($dir . $filename) && !is_link($dir . $filename))
			{
				$size += getTreeSize($dir . $filename);
			}
			else
			{
				$size += filesize($directory . $file);
			}
		}
	}

	closedir($handle);


	return $size;
}

//大小转换
function reSizeBytes($size)
{
   $count	= 0;
   $format	= array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

   while (($size / 1024) > 1 && $count < 8)
   {
	   $size = $size / 1024;
	   $count++;
   }

   if ($count < 2)
	   return number_format($size, 0) . " " . $format[$count];
   else
	   return number_format($size, 1) . " " . $format[$count];
}

//根据给定的图片（或Flash）文件名，返回显示代码
//@param: filename, 文件名
//@width, height: 图片或动画文件的宽度、高度。
//@url: 图片文件的链接地址，注意仅对图片文件有效。
function adver($filename, $width, $height, $url)
{
	$ext = getFileExt($filename);
	$str = "";

	if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" || $ext == "bmp")
	{
		$str = "<img src='" . $filename . "' width='" . $width . "' height='" . $height . "' border='0' />";

		if (!empty($url)) $str = "<a href='" . $url . "' target='_blank'>" . $str . "</a>";
	}
	elseif ($ext == "swf")
	{
		$str = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='" . $width . "' height='" . $height . "'>";
		$str .= "<param name='movie' value='" . $filename . "'>";
		$str .= "<param name='quality' value='high'>";
		$str .= "<param name='wmode' value='transparent'>" ;
		$str .= "<embed src='" . $filename . "' width='" . $width . "' height='" . $height . "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' wmode='transparent'></embed>";
		$str .= "</object>";
	}

	return $str;
}
/*
 *	中文字符串截取函数
*/
function csubstr($str, $len)
{
	$chinese = 0;

	if (strlen($str) < $len) return $str;

	for ($i=0; $i < $len; $i++)
	{
		if (ord($str[$i]) >= 0xA1) $chinese++;
	}

	if ($chinese % 2 == 1) $len--;

	return substr($str, 0, $len) . "..";
}

//截取utf8字符串
function utf8substr($str, $len, $from = 0)
{
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', '$1',$str);
}

/*
 *	替换字符串中的回车换行符号
 *	$str: 需要替换的字符串
*/
function nlToBr($str)
{
	if (!$str) return "";

	if (strstr($str, "<table"))
	{
		return $str;
	}
	else
	{
		return nl2br($str) . "<br>";
	}
}
/*
 *	计算指定时间到目前的差值
 *	$date: 需要计算的时间
*/
function datePass($date)
{
	if (!$date) return 0;

	return floor((time() - mktime(0, 0, 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4))) / 3600 / 24);
}


/*
 *	显示错误信息
*/
function info($msg, $url = "javascript:history.back();")
{
	header("location: info.php?msg=" . urlencode($msg) . "&url=" . urlencode($url));
	exit();
}

/*
 *	判断分类ID是否合法
 *	$id为待检查的id
 *	$min_level为最小分类层次,默认为1(为0即可为空)
 *	$max_level为最大分类层次,默认为5
*/
function checkInfoClassId($id, $min_level = 1, $max_level = 5)
{
	return preg_match("/^([1-9]\d{2}){" . $min_level . "," . $max_level . "}$/", $id);
}

/*
 *	前台判断GET id是否合法
 *	$baseID	一级分类ID
 *	$classID	待检查的ID
 *	$level	分类级数
 *	$maxLevel	最大分类级数,这样可以实现在某个范围内
*/
function checkGetClassID($baseID, $classID, $level = 2, $maxLevel = 0)
{
	if ($maxLevel <= $level)
	{
		return preg_match("/^" . $baseID . "([1-9][0-9][0-9]){" . ($level - 1) . "}$/", $classID);
	}
	else
	{
		return preg_match("/^" . $baseID . "([1-9][0-9][0-9]){" . ($level - 1) . "," . ($maxLevel - 1) . "}$/", $classID);
	}
}
function js_unescape($str)
{
		$ret = '';
		$len = strlen($str);

		for ($i = 0; $i < $len; $i++)
		{
				if ($str[$i] == '%' && $str[$i+1] == 'u')
				{
						$val = hexdec(substr($str, $i+2, 4));

						if ($val < 0x7f) $ret .= chr($val);
						else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
						else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));

						$i += 5;
				}
				else if ($str[$i] == '%')
				{
						$ret .= urldecode(substr($str, $i, 3));
						$i += 2;
				}
				else $ret .= $str[$i];
		}
		return $ret;
}
/*
 *	判断分类ID是否合法
 *	$id为待检查的id
 *	$level为分类层次
*/
function checkClassID($classID, $level)
{
	return preg_match("/^([1-9][0-9]{" . (CLASS_LENGTH - 1) . "}){" . $level . "}$/", $classID);
}

/*
 *	获取分类组信息
*/
function classGroup($classID)
{
	$num = (strlen($classID) - 3) / 3;

	for ($i = 0; $i < $num; $i++)
	{
		$result[] = substr($classID, 0, 6 + $i * 3);
	}

	return $result;
}

function classGroupArray($classGroup, $array)
{
	foreach ($classGroup as $value)
	{
		foreach ($array as $k => $v)
		{
			if ($value == $v["id"])
			{
				$result[$v["id"]] = $v["name"];
				continue;
			}
		}
	}

	return $result;
}

/*
 *	格式化时间
*/
function formatDate($ymd, $date)
{
	$date = strtotime($date) ? strtotime($date) : $date;
	return date($ymd, $date);
}

/*
 *	数组中是否包含$x
 *	包含，返回 True 不包含，返回False
*/
function hasInclude($array, $x)
{
	if (!is_array($array))
	{
		$array = array($array);
	}

	$has = false;

	foreach ($array as $value)
	{
		if ($x == $value)
		{
			$has = true;
			break;
		}
	}

	return $has;
}

/*
 *	menu 权限 $x
 *	包含，返回 True 不包含，返回False
*/
function hasBegin4Include($array, $x)
{
	if (!is_array($array))
	{
		$array = array($array);
	}

	$has = false;

	foreach ($array as $value)
	{
		if (substr($value, 0, 4) == $x)
		{
			$has = true;
			break;
		}
	}

	return $has;
}

/*
 *	功能：删除单个文件
 *	1 文件是相对路径
 *	2 文件是绝对路径
*/
function deleteFile($file, $x = 1)
{
	if (empty($file))
	{
		return;
	}

	if ($x == 2)
	{
		$file = $_SERVER["DOCUMENT_ROOT"] . $file;
	}
	else
	{
		$file = UPLOAD_PATH_FOR_ADMIN . $file;
	}

	if (file_exists($file))
	{
		@unlink($file);
	}
}

/*
 *	功能：删除多个文件
 *	1 文件是相对路径
 *	2 文件是绝对路径
 *	多个文件间以逗号“,”隔开
*/
function deleteFiles($file, $x = 1)
{
	if (empty($file))
	{
		return;
	}

	if (is_string($file))
	{
		$file = split(",", $file);
	}

	if (is_array($file))
	{
		if ($x == 2)
		{
			$root_path 	= $_SERVER["DOCUMENT_ROOT"];
		}
		else
		{
			$root_path 	= UPLOAD_PATH_FOR_ADMIN;
		}

		foreach($file as $value)
		{
			if ($value != "" && file_exists($root_path . $value))
			{
				@unlink($root_path . $value);
			}
		}
	}
}

/*
 *	多级分类返回下拉选项
 *	$array 分类数组，一定要包含id, name
 *	$currentID 被选中的项ID的值
 *	$func 对name操作的函数
*/
function optionTree($array, $currentID, $func = NULL)
{
	if (!is_array($array)) return NULL;
	$listStr = NULL;

	for ($i = 0, $cnt = count($array); $i < $cnt; $i++)
	{
		if ($i == 0) $fLen = strlen($array[$i]["id"]);

		if ($currentID === $array[$i]["id"])
		{
			$listStr .= "<option value='" . $array[$i]["id"] . "' selected>";
		}
		else
		{
			$listStr .= "<option value='" . $array[$i]["id"] . "'>";
		}

		$listStr .= str_repeat("&nbsp", ((strlen($array[$i]["id"]) - $fLen) / 3) * 2)
		. "|- "
		. (($func && function_exists($func)) ? call_user_func($func, $array[$i]) : $array[$i]["name"])
		. "</option>\n";
	}
	return $listStr;
}
/*
 *	多级分类返回下拉选项
 *	$array 分类数组，一定要包含id, name 切经过getNodeData函数处理过的数组
 *	$currentID 被选中的项ID的值
 *	$func 对name操作的函数
 *	$floor 无需人工指定，程序自动处理
*/
function optionsTree($array, $currentID, $func = NULL, $floor = 0)
{
	if (!is_array($array)) return NULL;
	$listStr = NULL;
	for ($i = 0, $cnt = count($array); $i < $cnt; $i++)
	{
		if ($currentID === $array[$i]["id"])
		{
			$listStr .= "<option value='" . $array[$i]["id"] . "' selected>";
		}
		else
		{
			$listStr .= "<option value='" . $array[$i]["id"] . "'>";
		}

		$listStr .= str_repeat("&nbsp", $floor * 2)
		. "|- "
		. (($func && function_exists($func)) ? call_user_func($func, $array[$i]) : $array[$i]["name"])
		. "</option>\n";

		if ($array[$i]["child"]) $listStr .= optionsTree($array[$i]["child"],  $currentID, $func = NULL, $floor + 1);
	}
	return $listStr;
}

/*
 *	分类从数据库中按 sortnum ASC排序查询后，递归生成兄弟双亲法表示的数组
 *	$parentID 父ID 可为空，为空即为第一级
 *	$len 多少位为一级 比如 3   101102
*/
function getNodeData($array, $parentID, $len)
{
	$arr = array();
	$arrCount = 0;

	for ($i = 0, $cnt = count($array); $i < $cnt; $i++)
	{
		if (substr($array[$i]["id"], 0, strlen($array[$i]["id"]) - $len) === $parentID)
		{
			$arr[$arrCount] = $array[$i];
			$arr[$arrCount++]["child"] = getNodeData($array, $array[$i]["id"], $len);
		}
	}

	return $arr;
}

//获取文件大小
function getFileSize($file)
{
	if (!empty($file))
	{
		$size = filesize($file);

		return reSizeBytes($size);
	}

	return "0 KB";
}
function getInfoArray($db,$condition)
{
	$sql = "select * from info where $condition";
	$rst = $db->query($sql);
	$info=array();
	while($row = $db->fetch_array($rst))
	{
		$info[]=$row;
	}
	return $info;
}
function get_class_state($db,$class_id)
{
	$sql = "select info_state from info_class where id=$class_id";
	$rst = $db->query($sql);
	if($row = $db->fetch_array($rst))
	{
		return $row["info_state"];
	}
}

function getImgUrl($str,$num = 1)
{
    $reg = '/<img(.*?)src=(.*?)\/?>/i';
    preg_match_all($reg,$str,$imgList);

     if(!empty($imgList))
     {
        if(isset($imgList[0][$num-1]))
        {
            $img = $imgList[0][$num-1];
            preg_match('/src=(.*?)\.\w{3,4}/i',$img,$url);
            $rep = array('src="',"src='",'src=');
            if(!empty($url))
			{
               return str_replace($rep,'',$url[0]);
			}
            else
			{
                return '';
			}
        }
        else
            return '';
     }
     else
        return '';
}

?>
