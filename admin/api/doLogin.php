<?php
// 获取到邮箱和密码
$email=$_POST['email'];
$password=$_POST['password'];
//连接数据库
include_once "../../phpTools.php";
$sql="select * from users where email='$email' and password='$password'";
$arr=excute_select($sql);
if(count($arr)>0){
    echo"ok";
    //  登录成功,保存这条登录信息在session中
    session_start();
    $_SESSION['info']=$arr[0];
}else{
    echo"fail";
}
?>