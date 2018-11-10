<?php
//获取传递过来的数据
$old = $_POST['old'];
$password = $_POST['password'];
// $confirm = $_POST['confirm'];
// $email=$_POST['email'];


include_once "../../phpTools.php";

// 取出session中的密码
session_start();
$rightPwd = $_SESSION['info']['password'];
$id=$_SESSION['info']['id'];
if ($old != $rightPwd) {
    echo "旧密码错误!";
} else {
    $sql = "update users set password='$password' where id='$id'";
    $rows = excute_zsg($sql);
    if ($rows) {
        echo "修改成功";
        //修改session中的密码
        $_SESSION['info']['password'] = $password;
    }
}


?>