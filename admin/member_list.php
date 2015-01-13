<?
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");
require "excel_class.php";

$docu_types=array("身份证","军官证","护照","港澳通行证","入台证");
$levels=array("VIP会员","钻石会员");
$page = (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;
$listUrl = "member_list.php?page=$page";
$editUrl = "member_edit.php?page=$page";


//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

//删除
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action		=$_POST['action'];
	if ($action == "download")
	{
		$date="<table border='1' bordercolor='#999999' width='100%' bordercolor='#000000'>";
		$date.=("<tr class='listHeaderTr'><td width='10%'>用户名</td><td width='15%'>会员级别</td><td width='10%'>会员编号</td><td width='10%'>会员姓名</td>".
			"<td width='10%'>证件类型</td><td width='10%'>证件编号</td><td width='10%'>手机号</td><td width='15%'>工作单位</td><td>创建时间</td></tr>");
		$cnt=0;
		$sql = "select * from member order by sortnum asc";
		$rst = $db->query($sql);
		while($row = $db->fetch_array($rst))
		{
			$vip=$levels[$row['level']];
			$docu=$docu_types[intval($row["docu_type"])];
			$bg=$cnt%2==0?"#FFFF00":"#FFFFFF";
		$date.=("<tr bgcolor={$bg}><td>".$row['user']."</td><td>".$vip."</td><td>".$row["user_no"]."</td><td>".$row["name"]."</td><td>".$docu."</td><td>".$row["docu_no"]."</td><td>".$row["phone"]."</td><td>".$row["company"]."</td><td>".$row["create_time"]."</td></tr>");
		$cnt++;
		}
		$date.="</table>";
		Create_Excel_File("member.xls",$date);
	}
	else
	{
		$id_array = $_POST["ids"];
		if (!is_array($id_array))
		{
			$id_array = array($id_array);
		}
	
		$db->query("begin");
		$sql = "delete from member where id in (" . implode(",", $id_array) . ")";
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
			info("删除失败！");
		}
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
				<td class="position">当前位置: 管理中心 -&gt; 高级管理 -&gt; 个人会员管理</td>
			</tr>
		</table>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr height="30">
				<td>
					<a href="<?=$listUrl?>">[刷新列表]</a>&nbsp;
					<a href="javascript:reverseCheck(document.form1.ids);">[反向选择]</a>&nbsp;
					<a href="javascript:if(delCheck(document.form1.ids)) {document.form1.submit();}">[删除]</a>&nbsp;
					<a href="<?=$editUrl?>">[新增会员]</a>&nbsp;
					<a href="javascript:document.form1.action.value = 'download';document.form1.submit();">[数据导出]</a>&nbsp;&nbsp;
				</td>
				<td align="right">
					<?
					//设置每页数
					$page_size = DEFAULT_PAGE_SIZE;
					//总记录数
					if($session_admin_grade==7){
						$record_count = $db->getCount("member","admin_id={$session_admin_id}");
					}else{
						$record_count = $db->getCount("member");
					}
					$record_count = $db->getCount("member");
					$page_count = ceil($record_count / $page_size);
					$page_str = page($page, $page_count, $pageUrl);
					echo $page_str;
					?>
				</td>
			</tr>
		</table>
			<form name="form1" action="" method="post">
			<input type="hidden" name="action" value="">
			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="listTable">
				<tr class="listHeaderTr">
					<td width="5%"></td>
					<td width="8%">用户名</td>
					<td width="10%">会员编号</td>
					<td width="8%">姓名</td>
					<td width="8%">证件类型</td>
					<td width="15%">证件编号</td>
					<td width="8%">会员等级</td>
					<td width="15%">联系方式</td>
					<td width="15%">工作单位</td>
					<td>创建时间</td>
				</tr>
				<?
				$sql = "select * from member ";
				if($session_admin_grade==7){
					$sql.="where admin_id={$session_admin_id} ";
				}
				$sql .= "order by sortnum desc limit " . ($page - 1) * $page_size . ", " . $page_size;
				$rst = $db->query($sql);
				while ($row = $db->fetch_array($rst))
				{
					$css = ($css == "listTr") ? "listAlternatingTr" : "listTr";
				?>
					<tr class="<?=$css?>">
						<td><input type="checkbox" id="ids" name="ids[]" value="<?=$row["id"]?>"></td>
						<td><a href="<?=$editUrl?>&id=<?=$row["id"]?>"><?=$row["user"]?></a></td>
						<td><?=$row["user_no"]?></td>
						<td><?=$row["name"]?></td>
						<td><?=$docu_types[$row['docu_type']];?></td>
						<td><?=$row["docu_no"]?></td>
						<td><?=$levels[$row['level']];?></td>
						<td><?=$row["phone"]?></td>
						<td><?=$row["company"]?></td> 
						<td><?=$row["create_time"]?></td>           
					</tr>
				<?
				}
				?>
				<tr class="listFooterTr">
					<td colspan="10"><?=$page_str?></td>
				</tr>
				</table>
			</form>
		
		<?
		$db->close();
		?>
	</body>
</html>
