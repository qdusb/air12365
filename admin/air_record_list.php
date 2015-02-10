<?php

require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");
require(dirname(__FILE__) . "/excel_class.php");

$page = (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;
$uid     = (int)$_GET["uid"];
$search     = (string)$_GET["search"];

$listUrl = "air_record_list.php?page=$page&uid=$uid&search=$search";
$backUrl = "member_list.php?page=$page&uid=$uid&search=$search";
$editUrl = "air_record_edit.php?page=$page&uid=$uid&search=$search";
$record_type=0;
//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $action		=$_POST['action'];
    /*下载*/
    if ($action == "download"){
        $data=getAirRecordData($db,$session_admin_id,$session_admin_grade);
        Create_Excel_File("personal_air_record.xls",$data);
    }elseif ($action == "delete"){
        $id_array = $_POST["ids"];
        if (!is_array($id_array)){
            $id_array = array($id_array);
        }
        $db->query("begin");
        $sql = "delete from air_record where id in (" . implode(",", $id_array) . ")";
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
        <td class="position">当前位置: 管理中心 -&gt; 高级管理 -&gt; 个人会员登机信息管理</td>
    </tr>
</table>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr height="30">
        <td>
            <a href="<?php echo $backUrl?>">[返回列表]</a>&nbsp;
            <a href="<?php echo $listUrl?>">[刷新列表]</a>&nbsp;
            <a href="javascript:reverseCheck(document.form1.ids);">[反向选择]</a>&nbsp;
            <a href="javascript:if(delCheck(document.form1.ids)) {document.form1.action.value = 'delete';document.form1.submit();}">[删除]</a>&nbsp;
            <a href="<?php echo $editUrl?>">[新增记录]</a>&nbsp;
            <a href="javascript:document.form1.action.value = 'download';document.form1.submit();">[数据导出]</a>
        </td>

        <td align="right">
            <?php
            //设置每页数
            $page_size = DEFAULT_PAGE_SIZE;
            //总记录数
            if($session_admin_grade==7){
                $record_count = $db->getCount("air_record","admin_id={$session_admin_id} and user_id=$uid");
            }else{
                $record_count = $db->getCount("air_record"," user_id=$uid");
            }
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
            <td width="1%"></td>
            <td width="10%">会员编号</td>
            <td width="10%">乘机人</td>
            <td width="8%">起飞时间</td>
            <td width="15%">到达时间</td>
            <td width="8%">行程</td>
            <td width="15%">票面金额</td>
            <td width="15%">积分</td>
            <td>创建时间</td>

        </tr>
        <?php
        $sql = "select * from air_record where type=$record_type";
        if($session_admin_grade==7){
            $sql.=" and admin_id={$session_admin_id}";
        }
        if(!empty($uid)){
            $sql.=" and user_id={$uid} ";
        }
        $sql .= " order by sortnum desc limit " . ($page - 1) * $page_size . ", " . $page_size;
        $rst = $db->query($sql);
        while ($row = $db->fetch_array($rst))
        {
            $user_no=$db->getTableFieldValue("member","user_no","where id={$row['user_id']}");
            $css = ($css == "listTr") ? "listAlternatingTr" : "listTr";
            ?>
            <tr class="<?php echo $css?>">
                <td><input type="checkbox" id="ids" name="ids[]" value="<?php echo $row["id"]?>"></td>
                <td><?php echo $user_no?></td>
                <td><a href="<?php echo $editUrl?>&id=<?php echo $row["id"]?>"><?php echo $row["passenger"]?></a></td>
                <td><?php echo $row['fly_date']?></td>
                <td><?php echo $row["arrive_date"]?></td>
                <td><?php echo $row['trip']?></td>
                <td><?php echo $row["ticket_price"]?></td>
                <td><?php echo $row["deposit"]?></td>
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
