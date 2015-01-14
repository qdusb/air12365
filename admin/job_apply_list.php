<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");


//高级管理权限
if ($session_admin_grade != ADMIN_HIDDEN && $session_admin_grade != ADMIN_SYSTEM && hasInclude($session_admin_advanced, JOB_APPLY_ADVANCEDID) == false)
{
	info("没有权限！");
}

$id		= trim($_GET["id"]);
$page	= (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;


$listUrl = "job_apply_list.php?page=$page";
$viewUrl = "job_apply_view.php?page=$page";


//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);


//删除
if ($id != "")
{
	$sql = "delete from job_apply where id=$id";
	$rst = $db->query($sql);
	if ($rst)
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
		info("删除职位失败！");
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
				<td class="position">当前位置: 管理中心 -&gt; 高级管理 -&gt; 应聘人员</td>
			</tr>
		</table>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr height="30">
				<td>
					<a href="<?php echo $listUrl?>">[刷新列表]</a>&nbsp;
				</td>
				<td align="right">
					<?php
					//设置每页数
					$page_size = DEFAULT_PAGE_SIZE;
					//总记录数
					$sql = "select count(*) as cnt from job_apply";
					$rst = $db->query($sql);
					$row = $db->fetch_array($rst);
					$record_count = $row["cnt"];
					$page_count = ceil($record_count / $page_size);

					$page_str = page($page, $page_count, $pageUrl);
					echo $page_str;
					?>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="listTable">
			<form name="form1" action="" method="post">
				<tr class="listHeaderTr">
					<td width="5%">序号</td>
					<td>姓名</td>
					<td>应聘职位</td>
					<td>毕业院校</td>
					<td width="10%">电话</td>
					<td width="10%">毕业时间</td>
					<td width="15%">应聘时间</td>
					<td width="5%">状态</td>
					<td width="5%">操作</td>
				</tr>
				<?php
				
				$sql = "select * from job_apply order by sortnum desc";
				$sql .= " limit " . ($page - 1) * $page_size . ", " . $page_size;
				$rst = $db->query($sql);
				while ($row = $db->fetch_array($rst))
				{
					$css = ($css == "listTr") ? "listAlternatingTr" : "listTr";
				?>
					<tr class="<?php echo $css?>">
						<td><?php echo $row["sortnum"]?></td>
						<td><a href="<?php echo $viewUrl?>&id=<?php echo $row["id"]?>"><?php echo $row["name"]?></a></td>
						<?php
						$sql1 = "select name from job where id=".$row["job_id"];
						$rst1 = $db->query($sql1);
						$row1 = $db->fetch_array($rst1);
						?>
						<td><?php echo $row1["name"]?></td>
						<td><?php echo $row["major"]?></td>
						<td><?php echo $row["phone"]?></td>
						<td><?php echo $row["graduate_time"]?></td>
						<td><?php echo $row["create_time"]?></td>
						<td>
							<?php
							switch ($row["state"])
							{
								case 0:
									echo "<font color='#0066FF'>未查看</font>";
									break;
								case 1:
									echo "已查看";
									break;
								default:
									echo "<font color='#FF0000'>错误</font>";
									break;
							}
							?>
						</td>
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
