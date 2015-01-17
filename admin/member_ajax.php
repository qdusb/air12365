<?php
require(dirname(__FILE__) . "/init.php");
require(dirname(__FILE__) . "/isadmin.php");
require(dirname(__FILE__) . "/config.php");

//连接数据库
$db = new onlyDB($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_no		=$_POST['user_no'];
    $sql="select * from member where user_no={$user_no} limit 1";
    $rst=$db->query($sql);
    if($row=$db->fetch_array($rst)){
       return $row;
    }
}