<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");

//高级管理权限
if ($session_admin_grade != ADMIN_HIDDEN && $session_admin_grade != ADMIN_SYSTEM && hasInclude($session_admin_advanced, BANNER_CLASS_ADVANCEDID) == false)
{
	info("没有权限！");
}

$id		= trim($_GET["id"]);
$page	= (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;

$listUrl	= "album_class_list.php?page=$page";
$editUrl		= "album_class_edit.php";

//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);
//删除
if ($id != "")
{
	//是否有内容
	if ($db->getCount("album", "class_id='$id'") > 0)
	{
		$db->close();
		info("分类下有信息，请先删除信息！");
	}

	$sql = "delete from album_class where id='$id'";
	$rst = $db->query($sql);
	if ($rst)
	{
		$db->query("commit");
		$db->close();
		header("Location: $listUrl");
		exit;
	}
	else
	{
		$db->query("rollback");
		$db->close();
		info("删除分类失败！");
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
				<td class="position">当前位置: 管理中心 -&gt; 电子相册分类管理</td>
			</tr>
		</table>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr height="30">
				<td>
					<a href="<?php echo $listUrl?>">[刷新列表]</a>&nbsp;
					<a href="<?php echo $editUrl?>">[增加]</a>&nbsp;
				</td>
				<td align="right">
					<?php
					//设置每页数
					$page_size = DEFAULT_PAGE_SIZE;
					//总记录数
					$sql = "select count(*) as cnt from album_class";
					$rst = $db->query($sql);
					$row = $db->fetch_array($rst);
					$record_count = $row["cnt"];
					$page_count = ceil($record_count / $page_size);

					$page_str = page($page, $page_count, $pageUrl);
					//echo $page_str;
					?>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="listTable">
			<tr class="listHeaderTr">
				<td>序号</td>
				<td>相册名称</td>
				<td>相册缩略图</td>
				<td>批量上传图片</td>
				<td>传看图片</td>
				<td>删除</td>
			</tr>
			<?php
			$sql = "select * from album_class order by sortnum asc";
			$sql .= " limit " . ($page - 1) * $page_size . ", " . $page_size;
			$rst = $db->query($sql);
			while ($row = $db->fetch_array($rst))
			{
				$css = ($css == "listTr") ? "listAlternatingTr" : "listTr";
			?>
				
				<tr class="<?php echo $css?>">
					<td><?php echo $row["sortnum"]?></td>
					<td><a href="<?php echo $editUrl?>?id=<?php echo $row["id"]?>"><?php echo $row["name"]?></a></td>
					<?php
					if(trim($row["pic"])=="")
					{
						echo "<td>无</td>";
					}
					else
					{
						echo "<td><a href=".$row['pic'].">图片</a></td>";
					}
					?>
					<td><a href="album_upload.php?class_id=<?php echo $row["id"]?>">批量上传图片</a></td>
					<td><a href="album_list.php?class_id=<?php echo $row["id"]?>">查看图片</a></td>
					<td><a href="<?php echo $listUrl?>&id=<?php echo $row["id"]?>" onClick="return del();">删除</a></td>
				</tr>
			<?php
			}
			?>
			<tr class="listFooterTr">
				<td colspan="10"><?php echo $page_str?></td>
			</tr>
		</table>
		<?php
		$db->close();
		?>
	</body>
</html>
