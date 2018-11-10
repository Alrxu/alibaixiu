<?php
$nickname=$_POST['nickname'];
$email=$_POST['email'];
$slug=$_POST['slug'];
$password=$_POST['password'];

include_once"../../phpTools.php";
$sql="insert into users(email,slug,password,nickname,avatar,status) values('$email','$slug','$password','$nickname','../../uploads/avatar_2.jpg','activated')";
$rows=excute_zsg($sql);
if($rows){
    echo"ok";
}else{
    echo"fail";
}


?>