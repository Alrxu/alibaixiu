<?php
//接收到传递过来的数据

$nickname=$_POST['nickname'];
$bio=$_POST['bio'];
$slug=$_POST['slug'];
$email=$_POST['email'];
// 获取到图片
$avatar=$_FILES['avatar'];

// 取出图片名 utf-8格式
$name=$avatar['name'];
//取出图片的临时路径
$temp_path=$avatar['tmp_name'];
// 将图片的格式转换为gbk格式
$newname=iconv('utf-8','gbk',$name);
// 目标路径
$path="../../uploads/$newname";
//移动图片
move_uploaded_file($temp_path,$path);

// 图片要上传到数据库,而数据库的编码格式是utf-8
//将图片路径转为utf-8格式
 $path="../../uploads/$name";

 //数据库修改操作

 include_once"../../phpTools.php";

 // 需要进行判断,如果图片没有选,就不修改图片
 if($name!=""){
    $sql="update users set
    slug='$slug',
    nickname='$nickname',
    avatar='$path',
    bio='$bio'
    where email='$email'";
 }else{
    $sql="update users set
    slug='$slug',
    nickname='$nickname',
    bio='$bio'
    where email='$email'";
 }
 
$rows=excute_zsg($sql);
if($rows){
    echo"ok";
    // 个人信息修改成功之后,修改session
    session_start();
    $_SESSION['info']['slug']=$slug;
    $_SESSION['info']['nickname']=$nickname;
    $_SESSION['info']['bio']=$bio;
    //同样如果图片没有更改,session中的关于图片也不修改
    if($name!=""){
        $_SESSION['info']['avatar']=$path;
    }
    
}else{
    echo"fail";
}

?>