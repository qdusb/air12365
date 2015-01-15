<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");
require(dirname(__FILE__) . "/excel_class.php");

$docu_types=array("身份证","军官证","护照","港澳通行证","入台证");
$levels=array("VIP会员","钻石会员");
$page = (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;
$listUrl = "company_member_list.php?page=$page";
$editUrl = "company_member_edit.php?page=$page";

//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$action		=$_POST['action'];
	/*下载*/
	if ($action == "download"){
		$data=getPersonalMemberData($db,$session_admin_id,$session_admin_grade);
		Create_Excel_File("personal_member.xls",$data);
	}elseif ($action == "delete"){
		$id_array = $_POST["ids"];
		if (!is_array($id_array)){
			$id_array = array($id_array);
		}
		$db->query("begin");
		$sql = "delete from member where id in (" . implode(",", $id_array) . ")";
		$rst = $db->query($sql);
		if ($rst){
			$db->query("commit");
			$db->close();
			header("Location: $listUrl");
			exit();
		}else{
			$db->query("rollback");
			$db->close();
			info("删除失败！");
		}
	}elseif($action == "send_message"){
		$id_array = $_POST["ids"];
		$sms_id = $_POST["sms_id"];
		if(empty($sms_id)){
			info("请选择短信");
		}
		if (!is_array($id_array)){
			$id_array = array($id_array);
		}
		if(empty($id_array[0])){
			info("请选择会员");
		}
		
		$retval=sendMessage($db,$id_array,$sms_id);
		if($retval){
			info("发送信息成功");
		}else{
			info("发送信息失败");
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
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
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
					<a href="<?php echo $listUrl?>">[刷新列表]</a>&nbsp;
					<a href="javascript:reverseCheck(document.form1.ids);">[反向选择]</a>&nbsp;
					<a href="javascript:if(delCheck(document.form1.ids)) {document.form1.action.value = 'delete';document.form1.submit();}">[删除]</a>&nbsp;
					<a href="<?php echo $editUrl?>">[新增会员]</a>&nbsp;
					<a href="javascript:document.form1.action.value = 'download';document.form1.submit();">[数据导出]</a>&nbsp;&nbsp;
					<a href="javascript:return false;" id="send_message">[发送短信]</a>
				</td>

				<td align="right">
					<?php
					//设置每页数
					$page_size = DEFAULT_PAGE_SIZE;
					//总记录数
					if($session_admin_grade==7){
						$record_count = $db->getCount("member","admin_id={$session_admin_id} and user_type=1");
					}else{
						$record_count = $db->getCount("member","and user_type=1");
					}
					$record_count = $db->getCount("member");
					$page_count = ceil($record_count / $page_size);
					$page_str = page($page, $page_count, $pageUrl);
					echo $page_str;
					?>
				</td>
			</tr>
			<script type="text/javascript">
			$(function(){
				$("#send_message").click(function(){
					$("#sms_tr").show();
				});
				$("#sms_select").change(function(){
					var sms=$(this).find("option:selected").text();
					$("#sms_content").val(sms);
				});
			});
			</script>
		</table>
			<form name="form1" action="" method="post">
			<input type="hidden" name="action" value="">
			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="listTable">
				<tr height="30" id="sms_tr" style="display:none" class="listHeaderTr">
					<td colspan="2" width="20%">
						<select name="sms_id" id="sms_select" style="width:120px">
							<option value="">请选择短信</option>
						<?php
						$sql="select * from sms where state=1 order by create_time desc";
						$rst=$db->query($sql);
						while($row=$db->fetch_array($rst)){
							echo "<option value={$row['id']} >".$row['content']."</option>";
						}
						?>
						</select>
					</td>
					<td colspan="8" width="80%" align="left">
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="120" value="请选择短信" id="sms_content"/>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.form1.action.value = 'send_message';document.form1.submit();">[发送短信]</a>
					</td>
				</tr>
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
				
				<?php
				$sql = "select * from member ";
				if($session_admin_grade==7){
					$sql.="where admin_id={$session_admin_id} and user_type=1";
				}else{
					$sql.="where user_type=1";
				}
				$sql .= "order by sortnum desc limit " . ($page - 1) * $page_size . ", " . $page_size;
				$rst = $db->query($sql);
				while ($row = $db->fetch_array($rst))
				{
					$css = ($css == "listTr") ? "listAlternatingTr" : "listTr";
				?>
					<tr class="<?php echo $css?>">
						<td><input type="checkbox" id="ids" name="ids[]" value="<?php echo $row["id"]?>"></td>
						<td><a href="<?php echo $editUrl?>&id=<?php echo $row["id"]?>"><?php echo $row["user"]?></a></td>
						<td><?php echo $row["user_no"]?></td>
						<td><?php echo $row["name"]?></td>
						<td><?php echo $docu_types[$row['docu_type']];?></td>
						<td><?php echo $row["docu_no"]?></td>
						<td><?php echo $levels[$row['level']];?></td>
						<td><?php echo $row["phone"]?></td>
						<td><?php echo $row["company"]?></td> 
						<td><?php echo $row["create_time"]?></td>           
					</tr>
				<?php }?>
				<tr class="listFooterTr">
					<td colspan="10"><?php echo $page_str?></td>
				</tr>
				</table>
			</form>
		<?php
		$db->close();
		?>
	</body>
</html>
