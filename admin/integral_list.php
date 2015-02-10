<?php

require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");
require(dirname(__FILE__) . "/excel_class.php");

$page = (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;
$uid     = (int)$_GET["uid"];
$search     = (string)$_GET["search"];
$type     = (string)$_GET["type"];
if(empty($type)){
    $backUrl = "member_list.php?page=$page&uid=$uid&search=$search";
}else{
    $backUrl = "company_member_list.php?page=$page&uid=$uid&search=$search";
}


$record_type=1;
//连接数据库
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
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr class="position">
        <td class="position">当前位置: 管理中心 -&gt; 高级管理 -&gt; 积分管理</td>
    </tr>
</table>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr height="30">
        <td>
            <a href="<?php echo $backUrl?>">[返回列表]</a>&nbsp;
        </td>

        <td align="right">
            <?php
            //设置每页数
            $page_size = DEFAULT_PAGE_SIZE;
            //总记录数
            $record_count = $db->getCount("integral_log"," member_id=$uid");
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
            <td width="5%">序号</td>
            <td width="15%">操作用户</td>
            <td width="20%">操作时间</td>
            <td width="10%">积分变化</td>
            <td>操作理由</td>

        </tr>
        <?php
        $sql = "select a.name,i.integral,i.create_time,i.operation  from integral_log as i left join admin as a on i.admin_id=a.id ";

        $sql .= " where i.member_id=$uid order by create_time desc limit " . ($page - 1) * $page_size . ", " . $page_size;
        $key=0;
        $rst = $db->query($sql);
        while ($row = $db->fetch_array($rst))
        {
            $ret=$db->getTableFieldValues("member",array("company","user_no"),"where id={$row['user_id']}");
            $css = ($css == "listTr") ? "listAlternatingTr" : "listTr";
            $key++;
            ?>
            <tr class="<?php echo $css?>">
                <td><?php echo $key?></td>
                <td><?php echo empty($row['name'])?"系统管理员":$row['name']?></td>
                <td><?php echo $row['create_time']?></td>
                <td><?php echo $row["integral"]?></td>
                <td><?php echo $row['operation']?></td>
            </tr>
        <?php }?>
        <tr class="listFooterTr">
            <td colspan="5"><?php echo $page_str?></td>
        </tr>
    </table>
</form>
<?php
$db->close();
?>
</body>
</html>
