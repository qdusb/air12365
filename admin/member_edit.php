<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");

$id		= (int)$_GET["id"];
$page	= (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;

$listUrl = "member_list.php?page=$page";

//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

$read_only="readonly='readonly'";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$pass		=trim($_POST['pass']);
	$data=array(
		"sortnum"=>(int)$_POST["sortnum"],
		"user"=>$_POST['user'],
		"user_no"=>strtolower($_POST['user_no']),
		"user_type"=>0,
		"level"=>intval($_POST['level']),
		"name"=>$_POST['name'],
		"docu_type"=>$_POST['docu_type'],
		"docu_no"=>$_POST['docu_no'],
		"phone"=>$_POST['phone'],
		"company"=>$_POST['company'],
		"admin_id"=>$session_admin_id
	);

	if($id<1)
	{
		if(empty($pass)){
			info("用户名密码不能为空");
		}
		$cnt=$db->getCount("member","user='{$user}' or user_no='{$user_no}'");
		if($cnt>0){
			info("用户名或会员编号已存在，不能新增");
		}else{
			$aid=$db->getMax("member", "id") + 1;
			$data['id']=$aid;
			$data['pass']=md5($pass);
			$data['create_time']=date("Y:m:d H:i:s");
			if($db->insert_data("member",$data)){
				header("location: $listUrl");
				exit;
			}else{
				info("新增失败,请确认用户名或者会员编号未被使用");
			}
		}
	}else{
		if(!empty($pass)){
			$data['pass']=md5($pass);
		}
		$data['update_time']=date("Y:m:d H:i:s");
		if($db->update_data("member",$data,"id={$id}")){
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
				$user_no=getDiamondNo($db);
			}else{
				$user_no=getVipNo($db);
			}
		}
	}else{
		$db->close();
		info("指定的记录不存在！");
	}
}else{
	$read_only="";
	$sortnum=$db->getMax("member", "sortnum","user_type=0") + 10;
	$user_no=getVipNo($db);
    $level=0;
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
					<a href="<?php echo $listUrl?>">[返回列表]</a>&nbsp;
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
					<td class="editRightTd"><input type="text" name="sortnum" maxlength="20" size="24" value="<?php echo $sortnum?>"/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">用户名</td>
					<td class="editRightTd"><input type="text" name="user" maxlength="20" size="60" value="<?php echo $user?>" <?php echo $read_only?>/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">会员编号/级别</td>
					<td class="editRightTd">
                    <input type="text" name="user_no" id="user_no" maxlength="20" size="30" value="<?php echo $user_no?>" <?php echo $read_only?>/>

                    <input type="radio" value="0" name="level" <?php if($level == 0) echo "checked";?> class="user_no_type"/>Vip会员 &nbsp;
                    <input type="radio" value="1" name="level" <?php if($level == 1) echo "checked";?> class="user_no_type"/>钻石会员
                    <?php if(empty($id)){?>
                    <script>
                    var diamond_no="<?php echo getDiamondNo($db);?>";
                    var vip_no="<?php echo $user_no?>";
                    $(function(){
                        var $user_no=$("#user_no");
                        $(".user_no_type").click(function(){
                            var val=$(this).val();
                            var no=val==0?vip_no:diamond_no
                            $user_no.val(no);
                        });
                    })
                    </script>
                    <?php }?>
                    </td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">会员密码</td>
					<td class="editRightTd"><input type="password" name="pass" maxlength="20" size="60" value=""/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">姓名</td>
					<td class="editRightTd"><input type="text" name="name" maxlength="20" size="60" value="<?php echo $name?>"/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">证件类型</td>
					<td class="editRightTd">
						<?php
						$docu_types=array("身份证","军官证","护照","港澳通行证","入台证");
						foreach($docu_types as $key=>$val){
						?>
						<input type="radio" name="docu_type" value="<?php echo $key?>" <?php if($key==$docu_type)echo "checked"?>/><?php echo $val ?>
						<?php } ?>
					</td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">证件号码</td>
					<td class="editRightTd"><input type="text" name="docu_no" maxlength="20" size="60" value="<?php echo $docu_no?>"/></td>
				</tr>
				<tr class="editTr">
					<td class="editLeftTd">电话</td>
					<td class="editRightTd"><input type="text" name="phone" maxlength="20" size="60" value="<?php echo $phone?>"/></td>
				</tr>
	
				<tr class="editTr">
					<td class="editLeftTd">工作单位</td>
					<td class="editRightTd"><input type="text" name="company" maxlength="20" size="60" value="<?php echo $company?>"/></td>
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
