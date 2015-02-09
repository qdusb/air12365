<?php
//菜单

require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");


$menu_id = $_GET["menu_id"] ? trim($_GET["menu_id"]) : "";


$i = 0;
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);
?>


<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="-1000">
		<link href="images/admin.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
			function expand(el)
			{
				childObj = document.getElementById("child" + el);

				if (childObj.style.display == "none")
				{
					childObj.style.display = "block";
				}
				else
				{
					childObj.style.display = "none";
				}
			}
		</script>
	</head>
	<body>
		<table width="170" height="100%" border="0" cellspacing="0" cellpadding="0" background="images/menu_bg.jpg">
			<tr>
				<td valign="top" align="center">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="10"></td>
						</tr>
					</table>
                    <?php
                    $sql = "select id, name, state from info_class where id like '" . CLASS_SPACE . "' order by sortnum asc";
					$rst = $db->query($sql);
					while ($row = $db->fetch_array($rst))
					{
						$i++;
						if ($session_admin_grade == ADMIN_HIDDEN || $session_admin_grade == ADMIN_SYSTEM || $session_admin_grade == ADMIN_ADVANCED || hasBegin4Include($session_admin_popedom, $row["id"]) == true)
						{
					?>
                            <table width="150" border="0" cellspacing="0" cellpadding="0">
                                <tr height="22">
                                    <td background="images/menu_bt.jpg" style="padding-left:30px"><a href="javascript:void(0)" onClick="expand(<?php echo $i?>)" class="menuParent"><?php echo $row["name"]?></a></td>
                                </tr>
                                <tr height="4">
                                    <td></td>
                                </tr>
                            </table>
                            <table id="child<?php echo $i?>" width="150" border="0" cellspacing="0" cellpadding="0" style="display:<?php echo ($row["id"] == $menu_id) ? "block" : "none"?>">
								<?php
								$sql  = "select id, name from info_class where id like '" . $row["id"] . CLASS_SPACE . "' order by sortnum asc";
								$rst2 = $db->query($sql);
								while ($row2 = $db->fetch_array($rst2))
								{
									if ($session_admin_grade == ADMIN_HIDDEN || $session_admin_grade == ADMIN_SYSTEM || $session_admin_grade == ADMIN_ADVANCED || hasInclude($session_admin_popedom, $row["id"]) == true || hasInclude($session_admin_popedom, $row2["id"]) == true)
									{
								?>
                                        <tr height="20">
                                            <td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
                                            <td><a href="info_list.php?class_id=<?php echo $row2["id"]?>" class="menuChild" target="main"><?php echo $row2["name"]?></a></td>
                                        </tr>
                                <?php
									}
                                }

                                if ($session_admin_grade == ADMIN_HIDDEN || ($session_admin_grade == ADMIN_SYSTEM && $row["state"] == 1))
                                {
                                ?>
                                    <tr height="20">
                                        <td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
                                        <?php
                                        if ($row["state"] == 1)
										{
										?>
                                        	<td><a href="second_class_list.php?class_id=<?php echo $row["id"]?>" class="menuChild" target="main">分类管理</a></td>
                                        <?php
                                        }
										else
										{
										?>
                                            <td><a href="second_class_list.php?class_id=<?php echo $row["id"]?>" class="menuChild" target="main"><font color="#FF0000">分类管理</font></a></td>
										<?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr height="4">
                                    <td colspan="2"></td>
                                </tr>
                            </table>
					<?php
						}
                    }
					$i++;
					?>
                        <table width="150" border="0" cellspacing="0" cellpadding="0">
                            <tr height="22">
                                <td background="images/menu_bt.jpg" style="padding-left:30px"><a href="javascript:void(0)" onClick="expand(<?php echo $i?>)" class="menuParent">高级管理</a></td>
                            </tr>
                            <tr height="4">
                                <td></td>
                            </tr>
                        </table>
                        <table id="child<?php echo $i?>" width="150" border="0" cellspacing="0" cellpadding="0" style="DISPLAY:none">
                    			
                        	<?php
							$sql = "select id, name, default_file from advanced where state=1 order by sortnum asc";
							$rst = $db->query($sql);
							while ($row = $db->fetch_array($rst))
							{
								if ($session_admin_grade == ADMIN_HIDDEN || $session_admin_grade == ADMIN_SYSTEM )
								{
							?>
                                    <tr height="20">
                                        <td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
                                        <td><a href="<?php echo $row["default_file"]?>" class="menuChild" target="main"><?php echo $row["name"]?></a></td>
                                    </tr>
							<?php }}?>
                            <?php
                            $advances=array(
                                //"个人订单管理"=>"air_record_list.php",
                               // "企业订单管理"=>"company_record_list.php",
                                "个人会员管理"=>"member_list.php",
                                "企业会员管理"=>"company_member_list.php"
                            );
                            foreach($advances as $key=>$val){

                            ?>
							<tr height="20">
                                <td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
                                <td><a href="<?php echo $val?>" class="menuChild" target="main"><?php echo $key?></a></td>
                            </tr>
                            <?php }?>
                            <tr height="4">
                                <td colspan="2"></td>
                            </tr>
                        </table>
					<?php

                    if ($session_admin_grade == ADMIN_HIDDEN || $session_admin_grade == ADMIN_SYSTEM)
					{
						$i++;
					?>
                        <table width="150" border="0" cellspacing="0" cellpadding="0">
                            <tr height="22">
                                <td background="images/menu_bt.jpg" style="padding-left:30px"><a href="javascript:void(0)" onClick="expand(<?php echo $i?>)" class="menuParent">系统管理</a></td>
                            </tr>
                            <tr height="4">
                                <td></td>
                            </tr>
                        </table>
                        <table id="child<?php echo $i?>" width="150" border="0" cellspacing="0" cellpadding="0" style="DISPLAY:none">
							<tr height="20">
								<td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
								<td><a href="admin_list.php" class="menuChild" target="main">管理员列表</a></td>
							</tr>
                            <tr height="4">
                                <td colspan="2"></td>
                            </tr>
                        </table>
					<?php
                    }

                    if ($session_admin_grade == ADMIN_HIDDEN)
					{
						$i++;
					?>
                        <table width="150" border="0" cellspacing="0" cellpadding="0">
                            <tr height="22">
                                <td background="images/menu_bt.jpg" style="padding-left:30px"><a href="javascript:void(0)" onClick="expand(<?php echo $i?>)" class="menuParent">隐藏管理</a></td>
                            </tr>
                            <tr height="4">
                                <td></td>
                            </tr>
                        </table>
                        <table id="child<?php echo $i?>" width="150" border="0" cellspacing="0" cellpadding="0" style="DISPLAY:none">
                            <tr height="20">
                                <td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
                                <td><a href="base_class_list.php" class="menuChild" target="main">一级分类管理</a></td>
                            </tr>
                            <tr height="20">
                                <td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
                                <td><a href="advanced_list.php" class="menuChild" target="main">高级功能管理</a></td>
                            </tr>
                            <tr height="4">
                                <td colspan="2"></td>
                            </tr>
                        </table>
					<?php
                    }
					?>
					<table width="150" border="0" cellspacing="0" cellpadding="0">
						<tr height="22">
							<td background="images/menu_bt.jpg" style="padding-left:30px"><a href="javascript:void(0)" onClick="expand(0)" class="menuParent">个人管理</a></td>
						</tr>
						<tr height="4">
							<td></td>
						</tr>
					</table>
					<table id="child0" width="150" border="0" cellspacing="0" cellpadding="0" style="DISPLAY:none">
						<tr height="20">
							<td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
							<td><a href="admin_changepass.php" class="menuChild" target="main">修改口令</a></td>
						</tr>
						<tr height="20">
							<td width="30" align="center"><img src="images/menu_icon.gif" width="9" height="9"></td>
							<td><a href="logout.php" class="menuChild" target="_top" onClick="if (confirm('确定要退出吗？')) return true; else return false;">退出系统</a></td>
						</tr>
					</table>
				</td>
				<td bgcolor="#D1E6F7" width="1"></td>
			</tr>
		</table>
		<?php
        $db->close();
		?>
	</body>
</html>
