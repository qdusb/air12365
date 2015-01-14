<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");


$id			= (int)$_GET["id"];
$clear_id	= (int)$_GET["clear_id"];


$listUrl = "admin_list.php";
$editUrl = "admin_edit.php";

$grades=array("8"=>"<font color='#FF6600'>系统管理员</font>","7"=>"<font color='#0066FF'>分销商管理员</font>");

//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);


//删除  admin 不可删除
if ($id > 1)
{
	if ($db->getCount("info", "admin_id=$id") > 0)
	{
		$db->close();
		info("该管理员已发表过信息，不允许删除！");
	}
	
	//事务开始
	$db->query("begin");
	
	//删除登陆日志
	$sql = "delete from admin_login where admin_id=$id";
	if (!$db->query($sql))
	{
		$db->query("rollback");
		$db->close();
		info("删除管理员失败！");
	}
	
	//删除分类栏目权限
	$sql = "delete from admin_popedom where admin_id=$id";
	if (!$db->query($sql))
	{
		$db->query("rollback");
		$db->close();
		info("删除管理员失败！");
	}
	
	//删除高级管理权限
	$sql = "delete from admin_advanced where admin_id=$id";
	if (!$db->query($sql))
	{
		$db->query("rollback");
		$db->close();
		info("删除管理员失败！");
	}
	
	//删除管理员
	$sql = "delete from admin where id=$id";
	if ($db->query($sql))
	{
		$db->query("commit");
		$db->close();
		header("Location: $listUrl");
		exit();
	}
	else
	{
		$db->query("rollback");
		$db->close();
		info("删除管理员失败！");
	}
}

//清空日志
if ($clear_id > 0)
{
	$db->query("begin");
	
	$sql= "delete from admin_login where admin_id=$clear_id";
	$rst = $db->query($sql);
	if ($rst)
	{
		$db->query("commit");
		$db->close();
		info("清空登录日志成功！");
	}
	else
	{
		$db->query("rollback");
		$db->close();
		info("清空登录日志失败！");
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
			function clearLogin()
			{
				if (confirm("即将清空登陆日志 , 且该操作不能恢复! 是否继续 ?"))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		</script>
	</head>
	<body>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr class="position">
				<td class="position">当前位置: 管理中心 -&gt; 系统管理 -&gt; 系统管理员</td>
			</tr>
		</table>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr height="30">
				<td>
					<a href="<?php echo $listUrl?>">[刷新列表]</a>
					<a href="<?php echo $editUrl?>">[增加]</a>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="listTable">
			<tr class="listHeaderTr">
				<td>登陆帐号</td>
				<td width="30%">真实姓名</td>
				<td width="12%">管理等级</td>
				<td width="8%">登陆次数</td>
				<td width="12%">登陆日志</td>
				<td width="8%">状态</td>
				<td width="8%">删除</td>
			</tr>
			<?php
			$sql = "select id, name, realname, grade, login_count, state from admin order by id asc";
			$rst = $db->query($sql);
			while ($row = $db->fetch_array($rst))
			{
				$css = ($css == "listTr") ? "listAlternatingTr" : "listTr";
			?>
				<tr class="<?php echo $css?>">
					<td><a href="<?php echo $editUrl?>?id=<?php echo $row["id"]?>"><?php echo $row["name"]?></a></td>
					<td><?php echo $row["realname"]?></td>
					<td>
						<?php echo $grades[$row["grade"]];?>
					</td>
					<td><?php echo $row["login_count"]?></td>
					<td><a href="admin_login_list.php?id=<?php echo $row["id"]?>">查看日志</a>&nbsp;&nbsp;<a href="<?php echo $listUrl?>?clear_id=<?php echo $row["id"]?>" onClick="return clearLogin()">清空</a></td>
					<td><?php echo ($row["state"] == 1) ? "正常" : "<font color='#FF6600'>锁定</font>"?></td>
					<td><a href="<?php echo $listUrl?>?id=<?php echo $row["id"]?>" onClick="return del();">删除</a></td>
				</tr>
			<?php
			}
			?>
			<tr class="listFooterTr">
				<td colspan="10"></td>
			</tr>
		</table>
		<?php
		$db->close();
		?>
	</body>
</html>
