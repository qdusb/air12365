<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");

$id		= (int)$_GET["id"];
$page	= (int)$_GET["page"] > 0 ? (int)$_GET["page"] : 1;

$listUrl = "air_record_list.php?page=$page";

//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user_id=$_POST['user_id'];
    if(empty($user_id)){
        $user_no=$_POST['user_no'];
        $user_id=$db->getTableFieldValue("member","id","where user_no='{$user_no}'");
    }

    $data=array(
        "sortnum"=>(int)$_POST["sortnum"],
        "user_id"=>$user_id,
        "passenger"=>$_POST['passenger'],
        "fly_date"=>$_POST['fly_date'],
        "arrive_date"=>$_POST['arrive_date'],
        "trip"=>$_POST['trip'],
        "ticket_price"=>$_POST['ticket_price'],
        "deposit"=>$_POST['deposit'],
        "admin_id"=>$session_admin_id
    );

    if($id<1)
    {
        if(empty($user_id)) {
            info("请填写正确的用户编号");
        }
        if($db->insert_data("air_record",$data)){
            header("location: $listUrl");
            exit;
        }else{
            info("新增失败");
        }
    }else{

        $data['update_time']=date("Y:m:d H:i:s");
        if($db->update_data("air_record",$data,"id={$id}")){
            header("location: $listUrl");
            exit;
        }else{
            info("修改失败！");
        }
    }
}

if(!empty($id)){
    $read_only="readOnly='readOnly'";
    $sql = "select * from air_record where id=$id";
    $rst = $db->query($sql);
    if ($row = $db->fetch_array($rst))
    {
        $sortnum	= $row["sortnum"];
        $user_id	=$row['user_id'];
        $passenger	=$row['passenger'];
        $fly_date	=$row['fly_date'];
        $arrive_date=$row['arrive_date'];
        $trip	    =$row['trip'];
        $ticket_price=$row['ticket_price'];
        $deposit		=$row['deposit'];
        $user_no=$db->getTableFieldValue("member","user_no","where id='{$user_id}'");
    }else{
        $db->close();
        info("指定的记录不存在！");
    }
}else{
    $read_only="";
    $sortnum=$db->getMax("air_record", "sortnum") + 10;
    $user_no="xc999";
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
        <td class="position">当前位置: 管理中心 -&gt; 高级管理 -&gt; 个人会员登机信息管理</td>
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
            <td class="editHeaderTd" colSpan="2">个人会员登机信息管理</td>
        </tr>
        <tr class="editTr">
            <td class="editLeftTd">序号</td>
            <td class="editRightTd"><input type="text" name="sortnum" maxlength="20" size="24" value="<?php echo $sortnum?>"/></td>
        </tr>
        <tr class="editTr">
            <td class="editLeftTd">会员编号</td>
            <td class="editRightTd">
                <input type="text" name="user_no" id="user_no" maxlength="20" size="60" value="<?php echo $user_no?>" <?php echo $read_only?>/>&nbsp;&nbsp;
                <?php if(empty($id)){?>
                <button type="button" id="num_check">检测会员编号</button>
                    <script>
                        $(function(){
                            $("#user_no").blur(function(){
                                var user_no=$("#user_no").val();
                                $.ajax({type:'POST',url:'member_ajax.php',data:{user_no:user_no},success:function (data,textStatus){
                                    var obj=eval("("+data+")");
                                    if(obj.retval=="ok"){
                                        var user_id=obj.user_id;
                                        var user_name=obj.name;
                                        $("input[name=user_id]").val(user_id);
                                        $("input[name=passenger]").val(user_name);
                                    }

                                    this;}});
                            });
                            $("#num_check").click(function(){
                                var user_no=$("#user_no").val();
                                $.ajax({type:'POST',url:'member_ajax.php',data:{user_no:user_no},success:function (data,textStatus){
                                    var obj=eval("("+data+")");
                                    var user_name="";
                                    var user_id="";
                                    if(obj.retval=="ok"){
                                        var msg="账号存在";
                                        user_id=obj.user_id;
                                        user_name=obj.name;
                                    }else{
                                        msg="账号不存在,请查证！";
                                    }
                                    alert(msg);
                                    $("input[name=user_id]").val(user_id);
                                    $("input[name=passenger]").val(user_name);
                                    this;}});
                            });
                        })
                    </script>
                <?php }?>
                <input type="text" style="display: none" name="user_id" maxlength="20" size="5" value="<?php echo $user_id;?>" />
            </td>
        </tr>

        <tr class="editTr">
            <td class="editLeftTd">乘机人</td>
            <td class="editRightTd"><input type="text" name="passenger" maxlength="20" size="60" value="<?php echo $passenger?>"/></td>
        </tr>

        <tr class="editTr">
            <td class="editLeftTd">起飞时间</td>
            <td class="editRightTd"><input type="text" name="fly_date" maxlength="20" size="60" value="<?php echo $fly_date?>"/></td>
        </tr>
        <tr class="editTr">
            <td class="editLeftTd">到达时间</td>
            <td class="editRightTd"><input type="text" name="arrive_date" maxlength="20" size="60" value="<?php echo $arrive_date?>"/></td>
        </tr>
        <tr class="editTr">
            <td class="editLeftTd">行程</td>
            <td class="editRightTd"><input type="text" name="trip" maxlength="20" size="60" value="<?php echo $trip?>"/></td>
        </tr>
        <tr class="editTr">
            <td class="editLeftTd">票面金额</td>
            <td class="editRightTd"><input type="text" name="ticket_price" maxlength="20" size="60" value="<?php echo $ticket_price?>"/></td>
        </tr>
        <tr class="editTr">
            <td class="editLeftTd">预存款</td>
            <td class="editRightTd"><input type="text" name="deposit" maxlength="20" size="60" value="<?php echo $deposit?>"/></td>
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
