<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");


//高级管理权限
if ($session_admin_grade != ADMIN_HIDDEN && $session_admin_grade != ADMIN_SYSTEM && hasInclude($session_admin_advanced, JOB_ADVANCEDID) == false)
{
	info("没有权限！");
}


$id		= (int)$_GET["id"];
$page	= (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;

$listUrl = "sms_list.php?page=$page";


//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

//提交表单
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

	$data=array(
		"sortnum"=>(int)$_POST["sortnum"],
		"state"=>(int)$_POST["state"],
		"title"=>htmlspecialchars(trim($_POST["title"])),
		"content"=>htmlspecialchars(trim($_POST["content"]))
	);
	if(empty($id)){
		$data['id']=$db->getMax("sms", "id") + 1;
		$data['create_time']=date("Y-m-d H:i:s");
		if($db->insert_data("sms",$data)){
			header("location: $listUrl");
			exit;
		}else{
			info("修改失败！");
		}
	}else{
		
		if($db->update_data("sms",$data,"id={$id}")){
			header("location: $listUrl");
			exit;
		}else{
			info("修改失败！");
		}
	}
	$rst = $db->query($sql);
	$db->close();
	header("Location: $listUrl");
}
if ($id == "")
{
	$sortnum 	= $db->getMax("sms", "sortnum") + 10;
	$state		= 1;
}
else
{
	$sql = "select * from sms where id='$id'";
	$rst = $db->query($sql);
	if ($row = $db->fetch_array($rst))
	{
		$id				= $row["id"];
		$sortnum		= $row["sortnum"];
		$state			= $row["state"];
		$title			= $row["title"];
		$content		= $row["content"];
	}
}
?>


<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="-1000">
		<link href="images/admin.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="images/common.js"></script>

		<script type="text/javascript">
			function check(form)
			{
				if (form.sortnum.value.match(/\D/))
				{
					alert("请输入合法的序号！");
					form.sortnum.focus();
					return false;
				}

				return true;
			}
		</script>
	</head>
	<body>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr class="position">
				<td class="position">当前位置: 管理中心 -&gt; 高级管理 -&gt; 短信管理</td>
			</tr>
		</table>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr height="30">
				<td>
					<a href="<?php echo $listUrl?>">[返回列表]</a>&nbsp;
				</td>
			</tr>
		</table>
		<form name="form1" action="" method="post">
			<table width="100%" border="0" cellSpacing="1" cellPadding="0" align="center" class="editTable">
				<tr class="editHeaderTr">
					<td class="editHeaderTd" colSpan="2">招聘职位</td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">序号</td>
					<td class="editRightTd"><input type="text" name="sortnum" value="<?php echo $sortnum?>" size="5" maxlength="5"></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">状态</td>
					<td class="editRightTd">
						<input type="radio" name="state" value="1"<?php if ($state == 1) echo " checked"?>>正常使用
						<input type="radio" name="state" value="0"<?php if ($state == 0) echo " checked"?>>停止使用
					</td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">短信标题</td>
					<td class="editRightTd"><input type="text" name="title" value="<?php echo $title?>" maxlength="50" size="30"></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">短信正文</td>
					<td class="editRightTd"><textarea name="content" cols="100" rows="10"><?php echo $content?></textarea>
					</td>
				</tr>
				<tr class="editFooterTr">
					<td class="editFooterTd" colSpan="2">
						<input type="submit" value=" 确 定 ">
						<input type="reset" value=" 重 填 ">
					</td>
				</tr>
			</table>
		</form>
		<?php
		$db->close();
		?>
	</body>
</html>
