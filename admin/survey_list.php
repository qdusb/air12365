<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");


//高级管理权限
if ($session_admin_grade != ADMIN_HIDDEN && $session_admin_grade != ADMIN_SYSTEM && hasInclude($session_admin_advanced, SURVEY) == false)
{
	info("没有权限！");
}


$id		= trim($_GET["id"]);
$page	= (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;


$listUrl = "survey_list.php?page=$page";
$viewUrl = "survey_view.php?page=$page";


//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);
//删除
if ($id != "")
{
	$sql = "delete from survey where id='$id'";
	$rst = $db->query($sql);
	$db->close();
	if ($rst)
	{
		header("Location: $listUrl");
		exit;
	}
	else
	{
		info("删除信息失败！");
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
	</head>
	<body>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr class="position">
				<td class="position">当前位置: 管理中心 -&gt; 高级管理 -&gt; 在线调查</td>
			</tr>
		</table>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr height="30">
				<td>
					<a href="<?php echo $listUrl?>">[刷新列表]</a>&nbsp;
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="listTable">
			<form name="form1" action="" method="post">
				<tr class="listHeaderTr">
					<td>序号</td>
					<td>姓名</td>
					<td>性别</td>
					<td>联系电话</td>
					<td>电子邮件 </td>
					<td>提交时间 </td>
					<td>状态</td>
					<td>删除</td>
				</tr>
				<?php
				$page_size = DEFAULT_PAGE_SIZE;
				//总记录数
				$sql = "select count(*) as cnt from survey";
				$rst = $db->query($sql);
				$row = $db->fetch_array($rst);
				$record_count = $row["cnt"];
				$page_count = ceil($record_count / $page_size);
				//分页
				$page_str		= page($page, $page_count);
				//列表
				$sql = "select * from survey order by sortnum desc";
				$sql .= " limit " . ($page - 1) * $page_size . ", " . $page_size;
				$rst = $db->query($sql);
				while ($row = $db->fetch_array($rst))
				{
					$css = ($css == "listTr") ? "listAlternatingTr" : "listTr";
				?>
					<tr class="<?php echo $css?>">
						<td><?php echo $row["sortnum"]?></td>
						<td><a href="<?php echo $viewUrl?>&id=<?php echo $row["id"]?>"><?php echo $row["name"]?></a></td>
						<td><?php echo $row["sex"]?></td>
						<td><?php echo $row["phone"]?></td>
						<td><?php echo $row["email"]?></td>
						<td><?php echo formatDate("Y-m-d", $row["create_time"])?></td>
						<td>
							<?php
							switch ($row["state"])
							{
							case 0:
								echo "<font color='#FF6600'>未查看</font>";
								break;
							case 1:
								echo "<font color='#0066FF'>已查看</font>";
								break;
							default:
								echo "<font color='#FF0000'>错误</font>";
								break;
							}
							?>
						<td><a href="<?php echo $listUrl?>&id=<?php echo $row["id"]?>" onClick="return del();">删除</a></td>
					</tr>
				<?php
				}
				?>
				<tr class="listFooterTr">
					<td colspan="10"><?php echo $page_str?></td>
				</tr>
			</form>
		</table>
		<?php
		$db->close();
		?>
	</body>
</html>
