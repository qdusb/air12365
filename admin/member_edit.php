<?
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");

//高级管理权限
if ($session_admin_grade != ADMIN_HIDDEN && $session_admin_grade != ADMIN_SYSTEM && hasInclude($session_admin_advanced, MESSAGE_ADVANCEDID) == false)
{
	info("没有权限！");
}

$id		= (int)$_GET["id"];
$page	= (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;

$listUrl = "member_list.php?page=$page";

//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

$read_only="readonly='readonly'";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$sortnum	= (int)$_POST["sortnum"];
	$user		=$_POST['user'];
	$user_no	=$_POST['user_no'];
	$pass		=trim($_POST['pass']);
	$level		=intval($_POST['level']);

	$name		=$_POST['name'];
	$docu_type	=$_POST['docu_type'];
	$docu_no	=$_POST['docu_no'];
	$phone		=$_POST['phone'];
	$company	=$_POST['company'];

	$data=array(
		"sortnum"=>$sortnum,
		"user"=>$user,
		"user_no"=>$user_no,
		"user_type"=>0,
		"level"=>$level,
		"name"=>$name,
		"docu_type"=>$docu_type,
		"docu_no"=>$docu_no,
		"phone"=>$phone,
		"company"=>$company,
	);

	if($id<1)
	{
		$sql = "select count(*) as cnt from member where user='{$user}' or user_no='{$user_no}'";
		$rst = $db->query($sql);
		$row = $db->fetch_array($rst);
		if($pass==""){
			info("用户名密码不能为空");
		}
		if($row['cnt']>0){
			info("用户名已存在，不能新增");
		}else{
			$aid=$db->getMax("member", "id") + 1;
			$data['id']=$aid;
			$data['pass']=md5($pass);
			$data['create_time']=date("Y:m:d H:i:s");
			$insert_sqls=array();
			foreach($data as $key=>$val){
				array_push($insert_sqls, $key."='".$val."'");
			}
			$sql = "insert into member set ".implode(",", $insert_sqls);
			$rst = $db->query($sql);
			$db->close();
			if(!$rst)
			{
				
				info("新增失败");
			}
			else
			{
				header("location: $listUrl");
				exit;
			}
		}
	}else{
		if($pass!=""){
			$data['pass']=md5($pass);
		}
		$data['update_time']=date("Y:m:d H:i:s");
		$update_sqls=array();
		foreach($data as $key=>$val){
			array_push($update_sqls, $key."='".$val."'");
		}
		$sql = "update member set ".implode(",", $update_sqls)." where id=$id";
		$rst = $db->query($sql);
		$db->close();
		if ($rst){
			header("location: $listUrl");
			exit;
		}else{
			info("修改失败！");
		}
	}
}

if(!empty($id)){
	$sql = "select * from member where id=$id";
	$rst = $db->query($sql);
	if ($row = $db->fetch_array($rst))
	{
		$sortnum	= $row["sortnum"];
		$user		=$row['user'];
		$user_no	=$row['user_no'];
		$level		=intval($row['level']);
		$name		=$row['name'];
		$docu_type	=$row['docu_type'];
		$docu_no	=$row['docu_no'];
		$phone		=$row['phone'];
		$company	=$row['company'];

		if($user_no==""){
			if($level==1){
				$user_no=getVipNo($db);
			}else{
				$user_no=getCommonNo($db);
			}
		}
	}
	else
	{
		$db->close();
		info("指定的记录不存在！");
	}
}
else
{
	$read_only="";
	$sortnum=$db->getMax("member", "sortnum") + 10;
	$user_no=getCommonNo($db);
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

				if (form.user.value=="")
				{
					alert("请输入用户名！");
					form.user_name.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>
	<body>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr class="position">
				<td class="position">当前位置: 管理中心 -&gt; 高级管理 -&gt; 留言簿</td>
			</tr>
		</table>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr height="30">
				<td>
					<a href="<?=$listUrl?>">[返回列表]</a>&nbsp;
				</td>
			</tr>
		</table>
		<form name="form1" action="" method="post" onSubmit="return check(this);">
			<table width="100%" border="0" cellSpacing="1" cellPadding="0" align="center" class="editTable">
				<tr class="editHeaderTr">
					<td class="editHeaderTd" colSpan="2">会员管理</td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">序号</td>
					<td class="editRightTd"><input type="text" name="sortnum" maxlength="20" size="24" value="<?=$sortnum?>"/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">用户名</td>
					<td class="editRightTd"><input type="text" name="user" maxlength="20" size="60" value="<?=$user?>" <?=$read_only?>/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">会员编号</td>
					<td class="editRightTd"><input type="text" name="user_no" maxlength="20" size="60" value="<?=$user_no?>"/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">会员密码</td>
					<td class="editRightTd"><input type="password" name="pass" maxlength="20" size="60" value=""/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">会员等级</td>
					<td class="editRightTd">
					<select name="level" style="width:80px;">
						<option value="0"  <? if($level == 0) echo "selected";?>>Vip用户</option>
						<option value="1"  <? if($level == 1) echo "selected";?>>钻石会员</option>
					</select>
					</td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">姓名</td>
					<td class="editRightTd"><input type="text" name="name" maxlength="20" size="60" value="<?=$name?>"/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">证件类型</td>
					<td class="editRightTd">
						<?php
						$docu_types=array("身份证","军官证","护照","港澳通行证","入台证");
						foreach($docu_types as $key=>$val){
						?>
						<input type="radio" name="docu_type" value="<?=$key?>" <?php if($key==$docu_type)echo "checked"?>/><?php echo $val ?>
						<?php } ?>
					</td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">证件号码</td>
					<td class="editRightTd"><input type="text" name="docu_no" maxlength="20" size="60" value="<?=$docu_no?>"/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">电话</td>
					<td class="editRightTd"><input type="text" name="phone" maxlength="20" size="60" value="<?=$phone?>"/></td>
				</tr>
	
				<tr class="editTr">
					<td class="editLeftTd">工作单位</td>
					<td class="editRightTd"><input type="text" name="company" maxlength="20" size="60" value="<?=$company?>"/></td>
				</tr>
				<tr class="editFooterTr">
					<td class="editFooterTd" colSpan="2">
						<input type="submit" value=" 确 定 ">
						<input type="reset" value=" 重 填 ">
					</td>
				</tr>
			</table>
		</form>
		<?php $db->close();?>
	</body>
</html>
